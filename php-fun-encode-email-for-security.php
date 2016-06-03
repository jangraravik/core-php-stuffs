<?php

echo encodeEmail('ravi@example.org');

/**
 *
 * Return ASCII value for web use
 *
 * @param string
 *
 * @return string
 *
 */
function makeASCII($char=0){
  return '&#'.ord($char).';';
}

/**
 *
 * @Encode an email to ascii
 *
 * @parma string 
 *
 * @return string
 *
 */
function encodeEmail($email){

if(filter_var($email, FILTER_VALIDATE_EMAIL) !== FALSE)
    {
    /*** split the email into single chars ***/
    $charArray = str_split($email);
    /*** apply a callback funcion to each array member ***/
    $encodedArray = filter_var($charArray, FILTER_CALLBACK, array('options'=>"makeASCII"));
    /*** put the string back together ***/
    $encodedString = implode('',$encodedArray);
    return '<a href="mailto:'.$encodedString.'">'.$encodedString.'</a>';
    }
else
  {
  return false;
  } 
}