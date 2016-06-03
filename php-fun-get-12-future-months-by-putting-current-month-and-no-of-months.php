<?php

/* php-fun-get-12-future-months-by-putting-current-month-and-no-of-months */
$currentMonth = date("Y-m");
$addMonths = 12;

echo "Current Month: ".$currentMonth."<br>";
echo "Add Months: ".$addMonths."<br>";

function findMonthsFromDateRange($dateStart, $addMonth){
    $foundDates = array($dateStart);
	$endMonth = date('Y-m', strtotime("+".$addMonth." months"));
	$monthArray = array();
    while(end($foundDates) < $endMonth){
        $foundDates[] = date('Y-m-d', strtotime(end($foundDates).' +1 day'));
		//$foundDates[] = strtotime(end($foundDates).' +1 day');
    }
	foreach($foundDates as $foundDate){
		$monthArray[] = date("M Y",strtotime($foundDate));
	}
/* Return M Y only*/
$monthArray = array_unique($monthArray);
return array_values($monthArray);
}

$months = findMonthsFromDateRange($currentMonth, $addMonths);

print_r($months);
exit;