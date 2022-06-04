<?php

namespace Aalogics\Tcs\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use \Aalogics\Tcs\Logger\Logger;

class Data extends AbstractHelper
{
	const SMS_CONFIRM_STATUS = 'confirm_sms_processing';
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Aalogics\Tcs\Logger\Logger
     */
    protected $_log;
    
    /**
     * Data constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
    	\Aalogics\Tcs\Logger\Logger $logger
    ) {
    	$this->_log = $logger;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    public function getStoreName() {
    	return $this->scopeConfig->getValue(
        'general/store_information/name',
        \Magento\Store\Model\ScopeInterface::SCOPE_STORE
    );
    }
    
    public function getShippingOriginCity() {
    	return $this->scopeConfig->getValue(
    			'shipping/origin/city',
    			\Magento\Store\Model\ScopeInterface::SCOPE_STORE
    	);
    }

    public function isEnabled() {
    	return $this->getAdminField('tcs_cod/enable');
    }
    
    public function isNonCodEnabled() {
    	return $this->getAdminField('tcs_non_cod/enable');
    }
    
    public function getTrackingUrl($tracking) {
    	$externalUrl =  $this->getAdminField('tcs_cod/tracking_url');
    	return $externalUrl . $tracking;
    }
    /**
     *
     */
    public function getAdminField( $key ) {
    	$value = $this->scopeConfig->getValue('aatcs/'.$key, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    	return $value;
    }
    
    public function debug($message, $data = NULL) {
    	if($this->getAdminField('tcs_cod/debug')) {
    		$this->_log->debug($message.print_r($data,TRUE));
    	}
    }

    public function isCitiesEnabled() {
        $value = $this->scopeConfig->getValue('aacities/general/enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $value;
    }
}
