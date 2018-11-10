<?php 
	require "controlador/c_controller.php";
	$ocontroller = new controller();

	if (!isset($_POST['metodo'])) {
		echo $ocontroller->_vprincipal();
	}else{
		if ($_POST['metodo']=='insertar') {
			$ocontroller->_insertar($_POST['accion']);
		}
		if ($_POST['metodo']=='consultar') {
			$ocontroller->_consultar($_POST['accion']);
		}
		if ($_POST['metodo']=='estado') {
			$ocontroller->_consultar($_POST['accion']);
		}
		if ($_POST['metodo']=='ciudad') {
			$ocontroller->_consultar($_POST['accion']);
		}
	}
 ?>