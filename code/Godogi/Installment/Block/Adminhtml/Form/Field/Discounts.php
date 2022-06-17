<?php
namespace Godogi\Installment\Block\Adminhtml\Form\Field;
use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Godogi\Installment\Block\Adminhtml\Form\Field\TaxColumn;
use Godogi\Installment\Block\Adminhtml\Form\Field\CountryColumn;
/**
* Class Ranges
*/
class Discounts extends AbstractFieldArray
{
    /**
    * @var TaxColumn
    */
    private $taxRenderer;
    /**
    * @var CountryColumn
    */
    private $countryRenderer;
    /**
    * Prepare rendering the new field by adding all the needed columns
    */
    protected function _prepareToRender()
    {
        $this->addColumn('discount', ['label' => __('Discount'), 'class' => 'required-entry']);
        $this->addColumn('months', ['label' => __('Months'), 'class' => 'required-entry']);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }
}