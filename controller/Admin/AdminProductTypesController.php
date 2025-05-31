<?php

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Models\ProductType;
use Vestis\Database\Repositories\CategoryRepository;
use Vestis\Database\Repositories\ColorRepository;
use Vestis\Database\Repositories\ImageRepository;
use Vestis\Database\Repositories\ProductRepository;
use Vestis\Database\Repositories\ProductTypeRepository;
use Vestis\Database\Repositories\SizeRepository;
use Vestis\Exception\DatabaseException;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;
use Vestis\Utility\PaginationUtility;

/**
 * Controller für alle Interaktionen in Bezug auf Produkt-Typen im Admin-Panel
 */
class AdminProductTypesController
{
    /**
     * Listet alle Produkt Typen paginiert auf.
     *
     * @return void
     */
    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $page = PaginationUtility::getCurrentPage();
        $productTypes = ProductTypeRepository::findPaginated($page);
        $errorMessage = $_GET["errorMessage"];
        require_once __DIR__.'/../../views/admin/productTypes/list.php';
    }

    /**
     * Ansicht zum Bearbeiten eines Produkttypen
     *
     * @return void
     */
    public function edit(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        // Fehlermeldung die ggf. im View angezeigt wird
        $errorMessage = null;

        /** @phpstan-ignore-next-line */
        $productTypeId = intval($_GET['id']);

        $productType = ProductTypeRepository::findById($productTypeId);

        // Für die Select-Optionen im View
        $optionalCategories = CategoryRepository::findAllWithParent();
        $optionalSizes = SizeRepository::findAll();
        $optionalColors = ColorRepository::findAll();

        if ($productType === null) {
            $errorMessage = 'Produkt nicht gefunden!';
            require_once __DIR__.'/../../views/admin/productTypes/edit.php';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $validationRules = [
                'name' => new ValidationRule(ValidationType::String),
                'categoryId' => new ValidationRule(ValidationType::Integer),
                'material' => new ValidationRule(ValidationType::String),
                'price' => new ValidationRule(ValidationType::Float),
                'description' => new ValidationRule(ValidationType::String),
                'collection' => new ValidationRule(ValidationType::String),
                'careInstructions' => new ValidationRule(ValidationType::String),
                'origin' => new ValidationRule(ValidationType::String),
                'extraFields' => new ValidationRule(ValidationType::Json),
                'sizes' => new ValidationRule(ValidationType::IntegerArray),
                'colors' => new ValidationRule(ValidationType::IntegerArray),
            ];

            try {
                ValidationService::validateForm($validationRules);

                $formData = ValidationService::getFormData();

                // Prüft, ob die gewählte Kategorie existiert
                if (CategoryRepository::findById($formData['categoryId']) === null) {
                    throw new ValidationException("Kategorie nicht gefunden!");
                }

                // Prüft, ob die gewählten Größen existieren
                foreach ($formData['sizes'] as $size) {
                    if (SizeRepository::findById($size) === null) {
                        throw new ValidationException("Größe nicht gefunden!");
                    }
                }

                // Prüft, ob die gewählten Farben existieren
                foreach ($formData['colors'] as $color) {
                    if (ColorRepository::findById($color) === null) {
                        throw new ValidationException("Farbe nicht gefunden!");
                    }
                }

                $productType->name = $formData['name'];
                $productType->categoryId = $formData['categoryId'];
                $productType->material = $formData['material'];
                $productType->price = $formData['price'];
                $productType->description = $formData['description'];
                $productType->collection = $formData['collection'];
                $productType->careInstructions = $formData['careInstructions'];
                $productType->origin = $formData['origin'];
                $productType->extraFields = $formData['extraFields'];

                ProductTypeRepository::update($productType);
                ProductTypeRepository::updateSizeMapping($productType->id, $formData['sizes']);
                ProductTypeRepository::updateColorMapping($productType->id, $formData['colors']);


            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__.'/../../views/admin/productTypes/edit.php';
    }

    /**
     * Listenansicht zum Erstellen eines Produkt-Typen
     *
     * @return void
     */
    public function create(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        // Optionen für die Selects
        $optionalCategories = CategoryRepository::findAllWithParent();
        $optionalSizes = SizeRepository::findAll();
        $optionalColors = ColorRepository::findAll();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $validationRules = [
                'name' => new ValidationRule(ValidationType::String),
                'categoryId' => new ValidationRule(ValidationType::Integer),
                'material' => new ValidationRule(ValidationType::String),
                'price' => new ValidationRule(ValidationType::Float),
                'description' => new ValidationRule(ValidationType::String),
                'collection' => new ValidationRule(ValidationType::String),
                'careInstructions' => new ValidationRule(ValidationType::String),
                'origin' => new ValidationRule(ValidationType::String),
                'extraFields' => new ValidationRule(ValidationType::Json, true),
                'sizes' => new ValidationRule(ValidationType::IntegerArray),
                'colors' => new ValidationRule(ValidationType::IntegerArray),
            ];

            try {
                ValidationService::validateForm($validationRules);

                $formData = ValidationService::getFormData();

                // Prüft, ob die gewählte Kategorie existiert
                if (CategoryRepository::findById($formData['categoryId']) === null) {
                    throw new ValidationException("Kategorie nicht gefunden!");
                }

                // Prüft, ob die gewählten Größen existieren
                foreach ($formData['sizes'] as $size) {
                    if (SizeRepository::findById($size) === null) {
                        throw new ValidationException("Größe nicht gefunden!");
                    }
                }

                // Prüft, ob die gewählten Farben existieren
                foreach ($formData['colors'] as $color) {
                    if (ColorRepository::findById($color) === null) {
                        throw new ValidationException("Farbe nicht gefunden!");
                    }
                }

                /** @var ProductType $productType */
                $productType = ProductTypeRepository::create($formData);
                ProductTypeRepository::updateSizeMapping($productType->id, $formData['sizes']);
                ProductTypeRepository::updateColorMapping($productType->id, $formData['colors']);

                header('Location: /admin/productTypes');
                return;

            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__.'/../../views/admin/productTypes/create.php';
    }

    /**
     * Ansicht zum Zuweisen von Bildern
     *
     * @return void
     */
    public function assignImages(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $productTypeId = intval($_GET['id']);

        $productType = ProductTypeRepository::findById($productTypeId);
        $page = PaginationUtility::getCurrentPage();

        // Alle bereits zugewiesenen Bilder (die IDs der Bilder)
        $assignedImageIds = [];

        if ($productType === null) {
            $errorMessage = 'Produkt nicht gefunden!';
            require_once __DIR__.'/../../views/admin/productTypes/assignImages.php';
            return;
        }

        // Alle bereits in der DB zugewiesenen Bilder IDs
        $persistentAssignedImageIds = $productType->getImageIds();

        // Führe die Zuweisungen der Datenbank mit denen aus dem GET-Parameter zusammen
        $assignedImageIds = array_merge($persistentAssignedImageIds, $this->getPreSelectedImageIds());

        // Alle Bilder, die auf einer Seite zur Auswahl stehen sollen
        $images = ImageRepository::findPaginated($page);

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            try {
                // Wenn der Submit Button gedrückt wurde, wird die Auswahl persistent in der DB gespeichert
                if (isset($_POST['submitButton'])) {

                    $validationRules = [
                        'assigned' => new ValidationRule(ValidationType::IntegerArray, true),
                    ];
                    ValidationService::validateForm($validationRules);

                    $formData = ValidationService::getFormData();

                    // Setze Fallback-Wert für die zugewiesenen
                    $formData['assigned'] = $formData['assigned'] ?? [];


                    // Alle über die URL ausgewählten und auf der aktuellen Seite ausgewählten Bilder zusammenführen (die IDs)
                    $newAssignedImageIds = array_unique(array_merge($formData['assigned'], $this->getPreSelectedImageIds()));

                    // Mapping der Bilder zu den Produkttypen in der DB aktualisieren
                    ProductTypeRepository::updateImageMapping($productType->id, $newAssignedImageIds);

                    header('Location: /admin/productTypes');
                    return;

                } else {
                    // Es wurde nicht der Submit-Button gedrückt, sondern einer der Pagination-Buttons.
                    // Es muss nun also die aktuelle Auswahl der alten Seite auf der neuen Seite bewusst sein.
                    // Die bereits auf anderen Seiten ausgewählten Bilder werden also in der URI gespeichert.

                    $validationRules = [
                        'pagination' => new ValidationRule(ValidationType::Integer),
                        'assigned' => new ValidationRule(ValidationType::IntegerArray, true),
                    ];
                    ValidationService::validateForm($validationRules);

                    $formData = ValidationService::getFormData();

                    // Wurden auf der Seite überhaupt Bilder ausgewählt?
                    if (isset($formData['assigned']) && is_array($formData['assigned'])) {

                        // Die bereits über
                        $newPreSelectedSelection = array_merge($formData['assigned'], $this->getPreSelectedImageIds());
                        $uniqueSelection = array_unique($newPreSelectedSelection);
                        $_GET['preSelected'] = implode(',', $uniqueSelection);
                    }

                    header('Location: /admin/productTypes/assignImages?'. PaginationUtility::generateSearchLink($formData['pagination']));
                    return;
                }
            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__.'/../../views/admin/productTypes/assignImages.php';
    }

    /**
     * Holt die Vorauswahl an Bildern aus den GET-Parametern
     *
     * @return array<int, int>
     */
    private function getPreSelectedImageIds(): array
    {
        $preSelectedImageIds = [];
        if (isset($_GET['preSelected']) && is_string($_GET['preSelected'])) {
            $idsAsString = explode(',', $_GET['preSelected']);
            $convertedToInt = array_map(fn (string $id) => intval($id), $idsAsString);
            $preSelectedImageIds = array_filter($convertedToInt, fn (int $i) => $i !== 0);
        }
        return $preSelectedImageIds;
    }

    /**
     * Löschen eines Produkttypen
     *
     * @return void
     */
    public function delete(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $validationRules = [
            'id' => new ValidationRule(ValidationType::Integer),
        ];

        try {
            ValidationService::validateForm($validationRules, "GET");

            $formData = ValidationService::getFormData();

            $usedProducts = ProductRepository::getIds();

            $usedProduct = false;

            for ($i = 0; $i < count($usedProducts); $i++) {
                if ($usedProducts[$i]->productTypeId === $formData["id"]) {
                    $usedProduct = true;
                    break;
                }
            }

            if (!$usedProduct) {
                ProductTypeRepository::delete($formData['id']);
            } else {
                $errorMessage = "Es gibt noch Produkte mit dieser Produktkategorie.";
            }

        } catch (ValidationException|DatabaseException $e) {
            $errorMessage = $e->getMessage();
        }

        if (isset($errorMessage)) {
            header('Location: /admin/productTypes?errorMessage=Fehler: ' . $errorMessage);
        } else {
            header('Location: /admin/productTypes');
        }
    }

}
