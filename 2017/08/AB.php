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

function buildRegister($instructions)
{
    global $highest;

    $registers = [];
    $highest = null;

    foreach ($instructions as $instruction) {
        $condtion = [];
        $instruction = explode(" ", $instruction);

        $register = $instruction[0];
        $modify = $instruction[1];
        $modifyBy = $instruction[2];
        $condtion[] = $instruction[4];
        $condtion[] = $instruction[5];
        $condtion[] = $instruction[6];

        if (!array_key_exists($register, $registers)) {
            $registers[$register] = 0;
        }

        $condtionResult = false;

        switch ($condtion[1]) {
            case '>':
                if (!isset($registers[$condtion[0]])) {
                    $registers[$condtion[0]] = 0;
                }
                $condtionResult = $registers[$condtion[0]] > $condtion[2];
                break;

            case '<':
                if (!isset($registers[$condtion[0]])) {
                    $registers[$condtion[0]] = 0;
                }
                $condtionResult = $registers[$condtion[0]] < $condtion[2];
                break;

            case '>=':
                if (!isset($registers[$condtion[0]])) {
                    $registers[$condtion[0]] = 0;
                }
                $condtionResult = $registers[$condtion[0]] >= $condtion[2];
                break;

            case '==':
                if (!isset($registers[$condtion[0]])) {
                    $registers[$condtion[0]] = 0;
                }
                $condtionResult = $registers[$condtion[0]] == $condtion[2];
                break;

            case '<=':
                if (!isset($registers[$condtion[0]])) {
                    $registers[$condtion[0]] = 0;
                }
                $condtionResult = $registers[$condtion[0]] <= $condtion[2];
                break;

            case '!=':
                if (!isset($registers[$condtion[0]])) {
                    $registers[$condtion[0]] = 0;
                }
                $condtionResult = $registers[$condtion[0]] != $condtion[2];
                break;
        }

        if ($condtionResult) {
            if ($modify === 'inc') {
                $registers[$register] += $modifyBy;
            }
            if ($modify === 'dec') {
                $registers[$register] -= $modifyBy;
            }
        }

        if (empty($highest) or $registers[$register] > $highest) {
            $highest = $registers[$register];
        }
    }

    return $registers;
}

$register = buildRegister(getInput());

echo "The largest value in any register: " . max($register) . "\n"; // The largest value in any register: 5752
echo "The highest value held: " . $highest; // The highest value held: 6366
