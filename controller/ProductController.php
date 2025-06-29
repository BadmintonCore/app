<?php

//Autor(en): Lasse Hoffmann

namespace Vestis\Controller;

use Vestis\Database\Models\Account;
use Vestis\Database\Models\ProductReview;
use Vestis\Database\Repositories\ColorRepository;
use Vestis\Database\Repositories\ProductRepository;
use Vestis\Database\Repositories\ProductTypeRepository;
use Vestis\Database\Repositories\ReviewRepository;
use Vestis\Database\Repositories\ShoppingCartRepository;
use Vestis\Database\Repositories\SizeRepository;
use Vestis\Exception\LogicException;
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
     * @throws LogicException
     */
    public function index(): void
    {
        $errorMessage = null;
        $product = null;

        // GET-Parameter in ein Integer konvertieren
        $itemId = intval($_GET["itemId"] ?? null);

        // Wenn die itemId = 0 ist, dann handelt es sich um eine invalide ID
        if ($itemId === 0) {
            $errorMessage = "Invalider Parameter";
            require_once __DIR__ . '/../views/product/itemid.php';
            return;
        }

        $shoppingCarts = [];
        if (AuthService::isCustomer() && AuthService::$currentAccount !== null) {
            // Alle Einkaufswagen des Benutzers finden und un shoppingCarts speichern
            $shoppingCarts = ShoppingCartRepository::findUserShoppingCarts(AuthService::$currentAccount);
        }

        // Das Produkt in der Datenbank suchen
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
                'shoppingCart' => new ValidationRule(ValidationType::String),
            ];

            try {

                // Formular validieren
                ValidationService::validateForm($validationRules);

                $formData = ValidationService::getFormData();

                // ShoppingCart setzt sich aus der Benutzer-ID und der ShoppingCart-ID zusammen
                $shoppingCartFields = explode("-", $formData["shoppingCart"]);
                // Wenn die Länge des Arrays "shoppingCartFields" nicht 2 ist, ist die Auswahl invalide
                if (count($shoppingCartFields) !== 2) {
                    throw new ValidationException("Die Warenkorb-ID ist invalide");
                }
                ValidationService::validateInteger($shoppingCartFields[0], "shoppingCart");
                ValidationService::validateInteger($shoppingCartFields[1], "shoppingCart");

                // Sucht den Warenkorb in der Datenbank und speichert es in der Variable shoppingCart
                $shoppingCart = ShoppingCartRepository::findShoppingCart(intval($shoppingCartFields[0]), intval($shoppingCartFields[1]));
                // Wenn Warenkorb Null ist, wurde er in der Datenbank nicht gefunden
                if (null === $shoppingCart) {
                    throw new LogicException("Warenkorb nicht gefunden");
                }

                /** @var Account $account */
                $account = AuthService::$currentAccount;

                // Wenn der aktuelle Benutzer keinen Zugriff auf den Warenkorb hat
                if (false === ShoppingCartRepository::hasAccessTo($account, $shoppingCart)) {
                    throw new LogicException("Sie haben keinen Zugriff auf diesen Warenkorb");
                }


                // Anzahl der Produkte mit der itemId, der Größe und der Farbe in der Datenbank suchen
                $pieces = ProductRepository::getUnsoldQuantity($itemId, $formData["size"], $formData["color"]);

                // Nur, wenn genug Produkte verfügbar sind, wird was in den Warenkorb hinzugefügt
                if ($pieces >= $formData["quantity"]) {
                    ShoppingCartRepository::add($shoppingCart, $itemId, $formData["size"], $formData["color"], $formData["quantity"]);
                } else {
                    throw new LogicException("Es sind nicht mehr genug Produkte auf Lager");
                }

                // Wenn der direkt bestellen Button gedrückt wurde
                if (isset($_POST['buyDirect'])) {
                    header('Location: /user-area/shoppingCart?accId=' . $shoppingCart->accId . '&cartNumber=' . $shoppingCart->cartNumber);
                    return;
                }

            } catch (ValidationException $e) {
                // Setzt alle Exceptions, die dann im frontend angezeigt werden
                $errorMessage = $e->getMessage();
            }
        }

        $reviews = ReviewRepository::getAllReviews($product->id);
        $hasReviewed = false;

        if (AuthService::$currentAccount !== null) {
            $hasReviewed = ReviewRepository::hasUserReviewed($product->id, AuthService::$currentAccount->id);
        }

        $reviewCount = count($reviews);
        $averageRating = 0;
        if (count($reviews) > 0) {
            // Reduziert das Array auf einen Wert, indem eine Callback-Funktion genutzt wird
            // Es werden alle Werte Ratings summiert und dann in der Variable sum gespeichert
            $sum = array_reduce($reviews, fn ($carry, ProductReview $item) => $carry + $item->rating, 0);
            $averageRating = round($sum / count($reviews), 1);
        }

        require_once __DIR__ . '/../views/product/itemid.php';
    }

    /**
     * Prüft, ob das Produkt in der spezifischen Konfiguration noch auf Lager ist.
     *
     * @return void
     * @throws ValidationException
     */
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

        // Anzahl der übrigen Einheiten eines Produktes aus der Datenbank abfragen
        $leftQuantity = ProductRepository::getUnsoldQuantity($productType->id, $size->id, $color->id);

        // Wird in der Datei shoppingCart.js dann weiter verarbeitet (Stückzahl auf Lager anzeigen)
        header('Content-type: application/json');
        echo json_encode(['quantityLeft' => $leftQuantity]);
    }
}
//Autor(en): Lasse Hoffmann
