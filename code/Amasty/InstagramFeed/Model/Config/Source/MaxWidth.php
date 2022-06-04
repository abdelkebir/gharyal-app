<?php

namespace Amasty\InstagramFeed\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class MaxWidth implements OptionSourceInterface, \Magento\Framework\Option\ArrayInterface
{
    public const SMALL = 320;

    public const MEDIUM = 480;

    public const LARGE = 640;

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::SMALL, 'label' => __('320')],
            ['value' => self::MEDIUM, 'label' => __('480')],
            ['value' => self::LARGE, 'label' => __('640')]
        ];
    }
}
