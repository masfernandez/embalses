<?php

namespace App;

require dirname(__DIR__) . '/vendor/autoload.php';

use App\Code\App;
use App\Code\InputData;
use InvalidArgumentException;

try {
    $fh = fopen('php://stdin', 'rb') or die($php_errormsg);
    $stdIn = fgets($fh);
    if ((int)$stdIn < 1 || 50 < (int)$stdIn) {
        throw new InvalidArgumentException('Restriction 1 <= T <= 50' . PHP_EOL);
    }
    for ($i = 0; $i < (int)$stdIn * 2; $i++) {
        $stdIn .= fgets($fh);
    }
    $results = (new App(new InputData($stdIn)))->run();
    foreach ($results as $exercise_idx => $water) {
        echo sprintf("Case #%s: %s", $exercise_idx, $water) . PHP_EOL;
    }
} catch (InvalidArgumentException $ex) {
    echo sprintf('Opps, something unexpected happened: %s', $ex->getMessage());
}