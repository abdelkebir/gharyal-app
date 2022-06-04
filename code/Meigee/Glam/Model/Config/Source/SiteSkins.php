<?php
namespace Meigee\Glam\Model\Config\Source;

class SiteSkins implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'default.css', 'label' => __('Default'), 'img' => 'Meigee_Glam::images/default.jpg', 'header' => 'default'],
            ['value' => 'olivia.css', 'label' => __('Olivia'), 'img' => 'Meigee_Glam::images/olivia.jpg'],
            ['value' => 'sophia.css', 'label' => __('Sophia'), 'img' => 'Meigee_Glam::images/sophia.jpg'],
            ['value' => 'ava.css', 'label' => __('Ava'), 'img' => 'Meigee_Glam::images/ava.jpg'],
            ['value' => 'isabella.css', 'label' => __('Isabella'), 'img' => 'Meigee_Glam::images/isabella.jpg'],
            ['value' => 'mia.css', 'label' => __('Mia'), 'img' => 'Meigee_Glam::images/mia.jpg'],
            ['value' => 'emily.css', 'label' => __('Emily'), 'img' => 'Meigee_Glam::images/emily.jpg'],
            ['value' => 'harper.css', 'label' => __('Harper'), 'img' => 'Meigee_Glam::images/harper.jpg'],
            ['value' => 'charlotte.css', 'label' => __('Charlotte'), 'img' => 'Meigee_Glam::images/charlotte.jpg'],
            ['value' => 'abigail.css', 'label' => __('Abigail'), 'img' => 'Meigee_Glam::images/abigail.jpg'],
        ];
  }
}
