<?php
namespace Meigee\Glam\Block\Adminhtml\System\Config\CheckboxSwitch;

class OnOff extends \Meigee\Glam\Block\Adminhtml\System\Config\CheckboxSwitch
{
    function getOnLabel()
    {
        return __('On');
    }
    function getOffLabel()
    {
        return __('Off');
    }
}
