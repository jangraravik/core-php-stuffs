<?php

$dataMonths = array('January','February','March','April','May','June','July','August','September','October','November','December');
//echo "<pre>".print_r($dataMonths)."</pre>";

$dataMonthsChunked = array_chunk($dataMonths,3);
//echo "<pre>".print_r($dataMonthsChunked)."</pre>";

echo "<table border='1'>";
foreach($dataMonthsChunked as $row) {
    echo "<tr>";
    foreach($row as $column) {
        echo "<td>{$column}</td>";
    }
    echo "</tr>";
}
echo "</table>";


function arrayUnchunk($array){
    return call_User_Func_Array('array_Merge',$array);
}

$dataMonthsUnchunked = arrayUnchunk($dataMonthsChunked);
//echo "<pre>".print_r($dataMonthsUnchunked)."</pre>";