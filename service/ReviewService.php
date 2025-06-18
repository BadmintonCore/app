<?php

namespace Vestis\Service;

use Vestis\Database\Repositories\ReviewRepository;
use Vestis\Exception\ValidationException;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

class ReviewService
{
    /**
     * Verarbeitet die Formular-Daten für eine Produktbewertung.
     *
     * @throws ValidationException
     */
    public static function handleReviewSubmission(): void
    {
        AuthService::checkAccess(); // Nutzer muss eingeloggt sein

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
        exit;
    }

    public static function hasReviewed($productId, $userId): bool{
    if (!ReviewRepository::hasUserReviewed($productId, $userId) == 0) {
        return true;
    } else {
        return false;
    }
}
}
