<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2020 Amasty (https://www.amasty.com)
 * @package Amasty_InstagramFeed
 */


declare(strict_types=1);

namespace Amasty\InstagramFeed\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @var Operation\InstallIndexTable
     */
    private $installIndexTable;

    /**
     * @var Operation\InstallReleationTable
     */
    private $installReleationTable;

    /**
     * @var Operation\UpdateIndexTable
     */
    private $updateIndexTable;

    public function __construct(
        Operation\InstallIndexTable $installIndexTable,
        Operation\InstallReleationTable $installReleationTable,
        Operation\UpdateIndexTable $updateIndexTable
    ) {
        $this->installIndexTable = $installIndexTable;
        $this->installReleationTable = $installReleationTable;
        $this->updateIndexTable = $updateIndexTable;
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '2.0.0', '<')) {
            $this->installIndexTable->execute($setup);
        }

        if (version_compare($context->getVersion(), '2.1.0', '<')) {
            $this->installReleationTable->execute($setup);
        }

        if (version_compare($context->getVersion(), '2.1.1', '<')) {
            $this->updateIndexTable->execute($setup);
        }
    }
}
