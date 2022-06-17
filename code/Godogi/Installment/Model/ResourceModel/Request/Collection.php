<?php

namespace Godogi\Installment\Model\ResourceModel\Request;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'in_id';
	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Godogi\Installment\Model\Request', 'Godogi\Installment\Model\ResourceModel\Request');
	}
}