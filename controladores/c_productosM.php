<?php
class productosM {
	
	public function _insertar(){
		date_default_timezone_set('America/Mexico_City');
		$omodelo = new m_modelo();
		extract($_POST);
		$fecha = date("Y-m-d");
		$query = ("insert into productos (id_producto,codigo,nombre,descripcion,tipo,material,categoria,fecha_ingreso,clase,medida,color) VALUES 
		(null, '$codigo', '$nombre', '$descripcion', '$tipo', '$material', '$categoria', '$fecha', '2', '$medida', '$elcolor');");
		$error = $omodelo->_insertar($query);
		
		$query2 = ("SELECT * FROM productos order by id_producto desc limit 1;");
		$row = $omodelo->_consultar($query2);
		
		$proveedor = explode(",",$proveedor);
		if($proveedor != ""){
			foreach($proveedor as $prove){
				$query3 = ("INSERT INTO detalle_proveedores(id_detalle,proveedor,producto) VALUES(null, '".$prove."', '".$row[0]['id_producto']."');");
				$error3 = $omodelo->_insertar($query3);
			}
		}
	// :::::::::::::::::::::::::::::::::::::::::::::::::::::::	AGREGAR MOVIMIENTO A LA BASE DE DATOS	:::::::::::::::::::::::::::::::::::::::::::::::::::::
		$cobjeto = new controller();
		$cobjeto->_movimientos("Materia prima#Productos","Insertar","Se dio de alta el producto: ".$row[0]['codigo']." con el nombre: ".$row[0]['nombre']);
	//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		if ($error == "si") {
			$mensaje = "Error de registro";
		}else{
			$mensaje = "Producto registrado";
		}
		echo $mensaje."#".$error."#".$row[0]['id_producto'];
	}
	
	public function _modificar(){
		date_default_timezone_set('America/Mexico_City');
		$omodelo = new m_modelo();
		extract($_POST);

		$query = ("UPDATE productos set codigo='$codigo', nombre='$nombre', descripcion='$descripcion', tipo='$tipo', material='$material', categoria='$categoria', medida='$medida', color='$elcolor' where id_producto = '$idR';");
		$error = $omodelo->_insertar($query);
		
		$proveedor = explode(",",$proveedor);
		if($proveedor != ""){
			
			$query5 = ("DELETE FROM detalle_proveedores where producto = '$idR';");
			$ro5 = $omodelo->_insertar($query5);
			
			$query2 = ("SELECT * FROM productos where id_producto = '$idR';");
			$row = $omodelo->_consultar($query2);

			foreach($proveedor as &$prove){
				$query3 = ("INSERT INTO detalle_proveedores() VALUES(null, '$prove', '$idR');");
				$error3 = $omodelo->_insertar($query3);
			}
		}
		if ($error == "si") {
			$mensaje = "Error de Modificaci&oacute;n"; 
		}else{
			$mensaje = "El producto se modifico con &eacute;xito";
		}
		echo $mensaje."#".$error."#".$idR;
	}

	public function _eliminar(){
		$omodelo = new m_modelo();
		extract($_POST);
		if(file_exists($ligaFotoB)){
			unlink($ligaFotoB);			
		}

		$query = ("DELETE FROM productos WHERE id_producto = '$idElimina';");
		$error = $omodelo->_insertar($query);
		
			$query3 = ("DELETE FROM detalle_proveedores where producto = '$idElimina');");
			$error3 = $omodelo->_insertar($query3);
		
		if ($error == "si") {
			$mensaje = "Error al eliminar el producto";
		}else{
			$mensaje = "Producto eliminado";			
		}
		echo $mensaje."#".$error;
	}
	
	public function _foto(){
		$omodelo = new m_modelo();
		extract($_POST);
		if (!empty($_FILES)) {
			//var_dump($_FILES);
			//if($ligaFoto != 0){
				$dir = "archivos/fotosProductos/".$ligaFoto;
				if(file_exists($dir)){
					unlink($dir);
				}
			//}
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
					$destino =  "archivos/fotosProductos/".$liga;
					if (copy($_FILES['foto']['tmp_name'],$destino)) {									
						echo "Archivo subido: ".$nombreFoto."";
					} else {
						echo "Error 1 al subir el archivo";
					}
				} else {
					echo "Error 2 al subir archivo";
				}
			}
			$query = ("UPDATE productos set foto='$liga' where id_producto = '$idR';");
			$error = $omodelo->_insertar($query);
		}
	}
	
	public function _reporte(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM productos where clase = '2';");
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			
			$lista1 = '
						<div class="table-responsive" width="100%" style="overflow-x:auto;">
						<table width="100%" style="color:black" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover" id="tablaUsuarios">
							<thead id="imprimirTh" width="100%">
								<tr class="expandible">
									<th id="thprimero" style="border-radius: 5px 0 0;border-right: 1px solid #E5DDDD;">Producto</th>
									<th style="border-right: 1px solid #E5DDDD;">Nombre</th>
									<th style="width:100px;border-right: 1px solid #E5DDDD;">Descripci&oacute;n</th>
									<th style="border-right: 1px solid #E5DDDD;">Tipo</th>
									<th style="border-right: 1px solid #E5DDDD;">Material</th>
									<th style="border-right: 1px solid #E5DDDD;">Categor&iacute;a</th>
									<th style="border-right: 1px solid #E5DDDD;">Color</th>
									<th style="border-right: 1px solid #E5DDDD;">Proveedores</th>
									<th style="border-right: 1px solid #E5DDDD;">Fecha de registro</th>
									<th style="border-radius: 0 5px 0 0;border-right: 1px solid #E5DDDD;">Acci&oacute;n</th>
								</tr>
							</thead>
							<tbody id="imprimirTb" align="center" width="100%">'; 
			for($i=0;$i<$numerofilas;$i++){
				$proveedor = "";
				$provee = "";
				$laFoto = 'archivos/fotosProductos/'.$row[$i]["foto"].'';
				if($row[$i]["foto"] == ""){
					$laFoto = 'vistas/images/picture.png';
				}
				
				$query2 = ("SELECT * FROM detalle_proveedores where producto = '".$row[$i]["id_producto"]."';");
				$row2 = $omodelo->_consultar($query2);
				$numerofilas2 = $omodelo->numerofilas;
				for($k=0;$k<$numerofilas2;$k++){
					$query3 = ("SELECT * FROM proveedores where id_proveedor = '".$row2[$k]["proveedor"]."';");
					$row3 = $omodelo->_consultar($query3);
					$numerofilas3 = $omodelo->numerofilas;
					
					$provee = '
					<div class="popTabla" id="divPov-'.$row[$i]["id_producto"].$k.'">
					<div id="provT-'.$row[$i]["id_producto"].$k.'" class="table-responsive tablaProv" style="border-radius:20px">
						<div class="modal-header bg-inverse bd-inverse-darken" style="border-radius: 18px 18px 0 0;">
							<h6 class="modal-title">Proveedor: <strong>'.$row3[0]['nombre'].'</strong></h6>
						</div>
						<div style="background: aliceblue;border-radius: 0 0 18px 18px;padding: 10px;" class="panel-body">
							<table style="font-size:11px" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover">
								<tr>
									<td style="color: #898989;"><strong>Nombre</strong></td>
									<td>'.$row3[0]['nombre'].'</td>
								</tr>
								<tr>
									<td style="color: #898989;"><strong>Direcci&oacute;n</strong></td>
									<td>'.$row3[0]['direccion'].'</td>
								</tr>
								<tr>
									<td style="color: #898989;"><strong>Telef&oacute;no</strong></td>
									<td>'.$row3[0]['telefono'].'</td>
								</tr>
								<tr>
									<td style="color: #898989;"><strong>Ciudad</strong></td>
									<td>'.$row3[0]['ciudad'].'</td>
								</tr>
								<tr>
									<td style="color: #898989;"><strong>Empresa</strong></td>
									<td>'.$row3[0]['empresa'].'</td>
								</tr>
							</table>
						</div>
					</div>
					';
					if($numerofilas3 > 0){
						$proveedor .= ''.$provee.'<label style="font-size: 10px;padding: 2px;" id="popTabla-'.$row[$i]["id_producto"].$k.'" class="btn btn-theme-inverse"><i class="fa fa-eye"></i> '.$row3[0]['nombre'].'</label></div>';
					}
				}
				if($row[$i]["color"] != ""){
					$colo = '<div style="background:'.$row[$i]["color"].';width:60px;height:30px;box-shadow: 2px 2px 9px #999;cursor:pointer"></div>'.$row[$i]["color"];
				}else{
					$colo = 'N/A';
				}
				
				$lista2 .= '										
								<tr>
									<td class="expandible0"><a href="'.$laFoto.'" title="'.$row[$i]["nombre"].'" class="preview_fancybox"><img id="fot'.$row[$i]["id_producto"].'" alt="" style="width:50px" src="'.$laFoto.'" class=""/></a><br>'.$row[$i]["codigo"].'</td>
									<td class="expandible2">'.$row[$i]["nombre"].'</td>									
									<td class="expandible3" style="width:100px">'.$row[$i]["descripcion"].'</td>								
									<td class="expandible6">'.$row[$i]["tipo"].'</td>
									<td class="expandible7">'.$row[$i]["material"].'</td>
									<td class="expandible8">'.$row[$i]["categoria"].'</td>
									<td class="expandible8">'.$colo.'</td>
									<td class="expandible9">'.$proveedor.'</td>											
									<td class="expandible10">'.date("d-m-Y",strtotime($row[$i]["fecha_ingreso"])).'</td>
									<td class="expandible11" style="border-right:0">
										<span class="tooltip-area">
											<button id="mod-'.$row[$i]["id_producto"].'" type="button" class="btn btn-theme-inverse btn-info ventaModificar" data-effect="md-flipHor" data-target="0"><i class="fa fa-pencil-square-o"></i></button>
											<button id="eli-'.$row[$i]["id_producto"].'" type="button" class="btn btn-danger btn-danger ventaEliminar" data-effect="md-flipHor" data-target="0"><i class="fa fa-trash-o"></i></button>
										</span>
									</td>
								</tr>';
			}			
		}
		$lista3 = '</tbody>
						</table>
						</div>';
		$lista = $lista1.$lista2.$lista3.$permi;
		return $lista;
		//return utf8_encode($lista);
		//<td>'.$permisosBD.'</td>
	}		
	
	public function _consulta(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM productos where clase = '2';");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			 for($i=0;$i<$numerofilas;$i++){
				$provee = "";
				$query2 = ("SELECT * FROM detalle_proveedores where producto = '".$row[$i]["id_producto"]."';");
				$row2 = $omodelo->_consultar($query2);
				$numerofilas2 = $omodelo->numerofilas;
				 for($j=0;$j<$numerofilas2;$j++){
					if($provee == ""){
						$provee = $row2[$j]['proveedor'];
					}else{
						$provee = $provee."*".$row2[$j]['proveedor'];
					}
				 }
				
				$query3 = ("SELECT sum(cantidad) as suma FROM detalle_productos where producto = '".$row[$i]["id_producto"]."';");
				$row3 = $omodelo->_consultar($query3);
				$costoUni = 0;
				if($row3[0]["suma"] != 0){
					$costoUni = (double)$row[$i]["costo"] / (double)$row3[0]["suma"];
				}
				
				$query4 = ("SELECT * FROM detalle_productos where producto = '".$row[$i]["id_producto"]."';");
				$row4 = $omodelo->_consultar($query4);
				$numerofilasb = $omodelo->numerofilas;
				$detalles = "";
				for($j=0;$j<$numerofilasb;$j++){
					$detalles .= $row4[$j]["sucursal"]."#".$row4[$j]["cantidad"].",";
				}
				$a[] = $numerofilas;						// 0
				$a[] = "17";								// 1
				$a[] = $row[$i]["id_producto"];				// 2
				$a[] = $row[$i]["codigo"];					// 3
				$a[] = $row[$i]["nombre"];					// 4
				$a[] = $row[$i]["descripcion"];				// 5
				//$a[] = $row[$i]["costo"];					// 6
				$a[] = $costoUni;							// 6
				$a[] = $row[$i]["precio"];					// 7
				$a[] = $row[$i]["tipo"];					// 8
				$a[] = $row[$i]["material"];				// 9
				$a[] = $row[$i]["categoria"];				// 10
				$a[] = $row[$i]["foto"];					// 11
				$a[] = $row[$i]["fecha_ingreso"];			// 12
				$a[] = $provee;								// 13
				$a[] = $row[$i]["medida"];					// 14
				$a[] = $detalles;							// 15
				$a[] = $row[$i]["color"];					// 16
			 }
		}
		foreach($a as $name){
			echo urldecode($name . "~");
		}
	}
	
	public function _consultaValidar($campo,$valo){
		$omodelo = new m_modelo();
		$query = ("SELECT * FROM productos where ".$campo." = '".$valo."';");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		echo $numerofilas;
	}	
	
}
?>
