<?php
namespace Aalogics\Tcs\Model\Api\Tcs\Api\Endpoints;
use Aalogics\Tcs\Model\Api\Tcs\Api\EndpointInterface;
use \Magento\Framework\DataObject;
use \Aalogics\Tcs\Helper\Data;

class Noncod extends DataObject implements EndpointInterface {
	protected $_endpoint = 'InsertInToTrack';
	
	protected $_tcsHelper;
	
	protected $scopeConfigObject;
	
	/**
	 *
	 * @var \Magento\Framework\Json\Helper\Data
	 */
	protected $jsonHelper;
	
	public function __construct(
			\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
			\Aalogics\Tcs\Helper\Data $tcsHelper,
			array $data = []
	) {
		$this->_tcsHelper = $tcsHelper;
		$this->scopeConfigObject = $scopeConfig;
		$data['wsdl'] = $this->_tcsHelper->getAdminField('tcs_non_cod/api_url');
		$data['endpoint'] = $this->_endpoint;
		parent::__construct($data);
	}
	
	public function makeRequestParams($parameters = []) {
		
		$params = array (
					'USERID' => $this->_tcsHelper->getAdminField('tcs_non_cod/username'),
					'API_KEY' => $this->_tcsHelper->getAdminField('tcs_non_cod/password'),
					'TCSAccountNo' => ($this->_tcsHelper->getAdminField('tcs_non_cod/costcenter_code'))?$this->_tcsHelper->getAdminField('tcs_non_cod/costcenter_code'):$parameters['costcenter'],
					'ConsigneeName' => $parameters['consignee_name'],
					'ConsigneeAddr1' => $parameters['consignee_address'],
					'ConsigneeAddr2' => $parameters['consignee_address'],
					'ConsigneePhone' => $parameters['telephone'],
					'ConsigneeCell' => $parameters['telephone'],
					'consigneeEmail' => $parameters['consignee_email'],
					'Destination' => $parameters['destination_city_name'],
					'Pieces' => $parameters['qty'],
// 					'Weight' => ($weight > 0 ) ? $weight : "0.5",
					'Weight' => $parameters['weight'],
					'COD_AMOUNT' => $parameters['grant_total'],
					'ReferenceNo' => $parameters['order_id'],
					'ServiceType' => "CO",
			);
		
		//remove empty array keys
		foreach ($params as $key => $param) {
			if(!$param && strlen($param) == 0 ) {
				unset($params[$key]);
			}
		}
		return $params;
	}
	
	public function makeRequestHeaders($parameters = []) {
		return [
				'Authorization-Token' => $parameters['access_token'],
				'Accept' => '*/*',
				'Accept-Encoding' => 'gzip, deflate',
				'Source-Identifier' => $parameters['source_identifier'],
				'User-Agent' => 'runscope/0.1',
				'Content-Type' => 'application/json'
		];
		
	}
	
	public function parseOutput($response) {
		$responseProperty = $this->getEndpoint().'Result';
		$responseString = $response->{$responseProperty};
		if(strpos('invalid', strtolower($responseString)) !== false){
			throw new \Exception ( 'Exception : '.$responseString );
		}
		return $responseString;
	
	}
	
}