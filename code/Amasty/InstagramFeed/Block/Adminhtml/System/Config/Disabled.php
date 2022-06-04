<?php

declare(strict_types=1);

namespace Amasty\InstagramFeed\Block\Adminhtml\System\Config;

use Amasty\InstagramFeed\Model\ConfigProvider;
use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Disabled extends Field
{
    /**
     * @var ConfigProvider
     */
    private $configProvider;

    public function __construct(
        ConfigProvider $configProvider,
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->configProvider = $configProvider;
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $afterHtml = '<i class="aminst-token-after ';
        if ($this->configProvider->getAccessToken()) {
            $afterHtml .= 'aminst-token-icon';
        }
        $afterHtml .= '"></i>';
        $element->setAfterElementHtml($afterHtml);
        $element->setReadonly(true);
        return parent::_getElementHtml($element);
    }
}
