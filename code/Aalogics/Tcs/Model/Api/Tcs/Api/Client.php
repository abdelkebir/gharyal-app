<?php
namespace Aalogics\Tcs\Model\Api\Tcs\Api;

use \Magento\Framework\HTTP\ZendClientFactory;
use \Aalogics\Tcs\Model\Api\Tcs\Api\Endpoints\Connect;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Aalogics\Tcs\Logger\Logger;
use \Magento\Framework\HTTP\ZendClient;
use \Magento\Framework\App\Config\ConfigResource\ConfigInterface;
use \Magento\Framework\Xml\Parser;
use \Aalogics\Tcs\Helper\Data as TcsHelper;
use \Magento\Framework\Webapi\Soap\ClientFactory;

class Client extends \Magento\Framework\DataObject {
	
	/**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfigObject;

    /**
     * 
     * @var \Magento\Framework\App\Config\ConfigResource\ConfigInterface
     */
    protected $scopeConfigWriter;

    /**
     * @var \Aalogics\Tcs\Logger\Logger
     */
    protected $logger;

    /**
     * @var \Magento\Framework\HTTP\ZendClientFactory $clientFactory
     */
    protected $clientFactory;
    
    /**
     * 
     * @var \Aalogics\Tcs\Model\Api\EndpointFactory
     */
    protected $endpointFactory;
    
     /**
      * @var \Aalogics\Tcs\Helper\Data
      */
     protected $_helper;

     /**
      * @var \Aalogics\Tcs\Helper\Data
      */
     protected $curlClient;  

    /**
     * 
     * @var \Magento\Framework\Xml\Parser
     */
    protected $xmlHelper; 
	
	public function __construct(
			\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
			\Aalogics\Tcs\Logger\Logger $logger,
			\Magento\Framework\Webapi\Soap\ClientFactory $clientFactory,
			EndpointFactory $endpointFactory,
			ConfigInterface $scopeWriter,
			\Magento\Framework\HTTP\Client\Curl $curl,
			\Aalogics\Tcs\Helper\Data $TcsHelper,
			\Magento\Framework\Xml\Parser $xmlHelper,
			array $data = []
	) {
			$this->xmlHelper = $xmlHelper;
			$this->_helper = $TcsHelper;
			$this->scopeConfigWriter = $scopeWriter;
			$this->scopeConfigObject = $scopeConfig;
			$this->logger = $logger;
			$this->curlClient = $curl;
			$this->clientFactory = $clientFactory;		
			$this->endpointFactory = $endpointFactory;
			parent::__construct($data);
	}
	
	public function connect($username = null, $password = null, $sandbox = false, $forceCheck = false) {
		return $this;
	}
	
	public function makeRequest($endPoint , $params , $method) {

		$endPointObj = $this->endpointFactory->create($endPoint);
		$wsdl = $endPointObj->getWsdl();

		/* $headers = $endPointObj->makeRequestHeaders(array(
				'access_token' => $this->getData('access_token'),
				'source_identifier' => $this->scopeConfigObject->getValue('aaTcs/synnexb2b/api_source_identifier')
		)); */
		
		/** @var \Magento\Framework\HTTP\ZendClient $client */
		//$this->clientFactory->create($wsdl);

		$this->curlClient->setHeaders($endPointObj->makeRequestHeaders());

		$this->curlClient->setOption(CURLOPT_SSL_VERIFYHOST,false);


		$parameters = json_encode($endPointObj->makeRequestParams($params));
		
		if($method == "POST"){
			$this->curlClient->post($wsdl, $parameters);
			
		}
		elseif($method == "GET"){
			$this->curlClient->get($wsdl);	
		}
		//$this->curlClient->post($wsdl, $parameters);


		//$this->curlClient->makeRequest($method ,$wsdl, $parameters);



		
		
		$this->_helper->debug('Request URL',$wsdl);
		$this->_helper->debug('Request Params',$parameters);
		$this->_helper->debug('Request Endpoint',$endPointObj->getEndpoint());

// 		$client->setHeaders($headers);
		try {
			$response = $result = $this->curlClient->getBody();
			
			$this->_helper->debug('Client RAW Response',$response);
		} catch (\Exception $e) {
			$this->_helper->debug('Client Request', $client->__getLastRequest());
			$this->_helper->debug('Exception : ',$e->getMessage());
			throw new \Exception ( 'Exception : '.$e->getMessage() );
		}
		/* if (($response->getStatus() < 200 || $response->getStatus() > 210)) {
			$this->_helper->debug('Deployment marker request did not send a 200 status code.');
			throw new \Exception ( 'Deployment marker request did not send a 200 status code' );
		}*/
		
		
		$response = $endPointObj->parseOutput($response);
		$this->_helper->debug('Client Response',$response);

		return $response;
	}
}
