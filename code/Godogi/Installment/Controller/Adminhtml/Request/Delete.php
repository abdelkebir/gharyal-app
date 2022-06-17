<?php
namespace Godogi\Installment\Controller\Adminhtml\Request;

use Godogi\Installment\Controller\Adminhtml\Request;

class Delete extends Request
{
	/**
	* @return void
	*/
	public function execute()
	{
		$inId = (int) $this->getRequest()->getParam('in_id');
		if ($inId) {
			$inModel = $this->_requestFactory->create();
			$inModel->load($inId);
			if (!$inModel->getId()) {
				$this->messageManager->addError(__('This installment request no longer exists.'));
			} else {
				try {
					$inModel->delete();
					$this->messageManager->addSuccess(__('The installment request has been deleted.'));
					$this->_redirect('*/*/');
					return;
				} catch (\Exception $e) {
					$this->messageManager->addError($e->getMessage());
					$this->_redirect('*/*/edit', ['in_id' => $inModel->getInId()]);
				}
			}
		}
	}
}