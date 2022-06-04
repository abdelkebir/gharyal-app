<?php
namespace Aalogics\Tcs\Model\Api\Tcs\Api;
use \Magento\Framework\Model\AbstractModel;
use \Aalogics\Tcs\Model\Api\Tcs\Api\Client;
use \Aalogics\Tcs\Helper\Data;
use \Magento\Framework\DataObject;
use \Magento\Framework\HTTP\ZendClient;

class Request extends DataObject {
	
	/**
	 * HTTP Client
	 * @var client
	 */
	protected $client;
	
	/**
	 * Helper
	 * @var \Aalogics\Tcs\Helper\Data
	 */
	protected $helper;
	
	/**
	 * 
	 * @param \Aalogics\Tcs\Model\Api\Tcs\Api\Client $client
	 * @param \Aalogics\Tcs\Logger\Logger $logger
	 */
	public function __construct(
		\Aalogics\Tcs\Model\Api\Tcs\Api\Client $client,
		\Aalogics\Tcs\Helper\Data $helper
	) {
		$this->client = $client;
		$this->helper = $helper;
	}	
	
	/**
	 * 
	 * @return boolean|\Magento\Customer\Model\Data\Customer
	 */
	public function trackCodOrder($parameters) {
		if (!$trackingId = $this->_trackCodOrder ($parameters)) {
			return false;
		}
	
		return $trackingId;
	}
	

	/**
	 *
	 * @return boolean|\Magento\Customer\Model\Data\Customer
	 */
	public function trackNonCodOrder($parameters) {
		if (!$products = $this->_trackNonCodOrder ($parameters)) {
			return false;
		}
	
		return $products;
	}
	
	/**
	 *
	 * @return boolean|\Magento\Customer\Model\Data\Customer
	 */
	public function getCities() {
		if (!$products = $this->_fetchCities ()) {
			return false;
		}
	
		return $products;
	}
	
	/**
	 * Connect to Tcs and sync products.
	 *
	 * @throws Exception
	 */
	protected function _trackCodOrder($parameters) {
		try {
			if ($this->client->connect ()) {
				$this->helper->debug('_trackCodOrder start');
				//check if customer exists , if exists send update request else create request
				$response = $this->client->makeRequest(
						\Aalogics\Tcs\Model\Api\Tcs\Api\Endpoints\Cod::class, 
						$this->_makeRequestArray('cod_order',$parameters),
						\Zend_Http_Client::POST
				);
			} else {
				throw new \Exception ( 'Unable to connect to TCS' );
			}
			return $response;
		} catch ( \Exception $e ) {
			throw $e;
		}
	
	}
	
	/**
	 * Connect to Tcs and sync cities.
	 *
	 * @throws Exception
	 */
	protected function _fetchCities() {
		try {
			if ($this->client->connect ()) {
				$this->helper->debug('_fetchCities start');
				//check if customer exists , if exists send update request else create request
				$response = $this->client->makeRequest(
						\Aalogics\Tcs\Model\Api\Tcs\Api\Endpoints\Cities::class,
						[],
						\Zend_Http_Client::GET 
				);
				if(count($response) > 0) {
					return $response;
				}else {
					$this->helper->debug('Response',$response);
					throw new \Exception ( 'Unable to fetch cities' );
				}
			} else {
				throw new \Exception ( 'Unable to connect to TCS' );
			}
		} catch ( \Exception $e ) {
			throw $e;
		}
	
	}
	
	/**
	 * Connect to Tcs and sync products.
	 *
	 * @throws Exception
	 */
	protected function _trackNonCodOrder($parameters) {
		try {
			if ($this->client->connect ()) {
				$this->helper->debug('_trackCodOrder start');
				//check if customer exists , if exists send update request else create request
				$response = $this->client->makeRequest(
						\Aalogics\Tcs\Model\Api\Tcs\Api\Endpoints\Cod::class,
						$this->_makeRequestArray('cod_order',$parameters),
						\Zend_Http_Client::POST 
				);
				/*if($response['corpTcs']['response'] == 'OK') {
					return TRUE;
				}else {
					$this->helper->debug('Response',$response);
					throw new \Exception ( 'Unable to deliver message' );
				}*/
			} else {
				throw new \Exception ( 'Unable to connect to Telenor' );
			}
		} catch ( \Exception $e ) {
			throw $e;
		}
	
	}
	
	
	/**
	 * 
	 * @param unknown $type
	 * @param unknown $parameters
	 * @return multitype:NULL string unknown Ambigous <string, unknown>
	 */
	protected function _makeRequestArray($type, $parameters = []) {
		$result = [];
		
		switch ($type) {
			case 'cod_order':
				$result = $parameters;
				break;
			case 'non_cod_order':
				$result = $parameters;
				break;
		}
		return $result;
	}
}