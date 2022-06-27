<?php
namespace Godogi\Installment\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
	public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
	{
		$setup->startSetup();
		if (!$setup->tableExists('godogi_installment_request')){
			$table = $setup->getConnection()->newTable($setup->getTable('godogi_installment_request'))
			->addColumn(
					'in_id',
					Table::TYPE_INTEGER,
					null,
					['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
					'Installment Id')
      ->addColumn(
          'rnumber',
          Table::TYPE_TEXT,
          250,
          [ 'nullable' => false],
          'Ref. no.')
      ->addColumn(
          'calc_discount',
          Table::TYPE_TEXT,
          250,
          [ 'nullable' => false],
          'Discount')
      ->addColumn(
          'calc_months',
          Table::TYPE_TEXT,
          250,
          [ 'nullable' => false],
          'Months')
      ->addColumn(
          'product_price',
          Table::TYPE_TEXT,
          250,
          [ 'nullable' => false],
          'Product Price')
			->addColumn(
					'coupon',
					Table::TYPE_TEXT,
	        250,
					[],
					'Coupon')
      ->addColumn(
          'last_name',
          Table::TYPE_TEXT,
          250,
          [ 'nullable' => false],
          'Last Name')
      ->addColumn(
          'first_name',
          Table::TYPE_TEXT,
          250,
          [ 'nullable' => false],
          'First Name')
			->addColumn(
          'monthly_income',
          Table::TYPE_TEXT,
          250,
          [ 'nullable' => false],
          'Monthly Income')
      ->addColumn(
          'cnic',
          Table::TYPE_TEXT,
          250,
          [ 'nullable' => false],
          'CNIC')
      ->addColumn(
          'email',
          Table::TYPE_TEXT,
          250,
          [ 'nullable' => false],
          'Email')
      ->addColumn(
          'address',
          Table::TYPE_TEXT,
          500,
          [ 'nullable' => false],
          'Address')
      ->addColumn(
          'zip_code',
          Table::TYPE_TEXT,
          250,
          [ 'nullable' => false],
          'Zip Code')
      ->addColumn(
          'location',
          Table::TYPE_TEXT,
          500,
          [ 'nullable' => false],
          'Location')
      ->addColumn(
          'date_birth',
          Table::TYPE_TEXT,
          250,
          [ 'nullable' => false],
          'Date of birth')
      ->addColumn(
          'phone_number',
          Table::TYPE_TEXT,
          250,
          [ 'nullable' => false],
          'Phone number')
      ->addColumn(
          'professional_situation',
          Table::TYPE_TEXT,
          250,
          [ 'nullable' => false],
          'Professional Situation')
				->addColumn(
	          'gender',
	          Table::TYPE_TEXT,
	          250,
	          [ 'nullable' => false],
	          'Gender')
			->addColumn(
          'status',
          Table::TYPE_TEXT,
          250,
          ['nullable' => false, 'default' => 'submitted'],
          'Status')
      ->addColumn(
          'file_cnic',
          Table::TYPE_TEXT,
          500,
          [ 'nullable' => false],
          'CNIC')
      ->addColumn(
          'file_account',
          Table::TYPE_TEXT,
          500,
          [ 'nullable' => false],
          'Account Maintenance Certificate')
      ->addColumn(
          'file_bank',
          Table::TYPE_TEXT,
          500,
          [ 'nullable' => false],
          'Bank Statement')
      ->addColumn(
          'agree',
          Table::TYPE_BOOLEAN,
          500,
          [ 'nullable' => false],
          'Agree to terms and conditions')
			->addColumn(
					'created_at',
					Table::TYPE_TIMESTAMP,
					null,
					['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
					'Created At')
			->addColumn(
					'updated_at',
					Table::TYPE_TIMESTAMP,
					null,
					['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
					'Updated At')
			->setComment('Installment requests');
			$setup->getConnection()->createTable($table);
		}
		$setup->endSetup();
	}
}
