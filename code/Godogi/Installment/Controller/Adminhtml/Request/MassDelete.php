<?php
namespace Godogi\Installment\Controller\Adminhtml\Request;

use Godogi\Installment\Controller\Adminhtml\Request;

class MassDelete extends Request
{
	/**
	* @return void
	*/
	public function execute()
	{
		try {
			$collection = $this->_filter->getCollection($this->_collectionFactory->create());
			$collectionSize = $collection->getSize();
			foreach ($collection as $item) {
				$item->delete();
			}
			$this->messageManager->addSuccess(
				__('A total of %1 request(s) were deleted.', count(array($collectionSize)))
			);
			$this->_redirect('*/*/index');
		} catch (\Exception $e) {
			$this->messageManager->addError($e->getMessage());
		}
	}
}