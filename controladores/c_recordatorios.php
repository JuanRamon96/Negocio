<?php
class recordatorios {										// ::::::::::::::: PONER NOMBRE DE CLASE IGUAL QUE EL MENU (solo minusculas)	

	public function _insertar(){
		$omodelo = new m_modelo();
		extract($_POST);
		date_default_timezone_set('America/Mexico_City');
		$lafecha = date("Y-m");
		$lafechaDia = date("d");
		$elMes = date("m");
		$elAnio = date("Y");
		if($fechaN != ""){
			$fNotificacion = $fechaN;
		}
		
		if($enviarRep == "on"){
			if($ndias != ""){				
				if($lafechaDia == $ndias){
					$clase = new reportes();
					switch($selecReportes){
						case 'puts':
							$repo = '_'.$selecReportes;
							$tabla = $clase->$repo();
							$titulo = 'Reporte de Puts';
						break;
						case 'calls':
							$repo = '_'.$selecReportes;
							$tabla = $clase->$repo();
							$titulo = 'Reporte de Calls';
						break;
						case 'restantes':
							$repo = '_'.$selecReportes;
							$tabla = $clase->$repo();
							$titulo = 'Reporte de Restantes';
						break;
						default :
							$clase = new $selecReportes();
							$tabla = $clase->_reporte();
							$titulo = 'Reporte de '.$selecReportes;
						break;
					}
					$correoss = str_replace('~',',', $correo);
					$tabla = str_replace('vistas/images/icons/print.png',' ', $tabla);
					$tabla = str_replace('vistas/images/icons/mail.png',' ', $tabla);
					$latabla = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Untitled Document</title>
					<style>thead tr{background-color:transparent}
					tfoot tr{font-weight:bold;background-color: #D2D2D2;}
					thead tr td{font-size:14px;height:30px;width: auto;position:relative;float: right;right:50px;margin-top:10px;background-color:transparent;border:0}
					tr{background-color: #F0F8DD;}
					tr:nth-child(2n+1){background-color: #FFFFFF;color:black;}
					th, td{padding: 3px;border: 2px solid #989898 ;border-radius: 3px;}
					th{background-color:#333333;font-size: 13px; color: #FFFFFF;text-align:center;}
					table {padding: 9px;border: 4px solid #C0C0C0;border-radius: 25px;background-color: #F0F0F0 ;text-align:center;width:100%}
					tbody{width:auto}p{font-size: 25px;color: black; text-align:center;background-color:transparent;border:0;width:100%;}
					input{display:none}</style>
					</head><body><center><img width=200 src=http://intranet.alimentosarandas.com/images/logob.png border=0><center><p>'.$titulo.'</p>'.$tabla.'<br><br>Correo enviado desde el sistema de software de p&oacute;lizas de seguros de Alimentos Arandas <br>
					<br> (esta cuenta de correo es utilizada solo para enviar correos y no para recibirlos) <br> *NO RESPONDER A ESTE CORREO </body></html>';
					$ocontroller = new controller();
					$mensaje = $ocontroller->_enviarRepor($latabla, $correoss, $nombre);
					
					if($ultimoDia == "1"){
						$diasMes = date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
						if($ndias > $diasMes){
							$fNotificacion = $lafecha."-".$diasMes;
						}
					}else{
						$fNotificacion = $lafecha."-".$ndias;
						$fNotificacion = date("Y-m-d", strtotime("$fNotificacion + 1 month"));
					}				
				}
			}
		}
		$ndias = $ndias."-".$ultimoDia;
		$query = ("insert into grecordatorios () VALUES (null, 'coberturas', '$correo', '$fNotificacion', '', '$comentarios', '$nombre', '$ndias', '$selecReportes');");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error de registro";
		}else{
			$mensaje = "Registro exitoso";
		}
		return $mensaje;
	}
	
	public function _modificar(){
		$omodelo = new m_modelo();
		extract($_POST);
		date_default_timezone_set('America/Mexico_City');
		$lafecha = date("Y-m");
		$elMes = date("m");
		$elAnio = date("Y");
		if($fechaN != ""){
			$fNotificacion = $fechaN;
		}
		if($ndias != ""){
			if($ultimoDia == "1"){
				$diasMes = date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
				if($ndias > $diasMes){
					$fNotificacion = $lafecha."-".$diasMes;
				}
			}else{
				$fNotificacion = $lafecha."-".$ndias;
				$fNotificacion = date("Y-m-d", strtotime("$fNotificacion + 1 month"));	
			}		
		}
		$ndias = $ndias."-".$ultimoDia;
		$query = ("UPDATE grecordatorios set asunto='$nombre', correos='$correo', fecha_notificacion='$fNotificacion', observaciones='$comentarios', dias='$ndias', reporte='$selecReportes' where id_recordatorio = '$idrecordatorio';");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error de Modificaci&oacute;n"; 
		}else{
			$mensaje = "El recordatorio se modifico con &eacute;xito"; // ::::::::::::::: MODIFICAR MENSAJES
		}
		return $mensaje;
	}

	public function _eliminar(){
		$omodelo = new m_modelo();
		extract($_POST);
														// ::::::::::::::: MODIFICAR EL QUERY
		$query = ("DELETE FROM grecordatorios WHERE id_recordatorio = '$idREC';");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error al eliminar el recordatorio";
		}else{
			$mensaje = "Recordatorio eliminado con &eacute;xito";				// ::::::::::::::: MODIFICAR EL MENSAJE		
		}
		return $mensaje;
	}

	public function _consultar(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM grecordatorios where gestor = 'coberturas';");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			$row = $omodelo->_consultar($query);
			 for($i=0;$i<$numerofilas;$i++){
				$OPopreportes = "";
				$OPgeneral = "";
				$arDias = explode("-",$row[$i]["dias"]);
				if($arDias[0] == ""){
					$unico = "checked";
					$repet = "";
					$dias = "oculto";
					$feca = "";
				}else{
					$unico = "";
					$repet = "checked";
					$feca = "oculto";
					$dias = "";
				}
				if($arDias[1] == "0"){
					$ultMes = "<br><smal style='font-size:11px'>(Se envia el &uacute;ltimo de cada mes)</small>";
				}else{
					$ultMes = "";
				}
				if($row[$i]["reporte"] != "0"){
					$rep = "checked";
					$selRep = "";
					$oblRepo = "obligatorio";
					//$queryc = ("SELECT * FROM usuarios where id_usuario = ".$_SESSION['id_p'].";");
					//$rowc = $omodelo->_consultar($queryc);
					$modul = array('Coberturas','Expedientes','Recordatorios','Usuarios');
					$modulV = array('coberturas','expedientes','recordatorios','usuarios');
					$report = array('Reporte de Puts','Reporte de Calls','Reporte de Restantes');
					$reportV = array('puts','calls','restantes');
					
					for($s=0;$s<count($modul);$s++){
						if($modulV[$s] == $row[$i]["reporte"]){
							$elseleccionado = "selected";
						}else{$elseleccionado = "";}
						$OPgeneral .= '<option '.$elseleccionado.' value="'.$modulV[$s].'">'.$modul[$s].'</option>';
					}
					for($sr=0;$sr<count($report);$sr++){
						if($reportV[$sr] == $row[$i]["reporte"]){
							$elseleccionado = "selected";
						}else{$elseleccionado = "";}
						$OPopreportes .= '<option '.$elseleccionado.' value="'.$reportV[$sr].'">'.$report[$sr].'</option>';
					}
					$general = "<optgroup label='Generales'>".$OPgeneral."</optgroup>";
					$opreportes = "<optgroup label='Reportes'>".$OPopreportes."</optgroup>";
					$opcionesRepo = $general.$opreportes;
				}else{
					$rep = "";
					$selRep = "oculto";
					$oblRepo = "";
					$opcionesRepo = "";
				}
				$contador = 90;
				$lcorreso = explode("~",$row[$i]["correos"]);
				for($j=0;$j<count($lcorreso);$j++){
				
				$correos .= '<div id="quit'.$contador.'" class="quitarspano spandiv ui-widget ui-state-default ui-corner-all" style="float:left;"><span class="" id="span'.$contador.'" >'.$lcorreso[$j].'</span><img id="'.$contador.'" class="quitarspan" src="vistas/images/close.png"></div>';
				$contador = $contador + 1;
				}
				$idform = "editarF".$row[$i]["id_recordatorio"]."";
				$lista .= '<div nombre="'.strtolower($row[$i]["asunto"]).'" class="listaBuscar" tipo="fila">					
					<b style="color:white">'.$row[$i]['asunto'].'</b>
					<form permiso=REE id="eliminarF'.$row[$i]["id_recordatorio"].'" class="formEliminar" name=desPO'.$row[$i]["id_recordatorio"].' action="?cmo=eliminar" method="post">
						<input type="hidden" name="nomPagina" value="v_recordatorios">
						<input type="hidden" name="idREC" value="'.$row[$i]["id_recordatorio"].'"> 
						<b style="color:white">Estas seguro que deseas eliminar a este recordatorio?</b><br>
						<div class="botonesGCeliminar">
							<input type="button" onclick="eliminarFor('.$row[$i]['id_recordatorio'].')" value="No, cancelar"/>
							<input type="submit" value="Si, eliminar" />
						</div>
					</form>
					<form permiso=REM id="editarF'.$row[$i]["id_recordatorio"].'" class="formModificar nomostrar" name="formusrM" action="?cmo=modificar" method="post" onsubmit="">		<!-- MODIFICAR -->
						<div class="formsModificar">
							<input type="hidden" name="nomPagina" value="v_recordatorios">
							<input type="hidden" id="oculto" name="idrecordatorio" value="'.$row[$i]["id_recordatorio"].'">
							<table>
								<tr class="obligatorio">
									<td><span>Nombre*</span></td>
									<td><input type="text" name="nombre" id="nombre" value="'.$row[$i]["asunto"].'" required title="Ingresa el nombre del recordatorio"></td>
								</tr>
								<tr>
									<td><span>Modo de env&iacute;o</span></td>
									<td><div class="radios" title="Selecciona por lo menos una opci&oacute;n">
									<input type="radio" '.$unico.' class="cheksAgregar" id="envioUni'.$row[$i]["id_recordatorio"].'" name="radio" onclick="envioUnico(\'editarF'.$row[$i]["id_recordatorio"].'\', '.$row[$i]["id_recordatorio"].')"><label style="width: 100px;" for="envioUni'.$row[$i]["id_recordatorio"].'">&Uacute;nico</label>
									<input type="radio" '.$repet.' class="cheksAgregar" id="envioRep'.$row[$i]["id_recordatorio"].'" name="radio" onclick="envioRepet(\'editarF'.$row[$i]["id_recordatorio"].'\', '.$row[$i]["id_recordatorio"].')"><label for="envioRep'.$row[$i]["id_recordatorio"].'">Repetitivo</label></div></td>
								</tr>
								<tr class="obligatorio" id="recorda">
									<td style="width:160px"><span>Fecha de notificaci&oacute;n*</span></td>
									<td id="envioRept">
										<input class="calendar '.$feca.'" type="text" name="fechaN" id="fechaN'.$row[$i]["id_recordatorio"].'" value="'._fecha($row[$i]["fecha_notificacion"]).'" title="Ingresa la fecha de notificaci&oacute;n">
										<div class="'.$dias.'" id="repetiti'.$row[$i]["id_recordatorio"].'"> cada: <input class="ui-widget ui-state-default ui-corner-all recDias" type="number" min="1" max="31" id="ndias-'.$row[$i]["id_recordatorio"].'" name="ndias" value="'.$arDias[0].'" style="width:40px"/> de cada mes '.$ultMes.'</div>										
										<input type="hidden" name="ultimoDia" id="ultimoDia-'.$row[$i]["id_recordatorio"].'" value="0">
									</td>
								</tr>
								<tr>
									<td></td>
									<td><div class="radios"><input type="checkbox" class="cheksAgregar chekEnvRep" '.$rep.' id="enviarRep-'.$row[$i]["id_recordatorio"].'" name="enviarRep" onclick="enviarRepo(\'editarF'.$row[$i]["id_recordatorio"].'\','.$row[$i]["id_recordatorio"].')"><label style="width: 200px;" for="enviarRep-'.$row[$i]["id_recordatorio"].'">Enviar reporte</label></div></td>
								</tr>
								<tr id="reportede-'.$row[$i]["id_recordatorio"].'" class="'.$selRep.' '.$oblRepo.'">
									<td><span>Reporte de: *</span></td>
									<td>
										<select class="selec selecReportes" name="selecReportes" id="selecReportes-'.$row[$i]["id_recordatorio"].'" title="Selecciona el reporte a enviar">
											<option value="0">- Selecciona -</option>'.$opcionesRepo.'
										</select>
									</td>
								</tr>
								<tr class="obligatorio">
									<td><span>Recordatorio*</span></td>
									<td><textarea class="ui-widget ui-state-default ui-corner-all" required style="max-width:280px;max-height:150px" rows="4" cols="22" name="comentarios" id="comentarios" title="Escribe los comentarios del recordatorio">'.$row[$i]["observaciones"].'</textarea></td>
								</tr>
								<tr>
									<td><span>Agregar Correo</span></td>
									<td>
										<input type="email" name="correos" id="correos'.$row[$i]["id_recordatorio"].'" title="Ingresa los correos a los cuales ser&aacute; enviado el recordatorio">
										<img id="" src="vistas/images/addC.png" onclick="spancorreos('.$row[$i]["id_recordatorio"].')" class="agregarCorr">
									</td>
								</tr>				
							</table>			
							<table>
								<tr class="obligatorioCorreo">
									<td><span id="core">Correos*</span></td>
									<div >
									<td style="width:700px;height:auto" class="borde tdcontactos" id="tdcontactos'.$row[$i]["id_recordatorio"].'">'.$correos.'</td>
									</div>
									<input type="hidden" id="correo" required title="Agrega por lo menos un correo" name="correo">
								</tr>
							</table>		
						</div>
						<p style="left:50px; position:absolute;color:white"><b>* Campos obligatorios</b></p>						
						<center>
							<div id="divbotonesGC">
								<input type="submit" style="display:none">
								<input id="Guardar" value="Guardar" type="button" class="botonesGC" onclick="validarForm(\'editarF'.$row[$i]["id_recordatorio"].'\')">
								<input value="Cancelar" type="button" onclick="$(\'.formModificar\')['.$i.'].reset()" class="botonesGC">
							 </div>
						 </center>
					</form>		
					<img permiso=REM id="'.$row[$i]['id_recordatorio'].'" src="vistas/images/edit.png" onclick="crearForm('.$row[$i]['id_recordatorio'].')" class="botonEditar">
					<img permiso=REE id="'.$row[$i]['id_recordatorio'].'" src="vistas/images/bin.png" onclick="eliminarFor('.$row[$i]['id_recordatorio'].')" class="botonBorrar">
					</div>';
				$opciones = "";
				$correos = "";
			}
			return utf8_encode($lista);
		}
	}	
		
	public function _consulta(){		
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM grecordatorios where gestor = 'coberturas';");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			$contador = 1;
			$row = $omodelo->_consultar($query);
			 for($i=0;$i<$numerofilas;$i++){
				$a[] = $numerofilas;					// 0
				$a[] = $row[$i]["id_recordatorio"];		// 1
				$a[] = $row[$i]["gestor"];				// 2
				$a[] = $row[$i]["correos"];				// 3
				$a[] = $row[$i]["fecha_notificacion"];	// 4
				$a[] = $row[$i]["periodo"];				// 5
				$a[] = $row[$i]["observaciones"];		// 6
				$a[] = $row[$i]["asunto"];				// 7
				$a[] = $row[$i]["dias"];				// 8
				$a[] = $row[$i]["reporte"];				// 9	
			 }
		}
		foreach($a as &$name){
			echo $name . ",";
		}
	}
	
	public function _reporte(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM grecordatorios where gestor = 'coberturas';");				// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
// ::::::::::::::: MODIFICAR (agregar y/o quitar) LOS NOMBRES DE LAS COLUMNAS DE LA TABLA
			$lista1 = '<div id="noImprime" style="margin-top:40px">
						<table class="datatabless" width="100%">
							<thead id="imprimirTh">
								<tr class="expandible">
									<th id="thprimero" style="border-radius: 5px 0 0;">Nombre</th>
									<th>Modo de env&iacute;o</th>
									<th>Prox&iacute;ma fecha de notificaci&oacute;n</th>
									<th>Reporte</th>
									<th>Recordatorio</th>
									<th style="border-radius: 0 5px 0 0;">Correos</th>
								</tr>
							</thead>
							<tbody id="imprimirTb">'; 
			$row = $omodelo->_consultar($query);
			for($i=0;$i<$numerofilas;$i++){
				if($row[$i]["dias"] != "0"){
					$modo = "Repetitivo";
				}else{
					$modo = "&Uacute;nico";
				}
				$losCorreos	= "";
				$correos = explode("~",$row[$i]["correos"]);
				foreach($correos as &$corre){
					if($losCorreos	== ""){
						$losCorreos = $corre;
					}else{
						$losCorreos .= ", ".$corre;
					}					
				}
				switch($row[$i]["reporte"]){
					case 'costoCRiesgo':
						$titulo = 'Reporte de Costo de cobertura VS Riesgo';
					break;
					case 'cobroCobert':
						$titulo = 'Reporte de Cobro de cobertura';
					break;
					case 'efectividad':
						$titulo = 'Reporte de Efectividad';
					break;
					case 'pagoPoliza':
						$titulo = 'Reporte de Pagos de p&oacute;lizas';
					break;
					case 'polizas':
						$titulo = 'P&oacute;lizas';
					break;
					default :
						$titulo = $row[$i]["reporte"];
					break;
				}
				if($row[$i]["reporte"] == "0"){
					$titulo = "Sin reporte";
				}
				if($row[$i]["observaciones"] == ""){
					$observac = "Sin recordatotio";
				}else{
					$observac = $row[$i]["observaciones"];
				}
				// ::::::::::::::: MODIFICAR (agregar y/o quitar) LOS DATOS A RECIBIR EN LA TABLA
				$lista2 .= '										
								<tr>
									<td class="expandible0">'.$row[$i]["asunto"].'</td>
									<td class="expandible1">'.$modo.'</td>
									<td class="expandible2">'._fecha($row[$i]["fecha_notificacion"]).'</td>
									<td class="expandible3" style="text-transform: capitalize;">'.$titulo.'</td>
									<td class="expandible4">'.$observac.'</td>									
									<td class="expandible5">'.$losCorreos.'</td>																	
								</tr>';
			}		
		}
		$lista3 = '</tbody>
						</table>
						</div>';
		$lista = $lista1.$lista2.$lista3;
		return utf8_encode($lista);
	}		
	
}
?>
