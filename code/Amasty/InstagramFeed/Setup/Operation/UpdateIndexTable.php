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

class UpdateIndexTable
{
    /**
     * @param SchemaSetupInterface $update
     * @throws \Zend_Db_Exception
     */
    public function execute(SchemaSetupInterface $update)
    {
        $update->startSetup();

        $update->getConnection()->changeColumn(
            $update->getTable(PostInterface::MAIN_TABLE),
            PostInterface::MEDIA_URL,
            PostInterface::MEDIA_URL,
            [
                'type' => Table::TYPE_TEXT,
                'length' => null
            ]
        );

        $update->endSetup();
    }
}
