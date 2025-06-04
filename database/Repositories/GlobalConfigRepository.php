<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\GlobalConfig;

/**
 * Repository für @see GlobalConfig
 */
class GlobalConfigRepository
{
    /**
     * Findet den Wert einer Config für ein Attribut.
     *
     * @param string $attribute
     * @return string|null
     */
    public static function getValue(string $attribute): ?string
    {
        $config = self::findByAttribute($attribute);
        return $config?->value;
    }

    /**
     * Lädt das Konfigurationsobjekt für ein Attribut
     *
     * @param string $attribute
     * @return GlobalConfig|null
     */
    public static function findByAttribute(string $attribute): ?GlobalConfig
    {
        return QueryAbstraction::fetchOneAs(GlobalConfig::class, "SELECT * FROM globalConfig WHERE attribute = :attr", ["attr" => $attribute]);
    }
}