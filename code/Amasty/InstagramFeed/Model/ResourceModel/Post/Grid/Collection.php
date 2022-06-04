<?php

namespace Amasty\InstagramFeed\Model\ResourceModel\Post\Grid;

use Amasty\InstagramFeed\Api\Data\PostInterface;
use Amasty\InstagramFeed\Model\ResourceModel\Post as PostResource;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\Api\Search\AggregationInterface;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Framework\EntityManager\MetadataPool;

class Collection extends AbstractCollection implements SearchResultInterface
{
    /**
     * @var AggregationInterface
     */
    private $aggregations;

    /**
     * @var \Magento\Eav\Model\Config
     */
    protected $_eavConfig;

    /**
     * @var MetadataPool
     */
    private $metadataPool;

    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Eav\Model\Config $eavConfig,
        MetadataPool $metadataPool,
        $eventPrefix = 'amasty_instagramfeed_post',
        $eventObject = 'post_grid_collection',
        $model = \Magento\Framework\View\Element\UiComponent\DataProvider\Document::class,
        $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        $this->_init($model, PostResource::class);
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $connection,
            $resource
        );
        $this->_eventPrefix = $eventPrefix;
        $this->_eventObject = $eventObject;
        $this->_eavConfig = $eavConfig;
        $this->metadataPool = $metadataPool;
        $this->setMainTable(PostInterface::MAIN_TABLE);
    }

    /**
     * @return AbstractCollection
     */
    protected function _beforeLoad()
    {
        $relationTable = $this->getResource()->getTable(PostInterface::PRODUCT_RELATION_TABLE);
        $this->getSelect()->joinLeft(
            ['relation_table' => $relationTable],
            'relation_table.ig_id = main_table.ig_id',
            [PostInterface::PRODUCT_ID]
        )->joinLeft(
            ['cpe' => $this->getResource()->getTable('catalog_product_entity')],
            'cpe.entity_id = relation_table.product_id',
            ['sku']
        )->joinLeft(
            ['cpev' => $this->getResource()->getTable('catalog_product_entity_varchar')],
            sprintf(
                'cpev.attribute_id = %1$s AND cpev.%2$s = cpe.%2$s AND cpev.store_id = 0',
                $this->getNameAttributeId(),
                $this->metadataPool->getMetadata(ProductInterface::class)->getLinkField()
            ),
            ['product_name' => 'value']
        );

        return parent::_beforeLoad();
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function getNameAttributeId()
    {
        return $this->_eavConfig->getAttribute(Product::ENTITY, 'name')->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function getAggregations()
    {
        return $this->aggregations;
    }

    /**
     * {@inheritdoc}
     */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setItems(array $items = null)
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSearchCriteria()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setSearchCriteria(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null)
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }
}
