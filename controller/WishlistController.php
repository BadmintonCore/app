<?php

namespace Vestis\Controller;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\WishlistRepository;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

class WishlistController
{
    /**
     * Ansicht für die Wunschliste
     *
     * @return void
     */
    public function wishlist(): void
    {
        require_once __DIR__ . '/../views/user-area/wishlist.php';
    }

    public function getWishlist(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        $account = AuthService::$currentAccount;
        header('Content-Type: application/json');
        if ($account !== null) {
            echo json_encode(WishlistRepository::getWishlistByAccountId($account->id));
        }
    }

    /**
     * @throws ValidationException
     */
    public function removeFromWishlist(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        $account = AuthService::$currentAccount;

        $validationRules = [
            'productTypeId' => new ValidationRule(ValidationType::Integer),
        ];

        ValidationService::validateForm($validationRules, "POST");

        $formData = ValidationService::getFormData();

        if ($account !== null) {
            WishlistRepository::removeFromWishlist($account->id, $formData["productTypeId"]);
            echo "Produkt wurde aus der Wunschliste entfernt";
        }
    }

    public function addToWishlist(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        $account = AuthService::$currentAccount;

        $validationRules = [
            'productTypeId' => new ValidationRule(ValidationType::Integer),
        ];

        ValidationService::validateForm($validationRules, "POST");

        $formData = ValidationService::getFormData();

        if ($account !== null) {
            WishlistRepository::addToWishlist($account->id, $formData["productTypeId"]);
            echo "Produkt wurde zu der Wunschliste hinzugefügt";
        }
    }
}