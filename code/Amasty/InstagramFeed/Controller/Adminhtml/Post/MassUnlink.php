<?php

namespace Amasty\InstagramFeed\Controller\Adminhtml\Post;

use Amasty\InstagramFeed\Api\Data\PostInterface;

class MassUnlink extends AbstractMassAction
{
    /**
     * {@inheritdoc}
     */
    protected function itemAction(PostInterface $post)
    {
        $this->repository->unlink($post);
    }
}
