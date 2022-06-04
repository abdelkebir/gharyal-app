<?php
namespace Aalogics\Tcs\Block\Checkout;


use Magento\Directory\Helper\Data as DirectoryHelper;

class LayoutProcessor implements \Magento\Checkout\Block\Checkout\LayoutProcessorInterface
{

    /**
     * @var DirectoryHelper
     */
    protected $directoryHelper;


    protected $_request;

    protected $_cityOption;


    protected $_helper;


    public function __construct(
       \Aalogics\Tcs\Model\Source\Cityoptions $cityOption,
       \Aalogics\Tcs\Helper\Data $_helper,
        DirectoryHelper $directoryHelper
    ) {
        $this->directoryHelper = $directoryHelper;
        $this->_cityOption  = $cityOption;
        $this->_helper = $_helper;
    }

    /**
     * @param array $result
     * @return array
     */
    public function process($result)
    {


        // $elements = [
        // 'city' => [
        //     'visible' => true,
        //     'formElement' => 'select',
        //     'label' => __('City'),
        //     'value' =>  '',
        //     'options' => array_option(),
        // ],

        if( $this->_helper->isCitiesEnabled() ){

             if ($result['components']['checkout']['children']['steps']
            ['children']['shipping-step']['children']['shippingAddress'])
            {

                $shippingAddressFieldSet = $result['components']['checkout']['children']['steps']
                ['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'];

                $streetSortOrder = $result['components']['checkout']['children']['steps']
                ['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['country_id']['sortOrder'];

                $cities = $this->_cityOption->getTcsCities();

                $cityOptions[] = ['label' => 'Please Select..', 'value' => ''];
                foreach ($cities as $field) {
                    $cityOptions[] = ['label' => $field['default_name'], 'value' => $field['default_name']];
                }

                // $options = '';
                // foreach($regionOptions as $city){
                //     $isSelected = $selectedCity == $city ? ' selected="selected"' : null;
                //     $options .= '<option value="' . $city . '"' . $isSelected . '>' . $city . '</option>';
                // }
                // return $options;

                // $this->_helper->debug('Cities List',$regionOptions);
               // $this->_helper->debug('Cities Enter',$regionOptions);

                $shippingAddressFieldSet['region_id'] = '';
                $shippingAddressFieldSet['region'] = '';

                // $result['components']['checkout']['children']['steps']
                // ['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'] = $shippingAddressFieldSet;

                $result['components']['checkout']['children']['steps']
                ['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['city_id'] = [
                    'component' => 'Magento_Ui/js/form/element/select',
                    'config' => [
                        'customScope' => 'shippingAddress',
                        'template' => 'ui/form/field',
                        'elementTmpl' => 'Aalogics_Tcs/select',
                        'id' => 'drop-down',
                        'additionalClasses' => 'city-drop-down',
                    ],
                    'dataScope' => 'shippingAddress.city',
                    'label' => 'City',
                    'provider' => 'checkoutProvider',
                    'visible' => true,
                    'sortOrder' => $streetSortOrder + 1,
                    'id' => 'city-drop-down',
                    'options' => $cityOptions
                ];

             $result['components']['checkout']['children']['steps']
                ['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['city'] =   [
                                            'component' => 'Magento_Ui/js/form/element/abstract',
                                            'config' => [
                                                // customScope is used to group elements within a single form (e.g. they can be validated separately)
                                                'template' => 'ui/form/field',
                                                'elementTmpl' => 'ui/form/element/input',
                                                'additionalClasses' => 'city-input-box'
                                            ],
                                            'dataScope' => 'shippingAddress.city',
                                            'label' => 'City',
                                            'provider' => 'checkoutProvider',
                                            'sortOrder' => $streetSortOrder + 1,
                                            'validation' => [
                                               'required-entry' => true
                                            ],
                                            'options' => [],
                                            'visible' => false,
                                        ];



            }
        }
           
           // $this->_helper->debug('Cities Data',$result);
            return $result;


    }


}
