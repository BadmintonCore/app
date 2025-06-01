<?php

namespace Vestis\Database\Models;

/**
 * Das Model für ein Produkt in der Datenbank
 */
class Product
{
    public int $id;

    public int $productTypeId;

    public int $sizeId;

    public int $colorId;

    public int $shoppingCartId;

    public ?int $accId = null;

    public ?string $boughtAt = null;

    public ?int $boughtPrice = null;
}
