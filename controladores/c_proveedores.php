<?php
class proveedores {
	
	public function _insertar(){
		$omodelo = new m_modelo();
		extract($_POST);

		$query = ("insert into proveedores (id_proveedor,nombre,direccion,telefono,ciudad,empresa,colonia,codigo_postal,puesto,correo,rfc,credito,celular,no_cuenta,banco) VALUES (
		null, '$nombre', '$direccion', '$telefono', '$ciudad', '$empresa', '$colonia', '$codigop', '$puesto', '$correo', '$rfc', '$credito', '$celular', '$cuenta', '$banco');");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error de registro";
		}else{
			$mensaje = "Proveedor registrado";
		}
		echo $mensaje."#".$error;
	}
	
	public function _modificar(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("UPDATE proveedores set nombre='$nombre', direccion='$direccion', telefono='$telefono', ciudad='$ciudad', empresa='$empresa', no_cuenta='$cuenta', banco='$banco', 
		colonia='$colonia', codigo_postal='$codigop', puesto='$puesto', correo='$correo', rfc='$rfc', credito='$credito', celular='$celular' where id_proveedor = '$idR';");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error de Modificaci&oacute;n"; 
		}else{
			$mensaje = "El proveedor se modifico con &eacute;xito";
		}
		echo $mensaje."#".$error;
	}

	public function _eliminar(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("DELETE FROM proveedores WHERE id_proveedor = '$idElimina';");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error al eliminar el producto";
		}else{
			$mensaje = "Proveedor eliminado";			
		}
		echo $mensaje."#".$error;
	}

	public function _reporte(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM proveedores;");
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			
			$lista1 = '
						<div class="col-sm-12 table-responsive">
						<table style="width:100%;color:black;font-size:11px" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover" id="tablaUsuarios">
							<thead id="imprimirTh">
								<tr class="expandible">
									<th id="thprimero" style="border-radius: 5px 0 0;">Raz&oacute;n social</th>
									<th>Ciudad</th>
									<th>RFC</th>
									<th>No. de cuenta</th>
									<th>Banco</th>
									<th>Cr&eacute;dito</th>
									<th style="width:90px">Contacto</th>
									<th style="border-radius: 0 5px 0 0;">Acci&oacute;n</th>
								</tr>
							</thead>
							<tbody id="imprimirTb" align="center">'; 
			$provee = "";
			$proveedor = "";
			$row = $omodelo->_consultar($query);
			for($i=0;$i<$numerofilas;$i++){
				
				$provee = '
					<div class="popTabla" id="divPov-'.$row[$i]["id_proveedor"].$i.'">
					<div id="provT-'.$row[$i]["id_proveedor"].$i.'" class="table-responsive tablaProv" style="border-radius:20px">
						<div class="modal-header bg-inverse bd-inverse-darken" style="border-radius: 18px 18px 0 0;">
							<h6 class="modal-title">Contacto: <strong>'.$row[$i]["nombre"].'</strong></h6>
						</div>
						<div style="background: aliceblue;border-radius: 0 0 18px 18px;padding: 10px;" class="panel-body">
							<table style="font-size:11px" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover">
								<tr>
									<td style="color: #898989;"><strong>Nombre</strong></td>
									<td>'.$row[$i]["nombre"].'</td>
								</tr>
								<tr>
									<td style="color: #898989;"><strong>Puesto</strong></td>
									<td>'.$row[$i]["puesto"].'</td>
								</tr>
								<tr>
									<td style="color: #898989;"><strong>Colonia</strong></td>
									<td>'.$row[$i]["colonia"].'</td>
								</tr>
								<tr>
									<td style="color: #898989;"><strong>Direcci&oacute;n</strong></td>
									<td>'.$row[$i]["direccion"].'</td>
								</tr>
								<tr>
									<td style="color: #898989;"><strong>C&oacute;digo postal</strong></td>
									<td>'.$row[$i]["codigo_postal"].'</td>
								</tr>
								<tr>
									<td style="color: #898989;"><strong>Telef&oacute;no</strong></td>
									<td>'.$row[$i]["telefono"].'</td>
								</tr>
								<tr>
									<td style="color: #898989;"><strong>Celular</strong></td>
									<td>'.$row[$i]["celular"].'</td>
								</tr>
								<tr>
									<td style="color: #898989;"><strong>Correo</strong></td>
									<td>'.$row[$i]["correo"].'</td>
								</tr>
							</table>
						</div>
					</div>
					';
				$proveedor = ''.$provee.'<label style="font-size: 10px;padding: 2px;" id="popTabla-'.$row[$i]["id_proveedor"].$i.'" class="btn btn-theme-inverse"><i class="fa fa-eye"></i> '.$row[$i]['nombre'].'</label></div>';
				$lista2 .= '										
								<tr>
									<td class="">'.$row[$i]["empresa"].'</td>
									<td class="">'.$row[$i]["ciudad"].'</td>
									<td class="">'.$row[$i]["rfc"].'</td>
									<td class="">'.$row[$i]["no_cuenta"].'</td>
									<td class="">'.$row[$i]["banco"].'</td>
									<td class="dinero">'.$row[$i]["credito"].'</td>
									<td class="" style="width:90px">'.$proveedor.'</td>
									<td>
										<span class="tooltip-area">
											<button id="mod-'.$row[$i]["id_proveedor"].'" type="button" class="btn btn-theme-inverse btn-info ventaModificar" data-effect="md-flipHor" data-target="0"><i class="fa fa-pencil-square-o"></i></button>
											<button id="eli-'.$row[$i]["id_proveedor"].'" type="button" class="btn btn-danger btn-danger ventaEliminar" data-effect="md-flipHor" data-target="0"><i class="fa fa-trash-o"></i></button>
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
		$query = ("SELECT * FROM proveedores;");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			 for($i=0;$i<$numerofilas;$i++){
				$a[] = $numerofilas;						// 0	
				$a[] = "17";								// 1	
				$a[] = $row[$i]["id_proveedor"];			// 2	0
				$a[] = $row[$i]["nombre"];					// 3	1 		APLICA PARA SELECTS
				$a[] = $row[$i]["direccion"];				// 4	2
				$a[] = $row[$i]["telefono"];				// 5	3
				$a[] = $row[$i]["ciudad"];					// 6	4
				$a[] = $row[$i]["empresa"];					// 7	5
				$a[] = $row[$i]["colonia"];					// 8	6
				$a[] = $row[$i]["codigo_postal"];			// 9	7
				$a[] = $row[$i]["puesto"];					// 10	8
				$a[] = $row[$i]["correo"];					// 11	9
				$a[] = $row[$i]["rfc"];						// 12	10
				$a[] = $row[$i]["credito"];					// 13	11
				$a[] = $row[$i]["celular"];					// 14	12
				$a[] = $row[$i]["no_cuenta"];				// 15	13
				$a[] = $row[$i]["banco"];					// 16	14
			 }
		}
		foreach($a as $name){
			echo $name . "~";
		}
	}

}
?>
