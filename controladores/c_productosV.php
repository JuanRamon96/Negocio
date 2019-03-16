<?php
class productosV {
	
	public function _insertar(){
		date_default_timezone_set('America/Mexico_City');
		$omodelo = new m_modelo();
		extract($_POST);
		$fecha = date("Y-m-d");
		$query = ("insert into productos (id_producto,codigo,nombre,descripcion,tipo,material,categoria,fecha_ingreso,clase,medida,precio,color) VALUES 
		(null, '$codigo', '$nombre', '$descripcion', '$tipo', '$material', '$categoria', '$fecha', '1', '$medida', '$precio', '$elcolor');");
		$error = $omodelo->_insertar($query);
		
		$query2 = ("SELECT * FROM productos order by id_producto desc limit 1;");
		$row = $omodelo->_consultar($query2);
		
		$proveedor = explode(",",$proveedor);
		if($proveedor != ""){
			foreach($proveedor as $prove){
				$query3 = ("INSERT INTO detalle_proveedores(id_detalle,proveedor,producto)  VALUES(null, '".$prove."', '".$row[0]['id_producto']."');");
				$error3 = $omodelo->_insertar($query3);
			}
		}

		//$cBarras = $this->_barcode($codigo);
		
		$error = "no";
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
		
		$query = ("UPDATE productos set codigo='$codigo', nombre='$nombre', descripcion='$descripcion', costo='$costo', precio='$precio', tipo='$tipo', material='$material', categoria='$categoria', medida='$medida', precio='$precio', color='$elcolor' where id_producto = '$idR';");
		$error = $omodelo->_insertar($query);
		
		$proveedor = explode(",",$proveedor);
		if($proveedor != ""){
			
			$query5 = ("DELETE FROM detalle_proveedores where producto = '$idR';");
			$ro5 = $omodelo->_insertar($query5);
			
			$query2 = ("SELECT * FROM productos where id_producto = '$idR';");
			$row = $omodelo->_consultar($query2);
			
			foreach($proveedor as $prove){
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
		echo $ligaFotoB."#".$error;
	}
	
	public function _foto(){
		$omodelo = new m_modelo();
		extract($_POST);
		if (!empty($_FILES)) {
			//var_dump($_FILES);
			if($ligaFoto != 0){
				$dir = "archivos/fotosProductos/".$ligaFoto;
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
		$query = ("SELECT * FROM productos where clase = '1';");
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			
			$lista1 = '
						<div class="col-md-12 table-responsive" width="100%" style="overflow-x:auto;">
						<table width="100%" style="color:black" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover" id="tablaUsuarios">
							<thead id="imprimirTh" width="100%">
								<tr class="expandible">
									<th id="thprimero" style="border-radius: 5px 0 0;border-right: 1px solid #E5DDDD;">Producto</th>
									<th style="border-right: 1px solid #E5DDDD;">Nombre</th>
									<th style="border-right: 1px solid #E5DDDD;">Precio de venta</th>
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
					$colo = '<div class="abreColor" id="color-'.$row[$i]["id_producto"].'" style="background:'.$row[$i]["color"].';width:60px;height:30px;box-shadow: 2px 2px 9px #999;cursor:pointer"></div>'.$row[$i]["color"];
					$divColor .= '
						<div style="display:none;  position: absolute;
				  z-index: 10;
				  width: 95%;
				  height: 50%;
				  top: 10%;
				  box-shadow: 5px 5px 100px #000;" id="divXolor-'.$row[$i]["id_producto"].'" >
							<div class="modal-header bg-inverse bd-inverse-darken" style="border-radius: 18px 18px 0 0;">
								<h6 class="modal-title">Color: <strong>'.$row[$i]['color'].'</strong></h6>
							</div>
							<div style="background: '.$row[$i]["color"].';border-radius: 0 0 18px 18px;height:50%" class="panel-body">
							
							</div>
						</div>
						';
				}else{
					$colo = 'N/A';
				}
				
				$lista2 .= '										
								<tr>
									<td class="expandible0"><a href="'.$laFoto.'" title="'.$row[$i]["nombre"].'" class="preview_fancybox"><img id="fot'.$row[$i]["id_producto"].'" alt="" style="width:50px" src="'.$laFoto.'" class=""/></a><br>'.$row[$i]["codigo"].'</td>
									<td class="expandible2">'.$row[$i]["nombre"].'</td>
									<td class="dinero"><b>'.$row[$i]["precio"].'</b></td>
									<td class="expandible3" style="width:100px">'.$row[$i]["descripcion"].'</td>								
									<td class="expandible6">'.$row[$i]["tipo"].'</td>
									<td class="expandible7">'.$row[$i]["material"].'</td>
									<td class="expandible8">'.$row[$i]["categoria"].'</td>
									<td class="expandible8">'.$colo.'</td>
									<td class="expandible9">'.$proveedor.'</td>											
									<td class="expandible10" style="width:100px">'.date("d-m-Y",strtotime($row[$i]["fecha_ingreso"])).'</td>
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
		$lista = $lista1.$lista2.$lista3.$permi.$divColor;
		return $lista;
		//return utf8_encode($lista);
		//<td>'.$permisosBD.'</td>
	}		
	
	public function _consulta(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM productos where clase = '1';");	// ::::::::::::::: MODIFICAR EL QUERY
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

				$a[] = $numerofilas;						// 0
				$a[] = "15";								// 1
				$a[] = $row[$i]["id_producto"];				// 2
				$a[] = $row[$i]["codigo"];					// 3
				$a[] = $row[$i]["nombre"];					// 4
				$a[] = $row[$i]["descripcion"];				// 5
				$a[] = $row[$i]["costo"];					// 6
				$a[] = $row[$i]["precio"];					// 7
				$a[] = $row[$i]["tipo"];					// 8
				$a[] = $row[$i]["material"];				// 9
				$a[] = $row[$i]["categoria"];				// 10
				$a[] = $row[$i]["foto"];					// 11
				$a[] = $row[$i]["fecha_ingreso"];			// 12
				$a[] = $provee;								// 13
				$a[] = $row[$i]["medida"];					// 14
			 }
		}
		foreach($a as $name){
			echo utf8_encode($name . "~");
		}
	}

	public function _consultaProducto(){
		$omodelo = new m_modelo();
		extract($_POST);
		$filtro = "";
		if($_POST["buscar"] != ""){
			$filtro = " AND codigo LIKE '%".$_POST["buscar"]."%' OR nombre LIKE '%".$_POST["buscar"]."%' OR descripcion LIKE '%".$_POST["buscar"]."%'";
		}
		//SELECT * FROM productos where clase = '1' OR codigo LIKE %'PAY'% OR nombre LIKE %'PAY'% OR descripcion LIKE %'PAY'%;
		$query = ("SELECT * FROM productos where clase = '1' ".$filtro.";");	// ::::::::::::::: MODIFICAR EL QUERY
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
				 
				$sucursal = "";
				$query3 = ("SELECT * FROM detalle_productos where producto = '".$row[$i]["id_producto"]."';");
				$row3 = $omodelo->_consultar($query3);
				$numerofilas3 = $omodelo->numerofilas;
				 for($k=0;$k<$numerofilas3;$k++){
					if($sucursal == ""){
						$sucursal = $row3[$k]['sucursal'];
						$cantidad = $row3[$k]['cantidad'];
					}else{
						$sucursal = $sucursal."*".$row3[$k]['sucursal'];
						$cantidad = $cantidad."*".$row3[$k]['cantidad'];
					}
				 }

				$a[] = $numerofilas;						// 0
				$a[] = "17";								// 1
				$a[] = $row[$i]["id_producto"];				// 2
				$a[] = $row[$i]["codigo"];					// 3
				$a[] = $row[$i]["nombre"];					// 4
				$a[] = $row[$i]["descripcion"];				// 5
				$a[] = $row[$i]["costo"];					// 6
				$a[] = $row[$i]["precio"];					// 7
				$a[] = $row[$i]["tipo"];					// 8
				$a[] = $row[$i]["material"];				// 9
				$a[] = $row[$i]["categoria"];				// 10
				$a[] = $row[$i]["foto"];					// 11
				$a[] = $row[$i]["fecha_ingreso"];			// 12
				$a[] = $provee;								// 13
				$a[] = $row[$i]["medida"];					// 14
				$a[] = $sucursal;							// 15
				$a[] = $cantidad;							// 16
			 }
		}
		foreach($a as $name){
			echo $name . "~";
		}
	}
	
	public function _consultaValidar($campo,$valo){
		$omodelo = new m_modelo();
		$query = ("SELECT * FROM productos where ".$campo." = '".$valo."';");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		echo $numerofilas;
	}	
	
	public function _barcode(){
		extract($_POST);
		
		require_once('controladores/generacodigo/class/BCGColor.php');
		require_once('controladores/generacodigo/class/BCGDrawing.php');
		require_once('controladores/generacodigo/class/BCGcode128.barcode.php');
		require_once('controladores/generacodigo/class/BCGFontFile.php');
		
		// Loading Font
		$font = new BCGFontFile('controladores/generacodigo/font/Arial.ttf', 18);
		$colorFront = new BCGColor(0, 0, 0);
		$colorBack = new BCGColor(255, 255, 255);

		// Barcode Part
		$code = new BCGcode128();
		$code->setScale(2);
		$code->setColor($colorFront, $colorBack);
		$code->setFont($font); // Font (or 0)
		$code->parse($codigo);

		// Drawing Part
		$drawing = new BCGDrawing('archivos/codeBar/codebar.png', $colorBack);
		$drawing->setBarcode($code);
		$drawing->draw();

		header('Content-Type: image/png');
		$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);

		/*
		// Including all required classes
		require_once('controladores/generacodigo/class/BCGFontFile.php');
		require_once('controladores/generacodigo/class/BCGColor.php');
		require_once('controladores/generacodigo/class/BCGDrawing.php');

		// Including the barcode technology
		require_once('controladores/generacodigo/class/BCGcode128.barcode.php');

		// Loading Font
		$font = new BCGFontFile('controladores/generacodigo/font/Arial.ttf', 18);

		// Don't forget to sanitize user inputs
		//$text = isset($_GET['text']) ? $_GET['text'] : 'HELLO';

		// The arguments are R, G, B for color.
		$color_black = new BCGColor(0, 0, 0);
		$color_white = new BCGColor(255, 255, 255);

		$drawException = null;
		try {
			$code = new BCGcode128();
			$code->setScale(3); // Resolution
			$code->setThickness(30); // Thickness
			$code->setForegroundColor($color_black); // Color of bars
			$code->setBackgroundColor($color_white); // Color of spaces
			$code->setFont($font); // Font (or 0)
			$code->parse($codigo); // Text
		} catch(Exception $exception) {
			$drawException = $exception;
		}

		$drawing = new BCGDrawing($color_white);
		if($drawException) {
			$drawing->drawException($drawException);
		} else {
			$drawing->setBarcode($code);
			$drawing->draw();
		}

		// Header that says it is an image (remove it if you save the barcode to a file)
		header('Content-Type: image/png');
		header('Content-Disposition: inline; filename="barcode.png"');

		// Draw (or save) the image into PNG format.
		$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
		//$imagen = '<img src="'.$drawing.'" alt="barcode" />';
		//echo $imagen;
		*/
	}
	
}
?>
