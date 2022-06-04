<?php

namespace Amasty\InstagramFeed\Ui\Component\Listing\Columns;

class Store extends \Magento\Store\Ui\Component\Listing\Column\Store
{
    /**
     * @param array $item
     * @return \Magento\Framework\Phrase|string
     */
    protected function prepareItem(array $item)
    {
        if (!is_array($item[$this->storeKey])) {
            $item[$this->storeKey] = [$item[$this->storeKey]];
        }

        return parent::prepareItem($item);
    }
}
