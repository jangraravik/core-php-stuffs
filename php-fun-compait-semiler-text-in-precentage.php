<?php

/*** Show how broken it is ***/
error_reporting(E_ALL);

/*** our first text string ***/
$text_a = "the quick brown fox jumps over the lazy dog";

/*** As string to compare it with ***/
$text_b = "The slow red fox jumps over the lazy cat";

/* check the similarities and put the percentage of 
 * matches into a variable.
 */
similar_text($text_a, $text_b, $percentMatch); 

/*** round off the match and echo ***/
echo round($percentMatch); 