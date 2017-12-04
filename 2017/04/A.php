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
            $unique = array_unique($values);

            return count($unique) === count($values);
        })
    );
}

echo validPassphrasesCount(getInput()); // 466
