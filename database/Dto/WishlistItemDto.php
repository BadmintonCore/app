<?php

namespace Vestis\Database\Dto;

use Vestis\Database\Models\ProductType;
use Vestis\Database\Repositories\ProductTypeRepository;

class WishlistItemDto
{
    public int $productTypeId;

    public String $name;

    public float $price;

    public String $timestamp;

}
