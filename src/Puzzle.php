<?php

namespace Crossword;

class Puzzle {

    protected $wordlist;
    protected $grid;

    public function __construct(
        Wordlist $wordlist
    )
    {
        $this->wordlist = $wordlist;
        $maxLength = $wordlist->getMaxLength();
        $this->grid = new Grid($maxLength, $maxLength);
    }

    public function getCoordinates()
    {
        return $this->grid->getSize();
    }

}