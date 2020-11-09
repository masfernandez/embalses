<?php

namespace App\Code;

use App\Dto\Coordinate;

/**
 * Class App
 * @package App\Code
 */
class App
{
    /**
     * @var InputData
     */
    private $data;

    /**
     * @var Reservoir
     */
    private $best;

    /**
     * App constructor.
     * @param InputData $data
     */
    public function __construct(InputData $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function run(): array
    {
        $results = [];
        foreach ($this->data->getExercises() as $idx => $exercise) {
            $this->best = new Reservoir();
            $base = new Reservoir($exercise->getTotalBlocks(), $exercise->getCoordinates());
            $this->buildReservoir($base, false);
            $results[$idx + 1] = $this->best->totalWater();
        }
        return $results;
    }

    /**
     * @param Reservoir $reservoir
     * @param bool $isFinished
     */
    private function buildReservoir(Reservoir $reservoir, bool $isFinished): void
    {
        if ($isFinished) {
            if ($reservoir->totalWater() > $this->best->totalWater()) {
                $this->best = clone $reservoir;
            }
        } else {
            foreach ($reservoir->getCoordinates() as $y => $coordinates) {
                foreach ($coordinates as $x => $value) {
                    $c = new Coordinate($x, $y);
                    if (!$reservoir->isCurrentCoordinateSolution($c)) {
                        if ($reservoir->hasBlockAvailable() && $reservoir->isBlockPositionValid($c)) {
                            $reservoir->insertBlock($c);
                            $this->buildReservoir($reservoir, false);
                            $reservoir->deleteBlock($c);
                        }
                    } else {
                        $this->buildReservoir($reservoir, true);
                    }
                }
            }
        }
    }
}