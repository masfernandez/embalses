<?php

namespace App\Dto;

/**
 * Class Coordinate
 * @package App\Dto
 */
class Coordinate
{
    public const EMPTY = -1;
    public const BLOCK = 0;
    public const WATER = 1;

    /**
     * @var
     */
    private $x;

    /**
     * @var
     */
    private $y;

    /**
     * Coordinate constructor.
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return int
     */
    public function x(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function y(): int
    {
        return $this->y;
    }
}