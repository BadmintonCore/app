<?php

namespace Vestis\Database\Models;

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
