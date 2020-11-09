<?php

namespace App\Code;

use App\Dto\Exercise;
use InvalidArgumentException;

/**
 * Class InputData
 * @package App\Code
 */
class InputData
{
    /**
     * @var int
     */
    private $total_exercises;

    /**
     * @var Exercise[]
     */
    private $exercises;

    /**
     * InputData constructor.
     * @param string $stdIn
     */
    public function __construct(string $stdIn)
    {
        $raw_data = explode("\n", $stdIn, -1);
        $data_temp = $raw_data;
        $this->total_exercises = (int)array_shift($data_temp);

        if ($this->total_exercises < 1 || 50 < $this->total_exercises) {
            throw new InvalidArgumentException('Constraint 1 <= T <= 50' . PHP_EOL);
        }

        $this->exercises = [];
        for ($i = 0; $i < $this->total_exercises; $i++) {
            [$num_coordinates, $num_blocks] = array_map('intval', explode(' ', $data_temp[2 * $i]));
            $coordinates = array_map(static function ($coordinate) {
                return (int)$coordinate;
            }, explode(' ', $data_temp[2 * $i + 1]));

            $this->exercises[] = new Exercise($num_blocks, $num_coordinates, $coordinates);
        }

        $this->checkConstraints();
    }

    public function checkConstraints(): void
    {
        foreach ($this->exercises as $exercise) {
            $num_coordinates = $exercise->getNumCoordinates();
            if ($num_coordinates < 3 || 20 < $num_coordinates) {
                throw new InvalidArgumentException('Constraint 3 <= N <= 20' . PHP_EOL);
            }

            $num_blocks = $exercise->getTotalBlocks();
            if ($num_blocks < 0 || 5 < $num_blocks) {
                throw new InvalidArgumentException('Constraint 0 <= M <= 5' . PHP_EOL);
            }

            foreach ($exercise->getCoordinates() as $coordinate) {
                if ($coordinate < 0 || 50 < $coordinate) {
                    throw new InvalidArgumentException('Constraint 0 <= X <= 50' . PHP_EOL);
                }
            }
        }
    }

    /**
     * @return Exercise[]
     */
    public function getExercises(): array
    {
        return $this->exercises;
    }
}