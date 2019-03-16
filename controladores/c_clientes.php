<?php
class clientes {
	
	public function _insertar(){
		$omodelo = new m_modelo();
		date_default_timezone_set('America/Mexico_City');
		extract($_POST);
		$direccionCompleta = $direccion . "," . $numeroExt . "," . $numeroInt;
		$fechaAlta = date("Y-m-d H:i:s");
		$query = ("insert into clientes (id_cliente,nombre,direccion,telefono,ciudad,empresa,colonia,codigo_postal,
		fecha_nacimiento,correo,rfc,lim_credito,celular,no_cuenta,banco,descuento,usuario,fecha_alta) VALUES (
		null, '$nombre', '$direccionCompleta', '$telefono', '$ciudad', '$empresa', '$colonia', '$codigop', '$fechabb', 
		'$correo', '$rfc', '$credito', '$celular', '$cuenta', '$banco', '$descuento', '".$_SESSION['id_tel']."', '$fechaAlta');");
		$error = $omodelo->_insertar($query);
		
		$query2 = ("SELECT * FROM clientes order by id_cliente desc limit 1;");
		$row = $omodelo->_consultar($query2);
		
		if ($error == "si") {
			$mensaje = "Error de registro";
		}else{
			$mensaje = "Cliente registrado";
		}
		echo $mensaje."#".$error."#".$row[0]['id_cliente'];
	}
	
	public function _modificar(){
		$omodelo = new m_modelo();
		extract($_POST);

		$query = ("UPDATE clientes SET nombre='$nombre', direccion='$direccion', telefono='$telefono', ciudad='$ciudad', empresa='$empresa', no_cuenta='$cuenta', banco='$banco', fecha_nacimiento='$fechabb',
		colonia='$colonia', codigo_postal='$codigop', correo='$correo', rfc='$rfc', lim_credito='$credito', descuento='$descuento', celular='$celular' where id_cliente = '$idR';");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error de Modificaci&oacute;n"; 
		}else{
			$mensaje = "El cliente se modifico con &eacute;xito";
		}
		echo $mensaje."#".$error."#".$idR;
	}

	public function _eliminar(){
		$omodelo = new m_modelo();
		extract($_POST);
		if(file_exists($ligaFotoB)){
			unlink($ligaFotoB);			
		}
		$query = ("DELETE FROM clientes WHERE id_cliente = '$idElimina';");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error al eliminar el cliente";
		}else{
			$mensaje = "Cliente eliminado";			
		}
		echo $mensaje."#".$error;
	}

	public function _foto(){
		$omodelo = new m_modelo();
		extract($_POST);
		if (!empty($_FILES)) {
			//var_dump($_FILES);
			if($ligaFoto != 0){
				$dir = "archivos/fotosClientes/".$ligaFoto;
				if(file_exists($dir)){
					unlink($dir);
				}
			}
			if($_FILES["foto"]["size"] > 0){
				$tipob = $_FILES["foto"]["type"];
				$archivob = $_FILES["foto"]["name"];
				$prefijo = substr(md5(uniqid(rand())),0,4);
				$archiv = explode(".",$archivob);
				if ($nombre != "") {
					$nombreEx = explode(" ",$nombre);
					for($w=0;$w<count($nombreEx);$w++){
						$nombreFotoB = $nombreFotoB.$nombreEx[$w];
					}
					$nombreFoto = $nombreFotoB.".".$archiv[1];
					$liga = $prefijo."_".$nombreFoto;
					$destino =  "archivos/fotosClientes/".$liga;
					if (copy($_FILES['foto']['tmp_name'],$destino)) {									
						$estado = "Archivo subido: ".$nombreFoto."";
					} else {
						$estado =  "Error 1 al subir el archivo";
					}
				} else {
					$estado =  "Error 2 al subir archivo";
				}
			}
			$query = ("UPDATE clientes set foto='".$liga."' where id_cliente = '$idR';");
			$error = $omodelo->_insertar($query);
		}
	}
	
	public function _reporte(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM clientes;");
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			
			$lista1 = '
						<div class="col-md-12 table-responsive" style="overflow-x:auto;">
						<table style="width:100%; color:black; font-size:11px" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover" id="tablaUsuarios">
							<thead id="imprimirTh">
								<tr class="expandible">
									<th id="thprimero" style="border-radius: 5px 0 0;">Nombre / foto</th>
									<th>Fecha de nacimiento</th>
									<th>Direcci&oacute;n</th>
									<th>Telef&oacute;nos</th>
									<th>Correo</th>
									<th>Descuento</th>
									<th>L&iacute;mite cr&eacute;dito</th>
									<th style="width:90px">ver mas</th>
									<th style="border-radius: 0 5px 0 0;">Acci&oacute;n</th>
								</tr>
							</thead>
							<tbody id="imprimirTb" align="center">'; 
			$provee = "";
			$verMas = "";
			$row = $omodelo->_consultar($query);
			for($i=0;$i<$numerofilas;$i++){
				$provee = '
					<div class="popTabla" id="divPov-'.$row[$i]["id_cliente"].$i.'">
					<div id="provT-'.$row[$i]["id_cliente"].$i.'" class="table-responsive tablaProv" style="border-radius:20px">
						<div class="modal-header bg-inverse bd-inverse-darken" style="border-radius: 18px 18px 0 0;">
							<h6 class="modal-title">Contacto: <strong>'.$row[$i]["nombre"].'</strong></h6>
						</div>
						<div style="background: aliceblue;border-radius: 0 0 18px 18px;padding: 10px;" class="panel-body">
							<table style="font-size:11px" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover">
								<tr>
									<td style="color: #898989;"><strong>Empresa</strong></td>
									<td>'.$row[$i]["empresa"].'</td>
								</tr>
								<tr>
									<td style="color: #898989;"><strong>RFC</strong></td>
									<td>'.$row[$i]["rfc"].'</td>
								</tr>
								<tr>
									<td style="color: #898989;"><strong>Banco</strong></td>
									<td>'.$row[$i]["banco"].'</td>
								</tr>
								<tr>
									<td style="color: #898989;"><strong>No. de cuenta</strong></td>
									<td>'.$row[$i]["no_cuenta"].'</td>
								</tr>
							</table>
						</div>
					</div>
					';
				if($row[$i]["foto"] == ""){
					$laFoto = 'assets/img/avatar7.gif';
				}else{
					$laFoto = 'archivos/fotosClientes/'.$row[$i]["foto"].'';
				}

				$direccion = '<span>Ciudad:</span>    &nbsp; <strong>'.$row[$i]["ciudad"].'</strong><br>
							 <span>C.P.:</span>       &nbsp; <strong>'.$row[$i]["codigo_postal"].'</strong><br>
							 <span>Colonia:</span>    &nbsp; <strong>'.$row[$i]["colonia"].'</strong><br>
							  <span>Direcci&oacute;n:</span>  &nbsp; <strong>'.$row[$i]["direccion"].'</strong><br>
				';
				$telefonos = 'Telef&oacute;no:  &nbsp; <strong>'.$row[$i]["telefono"].'</strong><br>
							  Celular:   &nbsp; <strong>'.$row[$i]["celular"].'</strong><br>
				';
				$verMas = $provee.'<label style="font-size: 10px;padding: 2px;" id="popTabla-'.$row[$i]["id_cliente"].$i.'" class="btn btn-theme-inverse"><i class="fa fa-eye"></i> Ver mas</label></div>';
				$lista2 .= '										
								<tr>
									<td class=""><a href="'.$laFoto.'" title="'.$row[$i]["nombre"].'" class="preview_fancybox"><img id="fot'.$row[$i]["id_cliente"].'" alt="" style="width:60px" src="'.$laFoto.'" class="circle"/></a><br>'.$row[$i]["nombre"].'<br>No. de cliente: <strong>'.$row[$i]["id_cliente"].'</strong></td>
									<td class="">'.date("d-m-Y",strtotime($row[$i]["fecha_nacimiento"])).'</td>
									<td class="" style="text-align:left;width:220px">'.$direccion.'</td>
									<td class="" style="text-align:left">'.$telefonos.'</td>
									<td class="">'.$row[$i]["correo"].'</td>
									<td class="decimal">'.$row[$i]["descuento"].'</td>
									<td class="">'.$row[$i]["lim_credito"].' <small>d&iacute;as</small></td>
									<td class="" style="width:90px">'.$verMas.'</td>
									<td style="width: 100px;">
										<span class="tooltip-area">
											<button id="mod-'.$row[$i]["id_cliente"].'" type="button" class="btn btn-theme-inverse btn-info ventaModificar" data-effect="md-flipHor" data-target="0"><i class="fa fa-pencil-square-o"></i></button>
											<button id="eli-'.$row[$i]["id_cliente"].'" type="button" class="btn btn-danger btn-danger ventaEliminar" data-effect="md-flipHor" data-target="0"><i class="fa fa-trash-o"></i></button>
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
		$query = ("SELECT * FROM clientes;");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			 for($i=0;$i<$numerofilas;$i++){
				$arrDireccion = explode(",", $row[$i]["direccion"]);
				$a[] = $numerofilas;						// 0	
				$a[] = "23";								// 1	
				$a[] = $row[$i]["id_cliente"];				// 2	0
				$a[] = $row[$i]["folio"];					// 3	1 		APLICA PARA SELECTS
				$a[] = $row[$i]["nombre"];					// 4	2
				$a[] = $arrDireccion[0];          			// 5	3
				$a[] = $row[$i]["telefono"];				// 6	4
				$a[] = $row[$i]["celular"];					// 7	5
				$a[] = $row[$i]["ciudad"];					// 8	6
				$a[] = $row[$i]["colonia"];					// 9	7
				$a[] = $row[$i]["codigo_postal"];			// 10	8
				$a[] = $row[$i]["descuento"];				// 11	9
				$a[] = $row[$i]["lim_credito"];				// 12	10
				$a[] = $row[$i]["correo"];					// 13	11
				$a[] = $row[$i]["fecha_nacimiento"];		// 14	12
				$a[] = $row[$i]["sexo"];					// 15	13
				$a[] = $row[$i]["fecha_alta"];				// 16	14
				$a[] = $row[$i]["foto"];					// 17	15
				$a[] = $row[$i]["rfc"];						// 18	16
				$a[] = $row[$i]["empresa"];					// 19	17
				$a[] = $row[$i]["no_cuenta"];				// 20	18
				$a[] = $row[$i]["banco"];					// 21	19
				$a[] = $row[$i]["usuario"];					// 22	20
				$a[] = $arrDireccion[1];
				$a[] = $arrDireccion[2];
			 }
		}
		foreach($a as $name){
			echo $name . "~";
		}
	}

}
?>
