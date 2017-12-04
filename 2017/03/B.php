<?php

// TODO: explain whats going on

$input = 368078;

// initial state
$gridValues = [1];
$gridCoord = [['x' => 0, 'y' => 0]];

// moves
$move = 'right';
$nextMoves = [
    'right' => 'up',
    'up' => 'left',
    'left' => 'down',
    'down' => 'right'
];

// number of times each move is to be performed
$iteration = 1;

while (true) {
    for ($j = 0; $j < 2; $j++) {
        $found = action($move, $iteration);

        if ($found) {
            break 2;
        }

        $move = $nextMoves[$move];
    }

    $iteration += 1;
}

function calculateAdjacentSum($coord)
{
    global $gridCoord;
    global $gridValues;

    $sum = 0;

    $x = $coord['x'];
    $y = $coord['y'];

    $adjacents = [[1, 0], [1, 1], [0, 1], [-1, 1], [-1, 0], [-1, -1], [0, -1], [1, -1]];

    foreach ($adjacents as $key => $value) {
        $index = array_search(['x' => $x + $value[0], 'y' => $y + $value[1]], $gridCoord);
        if ($index !== false) {
            $sum += $gridValues[$index];
        }
    }

    return $sum;
}

function action($direction, $iteration)
{
    global $gridCoord;
    global $gridValues;
    global $input;

    $steps = [
        'right' => [1, 0],
        'up' => [0, 1],
        'left' => [-1, 0],
        'down' => [0, -1]
    ];

    for ($i = 0; $i < $iteration; $i++) {
        $nextX = end($gridCoord)['x'] + $steps[$direction][0];
        $nextY = end($gridCoord)['y'] + $steps[$direction][1];

        $next = ['x' => $nextX, 'y' => $nextY];

        $gridCoord[] = $next;
        $gridValues[] = calculateAdjacentSum($next);

        if (end($gridValues) > $input) {
            return true;
        }
    }

    return false;
}

echo end($gridValues); // 369601
