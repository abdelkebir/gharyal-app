<?php

namespace Amasty\InstagramFeed\Block\Adminhtml\System\Config;

use Amasty\InstagramFeed\Model\ConfigProvider;
use Amasty\InstagramFeed\Model\Instagram\Client;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Json\EncoderInterface;
use Magento\Framework\UrlInterface;

/**
 * Class AcessToken
 *
 * Implements configuration for getting access token
 */
class AcessToken extends Field
{
    /**
     * @var EncoderInterface
     */
    private $jsonEncoder;
    /**
     * @var Client
     */
    private $client;

    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * @var ConfigProvider
     */
    private $configProvider;

    public function __construct(
        Client $client,
        \Magento\Backend\Block\Template\Context $context,
        EncoderInterface $jsonEncoder,
        UrlInterface $url,
        ConfigProvider $configProvider,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->jsonEncoder = $jsonEncoder;
        $this->client = $client;
        $this->url = $url;
        $this->configProvider = $configProvider;
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->setTemplate('Amasty_InstagramFeed::system/config/access_token.phtml');

        return $this;
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $element = clone $element;
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();

        return parent::render($element);
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $originalData = $element->getOriginalData();
        $label = $this->getIsTokenSet() ? __('Re-generate Access Token') : __($originalData['button_label']);
        $this->addData(
            [
                'button_label' => $label,
                'json_config' => $this->generateButtonConfig($element),
                'html_id' => $element->getHtmlId()
            ]
        );

        return $this->_toHtml();
    }

    /**
     * @return bool
     */
    public function getIsTokenSet()
    {
        return (bool) $this->configProvider->getAccessToken();
    }

    /**
     * @param $element
     * @return mixed
     */
    private function generateButtonConfig(AbstractElement $element)
    {
        $result = [
            'authorize_url' => $this->client->getAuthorizeUrl($element->getScopeId()),
        ];

        return $this->jsonEncoder->encode($result);
    }

    /**
     * @return bool
     */
    public function getIsConnectionSecure()
    {
        return $this->client->getIsRefererSecure();
    }
}
