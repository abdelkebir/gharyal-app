<?php
/**
  * @category   Mageants Shippingtracker
  * @package    Mageants_Shippingtracker
  * @copyright  Copyright (c) 2017 Mageants
  * @author     Mageants Team <support@Mageants.com>
  */

namespace Mageants\Shippingtracker\Model\ShippingCarrier;

use Magento\Framework\Module\Manager as ModuleManager;
use Magento\Customer\Api\Data\GroupInterface;
use Magento\Customer\Api\GroupRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Shipping\Model\Config;

class Methods implements \Magento\Framework\Option\ArrayInterface
{

    /**
     * @var \Magento\Shipping\Model\Config
     */
    public $shippingConfig;

    /**
     * @var \Magento\Shipping\Model\Config
     */
    public $request;

    /**
     * @var \Magento\Shipping\Model\Config
     */
    public $storeManager;

    /**
     * @param \Magento\Shipping\Model\Config $shippingConfig
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\App\RequestInterface $request,
     */
    public function __construct(
        Config $shippingConfig,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Mageants\Shippingtracker\Helper\Data $shippingTrackerHelper
    ) {
        $this->request = $request;
        $this->shippingConfig = $shippingConfig;
        $this->storeManager = $storeManager;
        $this->shippingTrackerHelper = $shippingTrackerHelper;
    }


    /**
     * Return array of customer groups
     *
     * @return array
     */
    public function toOptionArray()
    {
        $prepareCarrier = $this->getCarriers();
        return $prepareCarrier;
    }

    public function getCarriers()
    {
        $carriers = [];
        $i = 1 ;
        $carrierInstances = $this->_getCarriersInstances();
        $carriers[0]['label'] = __('Custom Value');
        $carriers[0]['value'] = 'custom';
        foreach ($carrierInstances as $code => $carrier) {
            if ($carrier->isTrackingAvailable()) {
                $carriers[$i]['label'] = $carrier->getConfigData('title');
                $carriers[$i]['value'] = $code;
            }
            $i++;
        }
        $customCarrier = $this->shippingTrackerHelper->getCustomCarrierTitle();
        if (!empty($customCarrier)) {
            foreach ($customCarrier as $code => $carrier) {
                $carriers[$i]['label'] = $carrier;
                $carriers[$i]['value'] = $code;
                $i++;
            }
        }
        return $carriers;
    }
    
    public function _getCarriersInstances()
    {
        $storeId = $this->request->getParam('store');
        if (!empty($storeId)) {
            $store = $storeId;
        } else {
            $store = 1;
        }
        return $this->shippingConfig->getAllCarriers($store);
    }
}
