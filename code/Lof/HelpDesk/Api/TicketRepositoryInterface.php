<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Lof\HelpDesk\Api;

interface TicketRepositoryInterface
{
    /**
     * Create ticket.
     *
     * @return \Lof\HelpDesk\Api\Data\TicketInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function createTicket();
}
