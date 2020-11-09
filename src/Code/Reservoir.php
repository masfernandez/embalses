<?php

namespace App\Code;

use App\Dto\Coordinate;

/**
 * Class Reservoir
 * @package App\Code
 */
class Reservoir
{
    /**
     * @var array
     */
    private $coordinates;

    /**
     * @var int
     */
    private $blocks;

    /**
     * @var int
     */
    private $water;

    /**
     * @var int
     */
    private $wide;

    /**
     * @var int
     */
    private $steps;

    /**
     * Reservoir constructor.
     * @param int $blocks
     * @param array $coordinates
     */
    public function __construct(int $blocks = 0, array $coordinates = [])
    {
        $this->blocks = $blocks;
        $this->coordinates = $coordinates;
        $this->initData();
    }

    /**
     *
     */
    private function initData(): void
    {
        $tall = 0;
        foreach ($this->coordinates as $x => $value) {
            $tall = ($value > $tall) ? $value : $tall;
        }

        $this->wide = count($this->coordinates);
        $max_tall = ($tall + $this->blocks);
        $this->steps = $this->wide * $max_tall;

        $board = [];
        for ($i = 0; $i < $max_tall; $i++) {
            foreach ($this->coordinates as $x => $y) {
                $board[$i][$x] = ($i < $y) ? Coordinate::BLOCK : Coordinate::EMPTY;
            }
        }

        $this->coordinates = $board;
        $this->buildWater();
    }

    /**
     *
     */
    private function buildWater(): void
    {
        $this->water = 0;
        foreach ($this->coordinates as $y => $coordinates) {
            $this->rebuildWaterRow($y);
        }
    }

    /**
     * @param int $row
     */
    private function rebuildWaterRow(int $row): void
    {
        foreach ($this->coordinates[$row] as $x => $value) {
            if ($this->coordinates[$row][$x] === Coordinate::WATER) {
                $this->coordinates[$row][$x] = Coordinate::EMPTY;
                $this->water--;
            }
        }
        foreach ($this->coordinates[$row] as $x => $value) {
            if ($this->isWaterPositionValid(new Coordinate($x, $row))) {
                $this->coordinates[$row][$x] = Coordinate::WATER;
                $this->water++;
            }
        }
    }

    /**
     * @param Coordinate $c
     * @return bool
     */
    private function isWaterPositionValid(Coordinate $c): bool
    {
        $y = $c->y();
        $x = $c->x();
        if ($this->coordinates[$y][$x] !== Coordinate::EMPTY) {
            return false;
        }

        if ($x === 0 || $x === ($this->wide - 1)) {
            return false;
        }

        $inf = $sup = false;
        foreach ($this->coordinates[$y] as $index => $value) {
            if (!$inf && $index < $x) {
                $inf = $this->coordinates[$y][$index] === Coordinate::BLOCK;
            } else if (!$sup && $index > $x) {
                $sup = $this->coordinates[$y][$index] === Coordinate::BLOCK;
            }
        }
        return ($inf && $sup);
    }

    /**
     * @return bool
     */
    public function hasBlockAvailable(): bool
    {
        return $this->blocks > 0;
    }

    /**
     * @return array
     */
    public function getCoordinates(): array
    {
        return $this->coordinates;
    }

    /**
     * @param Coordinate $c
     * @return bool
     */
    public function isCurrentCoordinateSolution(Coordinate $c): bool
    {
        return ($c->x() + 1) * ($c->y() + 1) === $this->steps;
    }

    /**
     * @return int
     */
    public function totalWater(): int
    {
        return $this->water;
    }

    /**
     * @param Coordinate $c
     * @return bool
     */
    public function isBlockPositionValid(Coordinate $c): bool
    {
        $y = $c->y();
        $x = $c->x();
        $empty = $this->coordinates[$y][$x] === Coordinate::EMPTY;
        if ($y > 0) {
            $below_is_block = $this->coordinates[$y - 1][$x] === Coordinate::BLOCK;
            return $below_is_block && $empty;
        }
        return $empty;
    }

    /**
     * @param Coordinate $c
     */
    public function insertBlock(Coordinate $c): void
    {
        $y = $c->y();
        $x = $c->x();
        $this->coordinates[$y][$x] = Coordinate::BLOCK;
        $this->blocks--;
        $this->rebuildWaterRow($y);
    }

    /**
     * @param Coordinate $c
     */
    public function deleteBlock(Coordinate $c): void
    {
        $y = $c->y();
        $x = $c->x();
        $this->coordinates[$y][$x] = Coordinate::EMPTY;
        $this->blocks++;
        $this->rebuildWaterRow($y);
    }
}