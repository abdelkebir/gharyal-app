<?php
namespace Godogi\Installment\Controller\Adminhtml\Request;

use Godogi\Installment\Controller\Adminhtml\Request;

class Edit extends Request
{
	/**
	* @return void
	*/
	public function execute()
	{
		$inId = $this->getRequest()->getParam('in_id');
		/*
		print_r($inId);
		echo 'Edit';
		exit();
		*/
		$model = $this->_requestFactory->create();
		if ($inId) {
			$model->load($inId);
			if (!$model->getId()) {
				$this->messageManager->addError(__('This installment request no longer exists.'));
				$this->_redirect('*/*/');
				return;
			}
		}
		// Restore previously entered form data from session
		$data = $this->_session->getRequestData(true);
		if (!empty($data)) {
			$model->setData($data);
		}
		$this->_coreRegistry->register('godogi_installment_request', $model);
		/** @var \Magento\Backend\Model\View\Result\Page $resultPage */
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('Godogi_Installment::requests');
		$resultPage->getConfig()->getTitle()->prepend(__('Installment Request'));
		return $resultPage;
	}
}
