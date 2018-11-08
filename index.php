<?php 
	require "controlador/c_controller.php";
	$ocontroller = new controller();

	if (!isset($_POST['metodo'])) {
		echo $ocontroller->_vprincipal();
	}else{
		if ($_POST['metodo']=='insertar') {
			$ocontroller->_insertar($_POST['accion']);
		}
	}
 ?>