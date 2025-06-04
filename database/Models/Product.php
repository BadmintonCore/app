<?php

namespace Vestis\Database\Models;

use Vestis\Database\Repositories\ColorRepository;
use Vestis\Database\Repositories\ProductTypeRepository;
use Vestis\Database\Repositories\SizeRepository;

/**
 * Das Model für ein Produkt in der Datenbank
 */
class Product
{
    public int $id;

    public int $productTypeId;

    public int $sizeId;

    public int $colorId;

    public ?int $shoppingCartId;

    public ?int $accId = null;

    public ?string $boughtAt = null;

    public ?float $boughtPrice = null;

    public ?int $orderId = null;

    private ?Size $size = null;

    private ?Color $color = null;

    private ?ProductType $productType = null;

    public function getSize(): Size
    {
        if ($this->size !== null) {
            return $this->size;
        }
        $this->size =  SizeRepository::findById($this->sizeId);

        /** @phpstan-ignore-next-line Die Größe ist immer !== null  */
        return $this->size;
    }

    public function getColor(): Color
    {
        if ($this->color !== null) {
            return $this->color;
        }
        $this->color =  ColorRepository::findById($this->colorId);

        /** @phpstan-ignore-next-line Die Farbe ist immer !== null  */
        return $this->color;
    }

    public function getProductType(): ProductType
    {
        if ($this->productType !== null) {
            return $this->productType;
        }
        $this->productType =  ProductTypeRepository::findById($this->productTypeId);

        /** @phpstan-ignore-next-line Der Produkttyp ist immer !== null  */
        return $this->productType;
    }
}
