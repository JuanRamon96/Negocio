<?php
class comprasV {
	
	public function _insertar(){
		date_default_timezone_set('America/Mexico_City');
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("insert into compras (id_compra,fecha,usuario,proveedor,total,estatus,clase,folio,dias_pagar) VALUES 
		(null, '$fechabb', '".$_SESSION['id_tel']."', '$proveedor', '$total', '$estatus', '1', '$folio', '$dias');");
		$error = $omodelo->_insertar($query);
		
		$query1 = ("SELECT * FROM compras order by id_compra desc limit 1;");	// ::::::::::::::: MODIFICAR EL QUERY
		$row1 = $omodelo->_consultar($query1);
		$existencia = 0;
		$detalle = explode("#",$detalles);
		for($y=0;$y<count($detalle);$y++){
			$detalleB = explode("~",$detalle[$y]);
			$query2 = ("INSERT INTO detalle_compras (id_detalle,compra,producto,cantidad,subtotal,sucursal)
			values(null,'".$row1[0]['id_compra']."','".$detalleB[0]."','".$detalleB[1]."','".$detalleB[2]."','".$sucursal."');");
			$row2 = $omodelo->_insertar($query2);
			// ALMACEN 
			
			// COSTEO DEL PRODUCTO
			$costoAct = (double)$detalleB[1] * (double)$detalleB[2];

			$querys = ("UPDATE productos set costo=costo+".$costoAct." where id_producto = '".$detalleB[0]."';");
			$rows = $omodelo->_insertar($querys);
			// ----------------------------------------------------------------------------------------------------
			
			$query5 = ("SELECT * FROM detalle_productos where producto = '".$detalleB[0]."' and sucursal='".$sucursal."' ;");
			$row5 = $omodelo->_consultar($query5);
			$numerofilas5 = $omodelo->numerofilas;
			if($numerofilas5 > 0){
				$existencia = (double)$detalleB[1] + $row5[0]['cantidad'];
			
				$query6 = ("UPDATE detalle_productos set cantidad='".$existencia."' where id_detalle = '".$row5[0]['id_detalle']."';");
				$row6 = $omodelo->_insertar($query6);
			}else{
				$existencia = $detalleB[1];
				$query6 = ("INSERT INTO detalle_productos (id_detalle,producto,sucursal,cantidad) values(null,'".$detalleB[0]."','".$sucursal."','".$detalleB[1]."');");	// ::::::::::::::: MODIFICAR EL QUERY
				$row6 = $omodelo->_insertar($query6);
			}
		}
		if($estatus != 'Pagado'){
			$query4 = ("SELECT * FROM proveedores where id_proveedor = '".$proveedor."';");
			$row4 = $omodelo->_consultar($query4);

			$diasb = (int)$dias - 5;
			$fechaNot = date('Y-m-d',strtotime('+'.$diasb.' days', strtotime($fechaB)));
			$query3 = ("insert into notificaciones (id_notificacion,usuario,nombre,descripcion,fecha,modulo,id_modulo) VALUES 
			(null, '".$_SESSION['id_tel']."', 'Pagar nota', 'Pagar la nota <strong>".$folio."</strong> del proveedor ".$row4[0]['nombre']."', '$fechaNot', 'Compras', '".$row1[0]['id_compra']."');");
			$error3 = $omodelo->_insertar($query3);
		}
		if ($error == "si") {
			$mensaje = "Error de registro";
		}else{
			$mensaje = "Compra registrada";
		}
		echo $mensaje."#".$error;
	}
	
	public function _modificar(){
		date_default_timezone_set('America/Mexico_City');
		$omodelo = new m_modelo();
		extract($_POST);
		$query7 = ("SELECT * FROM detalle_compras where compra = '$idR';");	// ::::::::::::::: MODIFICAR EL QUERY
		$row7 = $omodelo->_consultar($query7);
		$numerofilas7 = $omodelo->numerofilas;
		$existencia4 = $costoActual = 0;
		for($x=0;$x<$numerofilas7;$x++){
		
			$queryg = ("SELECT sum(cantidad) as promedio FROM detalle_productos where producto = '".$row7[$x]['producto']."';");	// ::::::::::::::: MODIFICAR EL QUERY
			$rowg = $omodelo->_consultar($queryg);
			
			$querys = ("SELECT * FROM productos where id_producto = '".$row7[$x]['producto']."';");
			$rows = $omodelo->_consultar($querys);
			$costo=(double)$rows[0]['costo']/(double)$rowg[0]['promedio'];
			$costoMenos = (double)$costo * (double)$row7[$x]['cantidad'];
			$costoActual = (double)$rows[0]['costo'] - (double)$costoMenos;
			
			$queryj = ("UPDATE productos set costo=".$costoActual." where id_producto = '".$row7[$x]['producto']."';");
			$rowj = $omodelo->_insertar($queryj);
			
			$query9 = ("SELECT * FROM  detalle_productos where producto = '".$row7[$x]['producto']."' and sucursal='".$sucursal."' ;");	// ::::::::::::::: MODIFICAR EL QUERY
			$row9 = $omodelo->_consultar($query9);
			$existencia4 = (double)$row9[0]['cantidad'] - (double)$row7[$x]['cantidad'];	
			
			$query8 = ("UPDATE detalle_productos SET cantidad='".$existencia4."' where id_detalle = '".$row9[0]['id_detalle']."';");	// ::::::::::::::: MODIFICAR EL QUERY
			$row8 = $omodelo->_insertar($query8);
		}

		$query = ("UPDATE compras SET fecha='$fechabb',usuario='".$_SESSION['id_tel']."',proveedor='$proveedor',total='$total',estatus='$estatus',folio='$folio' where id_compra =  '$idR';");
		$error = $omodelo->_insertar($query);
		
		$query1 = ("DELETE FROM detalle_compras where compra = '$idR';");	// ::::::::::::::: MODIFICAR EL QUERY
		$row1 = $omodelo->_insertar($query1);
		
		$detalle = explode("#",$detalles);
		$existencia = $existencia3 = 0;
		for($y=0;$y<count($detalle);$y++){
			$detalleB = explode("~",$detalle[$y]);
			$query2 = ("INSERT INTO detalle_compras (id_detalle,compra,producto,cantidad,subtotal,sucursal)
			values(null,'".$idR."','".$detalleB[0]."','".$detalleB[1]."','".$detalleB[2]."','".$sucursal."');");
			$row2 = $omodelo->_insertar($query2);
			// ALMACEN 
			
			// COSTEO DEL PRODUCTO
			$costoAct = (double)$detalleB[1] * (double)$detalleB[2];

			$queryz = ("UPDATE productos set costo=costo+".$costoAct." where id_producto = '".$detalleB[0]."';");
			$rowz = $omodelo->_insertar($queryz);
			// ----------------------------------------------------------------------------------------------------
			
			$query5 = ("SELECT * FROM detalle_productos where producto = '".$detalleB[0]."' and sucursal='".$sucursal."' ;");	// ::::::::::::::: MODIFICAR EL QUERY
			$row5 = $omodelo->_consultar($query5);
			
			//$existencia3 = (double)$row5[0]['cantidad'] - $existencia2;
			$existencia = (double)$detalleB[1] + $row5[0]['cantidad'];
			
			$query6 = ("UPDATE detalle_productos set cantidad='".$existencia."' where id_detalle='".$row5[0]['id_detalle']."';");	// ::::::::::::::: MODIFICAR EL QUERY
			$row6 = $omodelo->_insertar($query6);
		}
		
		if($estatus != 'Pagado'){
			$query4 = ("SELECT * FROM proveedores where id_proveedor = '".$proveedor."';");	// ::::::::::::::: MODIFICAR EL QUERY
			$row4 = $omodelo->_consultar($query4);

			$diasb = (int)$dias - 5;
			$fechaNot = date('Y-m-d',strtotime('+'.$diasb.' days', strtotime($fechaB)));
			$query3 = ("UPDATE notificaciones SET descripcion='Pagar la nota <strong>".$folio."</strong> del proveedor ".$row4[0]['nombre']."',fecha='$fechaNot' where modulo='Compras' and id_modulo='$idR';");
			$error3 = $omodelo->_insertar($query3);
		}
		
		if ($error == "si") {
			$mensaje = "Error de Modificaci&oacute;n"; 
		}else{
			$mensaje = "La compra se modifico con &eacute;xito";
		}
		echo $mensaje."#".$error;
	}

	public function _eliminar(){
		$omodelo = new m_modelo();
		extract($_POST);
		
		$query = ("DELETE FROM compras WHERE id_compra = '$idElimina';");
		$error = $omodelo->_insertar($query);
		
		$query7 = ("SELECT * FROM detalle_compras where compra = '$idElimina';");	// ::::::::::::::: MODIFICAR EL QUERY
		$row7 = $omodelo->_consultar($query7);
		$numerofilas7 = $omodelo->numerofilas;
		$existencia4 = 0;
		for($x=0;$x<$numerofilas7;$x++){
			$query9 = ("SELECT * FROM  detalle_productos where producto = '".$row7[$x]['producto']."' and sucursal='".$row7[$x]['sucursal']."' ;");	// ::::::::::::::: MODIFICAR EL QUERY
			$row9 = $omodelo->_consultar($query9);
			
			$queryg = ("SELECT sum(cantidad) as promedio FROM detalle_productos where producto = '".$row7[$x]['producto']."';");	// ::::::::::::::: MODIFICAR EL QUERY
			$rowg = $omodelo->_consultar($queryg);
			
			$querys = ("SELECT * FROM productos where id_producto = '".$row7[$x]['producto']."';");
			$rows = $omodelo->_consultar($querys);
			$costo=(double)$rows[0]['costo']/(double)$rowg[0]['promedio'];
			$costoMenos = (double)$costo * (double)$row7[$x]['cantidad'];
			$costoActual = (double)$rows[0]['costo'] - $costoMenos;
			
			$queryj = ("UPDATE productos set costo=".$costoActual." where id_producto = '".$row7[$x]['producto']."';");
			$rowj = $omodelo->_insertar($queryj);
			
			$existencia4 = (double)$row9[0]['cantidad'] - (double)$row7[$x]['cantidad'];	
			
			$query8 = ("UPDATE detalle_productos set cantidad='".$existencia4."' where id_detalle = '".$row9[0]['id_detalle']."';");	// ::::::::::::::: MODIFICAR EL QUERY
			$row8 = $omodelo->_insertar($query8);
		}
		
			$query3 = ("DELETE FROM detalle_compras where compra = '$idElimina';");
			$error3 = $omodelo->_insertar($query3);
		
		if ($error == "si") {
			$mensaje = "Error al eliminar la compra";
		}else{
			$mensaje = "Compra eliminada";			
		}
		echo $mensaje."#".$error;
	}

	public function _reporte(){
		$omodelo = new m_modelo();
		extract($_POST);
		$fechaactual = date("Y-m-d");
		$query = ("SELECT * FROM compras where clase = '1';");
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
									<th id="thprimero" style="border-radius: 5px 0 0;border-right: 1px solid #E5DDDD;">Folio</th>
									<th style="border-right: 1px solid #E5DDDD;">Fecha</th>
									<th style="border-right: 1px solid #E5DDDD;">Vencimiento</th>
									<th style="border-right: 1px solid #E5DDDD;">Proveedor</th>
									<th style="border-right: 1px solid #E5DDDD;">Usuario</th>
									<th style="border-right: 1px solid #E5DDDD;">Total</th>
									<th style="border-right: 1px solid #E5DDDD;">Estatus</th>
									<th style="border-right: 1px solid #E5DDDD;">Detalles</th>
									<th style="border-radius: 0 5px 0 0;border-right: 1px solid #E5DDDD;">Acci&oacute;n</th>
								</tr>
							</thead>
							<tbody id="imprimirTb" align="center" width="100%">'; 
			$detalle = "";
			for($i=0;$i<$numerofilas;$i++){
				$detalles = "";
				$query2 = ("SELECT * FROM proveedores where id_proveedor = '".$row[$i]["proveedor"]."';");
				$row2 = $omodelo->_consultar($query2);

				$query3 = ("SELECT * FROM usuarios where id_usuario = '".$row[$i]["usuario"]."';");
				$row3 = $omodelo->_consultar($query3);
				
				$query4 = ("SELECT * FROM detalle_compras where compra = '".$row[$i]["id_compra"]."';");
				$row4 = $omodelo->_consultar($query4);
				$filasDetalle = $omodelo->numerofilas;
				for($j=0;$j<$filasDetalle;$j++){
					$query5 = ("SELECT * FROM productos where id_producto = '".$row4[$j]["producto"]."';");
					$row5 = $omodelo->_consultar($query5);
					$detalles .='
						<tr>
							<td>'.$row5[0]['nombre'].'</td>
							<td>'.$row4[$j]['cantidad'].'</td>
							<td class="dinero">'.$row4[$j]['subtotal'].'</td>
						</tr>
							
					';
				}
				
				$detalle .= '
				<div id="ventaPermisos'.$i.'" class="modal fade" tabindex="-1">
					<div class="modal-header bg-inverse bd-inverse-darken">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
						<h4 class="modal-title">Detalles de la compra: <strong>'.$row[$i]["folio"].'</strong></h4>
					</div>
					<div class="modal-body">
						
						<div id="noImprime">
							<div class="table-responsive">
								<table cellpadding="0" style="color:black" cellspacing="0" border="0" class="table table-bordered table-striped table-hover">
									<thead id="imprimirTh" width="100%">
										<tr class="expandible">
											<th id="thprimero" style="border-radius: 5px 0 0;border-right: 1px solid #E5DDDD;">Producto</th>
											<th style="border-right: 1px solid #E5DDDD;">Cantidad</th>
											<th style="border-radius: 0 5px 0 0;border-right: 1px solid #E5DDDD;">Subtotal</th>
										</tr>
									</thead>
									<tbody id="imprimirTb" align="center" width="100%">
										'.$detalles.'
									</tbody>
								</table>
							</div>
						</div>						
					</div>
				</div>
				';
				if($row[$i]["estatus"] == "Pagado"){
					$estat = '<span class="label label-success">Pagada</span>';
				}
				if($row[$i]["estatus"] == "Sin pagar"){
					$fecha = date("Y-m-d",strtotime($row[$i]["fecha"]));
					$queryc = "SELECT TIMESTAMPDIFF(DAY,'$fecha','$fechaactual') as 'fecDia';";
					$rowc = $omodelo->_consultar($queryc);
					$dife = (int)$row[$i]["dias_pagar"] - (int)$rowc[0]['fecDia'];
					if($dife < 1){
						$estat = '<span class="label label-danger">Vencida</span>';
					}else{
						$estat = '<span class="label label-primary">Sin pagar</span>';
					}
				}
				$fechaLimite = date('d-m-Y',strtotime('+'.$row[$i]['dias_pagar'].' days', strtotime($row[$i]['fecha'])));
				$ver = '<button type="button" class="ventaPermisos btn btn-theme-inverse btn-info" data-effect="md-flipHor" data-target="'.$i.'" ><i class="fa fa-eye"></i>Ver detalles</button>';
				$lista2 .= '										
								<tr>
									<td class="expandible0">'.$row[$i]["folio"].'</td>
									<td class="expandible1">'.date("d-m-Y",strtotime($row[$i]["fecha"])).'</td>
									<td class="expandible2">'.$fechaLimite.'</td>
									<td class="expandible3">'.$row2[0]['nombre'].'</td>
									<td class="expandible4">'.$row3[0]["nombre"].'</td>									
									<td class="expandible5 dinero">'.$row[$i]["total"].'</td>							
									<td class="expandible6">'.$estat.'</td>
									<td class="expandible7 tablaPermisos">'.$ver.'</td>
									<td class="expandible8" style="border-right:0">
										<span class="tooltip-area">
											<button id="mod-'.$row[$i]["id_compra"].'" type="button" class="btn btn-theme-inverse btn-info ventaModificar" data-effect="md-flipHor" data-target="0"><i class="fa fa-pencil-square-o"></i></button>
											<button id="eli-'.$row[$i]["id_compra"].'" type="button" class="btn btn-danger btn-danger ventaEliminar" data-effect="md-flipHor" data-target="0"><i class="fa fa-trash-o"></i></button>
										</span>
									</td>
								</tr>';
			}			
		}
		$lista3 = '</tbody>
						</table>
						</div>';
		$lista = $lista1.$lista2.$lista3.$detalle;
		//return utf8_encode($lista);
		return utf8_encode($lista);
		//<td>'.$permisosBD.'</td>
	}		
	
	public function _consulta(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM compras where clase = '1';");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			 for($i=0;$i<$numerofilas;$i++){

				$a[] = $numerofilas;						// 0
				$a[] = "11";								// 1
				$a[] = $row[$i]["id_compra"];				// 2
				$a[] = $row[$i]["fecha"];					// 3
				$a[] = $row[$i]["usuario"];					// 4
				$a[] = $row[$i]["proveedor"];				// 5
				$a[] = $row[$i]["total"];					// 6
				$a[] = $row[$i]["estatus"];					// 7
				
				$detalle = "";
				$query1 = ("SELECT * FROM detalle_compras where compra = '".$row[$i]["id_compra"]."';");
				$row1 = $omodelo->_consultar($query1);
				$numerofilas1 = $omodelo->numerofilas;
				for($o=0;$o<$numerofilas1;$o++){
					$query2 = ("SELECT * FROM productos where id_producto = '".$row1[$o]['producto']."';");
					$row2 = $omodelo->_consultar($query2);
					$detalle .= $numerofilas1."#";				// 0
					$detalle .= $row1[$o]['id_detalle']."#";	// 1
					$detalle .= $row1[$o]['compra']."#";		// 2
					$detalle .= $row1[$o]['producto']."#";		// 3
					$detalle .= $row1[$o]['cantidad']."#";		// 4
					$detalle .= $row1[$o]['subtotal']."#";		// 5
					$detalle .= $row2[0]['nombre']."#";			// 6
					$detalle .= $row1[$o]['sucursal']."#";		// 7
					$detalle .= $row2[0]['foto']."#";			// 8
				}
				$a[] = $detalle;							// 8
				$a[] = $row[$i]["folio"];					// 9
				$a[] = $row[$i]["dias_pagar"];				// 10
			 }
		}
		foreach($a as $name){
			echo utf8_encode($name . "~");
		}
	}

	public function _consultaValidar($campo,$valo){
		$omodelo = new m_modelo();
		$query = ("SELECT * FROM compras where ".$campo." = '".$valo."';");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		echo $numerofilas;
	}	
	
}
?>
