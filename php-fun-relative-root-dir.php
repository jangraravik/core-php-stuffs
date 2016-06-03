<?php

function getRelativeRoot(){ 
    /*** get the document root ***/     
    $dr = $_SERVER['DOCUMENT_ROOT']; 
    /*** get the current working directory ***/ 
    $cwd = getcwd(); 
    /*** return the path ***/ 
    return str_replace($dr, '',  $cwd); 
}

echo getRelativeroot(); /* get relative root of current ducument */

