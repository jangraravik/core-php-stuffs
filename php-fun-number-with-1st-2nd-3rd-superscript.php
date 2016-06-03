<?php

function getOrdinalSuffix($number, $ss=0) 
{ 
    if ($number % 100 > 10 && $number %100 < 14){ 
        $os = 'th'; 
    } elseif($number == 0){ 
		/*** check if number is zero ***/ 
        $os = ''; 
    } else { 
        /*** get the last digit ***/ 
        $last = substr($number, -1, 1); 
        switch($last){ 
            case "1":$os = 'st';break; 
            case "2":$os = 'nd';break; 
            case "3":$os = 'rd';break; 
            default:$os = 'th';
        } 
    } 
    /*** add super script ***/ 
    $os = $ss==0 ? $os : '<sup>'.$os.'</sup>'; 
	
    /*** return ***/ 
    return $number.$os; 
} 

echo getOrdinalSuffix(11);
echo "<br>";
echo getOrdinalSuffix(11,1);
echo "<br>";

echo getOrdinalSuffix(12);
echo "<br>";
echo getOrdinalSuffix(12,1);
echo "<br>";

echo getOrdinalSuffix(13);
echo "<br>";
echo getOrdinalSuffix(13,1);
echo "<br>";