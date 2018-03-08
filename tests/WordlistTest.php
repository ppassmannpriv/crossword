<?php

namespace Crossword\Tests;

use Crossword\Wordlist;

class WordlistTest extends \PHPUnit_Framework_TestCase
{
    public function testListIsSorted()
    {
        $testList = '';
        $wordlist = new Wordlist;
        var_dump($wordlist->getList());
        $this->assertEquals(
            $testList,
            $wordlist->getList()
        );
    }
}