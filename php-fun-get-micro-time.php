<?php

// a function to  get microtime
function getmicrotime(){
  list($usec, $sec) = explode(" ",microtime());
  return ((float)$usec + (float)$sec);
}

// start time
$time_start = getmicrotime();

// a little loop to time
for ($i=0; $i < 10000; $i++)
{
// print the loop number
echo $i.'<br />';
}

// the end time
$time_end = getmicrotime();

// subtract the start time from the end time to get the time taken
$time = $time_end - $time_start;


// echo a little message
echo '<br />Script ran for ' . round($time,2) .' seconds.';