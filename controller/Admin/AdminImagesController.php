<?php

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\ImageRepository;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;
use Vestis\Utility\PaginationUtility;

class AdminImagesController
{
    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $page = PaginationUtility::getCurrentPage();

        $images = ImageRepository::findPaginated($page);
        require_once __DIR__.'/../../views/admin/images/list.php';
    }

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

                /** @var array<string, string|int|array<string, int|string>> $formData */
                $formData = ValidationService::getFormData();

                if (!is_array($formData['image'])) {
                    throw new ValidationException("Provided image must be an array");
                }

                /** @var string $originalName */
                $originalName = $formData['image']['name'];
                /** @var string $tmpFile */
                $tmpFile = $formData['image']['tmp_name'];
                $uniqueName = uniqid('img_', true) . '.' . pathinfo($originalName, PATHINFO_EXTENSION);
                $destination = __DIR__ . '/../../public/uploads/' . $uniqueName;
                move_uploaded_file($tmpFile, $destination);

                /** @phpstan-ignore-next-line Wurde bereits validiert */
                ImageRepository::create($formData['name'], '/uploads/' . $uniqueName);
                header('Location: /admin/images');
                return;

            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__.'/../../views/admin/images/create.php';
    }

    public function view(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        /** @phpstan-ignore-next-line secure */
        $imageId = intval($_GET['id']);
        $image = ImageRepository::findById($imageId);
        if ($image === null) {
            $errorMessage = 'Bild nicht gefunden!';
        }
        require_once __DIR__.'/../../views/admin/images/view.php';
    }
}
