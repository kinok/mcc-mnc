<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MccMncExtractor\MccMncExtractor;

$results = MccMncExtractor::extract();

if (isset($results['error']))
    exit(var_export($results, true));

foreach ($results as $result) {
    echo implode(',', $result) . PHP_EOL;
}