<?php

function send_mail($data_arr){
 
 $data_arr = array_merge( array( 'to'=>'', 'from'=>'', 'subject'=>'', 'message'=>'', 'cc'=>'', 'bcc'=>'', 'file_name'=>'', 'file_path'=>'' ), $data_arr );
 
 $EmailTo = strip_tags($data_arr['to']);
 $EmailFrom = strip_tags($data_arr['from']);
 $EmailSubject = $data_arr['subject'];
 $EmailMessage = stripslashes($data_arr['message']);
 $EmailCc = strip_tags($data_arr['cc']);
 $EmailBcc = strip_tags($data_arr['bcc']);
 $filepath = $data_arr['file_path'];
 //if file_name is set explicitly use it else use the name of the uploaded file
 $filename = $data_arr['file_name'] ? $data_arr['file_name'] : end(explode("/",$filepath));
 
 // carriage return type (we use a PHP end of line constant)
 $eol = PHP_EOL;
 
 $headers = "";
 
 // main header
 if( !empty($EmailFrom) )
 $headers  .= "From: ".$EmailFrom.$eol; 
 
 if( !empty($EmailFrom) )
 $headers .= "Reply-To: ". $EmailFrom .$eol;
 
 if( !empty($EmailCc) )
 $headers .= "CC: ".$EmailCc.$eol;
 
 if( !empty($EmailBcc) )
 $headers .= "BCC: ".$EmailBcc.$eol;
 
 $headers .= "MIME-Version: 1.0".$eol; 
 
 /** in case file path is not set then send html mail with no attachment **/
 if( !isset( $data_arr['file_path'] ) || $data_arr['file_path'] == '' ){
	$headers .= "Content-type: text/html".$eol;
	if(mail($EmailTo, $EmailSubject, $EmailMessage, $headers)){ return true; } else { return false; }
 }
 
 
 $attachment = chunk_split( base64_encode(file_get_contents($filepath)) );
  
 //a unique seperator
 $separator = md5(time());  
 
 $headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";
  
 // message
 $body = "";
 $body .= "--".$separator.$eol;
 $body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
 $body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;//optional defaults to 7bit
 $body .= $EmailMessage.$eol;
  
 // attachment
 $body .= "--".$separator.$eol;
 $body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
 $body .= "Content-Transfer-Encoding: base64".$eol;
 $body .= "Content-Disposition: attachment".$eol.$eol;
 $body .= $attachment.$eol;
 $body .= "--".$separator."--";
  
 // send message
 if (mail($EmailTo, $EmailSubject, $body, $headers)) { return true; } else { return false; }
}





$mailArray = array(
 'to' => 'someone@example.com',
 'from' => 'info@perials.com',
 'subject' => 'Welcome',
 'message' => '<h2>Welcome User</h2><table><tr><td>First name</td><td>User</td></tr></table>',
 'file_path' => 'temp.jpg',
 'file_name' => 'Awesome.jpg'
 );
 
 
send_mail($mailArray);