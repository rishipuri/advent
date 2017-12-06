<?php

namespace A;

$states = [];
$cycles = 0;

function getInput()
{
    $input = file_get_contents(__DIR__ . '/input.txt');
    clean($input);

    return $input;
}

function clean(&$content)
{
    $content = explode("\t", trim($content));
}

function calculateRedistributionCycle($banks)
{
    global $states;
    global $cycles;

    $states = [$banks];

    while (count(array_unique($states, SORT_REGULAR)) === count($states)) {
        $bankToRedistribute = getMaxBank($banks);
        $bankValue = $banks[$bankToRedistribute];
        $banks[$bankToRedistribute] = 0;

        $index = ++$bankToRedistribute;

        while ($bankValue > 0) {
            if (!isset($banks[$index])) {
                $index = 0;
            }

            ++$banks[$index];

            $index++;
            $bankValue--;
        }

        $cycles++;
        $states[] = $banks;
    }

    return $cycles;
}

function getMaxBank($banks)
{
    return array_keys($banks, max($banks))[0];
}

function run()
{
    return calculateRedistributionCycle(getInput());
}

echo "Redistribution cycles: " . run() . "\n"; // Redistribution cycles: 6681
