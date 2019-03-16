<?php

namespace MorrisPhp\ProjectEuler;

require __DIR__ . '/../vendor/autoload.php';

$solutions = array_map(function ($file) {
    return pathinfo($file, PATHINFO_FILENAME);
}, glob(__DIR__ . '/Solution/*'));

foreach ($solutions as $index => $solution) {
    echo ++$index . ') ' . $solution . PHP_EOL;
}

$choice = readline('Which solution would you like to run? ') - 1;

$solution = __NAMESPACE__ . '\\Solution\\' . $solutions[$choice];

echo "Running " . $solution . "..." . PHP_EOL . PHP_EOL;

echo "Result: " . (new $solution)->calculate() . PHP_EOL;
