<?php

require __DIR__ . '/../src/Puzzle.php';
require __DIR__ . '/../src/Wordlist.php';
require __DIR__ . '/../src/Word.php';
require __DIR__ . '/../src/Grid.php';

$puzzle = new Crossword\Puzzle(new Crossword\Wordlist);

echo $puzzle->toTxt();
