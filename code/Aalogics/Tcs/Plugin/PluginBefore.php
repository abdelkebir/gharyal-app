<?php

namespace Aalogics\Tcs\Plugin;

class PluginBefore
{
    protected $_traxHelper;

    public function __construct(\Aalogics\Tcs\Helper\Data $traxHelper)
    {
        $this->_traxHelper = $traxHelper;
    }

    public function beforePushButtons(
        \Magento\Backend\Block\Widget\Button\Toolbar\Interceptor $subject,
        \Magento\Framework\View\Element\AbstractBlock $context,
        \Magento\Backend\Block\Widget\Button\ButtonList $buttonList
    ) {

        $this->_request = $context->getRequest();

        if ($this->_traxHelper->isEnabled() && $this->_request->getFullActionName() == 'sales_order_view') {
            $buttonList->add(
                'send_tcs_ship',
                [
                    'label'   => __('Tcs Ship'),
                    'onclick' => 'jQuery("#shipModal").modal("openModal")',
                ]
            );
        }

    }

}
