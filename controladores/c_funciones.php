<?php
function _fecha($fecha){
	date_default_timezone_set('America/Mexico_City');
	$fech = explode("-",$fecha);
	return $fecha = $fech[2]."-".$fech[1]."-".$fech[0];	
}
?>
