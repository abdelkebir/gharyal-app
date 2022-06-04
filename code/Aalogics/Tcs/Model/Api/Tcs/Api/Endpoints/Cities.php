<?php
namespace Aalogics\Tcs\Model\Api\Tcs\Api\Endpoints;
use Aalogics\Tcs\Model\Api\Tcs\Api\EndpointInterface;
use \Magento\Framework\DataObject;
use \Aalogics\Tcs\Helper\Data;
use \Magento\Framework\Xml\Parser;

class Cities extends DataObject implements EndpointInterface {
	protected $_endpoint = 'cod/cities';
	
	protected $_tcsHelper;
	
	protected $scopeConfigObject;
	
	 /**
     * 
     * @var \Magento\Framework\Xml\Parser
     */
    protected $xmlHelper;

    /**
	 *
	 * @var \Magento\Framework\Json\Helper\Data
	 */
	protected $jsonHelper;
	
	public function __construct(
			\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
			\Aalogics\Tcs\Helper\Data $tcsHelper, 
			\Magento\Framework\Json\Helper\Data $jsonHelper,
			\Magento\Framework\Xml\Parser $xmlHelper,
			array $data = []
	) {
		$this->_tcsHelper = $tcsHelper;
		$this->xmlHelper = $xmlHelper;
		$this->scopeConfigObject = $scopeConfig;
		$data['wsdl'] = $this->_tcsHelper->getAdminField('tcs_cod/api_url'). $this->_endpoint;
		$data['endpoint'] = $this->_endpoint;
		$this->jsonHelper = $jsonHelper;
		parent::__construct($data);
	}
	
	public function makeRequestParams($parameters = []) {
		
		$params = array();
		
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
				'X-IBM-Client-Id' => !is_null($this->_tcsHelper->getAdminField('tcs_cod/api_key'))? $this->_tcsHelper->getAdminField('tcs_cod/api_key') : "b29d7ac9-d807-40bd-89e9-3c0731c87bdf",
				'Content-Type' => 'application/json'
		];
		
	}
	
	public function parseOutput($response) {
		$arrayResponse = $this->jsonHelper->jsonDecode($response);

		return $arrayResponse['allCities'];
	}
	
}