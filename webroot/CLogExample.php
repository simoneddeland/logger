<?php

//
// Set the error reporting.
//
error_reporting(-1);              // Report all type of errors
ini_set('output_buffering', 0);   // Do not buffer outputs, write directly

//
// Get required files
//
require "../src/Logger/CLog.php";

// Create new CLog object, set precision to 3 decimals (default is 3)
$log = new \ultimadark\Logger\CLog(3);

$log->timestamp("ExampleClass", "Beginning of file");

// Calculate some meaningless stuff
$log->timestamp("ExampleClass", "calculateBigSum", "Before summing");
calculateBigSum();
$log->timestamp("ExampleClass", "calculateBigSum", "After summing");

$log->timestamp("ExampleClass", "End of file");

// Print log
echo $log->timestampAsTable();


function calculateBigSum()
{    
    $sum = 0;
    for ($i = 0; $i < 500000; $i++) {
        $sum += $i;
    }    
}