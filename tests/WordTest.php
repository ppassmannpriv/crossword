<?php

namespace Crossword\Tests;

use Crossword\Word;

class WordTest extends \PHPUnit_Framework_TestCase
{
    public function testWordLengthIsCorrect()
    {
        $word = new Word('KONFORM', 'EINIG');
        $this->assertEquals(
            7,
            $word->getLength()
        );
    }

    public function testWordDirectionCanBeSet()
    {
        $word = new Word('KONFORM', 'EINIG');
        $word->setDirection('horizontal');
        $this->assertEquals(
            'horizontal',
            $word->getDirection()
        );
    }

    public function testColCanBeSetOnWord()
    {
        $word = new Word('KONFORM', 'EINIG');
        $word->setCol(3);
        $this->assertEquals(
            3,
            $word->getCol()
        );
    }

    public function testRowCanBeSetOnWord()
    {
        $word = new Word('KONFORM', 'EINIG');
        $word->setRow(3);
        $this->assertEquals(
            3,
            $word->getRow()
        );
    }
}