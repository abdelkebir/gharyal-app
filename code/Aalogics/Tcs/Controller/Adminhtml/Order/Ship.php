<?php

/**
 * Copyright © Aalogics Ltd. All rights reserved.
 *
 * @package    Aalogics_Trax
 * @copyright  Copyright © Aalogics Ltd (http://www.aalogics.com)
 */

namespace Aalogics\Tcs\Controller\Adminhtml\Order;

use Magento\Framework\App\Action\Context;
use Magento\Sales\Api\OrderRepositoryInterface;

class Ship extends \Magento\Framework\App\Action\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Aalogics_Tcs::ship';

    protected $_traxOrderManager;

    protected $_traxHelper;
    protected $orderRepository;
    protected $_resultJsonFactory;
    protected $_coreRegistry = null;

    public function __construct(
        Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Aalogics\Tcs\Model\OrderManager $traxModel,
        \Aalogics\Tcs\Helper\Data $traxHelper,
        OrderRepositoryInterface $orderRepository,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_traxOrderManager   = $traxModel;
        $this->_traxHelper         = $traxHelper;
        $this->orderRepository    = $orderRepository;
        $this->_resultJsonFactory = $resultJsonFactory;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Hold order
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        $resultJson = $this->_resultJsonFactory->create();

        $city = $this->getRequest()->getParam('city_field');

        $costCenter = $this->getRequest()->getParam('costcenter');

        $shipOrders     = array();
        $alreadyShipped = array();

        if ($this->_traxHelper->isEnabled()) {
            $order = $this->_initOrder();

            if ($order) {

                $shipment            = $order->getShipmentsCollection()->getFirstItem();
                $shipmentIncrementId = $shipment->getIncrementId();

                // Redirect to Order View
                $resultRedirect->setPath('sales/order/view', ['order_id' => $order->getId()]);

                $redirectUrl = $this->_url->getUrl('sales/order/view', ['order_id' => $order->getId()]);
                
                if ($shipmentIncrementId == null && $order->canShip()) {
                    $shipOrders[] = $order;
                } else {
                    $alreadyShipped[] = $order;
                }

                $message = '';
                if (count($alreadyShipped) > 0) {
                    $message = __("Something went wrong while creating shipment for the selected order(s) : ");
                    for ($x = 0; $x < count($alreadyShipped); $x++) {
                        $message .= $alreadyShipped[$x]->getIncrementId();
                        if (!$x == (count($alreadyShipped) - 1)) {
                            $message .= ', ';
                        }

                    }

                }

                if (!empty($message)) {
                    $this->messageManager->addError($message);
                    return $resultJson->setData([
                        'returnUrl' => $redirectUrl,
                        'message'   => $message,
                    ]);
                }


                if ($this->_traxHelper->isEnabled()) {

                    $this->_traxHelper->debug('massAction invoiceandShipAll start');
                    // Process Shipments
                    $result = $this->_traxOrderManager->shipAll(
                        $shipOrders,
                        false,
                        false,
                        false,
                        [],
                        [],
                        $costCenter,
                        $city
                    );

                    // Add results to session
                    $this->addResultsToSession($result);

                    return $resultJson->setData([
                        'returnUrl' => $redirectUrl,
                        'message'   => $result,
                    ]);

                } else {
                    $this->messageManager->addError('Trax Shippement Not Enabled');

                    return $resultJson->setData([
                        'returnUrl' => $redirectUrl,
                        'message'   => 'Trax Shippement Not Enabled',
                    ]);
                }

                // return $resultRedirect;
            }

        } else {
            $this->messageManager->addError('Trax is Not Enabled');
            return $resultJson->setData([
                'returnUrl' => $redirectUrl,
                'message'   => 'Trax is Not Enabled',
            ]);
        }

        $resultRedirect->setPath('sales/*/');
        return $resultJson->setData([
            'returnUrl' => $redirectUrl,
            'message'   => '',
        ]);
        // return $resultRedirect;
    }

    /**
     * add both error and success message to admin session
     *
     * @param $result
     * @param $successMessage
     */
    public function addResultsToSession($result)
    {
        if (!empty($result['errors'])) {
            $this->messageManager->addError(implode('<br/>', $result['errors']));
        }
        if (!empty($result['successes'])) {
            $this->messageManager->addSuccess(implode(',', $result['successes']));
        }
    }

    protected function _initOrder()
    {
        $id = $this->getRequest()->getParam('order_id');

        try {
            $order = $this->orderRepository->get($id);
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addError(__('This order no longer exists.'));
            $this->_actionFlag->set('', self::FLAG_NO_DISPATCH, true);
            return false;
        } catch (InputException $e) {
            $this->messageManager->addError(__('This order no longer exists.'));
            $this->_actionFlag->set('', self::FLAG_NO_DISPATCH, true);
            return false;
        }
        $this->_coreRegistry->register('sales_order', $order);
        $this->_coreRegistry->register('current_order', $order);
        return $order;
    }

}
