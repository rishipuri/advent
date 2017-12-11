<?php

function getInput()
{
    $input = file_get_contents(__DIR__ . '/input.txt');
    clean($input);

    return $input;
}

function clean(&$content)
{
    $content = explode(',', trim($content));
}

function calculateDistance($paths)
{
    $q = 0;
    $r = 0;
    $furthestDistance = 0;

    $hexStart = [$q, $r];

    foreach ($paths as $path) {
        if ($path === 'ne') {
            $q += 1;
            $r -= 1;
        }

        if ($path === 'se') {
            $q += 1;
        }

        if ($path === 'nw') {
            $q -= 1;
        }

        if ($path === 'sw') {
            $q -= 1;
            $r += 1;
        }

        if ($path === 'n') {
            $r -= 1;
        }

        if ($path === 's') {
            $r += 1;
        }

        $hexCurrent = [$q, $r];
        $currentDistance = cubeDistance(axialToCube($hexStart), axialToCube($hexCurrent));
        if ($currentDistance > $furthestDistance) {
            $furthestDistance = $currentDistance;
        }
    }

    $hexEnd = [$q, $r];

    // convert axial to cube
    $cubeStart = axialToCube($hexStart);
    $cubeEnd = axialToCube($hexEnd);

    // cube distance
    return [
        'shortestDistance' => cubeDistance($cubeStart, $cubeEnd),
        'furthestDistance' => $furthestDistance
    ];
}

function axialToCube($hex)
{
    $x = $hex[0];
    $z = $hex[1];
    $y = -$x - $z;

    return [$x, $y, $z];
}

function cubeDistance($start, $end)
{
    return (
        abs($start[0] - $end[0]) +
        abs($start[1] - $end[1]) +
        abs($start[2] - $end[2])
    ) / 2;
}

$answers = calculateDistance(getInput());

echo "Shortest Distance: " . $answers['shortestDistance'] . "\n"; // Shortest Distance: 715
echo "Furthest Distance: " . $answers['furthestDistance'] . "\n"; // Furthest Distance: 1512
