<?php

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\ColorRepository;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

class AdminColorsController
{
    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $colors = ColorRepository::findAll();
        require_once __DIR__.'/../../views/admin/colors/list.php';
    }

    public function edit(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $colorId = intval($_GET['id']);
        $color = ColorRepository::findById($colorId);
        if ($color === null) {
            $errorMessage = 'Farbe nicht gefunden!';
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $validationRules = [
                'name' => new ValidationRule(ValidationType::String),
                'hex' => new ValidationRule(ValidationType::String),
            ];
            try {
                ValidationService::validateForm($validationRules);
                /** @var string $name */
                ['name' => $name, 'hex' => $hex] = ValidationService::getFormData();

                if (strlen($hex) !== 7) {
                    throw new ValidationException("Invalid color");
                }
                $color->hex = substr($hex, 1, strlen($hex));
                $color->name = $name;
                ColorRepository::update($color);
            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__.'/../../views/admin/colors/edit.php';
    }

    public function create(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        if ($_SERVER['REQUEST_METHOD'] === "GET") {

            require_once __DIR__.'/../../views/admin/colors/create.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === "POST") {

            $validationRules = [
                'name' => new ValidationRule(ValidationType::String),
                'hex' => new ValidationRule(ValidationType::String),
            ];
            try {
                ValidationService::validateForm($validationRules);

                /** @var string $name */
                /** @var string $hex */
                ['name' => $name, 'hex' => $hex] = ValidationService::getFormData();

                if (strlen($hex) !== 7) {
                    throw new ValidationException("Invalid color");
                }
                $hex = substr($hex, 1, strlen($hex));

                ColorRepository::create($name, $hex);
                header('Location: /admin/colors');
                return;

            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
                require_once __DIR__.'/../../views/admin/categories/create.php';
            }
        }
    }

}
