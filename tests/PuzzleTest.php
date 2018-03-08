<?php

namespace Crossword\Tests;

use Crossword\Puzzle;
use Crossword\Wordlist;

class PuzzleTest extends \PHPUnit_Framework_TestCase
{

    public function testPuzzleCanBeLoaded()
    {
        $puzzle = new Puzzle(new Wordlist);

        $this->assertEquals(
            '15,15',
            $puzzle->getCoordinates()
        );
    }

}