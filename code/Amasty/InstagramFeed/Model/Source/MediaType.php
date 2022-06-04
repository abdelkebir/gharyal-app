<?php

declare(strict_types=1);

namespace Amasty\InstagramFeed\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

class MediaType implements OptionSourceInterface
{
    public const IMAGE = 'IMAGE';
    public const CAROUSEL_ALBUM = 'CAROUSEL_ALBUM';
    public const VIDEO = 'VIDEO';
    
    public function toOptionArray(): array
    {
        return [
            ['value' => self::IMAGE, 'label' => __('Image')],
            ['value' => self::CAROUSEL_ALBUM, 'label' => __('Carousel album')]
        ];
    }
}
