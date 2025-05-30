<?php

namespace Vestis\Database\Dto;

use Vestis\Database\Models\Color;
use Vestis\Database\Models\ProductType;
use Vestis\Database\Models\Size;
use Vestis\Database\Repositories\CategoryRepository;
use Vestis\Database\Repositories\ColorRepository;
use Vestis\Database\Repositories\ProductTypeRepository;
use Vestis\Database\Repositories\SizeRepository;

class ShoppingCartItemDto
{
    public int $id;

    public int $productTypeId;

    public int $sizeId;

    public int $colorId;

    public int $shoppingCartId;

    public ?int $accId = null;

    public ?string $boughtAt = null;

    public ?int $boughtPrice = null;

    public int $count;

    private ?ProductType $productType = null;

    private ?Size $size = null;

    private ?Color $color = null;

    public function getProductType(): ProductType{
        if ($this->productType !== null) {
            return $this->productType;
        }
        $this->productType =  ProductTypeRepository::findById($this->productTypeId);

        /** @phpstan-ignore-next-line Der Produkttyp ist immer !== null  */
        return $this->productType;
    }

    public function getSize(): Size{
        if ($this->size !== null) {
            return $this->size;
        }
        $this->size =  SizeRepository::findById($this->sizeId);

        /** @phpstan-ignore-next-line Die Größe ist immer !== null  */
        return $this->size;
    }

    public function getColor(): Color{
        if ($this->color !== null) {
            return $this->color;
        }
        $this->color =  ColorRepository::findById($this->colorId);

        /** @phpstan-ignore-next-line Die Größe ist immer !== null  */
        return $this->color;
    }
}