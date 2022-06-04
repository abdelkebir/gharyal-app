<?php

namespace Lof\HelpDesk\Api\Data;

interface TicketInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const TICKET_ID = 'ticket_id';
    const SUBJECT = 'subject';
    const DESCRIPTION = 'description';
    const STATUS_ID = 'status_id';
    const CUSTOMER_EMAIL = 'customer_email';
    const CUSTOMER_NAME = 'customer_name';

    /**
     * Get ticket_id
     * @return int|null
     */
    public function getTicketID();

    /**
     * Set ticket_id
     * @param int $ticket_id
     * @return \Lof\HelpDesk\Api\Data\TicketInterface
     */
    public function setTicketID($ticket_id);

    /**
     * Get subject
     * @return string|null
     */
    public function getSubject();

    /**
     * Set subject
     * @param string $subject
     * @return \Lof\HelpDesk\Api\Data\TicketInterface
     */
    public function setSubject($subject);

    /**
     * Get description
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     * @param string $description
     * @return \Lof\HelpDesk\Api\Data\TicketInterface
     */
    public function setDescription($description);

    /**
     * Get status_id
     * @return int|null
     */
    public function getStatusId();

    /**
     * Set status_id
     * @param int $status_id
     * @return \Lof\HelpDesk\Api\Data\TicketInterface
     */
    public function setStatusId($status_id);

    /**
     * Get customer_email
     * @return string|null
     */
    public function getCustomerEmail();

    /**
     * Set customer_email
     * @param string $customer_email
     * @return \Lof\HelpDesk\Api\Data\TicketInterface
     */
    public function setCustomerEmail($customer_email);

    /**
     * Get customer_name
     * @return string|null
     */
    public function getCustomerName();

    /**
     * Set customer_name
     * @param string $customer_name
     * @return \Lof\HelpDesk\Api\Data\TicketInterface
     */
    public function setCustomerName($customer_name);
}