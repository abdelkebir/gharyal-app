<?php

namespace Amasty\InstagramFeed\Controller\Post;

use Amasty\InstagramFeed\Block\Widget\Feed\Single as SinglePost;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\LayoutInterface;

class Single extends Action
{
    /**
     * @var LayoutInterface
     */
    private $layout;

    public function __construct(
        LayoutInterface $layout,
        Context $context
    ) {
        parent::__construct($context);
        $this->layout = $layout;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface|null
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Raw $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $html = '';

        if ($postUrl = $this->getRequest()->getParam('post_url')) {
            /** @var SinglePost $singlePost */
            $singlePost = $this->layout->createBlock(SinglePost::class);
            $singlePost->setPostUrl($postUrl);
            $html = $singlePost->toHtml();
        }
        $result->setContents($html);

        return $result;
    }
}
