<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude(['vendor', 'sql', 'json', 'conf', '.github'])
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
    ])
    ->setFinder($finder);