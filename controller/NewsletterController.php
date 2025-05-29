<?php

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
     * POST-Endpoint für das Newsletter
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

                // Validate form
                ValidationService::validateForm($validationRules);

                /** @var string $mail */
                ['mail' => $mail] = ValidationService::getFormData();

                NewsletterService::subscribe($mail);

            } catch (\Exception|DatabaseException $e) {
                // Setzt alle exceptions, die dann im frontend angezeigt werden
                $errorMessage = $e->getMessage();
            }
        }
        require_once __DIR__ . '/../views/index.php';
    }

}
