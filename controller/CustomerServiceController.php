<?php

namespace Vestis\Controller;

use Vestis\Database\Repositories\FeedbackRepository;
use Vestis\Exception\AuthException;
use Vestis\Exception\DatabaseException;
use Vestis\Exception\ValidationException;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

/**
 * Controller für Kundendienste
 */
class CustomerServiceController
{
    /**
     * Ansicht für das Kontaktformular
     *
     * @return void
     */
    public function contact(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $validationRules = [
                'name' => new ValidationRule(ValidationType::String),
                'evaluation' => new ValidationRule(ValidationType::String),
                'email' => new ValidationRule(ValidationType::String),
                'message' => new ValidationRule(ValidationType::String),
            ];
            try {

                // Validate form
                ValidationService::validateForm($validationRules);
                $formData = ValidationService::getFormData();

                //Erstellt ein neues Feedback
                FeedbackRepository::createFeedback($formData['name'], $formData['evaluation'], $formData['email'], $formData['message']);

                $feedbackMessage = "Vielen Dank für dein Feedback!";
            } catch (ValidationException|DatabaseException $e) {
                // Setzt alle exceptions, die dann im frontend angezeigt werden
                $errorMessage = $e->getMessage();
            }
        }
        require_once __DIR__ . "/../views/customer-service/contact.php";
    }

    public function faq(): void
    {
        require_once __DIR__ . "/../views/customer-service/faq.php";
    }

    public function returns(): void
    {
        require_once __DIR__ . "/../views/customer-service/returns.php";
    }
}
