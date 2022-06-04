<?php
 
namespace AaLogics\Tcs\Controller\Index;
 
use Magento\Framework\App\Action\Context;
use Aalogics\Tcs\Model\System\OrderStatusOptions;
use Aalogics\Tcs\Block\System\Config\Form\Field\Costcenter;
 
class Index extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    protected $_orderStatus;
    protected $_costCenter;
    protected $_client;
 
    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        OrderStatusOptions $orderStatus,
        Costcenter $costCenter,
        \Aalogics\Tcs\Model\Carrier\Tcs $client
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_orderStatus = $orderStatus;
        $this->_costCenter = $costCenter;
        $this->_client = $client;

        parent::__construct($context);
    }
 
    public function execute()
    {
        // $resultPage = $this->_resultPageFactory->create();
        // return $resultPage;

        echo "index data";

        // $data = $this->_client->collectRates();

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $block = $objectManager->create('\Aalogics\Tcs\Block\Cities');

        $data = $block->getPakCities();

        // $data = $this->_orderStatus->toOptionArray();
        // $data = $this->_costCenter->getAddButtonHtml();
        echo "<pre>";
        print_r($data);
        die;

    }
}