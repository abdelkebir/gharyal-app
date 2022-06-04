<?php

declare(strict_types=1);

namespace Amasty\InstagramFeed\Model\Sorting;

use Amasty\InstagramFeed\Api\Data\PostInterface;
use Amasty\InstagramFeed\Model\Config\Source\Sorting;

class GetSortingById
{
    /**
     * @param int $sort
     * @return string
     */
    public function execute(int $sort): string
    {
        switch ($sort) {
            case Sorting::LIKED:
                $field = PostInterface::LIKE_COUNT;
                break;
            case Sorting::COMMENTED:
                $field = PostInterface::COMMENTS_COUNT;
                break;
            case Sorting::RANDOM:
                $field = 'RAND()';
                break;
            case Sorting::NEWEST:
            default:
                $field = PostInterface::TIMESTAMP;
                break;
        }

        return $field;
    }
}
