<?php

namespace Magento\SamplePaymentGateway\Model;

class Custom implements \Magento\Framework\Option\ArrayInterface
{ 
    /**
     * Return array of options as value-label pairs, eg. value => label
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            '0' => 'None',
            '1001' => 'Union Pay',
			'1002' => 'Cyber Source',
        ];
    }
}