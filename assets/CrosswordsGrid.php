<?php

namespace Crossword;

class CrossWordsGrid {

    private $_rows;
    private $_cols;
    private $_matrix = null;

    public function __construct($rows, $cols) {
        $this->_rows = $rows;
        $this->_cols = $cols;
        $this->_matrix = $this->_makeGrid($rows, $cols);
    }

    protected function _makeGrid($rows, $cols) {
        $grid = new \ArrayObject();
        foreach (range(0, $rows - 1) as $row) {
            $grid[$row] = array_map(function() {
                return CrossWords::EMPTY_CHAR;
            }, range(0, $cols - 1));
            //$grid[$row] = array_map(function() { return call_user_func(array('CrossWords', 'test')); }, range(0, $cols-1));
        }
        return $grid;
    }

    public function get($x = null, $y = null) {
        if ($x === null) {
            return $this->_matrix;
        }
        if ($y === null) {
            return $this->_matrix[$x];
        }
        return $this->_matrix[$x][$y];
    }

    public function set($x, $y, $value=null) {
        $this->_matrix[$x][$y] = $value;
    }

    public function getNumRows() {
        return $this->_rows;
    }

    public function getNumCols() {
        return $this->_cols;
    }

    public function reset() {
        $this->_matrix = $this->_makeGrid($this->_rows, $this->_cols);
    }


    public function __toString() {
        $rows = count($this->get());
        $sRows = array();
        foreach (range(0, $rows - 1) as $row) {
            $sRows[] = implode(' ', $this->get($row));
        }
        return implode(PHP_EOL, $sRows);
    }

    public function toHtmlTable() {
        $rows = count($this->get());
        $sRows = array();

        foreach (range(0, $rows - 1) as $row) {
            $line = '<tr>';
            foreach ($this->get($row) as $cell) {
                $line .= '<td>' .   $cell . '<td>';
            }
            $line .= '</tr>';
            $sRows[] = $line;
        }

        $table = '<table>';
        $table .= implode(PHP_EOL, $sRows);
        $table .= '</table>';
        return $table;
    }

}