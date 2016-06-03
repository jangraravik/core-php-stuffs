<?php

$arr = array("jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");
$previousValue = null;
foreach($arr as $ar){
  echo "this- ".$ar."<br>";
  if($previousValue) {
    echo "prev - ".$previousValue."<br>";
  }
  $previousValue = $ar;
}

echo "<hr>"

$arr2=$arr;
foreach($arr as $k=>$currVal){
    unset($arr2[$k]);
    foreach($arr2 as $k=>$v){
        $nextVal= $v;

        break;
    }
echo "next val: ".$nextVal."<br>";
echo "current val: ".$currVal."<br>";
}