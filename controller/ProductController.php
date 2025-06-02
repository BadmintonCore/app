<?php

/*Autor(en): */

namespace Vestis\Controller;

use Vestis\Database\Repositories\ProductTypeRepository;
use Vestis\Database\Repositories\ShoppingCartRepository;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

/**
 * Controller für Produkte
 */
class ProductController
{
    /**
     * Ansicht eines Produktes im Detail
     *
     * @return void
     */
    public function index(): void
    {
        $errorMessage = null;
        $product = null;

        $itemId = intval($_GET["itemId"] ?? null);
        if ($itemId === 0) {
            $errorMessage = "Invalider Parameter";
            require_once __DIR__ . '/../views/product/itemid.php';
            return;
        }

        $product = ProductTypeRepository::findById($itemId);
        if (null === $product) {
            $errorMessage = "Produkt nicht gefunden";
            require_once __DIR__ . '/../views/product/itemid.php';
            return;
        }

        // Verarbeitung des "Zum Warenkorb"-Buttons
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $validationRules = [
                'size' => new ValidationRule(ValidationType::Integer),
                'color' => new ValidationRule(ValidationType::Integer),
                'quantity' => new ValidationRule(ValidationType::Integer),
            ];

            try {

                // Formular validieren
                ValidationService::validateForm($validationRules);

                $formData = ValidationService::getFormData();

                $account = AuthService::$currentAccount;

                if ($account !== null) {

                    // Anzahl der Produkte mit der itemId, der Größe und der Farbe in der Datenbank suchen
                    $pieces = ShoppingCartRepository::getAmountOfProducts($itemId, $formData["size"], $formData["color"]);

                    // Nur, wenn genug Produkte verfügbar sind, wird was in den Warenkorb hinzugefügt
                    if ($pieces >= $formData["quantity"]) {
                        ShoppingCartRepository::add($account, $itemId, $formData["size"], $formData["color"], $formData["quantity"]);
                    }
                }

            } catch (ValidationException $e) {
                // Setzt alle Exceptions, die dann im frontend angezeigt werden
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__ . '/../views/product/itemid.php';
    }


}
/*Autor(en): */
