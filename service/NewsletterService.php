<?php

namespace Vestis\Service;

use Vestis\Database\Repositories\AccountRepository;
use Vestis\Database\Repositories\NewsletterRepository;

/**
 * Service, welcher alles rundum das Thema Newsletter erledigt
 */
class NewsletterService
{
    public static function subscribe(string $email): void
    {
        $newsletterEntry = NewsletterRepository::search($email);

        if (null === $newsletterEntry) {
            NewsletterRepository::subscribe($email);
        }
    }

    public static function unsubscribe(string $email): void
    {
        $newsletterEntry = NewsletterRepository::search($email);

        if ($newsletterEntry !== null) {
            NewsletterRepository::unsubscribe($email);
        }
    }
}
