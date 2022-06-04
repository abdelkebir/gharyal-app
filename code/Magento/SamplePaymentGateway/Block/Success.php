<?php
namespace Magento\SamplePaymentGateway\Block;

use \Magento\Framework\Registry;
use \Magento\Framework\View\Element\Template;

/**
 * Core registry
 *
 * @var \Magento\Framework\Registry
 */
class Success extends \Magento\Framework\View\Element\Template
{
	private $_registry;
	protected $customerOrderNum;
	
	public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\Registry $registry)
	{
		parent::__construct($context);
		$this->_registry = $registry;
	}

	public function setCustomerMessage($customMessage)
	{
		$this->_registry->register('customMessage', $customMessage);
	}
	
	public function getCustomerMessage()
	{     
		 return __($this->_registry->registry('customMessage'));
	}
	
	public function setCustomerOrderNumber($customerOrderNum)
	{
		$this->_registry->register('customerOrderNum', $customerOrderNum);
	}
		
	public function getCustomerOrderNumber()
	{     
		// echo $this->registry->registry('customerOrderNum');
		 return __($this->_registry->registry('customerOrderNum'));
	
		 //return __('Hello World');
	}
}