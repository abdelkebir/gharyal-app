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

namespace Aalogics\Tcs\Observer\Sales;

use Magento\Framework\Event\ObserverInterface;
// use Aalogics\Sms\Helper\Data as Helper;
// use \Aalogics\Sms\Model\GatewayFactory;

class OrderAfter implements ObserverInterface
{
    /**
     * @var \Pmclain\Twilio\Helper\Data
     */
    // protected $_helper;


    // protected $_gateWayFactory;
    // public function __construct(
    //     Helper $helper,
    // 	\Aalogics\Sms\Model\GatewayFactory $gateWayFactory	
    // ) {
    // 	$this->_gateWayFactory = $gateWayFactory;
    //     $this->_helper = $helper;
    // }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return \Magento\Framework\Event\Observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
  //   	$this->_helper->debug('execute observer sales order after');
  //   	if($this->_helper->isEnabled() 
  //   		&& $this->_helper->getAdminField('sms_code_verfication')
		// 	&& $gateWay = $this->_helper->getSmsGateway()
		// ) {
  //   		$this->_helper->debug('Gateway',$gateWay);
  //   		$gateWayObj = $this->_gateWayFactory->create($gateWay);
  //   		$order = $observer->getOrder();
	 //        if ($order->getBillingAddress()->getTelephone()) {
	 //            $gateWayObj->sendOrderSms($this->_smsDetails($order));
	 //        }
  //   	}
        return $observer;
    }
    
    // protected function _smsDetails($order) {
    // 	$randomCode = rand ( 00000, 99999 );
    // 	$this->_helper->debug('observer randomCode', $randomCode);
    		
    // 	$orderId = $order->getId ();
    // 	$this->_helper->debug('orderId', $orderId);
    // 	$billingAddress = $order->getBillingAddress ()->getData ();
    		
    // 	//if verification is needed
    // 	if ($this->_helper->getAdminField('sms_code_verfication')) {
    // 		$order->setData ( "sms_success_code", $randomCode );
    // 		$order->save ();
    // 	}
    // 	/* END Updating Order Table with verification Code */
    		
    		
    // 	$storeName = $this->_helper->getStoreName();
    // 	$phone = $billingAddress ['telephone'];
    		
    // 	// Creating message for customer
    // 	$replaceKeywords = [
    // 	'{first name}',
    // 	'{last name}',
    // 	'{order_increment_no}',
    // 	'{store_name}',
    // 	'{verification_code}'
    // 			];
    // 	$replaceValues = [
    // 	$billingAddress ['firstname'],
    // 	$billingAddress ['lastname'],
    // 	$order->getIncrementId (),
    // 	$storeName,
    // 	$randomCode
    // 	];
    // 	$messageToSend = str_replace ( $replaceKeywords, $replaceValues, $this->_helper->getAdminField('sms_code_template') );
    		
    // 	$smsData = [
    // 	'firstname' => $billingAddress ['firstname'],
    // 	'lastname' => $billingAddress ['lastname'],
    // 	'phone' => $phone,
    // 	'smsMessage' => $messageToSend,
    // 	'orderIncId' => $order->getIncrementId (),
    // 	'randomCode' => $randomCode,
    // 	'storeName' => $storeName
    // 	];
    // 	return $smsData;
    // }
}
