<?php

namespace B;

require('A.php');

function run()
{
    global $states;
    global $cycles;

    $loopStart = array_search(end($states), $states);
    $loopEnd = $cycles;

    return $loopEnd - $loopStart;
}

echo "Cycles in the infinite loop: " . run() . "\n"; // Cycles in the infinite loop: 2392
