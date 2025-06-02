<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Models\Image;
use Vestis\Database\Models\ProductType;

/**
 * Repository für @see Image
 */
class ImageRepository
{
    /**
     * Findet alle Bilder paginiert
     *
     * @param int $page Die Seite, die geladen werden soll
     * @return PaginationDto<Image>
     */
    public static function findPaginated(int $page): PaginationDto
    {
        return QueryAbstraction::fetchManyAsPaginated(Image::class, "SELECT * FROM image", $page, 10);
    }

    /**
     * Findet ein Bild anhand seiner ID
     *
     * @param int $id
     * @return Image|null
     */
    public static function findById(int $id): ?Image
    {
        return QueryAbstraction::fetchOneAs(Image::class, "SELECT * FROM image WHERE id = :id", ['id' => $id]);
    }

    /**
     * Findet Bilder anhand ihres Produkt-Typen
     *
     * @param ProductType $productType
     * @return array<int, Image>
     */
    public static function findByProductType(ProductType $productType): array
    {
        return QueryAbstraction::fetchManyAs(Image::class, "SELECT i.* FROM image i JOIN productImage pi ON pi.imageId = i.id WHERE pi.productTypeId = :productId", ["productId" => $productType->id]);
    }

    /**
     * Erstellt ein neues Bild
     *
     * @param string $name Der Name des Bildes
     * @param string $path Der Pfad unter dem das Bild gespeichert ist
     * @return Image|null
     */
    public static function create(string $name, string $path): ?Image
    {
        return QueryAbstraction::executeReturning(Image::class, "INSERT INTO image (name, path) VALUES (:name, :path)", ['name' => $name, 'path' => $path]);
    }

    /**
     * Löscht ein vorhandenes Bild
     *
     * @param int $imageId Die ID des Bildes
     * @return void
     */
    public static function delete(int $imageId): void
    {
        QueryAbstraction::execute("DELETE FROM image WHERE id = :id", ['id' => $imageId]);
    }

}
