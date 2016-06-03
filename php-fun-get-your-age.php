<?php

function yearsOld($birthday)
{
    if (($birthday = strtotime($birthday)) === false)
    {
        return false;
    }
    for ($i = 0; strtotime("-$i year") > $birthday; ++$i);
    return $i - 1;
}  



 /*** example usage ***/
 $birthday = 'Feb 08 1986';
 
 echo yearsOld($birthday).' years old';