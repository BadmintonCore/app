<?php

namespace Vestis\Database\Models;

use Vestis\Database\Repositories\QueryAbstraction;

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
            $parentCategory = QueryAbstraction::fetchOneAs(self::class, "SELECT * FROM category WHERE id = :id", ["id" => $this->parentCategoryId]);
            $this->parentCategory = $parentCategory;
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
            $childCategories = QueryAbstraction::fetchManyAs(self::class, "SELECT * FROM category WHERE parentCategoryId = :id", ["id" => $this->id]);
            $this->childCategories = $childCategories;
            return $childCategories;
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
        $childCategories = QueryAbstraction::fetchManyAs(self::class, "SELECT * FROM category WHERE parentCategoryId = :id", ["id" => $this->id]);
        $this->childCategories = $childCategories;
        return $childCategories;
    }

}
