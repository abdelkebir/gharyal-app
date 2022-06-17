<?php
namespace Godogi\Installment\Model\ResourceModel;
class Request extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	){
		parent::__construct($context);
	}
	protected function _construct()
	{
		$this->_init('godogi_installment_request', 'in_id');
	}
}