<?php

//Autor(en): Lasse Hoffmann

namespace Vestis\Database\Repositories;

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Models\Category;
use Vestis\Database\Models\ProductType;

/**
 * Repository für @see ProductType
 */
class ProductTypeRepository
{
    /**
     * Findet ProduktTypen paginiert
     *
     * @param int $page Die Seite, die geladen werden soll
     * @return PaginationDto<ProductType>
     */
    public static function findPaginated(int $page): PaginationDto
    {
        return QueryAbstraction::fetchManyAsPaginated(ProductType::class, "SELECT * FROM productType", $page, 10);
    }

    /**
     * Findet Produkte anhand von Parametern.
     *
     * @param Category $category Die Kategorie, die genutzt werden soll, um einen Produkttyp zu finden
     * @param array<int, int> $allowedColorIds Die zugewiesenen Farben
     * @param array<int, int> $allowedSizeIds Die zugewiesenen Größen
     * @param string|null $search Ein Suchbegriff
     * @return array<int, ProductType>
     */
    public static function findByParams(Category $category, array $allowedColorIds, array $allowedSizeIds, ?string $search): array
    {
        $hasColorFilter = count($allowedColorIds) > 0;
        $hasSizeFilter = count($allowedSizeIds) > 0;
        $params = [
            'catId' => $category->id,
            'search' => $search !== null ? '%' . $search . '%' : null,
        ];


        // Parameter existiert nur, wenn auch der Farbfilter aktiv ist
        if ($hasColorFilter) {
            $params['allowedColors'] = $allowedColorIds;
        }

        // Parameter existiert nur, wenn auch der Größenfilter aktiv ist
        if ($hasSizeFilter) {
            $params['allowedSizes'] = $allowedSizeIds;
        }
        return QueryAbstraction::fetchManyAs(
            ProductType::class,
            sprintf(
                "SELECT DISTINCT p.* FROM productType p JOIN allowedSize az ON az.productTypeId = p.id JOIN allowedColor ac ON ac.productTypeId = p.id WHERE categoryId = :catId %s %s AND (:search IS NULL OR description LIKE :search OR name LIKE :search OR collection LIKE :search)",
                $hasColorFilter ? 'AND ac.colorId IN :allowedColors' : '',
                $hasSizeFilter ? 'AND az.sizeId IN :allowedSizes ' : ''
            ),
            $params
        );
    }

    /**
     * Findet einen Produkttyp anhand seiner ID
     *
     * @param int $id Die Produkttyp-ID
     * @return ProductType|null
     */
    public static function findById(int $id): ?ProductType
    {
        return QueryAbstraction::fetchOneAs(ProductType::class, "SELECT DISTINCT * FROM productType WHERE id = :id", ["id" => $id]);
    }

    /**
     * Aktualisiert einen Produkttypen
     *
     * @param ProductType $productType
     * @return void
     */
    public static function update(ProductType $productType): void
    {
        $params = [
            'id' => $productType->id,
            'name' => $productType->name,
            'categoryId' => $productType->categoryId,
            'material' => $productType->material,
            'price' => $productType->price,
            'description' => $productType->description,
            'collection' => $productType->collection,
            'careInstructions' => $productType->careInstructions,
            'origin' => $productType->origin,
            'extraFields' => $productType->extraFields,
            'discount' => $productType->discount,
        ];
        QueryAbstraction::execute("UPDATE productType SET name = :name, categoryId = :categoryId, material = :material, price = :price, description = :description, collection = :collection, careInstructions = :careInstructions, origin = :origin, extraFields = :extraFields, discount = :discount WHERE id = :id", $params);
    }

    /**
     * Erstellt einen Produkttypen
     *
     * @param array<string, int|bool|string|float|null> $formData
     * @return ProductType|null
     */
    public static function create(array $formData): ?ProductType
    {
        $params = [
            'name' => $formData['name'],
            'categoryId' => $formData['categoryId'],
            'material' => $formData['material'],
            'price' => $formData['price'],
            'description' => $formData['description'],
            'collection' => $formData['collection'],
            'careInstructions' => $formData['careInstructions'],
            'origin' => $formData['origin'],
            'extraFields' => $formData['extraFields'] ?? '{}',
        ];
        return QueryAbstraction::executeReturning(ProductType::class, "INSERT INTO productType (name, material, price, description, collection, careInstructions, origin, categoryId, extraFields) VALUES (:name, :material, :price, :description, :collection, :careInstructions, :origin, :categoryId, :extraFields)", $params);
    }

    /**
     * Aktualisiert die Größen-Zuordnung zu einem Produkttyp
     *
     * @param int $productTypeId Die Produkttyp-ID
     * @param array<int, int> $sizeIds Die Größen-ID
     * @return void
     */
    public static function updateSizeMapping(int $productTypeId, array $sizeIds): void
    {

        $existingSizes = QueryAbstraction::fetchManyAs(null, "SELECT sizeId FROM allowedSize WHERE productTypeId = :productTypeId", ["productTypeId" => $productTypeId]);
        /** @var array<int, int> $existingSizeIds */
        $existingSizeIds = array_column($existingSizes, 'sizeId');

        $sizesToRemove = array_diff($existingSizeIds, $sizeIds);
        foreach ($sizesToRemove as $sizeId) {
            QueryAbstraction::execute("DELETE FROM allowedSize WHERE productTypeId = :productTypeId AND sizeId = :sizeId", ['productTypeId' => $productTypeId, 'sizeId' => $sizeId]);
        }

        $sizesToAdd = array_diff($sizeIds, $existingSizeIds);
        foreach ($sizesToAdd as $sizeId) {
            QueryAbstraction::execute("INSERT INTO allowedSize (productTypeId, sizeId) VALUES (:productTypeId, :sizeId)", ['productTypeId' => $productTypeId, 'sizeId' => $sizeId]);
        }
    }

    /**
     * Aktualisiert die Farben-Zuordnung zu einem Produkttyp
     *
     * @param int $productTypeId Die Produkttyp-ID
     * @param array<int, int> $colorIds Die Größen-ID
     * @return void
     */
    public static function updateColorMapping(int $productTypeId, array $colorIds): void
    {
        $existingColors = QueryAbstraction::fetchManyAs(null, "SELECT colorId FROM allowedColor WHERE productTypeId = :productTypeId", ["productTypeId" => $productTypeId]);
        /** @var array<int, int> $existingColorIds */
        $existingColorIds = array_column($existingColors, 'colorId');

        $colorsToRemove = array_diff($existingColorIds, $colorIds);
        foreach ($colorsToRemove as $colorId) {
            QueryAbstraction::execute("DELETE FROM allowedColor WHERE productTypeId = :productTypeId AND colorId = :colorId", ['productTypeId' => $productTypeId, 'colorId' => $colorId]);
        }

        $colorsToAdd = array_diff($colorIds, $existingColorIds);
        foreach ($colorsToAdd as $colorId) {
            QueryAbstraction::execute("INSERT INTO allowedColor (productTypeId, colorId) VALUES (:productTypeId, :colorId)", ['productTypeId' => $productTypeId, 'colorId' => $colorId]);
        }
    }

    /**
     * Aktualisiert die Bilder-Zuordnung zu einem Produkttyp
     *
     * @param int $productTypeId Die Produkttyp-ID
     * @param array<int, int> $imageIds Die Bild-ID
     * @return void
     */
    public static function updateImageMapping(int $productTypeId, array $imageIds): void
    {
        $existingImages = QueryAbstraction::fetchManyAs(null, "SELECT imageId FROM productImage WHERE productTypeId = :productTypeId", ["productTypeId" => $productTypeId]);
        /** @var array<int, int> $existingImageIds */
        $existingImageIds = array_column($existingImages, 'imageId');

        $imagesToRemove = array_diff($existingImageIds, $imageIds);
        foreach ($imagesToRemove as $imageId) {
            QueryAbstraction::execute("DELETE FROM productImage WHERE productTypeId = :productTypeId AND imageId = :imageId", ['productTypeId' => $productTypeId, 'imageId' => $imageId]);
        }

        $imagesToAdd = array_diff($imageIds, $existingImageIds);
        foreach ($imagesToAdd as $imageId) {
            QueryAbstraction::execute("INSERT INTO productImage (productTypeId, imageId) VALUES (:productTypeId, :imageId)", ['productTypeId' => $productTypeId, 'imageId' => $imageId]);
        }
    }

    /**
     * Löscht eine vorhandene Produktkategorie
     *
     * @param int $productTypeId Die Produkttyp-ID
     * @return void
     */
    public static function delete(int $productTypeId): void
    {
        QueryAbstraction::execute("DELETE FROM productType WHERE id = :id", ['id' => $productTypeId]);
    }

    /**
     * Überprüft, ob eine Kategorie bereits einem Produkttyp zugeordnet ist
     *
     * @param int $categoryId Die Kategorie-ID
     * @return bool
     */
    public static function hasCategories(int $categoryId): bool
    {
        return QueryAbstraction::fetchOneAs(ProductType::class, "SELECT * FROM productType WHERE categoryId = :categoryId", ["categoryId" => $categoryId]) !== null;
    }

    /**
     * @return array<int, ProductType>
     */
    public static function findBestsellers(): array
    {
        $top10 = QueryAbstraction::fetchManyAs(null, "SELECT productTypeId FROM product WHERE accId IS NOT NULL GROUP BY productTypeId ORDER BY COUNT(id) LIMIT 10");
        /** @var int[] $ids */
        $ids = array_column($top10, 'productTypeId');
        if (count($ids) === 0) {
            return [];
        }
        return QueryAbstraction::fetchManyAs(ProductType::class, "SELECT * FROM productType WHERE id IN :top10Ids", ["top10Ids" => $ids]);
    }
}
//Autor(en): Lasse Hoffmann
