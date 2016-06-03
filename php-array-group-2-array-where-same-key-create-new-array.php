<?php
/*
Group 2 array with same key and create new array
*/
$array1 = array(11,22,33,44);
$array2 = array(1,2,3,4,5,6);

$result = array_map(function ($array1, $array2) {
					return ['song' => $array1, 'size' => $array2];
					}, $array1, $array2);
print_r($result);exit;