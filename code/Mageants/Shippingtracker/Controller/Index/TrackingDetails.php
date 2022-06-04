<?php
 /**
  * @category   Mageants Shippingtracker
  * @package    Mageants_Shippingtracker
  * @copyright  Copyright (c) 2017 Mageants
  * @author     Mageants Team <support@Mageants.com>
  */
 
namespace Mageants\Shippingtracker\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;
use Magento\Sales\Model\ResourceModel\Order\Shipment\Track\CollectionFactory as TrackCollectionFactory;
use Magento\Sales\Api\Data\ShipmentTrackInterface;

class TrackingDetails extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\View\Result\LayoutFactor */
    protected $_shippingTracker;

    /**
     *  @var   \Magento\Framework\App\Action\Context::url()
     */
    protected $_url;

    /**
     *  @var   \Magento\Framework\App\Action\Context::request()
     */
    protected $_request;

    /**
     *  @var   \Magento\Shipping\Helper\Data
     */
    protected $_helper;
    /**
     *  @var   TrackCollectionFactory
     */
    protected $trackingCollection;

    /**
     *  @param    \Magento\Framework\App\Action\Context $context
     *  @param   \Mageants\Shippingtracker\Block\Shippingtracker $shippingtracker
     *  @param   \Magento\Shipping\Helper\Data $helper
     *  @param   TrackCollectionFactory $collectionFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Mageants\Shippingtracker\Block\Shippingtracker $shippingtracker,
        \Mageants\Shippingtracker\Helper\Data $shippingTrackerHelper,
        \Magento\Shipping\Helper\Data $helper,
        TrackCollectionFactory $collectionFactory
    ) {
        $this->_url = $context->getUrl();
        $this->_shippingTracker = $shippingtracker;
        $this->shippingTrackerHelper = $shippingTrackerHelper;
        $this->_request = $context->getRequest();
        $this->_helper  = $helper;
        $this->trackingCollection = $collectionFactory->create();
        parent::__construct($context);
    }
    /**
     * Shippingtracker Page
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $disabledCarrier = $this->shippingTrackerHelper->getDisabledCarrier();
        $disabledCarrierMessage = $this->shippingTrackerHelper->getDisabledCarrierMessage();
        $carrierCode = "";
        if ($this->_request->getPost('trackingid') != null) {
            $this->trackingCollection
                ->addFieldToFilter(ShipmentTrackInterface::TRACK_NUMBER, $this->_request->getPost('trackingid'));
            $tracking = $this->trackingCollection;
            foreach ($tracking as $trackingData) {
                $trackingDetails = $this->_shippingTracker->getOrderdetails($trackingData->getOrderId());
            }
            if (isset($trackingDetails)) {
                $trackCollect = $trackingDetails->getTracksCollection();
                foreach ($trackCollect as $track) {
                    $carrierTitle = $track->getTitle();
                    $carrierCode = $track->getCarrierCode();
                }
            }
            if (isset($trackingDetails) && !in_array($carrierCode, $disabledCarrier)) {
                $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
                $details = array('tracking_count'=>$trackingDetails->getTracksCollection()->count(),'shippingurl'=>$this->_helper->getTrackingPopupUrlBySalesModel($trackingDetails));
                return $resultJson->setData($details);
            } else {
                if (isset($carrierTitle)) {
                    $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
                    $shipping_code  = '{{shipping_method_title}}';
                    if (strpos($disabledCarrierMessage, $shipping_code) !== false) {
                        $message = str_replace($shipping_code, $carrierTitle, $disabledCarrierMessage);
                    } else {
                        $message = $disabledCarrierMessage;
                    }
                    $details = array('shipping_method_disabled'=>1,'carrier_message'=>$message);
                    return  $resultJson->setData($details);
                }
            }
        } else {
            $trackingDetails = $this->_shippingTracker->getOrderdetails($this->_request->getPost('orderid'), $this->_request->getPost('email'));
            if (isset($trackingDetails)) {
                $trackCollect = $trackingDetails->getTracksCollection();
                foreach ($trackCollect as $track) {
                    $carrierTitle = $track->getTitle();
                    $carrierCode = $track->getCarrierCode();
                }
            }
            if (isset($trackingDetails) && !in_array($carrierCode, $disabledCarrier)) {
                $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
                if (array_key_exists('tracking_error_message', $trackingDetails)) {
                    return $resultJson->setData($trackingDetails);
                }
                $details = array('tracking_count'=>$trackingDetails->getTracksCollection()->count(),'shippingurl'=>$this->_helper->getTrackingPopupUrlBySalesModel($trackingDetails));
                return  $resultJson->setData($details);
            } else {
                if (isset($carrierTitle)) {
                    $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
                    $shipping_code  = '{{shipping_method_title}}';
                    if (strpos($disabledCarrierMessage, $shipping_code) !== false) {
                        $message = str_replace($shipping_code, $carrierTitle, $disabledCarrierMessage);
                    } else {
                        $message = $disabledCarrierMessage;
                    }
                    $details = array('shipping_method_disabled'=>1,'carrier_message'=>$message);
                    return  $resultJson->setData($details);
                }
            }
        }
    }
}
