<?php

namespace Crossword\Tests;

use Crossword\Puzzle;
use Crossword\Wordlist;

class PuzzleTest extends \PHPUnit_Framework_TestCase
{
    protected $puzzle;

    public function setup()
    {
        $this->puzzle = new Puzzle(new Wordlist);
    }

    public function testPuzzleCanBeLoaded()
    {
        $this->assertEquals(
            '15,15',
            $this->puzzle->getCoordinates()
        );
        var_dump($this->puzzle->toTxt());
    }

}