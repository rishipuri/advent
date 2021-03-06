<?php

function getInput()
{
    $input = file(__DIR__ . '/input.txt');
    clean($input);

    return $input;
}

function clean(&$content)
{
    $content = array_map('trim', $content);
}

function stepsRequiredToExit($sequence)
{
    $steps = 0;
    $jumpFrom = 0;
    $jumpTo = 0;

    while (true) {
        $jumpFrom = $jumpTo;
        $jumpTo += $sequence[$jumpFrom];

        if (!isset($sequence[$jumpTo])) {
            break;
        }

        if ($sequence[$jumpFrom] >= 3) {
            --$sequence[$jumpFrom];
        } else {
            ++$sequence[$jumpFrom];
        }

        $steps++;
    }

    return ++$steps;
}

echo stepsRequiredToExit(getInput()); // 21841249
