<?php

namespace Crossword\Tests;

use Crossword\Grid;

class GridTest extends \PHPUnit_Framework_TestCase
{
    public function testGridHasGivenSizeAndSpace()
    {
        $testGrid = [
            0 => [0 => '-', 1 => '-', 2 => '-'],
            1 => [0 => '-', 1 => '-', 2 => '-'],
            2 => [0 => '-', 1 => '-', 2 => '-']
        ];
        $grid = new Grid(3,3);
        $this->assertSame(
            $testGrid,
            $grid->getGrid()
        );
    }

    public function testFieldInGridIsEmpty()
    {
        $grid = new Grid(10,10);
        $this->assertEquals(
            true,
            $grid->isFieldEmtpy(5,6)
        );
    }
}