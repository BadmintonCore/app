<?php

//Autor(en): Mathis Burger

namespace Vestis\Service;

use Vestis\Exception\LogicException;

/**
 * Dienst zum Verwalten eines Cache.
 */
class CacheService
{
    /**
     * Der Pfad in dem die Cache-Dateien gespeichert werden
     */
    private const CACHE_PATH = __DIR__ .'/../cache/';

    /**
     * Die Speicher-Dauer einer Cache-Datei
     */
    private const CACHE_DURATION = 'PT1H';

    /**
     * Prüft, ob ein Element im Cache vorhanden ist und gibt dieses zurück
     *
     * @param string $key Der Key des Cache-Elementes
     * @return mixed
     * @throws LogicException
     */
    public static function get(string $key): mixed
    {
        $jsonContent = self::getCacheContent($key);
        if ($jsonContent === null) {
            return null;
        }
        if ($jsonContent['timestamp'] < (new \DateTimeImmutable())->getTimestamp()) {
            self::deleteFile($key);
            return null;
        }
        return $jsonContent['data'];
    }

    /**
     * Setzt ein Cache-Element
     *
     * @param string $key Der Key des Cache-Elementes
     * @param mixed $value Der Wert, der gesetzt werden soll
     * @return void
     */
    public static function set(string $key, mixed $value): void
    {
        $location = self::CACHE_PATH . md5($key);
        $timestamp = (new \DateTimeImmutable())->add(new \DateInterval(self::CACHE_DURATION))->getTimestamp();
        $data = [
            'timestamp' => $timestamp,
            'data' => $value,
        ];
        file_put_contents($location, json_encode($data));
    }

    /**
     * Lädt den internen JSON inhalt einer Cache-Datei. Gibt null zurück, wenn eine Datei nicht existiert
     *
     * @param string $key Der Cache-Key, dessen Datei geladen werden soll
     * @return array<string, mixed>|null
     */
    private static function getCacheContent(string $key): ?array
    {
        $location = self::CACHE_PATH . md5($key);
        if (!file_exists($location)) {
            return null;
        }
        $fileContent = file_get_contents($location);
        if ($fileContent === false) {
            return null;
        }

        $jsonContent = json_decode($fileContent, true);
        if ($jsonContent === null) {
            return null;
        }
        return $jsonContent;
    }

    /**
     * Löscht eine Datei
     *
     * @param string $key Der Key des Cache-Elementes, zu dem die Datei gehört
     * @return void
     * @throws LogicException
     */
    private static function deleteFile(string $key): void
    {
        // md5 ist ein Hashing-Algorithmus
        $location = self::CACHE_PATH . md5($key);
        if (unlink($location) === false) {
            throw new LogicException("Unable to delete cache file.");
        }
    }

}
//Autor(en): Mathis Burger
