<?php

namespace Vestis\Database\Models;

class ProductType
{
    public int $id;

    public int $categoryId;

    public string $name;

    public string $material;

    public float $price;

    public string $imgPath;

    public string $description;

    public string $collection;

    public string $careInstructions;

    public string $origin;

    public string $extraFields;
}