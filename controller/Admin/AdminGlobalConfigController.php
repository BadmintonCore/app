<?php

/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\GlobalConfigRepository;
use Vestis\Exception\LogicException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;
use Vestis\Utility\PaginationUtility;

/**
 * Controller für die Konfigurationen im Admin-Panel
 */
class AdminGlobalConfigController
{
    /**
     * Listet alle Konfigurationen paginiert auf
     *
     * @return void
     */
    public function allConfigs(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $page = PaginationUtility::getCurrentPage();
        $configs = GlobalConfigRepository::findAllPaginated($page, 10);
        require_once __DIR__ . '/../../views/admin/globalConfig/list.php';
    }

    public function edit(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $validationRules = ['attribute' => new ValidationRule(ValidationType::String)];
        ValidationService::validateForm($validationRules, "GET");
        $getParams = ValidationService::getFormData();

        $config = GlobalConfigRepository::findByAttribute($getParams["attribute"]);

        if ($config === null) {
            throw new LogicException("Diese Konfiguration existiert nicht.");
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $validationRules = ['value' => new ValidationRule(ValidationType::Text)];
            ValidationService::validateForm($validationRules, "POST");
            $formData = ValidationService::getFormData();

            GlobalConfigRepository::update($getParams["attribute"], $formData["value"]);
            header("Location: /admin/globalConfigs");
            return;
        }

        require_once __DIR__ . '/../../views/admin/globalConfig/edit.php';
    }

}
