<?php

namespace Vestis\Database\Models;

use Vestis\Database\Repositories\CategoryRepository;

/**
 * Das Model für eine Kategorie in der Datenbank
 */
class Category
{
    public int $id;

    public string $name;

    public ?int $parentCategoryId;

    private ?Category $parentCategory = null;

    /**
     * @var array<int, Category>|null
     */
    private ?array $childCategories = null;

    /**
     * Gibt alle untergeordneten Kategorien zurück
     *
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

    /**
     * Gibt die übergeordnete Kategorie (falls vorhanden) zurück
     *
     * @return Category|null
     */
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
