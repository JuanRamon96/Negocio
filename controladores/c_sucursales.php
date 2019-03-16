<?php
class sucursales {
	
	public function _insertar(){
		date_default_timezone_set('America/Mexico_City');
		$omodelo = new m_modelo();
		extract($_POST);

		$query = ("insert into sucursales () VALUES (null, '$nombre', '$direccion', '$telefono');");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error de registro";
		}else{
			$mensaje = "Sucursale registrada";
		}
		echo $mensaje."#".$error;
	}
	
	public function _modificar(){
		date_default_timezone_set('America/Mexico_City');
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("UPDATE sucursales set nombre='$nombre', direccion='$direccion', telefono='$telefono' where id_sucursal = '$idR';");
		$error = $omodelo->_insertar($query);
		
	// :::::::::::::::::::::::::::::::::::::::::::::::::::::::	AGREGAR MOVIMIENTO A LA BASE DE DATOS	:::::::::::::::::::::::::::::::::::::::::::::::::::::
		$cobjeto = new controller();
		$cobjeto->_movimientos("Sucursales","Modificar","Se modificao la sucursal: ".$nombre);
	//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		
		if ($error == "si") {
			$mensaje = "Error de Modificaci&oacute;n"; 
		}else{
			$mensaje = "La sucursal se modifico con &eacute;xito";
		}
		echo $mensaje."#".$error;
	}

	public function _eliminar(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("DELETE FROM sucursales WHERE id_sucursal = '$idElimina';");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error al eliminar el producto";
		}else{
			$mensaje = "Sucursal eliminada";			
		}
		echo $mensaje."#".$error;
	}

	public function _reporte(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM sucursales;");
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			
			$lista1 = '
						<div class="col-sm-12 table-responsive">
						<table style="width:100%; color:black;" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover" id="tablaUsuarios">
							<thead id="imprimirTh">
								<tr class="expandible">
									<th id="thprimero" style="border-radius: 5px 0 0;">Nombre</th>
									<th>Direcci&oacute;n</th>
									<th>Telef&oacute;no</th>
									<th style="border-radius: 0 5px 0 0;">Acci&oacute;n</th>
								</tr>
							</thead>
							<tbody id="imprimirTb" align="center">'; 

			$row = $omodelo->_consultar($query);
			for($i=0;$i<$numerofilas;$i++){
				$lista2 .= '										
								<tr>
									<td class="">'.$row[$i]["nombre"].'</td>
									<td class="">'.$row[$i]["direccion"].'</td>
									<td class="">'.$row[$i]["telefono"].'</td>									
									<td>
										<span class="tooltip-area">
											<button id="mod-'.$row[$i]["id_sucursal"].'" type="button" class="btn btn-theme-inverse btn-info ventaModificar" data-effect="md-flipHor" data-target="0"><i class="fa fa-pencil-square-o"></i></button>
											<button id="eli-'.$row[$i]["id_sucursal"].'" type="button" class="btn btn-danger btn-danger ventaEliminar" data-effect="md-flipHor" data-target="0"><i class="fa fa-trash-o"></i></button>
										</span>
									</td>
								</tr>';
			}			
		}
		$lista3 = '</tbody>
						</table>
						</div>';
		$lista = $lista1.$lista2.$lista3.$permi;
		return utf8_encode($lista);
		//<td>'.$permisosBD.'</td>
	}		
	
	public function _consulta(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM sucursales;");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			 for($i=0;$i<$numerofilas;$i++){
				$a[] = $numerofilas;						// 0	
				$a[] = "6";									// 1	
				$a[] = $row[$i]["id_sucursal"];				// 2	0
				$a[] = $row[$i]["nombre"];					// 3	1		APLICA PARA SELECTS
				$a[] = $row[$i]["direccion"];				// 4	2
				$a[] = $row[$i]["telefono"];				// 5	3
			 }
		}
		foreach($a as $name){
			echo $name . "~";
		}
	}

}
?>
