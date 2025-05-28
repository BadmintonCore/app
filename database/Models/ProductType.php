<?php

namespace Vestis\Database\Models;

use Vestis\Database\Repositories\CategoryRepository;
use Vestis\Database\Repositories\ColorRepository;
use Vestis\Database\Repositories\SizeRepository;

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

    private ?Category $category = null;

    /**
     * @return array<int, Color>
     */
    public function getColors(): array
    {
        return ColorRepository::findByProductType($this);
    }

    /**
     * @return array<int, Size>
     */
    public function getSizes(): array
    {
        return SizeRepository::findByProductType($this);
    }

    public function getCategory(): Category
    {
        if ($this->category !== null) {
            return $this->category;
        }
        $this->category =  CategoryRepository::findById($this->categoryId);
        return $this->category;
    }
}
