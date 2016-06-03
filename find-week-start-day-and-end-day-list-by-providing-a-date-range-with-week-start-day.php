<?php
/*
Find Week Start Day and End Day list by providing a Date Range with Week Start Day as [1,2,3,4,5,6,7 where 1 is Monday] default week start from saturday.
*/
function findWeekStartEndFromDateRange($dateStart,$dateEnd,$weekStartOn = 6) {
	$arrayWeekStart = array();
	$arrayWeekEnd = array();
	$foundWeeksRough = array();
	$foundWeeks = array();
	for ($i = strtotime($dateStart); $i <= strtotime($dateEnd); $i = strtotime('+1 day', $i)) {
	  if (date('N', $i) == $weekStartOn){ //Default is Saturday == 6
		$arrayWeekStart[] = date('Y-m-d', $i); // if it's a Saturday
	  }
	}
	foreach($arrayWeekStart as $valweekStartOn){
		$valWeekEnd  = strtotime("+6 day".$valweekStartOn);
		if($valWeekEnd <= strtotime($dateEnd)){
			$arrayWeekEnd[] = date('Y-m-d', strtotime("+6 day".$valweekStartOn));
		}
	}
	$foundWeeksRough = array_map(function ($arrayWeekStart, $arrayWeekEnd) {
					return ['Start' => $arrayWeekStart, 'End' => $arrayWeekEnd];
					}, $arrayWeekStart, $arrayWeekEnd);	
	
	foreach($foundWeeksRough as $foundWeekRough){	
		if(empty($foundWeekRough['End']))continue;
		$foundWeeks[] = $foundWeekRough['Start'].",".$foundWeekRough['End'];
	}
// Array of WeekStartDate and WeekEndDate
return $foundWeeks;
}

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


$valWeekList = findWeekStartEndFromDateRange('2016-01-25','2016-03-06',7);
print_r($valWeekList);exit;
