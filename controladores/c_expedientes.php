<?php
class expedientes {										// ::::::::::::::: PONER NOMBRE DE CLASE IGUAL QUE EL MENU (solo minusculas)	

	public function _insertar(){
		$omodelo = new m_modelo();
		extract($_POST);
		$tama = $_FILES["archivo"]['size'];
		if ($tama > 8380000) {		
			echo "<script> alert('Excede el tamaño de archivo');</script>";
			return false;
		}
		if ($tama == 0) {
			echo "<script> alertas('Selecciona un archivo');</script>";
			return false;
		}else{
			date_default_timezone_set('America/Mexico_City');
			$fechaCarga = date("y-m-d H:i:s");
			$status = ""; 
			$tipe = $_FILES["archivo"]['type'];
			$archivo = $_FILES["archivo"]['name'];
			$prefijo = substr(md5(uniqid(rand())),0,3);
			$tamano = $_FILES["archivo"]['size'];
			$archiv = explode(".",$archivo);
			if ($nombre != "") {
					$nombre = $nombre.".".$archiv[1];
					$liga = $prefijo."_".$nombre;
					$destino =  "archivos/".$prefijo."_".$nombre;			
				if (copy($_FILES['archivo']['tmp_name'],$destino)) {									
					$mensajeb = "Archivo subido: ".$nombre."";
				} else {
					$mensajeb = "Error 1 al subir el archivo";
				}
			} else {
				$mensajeb = "Error 2 al subir archivo";
			}
		}
		$query = ("insert into axc_archivos () VALUES (null, 'Coberturas', '$folio', '$tipo', '$nombre', '$descripcion', '$liga', '$fechaCarga');");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error de registro";
		}else{
			$mensaje = "Registro exitoso";
		}
		return $mensaje.", ".$mensajeb ;
	}
	
	public function _modificar(){
		$omodelo = new m_modelo();
		date_default_timezone_set('America/Mexico_City');
		extract($_POST);
		$nombre = $nombre.".".$nombre2;
		$query = ("UPDATE axc_archivos set expediente='Coberturas', folio='$folio', tipo='$tipo', nombre='$nombre', descripcion='$descripcion' where id_archivo = '$idarchivo';");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error de Modificaci&oacute;n"; 
		}else{
			$mensaje = "El archivo se modifico con &eacute;xito"; // ::::::::::::::: MODIFICAR MENSAJES
		}
		return $mensaje;
	}

	public function _eliminar(){
		$omodelo = new m_modelo();
		extract($_POST);
		$dir = "archivos/".$dir."";
		if(file_exists($dir)){
			unlink($dir);			
		}
		// ::::::::::::::: MODIFICAR EL QUERY
		$query = ("DELETE FROM axc_archivos WHERE id_archivo = '$idAR';");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error al eliminar el archivo";
		}else{
			$mensaje = "Archivo eliminado con &eacute;xito";				// ::::::::::::::: MODIFICAR EL MENSAJE		
		}
		return $mensaje;
	}

	public function _consultar(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM axc_archivos;");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			for($i=0;$i<$numerofilas;$i++){
				$opciones = "";
				$selectCobert = "";
				//if ($row[$i]['expediente'] == "Coberturas") {
					$queryt = ("SELECT * FROM axc_riesgos;");
					$rowt = $omodelo->_consultar($queryt);
					$numerofilast = $omodelo->numerofilas;
					for($jt=0;$jt<$numerofilast;$jt++){
						if($row[$i]["folio"] == $rowt[$jt]['id_riesgo']){
							$seleccionadot = "selected";
						}else{
							$seleccionadot = "";
						}
						$selectCobert.= '<option '.$seleccionadot.' value="'.$rowt[$jt]['id_riesgo'].'">'.$rowt[$jt]['folio'].'</option>';
					}
				//}
				$tpoDocumento = array('Comprobante de compra');
				for($j=0;$j<count($tpoDocumento);$j++){
					if($row[$i]["tipo"] == $tpoDocumento[$j]){
						$seleccionadoc = "selected";
					}else{
						$seleccionadoc = "";
					}
					$opciones .= '<option '.$seleccionadoc.' value="'.$tpoDocumento[$j].'">'.$tpoDocumento[$j].'</option>';
				}
				$elnombre = explode(".",$row[$i]["nombre"]);
				$idform = "editarF".$row[$i]["id_archivo"]."";
				$lista .= '<div nombre="'.strtolower($row[$i]["nombre"]).'" class="listaBuscar" tipo="fila">					
					<b style="color:white">'.$row[$i]['nombre'].'</b>
					<form permiso=ARE id="eliminarF'.$row[$i]["id_archivo"].'" class="formEliminar" name=desPO'.$row[$i]["id_archivo"].' action="?cmo=eliminar" method="post">
						<input type="hidden" name="nomPagina" value="v_expedientes">
						<input type="hidden" name="idAR" value="'.$row[$i]["id_archivo"].'">
						<input type="hidden" name="dir" value="'.$row[$i]["liga"].'">
						<b style="color:white">Estas seguro que deseas eliminar este archivo?</b><br>
						<div class="botonesGCeliminar">
							<input type="button" onclick="eliminarFor('.$row[$i]['id_archivo'].')" value="No, cancelar"/>
							<input type="submit" value="Si, eliminar" />
						</div>
					</form>
					<form permiso=ARM id="editarF'.$row[$i]["id_archivo"].'" class="formModificar nomostrar" name="formusrM" action="?cmo=modificar" method="post" onsubmit="">		<!-- MODIFICAR -->
						<div class="formsModificar">
							<input type="hidden" name="nomPagina" value="v_expedientes">
							<input type="hidden" id="oculto" name="idarchivo" value="'.$row[$i]["id_archivo"].'">
							<table>
								<tr id="escrit'.$row[$i]["id_archivo"].'" class="obligatorio">
									<td><span>Cobertura*</span></td>
									<td>
										<select class="coberturs" name="folio" id="folio-'.$row[$i]["id_archivo"].'" cargado="1" title="Selecciona la cobertura">
										<option value="">- Selecciona -</option>
										'.$selectCobert.'
										</select>
									</td>									
								</tr>
								<tr class="obligatorio">
									<td><span>Tipo de documento*</span></td>
									<td>
										<select class="selec tipoDocumento" name="tipo" id="tipo-'.$row[$i]["id_archivo"].'" required title="Selecciona el tipo del documento">
											<option value="0">- Selecciona -</option>
											<option>Comprobante de compra</option>
											'.$opciones.'
										</select>
									</td>
								</tr>
								<tr class="obligatorio">
									<td><span>Nombre*</span></td>
									<td><input type="text" name="nombre" required id="nombre" value="'.$elnombre[0].'" title="Ingresa el nombre del archivo"><input class="oculto" type="text" name="nombre2" value="'.$elnombre[1].'"></td>
								</tr>
								<tr>
									<td><span>Descripci&oacute;n</span></td>
									<td><textarea class="ui-widget ui-state-default ui-corner-all" style="max-width:280px;max-height:150px" rows="4" cols="22" name="descripcion" id="descripcion" placeholder="Agrega una descripci&oacute;n detallada" title="Agrega una descripci&oacute;n detallada del documento">'.$row[$i]["descripcion"].'</textarea></td>
								</tr>			
							</table>		
						</div>
						<p style="left:50px; position:absolute;color:white"><b>* Campos obligatorios</b></p>						
						<center>
							<div id="divbotonesGC">
								<input type="submit" style="display:none">
								<input id="Guardar" value="Guardar" type="button" class="botonesGC" onclick="validarForm(\'editarF'.$row[$i]["id_archivo"].'\')">
								<input value="Cancelar" type="button" onclick="$(\'.formModificar\')['.$i.'].reset()" class="botonesGC">
							 </div>
						 </center>
					</form>		
					<img permiso=ARM id="'.$row[$i]['id_archivo'].'" src="vistas/images/edit.png" onclick="crearForm('.$row[$i]['id_archivo'].')" class="botonEditar">
					<img permiso=ARE id="'.$row[$i]['id_archivo'].'" src="vistas/images/bin.png" onclick="eliminarFor('.$row[$i]['id_archivo'].')" class="botonBorrar">
					</div>';				
			}
			return utf8_encode($lista);
		}
	}	
		
	public function _consulta(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM axc_archivos;");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			$contador = 1;
			$row = $omodelo->_consultar($query);
			 for($i=0;$i<$numerofilas;$i++){
				$a[] = $numerofilas;					// 0
				$a[] = $row[$i]["id_archivo"];			// 1
				$a[] = $row[$i]["nombre"];				// 2
				$a[] = $row[$i]["descripcion"];			// 3
				$a[] = $row[$i]["liga"];				// 4
				$a[] = $row[$i]["fecha_carga"];			// 5
				$a[] = $row[$i]["expediente"];			// 6
				$a[] = $row[$i]["folio"];				// 7
				$a[] = $row[$i]["tipo"];				// 8
			 }
		}
		foreach($a as &$name){
			echo utf8_encode ($name . "~");
		}
	}
	
	public function _reporte(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM axc_archivos;");				// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
		
			$lista1 = '<div id="noImprime" style="margin-top:40px">
			<table class="datatabless" width="100%">
				<thead id="imprimirTh">
					<tr class="expandible">
						<th id="thprimero" style="border-radius: 5px 0 0;">Expediente de:</th>
						<th>Folio</th>
						<th>Tipo de documento</th>
						<th>Nombre</th>
						<th>Descripci&oacute;n</th>
						<th style="border-radius: 0 5px 0 0;">Fecha y hora de subida</th>
					</tr>
				</thead>
				<tbody id="imprimirTb">';
		
			for($i=0;$i<$numerofilas;$i++){
				$folio = "";
				$elmodulo = "";
				if ($row[$i]['expediente'] == "Coberturas") {
					$elmodulo = "axc_riesgos";					
					$folio = "folio";
					$elid = "id_riesgo";
				}
				$queryb = ("SELECT * FROM $elmodulo where $elid = ".$row[$i]['folio'].";");
				$rowb = $omodelo->_consultar($queryb);
				$nombre = '<a class="links" href="config/download.php?file='.$row[$i]["liga"].'">'.$row[$i]["nombre"].'</a>';
				$feca = explode(" ",$row[$i]["fecha_carga"]);
				
				$lista2 .= '										
						<tr>
							<td class="expandible0">'.$row[$i]['expediente'].'</td>
							<td class="expandible1">'.$rowb[0][$folio].'</td>
							<td class="expandible2">'.$row[$i]['tipo'].'</td>
							<td class="expandible4 linkExpedie">'.$nombre.'</td>
							<td class="expandible5">'.$row[$i]["descripcion"].'</td>
							<td class="expandible6">Fecha: '._fecha($feca[0]).'<br>Hora: '.$feca[1].'</td>																	
						</tr>';				
			}
			$lista3 = '</tbody></table></div>';
			$lista = $lista1.$lista2.$lista3;
		}
		return utf8_encode($lista);
	}		
	
}
?>
