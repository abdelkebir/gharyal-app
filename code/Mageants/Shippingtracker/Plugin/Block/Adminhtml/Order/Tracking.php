<?php
 
namespace Mageants\Shippingtracker\Plugin\Block\Adminhtml\Order;

class Tracking
{
    public function __construct(
        \Mageants\Shippingtracker\Helper\Data $shippingTrackerHelper
    ) {
        $this->shippingTrackerHelper = $shippingTrackerHelper;
    }

    
    public function afterGetCarriers(\Magento\Shipping\Block\Adminhtml\Order\Tracking $subject, $result)
    {
        $customCarrier = $this->shippingTrackerHelper->getCustomCarrierTitle();
        if (!empty($customCarrier)) {
            foreach ($customCarrier as $code => $carrierTitle) {
                $result[$code] = $carrierTitle;
            }
        }
        return $result;
    }
}
