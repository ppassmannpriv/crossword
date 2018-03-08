<?php

namespace Crossword\Tests;

use Crossword\Wordlist;

class WordlistTest extends \PHPUnit_Framework_TestCase
{
    public function testListIsSorted()
    {
        $this->markTestSkipped();
        $testList = '';
        $wordlist = new Wordlist;

        $this->assertEquals(
            $testList,
            $wordlist->getList()
        );
    }


}