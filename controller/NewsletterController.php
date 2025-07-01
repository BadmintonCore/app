<?php

/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Vestis\Controller;

use Vestis\Exception\DatabaseException;
use Vestis\Service\NewsletterService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

/**
 * Controller für den Newsletter
 */
class NewsletterController
{
    /**
     * POST-Endpoint für den Newsletter
     *
     * @return void
     */
    public function subscribe(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $validationRules = [
                'mail' => new ValidationRule(ValidationType::Email)
            ];

            try {

                // Formular validieren
                ValidationService::validateForm($validationRules);

                /** @var string $mail */
                ['mail' => $mail] = ValidationService::getFormData();

                NewsletterService::subscribe($mail);

            } catch (\Exception|DatabaseException $e) {
                // Setzt alle Exceptions, die dann im frontend angezeigt werden
                $errorMessage = $e->getMessage();
            }
        }
        header('Location: /');
    }

}
