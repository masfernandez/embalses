<?php declare(strict_types=1);

use App\Code\InputData;
use App\Code\Reservoir;
use App\Dto\Coordinate;
use App\Dto\Exercise;
use PHPUnit\Framework\TestCase;

final class ReservoirTest extends TestCase
{
    /**
     * @var Reservoir
     */
    private $reservoir;

    public function setUp(): void
    {
        $exercise_mock = $this->createMock(Exercise::class);
        $exercise_mock->expects(self::once())->method('getTotalBlocks')->willReturn(1);
        $exercise_mock->expects(self::once())->method('getCoordinates')->willReturn([1, 2, 1, 0, 3, 1, 2, 2, 1, 2]);
        $input_data_mock = $this->createMock(InputData::class);
        $input_data_mock->expects(self::once())->method('getExercises')->willReturn([$exercise_mock]);
        foreach ($input_data_mock->getExercises() as $exercise) {
            $this->reservoir = new Reservoir($exercise->getTotalBlocks(), $exercise->getCoordinates());
        }
        self::assertNotNull($this->reservoir);
    }

    public function testTotalWater(): void
    {
        $total_water_expected = 5;
        self::assertEquals($total_water_expected, $this->reservoir->totalWater());
    }

    public function testHasBlockAvailable(): void
    {
        self::assertNotNull($this->reservoir);
        $total_blocks_expected = 1;
        self::assertEquals($total_blocks_expected, $this->reservoir->hasBlockAvailable());
    }

    public function testIsBlockPositionValid(): void
    {
        self::assertNotNull($this->reservoir);
        $valid_expected = true;
        self::assertEquals($valid_expected, $this->reservoir->isBlockPositionValid(new Coordinate(9, 2)));
        self::assertEquals(!$valid_expected, $this->reservoir->isBlockPositionValid(new Coordinate(9, 3)));
    }

    public function testInsertBlock(): void
    {
        self::assertNotNull($this->reservoir);
        $total_water_expected = 9;
        $this->reservoir->insertBlock(new Coordinate(9, 2));
        self::assertEquals($total_water_expected, $this->reservoir->totalWater());
    }

    public function testDeleteBlock(): void
    {
        $total_water_expected_before_deletion = 9;
        $total_water_expected_before_after = 5;
        $block = new Coordinate(9, 2);
        $this->reservoir->insertBlock($block);
        self::assertEquals($total_water_expected_before_deletion, $this->reservoir->totalWater());
        $this->reservoir->deleteBlock($block);
        self::assertEquals($total_water_expected_before_after, $this->reservoir->totalWater());
    }
}