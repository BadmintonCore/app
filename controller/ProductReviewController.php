<?php

//Autor(en): Mathis Burger

namespace Vestis\Controller;

use Vestis\Database\Models\Account;
use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\ReviewRepository;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

class ProductReviewController
{
    /**
     * Verarbeitet die Formular-Daten für eine Produktbewertung.
     *
     * @throws ValidationException
     */
    public function submit(): void
    {
        AuthService::checkAccess(); // Nutzer muss eingeloggt sein. Auch Admins können Bewertungen abgeben

        $validationRules = [
            'product_id' => new ValidationRule(ValidationType::Integer, true),
            'rating' => new ValidationRule(ValidationType::Integer, true),
            'review' => new ValidationRule(ValidationType::String, false),
        ];

        ValidationService::validateForm($validationRules, "POST");
        $formData = ValidationService::getFormData();

        $productId = (int)$formData['product_id'];
        $rating = (int)$formData['rating'];
        $review = trim($formData['review'] ?? '');

        /** @var Account $user */
        $user = AuthService::$currentAccount;

        if ($rating < 1 || $rating > 5) {
            throw new ValidationException("Bewertung muss zwischen 1 und 5 Sternen liegen.");
        }

        if (strlen($review) < 3) {
            throw new ValidationException("Bitte gib einen aussagekräftigen Text ein.");
        }

        $created = ReviewRepository::create($productId, $user->id, $rating, $review);

        if ($created === null) {
            throw new ValidationException("Speichern der Bewertung fehlgeschlagen.");
        }



        // Weiterleitung oder Erfolgsmeldung
        header("Location: /categories/product?itemId=" . $productId);
    }

}
//Autor(en): Mathis Burger
