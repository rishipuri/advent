<?php

function getInput()
{
    $input = file(__DIR__ . '/input.txt');
    clean($input);

    return $input;
}

function clean(&$content)
{
    $content = array_map(function ($row) {
        $key = explode(" ", $row[0])[0];
        $weight = explode(" ", $row[0])[1];
        $row['parent'] = [
            'key' => $key,
            'weight' => $weight
        ];

        if (array_key_exists(1, $row)) {
            $row['childrens'] = explode(", ", $row[1]);
        }

        unset($row[0]);
        unset($row[1]);

        return $row;
    }, array_map(function ($row) {
        return explode(" -> ", $row);
    }, array_map('trim', $content)));
}

function determineBase($instructions)
{
    $flattened = [];

    foreach ($instructions as $value) {
        if (array_key_exists('childrens', $value)) {
            foreach ($value['childrens'] as $val) {
                $flattened[] = $val;
            }
        }

        $flattened[] = $value['parent']['key'];
    }

    return array_keys(array_intersect(array_count_values($flattened), [1]))[0];
}

echo determineBase(getInput()); // vtzay
