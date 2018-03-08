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
        $this->grid = new Grid($maxLength, $maxLength, $wordlist);
    }

    public function getCoordinates()
    {
        return $this->grid->getSize();
    }

    public function getGrid()
    {
        return $this->grid->getGrid();
    }

    public function getGridScore()
    {
        return $this->grid->getScore();
    }

    public function toHtml()
    {
        $html = '<div id="puzzle">';
        foreach ($this->getGrid() as $row)
        {
            $html .= '<div class="row">';
                foreach($row as $col)
                {
                    $html .= '<div class="field">';
                        $html .= '<span>'.$col.'</span>';
                    $html .= '</div>';
                }
            $html .= '</div>';
        }
        $html .= '</div>';

        return $html;
    }

    public function toTxt()
    {
        $txt = "\n";
        foreach ($this->getGrid() as $row)
        {
            $txt .= "| ";
            foreach($row as $col)
            {
                $txt .= $col;
                $txt .= " | ";
            }
            $txt .= "\n";
        }

        return $txt;
    }

}