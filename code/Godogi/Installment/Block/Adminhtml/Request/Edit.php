<?php
namespace Godogi\Installment\Block\Adminhtml\Request;

use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

class Edit extends Container
{
	/**
	* Core registry
	*
	* @var \Magento\Framework\Registry
	*/
	protected $_coreRegistry = null;
	/**
	* @param Context $context
	* @param Registry $registry
	* @param array $data
	*/
	public function __construct(
		Context $context,
		Registry $registry,
		array $data = []
	) {
		$this->_coreRegistry = $registry;
		parent::__construct($context, $data);
	}
	/**
	* Class constructor
	*
	* @return void
	*/
	protected function _construct()
	{
		$this->_objectId = 'id';
		$this->_controller = 'adminhtml_request';
		$this->_blockGroup = 'Godogi_Installment';
		parent::_construct();
		/*
		$this->removeButton('save');

		*/
		$this->removeButton('reset');
		$this->buttonList->update('save', 'label', __('Save'));
		/*
		$this->buttonList->add(
			'saveandcontinue',
			[
				'label' => __('Save and Continue Edit'),
				'class' => 'save',
				'data_attribute' => [
					'mage-init' => [
						'button' => [
							'event' => 'saveAndContinueEdit',
							'target' => '#edit_form'
						]
					]
				]
			],
		-100
		);
		*/
		$this->buttonList->update('delete', 'label', __('Delete'));

	}


}
