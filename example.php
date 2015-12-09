<?php

require_once __DIR__ . '/vendor/autoload.php';



$expressions = [
    '(1 > 2 AND 3 < 2) OR 1+2 == 3',
    '(3 > 2) AND (3 < 5)',
    '(1 > 2) OR (3 < 5)',
    '(1 > 2) OR (6 > 5)',
    '(1 > 2) OR (6 < 5)',
    '1 + 2 == 3',
    '2 < 1 + 2',
    '(2 < 1) + 2',
    '((2 < 1) + 2) == 2',
    '-8/-2',
    '-8/2',
    '-8/-2 + 15 * 1',
];

$exEngine = new \ExpressionEvaluator\Engine();

foreach ($expressions as $expression) {
    echo $expression . PHP_EOL;
    echo $exEngine->evaluate($expression) . PHP_EOL;
    echo '------------------' . PHP_EOL;
}
