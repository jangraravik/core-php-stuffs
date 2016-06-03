<?php 

/*
log-a-msgs-or-error-text-in-a-file-collect-on-daily-basis-file-name-as-daily-date-daily-log-by-time-stamp
*/

function logMsgs($message) {
	$logFilePath = dirname(__FILE__).'/sitelogs/';
	$date = new DateTime();
	$myLogFile = $logFilePath . $date->format('Y-m-d').".log";

	if(is_dir($logFilePath)) {
		if(!file_exists($myLogFile)) {
			/* create log file with first message on new day*/
			$fh  = fopen($myLogFile, 'a+') or die("Fatal Error !");
			$logcontent = "LogTime: " . $date->format('H:i:s')."\r\nLogText: " . $message ."\r\n";
			fwrite($fh, $logcontent);
			fclose($fh);
		}else{
			/* edit/update log file with new message on same day */
			$logcontent = "LogTime: " . $date->format('H:i:s')."\r\nLogText: " . $message ."\r\n\r\n";
			$logcontent = $logcontent . file_get_contents($myLogFile);
			file_put_contents($myLogFile, $logcontent);			

		}
	}else{if(mkdir($logFilePath,0777) === true){logMsgs($message);}}
}



logMsgs("this is a test message 1");
logMsgs("this is a test message 2");