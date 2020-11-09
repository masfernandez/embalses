<?php declare(strict_types=1);

use App\Code\App;
use App\Code\InputData;
use PHPUnit\Framework\TestCase;

final class FunctionalTest extends TestCase
{
    public function testRun(): void
    {
        $results_expected = [
            1 => 9,
            2 => 6,
            3 => 1,
            4 => 0,
            5 => 3,
            6 => 16,
            7 => 209
        ];
        $exercises_file = dirname(__DIR__) . '/data/input_file';
        $fileIn = file_get_contents($exercises_file);
        $results = (new App(new InputData($fileIn)))->run();
        foreach ($results as $idx => $result) {
            self::assertEquals($results_expected[$idx], $result);
        }
    }
}