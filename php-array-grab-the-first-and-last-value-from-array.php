<?php

$values = array("orange", "banana", "table", "cup", "car", "jug", "moter");
test($values);
echo "<br>";
echo  "First Value: ".array_shift($values);
echo "<br>";
echo  "Last Value: ".array_pop($values);
echo "<br>";
test($values);