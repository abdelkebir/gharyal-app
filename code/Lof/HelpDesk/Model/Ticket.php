<?php
/**
 * Landofcoder
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Landofcoder.com license that is
 * available through the world-wide-web at this URL:
 * http://landofcoder.com/license
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category   Landofcoder
 * @package    Lof_HelpDesk
 * @copyright  Copyright (c) 2017 Landofcoder (http://www.landofcoder.com/)
 * @license    http://www.landofcoder.com/LICENSE-1.0.html
 */

namespace Lof\HelpDesk\Model;

class Ticket extends \Magento\Framework\Model\AbstractModel implements \Lof\HelpDesk\Api\Data\TicketInterface
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    protected function _construct()
    {
        $this->_init('Lof\HelpDesk\Model\ResourceModel\Ticket');
    }

    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    /**
     * Get ticket_id
     * @return int|null
     */
    public function getTicketID()
    {
        return $this->getData(self::TICKET_ID);
    }

    /**
     * Set ticket_id
     * @param int $ticket_id
     * @return \Lof\HelpDesk\Api\Data\TicketInterface
     */
    public function setTicketID($ticket_id)
    {
        return $this->setData(self::TICKET_ID, $ticket_id);
    }

    /**
     * Get subject
     * @return string|null
     */
    public function getSubject()
    {
        return $this->getData(self::SUBJECT);
    }

    /**
     * Set subject
     * @param string $subject
     * @return \Lof\HelpDesk\Api\Data\TicketInterface
     */
    public function setSubject($subject)
    {
        return $this->setData(self::SUBJECT, $subject);
    }

    /**
     * Get description
     * @return string|null
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * Set description
     * @param string $description
     * @return \Lof\HelpDesk\Api\Data\TicketInterface
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * Get status_id
     * @return int|null
     */
    public function getStatusId()
    {
        return $this->getData(self::STATUS_ID);
    }

    /**
     * Set status_id
     * @param int $status_id
     * @return \Lof\HelpDesk\Api\Data\TicketInterface
     */
    public function setStatusId($status_id)
    {
        return $this->setData(self::STATUS_ID, $status_id);
    }

    /**
     * Get customer_email
     * @return string|null
     */
    public function getCustomerEmail()
    {
        return $this->getData(self::CUSTOMER_EMAIL);
    }

    /**
     * Set customer_email
     * @param string $customer_email
     * @return \Lof\HelpDesk\Api\Data\TicketInterface
     */
    public function setCustomerEmail($customer_email)
    {
        return $this->setData(self::CUSTOMER_EMAIL, $customer_email);
    }

    /**
     * Get customer_name
     * @return string|null
     */
    public function getCustomerName()
    {
        return $this->getData(self::CUSTOMER_NAME);
    }

    /**
     * Set customer_name
     * @param string $customer_name
     * @return \Lof\HelpDesk\Api\Data\TicketInterface
     */
    public function setCustomerName($customer_name)
    {
        return $this->setData(self::CUSTOMER_NAME, $customer_name);
    }
}
