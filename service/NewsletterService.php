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
        $isRegistered = NewsletterRepository::search($email);

        if ($isRegistered !== null) {
            return;
        } else {
            NewsletterRepository::subscribe($email);
        }
    }

    public static function unsubscribe(string $email): void
    {
        $isRegistered = NewsletterRepository::search($email);

        if ($isRegistered !== null) {
            NewsletterRepository::unsubscribe($email);
        }
    }
}
