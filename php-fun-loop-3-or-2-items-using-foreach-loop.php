<?php
$array = [0,1,2,3,4,5,6,7,8,9,0,4,5,6,7,8,9,8,7,6,5,4,3,2,3];
    $table = "<table class='table'><tbody><tr>";
                                        //^^^^ See here the start of the first row
    foreach($array as $a => $v) {

        $table .= "<td>$v</td>";
                //^           ^ double quotes for the variables
        if(($a+1) % 4 == 0)
            $table .= "</tr><tr>";

    }
    $table .= "</tr></tbody></table>"; 
         //^   ^^^^^ end the row
         //| append the text and don't overwrite it at the end
    echo $table;