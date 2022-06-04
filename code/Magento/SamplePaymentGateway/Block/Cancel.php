<?php
namespace Magento\SamplePaymentGateway\Block;
class Cancel extends \Magento\Framework\View\Element\Template
{
	public function __construct(\Magento\Framework\View\Element\Template\Context $context)
	{
		parent::__construct($context);
	}

	public function cancel()
	{
		return __('Payment Is Unsuccessfull. Your Order Is Cancelled.');
	}
	
}