<?php

namespace Vestis\Controller;

use Vestis\Database\Repositories\ColorRepository;
use Vestis\Database\Repositories\ProductRepository;
use Vestis\Database\Repositories\ProductTypeRepository;
use Vestis\Database\Repositories\ShoppingCartRepository;
use Vestis\Database\Repositories\SizeRepository;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\ShoppingCartService;
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

        //Verarbeitung des "Zum Warenkorb"-Buttons
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $validationRules = [
                'size' => new ValidationRule(ValidationType::Integer),
                'color' => new ValidationRule(ValidationType::Integer),
                'quantity' => new ValidationRule(ValidationType::Integer),
            ];

            try {

                // Validate form
                ValidationService::validateForm($validationRules);

                $formData = ValidationService::getFormData();

                $account = AuthService::$currentAccount;

                if ($account !== null) {

                    //Anzahl der Produkte mit der itemId, der Größe und der Farbe in der Datenbank suchen
                    $pieces = ProductRepository::getUnsoldQuantity($itemId, $formData["size"], $formData["color"]);

                    //Nur, wenn genug Produkte verfügbar sind, wird was in den Warenkorb hinzugefügt
                    if ($pieces >= $formData["quantity"]) {
                        ShoppingCartRepository::add($account, $itemId, $formData["size"], $formData["color"], $formData["quantity"]);
                    }
                }

                // Wenn der direkt bestellen Button gedrückt wurde
                if (isset($_POST['buyDirect'])) {
                    header('Location: /user-area/shoppingCart');
                    return;
                }

            } catch (ValidationException $e) {
                // Setzt alle exceptions, die dann im frontend angezeigt werden
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__ . '/../views/product/itemid.php';
    }

    public function checkStock(): void
    {
            $validationRules = [
                'itemId' => new ValidationRule(ValidationType::Integer),
                'sizeId' => new ValidationRule(ValidationType::Integer),
                'colorId' => new ValidationRule(ValidationType::Integer),
            ];
            ValidationService::validateForm($validationRules, "GET");
            $formData = ValidationService::getFormData();

            $productType = ProductTypeRepository::findById($formData["itemId"]);
            if (null === $productType) {
                throw new ValidationException("Produkttyp nicht gefunden");
            }

            $color = ColorRepository::findById($formData["colorId"]);
            if (null === $color) {
                throw new ValidationException("Farbe nicht gefunden");
            }

            $size = SizeRepository::findById($formData["sizeId"]);
            if (null === $size) {
                throw new ValidationException("Größe nicht gefunden");
            }

            $leftQuantity = ProductRepository::getUnsoldQuantity($productType->id, $size->id, $color->id);

            header('Content-type: application/json');
            echo json_encode(['quantityLeft' => $leftQuantity]);
    }
}
