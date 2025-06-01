<?php

namespace Vestis\Service;

use Vestis\Database\Repositories\ProductRepository;

class DeletionValidationService
{
    public static function validateColorDeletion(int $colorId): ?string
    {
        $isUsed = ProductRepository::hasColor($colorId);

        if($isUsed){
            return "Diese Farbe wird noch verwendet und kann nicht gelöscht werden.";
        }
        return null;
    }
}