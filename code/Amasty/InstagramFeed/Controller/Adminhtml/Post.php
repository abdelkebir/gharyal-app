<?php

namespace Amasty\InstagramFeed\Controller\Adminhtml;

abstract class Post extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Amasty_InstagramFeed::post';
}
