<?php
// Group multiple array to single array bring at root
$myArray = Array ( 
				Array ('January 2016,5','February 2016,5','March 2016,5','April 2016,5'), 
				Array ('May 2016,4','June 2016,4','July 2016,4','August 2016,4'),
				Array ('September 2016,3','October 2016,3','November 2016,3','December 2016,3')
			);

		
function groupMultiArrayToSingleArray(array $array) {
//If you're using PHP 5.3 you can make use of array_walk_recursive and a closure (the closure can be replaced by a normal function if your PHP version < 5.3)
    $flatten = array();
    array_walk_recursive($array, function($value) use(&$flatten) {
        $flatten[] = $value;
    });

    return $flatten;
}

echo "<pre>";
print_r($myArray);
echo "</pre>";

echo "<hr><pre>";
$minStayArrayList = groupMultiArrayToSingleArray($myArray);
print_r($minStayArrayList);
echo "</pre>";

echo "<hr><pre>";
foreach($minStayArrayList as $minStay){
	$minStay = explode(",",$minStay);
	echo "Month = ".$minStay[0]."<br>";
	echo "Min Stay = ".$minStay[1]."<br>";
}
echo "</pre>";
