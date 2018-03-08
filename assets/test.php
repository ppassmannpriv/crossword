<?php

require __DIR__ . '/../src/Crosswords.php';
require __DIR__ . '/../src/CrosswordsGrid.php';

$rows = 10;
$cols = 10;

$text = 'spam henrique yahoo zucareli palhaço';

$cw = new Crossword\Crosswords($text);
$cw->makePuzzle();

echo $cw;