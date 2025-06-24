<?php

//Autor(en): Lasse Hoffmann

namespace Vestis\Database\Dto;

use Vestis\Database\Models\ProductType;
use Vestis\Database\Repositories\ProductTypeRepository;


/**
 * DTO (Domain Transfer Object) für Wishlist-Item
 */
class WishlistItemDto
{
    public int $productTypeId;

    public String $name;

    public float $price;

    public String $timestamp;

}
//Autor(en): Lasse Hoffmann
