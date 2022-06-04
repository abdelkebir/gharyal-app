<?php
namespace Aalogics\Tcs\Model\Api\Tcs\Api\Endpoints;
use Aalogics\Tcs\Model\Api\Tcs\Api\EndpointInterface;
use \Magento\Framework\DataObject;
use \Aalogics\Tcs\Helper\Data;

class Cod extends DataObject implements EndpointInterface {
	protected $_endpoint = 'cod/create-order';

	protected $_tcsHelper;

	protected $scopeConfigObject;

	const STATUS_SUCCESS = "SUCCESS";

	/**
	 *
	 * @var \Magento\Framework\Json\Helper\Data
	 */
	protected $jsonHelper;

	public function __construct(
			\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
			\Aalogics\Tcs\Helper\Data $tcsHelper,
			\Magento\Framework\Json\Helper\Data $jsonHelper,
			array $data = []
	) {
		$this->_tcsHelper = $tcsHelper;
		$this->scopeConfigObject = $scopeConfig;
		$data['wsdl'] = $this->_tcsHelper->getAdminField('tcs_cod/api_url'). $this->_endpoint;
		$data['endpoint'] = $this->_endpoint;
		$this->jsonHelper = $jsonHelper;
		parent::__construct($data);
	}

	public function makeRequestParams($parameters = []) {

		$params = array (
					'userName' => $this->_tcsHelper->getAdminField('tcs_cod/username'),
					'password' => $this->_tcsHelper->getAdminField('tcs_cod/password'),
					'costCenterCode' => $parameters['costcenter'],
					'consigneeName' => $parameters['consignee_name'],
					'consigneeAddress' => $parameters['consignee_address'],
					'consigneeMobNo' => $parameters['telephone'],
					'consigneeEmail' => $parameters['consignee_email'],
					'originCityName' => $this->_tcsHelper->getAdminField('tcs_setting_backend/city_name'),
					'destinationCityName' => trim($parameters['destination_city_name']),
					'pieces' => $parameters['qty'],
// 					'weight' => ($weight > 0 ) ? $weight : "0.5",
					'weight' => $parameters['weight'],
					'codAmount' => $parameters['grant_total'],
					'customerReferenceNo' => $parameters['order_id'],
					'productDetails' => $parameters['sku'],
					'fragile' => "YES",
					'services' => "O",
					'remarks' => isset($parameters['remarks'])?$parameters['remarks']:' ',
					'insuranceValue' => '10'
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

				'Accept' => 'application/json',
				'X-IBM-Client-Id' => $this->_tcsHelper->getAdminField('tcs_cod/api_key'),
				'Content-Type' => 'application/json'
		];

	}

	public function parseOutput($response) {
		$arrayResponse = $this->jsonHelper->jsonDecode($response);

		if($arrayResponse['returnStatus']['status'] == self::STATUS_SUCCESS){
			return (int) filter_var($arrayResponse['bookingReply']['result'], FILTER_SANITIZE_NUMBER_INT);
		}
		else{
			return $arrayResponse['returnStatus'];
		}

		
	}

}
