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
			$inId = $this->getRequest()->getParam('request')['in_id'];
			if ($inId) {
				$inModel->load($inId);
			}
			$formData = $this->getRequest()->getParam('request');
			if ($inId) {
				/*
				echo '<pre>';
				print_r($inModel->getData());
				print_r($formData);
				echo '</pre>';
				*/
				if($inModel->getData()['status'] != $formData['status']){

					$templateOptions = array('area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => $this->storeManager->getStore()->getId());
					$status = '';
					$reserved = 1;
					if($formData['status'] == 'submitted'){
						$status = 'Submitted';
					}else if($formData['status'] == 'under_review'){
						$status = 'Under Review';
					}else if($formData['status'] == 'approved'){
						$status = 'Approved';
						$reserved = 0;
					}else if($formData['status'] == 'rejected'){
						$status = 'Rejected';
						$reserved = 0;
					}

					/*
					$attributeCode = "reserved_for_installment";
					$attributeValue = $reserved;
					$product = $this->getProductBySku($inModel->getData()['rnumber']);
					$product->setData($attributeCode, $attributeValue);
					$this->_productRepository->save($product);
					*/

					$templateVars = array(
										'store' => $this->storeManager->getStore(),
										'customer_name' => $inModel->getData()['first_name'],
										'status' => $status
									);
					$name = $this->scopeConfig->getValue('trans_email/ident_custom1/name',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
					$email = $this->scopeConfig->getValue('trans_email/ident_custom1/email',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
					$from = array('email' => $email, 'name' => $name);
					$this->inlineTranslation->suspend();
					$to = array($inModel->getData()['email']);
					$transport = $this->_transportBuilder->setTemplateIdentifier('mpsmtp_status_change_email_template')
											->setTemplateOptions($templateOptions)
											->setTemplateVars($templateVars)
											->setFrom($from)
											->addTo($to)
											->getTransport();
					$transport->sendMessage();
					$this->inlineTranslation->resume();
				}
			}
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
