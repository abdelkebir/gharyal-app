<?php

namespace Godogi\Installment\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as EventObserver;
use Psr\Log\LoggerInterface as Logger;
use Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfig;
use Magento\Catalog\Api\CategoryLinkManagementInterface as CategoryLink;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\ResourceConnection;

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
     * @var \Magento\Framework\App\ResourceConnection
     */
    protected $resourceConnection;

    /**
     * @param Logger $logger
     */
    public function __construct(
        ScopeConfig $scopeConfig,
        CategoryLink $categoryLink,
        CollectionFactory $collectionFactory,
        ResourceConnection $resourceConnection,
        Logger $logger
    ) {
        $this->logger = $logger;
        $this->scopeConfig = $scopeConfig;
        $this->categoryLink = $categoryLink;
        $this->collectionFactory = $collectionFactory;
        $this->resourceConnection = $resourceConnection;
    }

    public function execute(EventObserver $observer)
    {
        $categoryId = 70;
        $maxPrice = $this->scopeConfig->getValue('godogi_installment/general/max_price', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $connection = $this->resourceConnection->getConnection();
        $table = $connection->getTableName('catalog_category_product');
        $query = "DELETE FROM `" . $table . "` WHERE category_id = $categoryId ";
        $connection->query($query);
        $collection = $this->collectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToFilter('enable_installment',['eq'=>1]);
        $collection->addFieldToFilter( 'price' , array('from' => 0, 'to' => $maxPrice) );
        foreach($collection as $product){
            $productId = $product->getId();
            $query = "INSERT INTO `" . $table . "`(`category_id`, `product_id`) VALUES ($categoryId, $productId)";
            $connection->query($query);
        }

    }
}
