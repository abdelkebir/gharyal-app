<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2020 Amasty (https://www.amasty.com)
 * @package Amasty_InstagramFeed
 */


declare(strict_types=1);

namespace Amasty\InstagramFeed\Setup\Operation;

use Amasty\InstagramFeed\Api\Data\PostInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallReleationTable
{
    /**
     * @param SchemaSetupInterface $setup
     * @throws \Zend_Db_Exception
     */
    public function execute(SchemaSetupInterface $setup)
    {
        $setup->startSetup();

        $table = $setup->getConnection()->newTable(
            $setup->getTable(PostInterface::PRODUCT_RELATION_TABLE)
        )->addColumn(
            PostInterface::IG_ID,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false, 'primary' => false],
            'Amasty Instagram Post Id'
        )->addColumn(
            PostInterface::PRODUCT_ID,
            Table::TYPE_INTEGER,
            10,
            ['nullable' => false, 'unsigned' => true, 'primary' => false],
            'Instagram Id Into Facebook'
        )->addIndex(
            $setup->getIdxName(PostInterface::MAIN_TABLE, [PostInterface::IG_ID, PostInterface::PRODUCT_ID]),
            [PostInterface::IG_ID, PostInterface::PRODUCT_ID],
            ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
        )->addForeignKey(
            $setup->getFkName(
                $setup->getTable(PostInterface::PRODUCT_RELATION_TABLE),
                PostInterface::PRODUCT_ID,
                $setup->getTable('catalog_product_entity'),
                'entity_id'
            ),
            PostInterface::PRODUCT_ID,
            $setup->getTable('catalog_product_entity'),
            'entity_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->setComment(
            'Amasty InstagramFeed Posts Product Relation Table'
        );
        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
