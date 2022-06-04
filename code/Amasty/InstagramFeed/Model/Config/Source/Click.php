<?php

namespace Amasty\InstagramFeed\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Click implements OptionSourceInterface, \Magento\Framework\Option\ArrayInterface
{
    public const LINK = 0;

    public const POPUP = 1;

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::LINK, 'label' => __('Open Post in Instagram')],
            ['value' => self::POPUP, 'label' => __('Open Post in Pop-up')]
        ];
    }
}
