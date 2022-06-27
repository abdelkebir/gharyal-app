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

class Info extends Generic implements TabInterface
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
			['legend' => __('General')]
		);
		if ($model->getId()) {
			$fieldset->addField(
				'in_id',
				'hidden',
				['name' => 'in_id']
			);
		}
		$fieldset->addField(
        'status',
        'select',
        [
            'name' => 'status',
            'label' => __('Status'),
            'title' => __('Status'),
            'values' => [
                ['label' => __('Submitted'), 'value' => 'submitted'],
                ['label' => __('Under Review'), 'value' => 'under_review'],
                ['label' => __('Approved'), 'value' => 'approved'],
								['label' => __('Rejected'), 'value' => 'rejected']
            ]
        ]
    );
		$fieldset->addField(
			'rnumber',
			'label',
			[
				'name' => 'rnumber',
				'label' => __('Ref. no.')
			]
		);
		$fieldset->addField(
			'coupon',
			'label',
			[
				'name' => 'coupon',
				'label' => __('Coupon')
			]
		);
		$fieldset->addField(
			'last_name',
			'label',
			[
				'name' => 'last_name',
				'label' => __('Last Name')
			]
		);
		$fieldset->addField(
			'first_name',
			'label',
			[
				'name' => 'first_name',
				'label' => __('First Name')
			]
		);
		$fieldset->addField(
			'gender',
			'label',
			[
				'name' => 'gender',
				'label' => __('Gender')
			]
		);
		$fieldset->addField(
			'monthly_income',
			'label',
			[
				'name' => 'monthly_income',
				'label' => __('Monthly Income')
			]
		);
		$fieldset->addField(
			'cnic',
			'label',
			[
				'name' => 'cnic',
				'label' => __('CNIC')
			]
		);
		$fieldset->addField(
			'email',
			'label',
			[
				'name' => 'email',
				'label' => __('Email')
			]
		);
		$fieldset->addField(
			'address',
			'label',
			[
				'name' => 'address',
				'label' => __('Address')
			]
		);
		$fieldset->addField(
			'zip_code',
			'label',
			[
				'name' => 'zip_code',
				'label' => __('ZIP CODE')
			]
		);
		$fieldset->addField(
			'location',
			'label',
			[
				'name' => 'location',
				'label' => __('Location')
			]
		);
		$fieldset->addField(
			'date_birth',
			'label',
			[
				'name' => 'date_birth',
				'label' => __('Date of birth')
			]
		);
		$fieldset->addField(
			'phone_number',
			'label',
			[
				'name' => 'phone_number',
				'label' => __('Phone Number')
			]
		);
		$fieldset->addField(
			'professional_situation',
			'label',
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
