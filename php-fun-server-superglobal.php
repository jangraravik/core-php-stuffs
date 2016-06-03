<html>
<head>
<LINK REL="SHORTCUT ICON" HREF="/favicon.ico">
<style type="text/css">
<!--
body, table { font:12px Verdana,Arial,Helvetica,sans-serif}
tr.Dark { background-color:#F6F6F6 }
tr.Light { background-color:#F0F0F0 }
tr.Gazooo { background-color:#FFFFFF; border: solid 1px}
-->
</style>
</head>
<body>
<table border="0" cellspacing="2">
<tbody>
<tr class="Gazooo"><th><h2>Server variable</h2></th><th><h2>Value</h2></th></tr>
<?php
$colors = array('dark', 'light');
$i=0;
foreach($_SERVER as $key=>$value)
    {
   echo '<tr class="'.$colors[$i++ % 2].'"><td>$_SERVER[\''.$key.'\']</td><td>'.$value.'</td></tr>';
    }
?>
</tbody></table>
</body></html>