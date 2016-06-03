<?php

$items = array('a', 'b', 'c', 'd');
//print_r($stack);exit;
$i= 1;
foreach($items as $value){
    $items2[$i] = $value;
    $i++;
}
$items = $items2;
print_r($items);exit;
exit;