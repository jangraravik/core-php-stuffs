<?php


$myArray = array(array('first'=>1,2,3,4,5,6,7,8,9),array('first'=>11,22,33,44,55,66,77,88,99));

/** 
 * Flattens an array REPLACE SAME KEY's VALUE, or returns FALSE on fail. 
 */ 
function flattenArray($array){ 
  if (!is_array($array)) { return FALSE; } 
  $result = array();
  foreach ($array as $key => $value) { 
    if (is_array($value)) { $result = array_merge($result, flattenArray($value)); } 
    else { $result[$key] = $value; } 
  } 
return $result; 
}

$resultArray = flattenArray($myArray);
print_r($resultArray);exit;