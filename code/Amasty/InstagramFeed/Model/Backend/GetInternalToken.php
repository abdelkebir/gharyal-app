<?php

declare(strict_types=1);

namespace Amasty\InstagramFeed\Model\Backend;

use Amasty\InstagramFeed\Model\ConfigProvider;
use Magento\Backend\Model\Session as BackendSession;

class GetInternalToken
{
    public const INTERNAL_TOKEN_CODE = 'amasty_instagramfeed_internal_token';

    /**
     * @var ConfigProvider
     */
    private $configProvider;

    /**
     * @var BackendSession
     */
    private $backendSession;

    public function __construct(ConfigProvider $configProvider, BackendSession $backendSession)
    {
        $this->configProvider = $configProvider;
        $this->backendSession = $backendSession;
    }

    public function execute()
    {
        $internalToken = $this->backendSession->getData(self::INTERNAL_TOKEN_CODE);
        if ($internalToken === null) {
            $internalToken = $this->configProvider->getInternalToken(true);
            $this->backendSession->setData(self::INTERNAL_TOKEN_CODE, $internalToken);
        }

        return $internalToken;
    }
}
