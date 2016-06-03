<?php

function wordbreak($string, $maxlength)
 {
     $string = substr($string, 0, $maxlength);
     return substr($string, 0, strrpos($string, " "));
 }

/*** example usage ***/
$string = 'Heather is hoping to hop to Tahiti to hack a hibiscus to hang on her hat.
Now heather has hundreds of hats on her hat rack, so how can a hop to Tahiti top that?';

echo wordbreak($string, 50).' ...';

echo "<hr>";

function first_words($string, $num, $tail='&nbsp;...')
{
        /** words into an array **/
        $words = str_word_count($string, 2);

        /*** get the first $num words ***/
        $firstwords = array_slice( $words, 0, $num);

        /** return words in a string **/
        return  implode(' ', $firstwords).$tail;
}

 
 /*** get the first 5 words ***/
 echo first_words( $string, 5);