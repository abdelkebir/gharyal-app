<?php
namespace Godogi\Installment\Model;
class Request extends \Magento\Framework\Model\AbstractModel
{
	protected function _construct()
	{
		$this->_init('Godogi\Installment\Model\ResourceModel\Request');
	}
}