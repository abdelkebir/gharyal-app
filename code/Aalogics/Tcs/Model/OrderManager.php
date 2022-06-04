<?php
namespace Aalogics\Tcs\Model;

use Magento\Framework\Event\ObserverInterface;
use \Aalogics\Tcs\Helper\Data;
/**
 * @author     Aalogics
 * @package    Aalogics_Tcs
 * @copyright  Copyright (c) Aalogics
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class OrderManager{

	/**
	 * @var EventManager
	 */
	private $eventManager;
	
	protected $_helper;
	
	
	public function __construct(
			\Magento\Framework\Event\Manager $eventManager,
			\Aalogics\Tcs\Helper\Data $tcsHelper

	){
		
		$this->_helper = $tcsHelper;
		$this->eventManager = $eventManager;
	}
	

    /**
     * Invoice and ship all selected orders
     *
     * @param        $orderIds
     * @param string $newOrderStatus
     * @param bool   $sendInvoiceEmail
     * @param bool   $sendShippingEmail
     * @param array  $allTrackingNrs
     * @param array  $allCarrierCodes
     *
     * @return array
     */
    public function invoiceAndShipAll(
        $orders, $newOrderStatus = '', $sendInvoiceEmail = false, $sendShippingEmail = false, $allTrackingNrs = array(), $allCarrierCodes = array(), $costcenter = NULL
    ) {
    	$this->_helper->debug('invoiceAndShipAll Start');
        $successes = array();
        $errors = array();

        if (is_array($orders) && !empty($orders)) {
            if (count($orders) > 0) {
                foreach ($orders as $order) {
                    $orderIncrementId = $order->getIncrementId();
                    $trackingNrs = $this->getTrackingNrsForOrder($order->getId(), $allTrackingNrs);
                    $carrierCode = $this->getCarrierForOrder($order->getId(), $allCarrierCodes);
                    try {
                    	if($order->canInvoice()) {
// 	                        $this->invoice($order, false, $sendInvoiceEmail);
// 	                        $this->eventManager->dispatch('aatcs_tcs_invoice',['order'=>$order]);
                    	}
						if($order->canShip()) {
							$this->_helper->debug('invoiceAndShipAll Ship Start');
							$this->eventManager->dispatch('aatcs_tcs_ship',['order'=>$order, 'cost_center' => $costcenter]);
						}
						$successes[] = $orderIncrementId;
                    } catch (\Exception $e) {
                        $errors[] = $orderIncrementId . ": " . $e->getMessage();
                        $this->_helper->debug('Exception',$e->getMessage());
                    }
                }
            }
        }
        return array('errors' => $errors, 'successes' => $successes);
    }

    /**
     * Invoice and ship all selected orders
     *
     * @param        $orderIds
     * @param string $newOrderStatus
     * @param bool   $sendInvoiceEmail
     * @param bool   $sendShippingEmail
     * @param array  $allTrackingNrs
     * @param array  $allCarrierCodes
     *
     * @return array
     */
    public function shipAll(
            $orders, $newOrderStatus = '', $sendInvoiceEmail = false, $sendShippingEmail = false, $allTrackingNrs = array(), $allCarrierCodes = array(), $costcenter = NULL, $city = NULL
    ) {
        $this->_helper->debug('shipAll Start');
        $successes = array();
        $errors = array();
    
        if (is_array($orders) && !empty($orders)) {
            if (count($orders) > 0) {
                foreach ($orders as $order) {
    
                    $orderIncrementId = $order->getIncrementId();
    
                    // $trackingNrs = $this->getTrackingNrsForOrder($order->getId(), $allTrackingNrs);
                    // $carrierCode = $this->getCarrierForOrder($order->getId(), $allCarrierCodes);
    
                    try {
    
                        $orderCanShip = $order->canShip();
    
                        /******** Create Order Shipment *********/
                        if($orderCanShip) {
                            $this->_helper->debug('Ship Start');
                            $this->eventManager->dispatch('aatcs_tcs_ship',['order'=>$order,'city'=>$city, 'cost_center' => $costcenter]);
                        }
    
                        $successes[] = $orderIncrementId. ": Shipped";
    
                    } catch (\Exception $e) {
                        $errors[] = $orderIncrementId . ": " . $e->getMessage();
                        $this->_helper->debug('Exception: ',$e->getMessage());
                    }
                }
            }
        }
        return array('errors' => $errors, 'successes' => $successes);
    }


    /**
     * @param $orderId
     * @param $carrierCodes
     *
     * @return mixed
     */
    public function getCarrierForOrder($orderId, $carrierCodes)
    {
        if (isset($carrierCodes[$orderId])) {
            return $carrierCodes[$orderId];
        } else {
            return $this->_helper->getAdminField('tcs_cod/preselectedcarrier');
        }
    }

    /**
     * @param $orderId
     * @param $trackingNumbers
     *
     * @return array|bool
     */
    public function getTrackingNrsForOrder($orderId, $trackingNumbers)
    {
        if (!empty($trackingNumbers[$orderId])) {
            return explode(';', $trackingNumbers[$orderId]);
        }
        return false;
    }


}
