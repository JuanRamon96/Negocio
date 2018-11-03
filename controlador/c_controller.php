<?php 
	class controller {

	function _vprincipal(){
	$pagina = file_get_contents('vistas/v_html.php');
	$formulario = file_get_contents('vistas/v_formulario.php');
	$pagina = str_replace('#prueba#',$formulario,$pagina);
	return $pagina;
	}
}
 ?>