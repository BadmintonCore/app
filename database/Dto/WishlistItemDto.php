<?php

/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

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
