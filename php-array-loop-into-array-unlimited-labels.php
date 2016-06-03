<?php

//  Multi-dementional Source Array
$tmpArray = array(
    array("A", array('a1','a1','a1','a1','a1',)),
    array("B", array('b1','b1','b1','b1')),
    array("C", array('c1','c1','c1','c1'),array("C2", array('c2','c2','c2','c2'))),
	array("D", array('d1','d1','d1','d1'),array('d12','d13','d14','d15'))
);

//print_r($tmpArray);exit;


displayArrayRecursively($tmpArray);

function displayArrayRecursively($arr, $indent='') {
    if ($arr) {
        foreach ($arr as $value) {
            if (is_array($value)) {
                //
                displayArrayRecursively($value, $indent . '--');
            } else {
                //  Output
                echo "$indent $value <br>";
            }
        }
    }
}

