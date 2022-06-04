<?php
namespace Magento\SamplePaymentGateway\Controller\Index;
use \phpseclib\Crypt\RSA;
use Magento\Checkout\Model\Session;
use Magento\Sales\Model\Order;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_scopeConfig;
	protected $_orderRepository;
	private $DECRYPT_BLOCK_SIZE = 512;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
		\Magento\Sales\Model\Order $_order,
		\Magento\Sales\Model\OrderRepository $orderRepository
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->scopeConfig = $scopeConfig;
		return parent::__construct($context);
		$this->_order = $_order;
		$this->_orderRepository = $orderRepository;
	}

	/**
	* @var \Magento\Framework\App\ViewInterface $_view
	*/

	/**
	* @return void
	*/
	
	public function execute()
	{		
		  $dec_key = $this->scopeConfig->getValue('payment/sample_gateway/dec_key', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		  $dec_key = str_replace("-----BEGIN RSA PRIVATE KEY-----",nl2br("-----BEGIN RSA PRIVATE KEY-----"),$dec_key);
		  $dec_key = str_replace("-----END RSA PRIVATE KEY-----","-----END RSA PRIVATE KEY-----",$dec_key);
		  $dec_key = str_replace(".<br />", "", $dec_key);
		 
		if (strpos($_SERVER['REQUEST_URI'], 'data') !== false)
		{
			$encryptedData = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
			$encryptedData = str_replace("data=", "", $encryptedData);

			$url_params = $this->decryptData($encryptedData, $dec_key);
			parse_str($url_params,$paramArray);

			if($paramArray['RESPONSE_CODE'] == '100' || $paramArray['RESPONSE_CODE'] == '0' || $paramArray['RESPONSE_CODE'] == '300' || $paramArray['RESPONSE_CODE'] == '00') // || $paramArray['RESPONSE_CODE'] == '101' || $paramArray['RESPONSE_CODE'] == '102' || $paramArray['RESPONSE_CODE'] == '200' || $paramArray['RESPONSE_CODE'] == '201' || $paramArray['RESPONSE_CODE'] == '202' || $paramArray['RESPONSE_CODE'] == '203' || $paramArray['RESPONSE_CODE'] == '204' || $paramArray['RESPONSE_CODE'] == '205' || $paramArray['RESPONSE_CODE'] == '207' || $paramArray['RESPONSE_CODE'] == '208' || $paramArray['RESPONSE_CODE'] == '210' || $paramArray['RESPONSE_CODE'] == '211' || $paramArray['RESPONSE_CODE'] == '221' || $paramArray['RESPONSE_CODE'] == '222' || $paramArray['RESPONSE_CODE'] == '203' || $paramArray['RESPONSE_CODE'] == '230' || $paramArray['RESPONSE_CODE'] == '231' || $paramArray['RESPONSE_CODE'] == '232' || $paramArray['RESPONSE_CODE'] == '233' || $paramArray['RESPONSE_CODE'] == '234' || $paramArray['RESPONSE_CODE'] == '236' || $paramArray['RESPONSE_CODE'] == '240' || $paramArray['RESPONSE_CODE'] == '475' || $paramArray['RESPONSE_CODE'] == '476' || $paramArray['RESPONSE_CODE'] == '520' || $paramArray['RESPONSE_CODE'] == '481')
			{
				$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
				////////////////////////////////
				$collection = $objectManager->create('\Magento\Sales\Model\Order'); 
				$order = $collection->loadByIncrementId($paramArray['ORDER_REF_NUMBER']); // get order detail by incrementid 
				//$orderId = $orderInfo ->getId();
				//echo $orderId;  
				/////////////////////////////////
				//$order = $objectManager->create('\Magento\Sales\Model\OrderRepository')->get($paramArray['ORDER_REF_NUMBER']);  //load by primary key entity id
				//$orderIncrementId = $order->getIncrementId();
				//echo $orderIncrementId;
				
				$customerOrderNumber = $paramArray['ORDER_REF_NUMBER'];
				
				
				$this->_view->loadLayout();
				 $block = $this->_view->getLayout()->getBlock('customcheckout_index_index');
				 //echo var_dump($block);
				  if($block) 
				  {
					  $customMessage = $paramArray['RESPONSE_MESSAGE'];
					  $block->setCustomerOrderNumber($customerOrderNumber);
					  $block->setCustomerMessage($customMessage);
				  }
				$order->setStatus('processing')->setState('processing');
				$order->save();
			}
			else
			{
				//$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
				//$collection = $objectManager->create('\Magento\Sales\Model\Order'); 
				//$order = $collection->loadByIncrementId($paramArray['ORDER_REF_NUMBER']);
				//$order = $objectManager->create('\Magento\Sales\Model\OrderRepository')->get($paramArray['ORDER_REF_NUMBER']);
				//$orderIncrementId = $order->getIncrementId();
				//echo $orderIncrementId;
				
				$customerOrderNumber = $paramArray['ORDER_REF_NUMBER'];
				
				
				$this->_view->loadLayout();
				 $block = $this->_view->getLayout()->getBlock('customcheckout_index_index');
				 //echo var_dump($block);
				  if($block) 
				  {
					  $customMessage = $paramArray['RESPONSE_MESSAGE'];
					  $block->setCustomerOrderNumber($customerOrderNumber);
					  $block->setCustomerMessage($customMessage);
				  }
				// $order->setStatus('holded')->setState('holded');
				// $order->save();
			}	
		 }
		
		 return $this->_pageFactory->create();
	}
	
	protected function decryptData($data,$privatePEMKey)
	{
		$decrypted = '';
		//decode must be done before spliting for getting the binary String
		$data = str_split(base64_decode($data), $this->DECRYPT_BLOCK_SIZE);

		foreach($data as $chunk)
		{
			$partial = '';
		
			//be sure to match padding
			$decryptionOK = openssl_private_decrypt($chunk, $partial, $privatePEMKey, OPENSSL_PKCS1_PADDING);
			if($decryptionOK === false)
			{
				return false;
			}//here also processed errors in decryption. If too big this will be false
			$decrypted .= $partial;
		}
		
		return $decrypted;
	}

}