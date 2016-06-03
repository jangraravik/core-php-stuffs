<?php

/*
Find all dates in a date range by providing start and end date
*/
function findDatesFromDateRange($dateStart, $dateEnd){
    $foundDates = array($dateStart);
    while(end($foundDates) < $dateEnd){
        $foundDates[] = date('Y-m-d', strtotime(end($foundDates).' +1 day'));
    }
// Array of foundDates
return $foundDates;
}



$getDays = findDatesFromDateRange('2016-02-18','2016-02-24');
print_r($getDays);
echo "Total Days ".count($getDays);