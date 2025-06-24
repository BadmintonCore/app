<?php

//Autor(en): Lasse Hoffmann

namespace Vestis\Service;

use Vestis\Database\Repositories\AccountRepository;
use Vestis\Database\Repositories\NewsletterRepository;

/**
 * Service, welcher alles rundum das Thema Newsletter erledigt
 */
class NewsletterService
{
    /**
     * Abonniert einen Newsletter
     *
     * @param string $email
     * @return void
     */
    public static function subscribe(string $email): void
    {
        $newsletterEntry = NewsletterRepository::search($email);

        if (null === $newsletterEntry) {
            NewsletterRepository::subscribe($email);
        }
    }

    /**
     * Deabonniert einen Newsletter
     *
     * @param string $email
     * @return void
     */
    public static function unsubscribe(string $email): void
    {
        $newsletterEntry = NewsletterRepository::search($email);

        if ($newsletterEntry !== null) {
            NewsletterRepository::unsubscribe($email);
        }
    }
}
//Autor(en): Lasse Hoffmann
