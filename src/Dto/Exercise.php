<?php

namespace App\Dto;

/**
 * Class Exercise
 * @package App\Dto
 */
class Exercise
{
    /**
     * @var
     */
    private $total_blocks;

    /**
     * @var
     */
    private $num_coordinates;

    /**
     * @var
     */
    private $coordinates;

    /**
     * Exercise constructor.
     * @param $total_blocks
     * @param $num_coordinates
     * @param $coordinates
     */
    public function __construct($total_blocks, $num_coordinates, $coordinates)
    {
        $this->total_blocks = $total_blocks;
        $this->num_coordinates = $num_coordinates;
        $this->coordinates = $coordinates;
    }

    /**
     * @return int
     */
    public function getTotalBlocks(): int
    {
        return $this->total_blocks;
    }

    /**
     * @return mixed
     */
    public function getNumCoordinates()
    {
        return $this->num_coordinates;
    }

    /**
     * @return array
     */
    public function getCoordinates(): array
    {
        return $this->coordinates;
    }
}