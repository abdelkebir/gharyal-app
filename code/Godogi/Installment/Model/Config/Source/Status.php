<?php
namespace Godogi\Installment\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Status implements ArrayInterface
{
    public function toOptionArray()
    {
        $result = [];
        foreach ($this->getOptions() as $value => $label) {
            $result[] = [
                 'value' => $value,
                 'label' => $label,
             ];
        }

        return $result;
    }

    public function getOptions()
    {
        return [
            'submitted' => __('Submitted'),
            'under_review' => __('Under Review'),
            'approved' => __('Approved'),
            'rejected' => __('Rejected')
        ];
    }
}
