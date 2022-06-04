<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Lof\HelpDesk\Model;

use Lof\HelpDesk\Api\Data;
use Lof\HelpDesk\Api\TicketRepositoryInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Lof\HelpDesk\Model\ResourceModel\Ticket as ResourceTicket;
use Lof\HelpDesk\Model\ResourceModel\Ticket\CollectionFactory as TicketCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class TicketRepository implements TicketRepositoryInterface
{
    /**
     * @var ResourceTicket
     */
    protected $resource;

    /**
     * @var TicketFactory
     */
    protected $ticketFactory;

    /**
     * @var TicketCollectionFactory
     */
    protected $ticketCollectionFactory;

    /**
     * @var \Lof\HelpDesk\Api\Data\TicketInterfaceFactory
     */
    protected $dataTicketFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param ResourceTicket $resource
     * @param TicketFactory $ticketFactory
     * @param Data\TicketInterfaceFactory $dataTicketFactory
     * @param TicketCollectionFactory $ticketCollectionFactory
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceTicket $resource,
        TicketFactory $ticketFactory,
        Data\TicketInterfaceFactory $dataTicketFactory,
        TicketCollectionFactory $ticketCollectionFactory,
        StoreManagerInterface $storeManager
    )
    {
        $this->resource = $resource;
        $this->ticketFactory = $ticketFactory;
        $this->ticketCollectionFactory = $ticketCollectionFactory;
        $this->dataTicketFactory = $dataTicketFactory;
        $this->storeManager = $storeManager;
    }

    /**
     * Create Ticket data
     *
     * @return Ticket
     * @throws CouldNotSaveException
     */
    public function createTicket()
    {
        $html = $_POST['html'];
        $matches = [];

        //get content message of the email you have just received
        preg_match_all('#<div[^>]*>(.*?)</div>#', $html, $matches);
        $contentMessage = strip_tags($matches[1][0]);

        $storeId = $this->storeManager->getStore()->getId();
        $modelTicket = $this->ticketFactory->create();
        $dataEmail = $this->parseEmailAddress($_POST['from']);
        $websiteID = $this->storeManager->getStore()->getWebsiteId();
        $customer = $this->_customer->create()->setWebsiteId($websiteID)->loadByEmail($dataEmail['email']);
        $customerId = $customer->getId();
        $getSubject = isset($_POST['subject']) ? $_POST['subject'] : __("No subject");
        $subject = str_replace("Re: ", "", $getSubject);
        $checkReply = str_split($getSubject, 4);
        //check exist string 'Re: ' in subject
        if (isset($checkReply[0]) && "Re: " === $checkReply[0]) {
            $ticketCollection = $this->ticketCollection->create();
            $replyTicket = $ticketCollection->addFieldToFilter('subject', $subject)
                ->addFieldToFilter('customer_email', $dataEmail['email'])
                ->setOrder('ticket_id', 'ASC');
            if ($replyTicket->count() > 0) {
                $modelMessage = $this->messageFactory->create();
                $modelMessage->setData([
                    "ticket_id" => $replyTicket->getFirstItem()->getTicket_id(),
                    "customer_id" => isset($customerId) ? $customerId : null,
                    "customer_email" => $dataEmail['email'],
                    "customer_name" => $dataEmail['name'],
                    "body" => $contentMessage,
                ]);
                $modelMessage->save();
                return true;
            }
        }
        $dataInput = [
            "subject" => $subject,
            "description" => $contentMessage,
            "status_id" => 1,
            "customer_id" => isset($customerId) ? $customerId : null,
            "department_id" => 1,
            "customer_email" => $dataEmail['email'],
            "customer_name" => $dataEmail['name'],
            "store_id" => $storeId,
        ];
        try {
            $modelTicket->setData($dataInput)->save();
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the ticket: %1', $exception->getMessage()),
                $exception
            );
        }
        return true;
    }

    private function parseEmailAddress($raw)
    {
        $name = "";
        $email = trim($raw, " '\"");
        if (preg_match("/^(.*)<(.*)>.*$/", $raw, $matches)) {
            array_shift($matches);
            $name = trim($matches[0], " '\"");
            $email = trim($matches[1], " '\"");
        }
        $dataEmail = [
            "name" => $name,
            "email" => $email,
            "full" => $name . " <" . $email . ">"
        ];
        return $dataEmail;
    }
}
