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

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\WishlistRepository;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

/**
 * Controller für die Wunschliste
 */
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

    /**
     * API, welches die Objekte der Wunschliste in einem Array enthält
     *
     * @return void
     */
    public function getWishlist(): void
    {
        // Überprüfen, ob der aktuelle Benutzer vom Typ Customer ist
        AuthService::checkAccess(AccountType::Customer);

        // Den aktuellen Account setzen
        $account = AuthService::$currentAccount;

        // Den Content-Type setzen (Browser erkennt, dass es sich um JSON-Inhalte handelt)
        header('Content-Type: application/json');

        // Wenn ein Account existiert, wird die Wunschliste des aktuellen Benutzers ausgegeben
        if ($account !== null) {
            echo json_encode(WishlistRepository::getWishlistByAccountId($account->id));
        }
    }

    /**
     * Fügt einen Eintrag in die Wunschliste hinzu
     *
     * @throws ValidationException
     */
    public function addToWishlist(): void
    {
        // Überprüfen, ob der aktuelle Benutzer vom Typ Customer ist
        AuthService::checkAccess(AccountType::Customer);

        // Den aktuellen Account setzen
        $account = AuthService::$currentAccount;

        $validationRules = [
            'productTypeId' => new ValidationRule(ValidationType::Integer),
        ];

        ValidationService::validateForm($validationRules, "POST");

        $formData = ValidationService::getFormData();

        // Wenn ein Account existiert, wird der angegebene Produkttyp zur Wunschliste hinzugefügt
        if ($account !== null) {
            WishlistRepository::addToWishlist($account->id, $formData["productTypeId"]);
            echo "Produkt wurde erfolgreich zur Wunschliste hinzugefügt.";
        }
    }

    /**
     * Entfernt einen Eintrag aus der Wunschliste
     *
     * @throws ValidationException
     */
    public function removeFromWishlist(): void
    {
        // Überprüfen, ob der aktuelle Benutzer vom Typ Customer ist
        AuthService::checkAccess(AccountType::Customer);

        // Den aktuellen Account setzen
        $account = AuthService::$currentAccount;

        $validationRules = [
            'productTypeId' => new ValidationRule(ValidationType::Integer),
        ];

        ValidationService::validateForm($validationRules);

        $formData = ValidationService::getFormData();

        // Wenn ein Account existiert, wird der angegebene Produkttyp aus der Wunschliste entfernt
        if ($account !== null) {
            WishlistRepository::removeFromWishlist($account->id, $formData["productTypeId"]);
            echo "Produkt wurde erfolgreich aus der Wunschliste entfernt.";
        }
    }
}
/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */
