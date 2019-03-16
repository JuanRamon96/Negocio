<?php
class empleados {
	
	public function _insertar(){
		$omodelo = new m_modelo();
		date_default_timezone_set('America/Mexico_City');
		extract($_POST);
		$horario = $horarioEntrada." - ".$horarioSalida;
		$query = ("insert into empleados (id_empleado,nombre,direccion,telefono,ciudad,colonia,fecha_nacimiento,correo,celular,fecha_entrada,horario,sueldo,puesto) VALUES 
		(null, '$nombre', '$direccion', '$telefono', '$ciudad', '$colonia', '$fechabb', '$correo', '$celular', '$fechabb2', '$horario', '$sueldo', '$puesto');");
		$error = $omodelo->_insertar($query);
		
		$query2 = ("SELECT * FROM empleados order by id_empleado desc limit 1;");
		$row = $omodelo->_consultar($query2);
		
		if ($error == "si") {
			$mensaje = "Error de registro";
		}else{
			$mensaje = "Empleado registrado";
		}
		echo $mensaje."#".$error."#".$row[0]['id_empleado'];
	}
	
	public function _modificar(){
		$omodelo = new m_modelo();
		extract($_POST);
		
		$horario = $horarioEntrada." - ".$horarioSalida;
		$query = ("UPDATE empleados SET nombre='$nombre', direccion='$direccion', telefono='$telefono', ciudad='$ciudad', fecha_entrada='$fechabb2', 
		horario='$horario', sueldo='$sueldo', fecha_nacimiento='$fechabb', colonia='$colonia', puesto='$puesto', correo='$correo', 
		celular='$celular' where id_empleado = '$idR';");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error de Modificaci&oacute;n"; 
		}else{
			$mensaje = "El empleado se modifico con &eacute;xito";
		}
		echo $mensaje."#".$error."#".$idR;
	}

	public function _eliminar(){
		$omodelo = new m_modelo();
		extract($_POST);
		if(file_exists($ligaFotoB)){
			unlink($ligaFotoB);			
		}
		$query = ("DELETE FROM empleados WHERE id_empleado = '$idElimina';");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error al eliminar el empleado";
		}else{
			$mensaje = "Empleado eliminado";			
		}
		echo $mensaje."#".$error;
	}

	public function _foto(){
		$omodelo = new m_modelo();
		extract($_POST);
		if (!empty($_FILES)) {
			//var_dump($_FILES);
			if($ligaFoto != 0){
				$dir = "archivos/fotosEmpleados/".$ligaFoto;
				if(file_exists($dir)){
					unlink($dir);
				}
			}
			$liga = "Primero";
			if($_FILES["foto"]["size"] > 0){
				$tipob = $_FILES["foto"]["type"];
				$archivob = $_FILES["foto"]["name"];
				$prefijo = substr(md5(uniqid(rand())),0,4);
				$archiv = explode(".",$archivob);
				$liga = "Segundo";
				if ($nombre != "") {
					$liga = "Tercero";
					$nombreEx = explode(" ",$nombre);
					for($w=0;$w<count($nombreEx);$w++){
						$nombreFotoB = $nombreFotoB.$nombreEx[$w];
					}
					$nombreFoto = $nombreFotoB.".".$archiv[1];
					$liga = $prefijo."_".$nombreFoto;
					$destino =  "archivos/fotosEmpleados/".$liga;
					if (copy($_FILES['foto']['tmp_name'],$destino)) {									
						$estado = "Archivo subido: ".$nombreFoto."";
					} else {
						$estado =  "Error 1 al subir el archivo";
					}
				} else {
					$estado =  "Error 2 al subir archivo";
				}
			}
			$query = ("UPDATE empleados set foto='".$liga."' where id_empleado = '$idR';");
			$error = $omodelo->_insertar($query);
		}
	}
	
	public function _reporte(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM empleados;");
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
									<th id="thprimero" style="border-radius: 5px 0 0;">Nombre / foto</th>
									<th>Fecha de nacimiento</th>
									<th>Direcci&oacute;n</th>
									<th>Telef&oacute;nos</th>
									<th>Fecha de inicio</th>
									<th>Puesto</th>
									<th>Sueldo</th>
									<th>Horario</th>
									<th style="border-radius: 0 5px 0 0;">Acci&oacute;n</th>
								</tr>
							</thead>
							<tbody id="imprimirTb" align="center">'; 
			$provee = "";
			$verMas = "";
			$row = $omodelo->_consultar($query);
			for($i=0;$i<$numerofilas;$i++){
				
				$provee = '
					<div class="popTabla" id="divPov-'.$row[$i]["id_empleado"].$i.'">
					<div id="provT-'.$row[$i]["id_empleado"].$i.'" class="table-responsive tablaProv" style="border-radius:20px">
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
					$laFoto = 'archivos/fotosEmpleados/'.$row[$i]["foto"].'';
				}
				$direccion = 'Ciudad:    &nbsp; <strong>'.$row[$i]["ciudad"].'</strong><br>
							  Colonia:   &nbsp; <strong>'.$row[$i]["colonia"].'</strong><br>
							  Direcci&oacute;n: &nbsp; <strong>'.$row[$i]["direccion"].'</strong><br>
							  Correo: &nbsp; <strong>'.$row[$i]["correo"].'</strong><br>
				';
				$telefonos = 'Telef&oacute;no:  &nbsp; <strong>'.$row[$i]["telefono"].'</strong><br>
							  Celular:   &nbsp; <strong>'.$row[$i]["celular"].'</strong><br>
				';
				$verMas = $provee.'<label style="font-size: 10px;padding: 2px;" id="popTabla-'.$row[$i]["id_empleado"].$i.'" class="btn btn-theme-inverse"><i class="fa fa-eye"></i> Ver mas</label></div>';
				$lista2 .= '										
								<tr>
									<td class=""><a href="'.$laFoto.'" title="'.$row[$i]["nombre"].'" class="preview_fancybox"><img id="fot'.$row[$i]["id_empleado"].'" alt="" style="width:60px" src="'.$laFoto.'" class="circle"/></a><br>'.$row[$i]["nombre"].'<br>No. de empleado: <strong>'.$row[$i]["id_empleado"].'</strong></td>
									<td class="">'.date("d-m-Y",strtotime($row[$i]["fecha_nacimiento"])).'</td>
									<td class="" style="text-align:left">'.$direccion.'</td>
									<td class="" style="text-align:left">'.$telefonos.'</td>
									<td class="decimal">'.date("d-m-Y",strtotime($row[$i]["fecha_entrada"])).'</td>
									<td class="">'.$row[$i]["puesto"].'</td>
									<td class="dinero">'.$row[$i]["sueldo"].'</td>
									<td class="">'.$row[$i]["horario"].'</td>
									<td>
										<span class="tooltip-area">
											<button id="mod-'.$row[$i]["id_empleado"].'" type="button" class="btn btn-theme-inverse btn-info ventaModificar" data-effect="md-flipHor" data-target="0"><i class="fa fa-pencil-square-o"></i></button>
											<button id="eli-'.$row[$i]["id_empleado"].'" type="button" class="btn btn-danger btn-danger ventaEliminar" data-effect="md-flipHor" data-target="0"><i class="fa fa-trash-o"></i></button>
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
		$query = ("SELECT * FROM empleados;");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			 for($i=0;$i<$numerofilas;$i++){
				$a[] = $numerofilas;						// 0	
				$a[] = "17";								// 1	
				$a[] = $row[$i]["id_empleado"];				// 2	0		APLICA PARA SELECTS
				$a[] = $row[$i]["nombre"];					// 3	1
				$a[] = $row[$i]["direccion"];				// 4	2
				$a[] = $row[$i]["telefono"];				// 5	3
				$a[] = $row[$i]["celular"];					// 6	4
				$a[] = $row[$i]["ciudad"];					// 7	5
				$a[] = $row[$i]["colonia"];					// 8	6
				$a[] = $row[$i]["puesto"];					// 9	7
				$a[] = $row[$i]["correo"];					// 10	8
				$a[] = $row[$i]["fecha_nacimiento"];		// 11	9
				$a[] = $row[$i]["sexo"];					// 12	10
				$a[] = $row[$i]["fecha_entrada"];			// 13	11
				$a[] = $row[$i]["foto"];					// 14	12
				$a[] = $row[$i]["horario"];					// 15	13
				$a[] = $row[$i]["sueldo"];					// 16	14
			 }
		}
		foreach($a as $name){
			echo $name . "~";
		}
	}

}
?>