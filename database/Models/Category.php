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

    public ?Category $parentCategory = null {
        get {
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

    /**
     * @var array<int, Category>
     */
    public ?array $childCategories = null {
        get {
            if (null !== $this->childCategories) {
                return $this->childCategories;
            }
            $this->childCategories = CategoryRepository::findByParentId($this->parentCategoryId);
            return $this->childCategories;
        }
    }

    /**
     * NOTE: Second option with language standard from PHP 8.2 for @see Category::$childCategories::__get()
     *
     * @return Category[]
     */
    public function getChildCategories(): array
    {
        if (null !== $this->childCategories) {
            return $this->childCategories;
        }
        $this->childCategories = CategoryRepository::findByParentId($this->parentCategoryId);
        return $this->childCategories;
    }

}
