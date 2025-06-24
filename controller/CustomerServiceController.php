<?php

//Autor(en): Lasse Hoffmann

namespace Vestis\Controller;

use Vestis\Database\Repositories\FeedbackRepository;
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
    public function root(): void
    {
        header('Location: /');
    }

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

                // Formular validieren
                ValidationService::validateForm($validationRules);
                $formData = ValidationService::getFormData();

                // Erstellt ein neues Feedback
                FeedbackRepository::createFeedback($formData['name'], $formData['evaluation'], $formData['email'], $formData['message']);

                $feedbackMessage = "Vielen Dank für dein Feedback!";
            } catch (ValidationException|DatabaseException $e) {
                // Setzt alle Exceptions, die dann im frontend angezeigt werden
                $errorMessage = $e->getMessage();
            }
        }
        require_once __DIR__ . "/../views/customer-service/contact.php";
    }

    /**
     * Ansicht für die FAQ-Seite
     *
     * @return void
     */
    public function faq(): void
    {
        require_once __DIR__ . "/../views/customer-service/faq.php";
    }

    /**
     * Ansicht für die Rückgabe-Seite
     *
     * @return void
     */
    public function returns(): void
    {
        require_once __DIR__ . "/../views/customer-service/returns.php";
    }
}
//Autor(en): Lasse Hoffmann
