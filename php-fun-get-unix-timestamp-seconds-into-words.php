<?php 
    /*** start time ***/ 
    $start = strtotime('10:30 January 7 2004'); 
    /*** time now in seconds ***/ 
        $now = time(); 
    /*** do the math ***/ 
        $seconds = $now-$start; 

    /** 
     * 
     * @convert seconds to words 
     * 
     * @param INT $seconds 
     * 
     * @return string 
     * 
     */ 
        function secondsToWords($seconds) 
        { 
        /*** number of days ***/ 
                $days=(int)($seconds/86400); 
        /*** if more than one day ***/ 
        $plural = $days > 1 ? 'days' : 'day'; 
        /*** number of hours ***/ 
                $hours = (int)(($seconds-($days*86400))/3600); 
        /*** number of mins ***/ 
        $mins = (int)(($seconds-$days*86400-$hours*3600)/60); 
        /*** number of seconds ***/ 
        $secs = (int)($seconds - ($days*86400)-($hours*3600)-($mins*60)); 
        /*** return the string ***/ 
                return sprintf("%d $plural, %d hours, %d min, %d sec", $days, $hours, $mins, $secs); 
        } 

    /*** example usage ***/ 

    /*** start time ***/ 
    $start = strtotime('10:30 January 7 2004'); 
    /*** time now in seconds ***/ 
    $now = time(); 
    /*** do the math ***/ 
    $seconds = $now-$start; 

    /*** show the words ***/ 
    echo secondsToWords($seconds); 

?>