<?php

/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

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
