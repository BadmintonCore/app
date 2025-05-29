<?php

namespace Vestis\Database\Models;

use Vestis\Database\Repositories\CategoryRepository;
use Vestis\Database\Repositories\ColorRepository;
use Vestis\Database\Repositories\ImageRepository;
use Vestis\Database\Repositories\SizeRepository;

class ProductType
{
    public int $id;

    public int $categoryId;

    public string $name;

    public string $material;

    public float $price;

    public string $description;

    public string $collection;

    public string $careInstructions;

    public string $origin;

    public string $extraFields;

    private ?Category $category = null;

    private ?array $sizeIds = null;

    private ?array $colorIds = null;

    private ?array $imageIds = null;

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

    public function getImages(): array
    {
        return ImageRepository::findByProductType($this);
    }

    /**
     * @return array<int, int>
     */
    public function getSizeIds(): array
    {
        if ($this->sizeIds !== null) {
            return $this->sizeIds;
        }
        $this->sizeIds =  array_map(
            fn (Size $size) => $size->id,
            SizeRepository::findByProductType($this)
        );
        return $this->sizeIds;
    }

    /**
     * @return array<int, int>
     */
    public function getColorIds(): array
    {
        if ($this->colorIds !== null) {
            return $this->colorIds;
        }
        $this->colorIds =  array_map(
            fn (Color $color) => $color->id,
            ColorRepository::findByProductType($this)
        );
        return $this->colorIds;
    }

    /**
     * @return array<int, int>
     */
    public function getImageIds(): array
    {
        if ($this->imageIds !== null) {
            return $this->imageIds;
        }
        $this->imageIds =  array_map(
            fn (Image $image) => $image->id,
            ImageRepository::findByProductType($this)
        );
        return $this->imageIds;
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
