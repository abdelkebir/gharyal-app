<?php

namespace Godogi\Installment\Block\Adminhtml\Request\Edit;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

class Tabs extends WidgetTabs
{
	/**
	* Class constructor
	*
	* @return void
	*/
	protected function _construct()
	{
		parent::_construct();
		$this->setId('request_edit_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(__('request Information'));
	}
	/**
	* @return $this
	*/
	protected function _beforeToHtml()
	{
		$this->addTab(
			'request_info',
			[
				'label' => __('General'),
				'title' => __('General'),
				'content' => $this->getLayout()->createBlock('Godogi\Installment\Block\Adminhtml\Request\Edit\Tab\Info')->toHtml(),
				'active' => true
			]
		);
		$this->addTab(
			'request_details',
			[
				'label' => __('Details'),
				'title' => __('Details'),
				'content' => 	$this->getLayout()
									->createBlock('Godogi\Installment\Block\Adminhtml\Details')
									->setTemplate('Godogi_Installment::details.phtml')
									->toHtml(),
				'active' => false
			]
		);
		return parent::_beforeToHtml();
	}
}