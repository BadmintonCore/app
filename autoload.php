<?php

//Autor(en): Mathis Burger

/*Funktion, von PHP zur Verfügung gestellt, wenn die Klasse geladen wird, wird diese auch ausgeführt.
Lädt Klassen, wenn sie mit use (Import) genutzt wurden
Zur Laufzeit: Welche Klassen hat man benutzt und dann Laden dieser Klassen
Übergeben wird ein Klassenname (bspw. Vestis\Database\Model\Account)*/
spl_autoload_register(function ($class) {
    // Map die zeigt, welche Präfixes in welchen Ordner liegen
    $prefixes = [
        // Packages (\\, damit es als ein "\" gezählt wird, da Sonderzeichen):
        'Vestis\\Database\\' => __DIR__ . '/database/',
        'Vestis\\Service\\' => __DIR__ . '/service/',
        'Vestis\\Exception\\' => __DIR__ . '/exception/',
        'Vestis\\Controller\\' => __DIR__ . '/controller/',
        'Vestis\\Utility\\' => __DIR__ . '/utility/',
    ];

    // Löst die Map auf (bspw. 'Vestis\\Database\\' => __DIR__ . '/database/')
    foreach ($prefixes as $prefix => $baseDir) {
        // Länge des Präfixes
        $len = strlen($prefix);

        // Überprüfen, ob das Präfix vorhanden ist und in dem Fall sinnvoll
        // Vergleicht char für char eines Strings bis zum Punkt len (in diesem Fall)
        if (strncmp($prefix, $class, $len) !== 0) {
            continue;
        }

        // Ohne Präfix (bspw. Vestis\Database\Model\Account -> Model\Account)
        $relativeClass = substr($class, $len);

        // BaseDir + Ersetzt bei der relativeClass doppeltes \\ mit einem \ und fügt .php als Endung hinzu
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

        // If the file exists, require it
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Erstelle ein Alias für eine Klasse, um das Laden von Konfigurationen übersichtlicher zu machen (damit man nicht immer Global... schreiben muss)
class_alias('\\Vestis\\Database\\Repositories\\GlobalConfigRepository', '\\Vestis\\Database\\Repositories\\GCR');
//Autor(en): Mathis Burger
