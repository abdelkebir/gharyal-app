<?php

namespace Godogi\Installment\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as EventObserver;
use Psr\Log\LoggerInterface as Logger;
use Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfig;
use Magento\Catalog\Api\CategoryLinkManagementInterface as CategoryLink;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class ConfigObserver implements ObserverInterface
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var ScopeConfig
     */
    protected $scopeConfig;

    /**
     * @var CategoryLink
     */
    protected $categoryLink;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param Logger $logger
     */
    public function __construct(
        ScopeConfig $scopeConfig,
        CategoryLink $categoryLink,
        CollectionFactory $collectionFactory,
        Logger $logger
    ) {
        $this->logger = $logger;
        $this->scopeConfig = $scopeConfig;
        $this->categoryLink = $categoryLink;
        $this->collectionFactory = $collectionFactory;
    }

    public function execute(EventObserver $observer)
    {
        /*
        $this->logger->info('____________________________________  hhh ');
        $this->logger->info($observer->getWebsite());
        $this->logger->info($observer->getStore());
        */
        /*
        $maxPrice = $this->scopeConfig->getValue('godogi_installment/general/max_price', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $this->logger->info('____________________________________ 9999');
        $this->logger->info($maxPrice);



        $categoryIds = ['70'];
        $categoryId = 70;

        $collection = $this->collectionFactory->create();
        $collection->addAttributeToSelect('*');

        $collection->addFieldToFilter( 'price' , array('from' => 0, 'to' => $maxPrice) );
        $i = 0;
        foreach($collection as $product){
            
            //$sku = $product->getSku();
            //$this->categoryLink->assignProductToCategories($sku, $categoryIds);
            
            $categories = $product->getCategoryIds();
            $categories[] = $categoryId;
            $product->setCategoryIds($categories);
            $product->save();
            $i++;
        }

        $this->logger->info('____________________________________ 444');
        $this->logger->info($collection->count());

        */

        

    }
}
