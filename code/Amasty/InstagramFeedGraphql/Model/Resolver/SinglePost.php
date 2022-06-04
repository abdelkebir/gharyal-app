<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Amasty_InstagramFeedGraphql
*/


declare(strict_types=1);

namespace Amasty\InstagramFeedGraphql\Model\Resolver;

use Amasty\InstagramFeed\Model\Repository\PostRepository;
use Amasty\InstagramFeedGraphql\Model\Instagram\Post\AddProductData;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class SinglePost implements ResolverInterface
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * @var AddProductData
     */
    private $addProductData;

    public function __construct(
        PostRepository $postRepository,
        AddProductData $addProductData
    ) {
        $this->postRepository = $postRepository;
        $this->addProductData = $addProductData;
    }

    /**
     * @param Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array
     * @throws LocalizedException
     * @throws \Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ): array {
        $post = $this->postRepository->getByPermalink($args['postUrl']);

        if ($postData = $post->getData()) {
            $storeId = (int)$context->getExtensionAttributes()->getStore()->getId();

            return $this->addProductData->execute($postData, $storeId);
        } else {
            throw new LocalizedException(__('Post with this address not found.'));
        }
    }
}
