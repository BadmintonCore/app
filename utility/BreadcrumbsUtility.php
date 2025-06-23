<?php

namespace Vestis\Utility;

use Vestis\Database\Models\Category;
use Vestis\Database\Models\ProductType;

/**
 * Utility-Klasse zum Generieren von Breadcrumbs Content für Seiten auf denen das nicht über die URL getan werden kann
 */
class BreadcrumbsUtility
{
    /**
     * Der Name des Query-Parameters, der im JS benutzt wird, um die Breadcrumbs zu laden
     */
    public const FIELD_NAME = 'breadcrumpsContent';

    /**
     * Der Root-Path für die Breadcrumbs
     */
    private const ROOT_PATH = ['name' => 'Startseite', 'url' => '/'];


    /**
     * Generiert den Breadcrumbs base64 String für die Produkt-Seite
     *
     * @param Category $category Die Kategorie des Produktes
     * @param ProductType $productType Das Produkt
     * @return string Der base64 String
     */
    public static function generateProductBreadcrumbsBase64(Category $category, ProductType $productType): string
    {
        $links = [self::ROOT_PATH];
        if ($category->getParentCategory() !== null) {
            $links[] = ['name' => $category->getParentCategory()->name, 'url' => '/categories?categoryId=' . $category->getParentCategory()->id];
        }
        $uri = sprintf('/categories?categoryId=%s&%s=%s', $category->id, self::FIELD_NAME, self::generateCategoryBreadcrumbsBase64($category));
        $links[] = ['name' => $category->name, 'url' => $uri];
        $links[] = ['name' => $productType->name, 'url' => null];

        $encoded = json_encode($links);
        if (false === $encoded) {
            return "";
        }
        return Base64Utility::base64UrlEncode($encoded);
    }

    /**
     * Generiert den Breadcrumbs base64 String für eine Unterkategorie.
     *
     * @param Category $category Die Unterkategorie
     * @return string Der base64 String
     */
    public static function generateCategoryBreadcrumbsBase64(Category $category): string
    {
        $links = [self::ROOT_PATH];
        if ($category->getParentCategory() !== null) {
            $links[] = ['name' => $category->getParentCategory()->name, 'url' => '/categories?categoryId=' . $category->getParentCategory()->id];
        }
        $links[] = ['name' => $category->name, 'url' => null];
        $encoded = json_encode($links);
        if (false === $encoded) {
            return "";
        }
        return Base64Utility::base64UrlEncode($encoded);
    }
}
