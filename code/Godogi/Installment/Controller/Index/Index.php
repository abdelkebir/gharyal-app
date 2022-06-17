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
        RequestFactory $requestFactory)
    {
        $this->resultFactory = $resultFactory;
        $this->messageManager = $messageManager;
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_requestFactory = $requestFactory;
        parent::__construct($context);
    }

    public function execute()
    {   
        try{
            $post = $this->getRequest()->getPostValue();

            $target = $this->_mediaDirectory->getAbsolutePath('godogi/installment/request/');

            $uploaderCnic = $this->_fileUploaderFactory->create(['fileId' => 'file_cnic']);
            $uploaderCnic->setAllowedExtensions(['jpg', 'pdf', 'doc', 'png', 'jpeg']);
            $uploaderCnic->setAllowRenameFiles(true);
            $resultCnic = $uploaderCnic->save($target);

            $uploaderAccount = $this->_fileUploaderFactory->create(['fileId' => 'file_account']);
            $uploaderAccount->setAllowedExtensions(['jpg', 'pdf', 'doc', 'png', 'jpeg']);
            $uploaderAccount->setAllowRenameFiles(true);
            $resultAccount = $uploaderAccount->save($target);

            $uploaderBank = $this->_fileUploaderFactory->create(['fileId' => 'file_bank']);
            $uploaderBank->setAllowedExtensions(['jpg', 'pdf', 'doc', 'png', 'jpeg']);
            $uploaderBank->setAllowRenameFiles(true);
            $resultBank = $uploaderBank->save($target);

            if ($resultCnic['file'] && $resultAccount['file'] && $resultBank['file']) {
                $post["file_cnic"] = $resultCnic['file'];
                $post["file_account"] = $resultAccount['file'];
                $post["file_bank"] = $resultBank['file'];

                $requestModel = $this->_requestFactory->create();
                $requestModel->setData($post);
                $requestModel->save();
            }
            $this->messageManager->addSuccess(__("Your query will be answered within 48 working hours"));
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}