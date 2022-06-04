<?php
namespace Aalogics\Tcs\Controller\Adminhtml\Order;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use \Aalogics\Tcs\Model\OrderManager;
use \Aalogics\Tcs\Helper\Data;

class MassShip extends \Magento\Sales\Controller\Adminhtml\Order\AbstractMassAction
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Aalogics_Tcs::massship';

    const COD_PAYMENT = "Cash On Delivery";

    protected $_tcsOrderManager;
    
    protected $_tcsHelper;
    
    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, 
                                CollectionFactory $collectionFactory,
                                \Aalogics\Tcs\Model\OrderManager $tcsModel,
                                \Aalogics\Tcs\Helper\Data $tcsHelper
)
    {
        parent::__construct($context, $filter);
        $this->collectionFactory = $collectionFactory;
        $this->_tcsOrderManager = $tcsModel;
        $this->_tcsHelper = $tcsHelper;
    }
 
    /**
     * Ship via TCS selected orders
     *
     * @param AbstractCollection $collection
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    protected function massAction(AbstractCollection $collection)
    {
        $this->_tcsHelper->debug('massAction Start');
        $costcenter = $this->getRequest()->getParam('costcenter');
        $orders = array();
        $shipOrders = array ();
        $alreadyShipped = array ();
        $orderCanceled = array ();
        $nonCodOrders = array ();
        foreach ($collection->getItems() as $order) {
            if (!$order->canCancel()) {
                $orderCanceled [] = $order->getIncrementId();
                continue;
            }
            $payment = $order->getPayment();
            $method = $payment->getMethodInstance();
            $methodTitle = $method->getTitle();

           /* if ($methodTitle != $this::COD_PAYMENT) {
                $nonCodOrders [] = $order->getIncrementId();
                continue;
            }*/


            $shipment = $order->getShipmentsCollection ()->getFirstItem ();
            $shipmentIncrementId = $shipment->getIncrementId ();
            //          $shipOrders [$count ++] = $orderIds [$orders];
            if ($shipmentIncrementId == null) {
                $shipOrders [] = $order;
            } else {
                $alreadyShipped [] = $order->getIncrementId();
            }
//          $order->cancel();
//          $order->save();
//          $countCancelOrder++;
        }
        $message = '';
        $messageArray = array ();
        if (count ( $shipOrders ) <= 0) {
            $nonCodMessage = __( "Non COD order(s) : " );
            $cancelOrderMessage = __( "Cancelled order(s) : " );
            $alreadyShippedMessage = __( "Shipment has already been created for the selected order(s) : " );

            if(count($orderCanceled) > 0){
                $this->computeErrorToMessage($orderCanceled, $cancelOrderMessage);
            }
            if(count($alreadyShipped) > 0){
                $this->computeErrorToMessage($alreadyShipped, $alreadyShippedMessage);
            }
            if(count($nonCodOrders) > 0){
                $this->computeErrorToMessage($nonCodOrders, $nonCodMessage);
            }
            
            // $this->computeErrorToMessage($alreadyShipped, $alreadyShippedMessage);
            // $this->computeErrorToMessage($nonCodOrders, $nonCodMessage);

            // $this->_redirect ( 'adminhtml/sales_order/' );
        } else {
            for($x = 0; $x < count ( $alreadyShipped ); $x ++) {
                $message .= $alreadyShipped [$x];
                 
                if (! $x == (count ( $alreadyShipped ) - 1))
                    $message .= ',';
            }
        }
        if(strlen($message) > 0){
            $this->messageManager->addError($message);    
        }
        



        $this->_tcsHelper->debug('massAction invoiceandShipAll');
        // Process Invoices + Shipments
        $result = $this->_tcsOrderManager->invoiceAndShipAll (
                $shipOrders, $this->_tcsHelper->getAdminField ( 'invoiceshipaction/newstatus' ),
                $this->_tcsHelper->getAdminField ( 'invoiceshipaction/sendinvoiceemail' ),
                $this->_tcsHelper->getAdminField ( 'invoiceshipaction/sendshipemail' ),
                $this->_getTrackingNumbers (),
                $this->_getCarrierCodes (),
                $costcenter
        );
        
//      $resultRedirect = $this->resultRedirectFactory->create();
//      $resultRedirect->setPath($this->getComponentRefererUrl());
//      return $resultRedirect;
        
//      $this->pdfdocsAction ( $orderIds );
        
        // Add results to session
        $this->addResultsToSession ( $result, 'Invoiced and shipped' );
        // go back to the order overview page
        
        $orderErrors = $this->_redirectWithSelectiontcs ( $shipOrders, 'invoiceshipaction', $alreadyShipped );
        
        
        
    }
    
    
    
    protected function _redirectWithSelectionpdf($orderIds, $action) {
        $keepSelection = Mage::helper ( 'aatcs' )->getStoreConfig ( $action . '/keepselection' );
        if ($keepSelection && is_array ( $orderIds ) && ! empty ( $orderIds )) {
            $orderIds = implode ( ',', $orderIds );
            $this->pdfdocsAction ();
        } else {
                
            // $this->_redirect ( 'adminhtml/sales_order/' );
            $this->_redirect ( 'sales/order/' );
        }
    }
    protected function _redirectWithSelectiontcs($orderIds, $action, $alreadyShipped = array()) {
        $keepSelection = $this->_tcsHelper->getAdminField ( $action . '/keepselection' );
        if ($keepSelection && is_array ( $orderIds ) && ! empty ( $orderIds )) {
            $this->addResultsToSession ( $result, 'Invoiced and shipped' );
            $this->pdfdocsAction ();
        } else {
                
            // $this->_redirect ( 'adminhtml/sales_order/' );
            $this->_redirect ( 'sales/order/' );
        }
    }
    public function pdfdocsAction() {
    
        $orderIds = $this->getRequest ()->getPost ('order_ids');
        error_log('pdfdocsAction Order Ids'.print_r($orderIds, TRUE));
        $flag = false;
        if (! empty ( $orderIds )) {
            foreach ( $orderIds as $orderId ) {
                $invoices = Mage::getResourceModel ( 'sales/order_invoice_collection' )->setOrderFilter ( $orderId )->load ();
                $shipments = Mage::getResourceModel ( 'sales/order_shipment_collection' )->setOrderFilter ( $orderId )->load ();
                if ($shipments->getSize ()) {
                    $flag = true;
                        
                    if (! isset ( $pdf )) {
    
                        $pdf = Mage::getModel ( 'sales/order_pdf_shipment' )->getPdf ( $shipments );
                    } else {
                        $pages = Mage::getModel ( 'sales/order_pdf_shipment' )->getPdf ( $shipments );
                        $pdf->pages = array_merge ( $pdf->pages, $pages->pages );
                    }
                }
    
                $creditmemos = Mage::getResourceModel ( 'sales/order_creditmemo_collection' )->setOrderFilter ( $orderId )->load ();
                if ($creditmemos->getSize ()) {
                    $flag = true;
                    if (! isset ( $pdf )) {
                        $pdf = Mage::getModel ( 'sales/order_pdf_creditmemo' )->getPdf ( $creditmemos );
                    } else {
                        $pages = Mage::getModel ( 'sales/order_pdf_creditmemo' )->getPdf ( $creditmemos );
                        $pdf->pages = array_merge ( $pdf->pages, $pages->pages );
                    }
                }
            }
            if ($flag) {
                Mage::log('in flag');
                return $this->_prepareDownloadResponse ( 'docs' . Mage::getSingleton ( 'core/date' )->date ( 'Y-m-d_H-i-s' ) . '.pdf', $pdf->render(), 'application/pdf' );
            } else {
                Mage::log ( "false" );
                $this->_getSession ()->addError ( $this->__ ( 'There are no printable documents related to selected orders.' ) );
                $this->_redirect ( '*/*/' );
            }
        }
    
        $this->_redirect ( '*/*/' );
    }
    
    /**
     * sorted order ids from POST
     *
     * @return mixed
     */
    protected function _getOrderIds()
    {
        $orderIds = $this->getRequest()->getPost('order_ids');
        sort($orderIds);
        return $orderIds;
    }
    
    /**
     * retrieve tracking numbers from POST
     * sort into array by order_id
     */
    protected function _getTrackingNumbers()
    {
        $trackingNumbersSorted = array();
        $trackingNumbersRaw = $this->getRequest()->getPost('tracking');
        if (!$trackingNumbersRaw) {
            return $trackingNumbersSorted;
        }
        $trackingNumbersRaw = explode(",", $trackingNumbersRaw);
        foreach ($trackingNumbersRaw as $trackingNumberRaw) {
            list($orderId, $number) = explode("|", $trackingNumberRaw);
            $trackingNumbersSorted[$orderId] = $number;
        }
        return $trackingNumbersSorted;
    }
    
    /**
     * retrieve carrier codes from POST
     * sort into array by order_id
     */
    protected function _getCarrierCodes()
    {
        $carrierCodesSorted = array();
        $carrierCodesRaw = explode(",", $this->getRequest()->getPost('carrier'));
        if (is_array($carrierCodesRaw)) {
            foreach ($carrierCodesRaw as $carrierCodeRaw) {
                if (!preg_match('/[a-z|]/', $carrierCodeRaw)) {
                    continue;
                }
                list($orderId, $code) = explode("|", $carrierCodeRaw);
                $carrierCodesSorted[$orderId] = $code;
            }
        }
        return $carrierCodesSorted;
    }

    public function computeErrorToMessage($array, $message)
    {
        //$message = '';
        for($x = 0; $x < count ( $array ); $x ++) {

            $message .= (string)$array [$x];
             
            if (! $x == (count ( $array ) - 1))
                $message .= ', ';
        }
        $messages = array();
        $messages['errors'] = $message;

        $this->addErrorToSession($messages, "");
    }

    public function addErrorToSession($result, $successMessage)
    {
        if (!empty($result['errors'])) {
            $this->messageManager->addError($result['errors']);
        }
        if (!empty($result['successes'])) {
            $this->messageManager->addSuccess(__($successMessage . ': ' . implode(',', $result['successes'])));
        }
    }

    /**
     * add both error and success message to admin session
     *
     * @param $result
     * @param $successMessage
     */
    public function addResultsToSession($result, $successMessage)
    {
        if (!empty($result['errors'])) {
            $this->messageManager->addError(implode('<br/>', $result['errors']));
        }
        if (!empty($result['successes'])) {
            $this->messageManager->addSuccess(__($successMessage . ': ' . implode(',', $result['successes'])));
        }
    }
}
