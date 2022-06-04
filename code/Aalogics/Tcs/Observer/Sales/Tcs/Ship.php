<?php
/**
 * Pmclain_Twilio extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GPL v3 License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl.txt
 *
 * @category       Pmclain
 * @package        Twilio
 * @copyright      Copyright (c) 2017
 * @license        https://www.gnu.org/licenses/gpl.txt GPL v3 License
 */

namespace Aalogics\Tcs\Observer\Sales\Tcs;

use Magento\Framework\Event\ObserverInterface;
use \Aalogics\Tcs\Helper\Data as Helper;
use \Aalogics\Tcs\Model\Api\Tcs\Api\Request;
use \Magento\Sales\Model\Order\ShipmentFactory;
use \Magento\Sales\Api\ShipmentRepositoryInterface;
use \Magento\Shipping\Model\ShipmentNotifier;
use \Magento\Sales\Api\ShipmentTrackRepositoryInterface;
use \Magento\Sales\Api\Data\ShipmentTrackInterface;
use \Magento\Sales\Model\Order\Shipment\TrackFactory;

class Ship implements ObserverInterface
{
    /**
     * @var \Pmclain\Twilio\Helper\Data
     */
    protected $_helper;

    /** @var \Magento\Sales\Api\ShipmentRepositoryInterface */
    protected $shipmentRepository;

    /** @var \Magento\Sales\Model\Order\ShipmentFactory */
    protected $shipmentFactory;

    /** @var \Magento\Shipping\Model\ShipmentNotifier */
    protected $shipmentNotifier;

    /** @var \Magento\Sales\Model\Order\Shipment\TrackFactory */
    protected $_trackFactory;

    /** @var \Magento\Sales\Api\ShipmentTrackRepositoryInterface */
    protected $_trackRepository;

    /** @var \Aalogics\Tcs\Model\Api\Tcs\Api\Request */
    protected $_apiRequest;

    protected $orderModel;
	private $_objectManager;

    public function __construct(
        	Helper $helper,
    		\Magento\Sales\Api\ShipmentRepositoryInterface $shipmentRepository,
        	\Magento\Sales\Model\Order\ShipmentFactory $shipmentFactory,
        	\Magento\Shipping\Model\ShipmentNotifier $shipmentNotifier,
    		\Magento\Sales\Model\Order\Shipment\TrackFactory $trackFactory,
    		\Aalogics\Tcs\Model\Api\Tcs\Api\Request $apiRequest,
    		\Magento\Sales\Api\ShipmentTrackRepositoryInterface $trackRepository,
    		\Magento\Sales\Model\Convert\Order $orderModel,
			\Magento\Framework\ObjectManagerInterface $objectmanager
    ) {
    	$this->_apiRequest = $apiRequest;
        $this->_helper = $helper;
        $this->_shipmentFactory = $shipmentFactory;
        $this->_shipmentNotifier = $shipmentNotifier;
        $this->_shipmentRepository = $shipmentRepository;
        $this->_trackFactory = $trackFactory;
        $this->_trackRepository = $trackRepository;
        $this->orderModel = $orderModel;
		$this->_objectManager = $objectmanager;
		
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return \Magento\Framework\Event\Observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
    	$this->_helper->debug('execute observer sales order ship');
    	$order = $observer->getOrder();
    	$costcenter = $observer->getCostCenter();
    	if($observer->getCity()){
    		$city = $observer->getCity();
    	}
    	else{
    		$city = null;
    	}
    	if($this->_helper->isEnabled()
		) {
			$this->_helper->debug('tcs ship observer execute Start');
// 	        if ($order->getBillingAddress()->getTelephone()) {
	            $this->tcsTrackingNumberShip($order, $costcenter, $city); 	
// 	        }
    	}
        return $observer;
    }

/**
	 *
	 * @param unknown $observer
	 */
	public function tcsTrackingNumberShip($order, $costcenter, $city) {
		
		$priceCurrencyFactory = $this->_objectManager->get('Magento\Directory\Model\CurrencyFactory');
        $storeManager = $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface');
		$currencyCodeTo = $storeManager->getStore()->getCurrentCurrency()->getCode(); 
		$currencyCodeFrom = "PKR"; //$storeManager->getStore()->getBaseCurrency()->getCode();
		
		$paymentMethod = $order->getPayment()->getMethodInstance()->getCode();
		$message = array ();
		$parameters = array();
		$order->getCustomerId (); // get customer Id
		$parameters['order_id'] = str_replace ( '-', '', $order->getIncrementId () ); // removing - from order id
		$parameters['costcenter'] = $costcenter;//@todo fix this
		$parameters['consignee_email'] = $order->getCustomerEmail (); // get customer Email
		$parameters['consignee_name'] = $order->getShippingAddress ()->getFirstname () . ' ' . $order->getShippingAddress ()->getLastname (); // get customer Name
		$shipping_address = $order->getShippingAddress (); // get customer Address
		$telephone = $order->getShippingAddress()->getTelephone (); // get customer Telephone
		$parameters['telephone'] = ltrim ( str_replace ( '+92', '', $telephone ), '0' );
		$shipAddress = $order->getShippingAddress();
		$street = $shipAddress->getStreet();
		//error_log(json_encode($street));
		$this->_helper->debug('ShipAddress',$shipAddress->debug());
		$destinationCityName = isset($city)? $city : $shipAddress->getCity (); // load city
		$parameters['destination_city_name'] = strtoupper ( $destinationCityName ); // load city
		$parameters['consignee_address'] = $street[0]; // get customer street address
		if($paymentMethod != 'cashondelivery') {
		$parameters['grant_total'] = 0; // Cod Amount
		}else {
			
			$total = $order->getGrandTotal();
			$rate = $priceCurrencyFactory->create()->load($currencyCodeTo)->getAnyRate($currencyCodeFrom);
			$total = $total * $rate;
			$parameters['grant_total'] = $order->getGrandTotal(); // Cod Amount 
		}
		$Qty = $order->getData ( 'total_qty_ordered' ); // prodcut Qty
		$parameters['qty'] = round ( $Qty );
		list($parameters['sku'],$parameters['weight']) =  $this->_processWeight($order);
		$paymentMethod = $order->getPayment()->getMethodInstance()->getCode();
		$this->_helper->debug('Parameters',$parameters);
		$this->_helper->debug('Payment Method',$paymentMethod);
		$trackingNumber = FALSE;
		
		
		/*if($paymentMethod != 'cashondelivery') {
			if($this->_helper->isNonCodEnabled()) {
				$trackingNumber = $this->_apiRequest->trackNonCodOrder($parameters);
			}else {
				$this->_helper->debug('NON COD is not enabled from configurations');
				throw new \Exception ( 'NON COD is not enabled from configurations' );
			}
		}else {*/
			$trackingNumber = $this->_apiRequest->trackCodOrder($parameters);
		
		if (!$trackingNumber || is_array($trackingNumber)) {
			if(is_array($trackingNumber)){
				throw new \Exception ( $trackingNumber['message'] );	
			}
			throw new \Exception ( $trackingNumber );
		} else {
			// create shipment if configuration is set to YES
			// if(Mage::helper ( 'sherpa' )->getConfigData ( 'sherpa_settings/shipment' )) {
			$this->_addTrackingNumber ( $order, $trackingNumber );
			// }
		}
	}

	protected function _processWeight($order) {
		$weight = 0;
		$sku = array();
		// Product Sku
		foreach ( $order->getAllItems () as $item ) {
			/* @var $item Mage_Sales_Model_Quote_Item */
			if ($item->getProduct ()->isVirtual () || $item->getParentItem ()) {
				continue;
			}
			$sku[] = $item->getSku();
			$weight += $item->getRowWeight() ;
		}
		//round weight to nearest digit
		if($weight < 0.5) {
			$weight = 0.5;
		}else {
			$weight = round($weight, 1);
		}
		$sku = implode(",", $sku);
		return [$sku,$weight];
	}

	/**
	 *
	 * @param unknown $observer
	 * @throws Exception
	 */
	public function tcsTrackingNumberInvoice($observer) {
		// @todo add code here if needed
	}

	/**
	 * Prepares tracking data form tracking number.
	 *
	 * @param $trackingNumber
	 *
	 * @return \Magento\Sales\Model\Order\Shipment\Track
	 */
	protected function setTrackingData($trackingNumber)
	{
		$track = $this->trackingFactory->create();
		$track->setTrackNumber($trackingNumber);
		//Carrier code can not be null/empty. Default carrier code is used
		$track->setCarrierCode('custom');//Put your carrier code here
		$track->setTitle('');//add your title here
		$trackInfo[] = $track;

		return $trackInfo;
	}

	/**
	 * Create shipment items required to create shipment.
	 *
	 * @param array                      $items
	 * @param \Magento\Sales\Model\Order $order
	 *
	 * @return array
	 */
	protected function createShipmentItems(array $items, $order)
	{
		$shipmentItem = [];
		foreach ($order->getAllItems() as $orderItem) {
			if (array_key_exists($orderItem->getId(), $items)) {
				$shipmentItem[] = $this->orderConverter
				->itemToShipmentItem($orderItem)
				->setQty($items[$orderItem->getId()]);
			}
		}

		return $shipmentItem;
	}

	/**
	 *
	 * @param unknown $_order
	 * @param unknown $tracking_no
	 */
	protected function _addTrackingNumber($_order, $tracking_no) {
		if ($_order->canShip()) {
			$this->_helper->debug('creating order shipment');
			$items = [];

			$shipment = $this->orderModel->toShipment($_order);
			foreach ($_order->getAllItems() AS $orderItem) {
				if (!$orderItem->getQtyToShip() || $orderItem->getIsVirtual()) {
		            continue;
		        }
		        $qtyShipped = $orderItem->getQtyToShip();
		 
		        $shipmentItem = $this->orderModel->itemToShipmentItem($orderItem)->setQty($qtyShipped);
		 
		        $shipment->addItem($shipmentItem);
			}
			
			//$shipment->getExtensionAttributes()->setSourceCode('default');  
			//$shipment = $this->_shipmentFactory->create($_order, $items);
			$shipment->register();
    		$shipment->getOrder()->setIsInProcess(true);

			$data = [
                        ShipmentTrackInterface::ENTITY_ID => null,
                        ShipmentTrackInterface::ORDER_ID => $shipment->getOrderId(),
                        ShipmentTrackInterface::PARENT_ID => $shipment->getId(),
                        ShipmentTrackInterface::TRACK_NUMBER => $tracking_no,
                        ShipmentTrackInterface::DESCRIPTION => 'TCS Shipment',
                        ShipmentTrackInterface::TITLE => 'TCS',
                        ShipmentTrackInterface::CARRIER_CODE => 'aatcs',
                    ];
			$track = $this->_trackFactory->create()->addData($data);
			$shipment->addTrack($track)->save();

			$shipment->save();
        	$shipment->getOrder()->save();

			//$this->_shipmentRepository->save($shipment);

      // $_order->setState(\Magento\Sales\Model\Order::STATE_PROCESSING, true);
      // $_order->setStatus(\Magento\Sales\Model\Order::STATE_PROCESSING);
      // //$_order->addStatusToHistory($_order->getStatus(), 'Order processed successfully with reference');
      // $_order->save();


			/* Notify the customer*/
			$this->_shipmentNotifier->notify($shipment);

			// $shipment->save();

		} else {
			$this->_helper->debug('in else check can ship');
		}
	}
}
