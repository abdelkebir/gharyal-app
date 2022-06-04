<?php

/**
 * Copyright © Aalogics Ltd. All rights reserved.
 *
 * @package    Aalogics_Trax
 * @copyright  Copyright © Aalogics Ltd (http://www.aalogics.com)
 */

namespace Aalogics\Tcs\Block\Adminhtml\Order;

class View extends \Magento\Sales\Block\Adminhtml\Order\View
{

    protected $_cityOption;
    protected $_context;
    protected $_traxHelper;
    protected $serialize;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Sales\Model\Config $salesConfig,
        \Magento\Sales\Helper\Reorder $reorderHelper,
        \Aalogics\Tcs\Model\Source\CityOptions $cityOption,
        \Aalogics\Tcs\Helper\Data $traxHelper,
        \Magento\Framework\Serialize\Serializer\Json $serialize,
        array $data = []
    ) {
        $this->_cityOption = $cityOption;
        $this->serialize = $serialize;
        $this->_context = $context;
        $this->_traxHelper = $traxHelper;
        parent::__construct($context, $registry, $salesConfig, $reorderHelper, $data);
    }

    public function _getCitiesOption(){
        $cities = $this->_cityOption->toOptionArray();
        
      
        return $cities;
    }


    public function _getCostCenters()
    {
        $costcenters_data = $this->_traxHelper->getAdminField('tcs_cod/costcenter_code');

        $costcenters = $this->serialize->unserialize($costcenters_data);

        $centers = array ();
        foreach ( $costcenters as $i => $costcenter ) {
            // if (! $costcenter ['delete']) {
                $centers [$i] ['value'] = $costcenter ['code'];
                $centers [$i] ['label'] = $costcenter ['name'];
            // }
        }

        return $centers;
    }

    /**
     * Trax Ship URL getter
     *
     * @return string
     */
    public function getTRAXUrl()
    {
        return $this->getUrl('aatcs/*/ship');
    }

}