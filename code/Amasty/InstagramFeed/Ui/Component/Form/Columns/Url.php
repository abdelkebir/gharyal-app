<?php

namespace Amasty\InstagramFeed\Ui\Component\Form\Columns;

use Magento\Ui\Component\Form\Field;

class Url extends Field
{
    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        $dataSource['data'][$this->getName()] = sprintf(
            '<a href="%1$s" target="_blank">%1$s</a>',
            $dataSource['data'][$this->getName()]
        );
        return parent::prepareDataSource($dataSource);
    }
}
