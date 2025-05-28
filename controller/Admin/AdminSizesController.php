<?php

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\ColorRepository;
use Vestis\Database\Repositories\SizeRepository;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

class AdminSizesController
{

    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $sizes = SizeRepository::findAll();
        require_once __DIR__.'/../../views/admin/sizes/list.php';
    }

    public function edit(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $colorId = intval($_GET['id']);
        $size = SizeRepository::findById($colorId);
        if ($size === null) {
            $errorMessage = 'Größe nicht gefunden!';
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $validationRules = [
                'size' => new ValidationRule(ValidationType::String),
            ];
            try {
                ValidationService::validateForm($validationRules);

                /** @var string $name */
                ['size' => $name] = ValidationService::getFormData();

                if (strlen($name) > 3) {
                    throw new ValidationException("Die Größe darf nicht länger als 3 Buchstaben sein");
                }
                $size->size = $name;

                SizeRepository::update($size);
            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__.'/../../views/admin/sizes/edit.php';
    }

    public function create(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        if ($_SERVER['REQUEST_METHOD'] === "GET") {

            require_once __DIR__.'/../../views/admin/sizes/create.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === "POST") {

            $validationRules = [
                'size' => new ValidationRule(ValidationType::String),
            ];
            try {
                ValidationService::validateForm($validationRules);

                /** @var string $name */
                ['size' => $name] = ValidationService::getFormData();

                if (strlen($name) > 3) {
                    throw new ValidationException("Die Größe darf nicht länger als 3 Buchstaben sein");
                }

                SizeRepository::create($name);
                header('Location: /admin/sizes');
                return;

            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
                require_once __DIR__.'/../../views/admin/categories/create.php';
            }
        }
    }

}