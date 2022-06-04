<?php
namespace Meigee\Glam\Block\Adminhtml\System\Config\CheckboxSwitchHeader;

class OnOffHeaders extends \Meigee\Glam\Block\Adminhtml\System\Config\CheckboxSwitchHeader
{
    protected $header = true;

    function getOnLabel()
    {
        return __('On');
    }
    function getOffLabel()
    {
        return __('Off');
    }
}
