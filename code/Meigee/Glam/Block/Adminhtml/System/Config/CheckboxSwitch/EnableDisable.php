<?php
namespace Meigee\Glam\Block\Adminhtml\System\Config\CheckboxSwitch;

class EnableDisable extends \Meigee\Glam\Block\Adminhtml\System\Config\CheckboxSwitch
{
    function getOnLabel()
    {
        return __('Enable');
    }
    function getOffLabel()
    {
        return __('Disable');
    }
}
