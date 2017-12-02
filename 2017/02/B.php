<?php

function checksum() {
    $content = file(__DIR__ . '/input.txt');
    clean($content);

    $evenlyDivisiblePairRemainders = extractEvenlyDivisiblePairRemainders($content);

    return array_sum($evenlyDivisiblePairRemainders);
}

function clean(&$content) {
    $content = array_map(function($row) {
        return explode("\t", trim($row));
    }, $content);
}

function extractEvenlyDivisiblePairRemainders($content) {
    return array_map(function($row) {
        for ($i = 0; $i < count($row); $i++) {
            for ($j = 0; $j < count($row); $j++) {
                if (($i !== $j) and ($row[$i] % $row[$j] === 0)) {
                    return $row[$i] / $row[$j];
                }
            }
        }
    }, $content);
}

echo checksum(); // 314
