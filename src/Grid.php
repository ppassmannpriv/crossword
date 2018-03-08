<?php

namespace Crossword;

class Grid {

    protected $col;
    protected $row;
    protected $grid;

    public function __construct(int $col, int $row)
    {
        $this->col = $col;
        $this->row = $row;

        $this->buildGrid();
    }

    public function getGrid()
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
    }

    public function isFieldEmtpy(int $row, int $col)
    {
        return $this->grid[$row - 1][$col - 1] === '-';
    }
}