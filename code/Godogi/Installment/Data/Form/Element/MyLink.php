<?php

namespace Godogi\Installment\Data\Form\Element;

use Magento\Framework\Escaper;
use Magento\Store\Model\StoreManagerInterface;

class MyLink extends \Magento\Framework\Data\Form\Element\Link
{
    /**
     * @param \Magento\Framework\Data\Form\Element\Factory $factoryElement
     * @param \Magento\Framework\Data\Form\Element\CollectionFactory $factoryCollection
     * @param Escaper $escaper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Data\Form\Element\Factory $factoryElement,
        \Magento\Framework\Data\Form\Element\CollectionFactory $factoryCollection,
        Escaper $escaper,
        StoreManagerInterface $storemanager,
        $data = []
    ) {
        $this->_storeManager = $storemanager;
        parent::__construct($factoryElement, $factoryCollection, $escaper, $data);
        $this->setType('mylink');
    }

    /**
     * Generates element html
     *
     * @return string
     */
    public function getElementHtml()
    {
        $mediaDirectory = $this->_storeManager->getStore()->getBaseUrl(
            \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
        );
        if(!$this->getValue()){
          $html = $this->getBeforeElementHtml() .
                  'Empty' .
                  $this->getAfterElementHtml();
        }else{
          $html = $this->getBeforeElementHtml() .
                  '<a
                      id="' . $this->getHtmlId() . '"
                      href="'. $mediaDirectory . 'godogi/installment/request/' . $this->getValue() .'"'. $this->_getUiId() . '
                      target="_blank"
                  >' . __("View") .
                  "</a>\n" .
                  $this->getAfterElementHtml();
        }
        return $html;
    }
}
