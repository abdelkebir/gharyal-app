<?php
namespace Meigee\Glam\Model\Config\Source;

class HoverType implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
		return [
			  ['value' => 'default_hover', 'label' => __('Default')],
			  ['value' => 'type2_hover', 'label' => __('Type 2')],
			  ['value' => 'type3_hover', 'label' => __('Type 3')],
			  ['value' => 'type4_hover', 'label' => __('Type 4')],
			  ['value' => 'type5_hover', 'label' => __('Type 5')]
		];
    }
}
