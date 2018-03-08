<?php

namespace Crossword;

class Crosswords {
    const RIGHT = 0;
    const DOWN = 1;
    const EMPTY_CHAR = '*';
    const MAX_TRIES = 30;

    private $_words;
    private $_grid;
    private $_options;
    private $_nTries = 0;

    public function __construct($text, $options=null) {
        $rows = 10;
        $cols = 10;
        $this->setOptions($options);
        $this->setGrid(new CrossWordsGrid($rows, $cols));
        $this->setWords($text);
    }

    public function setOptions($options) {
        $this->_options = $options;
    }

    public function getOptions() {
        return $this->_options;
    }

    private function _validateWords($word, $index, &$options) {
        if (strlen($word) > $options->maxWordLen) {
            $options->invalid[$index] = $word;
        }
    }

    public function setWords($text) {
        $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
        $words = explode(' ', $text);
        $invalidWords = array();
        $maxWordLen = max($this->getGrid()->getNumRows(), $this->getGrid()->getNumCols());
        $params = (object) array(
            'grid' => $this->getGrid(),
            'invalid' => &$invalidWords,
            'maxWordLen' => $maxWordLen
        );
        array_walk($words, array($this, '_validateWords'), $params);
        if (count($invalidWords)) {
            throw new Exception("Words " . implode(', ', $invalidWords) . ' exceeds the max word length');
        }
        $words = array_map('strtoupper', $words);
        $this->_words = $words;
    }

    public function getWords() {
        return $this->_words;
    }

    public function setGrid($grid) {
        $this->_grid = $grid;
    }

    public function getGrid() {
        return $this->_grid;
    }

    public function reset() {
        $this->_nTries = 0;
        $this->getGrid()->reset();
    }

    public function _fillRowWithRandomChars(&$letter, $index, $row) {
        if ($letter == self::EMPTY_CHAR) {
            #$letter = CrossWords::getRandomChar();
            $letter = '-';
        }
        $this->getGrid()->set($row, $index, $letter);
    }

    public function makePuzzle() {
        foreach ($this->_words as $word) {
            $this->putWord($word);
        }
        if (!$this->getOptions()->nofill) {
            foreach (range(0, $this->getGrid()->getNumRows() - 1) as $row) {
                array_walk($this->getGrid()->get($row), array($this, '_fillRowWithRandomChars'), $row);
            }
        }
    }

    public function log($text) {
        if ($this->getOptions()->verbose) {
            echo $text . PHP_EOL;
        }
    }

    public function getNextRandom() {
        $n = mt_rand(0, $this->getGrid()->getNumCols() * $this->getGrid()->getNumRows());
        //$n = 100;
        $this->log('rand:' . $n);
        return $n;
    }

    public function putWord($word) {
        $this->_nTries = 0;
        $this->log(str_pad('', 40, '-'));
        $textLength = strlen($word);

        $direction = mt_rand(0, 1);
        //$direction = 1;
        $this->log('Texto:' . $word);
        $this->log('Tamanho texto:' . $textLength);
        $this->log('dir:' . $direction);


        switch ($direction) {
            case self::DOWN:
                while (true) {
                    if ($this->_nTries > self::MAX_TRIES) {
                        throw new Exception('Max');
                        break;
                    }
                    $n = $this->getNextRandom();
                    $row = intval($n / $this->getGrid()->getNumCols());
                    $col = $n % $this->getGrid()->getNumCols();
                    $this->log('row:' . $row);
                    $this->log('col:' . $col);
                    $allowed = $row + $textLength <= $this->getGrid()->getNumRows();

                    if (!$allowed) {
                        $this->log($n . ' nÄ‚Åo deu');
                        $this->_nTries++;
                        continue;
                    }

                    for ($x = $row, $letter = 0; $x < $textLength + $row; $x++, $letter++) {
                        if ($this->getGrid()->get($x, $col) != self::EMPTY_CHAR) {
                            if ($word{$letter} != $this->getGrid()->get($x, $col)) {
                                continue 2;
                            }
                        }
                    }

                    for ($x = $row, $letter = 0; $x < $textLength + $row; $x++, $letter++) {
                        $this->getGrid()->set($x, $col, $word{$letter});
                    }
                    break;
                }
                break;
            case self::RIGHT:
                while (true) {
                    if ($this->_nTries > self::MAX_TRIES) {
                        throw new Exception('Max');
                        break;
                    }
                    $n = $this->getNextRandom();
                    $row = intval($n / $this->getGrid()->getNumCols());
                    $col = $n % $this->getGrid()->getNumCols();
                    $this->log('row:' . $row);
                    $this->log('col:' . $col);
                    $allowed = (
                            $n <= $this->getGrid()->getNumCols() * $this->getGrid()->getNumRows() - $textLength)
                        && ($col + $textLength <= $this->getGrid()->getNumCols()
                        );

                    if (!$allowed) {
                        $this->log($n . ' nÄ‚Åo deu');
                        $this->_nTries++;
                        continue;
                    }
                    for ($x = $col, $letter = 0; $x < $textLength + $col; $x++, $letter++) {
                        if ($this->getGrid()->get($row, $x) != self::EMPTY_CHAR) {
                            if ($word{$letter} != $this->getGrid()->get($row, $x)) {
                                continue 2;
                            }
                        }
                    }

                    for ($x = $col, $letter = 0; $x < $textLength + $col; $x++, $letter++) {
                        $this->getGrid()->set($row, $x, $word{$letter});
                    }
                    //print_r($this->getGrid());
                    break;
                }
            default:
                break;
        }
    }

    public function __toString() {
        if ($this->getOptions()->name) {
            echo 'Words: '. PHP_EOL;
            echo implode(', ', $this->getWords());
            echo PHP_EOL;
        }
        if ($this->getOptions()->html) {
            return $this->getGrid()->toHtmlTable();
        }
        return $this->getGrid()->__toString();
    }

    public static function getRandomChar() {
        return sprintf('%1c', mt_rand(65, 90));
    }


}