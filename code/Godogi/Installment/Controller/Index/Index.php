<?php
namespace Godogi\Installment\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Godogi\Installment\Model\RequestFactory;

class Index extends \Magento\Framework\App\Action\Action
{
  protected $resultFactory;
  protected $messageManager;
  protected $_mediaDirectory;
  protected $_fileUploaderFactory;
  protected $storeManager;
  protected $_transportBuilder;
  protected $inlineTranslation;
  protected $scopeConfig;
  protected $_productRepository;
  /**
	* Request model factory
	*
	* @var RequestFactory
	*/
	protected $_requestFactory;
    public function __construct(
        Context $context,
        \Magento\Framework\Controller\ResultFactory $resultFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        RequestFactory $requestFactory)
    {
        $this->resultFactory = $resultFactory;
        $this->messageManager = $messageManager;
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_requestFactory = $requestFactory;
        $this->storeManager = $storeManager;
        $this->_transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->scopeConfig = $scopeConfig;
        $this->_productRepository = $productRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        try{
            $post = $this->getRequest()->getPostValue();
            $target = $this->_mediaDirectory->getAbsolutePath('godogi/installment/request/');

            if(isset($post['file_cnic'])){
              $uploaderCnic = $this->_fileUploaderFactory->create(['fileId' => 'file_cnic']);
              $uploaderCnic->setAllowedExtensions(['jpg', 'pdf', 'doc', 'png', 'jpeg']);
              $uploaderCnic->setAllowRenameFiles(true);
              $resultCnic = $uploaderCnic->save($target);
            }

            if(isset($post['file_account'])){
              $uploaderAccount = $this->_fileUploaderFactory->create(['fileId' => 'file_account']);
              $uploaderAccount->setAllowedExtensions(['jpg', 'pdf', 'doc', 'png', 'jpeg']);
              $uploaderAccount->setAllowRenameFiles(true);
              $resultAccount = $uploaderAccount->save($target);
            }

            if(isset($post['file_bank'])){
              $uploaderBank = $this->_fileUploaderFactory->create(['fileId' => 'file_bank']);
              $uploaderBank->setAllowedExtensions(['jpg', 'pdf', 'doc', 'png', 'jpeg']);
              $uploaderBank->setAllowRenameFiles(true);
              $resultBank = $uploaderBank->save($target);
            }

            $templateOptions = array('area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => $this->storeManager->getStore()->getId());
            $templateVars = array(
            					'store' => $this->storeManager->getStore(),
            					'customer_name' => $post['first_name']
            				);
            $name = $this->scopeConfig->getValue('trans_email/ident_custom1/name',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
            $email = $this->scopeConfig->getValue('trans_email/ident_custom1/email',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
            $from = array('email' => $email, 'name' => $name);
            $this->inlineTranslation->suspend();
            $to = array($post['email']);
            $transport = $this->_transportBuilder->setTemplateIdentifier('mpsmtp_financing_request_email_template')
                				->setTemplateOptions($templateOptions)
                				->setTemplateVars($templateVars)
                				->setFrom($from)
                				->addTo($to)
                				->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();

            if(isset($post['file_cnic']) && isset($post['file_account']) && isset($post['file_bank'])){
              if ($resultCnic['file'] && $resultAccount['file'] && $resultBank['file']) {
                  $post["file_cnic"] = $resultCnic['file'];
                  $post["file_account"] = $resultAccount['file'];
                  $post["file_bank"] = $resultBank['file'];
              }
            }

            $requestModel = $this->_requestFactory->create();
            $requestModel->setData($post);
            $requestModel->save();

            /*
            $attributeCode = "reserved_for_installment";
            $attributeValue = 1;
            $product = $this->getProductBySku($post['rnumber']);
            $product->setData($attributeCode, $attributeValue);
            $this->_productRepository->save($product);
            */

            $this->messageManager->addSuccess(__("Your query will be answered within 48 working hours"));
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }

    public function getProductBySku($sku)
  	{
  		return $this->_productRepository->get($sku);
  	}
}
