<?php declare(strict_types=1);

use App\Code\InputData;
use App\Dto\Exercise;
use PHPUnit\Framework\TestCase;

final class InputDataTest extends TestCase
{
    public function testInputData(): void
    {
        $exercises_file = dirname(__DIR__, 2) . '/data/inputdata_tests_1';
        $fileIn = file_get_contents($exercises_file);
        $input_data = new InputData($fileIn);
        $exercises = $input_data->getExercises();

        $expected_exercises = [
            new Exercise(
                1,
                10,
                [1, 2, 1, 0, 3, 1, 2, 2, 1, 2])
        ];

        foreach ($exercises as $key => $exercise) {
            self::assertEquals($expected_exercises[$key], $exercise);
        }

        // total exercises test
        self::assertCount(count($expected_exercises), $exercises);
    }

    public function testTConstraintsInf(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $exercises_file = dirname(__DIR__, 2) . '/data/t_const_1';
        $fileIn = file_get_contents($exercises_file);
        new InputData($fileIn);
    }

    public function testTConstraintsSup(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $exercises_file = dirname(__DIR__, 2) . '/data/t_const_2';
        $fileIn = file_get_contents($exercises_file);
        new InputData($fileIn);
    }

    public function testNConstraintsInf(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $exercises_file = dirname(__DIR__, 2) . '/data/n_const_1';
        $fileIn = file_get_contents($exercises_file);
        new InputData($fileIn);
    }

    public function testNConstraintsSup(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $exercises_file = dirname(__DIR__, 2) . '/data/n_const_2';
        $fileIn = file_get_contents($exercises_file);
        new InputData($fileIn);
    }

    public function testMConstraintsInf(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $exercises_file = dirname(__DIR__, 2) . '/data/m_const_1';
        $fileIn = file_get_contents($exercises_file);
        new InputData($fileIn);
    }

    public function testMConstraintsSup(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $exercises_file = dirname(__DIR__, 2) . '/data/m_const_2';
        $fileIn = file_get_contents($exercises_file);
        new InputData($fileIn);
    }

    public function testXConstraintsInf(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $exercises_file = dirname(__DIR__, 2) . '/data/x_const_1';
        $fileIn = file_get_contents($exercises_file);
        new InputData($fileIn);
    }

    public function testXConstraintsSup(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $exercises_file = dirname(__DIR__, 2) . '/data/x_const_2';
        $fileIn = file_get_contents($exercises_file);
        new InputData($fileIn);
    }
}