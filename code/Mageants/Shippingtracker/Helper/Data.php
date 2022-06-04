<?php
/**
  * @category   Mageants Shippingtracker
  * @package    Mageants_Shippingtracker
  * @copyright  Copyright (c) 2017 Mageants
  * @author     Mageants Team <support@Mageants.com>
  */

namespace Mageants\Shippingtracker\Helper;

use Magento\Sales\Model\ResourceModel\Order\Shipment\Track\CollectionFactory as TrackCollectionFactory;
use Magento\Sales\Api\Data\ShipmentTrackInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Mageants\Shippingtracker\Block\Shippingtracker $shippingtracker,
        TrackCollectionFactory $collectionFactory
    ) {
        $this->storeManager = $storeManager;
        $this->shippingtracker = $shippingtracker;
        $this->trackingCollection = $collectionFactory->create();
        parent::__construct($context);
    }
    /**
     * Get config values
     *
     * @param null|string|bool|int|Store $store
     * @return bool
     */
    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue($config_path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getDisabledCarrier()
    {
        $selectedCarrier = explode(",", $this->getConfigValue('shippingtracker_section/shippingtracker_general/shippingtracker_carrier_disable'));
        return $selectedCarrier;
    }

    public function getDisabledCarrierMessage()
    {
        $carrierMessage = $this->getConfigValue('shippingtracker_section/shippingtracker_general/disabled_message');
        return $carrierMessage;
    }

    public function getConfigValue($config_path)
    {
        $storeId = $this->storeManager->getStore()->getId();
        return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getCustomCarrierUrlByCode($trackingNumber)
    {
        $carrierCode = '';
        $this->trackingCollection->addFieldToFilter(ShipmentTrackInterface::TRACK_NUMBER, $trackingNumber);
        $tracking = $this->trackingCollection;
        foreach ($tracking as $trackingData) {
            $trackingDetails = $this->shippingtracker->getOrderdetails($trackingData->getOrderId());
        }
        if (isset($trackingDetails)) {
            $trackCollect = $trackingDetails->getTracksCollection();
            foreach ($trackCollect as $track) {
                $carrierCode = $track->getCarrierCode();
            }
        }
        $carrierUrl = $this->getCustomCarrierURL($carrierCode, $trackingNumber);
        return $carrierUrl;
    }

    public function getCustomCarrierURL($carrierCode, $trackingNumber)
    {
        $j = 15;
        $carrierUrl = '';
        for ($i=1; $i <= $j; $i++) {
            $enable = 'shippingtracker_section/custom_shippingtracker_'.$i.'/custom_shippingtracker_enable_'.$i;
            $Url = 'shippingtracker_section/custom_shippingtracker_'.$i.'/custom_shippingtracker_url_'.$i;
            $carrierEnable = $this->getConfigValue($enable);
            $carrier = 'customcarrier'.$i;
            if ($carrierEnable) {
                if ($carrier == $carrierCode) {
                    $carrierUrl = $this->getConfigValue($Url);
                    $tracking_code  = '{{tracking_code}}';
                    if (strpos($carrierUrl, $tracking_code) !== false) {
                        $carrierUrl = str_replace($tracking_code, $trackingNumber, $carrierUrl);
                    }
                }
            }
        }
        return $carrierUrl;
    }

    public function getCustomCarrierTitle()
    {
        $j = 15;
        $customCarrier = [];
        for ($i=1; $i <= $j; $i++) {
            $enable = 'shippingtracker_section/custom_shippingtracker_'.$i.'/custom_shippingtracker_enable_'.$i;
            $Title = 'shippingtracker_section/custom_shippingtracker_'.$i.'/custom_shippingtracker_title_'.$i;
            $carrierEnable = $this->getConfigValue($enable);
            $carrierTitle = $this->getConfigValue($Title);
            if ($carrierEnable) {
                if ($carrierTitle) {
                    $customCarrier['customcarrier'.$i] = $carrierTitle;
                }
            }
        }
        return $customCarrier;
    }
}
