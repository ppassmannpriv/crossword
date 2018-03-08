<?php

namespace Crossword;

class Grid {

    protected $col;
    protected $row;
    protected $grid;
    protected $wordlist;

    public function __construct(int $col, int $row, Wordlist $wordlist)
    {
        $this->col = $col;
        $this->row = $row;
        $this->wordlist = $wordlist;

        $this->buildGrid();
    }

    public function getGrid() : array
    {
        if(empty($this->grid))
        {
            $this->buildGrid();
        }
        return $this->grid;
    }

    private function buildGrid()
    {
        $rows = [];
        $i = 1;
        while($i <= $this->row)
        {
            $row = [];
            $j = 1;
            while($j <= $this->col)
            {
                $row[] = '-';
                $j++;
            }
            $rows[] = $row;
            $i++;
        }
        $this->grid = $rows;

        $this->fillGrid();
    }

    public function isFieldEmtpy(int $row, int $col) : bool
    {
        return $this->grid[$row - 1][$col - 1] === '-';
    }

    public function getSize()
    {
        return $this->row.','.$this->col;
    }

    protected function fillGrid()
    {
        $this->setFirstWord();
    }

    private function setFirstWord()
    {
        $count = 0;
        foreach(str_split($this->wordlist->getList()[0]->getWord()) as $char)
        {
            $this->grid[0][$count] = $char;
            $count++;
        }
    }
}