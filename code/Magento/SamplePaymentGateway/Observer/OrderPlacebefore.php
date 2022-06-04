<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\SamplePaymentGateway\Observer;

use Magento\Framework\Event\ObserverInterface;

class OrderPlacebefore implements ObserverInterface
{
 protected $_objectManager;

  public function __construct(
    \Magento\Framework\ObjectManagerInterface $objectManager
  ) {
      $this->_objectManager = $objectManager;
  }

  public function execute(\Magento\Framework\Event\Observer $observer)
  {
       echo  "Hello Testing 1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111";die();
  }
}