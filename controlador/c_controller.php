<?php 
include "c_formulario.php";

class controller {

	function _vprincipal(){
		$pagina = file_get_contents('vistas/v_html.php');
		$formulario = file_get_contents('vistas/v_formulario.php');
		$pagina = str_replace('#prueba#',$formulario,$pagina);
		return $pagina;
	}

	function _insertar($metodo){
		$objeto = new $metodo();
		$objeto->_insertar();
	}

	function _consultar($metodo){
		$objeto = new $metodo();
		$objeto->_consultar();
	}
	
}
 ?>