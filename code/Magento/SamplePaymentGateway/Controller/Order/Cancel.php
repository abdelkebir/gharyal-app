<?php
namespace Magento\SamplePaymentGateway\Controller\Order;

use Magento\Checkout\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Sales\Model\Order;
use \phpseclib\Crypt\RSA;

class Cancel extends \Magento\Framework\App\Action\Action
{
	/** @var  \Magento\Framework\View\Result\Page */
	protected $_pageFactory;
	public function __construct(\Magento\Framework\App\Action\Context $context,\Magento\Framework\View\Result\PageFactory $pageFactory)
	{
		$this->_pageFactory = $pageFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		// echo "Order is Cancelled";		
		 // $resultPage = $this->_pageFactory->create();
         // $resultPage->getConfig()->getTitle()->prepend(__(' heading '));

         // $block = $resultPage->getLayout()
                // ->createBlock('Magento\SamplePaymentGateway\Block\Cancel')
                // ->setTemplate('Magento_SamplePaymentGateway::cancel.phtml')
                // ->toHtml();
         // $this->getResponse()->setBody($block);
		 
		 return $this->_pageFactory->create();
	}
}