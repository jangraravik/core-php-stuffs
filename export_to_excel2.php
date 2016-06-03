<?php 

function array_to_csv_download(array &amp;$array) {
    
    if (count($array) == 0) {
        return null;
    }
    
    $filename = "data_export_" . date("Y-m-d") . ".csv";
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");
 
    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
 
    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
 
    $df = fopen("php://output", 'w');
    fputcsv($df, array_keys(reset($array)));
    foreach ($array as $row) {
        fputcsv($df, $row);
    }
    fclose($df);
    die();    
}


$db_recordset = array(
                    array('id'=&gt;'560','name'=&gt;'John','age'=&gt;'31','occupation'=&gt;'Designer'),
                    array('id'=&gt;'561','name'=&gt;'Robert','age'=&gt;'21','occupation'=&gt;'Student')
                );
                
array_to_csv_download($db_recordset);