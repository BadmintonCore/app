<?php

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\ProductRepository;
use Vestis\Database\Repositories\ProductTypeRepository;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;
use Vestis\Utility\PaginationUtility;

/**
 * Controller für Produkte im Admin-Panel
 */
class AdminProductController
{

    /**
     * Listet alle Produkte eines bestimmten Produkttyoen paginiert auf.
     *
     * @return void
     * @throws ValidationException
     */
    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $productTypeId = intval($_GET['id']);
        $page = PaginationUtility::getCurrentPage();

        if (0 === $productTypeId) {
            throw new ValidationException("Parameter für den Produkt-Typen fehlt.");
        }

        $products = ProductRepository::findForTypePaginated($productTypeId, $page, 25);

        require_once __DIR__ . "/../../views/admin/products/list.php";
    }

    /**
     * Erstellt mehrere Produkte
     *
     * @return void
     * @throws ValidationException
     */
    public function create(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $productTypeId = intval($_GET['id']);

        if (0 === $productTypeId) {
            throw new ValidationException("Parameter für den Produkt-Typen fehlt.");
        }
        $productType = ProductTypeRepository::findById($productTypeId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validationRules = [
                'quantity' => new ValidationRule(ValidationType::Integer),
                'size' => new ValidationRule(ValidationType::Integer),
                'color' => new ValidationRule(ValidationType::Integer),
            ];
            ValidationService::validateForm($validationRules);

            $formData = ValidationService::getFormData();

            if (!in_array($formData['color'], $productType->getColorIds(), true)) {
                throw new ValidationException("Die gewählte Farbe existiert nicht für den Produkt Typen");
            }

            if (!in_array($formData['size'], $productType->getSizeIds(), true)) {
                throw new ValidationException("Die gewählte Größe existiert nicht für den Produkt Typen");
            }
            ProductRepository::create($productTypeId, $formData['color'], $formData['size'], $formData['quantity']);

            header('Location: /admin/productTypes/instances?id=' . $productTypeId);
        }



        require_once __DIR__ . "/../../views/admin/products/create.php";
    }

}