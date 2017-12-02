<?php

function checksum() {
    $content = file(__DIR__ . '/input.txt');
    clean($content);

    $minMaxPairDiff = extractMinMaxPairDiff($content);

    return array_sum($minMaxPairDiff);
}

function clean(&$content) {
    $content = array_map(function($row) {
        return explode("\t", trim($row));
    }, $content);
}

function extractMinMaxPairDiff($content) {
    return array_map(function($row) {
        return max($row) - min($row);
    }, $content);
}

echo checksum(); // 53978
