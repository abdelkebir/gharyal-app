<?php
namespace Godogi\Installment\Model\Config\Backend;

class MaxPrice extends \Magento\Framework\App\Config\Value
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;
    /**
     * @var \Magento\Framework\App\ResourceConnection
     */
    protected $resourceConnection;
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @var \Magento\Indexer\Model\IndexerFactory
     */
    protected $indexerFactory;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ScopeConfigInterface $config
     * @param \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Config\ScopeConfigInterface $config,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\App\ResourceConnection $resourceConnection,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        \Magento\Indexer\Model\IndexerFactory $indexerFactory,
        array $data = []
    ) {
        $this->logger = $logger;
        $this->collectionFactory = $collectionFactory;
        $this->resourceConnection = $resourceConnection;
        $this->scopeConfig = $scopeConfig;
        $this->indexerFactory = $indexerFactory;
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }

    /**
     * @return $this
     */
    public function afterSave()
    {
        if ($this->isValueChanged()) {
            $categoryId = 70;
            $maxPrice = $this->scopeConfig->getValue('godogi_installment/general/max_price', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
            $connection = $this->resourceConnection->getConnection();
            $table = $connection->getTableName('catalog_category_product');
            $query = "DELETE FROM `" . $table . "` WHERE category_id = $categoryId ";
            $connection->query($query);
            
            $collection = $this->collectionFactory->create();
            $collection->addAttributeToSelect('*');
            $collection->addFieldToFilter( 'price' , array('from' => 0, 'to' => $maxPrice) );
            foreach($collection as $product){
                $productId = $product->getId();
                $query = "INSERT INTO `" . $table . "`(`category_id`, `product_id`) VALUES ($categoryId, $productId)";
                $connection->query($query);
            }
            foreach ($indexerIds as $indexerId) {
                $indexer = $this->indexerFactory->create();
                $indexer->load($indexerId);
                $indexer->reindexAll();
            }
        }
        return parent::afterSave();
    }
}