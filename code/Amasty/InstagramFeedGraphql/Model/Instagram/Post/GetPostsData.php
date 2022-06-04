<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Amasty_InstagramFeedGraphql
*/


declare(strict_types=1);

namespace Amasty\InstagramFeedGraphql\Model\Instagram\Post;

use Amasty\InstagramFeed\Model\Repository\PostRepository;
use Amasty\InstagramFeed\Model\Sorting\GetSortingById;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;

class GetPostsData
{
    /**
     * @var GetSortingById
     */
    private $getSortingById;

    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * @var AddProductData
     */
    private $addProductData;

    public function __construct(
        GetSortingById $getSortingById,
        PostRepository $postRepository,
        AddProductData $addProductData
    ) {
        $this->getSortingById = $getSortingById;
        $this->postRepository = $postRepository;
        $this->addProductData = $addProductData;
    }

    /**
     * @param array $params
     * @param int $storeId
     * @return array
     * @throws GraphQlNoSuchEntityException
     */
    public function execute(int $sortId, int $limit, int $page, int $storeId): array
    {
        $sortField = $this->getSortingById->execute($sortId);
        $posts = $this->postRepository->getPosts($storeId, $sortField, $limit, $page);

        return $this->getDataFromPosts($posts, $storeId);
    }

    private function getDataFromPosts(array $posts, int $storeId): array
    {
        $postsData = [];

        foreach ($posts as $post) {
            $data = $this->addProductData->execute($post->getData(), $storeId);

            $postsData[] = $data;
        }

        return $postsData;
    }
}
