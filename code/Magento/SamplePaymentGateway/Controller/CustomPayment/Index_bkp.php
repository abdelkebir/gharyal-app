<?php
namespace Magento\SamplePaymentGateway\Controller\CustomPayment;
//namespace {Vendor}\{Module}\Controller\{CustomPaymentMethodName};

use Magento\Checkout\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Sales\Model\Order;
use \phpseclib\Crypt\RSA;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_curl;
	protected $_order;
	protected $_checkoutSession;
	protected $_orderRepository;
	protected $_regionFactory;
	protected $_categoryCollectionFactory;
	protected $_storeManager;
	protected $_logger;
	protected $_productFactory;
	
	public function __construct(
			Context $context,
			\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, 
			\Magento\Checkout\Model\Session $checkoutSession,
			\Magento\Framework\Locale\Resolver $store,
			\Magento\Framework\UrlInterface $urlBuilder,
			\Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory, 
			\Magento\Directory\Model\CountryFactory $countryFactory,
			\Magento\Framework\HTTP\Client\Curl $curl,
			\Magento\Sales\Model\Order $_order,
			\Magento\Sales\Model\OrderRepository $orderRepository,
			\Magento\Directory\Model\RegionFactory $regionFactory,
			\Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
			\Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
			\Magento\Store\Model\StoreManagerInterface $storeManager,
			\Psr\Log\LoggerInterface $logger,
			\Magento\Catalog\Model\ProductFactory $productFactory
		) {
			parent::__construct($context);
			$this->scopeConfig = $scopeConfig;
			$this->_checkoutSession = $checkoutSession;
			$this->store = $store;
			$this->urlBuilder = $urlBuilder;
			$this->resultJsonFactory = $resultJsonFactory;
			$this->_curl = $curl;
			$this->_order = $_order;
			$this->_orderRepository = $orderRepository;
			$this->_regionFactory = $regionFactory;
			$this->_categoryCollectionFactory = $categoryCollectionFactory;
			$this->_customerRepositoryInterface = $customerRepositoryInterface;
			$this->_storeManager = $storeManager;
			$this->_logger = $logger;
			$this->_productFactory = $productFactory;
		}
	
	public function execute()
    {		
		//...Admin Configurations
		$client_name = $this->scopeConfig->getValue('payment/sample_gateway/client_name', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		$password = $this->scopeConfig->getValue('payment/sample_gateway/password', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		$channel = $this->scopeConfig->getValue('payment/sample_gateway/channel', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		$return_url = $this->_storeManager->getStore()->getBaseUrl() . 'customcheckout/index';
		//$this->scopeConfig->getValue('payment/sample_gateway/return_url', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		$cancel_url = $this->_storeManager->getStore()->getBaseUrl() . 'customcheckout/Order/Cancel';
		//$this->scopeConfig->getValue('payment/sample_gateway/cancel_url', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		$enc_key = $this->scopeConfig->getValue('payment/sample_gateway/enc_key', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		$custom_select = $this->scopeConfig->getValue('payment/sample_gateway/custom_select', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		$bill_enable = $this->scopeConfig->getValue('payment/sample_gateway/bill_enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		$bill_edit = $this->scopeConfig->getValue('payment/sample_gateway/bill_edit', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		
		$live_environment = $this->scopeConfig->getValue('payment/sample_gateway/live_environment', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		$use_proxy = $this->scopeConfig->getValue('payment/sample_gateway/use_proxy', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		$proxy = $this->scopeConfig->getValue('payment/sample_gateway/proxy', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		
		
		$enc_key = str_replace("-----BEGIN PUBLIC KEY-----",nl2br("-----BEGIN PUBLIC KEY-----"),$enc_key);
		$enc_key = str_replace("-----END PUBLIC KEY-----","-----END PUBLIC KEY-----",$enc_key);
		$enc_key = str_replace(".<br />", "", $enc_key);
		
		
		$current_order = $this->_checkoutSession->getLastRealOrder();
		$orderId=$current_order->getEntityId();
		
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$order = $objectManager->create('\Magento\Sales\Model\OrderRepository')->get($orderId);
		
		$spbillingAddress = $order->getBillingAddress();
		$spshippingAddress = $order->getShippingAddress();
		//echo $spbillingAddress->getRegion();
		//echo $spshippingAddress->getRegion();
		
		//$customer = $this->_customerRepositoryInterface->getById($order->getCustomerId());
		//echo print_r($order->getCustomerId());
		
		$billerRegionCode = "";
		$billerRegionId = $order->getBillingAddress()->getRegionId();
		if (is_numeric($billerRegionId)) 
		{
          $billerRegion = $this->_regionFactory->create()->load($billerRegionId);
          $billerRegionCode =$billerRegion->getCode();
		}
		
		$shipperRegionCode = "";
		$shipperRegionId = $order->getShippingAddress()->getRegionId();
		if (is_numeric($shipperRegionId)) 
		{
          $shipperRegion = $this->_regionFactory->create()->load($shipperRegionId);
          $shipperRegionCode =$shipperRegion->getCode();
		}
		
		
		$billing_street_address = "";
		foreach ($order->getBillingAddress()->getStreet() as $street)
		{
			$billing_street_address .= $street;
		}
		
		$shipping_street_address = "";
		foreach ($order->getShippingAddress()->getStreet() as $street)
		{
			$shipping_street_address .= $street;
		}

		$excustId = '0';
		if(!$order->getCustomerIsGuest())
		{
			$this->_logger->addDebug('IS GUEST CUSTOMER:: ' . print_r($order->getCustomerIsGuest(), true) . ' ::result');
			$excustId = $order->getCustomerId();
		}
		else
		{
			$this->_logger->addDebug('IS GUEST CUSTOMER:: ' . print_r($order->getCustomerIsGuest(), true) . ' ::result');
		}
		
		$custom_data = array (
			'USER_ID' => $client_name,
			'PASSWORD' => $this->encryptData($password,$enc_key),
			'CHANNEL' => $this->encryptData($channel,$enc_key),
			'RETURN_URL' => $this->encryptData($return_url,$enc_key),
			'CANCEL_URL' => $this->encryptData($cancel_url,$enc_key),
			'TRAN_TYPE' => $this->encryptData('2',$enc_key),
			'TYPE_ID' => $this->encryptData($custom_select,$enc_key),
			'SHIPPING_DETAIL' => array (
				'NAME' => $this->encryptData($order->getShippingMethod(),$enc_key),
				'DELIEVERY_DAYS' => $this->encryptData('0',$enc_key),//modify if shipping days applicable
				'SHIPPING_COST' => $this->encryptData($order->getShippingAmount(),$enc_key)
			),
			'ORDER' => array (
				'DISCOUNT_ON_TOTAL' => $this->encryptData($order->getBaseDiscountAmount() + 0,$enc_key),
				'SUBTOTAL' => $this->encryptData($order->getGrandTotal() + 0,$enc_key)
				//'SUBTOTAL' => $this->encryptData($order->getSubtotal(),$enc_key)
			),
			'ADDITIONAL_DATA' => array (
				// 'BILL_TO_FORENAME' => $this->encryptData($order->getCustomerFirstname(),$enc_key),
				'BILL_TO_FORENAME' => $this->encryptData($spbillingAddress->getFirstname(),$enc_key),
				// 'BILL_TO_SURNAME' => $this->encryptData($order->getCustomerLastname(),$enc_key),
				'BILL_TO_SURNAME' => $this->encryptData($spbillingAddress->getLastname(),$enc_key),
				// 'BILL_TO_EMAIL' => $this->encryptData($order->getCustomerEmail(),$enc_key),
				'BILL_TO_EMAIL' => $this->encryptData($spbillingAddress->getEmail(),$enc_key),
				// 'BILL_TO_PHONE' => $this->encryptData($order->getBillingAddress()->getTelephone(),$enc_key),
				'BILL_TO_PHONE' => $this->encryptData($spbillingAddress->getTelephone(),$enc_key),
				'BILL_TO_ADDRESS_LINE' => $this->encryptData($billing_street_address,$enc_key),
				// 'BILL_TO_ADDRESS_CITY' => $this->encryptData($order->getBillingAddress()->getCity(),$enc_key),
				'BILL_TO_ADDRESS_CITY' => $this->encryptData($spbillingAddress->getCity(),$enc_key),
				// 'BILL_TO_ADDRESS_STATE' => $this->encryptData($billerRegionCode,$enc_key),
				'BILL_TO_ADDRESS_STATE' => $this->encryptData($spbillingAddress->getRegion(),$enc_key),
				// 'BILL_TO_ADDRESS_COUNTRY' => $this->encryptData($order->getBillingAddress()->getCountryId(),$enc_key),
				'BILL_TO_ADDRESS_COUNTRY' => $this->encryptData($spbillingAddress->getCountryId(),$enc_key),
				'BILL_TO_ADDRESS_POSTAL_CODE' => $this->encryptData($order->getBillingAddress()->getPostcode(),$enc_key),
				
				// 'SHIP_TO_FORENAME' => $this->encryptData($order->getCustomerFirstname(),$enc_key),
				'SHIP_TO_FORENAME' => $this->encryptData($spshippingAddress->getFirstname(),$enc_key),
				// 'SHIP_TO_SURNAME' => $this->encryptData($order->getCustomerLastname(),$enc_key),
				'SHIP_TO_SURNAME' => $this->encryptData($spshippingAddress->getLastname(),$enc_key),
				// 'SHIP_TO_PHONE' => $this->encryptData($order->getShippingAddress()->getTelephone(),$enc_key),
				'SHIP_TO_PHONE' => $this->encryptData($spshippingAddress->getTelephone(),$enc_key),
				'SHIP_TO_ADDRESS_LINE' => $this->encryptData($shipping_street_address,$enc_key),
				// 'SHIP_TO_ADDRESS_CITY' => $this->encryptData($order->getShippingAddress()->getCity(),$enc_key),
				'SHIP_TO_ADDRESS_CITY' => $this->encryptData($spshippingAddress->getCity(),$enc_key),
				// 'SHIP_TO_ADDRESS_STATE' => $this->encryptData($shipperRegionCode,$enc_key),
				'SHIP_TO_ADDRESS_STATE' => $this->encryptData($spshippingAddress->getRegion(),$enc_key),
				// 'SHIP_TO_ADDRESS_COUNTRY' => $this->encryptData($order->getShippingAddress()->getCountryId(),$enc_key),
				'SHIP_TO_ADDRESS_COUNTRY' => $this->encryptData($spshippingAddress->getCountryId(),$enc_key),
				'SHIP_TO_ADDRESS_POSTAL_CODE' => $this->encryptData($order->getShippingAddress()->getPostcode(),$enc_key),
				
				'CURRENCY' => $this->encryptData($order->getOrderCurrencyCode(),$enc_key),
				'REFERENCE_NUMBER' => $this->encryptData($orderId,$enc_key),
				'CUSTOMER_ID' => $this->encryptData($excustId,$enc_key),
				'MerchantFields' => array (
					'MDD1' => $this->encryptData('WC',$enc_key),
					'MDD2' => $this->encryptData('YES',$enc_key),
					'MDD6' => $this->encryptData($order->getShippingMethod(),$enc_key),
					'MDD8' => $this->encryptData($spshippingAddress->getCountryId(),$enc_key),
					'MDD20' => $this->encryptData('NO',$enc_key)
					 
					 //---------------MERCHANT MANUAL CONFIGURATION SECTION (start)---------------//
					// $mdd9 = $admin_settings['merchant_data_9'];
					// $mdd10 = $admin_settings['merchant_data_10'];
					// $mdd11 = $admin_settings['merchant_data_11'];
					// $mdd12 = $admin_settings['merchant_data_12'];
					// $mdd13 = $admin_settings['merchant_data_13'];
					// $mdd14 = $admin_settings['merchant_data_14'];
					// $mdd15 = $admin_settings['merchant_data_15'];
					// $mdd16 = $admin_settings['merchant_data_16'];
					// $mdd17 = $admin_settings['merchant_data_17'];
					// $mdd18 = $admin_settings['merchant_data_18'];
					// $mdd19 = $admin_settings['merchant_data_19'];
					//---------------MERCHANT MANUAL CONFIGURATION SECTION (end)---------------//					 
				)
			)
		);
		
		$previous_customer = ( $order->getCustomerId() > 0 ? 'YES' : 'NO' );
		$mdd5 = '';
		if($previous_customer)
		{
			$mdd5 = $this->encryptData($order->getCustomerId(),$enc_key);
			$custom_data['ADDITIONAL_DATA']['MerchantFields']['MDD5'] = $mdd5;
		}
		
		$custom_data['ORDER'] =  array (
				'DISCOUNT_ON_TOTAL' => $this->encryptData($order->getBaseDiscountAmount() + 0,$enc_key),
				// 'SUBTOTAL' => $this->encryptData($order->getSubtotal(),$enc_key),
				'SUBTOTAL' => $this->encryptData($order->getGrandTotal() + 0,$enc_key),
				'OrderSummaryDescription' => array ()
			);
		
		$OrderSummaryDescription = array();
		$parent_cats = '';
		$child_cats = '';
		$product_names = '';
		$order_qty = 0;
		foreach ($order->getAllItems() as $item)
		{
			$ccategories = $this->getProductCategories($item->getProductId());
			$categoryArr = $this->getCategoryById($ccategories);
				
			//$this->_logger->addDebug('start LINE:205:::array:: ' . print_r($categoryArr) . ' ::::: end');
			
			//$regular_pprice = $item->getPriceInfo()->getPrice('regular_price')->getValue();
			// echo 'Regular Price: '. var_dump($item->getRegularPrice());
			//echo 'Special Price: '. var_dump($item->getSpecialPrice());
			//echo var_dump($item->getPriceInfo());
			
			
			$OrderSummaryDescription[] = [
					'ITEM_NAME' => $this->encryptData($item->getName(),$enc_key),
					'QUANTITY' => $this->encryptData(intval($item->getQtyOrdered()),$enc_key),
					'UNIT_PRICE' => $this->encryptData($item->getPrice(),$enc_key),
					//'OLD_PRICE' => $this->encryptData($item->getSpecialPrice(),$enc_key),
					'CATEGORY' => $this->encryptData($categoryArr[0]['CATEGORY'],$enc_key),
					'SUB_CATEGORY' => $this->encryptData($categoryArr[0]['SUB_CATEGORY'],$enc_key)
					];
			
			$order_qty = $order_qty + intval($item->getQtyOrdered());
			$product_names .= $item->getName() . ',';
			$parent_cats .= $categoryArr[0]['CATEGORY'] . ',';
			$child_cats .= $categoryArr[0]['SUB_CATEGORY'] . ',';
		}
		
		$product_names = rtrim($product_names,', ');
		$parent_cats = rtrim($parent_cats,', ');
		$child_cats = rtrim($child_cats,', ');
		
		if(empty($parent_cats))
			$parent_cats = 'Uncategorized';
		
		if(empty($child_cats))
			$child_cats = 'Uncategorized';
		
		$custom_data['ADDITIONAL_DATA']['MerchantFields']['MDD3'] = $this->encryptData($this->TrimString($parent_cats . ',' . $child_cats,99), $enc_key);
		$custom_data['ADDITIONAL_DATA']['MerchantFields']['MDD4'] = $this->encryptData($this->TrimString($product_names,99), $enc_key);
		$custom_data['ADDITIONAL_DATA']['MerchantFields']['MDD7'] = $this->encryptData($this->TrimString($order_qty,99), $enc_key);
		
		$custom_data['ORDER']['OrderSummaryDescription'] = $OrderSummaryDescription;
		
		//$_order_rep = $this->_orderRepository->getById($orderId); // it order is not order increment id
		$order->setStatus('pending_payment')->setState('pending_payment');
		$order->save();
		
		$custom_data_json = $this->resultJsonFactory->create();
		//$data = $custom_data_json->setData($custom_data);
	
		$arr = json_encode($custom_data);
		$api_url = '';
		$page_url = '';
		
		if($live_environment == 1)
		{
			$api_url = 'https://digitalbankingportal.hbl.com/HostedCheckout/api/checkout';
			$page_url = 'https://digitalbankingportal.hbl.com/HostedCheckout/Site/index.html#/checkout?data=';
		}
		else
		{
			// $api_url = 'http://localhost:63896/api/Checkout';
			// $page_url = 'http://localhost:1113/index.html#/checkout?data=';
			
			$api_url = 'https://testpaymentapi.hbl.com/HBLPay/api/checkout';
			$page_url = 'https://testpaymentapi.hbl.com/HblPay/Site/index.html#/checkout?data=';
		}
		
		$make_call = $this->callAPI('POST', $api_url, $arr, $live_environment, $use_proxy, $proxy);
		//return $make_call;
		//$response = json_decode($make_call, true);
		// $errors   = $response['response']['errors'];
		// $data     = $response['response']['data'][0];
		
		$outputArray = json_decode($make_call, true);
		$outputArray['page_url'] = $page_url;
		
		
		$out = json_encode($outputArray);
		return $custom_data_json->setData($out);
		// return $custom_data_json->setData($make_call);
	}
	
	public function getProductCategories($pid)
    {
      $product = $this->_productFactory->create()->load($pid); // $pid = Product_ID
      return  $product->getCategoryIds();
	  //$catArray = $product->getCategoryIds();
	  
    }
	
	public function getCategoryById($cids)
    {
		$arrCat = array();
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$categoryCollection = $objectManager->get('\Magento\Catalog\Model\ResourceModel\Category\CollectionFactory');
		$categories = $categoryCollection->create()->addAttributeToSelect('*')->addAttributeToFilter('entity_id', $cids);
		$ch_cat = array();
		$pa_cat = array();
		
		if(isset($categories) && !empty($categories))
		{
			foreach ($categories as $category) 
			{
				// $this->_logger->addDebug('start getCategoryById:::cat_names:: ' . $category->getName() . ' :::::getCategoryById end');
				// echo $category->getName() . '<br>';
				$ch_cat[] = $category->getName();
				$pcid = $category->getparent_id();
				 $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
				 $categoryFactory = $objectManager->get('\Magento\Catalog\Model\CategoryFactory');
				 $parent_category = $categoryFactory->create()->load($pcid);
				 //$this->_logger->addDebug('start parentCategory:::cat_names:: ' . $parent_category->getName() . ' :::::parentCategory end');
				 $pa_cat[] = $parent_category->getName();
			}
		}
		
		if(!isset($ch_cat) || empty($ch_cat))
		{
			$ch_cat[] = 'Uncategorized';
		}
		if(!isset($pa_cat) || empty($pa_cat))
		{
			$pa_cat[] = 'Uncategorized';
		}	
		
		$arrCat[] = [
						'CATEGORY' => $this->cyber_clean(implode( ',', $pa_cat)),
						'SUB_CATEGORY' => $this->cyber_clean(implode( ',', $ch_cat))
					];
		
		//$this->_logger->addDebug('CATEGORY ARRAY:: ' . print_r($arrCat[0],true) . ' ::CATEGORY ARRAY');
		return $arrCat;
    }
	
	function cyber_clean($string) 
	{
		// $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
		// $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
		// return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
		$string = preg_replace('/[^A-Za-z, ]/', '', $string);
		return $string;
	}
	
	function callAPI($method, $url, $data, $islive, $useproxy, $proxy)
	{
	 // $this->_logger->addDebug('result:: ' . print_r($data, true) . ' ::result');

     $curl = curl_init();
     switch ($method)
	 {
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
	   }
	   // OPTIONS:
	   curl_setopt($curl, CURLOPT_URL, $url);
	   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		  //'APIKEY: 111111111111111111111',
		  'Content-Type: application/json',
	   ));
	   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	   
	    if($islive == 1)
		{
			  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		}
	   
	   // PROXY
		if($useproxy == 1)
		{
			//$proxy = $proxy;//'http://proxy3.domestic.hbl.com:8080';
			curl_setopt($curl, CURLOPT_PROXY, $proxy);
		}
	   
	   // EXECUTE:
	   $result = curl_exec($curl);
	   if(!$result)
	   {
		   die("Connection Failure");
	   }
	   curl_close($curl);
	   
	   return $result;
	}
	function encryptData($plainData, $publicPEMKey)
	{
		$plainData=utf8_encode($plainData);	
		$partialEncrypted = '';
		$encryptionOk = openssl_public_encrypt($plainData, $partialEncrypted, $publicPEMKey,OPENSSL_PKCS1_PADDING);
		return base64_encode($partialEncrypted);//encoding the whole binary String as MIME base 64
	}
	
	function TrimString($value,$length)
	{
		$value = substr($value, 0, $length);
		return $value;
	}
}