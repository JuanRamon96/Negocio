<?php 
session_start();
require "controladores/c_controller.php";
$ocontroller = new controller();
$accion = "";
$login = "";
$evento = "";

	if (ISSET($_POST['logi'])){
		$consult = $_POST['logi'];
		$ocontroller->_consulta($consult);
		return false;
	}
	if (ISSET($_GET['contact'])){
		if($_GET['contact'] == 0){
			$ocontroller->_contactan();
		}
		if($_GET['contact'] == 1){
			echo $ocontroller->_enviar();
		}
	}
	if(ISSET($_SESSION['id_tel'])){
		extract($_POST);
		// ESTE IF FUNCIONA PARA EL AJAX DE JQUERY
		if (ISSET($_POST['con'])){
			$consult = $_POST['con'];
			$ocontroller->_consulta($consult);
			return false;
		}
		if (ISSET($_POST['rep'])){
			$consult = $_POST['rep'];
			$reporte = $_POST['reporte'];
			$ocontroller->_reporte($consult,$reporte);
			return false;
		}
		if (ISSET($_POST['valid'])){
			$pagi = $_POST['valid'];
			$campo = $_POST['campo'];
			$valo = $_POST['valor'];
			$ocontroller->_consultaValidar($pagi,$campo,$valo);
			return false;
		}
		if (ISSET($_POST['cmo'])){
			$evento = $_POST['cmo'];
			$paginna = $_POST['nomPagina'];
			$ocontroller->_vevento($evento,$paginna );
			return false;
		}else {
			if (ISSET($_GET['cmdo'])){
				if($_GET['cmdo'] == 'logout'){
					$ocontroller->_logout();
				}
			}
			if (ISSET($_POST['cmd'])){
				$accion = $_POST['cmd'];
				switch($accion){
					case 'cambiar':
						echo $ocontroller->_cambiarcontrasena();
					break;	
					default:
						echo $ocontroller->_contenido($accion);
					break;
				}
			}else{
				echo $ocontroller->_vprincipal();
			}
			include "controladores/c_permisos.php";
		}
	}else{
		if (ISSET($_GET['cmo'])){
			$evento = $_GET['cmo'];
			if($evento == 'olvido') {
				echo $ocontroller->_olvidocontra();
			}
		}else{
			echo $ocontroller->_loginVista();
		}		
		if (ISSET($_GET['cml'])){
			$login = $_GET['cml'];
		}
		if($login == "login"){
			extract($_POST);
			$ocontroller->_login();
		}
	}	
	
?>