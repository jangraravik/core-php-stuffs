<?php
/*
find all saturday and sundays by providing a date range
*/
function findThuAndSunFromDateRange($dateStart,$dateEnd) {
$allThu = array();
$allSun = array();
$foundExtndWeekend = array();
	for ($i = strtotime($dateStart); $i <= strtotime($dateEnd); $i = strtotime('+1 day', $i)) {
		if (date('N', $i) == 4){ //Thursday == 4
			if($i<=$dateStart)continue;
			$allThu[] = date('Y-m-d', $i); // if it's a Saturday
		}
	}
	
	foreach($allThu as $thu){
		$valSun  = strtotime("+3 day".$thu);
		if($valSun <= strtotime($dateEnd)){
			$foundExtndWeekend[] = $thu.", ".date('Y-m-d', $valSun);
		}
	}
return $foundExtndWeekend;
}

//$days = findThuAndSunFromDateRange('01/01/2016','01/31/2016');
//$days = findThuAndSunFromDateRange('02/01/2016','02/29/2016');
$days = findThuAndSunFromDateRange('08/01/2016','12/04/2016');
print_r($days);