<?php
class gastos {
	
	public function _insertar(){
		$omodelo = new m_modelo();
		date_default_timezone_set('America/Mexico_City');
		extract($_POST);
		$query = ("insert into costos (id_costo,folio,fecha,cantidad,tipo_costo,otro_costo,costo,observaciones) VALUES 
		(null, '$folio', '$fechabb', '$cantidad', '$tipoGasto', '$otroGasto', '$gasto', '$descripcion');");
		$error = $omodelo->_insertar($query);

		if ($error == "si") {
			$mensaje = "Error de registro";
		}else{
			$mensaje = "Gasto registrado";
		}
		echo $mensaje."#".$error;
	}
	
	public function _modificar(){
		$omodelo = new m_modelo();
		extract($_POST);
		
		$horario = $horarioEntrada." - ".$horarioSalida;
		$query = ("UPDATE costos SET folio='$folio', fecha='$fechabb', cantidad='$cantidad', tipo_costo='$tipoGasto', otro_costo='$otroGasto', 
		costo='$gasto', observaciones='$descripcion' where id_costo = '$idR';");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error de Modificaci&oacute;n"; 
		}else{
			$mensaje = "El costo se modifico con &eacute;xito";
		}
		echo $mensaje."#".$error."#".$idR;
	}

	public function _eliminar(){
		$omodelo = new m_modelo();
		extract($_POST);
		if(file_exists($ligaFotoB)){
			unlink($ligaFotoB);			
		}
		$query = ("DELETE FROM costos WHERE id_costo = '$idElimina';");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error al eliminar el costo";
		}else{
			$mensaje = "Costo eliminado";			
		}
		echo $mensaje."#".$error;
	}

	public function _reporte(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM costos;");
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
									<th id="thprimero" style="border-radius: 5px 0 0;">Folio</th>
									<th>Fecha</th>
									<th>Tipo de gasto</th>
									<th>Gasto</th>
									<th>Cantidad</th>
									<th>Total</th>
									<th>Descripci&oacute;n</th>
									<th style="border-radius: 0 5px 0 0;">Acci&oacute;n</th>
								</tr>
							</thead>
							<tbody id="imprimirTb" align="center">'; 
			$row = $omodelo->_consultar($query);
			for($i=0;$i<$numerofilas;$i++){
				$gasto = $row[$i]["tipo_costo"];
				if($gasto == "Otros gastos"){
					$gasto = $row[$i]["otro_costo"];
				}
				$total = (double)$row[$i]["costo"] * (double)$row[$i]["cantidad"];
				$lista2 .= '										
						<tr>
							<td class=""><strong>'.$row[$i]["folio"].'</strong></td>
							<td class="">'.date("d-m-Y",strtotime($row[$i]["fecha"])).'</td>
							<td class="">'.$gasto.'</td>
							<td class="dinero">'.$row[$i]["costo"].'</td>
							<td class="decimal">'.$row[$i]["cantidad"].'</td>
							<td class="dinero">'.$total.'</td>
							<td class="">'.$row[$i]["observaciones"].'</td>
							<td>
								<span class="tooltip-area">
									<button id="mod-'.$row[$i]["id_costo"].'" type="button" class="btn btn-theme-inverse btn-info ventaModificar" data-effect="md-flipHor" data-target="0"><i class="fa fa-pencil-square-o"></i></button>
									<button id="eli-'.$row[$i]["id_costo"].'" type="button" class="btn btn-danger btn-danger ventaEliminar" data-effect="md-flipHor" data-target="0"><i class="fa fa-trash-o"></i></button>
								</span>
							</td>
						</tr>';
			}			
		}
		$lista3 = '</tbody>
						</table>
						</div>';
		$lista = $lista1.$lista2.$lista3;
		return $lista;
		//return utf8_encode($lista);
		//<td>'.$permisosBD.'</td>
	}		
	
	public function _consulta(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM costos;");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			 for($i=0;$i<$numerofilas;$i++){
				$a[] = $numerofilas;						// 0	
				$a[] = "10";								// 1	
				$a[] = $row[$i]["id_costo"];				// 2	0		APLICA PARA SELECTS
				$a[] = $row[$i]["folio"];					// 3	1
				$a[] = $row[$i]["fecha"];					// 4	2
				$a[] = $row[$i]["cantidad"];				// 5	3
				$a[] = $row[$i]["tipo_costo"];				// 6	4
				$a[] = $row[$i]["otro_costo"];				// 7	5
				$a[] = $row[$i]["costo"];					// 8	6
				$a[] = $row[$i]["observaciones"];			// 9	7
			 }
		}
		foreach($a as $name){
			echo $name . "~";
		}
	}

	public function _consultaValidar($campo,$valo){
		$omodelo = new m_modelo();
		$query = ("SELECT * FROM costos where ".$campo." = '".$valo."';");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		echo $numerofilas;
	}	
	
}
?>