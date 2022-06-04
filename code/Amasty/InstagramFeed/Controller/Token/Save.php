<?php

namespace Amasty\InstagramFeed\Controller\Token;

use Amasty\InstagramFeed\Model\ConfigProvider;
use Amasty\InstagramFeed\Model\Instagram\Client;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\LayoutInterface;
use Magento\Store\Model\Store;

class Save extends Action
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var ConfigProvider
     */
    private $configProvider;

    /**
     * @var LayoutInterface
     */
    private $layout;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    public function __construct(
        Context $context,
        ConfigProvider $configProvider,
        LayoutInterface $layout,
        Client $client,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->layout = $layout;
        $this->configProvider = $configProvider;
        $this->client = $client;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        if (!$this->checkInternalToken()) {
            $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
            return $resultForward->forward('noroute');
        }

        $token = $this->getRequest()->getParam('token');
        $error = '';
        if ($userId = $this->client->getUserIdByToken($token)) {
            $storeId = $this->getRequest()->getParam('store_id', Store::DEFAULT_STORE_ID);

            try {
                $this->configProvider->saveAccessToken($token, $storeId)->saveUserId($userId, $storeId);
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        } else {
            $error = __('We can\'t get user id by token.');
        }

        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);

        $resultData = [
            'success' => empty($error),
            'message' => $error
        ];

        return $resultJson->setData($resultData);
    }

    /**
     * @return bool
     */
    private function checkInternalToken()
    {
        return $this->getRequest()->getParam('internal_token') === $this->configProvider->getInternalToken();
    }
}
