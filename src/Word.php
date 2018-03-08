<?php

namespace Crossword;

class Word
{
    protected $word;
    protected $clue;
    protected $length;
    protected $col;
    protected $row;
    protected $direction;
    protected $placed = false;
    protected $coords = [];

    public function __construct(string $word, string $clue)
    {
        $this->word = $word;
        $this->clue = $clue;
    }

    public function getLength()
    {
        if(empty($this->length))
        {
            $this->length = \strlen($this->word);
        }
        return $this->length;
    }

    public function getWord()
    {
        return $this->word;
    }

    public function getClue()
    {
        return $this->clue;
    }

    public function getDirection()
    {
        return $this->direction;
    }

    public function setDirection(string $direction)
    {
        $this->direction = $direction;
    }

    public function getCol()
    {
        return $this->col;
    }

    public function setCol($col)
    {
        $this->col = $col;
    }

    public function getRow()
    {
        return $this->row;
    }

    public function setRow($row)
    {
        $this->row = $row;
    }

    public function setPlacedFlag(bool $placed)
    {
        $this->placed = $placed;
    }

    public function getPlacedFlag() : bool
    {
        return $this->placed;
    }

    public function getCoords() : array
    {
        return $this->coords;
    }

    public function setCoords(array $coords)
    {
        return $this->coords = $coords;
    }
}