<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Models\Image;
use Vestis\Database\Models\ProductType;

class ImageRepository
{
    /**
     * @param int $page
     * @return PaginationDto<Image>
     */
    public static function findPaginated(int $page): PaginationDto
    {
        return QueryAbstraction::fetchManyAsPaginated(Image::class, "SELECT * FROM image", $page, 10);
    }

    public static function findById(int $id): ?Image
    {
        return QueryAbstraction::fetchOneAs(Image::class, "SELECT * FROM image WHERE id = :id", ['id' => $id]);
    }

    /**
     * @param ProductType $productType
     * @return array<int, Image>
     */
    public static function findByProductType(ProductType $productType): array
    {
        return QueryAbstraction::fetchManyAs(Image::class, "SELECT i.* FROM image i JOIN productImage pi ON pi.imageId = i.id WHERE pi.productTypeId = :productId", ["productId" => $productType->id]);
    }

    public static function create(string $name, string $path): Image
    {
        return QueryAbstraction::executeReturning(Image::class, "INSERT INTO image (name, path) VALUES (:name, :path)", ['name' => $name, 'path' => $path]);
    }

}
