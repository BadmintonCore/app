<?php

//Autor(en): Lennart Moog

namespace Vestis\Database\Repositories;

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Models\GlobalConfig;

/**
 * Repository für @see GlobalConfig
 */
class GlobalConfigRepository
{
    /**
     * Findet alle Konfig Einträge paginiert
     *
     * @param int $page
     * @param int $perPage
     * @return PaginationDto<GlobalConfig>
     */
    public static function findAllPaginated(int $page, int $perPage): PaginationDto
    {
        return QueryAbstraction::fetchManyAsPaginated(GlobalConfig::class, "SELECT * FROM globalConfig", $page, $perPage);
    }

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

    /**
     * Aktualisiert eine Konfiguration.
     *
     * @param string $attribute
     * @param string $value
     * @return void
     */
    public static function update(string $attribute, string $value): void
    {
        QueryAbstraction::execute("UPDATE globalConfig SET value = :value WHERE attribute = :attr", ["attr" => $attribute, "value" => $value]);
    }
}
//Autor(en): Lennart Moog
