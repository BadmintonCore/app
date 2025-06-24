<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Dto\ShoppingCartItemDto;
use Vestis\Database\Models\Product;

/**
 * Repository für @see Product
 */
class ProductRepository
{
    /**
     * Prüft, ob für einen Produkttyp ein Produkt existiert
     *
     * @param int $productTypeId Die ID des Produkttyps
     * @return bool
     */
    public static function isUsed(int $productTypeId): bool
    {
        return QueryAbstraction::fetchOneAs(Product::class, "SELECT productTypeId FROM product WHERE productTypeId = :productTypeId ", ["productTypeId" => $productTypeId]) !== null;
    }

    /**
     * Lädt Produkte mit eines bestimmten Produkt-Typen paginiert
     *
     * @param int $productTypeId Die ID des Produkt-Typen
     * @param int $page Die Seite, die geladen werden soll
     * @param int $perPage Die Anzahl an Elementen pro Seite
     * @return PaginationDto<Product>
     */
    public static function findForTypePaginated(int $productTypeId, int $page, int $perPage): PaginationDto
    {
        return QueryAbstraction::fetchManyAsPaginated(Product::class, "SELECT * FROM product WHERE productTypeId = :productTypeId ORDER BY id DESC", $page, $perPage, ["productTypeId" => $productTypeId]);
    }

    /**
     * Findet alle Produkte eines bestimmten Auftrages
     *
     * @param int $orderId Die ID des Auftrages
     * @return array<int, Product>
     */
    public static function findForOrder(int $orderId): array
    {
        return QueryAbstraction::fetchManyAs(Product::class, "SELECT * FROM product JOIN orderProduct op ON product.id = op.productId WHERE op.orderId = :orderId", ["orderId" => $orderId]);
    }

    /**
     * Erstellt mehrere Produkte
     *
     * @param int $productTypeId Die ID des Produkt-Typen
     * @param int $colorId Die ID der Farbe
     * @param int $sizeId Die ID der Größe
     * @param int $quantity Die Anzahl an neuen Produkten
     * @return void
     */
    public static function create(int $productTypeId, int $colorId, int $sizeId, int $quantity): void
    {
        if ($quantity <= 0) {
            return;
        }

        $batchSize = 100;

        // Wir nutzen hier mehrere Batches, falls die Quantity das MariaDB Query Limit überschreiten sollte.
        for ($offset = 0; $offset < $quantity; $offset += $batchSize) {
            $currentBatchSize = min($batchSize, $quantity - $offset);
            $placeholders = [];
            $params = [];

            for ($i = 0; $i < $currentBatchSize; $i++) {
                $index = $offset + $i;
                $placeholders[] = "(:productTypeId{$index}, :colorId{$index}, :sizeId{$index}, NULL)";
                $params["productTypeId{$index}"] = $productTypeId;
                $params["colorId{$index}"] = $colorId;
                $params["sizeId{$index}"] = $sizeId;
            }

            $query = "INSERT INTO product (productTypeId, colorId, sizeId, boughtAt) VALUES " . implode(', ', $placeholders);
            QueryAbstraction::execute($query, $params);
        }
    }

    /**
     * Weist die Produkte des Warenkorbs einem Auftrag zu
     *
     * @param int $accountId Der Account, dem der Auftrag gehört
     * @param int $orderId Die ID des Auftrags
     * @param array<int, ShoppingCartItemDto> $products Die Produkte im Warenkorb
     * @return void
     */
    public static function assignToOrder(int $accountId, int $orderId, array $products): void
    {
        foreach ($products as $product) {
            $productsToUpdate = QueryAbstraction::fetchManyAs(Product::class, "SELECT * FROM product WHERE productTypeId = :productTypeId AND shoppingCartId = :accId AND accId IS NULL", ["productTypeId" => $product->productTypeId, "accId" => $accountId]);

            $productIds = array_map(fn (Product $product) => $product->id, $productsToUpdate);

            QueryAbstraction::execute("UPDATE product SET boughtAt = NOW(), accId = :accId, shoppingCartId = NULL,  boughtPrice = :boughtPrice, boughtDiscount = :discount WHERE id IN :productIds", ["accId" => $accountId, "boughtPrice" => $product->getProductType()->price, "discount" => $product->getProductType()->discount, "productIds" => $productIds]);
            foreach ($productIds as $productId) {
                QueryAbstraction::execute("INSERT INTO orderProduct (orderId, productId) VALUES (:orderId, :productId)", ["orderId" => $orderId, "productId" => $productId]);
            }
        }
    }

    /**
     * Ermittelt die Anzahl eines Produktes in der Datenbank (gleiche ItemIT, Farbe und Größe))
     *
     * @param int $productTypeId ItemID des Items
     * @param int $size Größe des Items
     * @param int $color Farbe des Items
     * @return int Anzahl der verfügbaren Produkte
     */
    public static function getUnsoldQuantity(int $productTypeId, int $size, int $color): int
    {

        $params = [
            "itemId" => $productTypeId,
            "size" => $size,
            "color" => $color,
        ];

        $statement = QueryAbstraction::fetchOneAs(null, "SELECT COUNT(DISTINCT id) AS count FROM product WHERE productTypeId = :itemId AND sizeId = :size AND colorId = :color AND shoppingCartId IS NULL AND boughtAt IS NULL", $params);

        return (int)($statement['count'] ?? 0);
    }

    /**
     * Finds the count of the products bought of a specific product type
     *
     * @param int $productTypeId The ID of the product type
     * @param int $accountId The ID of the account
     * @return int
     */
    public static function findBoughtProductCount(int $productTypeId, int $accountId): int
    {
        $params = [
            'accId' => $accountId,
            'productId' => $productTypeId,
        ];

        $row = QueryAbstraction::fetchOneAs(null, "SELECT COUNT(*) AS count FROM product WHERE productTypeId = :productId AND accId = :accId", $params);
        return (int)($row['count'] ?? 0);
    }
}
