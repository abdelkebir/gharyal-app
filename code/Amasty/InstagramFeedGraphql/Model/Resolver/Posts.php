<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Amasty_InstagramFeedGraphql
*/


declare(strict_types=1);

namespace Amasty\InstagramFeedGraphql\Model\Resolver;

use Amasty\InstagramFeed\Model\Config\Source\Sorting;
use Amasty\InstagramFeed\Model\Instagram\AccessToken\IsAccessTokenDifferent;
use Amasty\InstagramFeedGraphql\Model\Instagram\Post\GetPostsData;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Store\Model\Store;

class Posts implements ResolverInterface
{
    /**
     * @var GetPostsData
     */
    private $getPostsData;

    /**
     * @var IsAccessTokenDifferent
     */
    private $isAccessTokenDifferent;

    public function __construct(
        GetPostsData $getPostsData,
        IsAccessTokenDifferent $isAccessTokenDifferent
    ) {
        $this->getPostsData = $getPostsData;
        $this->isAccessTokenDifferent = $isAccessTokenDifferent;
    }

    /**
     * @param Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array
     * @throws \Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ): array {
        $currentStoreId = (int)$context->getExtensionAttributes()->getStore()->getId();
        $storeId = $this->isAccessTokenDifferent->execute($currentStoreId)
            ? $currentStoreId
            : Store::DEFAULT_STORE_ID;
        $sortId = $args['sortField'] ?? Sorting::NEWEST;

        return $this->getPostsData->execute($sortId, $args['limit'], $args['page'], $storeId);
    }
}
