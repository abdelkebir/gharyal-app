<?php

namespace Godogi\Installment\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context, 
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Psr\Log\LoggerInterface $logger)
    {
        $this->_registry = $registry;
        $this->logger = $logger;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    public function isInstallementActive()
    {
        $categoryIds = $this->getCategoryIds();
        if(in_array(70, $categoryIds)){
            return true;
        }
        return false;
    }
    public function getCurrentCategoryId()
    {
        if($this->_registry->registry('current_category')){
            return $this->_registry->registry('current_category')->getId();
        }
        return false;
    }
    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }

    public function getCategoryIds()
    {
        $product = $this->getCurrentProduct();
        return $product->getCategoryIds();
    }

    public function getConfig($config){
        return $this->scopeConfig->getValue(
            $config,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        );
    }

}