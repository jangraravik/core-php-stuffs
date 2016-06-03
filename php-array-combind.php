<?php
  // an array of months by name
  $values = array(
  'value1',
  'value2',
  'value3',
);
$months = array(
  'January',
  'February',
  'March',
);
  // an array of numbers combined with the months array
  //$blah = array_combine(range(1,3), $months);
  $blah = array_combine($values, $months);

  // loop through the resulting array
  foreach($blah as $k=>$v){ echo $k.' -> '.$v.'<br />'; }

?>