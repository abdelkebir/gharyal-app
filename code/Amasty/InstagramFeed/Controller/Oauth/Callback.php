<?php

namespace Amasty\InstagramFeed\Controller\Oauth;

use Amasty\InstagramFeed\Model\Instagram\Client;
use Amasty\InstagramFeed\Block\Adminhtml\System\Config\Oauth\Result;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\LayoutInterface;
use Magento\Store\Model\Store;
use Psr\Log\LoggerInterface;

/**
 * Class Callback
 *
 * Class for getting messages from oauth requests
 */
class Callback extends Action
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var LayoutInterface
     */
    private $layout;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        Client $client,
        LayoutInterface $layout,
        LoggerInterface $logger,
        Context $context
    ) {
        parent::__construct($context);
        $this->client = $client;
        $this->layout = $layout;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        $success = true;

        $storeId = (int) $this->getRequest()->getParam('store_id', Store::DEFAULT_STORE_ID);
        $message = $this->getRequest()->getParam('message', null);
        if ($message !== null) {
            $success = false;
            $this->logger->debug('Instagram Feed: ' . $message);
        }
        /** @var Raw $resultRaw */
        $resultRaw = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $resultRaw->setHeader(
            'Cache-Control',
            'no-store, no-cache, must-revalidate, max-age=0',
            true
        );

        return $resultRaw->setContents($this->getResultText($success, $message, $storeId));
    }

    /**
     * @param bool $success
     * @param string $message
     * @param int $storeId
     * @return string
     */
    private function getResultText($success, $message, $storeId)
    {
        /** @var Template $resultBlock */
        $resultBlock = $this->layout->createBlock(Result::class, '', [
            'data' => [
                'message' => $message,
                'success' => $success,
                'store_id' => $storeId
            ]
        ]);

        return $resultBlock->toHtml();
    }
}
