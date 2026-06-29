<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

// Project-wide PHP-CS-Fixer configuration.
// Local overrides can be placed in .php-cs-fixer.php
$finder = Finder::create()
    ->in([
        __DIR__ . '/lib',
    ])
    ->exclude([
        'vendor',
    ]);

return (new Config())
    ->setRules([
        '@PSR12'                       => true,
        'declare_strict_types'         => false,
        'yoda_style'                   => false,
        'concat_space'                 => ['spacing' => 'one'],
        'native_function_invocation'   => false,
        'fully_qualified_strict_types' => false,
        'global_namespace_import'      => false,
        'phpdoc_to_comment'            => false,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder);