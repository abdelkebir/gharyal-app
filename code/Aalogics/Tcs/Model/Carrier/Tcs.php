<?php

/**
 * @category    TCS
 * @package     Tcs_Cod
 * @author      AAlogics team <team@aalogics.com>
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Aalogics\Tcs\Model\Carrier;

use \Aalogics\Tcs\Helper\Data;
class Tcs extends \Magento\Shipping\Model\Carrier\AbstractCarrier implements \Magento\Shipping\Model\Carrier\CarrierInterface
{
	  protected $_code = 'aatcs';

    /**
     * @var \Magento\Shipping\Model\Tracking\Result\StatusFactory
     */
    protected $shippingTrackingResultStatusFactory;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;
    
    /**
     * @var \Aalogics\Tcs\Helper\Data
     */
    protected $_helper;

    public function __construct(
        \Magento\Shipping\Model\Tracking\Result\StatusFactory $shippingTrackingResultStatusFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
    	\Aalogics\Tcs\Helper\Data $helper	
    ) {
    	$this->_helper = $helper;
        $this->shippingTrackingResultStatusFactory = $shippingTrackingResultStatusFactory;
        $this->_scopeConfig = $scopeConfig;

    }
    public function collectRates(\Magento\Quote\Model\Quote\Address\RateRequest $request)
	{
		return false;
	}
 
	  public function getAllowedMethods()
	  {
	    return array(
	      'tcs' => 'TCS',
	    );
	  }
	 
		public function getTrackingInfo($tracking)
		{
			$track = $this->shippingTrackingResultStatusFactory->create();
			
			$externalUrl =  $this->_helper->getAdminField('tcs_cod/tracking_url');
	
			$track->setUrl($externalUrl . $tracking)
			->setTracking($tracking)
			->setCarrierTitle('TCS');
			return $track;
		}
		
		public function isTrackingAvailable()
		{
			return true;
		}
}
