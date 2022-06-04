<?php

namespace Amasty\InstagramFeed\Ui\DataProvider\Form;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Model\Product\Visibility;

class ProductDataProvider extends \Magento\Catalog\Ui\DataProvider\Product\ProductDataProvider
{
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        Visibility $productVisibility,
        $addFieldStrategies = [],
        $addFilterStrategies = [],
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $collectionFactory,
            $addFieldStrategies,
            $addFilterStrategies,
            $meta,
            $data
        );
        $this->collection->addAttributeToSelect(
            ['status', 'thumbnail', 'name', 'price'],
            'left'
        )->addAttributeToFilter([
            [
                'attribute' => 'visibility',
                'in' => $productVisibility->getVisibleInCatalogIds()
            ]
        ]);
    }
}
