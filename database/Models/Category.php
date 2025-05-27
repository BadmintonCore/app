<?php

namespace Vestis\Database\Models;

use Vestis\Database\Repositories\CategoryRepository;

/**
 * The category model that represents the data of the category database table
 */
class Category
{
    public int $id;

    public string $name;

    public ?int $parentCategoryId;

    public ?Category $parentCategory = null;

    /**
     * @var array<int, Category>|null
     */
    public ?array $childCategories = null;

    /**
     * @return array|Category[]
     */
    public function getChildCategories(): array
    {
        if (null !== $this->childCategories) {
            return $this->childCategories;
        }
        $this->childCategories = CategoryRepository::findByParentId($this->id);
        return $this->childCategories;
    }

    public function getParentCategory(): ?Category
    {
        if (null === $this->parentCategoryId) {
            return null;
        }
        if (null !== $this->parentCategory) {
            return $this->parentCategory;
        }
        $this->parentCategory = CategoryRepository::findById($this->parentCategoryId);
        return $this->parentCategory;
    }

}
