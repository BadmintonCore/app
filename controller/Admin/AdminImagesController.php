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
use Vestis\Database\Repositories\ImageRepository;
use Vestis\Exception\LogicException;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;
use Vestis\Utility\PaginationUtility;

/**
 * Controller für die Admin-Panel-Bilder Ansichten
 */
class AdminImagesController
{
    /**
     * Listet alle Bilder auf mit einer Pagination
     *
     * @return void
     */
    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $page = PaginationUtility::getCurrentPage();
        $images = ImageRepository::findPaginated($page);
        $errorMessage = $_GET["errorMessage"] ?? null;
        require_once __DIR__ . '/../../views/admin/images/list.php';
    }

    /**
     * Ansicht zum Erstellen eines Bildes
     *
     * @return void
     */
    public function create(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validationRules = [
                'name' => new ValidationRule(ValidationType::String),
                'image' => new ValidationRule(ValidationType::ImageFile)
            ];
            try {
                ValidationService::validateForm($validationRules);

                $formData = ValidationService::getFormData();

                $originalName = $formData['image']['name'];

                $tmpFile = $formData['image']['tmp_name'];

                // Der Name unter dem die Datei zukünftig gespeichert wird
                $uniqueName = uniqid('img_', true) . '.' . pathinfo($originalName, PATHINFO_EXTENSION);

                // Der Speicherort der Datei
                $destination = __DIR__ . '/../../public/uploads/' . $uniqueName;

                // Vom Temp-Order in den uploads ordner
                if (false === move_uploaded_file($tmpFile, $destination)) {
                    throw new LogicException("Datei kann nicht bewegt werden");
                }

                ImageRepository::create($formData['name'], '/uploads/' . $uniqueName);

                header('Location: /admin/images');
                return;

            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__ . '/../../views/admin/images/create.php';
    }

    /**
     * Ansicht um ein Bild anzuzeigen
     *
     * @return void
     */
    public function view(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $imageId = intval($_GET['id']);
        $image = ImageRepository::findById($imageId);

        if ($image === null) {
            $errorMessage = 'Bild nicht gefunden!';
        }
        require_once __DIR__ . '/../../views/admin/images/view.php';
    }

    /**
     * Löschen eines Bildes
     *
     * @return void
     * @throws ValidationException
     */
    public function delete(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $validationRules = [
            'id' => new ValidationRule(ValidationType::Integer),
        ];

        ValidationService::validateForm($validationRules, "GET");

        $formData = ValidationService::getFormData();

        // Löschen des Eintrags aus der Datenbank
        ImageRepository::delete($formData['id']);

        header('Location: /admin/images');
    }
}
