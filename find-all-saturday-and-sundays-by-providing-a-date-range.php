<?php
/*
find all saturday and sundays by providing a date range
*/
function findSatAndSunFromDateRange($dateStart,$dateEnd) {
$allSat = array();
$allSun = array();
	for ($i = strtotime($dateStart); $i <= strtotime($dateEnd); $i = strtotime('+1 day', $i)) {
	  if (date('N', $i) == 6){ //Saturday == 6
		$allSat[] = date('l Y-m-d', $i); // if it's a Saturday
	  }
	  if (date('N', $i) == 7){ //Sunday == 7
		$allSun[] = date('l Y-m-d', $i); // if it's a Sunday
	  }
	}
return array('saturdays' => $allSat, 'sundays' => $allSun);
}

$days = findSatAndSunFromDateRange('01/01/2016','01/10/2016');
print_r($days);