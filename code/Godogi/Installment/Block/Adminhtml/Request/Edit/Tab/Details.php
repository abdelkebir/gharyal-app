<?php
namespace Godogi\Installment\Block\Adminhtml\Request\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
use Godogi\Installment\Helper\Data as InstallmentData;
use Magento\Store\Model\StoreManagerInterface;

class Details extends Generic implements TabInterface
{
	protected $_installmentHelper;
	/**
	* @var \Magento\Cms\Model\Wysiwyg\Config
	*/
	protected $_wysiwygConfig;
	protected $_storeManager;
	
	/**
	* @param Context $context
	* @param Registry $registry
	* @param FormFactory $formFactory
	* @param Config $wysiwygConfig
	* @param array $data
	*/
	public function __construct(
		Context $context,
		Registry $registry,
		FormFactory $formFactory,
		Config $wysiwygConfig,
		InstallmentData $installmentHelper,
		StoreManagerInterface $storemanager, 
		array $data = []
	) {
		$this->_installmentHelper = $installmentHelper;
		$this->_wysiwygConfig = $wysiwygConfig;
		$this->_storeManager = $storemanager;
		parent::__construct($context, $registry, $formFactory, $data);
	}
	/**
	* Prepare form fields
	*
	* @return \Magento\Backend\Block\Widget\Form
	*/
	protected function _prepareForm()
	{
		/** @var $model \Godogi\Installment\Model\Request */
		$model = $this->_coreRegistry->registry('godogi_installment_request');
		/** @var \Magento\Framework\Data\Form $form */
		$form = $this->_formFactory->create();
		$form->setHtmlIdPrefix('request_');
		$form->setFieldNameSuffix('request');
		$fieldset = $form->addFieldset(
			'base_fieldset',
			['legend' => __('Details')]
		);
        $fieldset->addField(
			'product_price',
			'text',
			[
				'name' => 'product_price',
				'label' => __('Product Price'),
                'value' => "CCCCCCCC"
			]
		);
		$fieldset->addField(
			'calc_discount',
			'text',
			[
				'name' => 'calc_discount',
				'label' => __('Discount %')
			]
		);
		$fieldset->addField(
			'calc_months',
			'text',
			[
				'name' => 'calc_months',
				'label' => __('Months')
			]
		);
		
		$fieldset->addField(
			'address',
			'text',
			[
				'name' => 'address',
				'label' => __('Address')
			]
		);
		$fieldset->addField(
			'zip_code',
			'text',
			[
				'name' => 'zip_code',
				'label' => __('ZIP CODE')
			]
		);
		$fieldset->addField(
			'location',
			'text',
			[
				'name' => 'location',
				'label' => __('Location')
			]
		);
		$fieldset->addField(
			'date_birth',
			'text',
			[
				'name' => 'date_birth',
				'label' => __('Date of birth')
			]
		);
		$fieldset->addField(
			'phone_number',
			'text',
			[
				'name' => 'phone_number',
				'label' => __('Phone Number')
			]
		);
		$fieldset->addField(
			'professional_situation',
			'text',
			[
				'name' => 'professional_situation',
				'label' => __('Professional Situation')
			]
		);
		
		$fieldset->addType('custom_link','Godogi\Installment\Data\Form\Element\MyLink');
		$fieldset->addField(
			'file_cnic',
			'custom_link',
			[
				'name' => 'file_cnic',
				'label' => __('CNIC'),
				'title' => __('CNIC')
			]
		);
		$fieldset->addField(
			'file_account',
			'custom_link',
			[
				'name' => 'file_account',
				'label' => __('Account Maintenance Certificate'),
				'title' => __('Account Maintenance Certificate')
			]
		);
		$fieldset->addField(
			'file_bank',
			'custom_link',
			[
				'name' => 'file_bank',
				'label' => __('Bank Statement'),
				'title' => __('Bank Statement')
			]
		);
		$fieldset->addField(
			'agree',
			'select',
			[
				'options' => ['0' => __('Not Agreed'), '1' => __('Agreed')],
				'name' => 'agree',
				'label' => __('General terms and conditions')
			]
		);
		$data = $model->getData();
		$form->setValues($data);
		$this->setForm($form);
		return parent::_prepareForm();
	}
	/**
	* Prepare label for tab
	*
	* @return string
	*/
	public function getTabLabel()
	{
		return __('Request Info');
	}
	/**
	* Prepare title for tab
	*
	* @return string
	*/
	public function getTabTitle()
	{
		return __('Request Info');
	}
	/**
	* {@inheritdoc}
	*/
	public function canShowTab()
	{
		return true;
	}
	/**
	* {@inheritdoc}
	*/
	public function isHidden()
	{
		return false;
	}
}