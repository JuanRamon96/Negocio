<?php
class almacenV {
	
	public function _modificar(){
		//date_default_timezone_set('America/Mexico_City');
		$omodelo = new m_modelo();
		extract($_POST);
		
		$querya = ("SELECT * FROM detalle_productos where producto = '$idR' and sucursal = '$desucursal';");
		$row = $omodelo->_consultar($querya);
		$restar = (double)$row[0]['cantidad'] - (double)$cantidad;
		$query = ("UPDATE detalle_productos set cantidad='$restar' where producto = '$idR' and sucursal = '$desucursal';");
		$errora = $omodelo->_insertar($query);
		
		$queryc = ("SELECT * FROM detalle_productos where producto = '$idR' and sucursal = '$asucursal';");
		$rowc = $omodelo->_consultar($queryc);
		$filas = $omodelo->numerofilas;
		if($filas > 0){
			$sumar = (double)$rowc[0]['cantidad'] + (double)$cantidad;
			$queryb = ("UPDATE detalle_productos set cantidad='$sumar' where producto = '$idR' and sucursal = '$asucursal';");
			$error = $omodelo->_insertar($queryb);
		}else{
			$queryb = ("INSERT INTO detalle_productos(id_detalle,producto,sucursal,cantidad) values(null,'$idR','$asucursal','$cantidad');");
			$error = $omodelo->_insertar($queryb);
		}
		
		if ($error == "si") {
			$mensaje = "Error de Modificaci&oacute;n"; 
		}else{
			$mensaje = "El inventario se modifico con &eacute;xito";
		}
		echo $mensaje."#".$error;
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
						<div class="col-sm-12 table-responsive">
						<table style="width:100%; color:black;" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover" id="tablaUsuarios">
							<thead id="imprimirTh">
								<tr class="expandible">
									<th id="thprimero" style="border-radius: 5px 0 0;">Producto</th>
									<th>Nombre</th>
									<th>Cantidad</th>
									<th>Costo <small>c/u</small></th>
									<th>Total costo</th>
									<th>Precio <small>c/u</small></th>
									<th>Total precio</th>
									<th>Distribuci&oacute;n</th>
									<th style="border-radius: 0 5px 0 0;">Acci&oacute;n</th>
								</tr>
							</thead>
							<tbody id="imprimirTb" align="center">'; 
			$detalle = "";
			$lista2 = "";
			for($i=0;$i<$numerofilas;$i++){
				$cantids = 0;
				$detalles = "";
				$querya = ("SELECT * FROM detalle_productos where producto = '".$row[$i]["id_producto"]."';");
				$rowa = $omodelo->_consultar($querya);
				$numerofilasa = $omodelo->numerofilas;
				for($j=0;$j<$numerofilasa;$j++){
					$cantids = $cantids + (double)$rowa[$j]['cantidad'];
					
					$queryc = ("SELECT * FROM sucursales where id_sucursal = '".$rowa[$j]["sucursal"]."';");
					$rowc = $omodelo->_consultar($queryc);
					$detalles .='
						<tr>
							<td>'.$rowc[0]['nombre'].'</td>
							<td><b class="numeros">'.$rowa[$j]['cantidad'].'</b> '.$row[$i]["medida"].'</td>
						</tr>	
					';
				}
				/*$total = $totalPreci = 0;
				$queryb = ("SELECT * FROM detalle_compras where producto = '".$row[$i]["id_producto"]."';");
				$rowb = $omodelo->_consultar($queryb);
				$numerofilasb = $omodelo->numerofilas;
				for($k=0;$k<$numerofilasb;$k++){
					$multi = (double)$rowb[$k]['cantidad'] * (double)$rowb[$k]['subtotal'];
					$total = $total + $multi;
				}
				$promedio = 0;
				if($cantids != 0){
					$promedio = $total / $cantids;
				}*/
		
				$detalle .= '
				<div id="ventaPermisos'.$i.'" class="modal fade" tabindex="-1">
					<div class="modal-header bg-inverse bd-inverse-darken">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
						<h4 class="modal-title">Distribuci&oacute;n del producto: <strong>'.$row[$i]["nombre"].'</strong></h4>
					</div>
					<div class="modal-body">
						
						<div id="noImprime">
							<div class="table-responsive">
								<table cellpadding="0" style="color:black" cellspacing="0" border="0" class="table table-bordered table-striped table-hover">
									<thead id="imprimirTh" width="100%">
										<tr class="expandible">
											<th id="thprimero" style="border-radius: 5px 0 0;border-right: 1px solid #E5DDDD;">Producto</th>
											<th style="border-radius: 0 5px 0 0;border-right: 1px solid #E5DDDD;">Cantidad</th>
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
				$total = 0;
				$promedio = 0;
				if($cantids != 0){
					$promedio = (double)$row[$i]["costo"] / $cantids;
					$total = $cantids * $promedio;
				}
				$totalPreci = (double)$cantids * (double)$row[$i]['precio'];
				$totalCosto = $totalCosto + $total;
				$totalPrecio = $totalPrecio + $totalPreci;
				$laFoto = 'archivos/fotosProductos/'.$row[$i]["foto"].'';
				if($row[$i]["foto"] == ""){
					$laFoto = 'vistas/images/picture.png';
				}
				$ver = '<button type="button" class="ventaPermisos btn btn-theme-inverse btn-info" data-effect="md-flipHor" data-target="'.$i.'" ><i class="fa fa-eye"></i>Ver</button>';
				$lista2 .= '										
								<tr numeroSuma="2">
									<td class=""><a href="'.$laFoto.'" title="'.$row[$i]["nombre"].'" class="preview_fancybox"><img id="fot'.$row[$i]["id_producto"].'" style="width:50px" src="'.$laFoto.'" class=""/></a><br>'.$row[$i]["codigo"].'</td>
									<td>'.$row[$i]["nombre"].'</td>
									<td><b class="numeros">'.$cantids.'</b> '.$row[$i]["medida"].'</td>
									<td class="dinero">'.$promedio.'</td>
									<td class="dinero tbSuma0">'.$total.'</td>
									<td class="dinero">'.$row[$i]["precio"].'</td>
									<td class="dinero tbSuma1">'.$totalPreci.'</td>
									<td class="tablaPermisos">'.$ver.'</td>
									<td>
										<span class="tooltip-area">
											<button id="mod-'.$row[$i]["id_producto"].'" type="button" class="btn btn-theme-inverse btn-info ventaModificar" data-effect="md-flipHor" data-target="0"><i class="glyphicon glyphicon-transfer"></i></button>
										</span>
									</td>
								</tr>';
			}			
		}
		$lista4 = '<tfoot>									
				<tr>
					<td style="text-align:center"><b>Total</b></td>
					<td></td><td></td><td></td>
					<td style="text-align:center" class="dinero tfSuma0">'.$totalCosto.'</td>
					<td></td>
					<td style="text-align:center" class="dinero tfSuma1">'.$totalPrecio.'</td>
					<td></td><td></td>
				</tr>
				</tfoot>';
		
		$lista3 = '</tbody>'.$lista4.'
						</table>
						</div>';
		$lista = $lista1.$lista2.$lista3.$detalle;
		return utf8_encode($lista);
		//<td>'.$permisosBD.'</td>
	}		
	
	public function _consulta(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM productos where clase ='1';");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			
			 for($i=0;$i<$numerofilas;$i++){
				$a[] = $numerofilas;						// 0	
				$a[] = "8";									// 1	
				$a[] = $row[$i]["id_producto"];				// 2	0
				$a[] = $row[$i]["nombre"];					// 3	1		APLICA PARA SELECTS
				$a[] = $row[$i]["codigo"];					// 4	2
				$a[] = $row[$i]["costo"];					// 5	3
				$detalles = "";
				$querya = ("SELECT * FROM detalle_productos where producto ='".$row[$i]["id_producto"]."';");	// ::::::::::::::: MODIFICAR EL QUERY
				$rowa = $omodelo->_consultar($querya);
				$numerofilasa = $omodelo->numerofilas;
				for($j=0;$j<$numerofilasa;$j++){
					$detalles .= "6"."#";						// 0
					$detalles .= $numerofilasa."#";				// 1
					$detalles .= $rowa[$j]["id_detalle"]."#";	// 2
					$detalles .= $rowa[$j]["producto"]."#";		// 3
					$detalles .= $rowa[$j]["sucursal"]."#";		// 4
					$detalles .= $rowa[$j]["cantidad"]."#";		// 5
				}
				$a[] = $detalles;					// 6	4
				$a[] = $row[$i]["foto"];					// 7	5
			 }
		}
		foreach($a as $name){
			echo $name . "~";
		}
	}
	
}
?>
