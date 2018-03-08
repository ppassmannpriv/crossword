<?php

namespace Crossword;

class Grid
{

    protected $col;
    protected $row;
    protected $grid;
    protected $wordlist;
    protected $currentList;
    protected $horizontal = 0;
    protected $vertical = 0;

    public function __construct(int $col, int $row, Wordlist $wordlist)
    {
        $this->col = $col;
        $this->row = $row;
        $this->wordlist = $wordlist;

        $this->buildGrid();
    }

    public function getGrid(): array
    {
        if (empty($this->grid)) {
            $this->buildGrid();
        }
        return $this->grid;
    }

    private function buildGrid()
    {
        $rows = [];
        $i = 1;
        while ($i <= $this->row) {
            $row = [];
            $j = 1;
            while ($j <= $this->col) {
                $row[] = '-';
                $j++;
            }
            $rows[] = $row;
            $i++;
        }
        $this->grid = $rows;

        $this->fillGrid();
    }

    public function isFieldEmtpy(int $row, int $col): bool
    {
        if (isset($this->grid[$row - 1][$col - 1])) {
            return $this->grid[$row - 1][$col - 1] === '-';
        }
        return false;
    }

    public function getSize()
    {
        return $this->row . ',' . $this->col;
    }

    public function getScore()
    {
        return $this->horizontal . ', ' . $this->vertical;
    }

    protected function fillGrid()
    {
        $this->setFirstWord();
        foreach ($this->wordlist->getList() as $word) {
            if ($word->getPlacedFlag()) {
                continue;
            }
            $this->fitWordInGrid($word);
        }
    }

    private function setFirstWord()
    {
        $count = 0;
        $firstWord = $this->wordlist->getList()[0];
        foreach (str_split($firstWord->getWord()) as $char) {
            $this->grid[0][$count] = $char;
            $count++;
        }
        $firstWord->setPlacedFlag(true);
        $this->currentList[] = $firstWord;
        if ($firstWord->getDirection() === 'horizontal') {
            $this->horizontal++;
        } else {
            $this->vertical++;
        }
    }

    private function suggestCoordinates(Word $word)
    {
        $coords = [];
        foreach(\str_split($word->getWord()) as $char)
        {
            $coords = array_merge($this->checkCharMatch($char), $coords);
        }
        $word->setCoords($coords);
        var_dump($word->getWord());
        var_dump(count($coords));
    }

    private function checkCharMatch($char)
    {
        $coords = [];
        $cRow = 0;
        foreach($this->grid as $row)
        {
            $cRow++;
            $cCol = 0;
            foreach($row as $cell)
            {
                $cCol++;
                if($cell === $char)
                {
                    $coords[] = $cRow.', '.$cCol;
                }
            }
        }

        return $coords;
    }

    private function fitWordInGrid(Word $word)
    {
        $this->suggestCoordinates($word);
    }
}