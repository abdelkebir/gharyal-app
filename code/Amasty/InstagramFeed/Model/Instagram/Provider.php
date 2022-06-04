<?php

declare(strict_types=1);

namespace Amasty\InstagramFeed\Model\Instagram;

use Amasty\InstagramFeed\Api\Data\PostInterface;
use Amasty\InstagramFeed\Api\PostRepositoryInterface;
use Amasty\InstagramFeed\Model\Config\Source\Sorting;
use Amasty\InstagramFeed\Model\ConfigProvider;
use Amasty\InstagramFeed\Model\Instagram\AccessToken\IsAccessTokenDifferent;
use Amasty\InstagramFeed\Model\Sorting\GetSortingById;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;

class Provider
{
    public const POST_COUNT = 20;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;
    /**
     * @var Management
     */
    private $management;

    /**
     * @var ConfigProvider
     */
    private $configProvider;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var IsAccessTokenDifferent
     */
    private $isAccessTokenDifferent;

    /**
     * @var GetSortingById
     */
    private $getSortingById;

    public function __construct(
        PostRepositoryInterface $postRepository,
        Management $management,
        ConfigProvider $configProvider,
        StoreManagerInterface $storeManager,
        IsAccessTokenDifferent $isAccessTokenDifferent,
        GetSortingById $getSortingById
    ) {
        $this->postRepository = $postRepository;
        $this->management = $management;
        $this->configProvider = $configProvider;
        $this->storeManager = $storeManager;
        $this->isAccessTokenDifferent = $isAccessTokenDifferent;
        $this->getSortingById = $getSortingById;
    }

    /**
     * @param $params
     * @return array|PostInterface[]
     */
    public function getPosts($params, ?int $storeId = null)
    {
        $sort = $params['sort'] ?? Sorting::NEWEST;
        $count = $params['count'] ?? self::POST_COUNT;

        if ($storeId === null) {
            try {
                $storeId = $this->getStoreId();
            } catch (NoSuchEntityException $e) {
                $storeId = Store::DEFAULT_STORE_ID;
            }
        }

        if (!$this->postRepository->isPostsExist($storeId)) {
            $this->management->update($storeId);
        }

        return $this->getFromRepository($storeId, (int)$sort, (int)$count);
    }

    /**
     * @param int $storeId
     * @param int $sort
     * @param int $count
     * @return array|PostInterface[]
     */
    private function getFromRepository(int $storeId, int $sort, int $count)
    {
        $sortField = $this->getSortingById->execute($sort);

        return $this->postRepository->getPosts($storeId, $sortField, $count);
    }

    /**
     * @return int
     * @throws NoSuchEntityException
     */
    private function getStoreId()
    {
        return $this->isAccessTokenDifferent->execute()
            ? (int) $this->storeManager->getStore()->getId()
            : Store::DEFAULT_STORE_ID;
    }
}
