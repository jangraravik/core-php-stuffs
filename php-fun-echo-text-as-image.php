<?php

/*** set the header for the image ***/
header("Content-type: image/jpeg");

/*** specify an image and text ***/
$im = writeToImage('http://ecbyo.ivacationonline.com/gallery/gal-p1-1446662883-desert.jpg', 'PHPRO rules again');

/*** spit the image out the other end ***/
imagejpeg($im);

/**
 *
 * @Write text to an existing image
 *
 * @Author Kevin Waterson
 *
 * @access public
 *
 * @param string The image path
 *
 * @param string The text string
 *
 * @return resource
 *
 */
function writeToImage($imagefile, $text){
/*** make sure the file exists ***/
if(file_exists($imagefile))
    {    
    /*** create image ***/
    $im = @imagecreatefromjpeg($imagefile);

    /*** create the text color ***/
    $text_color = imagecolorallocate($im, 233, 14, 91);

    /*** splatter the image with text ***/
    imagestring($im, 6, 25, 150,  "$text", $text_color);
    }
else
    {
    /*** if the file does not exist we will create our own image ***/
    /*** Create a black image ***/
    $im  = imagecreatetruecolor(150, 30); /* Create a black image */

    /*** the background color ***/
    $bgc = imagecolorallocate($im, 255, 255, 255);

    /*** the text color ***/
    $tc  = imagecolorallocate($im, 0, 0, 0);

    /*** a little rectangle ***/
    imagefilledrectangle($im, 0, 0, 150, 30, $bgc);

    /*** output and error message ***/
    imagestring($im, 1, 5, 5, "Error loading $imagefile", $tc);
    }
return $im;
}
