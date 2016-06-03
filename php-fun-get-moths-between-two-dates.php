<?php


function getMonthsInDateRange($sDate, $eDate){
	$start = strtotime($sDate);
	$end = strtotime($eDate);
	$months = array();
	$currentdate = $start;
	while($currentdate < $end){
		$cur_date = date('F Y', $currentdate);
		$currentdate = strtotime('+1 month', $currentdate);
		//echo $cur_date . "<br />";
		$months[] = $cur_date;
	}	 
return $months;
}

function getMonthsInDateRangeWithMinStay($sDate, $eDate, $mStay){
	$start = strtotime($sDate);
	$end = strtotime($eDate);
	$months = array();
	$currentdate = $start;
	while($currentdate < $end){
		$cur_date = date('F Y', $currentdate);
		$currentdate = strtotime('+1 month', $currentdate);
		//echo $cur_date . "<br />";
		$months[] = $cur_date.",".$mStay;
	}	 
return $months;
}


echo print_r(getMonthsInDateRangeWithMinStay('01/01/16','03/31/16',5));
exit;
