<?php
$file = $_GET['file'];
$enlace = "../archivos/".$file; 
header ("Content-Disposition: attachment; filename=".$file.""); 
header ("Content-Type: application/octet-stream"); 
header ("Content-Length: ".filesize($enlace)); 
readfile($enlace); 

?>