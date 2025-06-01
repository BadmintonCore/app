<?php

namespace Vestis\Database\Models;

/**
 * Das Produkt-Modell, das die Daten der Produkt-Datenbanktabelle darstellt
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
