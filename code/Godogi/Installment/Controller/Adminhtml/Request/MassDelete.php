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
				/*
				$attributeCode = "reserved_for_installment";
				$attributeValue = 0;
				$product = $this->getProductBySku($item->getRnumber());
				$product->setData($attributeCode, $attributeValue);
				$this->_productRepository->save($product);
				*/
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
