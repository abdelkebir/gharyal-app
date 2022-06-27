<?php
namespace Godogi\Installment\Block\Adminhtml\Request\Renderer;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Data\Form\Element\Factory;
use Magento\Framework\Data\Form\Element\CollectionFactory;
use Magento\Framework\Escaper;
class MyFile extends \Magento\Framework\Data\Form\Element\AbstractElement
{
    private $_storeManager;
    /**
    * @param \Magento\Backend\Block\Context $context
    * @param array $data
    */
    public function __construct(
        Factory $factoryElement,
        CollectionFactory $factoryCollection,
        Escaper $escaper,
        StoreManagerInterface $storemanager,
        $data = [])
    {
        $this->_storeManager = $storemanager;
        parent::__construct(
            $factoryElement,
            $factoryCollection,
            $escaper,
            $data = []
        );
    }
    public function getElementHtml()
    {
        $mediaDirectory = $this->_storeManager->getStore()->getBaseUrl(
            \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
        );
        $value = $this->getTitle();
        if($value){
          $html = '<a href="'.$mediaDirectory . 'godogi/installment/request/'. $value . '" target="_blank">Download</a>';
        }else{
          $html = 'Empty';
        }

        return $html;
    }
    /**
     * Render HTML for element's label
     *
     * @param string $idSuffix
     * @param string $scopeLabel
     * @return string
     */
    public function getLabelHtml($idSuffix = '', $scopeLabel = '')
    {
        $scopeLabel = $scopeLabel ? ' data-config-scope="' . $scopeLabel . '"' : '';

        $html = '<label class="label admin__field-label" for="' .
            $this->getHtmlId() . $idSuffix . '"' . $this->_getUiId(
                'label'
            ) . '><span' . $scopeLabel . '>' .
                $this->getLabel()
            . '</span></label>' . "\n";
        return $html;
    }
}
