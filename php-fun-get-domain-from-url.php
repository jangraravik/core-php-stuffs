<?php
function getDomain($url)
{
    if(filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) === FALSE)
    {
        return false;
    }
    /*** get the url parts ***/
    $parts = parse_url($url);
    /*** return the host domain ***/
    return $parts['scheme'].'://'.$parts['host'];
}
$url = 'http://testing.php:88/php-fun-get-domain-from-url.php';
echo getDomain($url);