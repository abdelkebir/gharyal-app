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

class InstallIndexTable
{
    /**
     * @param SchemaSetupInterface $setup
     * @throws \Zend_Db_Exception
     */
    public function execute(SchemaSetupInterface $setup)
    {
        $setup->startSetup();

        $table = $setup->getConnection()->newTable(
            $setup->getTable(PostInterface::MAIN_TABLE)
        )->addColumn(
            PostInterface::POST_ID,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Amasty Instagram Post Id'
        )->addColumn(
            PostInterface::IG_ID,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Instagram Id Into Facebook'
        )->addColumn(
            PostInterface::COMMENTS_COUNT,
            Table::TYPE_INTEGER,
            null,
            ['identity' => false, 'nullable' => false, 'primary' => false],
            'Post Comments Count'
        )->addColumn(
            PostInterface::LIKE_COUNT,
            Table::TYPE_INTEGER,
            null,
            ['identity' => false, 'nullable' => false, 'primary' => false],
            'Post Likes Count'
        )->addColumn(
            PostInterface::MEDIA_URL,
            Table::TYPE_TEXT,
            255,
            ['identity' => false, 'nullable' => false, 'primary' => false],
            'Media Url'
        )->addColumn(
            PostInterface::PERMALINK,
            Table::TYPE_TEXT,
            255,
            ['identity' => false, 'nullable' => false, 'primary' => false],
            'Link'
        )->addColumn(
            PostInterface::SHORTCODE,
            Table::TYPE_TEXT,
            255,
            ['identity' => false, 'nullable' => false, 'primary' => false],
            'Short Code'
        )->addColumn(
            PostInterface::CAPTION,
            Table::TYPE_TEXT,
            255,
            ['identity' => false, 'nullable' => false, 'primary' => false],
            'Caption'
        )->addColumn(
            PostInterface::TIMESTAMP,
            Table::TYPE_DATETIME,
            null,
            ['identity' => false, 'nullable' => false, 'primary' => false],
            'Link'
        )->addColumn(
            PostInterface::STORE_ID,
            Table::TYPE_SMALLINT,
            null,
            ['identity' => false, 'nullable' => false, 'primary' => false, 'default' => 0],
            'Store Id'
        )->addIndex(
            $setup->getIdxName(PostInterface::MAIN_TABLE, [PostInterface::IG_ID]),
            [PostInterface::IG_ID],
            ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
        )->setComment(
            'Amasty InstagramFeed Posts Table'
        );
        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
