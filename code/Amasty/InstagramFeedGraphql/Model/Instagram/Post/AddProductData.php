<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Amasty_InstagramFeedGraphql
*/


declare(strict_types=1);

namespace Amasty\InstagramFeedGraphql\Model\Instagram\Post;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;

class AddProductData
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     * @param array $postData
     * @param int $storeId
     * @return array
     * @throws GraphQlNoSuchEntityException
     */
    public function execute(array $postData, int $storeId): array
    {
        if (isset($postData['product_id']) && $postData['product_id']) {
            try {
                $product = $this->productRepository->getById($postData['product_id'], false, $storeId);
            } catch (NoSuchEntityException $e) {
                throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
            }

            $postData['product_data'] = [
                'product_name' => $product->getName(),
                'product_url' => $product->getProductUrl()
            ];
        }

        return $postData;
    }
}
