<?php
namespace Godogi\Installment\Controller\Adminhtml\Request;

use Godogi\Installment\Controller\Adminhtml\Request;

class Save extends Request
{
	/**
	* @return void
	*/
	public function execute()
	{
		$isPost = $this->getRequest()->getPost();
		if ($isPost) {
			$inModel = $this->_requestFactory->create();
			$inId = $this->getRequest()->getParam('in_id');
			if ($inId) {
				$inModel->load($inId);
			}
			$formData = $this->getRequest()->getParam('in');
			$inModel->setData($formData);
			
			try {
				// Save news
				$inModel->save();
				
				// Display success message
				$this->messageManager->addSuccess(__('The installment request has been saved.'));
				// Check if 'Save and Continue'
				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', ['in_id' => $inModel->getInId(), '_current' => true]);
					return;
				}
				// Go to grid page
				$this->_redirect('*/*/');
				return;
			} catch (\Exception $e) {
				$this->messageManager->addError($e->getMessage());
			}
			$this->_getSession()->setFormData($formData);
			$this->_redirect('*/*/edit', ['in_id' => $inId]);
		}
	}
}