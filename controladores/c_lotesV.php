<?php
class lotesV {
	
	public function _insertar(){
		date_default_timezone_set('America/Mexico_City');
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("insert into lotes (id_lote,codigo,fecha_inicio,fecha_final,producto,cantidad,sucursal,estatus) VALUES 
		(null, '$folio', '$fechabb', '$fechabbF', '$producto', '$cantidad', '$sucursal', '$estatus');");
		$error = $omodelo->_insertar($query);
		
		$query1 = ("SELECT * FROM lotes order by id_lote desc limit 1;");	// ::::::::::::::: MODIFICAR EL QUERY
		$row1 = $omodelo->_consultar($query1);
		$existencia2 = $existencia = 0;
		
		if($estatus == "Terminado"){
			$query4 = ("SELECT * FROM detalle_productos where producto = '".$producto."' and sucursal='".$sucursal."' ;");
			$row4 = $omodelo->_consultar($query4);
			$numerofilas4 = $omodelo->numerofilas;
			if($numerofilas4 > 0){
				$existencia2 = (double)$row4[0]['cantidad'] + (double)$cantidad;
			
				$query3 = ("UPDATE detalle_productos set cantidad='".$existencia2."' where id_detalle = '".$row4[0]['id_detalle']."';");
				$query3 = $omodelo->_insertar($query3);
			}else{
				$query3 = ("INSERT INTO detalle_productos (id_detalle,producto,sucursal,cantidad) values(null,'".$producto."','".$sucursal."','".$cantidad."');");	// ::::::::::::::: MODIFICAR EL QUERY
				$query3 = $omodelo->_insertar($query3);
			}

			$query8 = ("UPDATE productos set costo=costo+".$totalP." where id_producto = '".$producto."';");
			$query8 = $omodelo->_insertar($query8);
		}
		
		$detalle = explode("#",$detalles);
		for($y=0;$y<count($detalle);$y++){
			$detalleB = explode("~",$detalle[$y]);
			$query2 = ("INSERT INTO detalle_lotes (id_detalle,lote,producto,cantidad,costo,sucursal)
			values(null,'".$row1[0]['id_lote']."','".$detalleB[0]."','".$detalleB[1]."','".$detalleB[4]."','".$detalleB[2]."');");
			$row2 = $omodelo->_insertar($query2);
			//if($estatus == "Terminado"){
				$query5 = ("SELECT * FROM detalle_productos where producto = '".$detalleB[0]."' and sucursal='".$detalleB[2]."' ;");
				$row5 = $omodelo->_consultar($query5);
				$existencia = 0;
				if($row5[0]['cantidad'] > 0){
					$existencia = (double)$row5[0]['cantidad'] - (double)$detalleB[1];
				}
				$query6 = ("UPDATE detalle_productos set cantidad='".$existencia."' where id_detalle = '".$row5[0]['id_detalle']."';");
				$row6 = $omodelo->_insertar($query6);
				$query9 = ("UPDATE productos set costo=costo-".$detalleB[2]." where id_producto = '".$detalleB[0]."';");
				$query9 = $omodelo->_insertar($query9);
			//}
		}
		if ($error == "si") {
			$mensaje = "Error de registro";
		}else{
			$mensaje = "Lote de producto registrado";
		}
		echo $mensaje."#".$error;
	}

	public function _modificar(){
		date_default_timezone_set('America/Mexico_City');
		$omodelo = new m_modelo();
		extract($_POST);

		// 	DESCONTAR PRODUCTO(venta) DEL INVENTARIO 
		$queryD = ("SELECT * FROM lotes where id_lote = '$idR';");	
		$rowD = $omodelo->_consultar($queryD);
		$numerofilasD = $omodelo->numerofilas;
		if($estatus == "Terminado"){

			for($D=0;$D<$numerofilasD;$D++){
				$queryg = ("SELECT sum(cantidad) as promedio FROM detalle_productos where producto = '".$rowD[$D]['producto']."';");	// ::::::::::::::: MODIFICAR EL QUERY
				$rowg = $omodelo->_consultar($queryg);

				$querys = ("SELECT * FROM productos where id_producto = '".$rowD[$D]['producto']."';");
				$rows = $omodelo->_consultar($querys);
				$costo=(double)$rows[0]['costo']/(double)$rowg[0]['promedio'];
				$costoMenos = (double)$costo * (double)$rowD[$D]['cantidad'];
				$costoActual = (double)$rows[0]['costo'] - (double)$costoMenos;

				$queryj = ("UPDATE productos set costo=".$costoActual." where id_producto = '".$rowD[$D]['producto']."';");
				$rowj = $omodelo->_insertar($queryj);

				$queryp = ("SELECT * FROM  detalle_productos where producto = '".$rowD[$D]['producto']."' and sucursal='".$rowD[$D]['sucursal']."' ;");	// ::::::::::::::: MODIFICAR EL QUERY
				$rowp = $omodelo->_consultar($queryp);
				$existenciap = 0;
				if($rowp[0]['cantidad'] > 0){
					$existenciap = (double)$rowp[0]['cantidad'] - (double)$rowD[$D]['cantidad'];	
				}

				$query8 = ("UPDATE detalle_productos SET cantidad='".$existenciap."' where id_detalle = '".$rowp[0]['id_detalle']."';");	// ::::::::::::::: MODIFICAR EL QUERY
				$row8 = $omodelo->_insertar($query8);
			}

			//	 SUMAR PRODUCTOS DE MATERIA PRIMA AL INVENTARIO
			$query7 = ("SELECT * FROM detalle_lotes where lote = '$idR';");
			$row7 = $omodelo->_consultar($query7);
			$numerofilas7 = $omodelo->numerofilas;
			$existencia4 = 0;
			for($x=0;$x<$numerofilas7;$x++){
				$query9 = ("SELECT * FROM  detalle_productos where producto = '".$row7[$x]['producto']."' and sucursal='".$row7[$x]['sucursal']."' ;");	// ::::::::::::::: MODIFICAR EL QUERY
				$row9 = $omodelo->_consultar($query9);
				$existencia4 = (double)$row9[0]['cantidad'] + (double)$row7[$x]['cantidad'];	

				$queryz = ("UPDATE detalle_productos SET cantidad='".$existencia4."' where id_detalle = '".$row9[0]['id_detalle']."';");	// ::::::::::::::: MODIFICAR EL QUERY
				$rowz = $omodelo->_insertar($queryz);

				$queryy = ("UPDATE productos set costo=costo+".$row7[$x]['costo']." where id_producto = '".$row7[$x]['producto']."';");
				$queryy = $omodelo->_insertar($queryy);
			}

//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::.

			$querya4 = ("SELECT * FROM detalle_productos where producto = '".$producto."' and sucursal='".$sucursal."' ;");
			$rowa4 = $omodelo->_consultar($querya4);
			$numerofilasa4 = $omodelo->numerofilas;
			if($numerofilasa4 > 0){
				$existenciaa2 = (double)$rowa4[0]['cantidad'] + (double)$cantidad;

				$query3 = ("UPDATE detalle_productos set cantidad='".$existenciaa2."' where id_detalle = '".$rowa4[0]['id_detalle']."';");
				$query3 = $omodelo->_insertar($query3);
			}else{
				$query3 = ("INSERT INTO detalle_productos (id_detalle,producto,sucursal,cantidad) values(null,'".$producto."','".$sucursal."','".$cantidad."');");	// ::::::::::::::: MODIFICAR EL QUERY
				$query3 = $omodelo->_insertar($query3);
			}

			$queryb8 = ("UPDATE productos set costo=costo+".$totalP." where id_producto = '".$producto."';");
			$queryb8 = $omodelo->_insertar($queryb8);
		}

		$queryb = ("UPDATE lotes SET codigo='$folio',fecha_inicio='".$fechabb."',fecha_final='$fechabbF',producto='$producto',cantidad='$cantidad',sucursal='$sucursal',estatus='$estatus' where id_lote =  '$idR';");
		$errorb = $omodelo->_insertar($queryb);

		// SE SUMAN LOS PRODUCTOS DE MATERIA PRIMA QUE NO SE UTILIZARAN.
		$query5v = ("SELECT * FROM detalle_lotes where lote = '".$idR."';");
		$row5v = $omodelo->_consultar($query5v);
		$numerofilas5v = $omodelo->numerofilas;
		for($v=0;$v<$numerofilas5v;$v++){
			$query5c = ("SELECT * FROM detalle_productos where producto = '".$row5v[$v]['producto']."' and sucursal='".$row5v[$v]['sucursal']."' ;");
			$row5c = $omodelo->_consultar($query5c);
			$existenciac = (double)$row5c[0]['cantidad'] + (double)$row5v[$v]['cantidad'];
			$query6c = ("UPDATE detalle_productos set cantidad='".$existenciac."' where id_detalle = '".$row5c[0]['detalle']."';");
			$row6c = $omodelo->_insertar($query6c);
			$query9c = ("UPDATE productos set costo=costo+".$row5v[$v]['costo']." where id_producto = '".$row5v[$v]['producto']."';");
			$query9c = $omodelo->_insertar($query9c);
		}

		$queryb1 = ("DELETE FROM detalle_lotes where lote = '$idR';");
		$rowb1 = $omodelo->_insertar($queryb1);

	//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::.

		$detalle = explode("#",$detalles);
		for($y=0;$y<count($detalle);$y++){
			$detalleB = explode("~",$detalle[$y]);
			$query2 = ("INSERT INTO detalle_lotes (id_detalle,lote,producto,cantidad,costo,sucursal)
			values(null,'".$idR."','".$detalleB[0]."','".$detalleB[1]."','".$detalleB[4]."','".$detalleB[2]."');");
			$row2 = $omodelo->_insertar($query2);
			//if($estatus == "Terminado"){
				$query5 = ("SELECT * FROM detalle_productos where producto = '".$detalleB[0]."' and sucursal='".$detalleB[2]."' ;");
				$row5 = $omodelo->_consultar($query5);
				$existencia = (double)$row5[0]['cantidad'] - (double)$detalleB[1];
				$query6 = ("UPDATE detalle_productos set cantidad='".$existencia."' where id_detalle = '".$row5[0]['id_detalle']."';");
				$row6 = $omodelo->_insertar($query6);
				$query9 = ("UPDATE productos set costo=costo-".$detalleB[2]." where id_producto = '".$detalleB[0]."';");
				$query9 = $omodelo->_insertar($query9);
			//}
		}
		if ($error == "si") {
			$mensaje = "Error de Modificaci&oacute;n"; 
		}else{
			$mensaje = "El lote se modifico con &eacute;xito";
		}
		echo $mensaje."#".$error;
	}

	public function _eliminar(){
		$omodelo = new m_modelo();
		extract($_POST);

		// 	DESCONTAR PRODUCTO(venta) DEL INVENTARIO 
		$queryD = ("SELECT * FROM lotes where id_lote = '$idElimina';");
		$rowD = $omodelo->_consultar($queryD);
		$numerofilasD = $omodelo->numerofilas;
		for($D=0;$D<$numerofilasD;$D++){
			$queryg = ("SELECT sum(cantidad) as promedio FROM detalle_productos where producto = '".$rowD[$D]['producto']."';");	// ::::::::::::::: MODIFICAR EL QUERY
			$rowg = $omodelo->_consultar($queryg);
			
			$querys = ("SELECT * FROM productos where id_producto = '".$rowD[$D]['producto']."';");
			$rows = $omodelo->_consultar($querys);
			$costo=(double)$rows[0]['costo']/(double)$rowg[0]['promedio'];
			$costoMenos = (double)$costo * (double)$rowD[$D]['cantidad'];
			$costoActual = (double)$rows[0]['costo'] - (double)$costoMenos;
			
			$queryj = ("UPDATE productos set costo=".$costoActual." where id_producto = '".$rowD[$D]['producto']."';");
			$rowj = $omodelo->_insertar($queryj);

			$query8 = ("UPDATE detalle_productos SET cantidad=cantidad-".(double)$rowD[$D]['cantidad']." where producto = '".$rowD[$D]['producto']."' and sucursal='".$rowD[$D]['sucursal']."';");	// ::::::::::::::: MODIFICAR EL QUERY
			$row8 = $omodelo->_insertar($query8);
		}
		
		//	 SUMAR PRODUCTOS DE MATERIA PRIMA AL INVENTARIO
		$query7 = ("SELECT * FROM detalle_lotes where lote = '$idElimina';");
		$row7 = $omodelo->_consultar($query7);
		$numerofilas7 = $omodelo->numerofilas;
		$existencia4 = 0;
		for($x=0;$x<$numerofilas7;$x++){

			$queryz = ("UPDATE detalle_productos SET cantidad=cantidad+".(double)$row7[$x]['cantidad']." where producto = '".$row7[$x]['producto']."' and sucursal='".$row7[$x]['sucursal']."';");	// ::::::::::::::: MODIFICAR EL QUERY
			$rowz = $omodelo->_insertar($queryz);
			
			$queryy = ("UPDATE productos set costo=costo+".$row7[$x]['costo']." where id_producto = '".$row7[$x]['producto']."';");
			$queryy = $omodelo->_insertar($queryy);
		}

		$query3 = ("DELETE FROM detalle_lotes where lote = '$idElimina';");
		$error3 = $omodelo->_insertar($query3);
			
		$query = ("DELETE FROM lotes WHERE id_lote = '$idElimina';");
		$error = $omodelo->_insertar($query);
		
		if ($error == "si") {
			$mensaje = "Error al eliminar el lote";
		}else{
			$mensaje = "Lote eliminado";			
		}
		echo $mensaje."#".$error;
	}

	public function _modificarEstatus(){
		extract($_POST);
		$omodelo = new m_modelo();
		$query = ("SELECT * FROM lotes where id_lote = '".$id."';");
		$row = $omodelo->_consultar($query);
		$fecha = date("Y-m-d");
		if($estatus == 'En proceso'){
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::.
			$querya4 = ("SELECT * FROM detalle_productos where producto = '".$row[0]['producto']."' and sucursal='".$row[0]['sucursal']."' ;");
			$rowa4 = $omodelo->_consultar($querya4);
			$numerofilasa4 = $omodelo->numerofilas;
			if($numerofilasa4 > 0){
				$existenciaa2 = (double)$rowa4[0]['cantidad'] + (double)$row[0]['cantidad'];

				$query3 = ("UPDATE detalle_productos set cantidad='".$existenciaa2."' where id_detalle = '".$rowa4[0]['id_detalle']."';");
				$query3 = $omodelo->_insertar($query3);
			}else{
				$query3 = ("INSERT INTO detalle_productos (id_detalle,producto,sucursal,cantidad) values(null,'".$row[0]['producto']."','".$row[0]['sucursal']."','".$row[0]['cantidad']."');");	// ::::::::::::::: MODIFICAR EL QUERY
				$query3 = $omodelo->_insertar($query3);
			}
			
			$querya = ("SELECT SUM(costo) as costo FROM detalle_lotes where lote = '".$id."';");
			$rowa = $omodelo->_consultar($querya);

			$queryb8 = ("UPDATE productos set costo=costo+".(double)$rowa[0]['costo']." where id_producto = '".$row[0]['producto']."';");
			$queryb8 = $omodelo->_insertar($queryb8);
			
			$queryb = ("UPDATE lotes set estatus='Terminado', fecha_final='".$fechaF."' where id_lote = '".$id."';");
			$queryb = $omodelo->_insertar($queryb);
		}else{
			//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::.
			$querya4 = ("SELECT * FROM detalle_productos where producto = '".$row[0]['producto']."' and sucursal='".$row[0]['sucursal']."' ;");
			$rowa4 = $omodelo->_consultar($querya4);
			$existenciaa2 = 0;
			if($rowa4[0]['cantidad'] > 0){
				$existenciaa2 = (double)$rowa4[0]['cantidad'] - (double)$row[0]['cantidad'];
			}

			$query3 = ("UPDATE detalle_productos set cantidad='".$existenciaa2."' where id_detalle = '".$rowa4[0]['id_detalle']."';");
			$query3 = $omodelo->_insertar($query3);
			
			$querya = ("SELECT SUM(costo) as costo FROM detalle_lotes where lote = '".$id."';");
			$rowa = $omodelo->_consultar($querya);

			$queryb8 = ("UPDATE productos set costo=costo-".(double)$rowa[0]['costo']." where id_producto = '".$row[0]['producto']."';");
			$queryb8 = $omodelo->_insertar($queryb8);
			
			$queryb = ("UPDATE lotes set estatus='En proceso', fecha_final='".$fecha."' where id_lote = '".$id."';");
			$queryb = $omodelo->_insertar($queryb);
		}
		if ($queryb == "si") {
			$mensaje = "Error de Modificación"; 
		}else{
			$mensaje = "El lote se modifico con éxito";
		}
		echo $mensaje."#".$queryb;
	}

	public function _reporte(){
		$omodelo = new m_modelo();
		extract($_POST);
		$fechaactual = date("Y-m-d");
		$query = ("SELECT * FROM lotes;");
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			
			$lista1 = '<div id="noImprime">
						<div class="col-md-12 table-responsive" width="100%" style="overflow-x:auto;">
						<table width="100%" style="color:black" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover" id="tablaUsuarios">
							<thead id="imprimirTh" width="100%">
								<tr class="expandible">
									<th id="thprimero" style="border-radius: 5px 0 0;border-right: 1px solid #E5DDDD;">Folio</th>
									<th style="border-right: 1px solid #E5DDDD;">Producto</th>
									<th style="border-right: 1px solid #E5DDDD;">Fecha inicial</th>
									<th style="border-right: 1px solid #E5DDDD;">Fecha final</th>
									<th style="border-right: 1px solid #E5DDDD;">Cantidad</th>
									<th style="border-right: 1px solid #E5DDDD;">Costo</th>
									<th style="border-right: 1px solid #E5DDDD;">Sucursal</th>
									<th style="border-right: 1px solid #E5DDDD;">Estatus</th>
									<th style="border-right: 1px solid #E5DDDD;">Materia prima</th>
									<th style="border-radius: 0 5px 0 0;border-right: 1px solid #E5DDDD;">Acci&oacute;n</th>
								</tr>
							</thead>
							<tbody id="imprimirTb" align="center" width="100%">'; 
			$detalle = "";
			$costoDet = 0;
			for($i=0;$i<$numerofilas;$i++){
				$detalles = "";

				$query4 = ("SELECT * FROM detalle_lotes where lote = '".$row[$i]["id_lote"]."';");
				$row4 = $omodelo->_consultar($query4);
				$filasDetalle = $omodelo->numerofilas;
				for($j=0;$j<$filasDetalle;$j++){
					$query5 = ("SELECT * FROM productos where id_producto = '".$row4[$j]["producto"]."';");
					$row5 = $omodelo->_consultar($query5);
					$detalles .='
						<tr>
							<td>'.$row5[0]['nombre'].'</td>
							<td>'.$row4[$j]['cantidad'].' '.$row5[0]['medida'].'</td>
							<td class="dinero">'.$row4[$j]['costo'].'</td>
						</tr>
					';
					$costoDet = $costoDet + (double)$row4[$j]["costo"];
				}
				
				$detalle .= '
				<div id="ventaPermisos'.$i.'" class="modal fade" tabindex="-1">
					<div class="modal-header bg-inverse bd-inverse-darken">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
						<h4 class="modal-title">Detalles del lote: <strong>'.$row[$i]["codigo"].'</strong></h4>
					</div>
					<div class="modal-body">
						
						<div id="noImprime">
							<div class="table-responsive">
								<table cellpadding="0" style="color:black" cellspacing="0" border="0" class="table table-bordered table-striped table-hover">
									<thead id="imprimirTh" width="100%">
										<tr class="expandible">
											<th id="thprimero" style="border-radius: 5px 0 0;border-right: 1px solid #E5DDDD;">Producto</th>
											<th style="border-right: 1px solid #E5DDDD;">Cantidad</th>
											<th style="border-radius: 0 5px 0 0;border-right: 1px solid #E5DDDD;">Costo</th>
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
				$ver = '<button style="height: 30px;" type="button" class="ventaPermisos btn btn-theme-inverse btn-info" data-effect="md-flipHor" data-target="'.$i.'" ><i class="fa fa-eye"></i>Ver detalles</button>';
				$estatus = '<button data-target="0" id="estatLote-'.$row[$i]["id_lote"].'" type="button" class="btn btn-primary estatLoteb" style="height: 30px;width: 85px;padding: 3px;font-size: 12px;"><span class="glyphicon glyphicon-cog"></span><span id="textoEstaus-'.$row[$i]["id_lote"].'"> &nbsp;En proceso</span></button><input type="hidden" id="estatusv-'.$row[$i]["id_lote"].'" name="estatus" value="En proceso">';
				if($row[$i]["estatus"] == "Terminado"){
					$estatus = '<button data-target="0" id="estatLote-'.$row[$i]["id_lote"].'" type="button" class="btn btn-success estatLoteb" style="height: 30px;width: 85px;padding: 3px;font-size: 12px;"><span class="glyphicon glyphicon-ok"></span><span id="textoEstaus-'.$row[$i]["id_lote"].'"> &nbsp;Terminado</span></button><input type="hidden" id="estatusv-'.$row[$i]["id_lote"].'" name="estatus" value="Terminado">';
				}
				$querya = ("SELECT * FROM productos where id_producto = '".$row[$i]["producto"]."';");
				$rowa = $omodelo->_consultar($querya);
				$laFoto = 'archivos/fotosProductos/'.$rowa[0]["foto"].'';
				if($rowa[0]["foto"] == ""){
					$laFoto = 'vistas/images/picture.png';
				}

				$queryc = ("SELECT * FROM sucursales where id_sucursal = '".$row[$i]["sucursal"]."';");
				$rowc = $omodelo->_consultar($queryc);
				$costoUn = (double)$costoDet / (double)$row[$i]["cantidad"];
				$lista2 .= '
								<tr>
									<td class="expandible0">'.$row[$i]["codigo"].'</td>
									<td class=""><a href="'.$laFoto.'" title="'.$rowa[0]["nombre"].'" class="preview_fancybox"><img id="fot'.$row[$i]["id_lote"].'" alt="" style="width:50px" src="'.$laFoto.'" class=""/></a><br><span style="font-size:11px">'.$rowa[0]["nombre"].'</span><br><label style="font-size:11px">Precio: &nbsp;</label><b class="dinero" style="font-size:11px">'.$rowa[0]["precio"].'</b></td>
									<td class="">'.date("d-m-Y",strtotime($row[$i]["fecha_inicio"])).'</td>
									<td class="">'.date("d-m-Y",strtotime($row[$i]["fecha_final"])).'</td>													
									<td class="">'.$row[$i]["cantidad"].' '.$rowa[0]["medida"].'</td>
									<td style="text-align:left"><label>Por pieza: &nbsp;</label><b class="dinero">'.$costoUn.'</b><br><label>Total: &nbsp;</label><b class="dinero">'.$costoDet.'</b></td>									
									<td class="">'.$rowc[0]["nombre"].'</td>
									<td class="">'.$estatus.'</td>
									<td class=" tablaPermisos">'.$ver.'</td>
									<td class="" style="border-right:0">
										<span class="tooltip-area">
											<button id="mod-'.$row[$i]["id_lote"].'" type="button" class="btn btn-theme-inverse btn-info ventaModificar" data-effect="md-flipHor" data-target="0"><i class="fa fa-pencil-square-o"></i></button>
											<button id="eli-'.$row[$i]["id_lote"].'" type="button" class="btn btn-danger btn-danger ventaEliminar" data-effect="md-flipHor" data-target="0"><i class="fa fa-trash-o"></i></button>
										</span>
									</td>
								</tr>';
			}			
		}
		$lista3 = '</tbody>
						</table>
						</div></div>';
		$lista = $lista1.$lista2.$lista3.$detalle;
		return $lista;
		//return utf8_encode($lista);
		//<td>'.$permisosBD.'</td>
	}		

	public function _consulta(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM lotes;");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			for($i=0;$i<$numerofilas;$i++){

				$a[] = $numerofilas;					// 0
				$a[] = "11";							// 1
				$a[] = $row[$i]["id_lote"];				// 2
				$a[] = $row[$i]["codigo"];				// 3
				$a[] = $row[$i]["fecha_inicio"];		// 4
				$a[] = $row[$i]["fecha_final"];			// 5
				$a[] = $row[$i]["producto"];			// 6
				$a[] = $row[$i]["cantidad"];			// 7
				$a[] = $row[$i]["sucursal"];			// 8
				
				$detalle = "";
				$query1 = ("SELECT * FROM detalle_lotes where lote = '".$row[$i]["id_lote"]."';");
				$row1 = $omodelo->_consultar($query1);
				$numerofilas1 = $omodelo->numerofilas;
				for($o=0;$o<$numerofilas1;$o++){
					$query2 = ("SELECT * FROM productos where id_producto = '".$row1[$o]['producto']."';");
					$row2 = $omodelo->_consultar($query2);
					$query3 = ("SELECT * FROM sucursales where id_sucursal = '".$row1[$o]['sucursal']."';");
					$row3 = $omodelo->_consultar($query3);
					$detalle .= $numerofilas1."#";				// 0
					$detalle .= $row1[$o]['id_detalle']."#";	// 1
					$detalle .= $row1[$o]['lote']."#";			// 2
					$detalle .= $row1[$o]['producto']."#";		// 3
					$detalle .= $row1[$o]['cantidad']."#";		// 4
					$detalle .= $row1[$o]['costo']."#";			// 5
					$detalle .= $row3[0]['nombre']."#";			// 6
					$detalle .= $row2[0]['foto']."#";			// 7
					$detalle .= $row2[0]['costo']."#";			// 8
					$detalle .= $row2[0]['nombre']."#";			// 9
					$detalle .= $row1[$o]['sucursal']."#";		// 10
					$detalle .= $row2[0]['medida']."#";			// 11
				}
				$a[] = $detalle;							// 9
				$a[] = $row[$i]["estatus"];					// 10
			}
		}
		foreach($a as $name){
			echo $name . "~";
		}
	}

	public function _consultaValidar($campo,$valo){
		$omodelo = new m_modelo();
		$query = ("SELECT * FROM lotes where ".$campo." = '".$valo."';");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		echo $numerofilas;
	}	
	
}
?>