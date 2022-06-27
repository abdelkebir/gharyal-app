<?php
namespace Godogi\Installment\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\UrlRewrite\Model\UrlRewriteFactory;
use Magento\UrlRewrite\Model\UrlRewrite;
use Magento\Ui\Component\MassAction\Filter;

use Godogi\Installment\Model\RequestFactory;
use Godogi\Installment\Model\ResourceModel\Request\CollectionFactory;

class Request extends Action
{
	/**
	* @var Filter
	*/
	protected $_filter;
	/**
	* @var UrlRewrite
	*/
	protected $_urlRewrite;
	/**
	* @var UrlRewriteFactory
	*/
	protected $_urlRewriteFactory;
	/**
	* Core registry
	*
	* @var \Magento\Framework\Registry
	*/
	protected $_coreRegistry;
	/**
	* Result page factory
	*
	* @var \Magento\Framework\View\Result\PageFactory
	*/
	protected $_resultPageFactory;
	/**
	* News model factory
	*
	* @var \Godogi\Installment\Model\requestFactory
	*/
	protected $_requestFactory;
	/**
	* @var CollectionFactory
	*/
	protected $_collectionFactory;
	protected $scopeConfig;
	protected $storeManager;
	protected $_transportBuilder;
	protected $inlineTranslation;
	protected $_productRepository;

	/**
	* @param Context $context
	* @param Registry $coreRegistry
	* @param PageFactory $resultPageFactory
	* @param RequestFactory $requestFactory
	* @param CollectionFactory $collectionFactory
	* @param UrlRewriteFactory $urlRewriteFactory
	* @param UrlRewrite $urlRewrite
	* @param Filter $filter
	*/
	public function __construct(
		Context $context,
		Registry $coreRegistry,
		PageFactory $resultPageFactory,
		RequestFactory $requestFactory,
		CollectionFactory $collectionFactory,
		UrlRewriteFactory $urlRewriteFactory,
		UrlRewrite $urlRewrite,
		Filter $filter,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
		\Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
		\Magento\Catalog\Model\ProductRepository $productRepository
	) {
		parent::__construct($context);
		$this->_coreRegistry = $coreRegistry;
		$this->_resultPageFactory = $resultPageFactory;
		$this->_requestFactory = $requestFactory;
		$this->_collectionFactory = $collectionFactory;
		$this->_urlRewriteFactory = $urlRewriteFactory;
		$this->_urlRewrite = $urlRewrite;
		$this->_filter = $filter;
		$this->storeManager = $storeManager;
		$this->_transportBuilder = $transportBuilder;
		$this->inlineTranslation = $inlineTranslation;
		$this->scopeConfig = $scopeConfig;
		$this->_productRepository = $productRepository;
	}

	public function execute()
	{
		return true;
	}

	/**
	* Qa access rights checking
	*
	* @return bool
	*/
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Godogi_Installment::requests');
	}

	public function getProductBySku($sku)
	{
		return $this->_productRepository->get($sku);
	}
}
