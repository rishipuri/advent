<?php

function getInput()
{
    $input = file(__DIR__ . '/input.txt');
    clean($input);

    return $input;
}

function clean(&$content)
{
    $content = array_filter(array_map('trim', $content));
}

function validPassphrasesCount($passphrases)
{
    return count(
        array_filter($passphrases, function ($row) {
            $values = explode(' ', $row);

            return !hasAnagram($values);
        })
    );
}

function hasAnagram($array)
{
    for ($i = 0; $i < count($array); $i++) {
        for ($j = $i + 1; $j < count($array); $j++) {
            if (count_chars($array[$i], 1) == count_chars($array[$j], 1)) {
                return true;
            }
        }
    }
}

echo validPassphrasesCount(getInput()); // 251
