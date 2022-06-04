<?php

namespace Amasty\InstagramFeed\Block\Adminhtml\Form\Post;

use Amasty\InstagramFeed\Api\Data\PostInterface;
use Amasty\InstagramFeed\Api\PostRepositoryInterface;
use Amasty\InstagramFeed\Model\Config\Source\MaxWidth;
use Amasty\InstagramFeed\Model\Instagram\Client;
use Magento\Backend\Block\Template;

class Single extends Template
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    public function __construct(
        PostRepositoryInterface $postRepository,
        Client $client,
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->client = $client;
        $this->postRepository = $postRepository;
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        return $this->getCustomHtml();
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCustomHtml()
    {
        $result = '';
        if ($postId = $this->getRequest()->getParam(PostInterface::POST_ID)) {
            $post = $this->postRepository->getById($postId);
            $result = $this->client->loadSinglePostHtml(
                $post->getPermalink(),
                MaxWidth::SMALL,
                true
            );
        }

        return $result;
    }
}
