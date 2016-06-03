<?php

function getCleanAlphaNumericAndSpaceOnly($string){
	return preg_replace('/[^a-zA-Z0-9\s]/', '', $string);
}

/** a string with some "bad characters" ***/
/*$valMyString = '(1234) S*m@#ith S)&+*t `E}{xam)ple?>land 1!_2)#3)(*4""5';*/
$valMyString = 'http://localhost:88/phpmyadmin/index.php?db=test&table=animals&target=sql.php&token=764f4ca88282f30449f1b4f37b84d329#PMAURL-1:sql.php?db=test&table=animals&server=1&target=&token=764f4ca88282f30449f1b4f37b84d329';
echo getCleanAlphaNumericAndSpaceOnly($valMyString);