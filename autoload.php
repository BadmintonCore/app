<?php


spl_autoload_register(function ($class) {
    $prefixes = [
        'Vestis\\Database\\' => __DIR__ . '/database/',
        'Vestis\\Service\\' => __DIR__ . '/service/',
        'Vestis\\Exception\\' => __DIR__ . '/exception/',
        'Vestis\\Controller\\' => __DIR__ . '/controller/',
        'Vestis\\Utility\\' => __DIR__ . '/utility/',
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        // Check if the class uses this namespace prefix
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            continue;
        }

        // Get the relative class name
        $relativeClass = substr($class, $len);

        // Replace namespace separators with directory separators, and add .php
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

        // If the file exists, require it
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
