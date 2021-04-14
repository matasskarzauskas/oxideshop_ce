<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\EshopCommunity\Tests\Integration\Internal\Domain\Newsletter\Dao;

use OxidEsales\EshopCommunity\Internal\Domain\Newsletter\Dao\NewsletterRecipientsDaoInterface;
use OxidEsales\EshopCommunity\Internal\Domain\Newsletter\DataMapper\NewsletterRecipientsDataMapper;
use OxidEsales\EshopCommunity\Internal\Domain\Newsletter\DataMapper\NewsletterRecipientsDataMapperInterface;
use OxidEsales\EshopCommunity\Tests\Integration\Internal\ContainerTrait;
use PHPUnit\Framework\TestCase;

class NewsletterRecipientsDaoTest extends TestCase
{
    use ContainerTrait;

    public function testGetNewsletterRecipients(): void
    {
        $recipientsList = $this->get(NewsletterRecipientsDataMapperInterface::class)->mapRecipientListDataToArray(
            $this->get(NewsletterRecipientsDaoInterface::class)->getNewsletterRecipients(1)
        );

        $this->assertContains(
            [
                NewsletterRecipientsDataMapper::SALUTATION           => "MR",
                NewsletterRecipientsDataMapper::FIRST_NAME           => "John",
                NewsletterRecipientsDataMapper::LAST_NAME            => "Doe",
                NewsletterRecipientsDataMapper::EMAIL                => "admin",
                NewsletterRecipientsDataMapper::OPT_IN_STATE         => "subscribed",
                NewsletterRecipientsDataMapper::COUNTRY              => "Deutschland",
                NewsletterRecipientsDataMapper::ASSIGNED_USER_GROUPS => "Auslandskunde,Shop-Admin"
            ],
            $recipientsList
        );
    }
}
