<?php

namespace Vestis\Service;

use Vestis\Database\Repositories\CategoryRepository;
use Vestis\Database\Repositories\ColorRepository;
use Vestis\Database\Repositories\ProductRepository;
use Vestis\Database\Repositories\ProductTypeRepository;
use Vestis\Database\Repositories\SizeRepository;

/**
 * Dienst zum Verwalten der Löschen-Funktionalität im Admin-Panel.
 */
class DeletionValidationService
{
    /**
     * Prüft, ob eine Farbe gelöscht werden kann
     *
     * @param int $colorId Die ID der Farbe
     * @return string|null
     */
    public static function validateColorDeletion(int $colorId): ?string
    {
        $isUsed = ColorRepository::isUsed($colorId);

        if ($isUsed) {
            return "Diese Farbe ist noch einem Produkttyp zugeordnet und kann nicht gelöscht werden.";
        }
        return null;
    }

    /**
     * Prüft, ob eine Größe gelöscht werden kann
     *
     * @param int $sizeId Die ID der Größe
     * @return string|null
     */
    public static function validateSizeDeletion(int $sizeId): ?string
    {
        $isUsed = SizeRepository::isUsed($sizeId);

        if ($isUsed) {
            return "Diese Größe ist noch einem Produkttyp zugeordnet und kann nicht gelöscht werden.";
        }
        return null;
    }

    /**
     * Prüft, ob ein Produkttyp gelöscht werden kann
     *
     * @param int $productType Die ID des Produkttyps
     * @return string|null
     */
    public static function validateProductTypeDeletion(int $productType): ?string
    {
        $isUsed = ProductRepository::isUsed($productType);

        if ($isUsed) {
            return "Von diesem Produkttyp existieren Produkte, weshalb diese Kategorie nicht gelöscht werden kann.";
        }
        return null;
    }

    /**
     * Prüft, ob eine Kategorie gelöscht werden kann
     *
     * @param int $category Die ID der Kategorie
     * @return string|null
     */
    public static function validateCategoryDeletion(int $category): ?string
    {
        if (CategoryRepository::hasParent($category)) {
            if (!ProductTypeRepository::hasCategories($category)) {
                return null;
            }
            return "Es gibt noch Produkte mit dieser Produktkategorie.";
        } else {
            if (CategoryRepository::hasChildren($category)) {
                return "Es gibt noch Kategorien, die diese Oberkategorie nutzen.";
            }
            return null;
        }
    }
}
