<?php
use \Magento\Framework\Registry;

namespace Magento\SamplePaymentGateway\Block;
/**
 * Core registry
 *
 * @var \Magento\Framework\Registry
 */
class Index extends \Magento\Framework\View\Element\Template
{	
	protected $_registry;
	
	public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\Registry $registry)
	{
		parent::__construct($context);
		$this->_registry = $registry;
	}

	public function setCustomerOrderNumber($customerOrderNum)
	{
		echo $customerOrderNum;
		$this->registry->register('customerOrderNum', $customerOrderNum);
	}
		
	public function getCustomerOrderNumber()
	{     
		// echo $this->registry->registry('customerOrderNum');
		// return $this->registry->registry('customerOrderNum');
	
		 return __('Hello World');
	}
}