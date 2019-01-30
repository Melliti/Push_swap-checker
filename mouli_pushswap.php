<?php

$la = [];
$lb = [];

// Rotate functions \\

function ra(&$la, &$lb) {
    array_push($la, array_shift($la));
}

function rb(&$la, &$lb) {
    array_push($lb, array_shift($lb));
}

function rr(&$la, &$lb) {
    ra($la, $lb);
    rb($la, $lb);
}

function rra(&$la, &$lb) {
    array_unshift($la, $la[count($la) - 1]);
    array_pop($la);
}

function rrb(&$la, &$lb) {
    array_unshift($lb, $lb[count($lb) - 1]);
    array_pop($lb);
}

function rrr(&$la, &$rb) {
    rra($la, $lb);
    rrb($la, $lb);
}

// End rotate functions \\


// Swap functions \\

function sa(&$la, &$lb) {
    if (count($la) >= 2)
    {
        $tmp = $la[0];
        $la[0] = $la[1];
        $la[1] = $tmp;
    }
}

function sb(&$la, &$lb) {
    if (count($lb) >= 2)
    {
        $tmp = $lb[0];
        $lb[0] = $lb[1];
        $lb[1] = $tmp;
    }
}

function sc(&$la, &$lb) {
    sa($la, $lb);
    sb($la, $lb);
}

// End swap functions \\


// transfer functions \\

function pa(&$la, &$lb) {
    array_unshift($la, array_shift($lb));
}

function pb(&$la, &$lb) {
    array_unshift($lb, array_shift($la));
}

// End transfer function \\


// Check if the result is correct \\

function is_sorted(&$la) {
    $sorted = $la;
    sort($sorted);
    return $sorted === $la ? true : false;
}


function solver($commandsArray, &$la, &$lb) {
    for ($i = 0; $i < count($commandsArray); $i++)
    {
        $commandsArray[$i]($la, $lb);
        echo PHP_EOL . "[+] Turn {$i}: {$commandsArray[$i]}" .PHP_EOL;
        // print_r($la);
        // print_r($lb);
        echo "\$la: " . json_encode($la) . PHP_EOL;
        echo "\$lb: " . json_encode($lb) . PHP_EOL;
    }
}

// Fill the list with argv \\

function fillList(&$la, $values) {
    $valuesTab = explode(' ', $values);
    for ($i=0; $i < count($valuesTab); $i++) { 
        $la[$i] = $valuesTab[$i];
    }
}

function moulinette($values, $ops, &$la, &$lb, $login = null, $filename = null) {
    $commands = explode(' ', trim($ops));
    fillList($la, $values);
    solver($commands, $la, $lb);
    if (is_sorted($la) == true)
    {
        if ($login != null)
        {
            if ($filename != null)
                file_put_contents(readline($filename) . ".txt" , $login . ";" . count($commands) . PHP_EOL, FILE_APPEND);
            file_put_contents(readline(PHP_EOL . "Filename: ") . ".txt" , $login . ";" . count($commands) . PHP_EOL, FILE_APPEND);
        }
        echo "Sorted in " . count($commands) . " operations" . PHP_EOL;
    }
    else
        echo "Unsorted" . PHP_EOL;
}

moulinette($argv[1], $argv[2], $la, $lb, $argv[3], $argv[4]);