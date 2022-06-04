<?php

declare(strict_types=1);

namespace Amasty\InstagramFeed\Model\Instagram;

use Amasty\InstagramFeed\Model\ConfigProvider;
use Amasty\InstagramFeed\Model\ResourceModel\Post as PostResource;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Flag;
use Magento\Framework\FlagFactory;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

class Management
{
    public const POSTS_TO_SAVE = 180;

    public const FLAG_CODE = 'am_last_instagram_post_update_%d';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var PostResource
     */
    private $postResource;

    /**
     * @var ConfigProvider
     */
    private $configProvider;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var Flag|null
     */
    private $flag;

    /**
     * @var DateTime
     */
    private $dateTime;

    /**
     * @var FlagFactory
     */
    private $flagFactory;

    public function __construct(
        ConfigProvider $configProvider,
        Client $client,
        PostResource $postResource,
        StoreManagerInterface $storeManager,
        FlagFactory $flagFactory,
        DateTime $dateTime,
        LoggerInterface $logger
    ) {
        $this->client = $client;
        $this->logger = $logger;
        $this->postResource = $postResource;
        $this->configProvider = $configProvider;
        $this->storeManager = $storeManager;
        $this->dateTime = $dateTime;
        $this->flagFactory = $flagFactory;
    }

    public function updateByCron()
    {
        $this->update();
    }

    public function update(?int $storeId = null): void
    {
        try {
            if ($this->isUpdateAvailable($storeId)) {
                $postData = $storeId !== null ? $this->getPosts($storeId) : $this->getAllPosts();
                $this->postResource->replaceData($postData, $storeId);
                $this->updateFlagData($storeId);
            }
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
        }
    }

    /**
     * @param int $storeId
     * @param array $oldPosts
     * @return array
     * @throws LocalizedException
     */
    public function getPosts($storeId, $oldPosts = [])
    {
        return array_merge(
            $this->client->loadPosts(self::POSTS_TO_SAVE, $storeId),
            $oldPosts
        );
    }

    /**
     * @return array
     * @throws LocalizedException
     */
    public function getAllPosts()
    {
        $defaultAccessToken = $this->configProvider->getAccessToken(Store::DEFAULT_STORE_ID);
        $postData = $this->getPosts(Store::DEFAULT_STORE_ID);

        foreach ($this->storeManager->getStores() as $store) {
            $storeId = (int) $store->getId();
            if ($defaultAccessToken != $this->configProvider->getAccessToken($storeId)) {
                $postData = $this->getPosts($storeId, $postData);
            }
        }

        return $postData;
    }

    public function isUpdateAvailable(?int $storeId = null): bool
    {
        return ($this->getCurrentTime() - (int) $this->getFlag($storeId)->getFlagData()) / 3600 > 1;
    }

    private function updateFlagData(?int $storeId)
    {
        $this->getFlag($storeId)->setFlagData($this->getCurrentTime())->save();
    }

    /**
     * @return int
     */
    private function getCurrentTime(): int
    {
        return $this->dateTime->timestamp();
    }

    private function getFlag(?int $storeId): Flag
    {
        if ($this->flag === null) {
            try {
                $flag = $this->flagFactory->create(['data' => [
                    'flag_code' => sprintf(self::FLAG_CODE, $storeId)
                ]]);
                $this->flag = $flag->loadSelf();
            } catch (LocalizedException $e) {
                $this->logger->error($e->getMessage());
            }
        }

        return $this->flag;
    }
}
