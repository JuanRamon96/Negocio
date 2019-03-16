<?php
class costosR {										// ::::::::::::::: PONER NOMBRE DE CLASE IGUAL QUE EL MENU (solo minusculas)	

	public function _reportev(){
		$omodelo = new m_modelo();
		extract($_POST);
		// TIPO DE CAMBIO PARA SISTEMA LOCAL EN LA BARCA
		$divisa = 20.52;
		//$divisa = $this->_tiie();
		
		// SE CREAN LOS FILTROS DE FECHA Y CICLOS
		$queryh = ("SELECT * FROM axc_ciclos order by id_ciclo desc;");	// ::::::::::::::: MODIFICAR EL QUERY
		$rowh = $omodelo->_consultar($queryh);
		$elciclo = " AND ciclo = '".$rowh[0]['ciclo']."'";
		if(ISSET($filtroCiclo)){
			if($filtroCiclo == "Todos"){
				$elciclo = "";
			}else{
				$elciclo = " AND ciclo = '".$filtroCiclo."'";
			}
		}
		$elEstatus = "";
		if(ISSET($estatus)){
			if($estatus == ""){
				$elEstatus = "";
			}else{
				$elEstatusA = explode(",",$estatus);
				$estat = '';
				for($r=0;$r<count($elEstatusA);$r++){
					if($r==0){
						$estat = "'".$elEstatusA[$r]."'";
					}else{
						$estat = $estat.",'".$elEstatusA[$r]."'";
					}
					if($elEstatusA[$r] == "Liquidada"){
						$estat = $estat.",'Liquidada definitiva','Liquidada parcial'";
					}
				}
				$elEstatus = " AND status IN (".$estat.")";
			}
		}
		
		$query = ("SELECT * FROM axc_riesgos where estructura = 'Put' ".$elciclo.$elEstatus.";");
		//$query = ("SELECT * FROM axc_riesgos where id_riesgo = '262';");
		$row = $omodelo->_consultar($query);		// ::::::::::::::: MODIFICAR EL QUERY
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			$lista2 = "";
			// FILTRO DE FECHA	
			$fecaMes = date ( 'Y-m-j' , strtotime ( '-11 month' , strtotime ( date("Y-m-d") ) ) );
			$fechaMes = explode("-",$fecaMes);
			$rangoFecha =  " AND anio >= '".$fechaMes[0]."'";
			$anioInicial = $fechaMes[0];
			$anioFinal = date ('Y');
			$fI = $fecaMes;
			$fF = date("Y-m-d");
			$elMesActual = date('m')+1;
			$elMesActual = $elMesActual - 1;
			if(ISSET($filtro)){
				$filtro = explode("#",$filtro);
				$anioIni = explode("-",$filtro[0]);
				$anioFin = explode("-",$filtro[1]);
				$anioInicial = $anioIni[0];
				$anioFinal = $anioFin[0];
				$rangoFecha =  " AND anio BETWEEN '".$anioIni[0]."' AND '".$anioFin[0]."'";
				$fI = $filtro[0];
				$fF = $filtro[1];
				//$elMesActual = $anioIni[1]+1;
				$elMesActual = $anioIni[1];
				$elMesActual = $elMesActual - 1;
			}
			
			$meses = array(1,2,3,4,5,6,7,8,9,10,11,12);
			$arMeses = Array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
			$tmesQ = array('eneNeto','febNeto','marNeto','abrNeto','mayNeto','junNeto','julNeto','agoNeto','sepNeto','octNeto','novNeto','dicNeto');
			//$contador = $elMesActual-1;
			$contador = $elMesActual;
			for($m=0;$m<12;$m++){
				$me[] = $arMeses[$contador];
				if ($contador < $elMesActual){
					$arAnio[] = $anioFinal;
				}else{
					$arAnio[] = $anioInicial;
				}
				$ma[] = $tmesQ[$contador];
				$nu[] = $meses[$contador];
				if($contador == 11){
					$contador = 0;
				}else{
					$contador = $contador + 1;
				}
			}
			$fechainicial = new DateTime($fI);
			$fechafinal = new DateTime($fF);
			$diferencia = $fechainicial->diff($fechafinal);
			$Lmeses = ( $diferencia->y * 12 ) + $diferencia->m;
			if($elMesActual == 0){
				$elAnioActual = $anioFinal;
			}else{
				$elAnioActual = $anioInicial; 	// 2015
			}
			$contadorb = $elMesActual-1;	// 0
			$contadorc = $elMesActual;		// 1
			//$anActb = $elAnioActual + 1;	// 2016
			$tmes = array($tenero,$tfebrero,$tmarzo,$tabril,$tmayo,$tjunio,$tjulio,$tagosto,$tseptiembre,$toctubre,$tnoviembre,$tdiciembre);
			for($i=0;$i<$numerofilas;$i++){
				$mes = array($enero,$febrero,$marzo,$abril,$mayo,$junio,$julio,$agosto,$septiembre,$octubre,$noviembre,$diciembre);
				$queryf = ("SELECT * FROM axc_contratos where id_contrato = ".$row[$i]["contrato"].";");
				$rowf = $omodelo->_consultar($queryf);		// ::::::::::::::: MODIFICAR EL QUERY
				if($rowf[0]['estatus'] == "En proceso"){
					
					$tipoCambio = 1;
					if($row[$i]["moneda"] == "dolares"){
						$tipoCambio = $divisa;
						if($row[$i]["divisa"] != "0"){
							$tipoCambio = $row[$i]["divisa"];
						}
					}
					$fechaM = (int)date("m");
					$queryb = ("SELECT * FROM axc_riesgos_mensual where riesgo = ".$row[$i]["id_riesgo"]." ".$rangoFecha.";");				// ::::::::::::::: MODIFICAR EL QUERY
					$rowb = $omodelo->_consultar($queryb);
					$numerofilask = $omodelo->numerofilas;
					for($k=0;$k<$numerofilask;$k++){
						$siMes = 0;
						for($t=0;$t<$Lmeses+1;$t++){
							$mat = $Lmeses+1;
							$anActb = $anioInicial;
							if($siMes == 1){
								$anActb = $anioFinal;
							}
							//echo '<script>alert("'.$anActb.' ~ '.$rowb[$k]['anio'].'");</script>';
							if($rowb[$k]['anio'] == $anActb){
								$mesRie = (double)$rowb[$k][$ma[$t]] * (double)$tipoCambio;
								$mes[$t] = $mesRie;
							}
							if($ma[$t] == "dicNeto"){
								$siMes = 1;
							}
						}
						$tuti = $tuti + $row[$i]["utilidad"];
					}
					$elTd = "";
					for($j=0;$j<$Lmeses+1;$j++){
						if($fechaM == $nu[$j]){
							$mesRie = (double)$row[$i]["utilidad"] * (double)$tipoCambio;
							$mes[$j] = $mesRie;
							$tmes[$j] = $tuti;
						}else{
							$tmes[$j] = $tmes[$j] + $mes[$j];
						}
						$mes[$j] = ($mes[$j] != "") ? $mes[$j] : "0";
						$elTd .= '<td class="dinero sumar" sumaCol="suma'.$j.'">'.$mes[$j].'</td>';
					}

					$lista2 .= '
						<tr style="font-size:11px">
							<td class="expandible0">'.$row[$i]["folio"].'</td>						
							<td class="expandible1">'.$row[$i]["ciclo"].'</td>
							<td class="expandible2">'.$row[$i]["subyacente"].'</td>
							'.$elTd.'
						</tr>';
				}
			}
			$elTd .= '<td class="dinero sumar" sumaCol="febr">'.$mes[$j].'</td>';
			$Tcolum = "";
			for($tt=0;$tt<$Lmeses+1;$tt++){
				$Tcolum .= '<td class="expandible1 dinero sumar" sumaCol="Tsuma'.$tt.'">'.$tmes[$tt].'</td>';
			}
			$lista3 = '
				<tfoot id="imprimirTf">
					<tr style="font-size:11px">
						<td class="expandible0" style="text-align:center"><b>Total</b></td>
						<td></td>
						<td></td>
						'.$Tcolum.'
					</tr>
				</tfoot>
			';
			
			$colum = "";
			for($th=0;$th<$Lmeses+1;$th++){
				$colum .= '<th>'.$me[$th].'<br><small>'.$arAnio[$th].'</small></th>';
			}
			$lista1 = '<div class="table-responsive">
			<table style="color:black;font-size: 12px;" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover sumando" id="tablaUsuarios">
				<thead id="imprimirTh">
					<tr class="expandible">
						<th style="border-radius: 5px 0 0;">Folio</th>
						<th>Ciclo</th>
						<th>Subyacente</th>
						'.$colum.'
					</tr>
				</thead>
				<tbody id="imprimirTb">';
			$lista4 = ''.$lista2.'</tbody>'.$lista3.'</table></div>';
		}
	//16051500090-32
		$lista = $lista1.$lista4;
		return $lista;
	}
	
	public function _reporte(){
		$omodelo = new m_modelo();
		extract($_POST);
		
		// SE CREAN LOS FILTROS DE FECHA Y CICLOS
		/*$queryh = ("SELECT * FROM costos order by id_costo desc;");	// ::::::::::::::: MODIFICAR EL QUERY
		$rowh = $omodelo->_consultar($queryh);
		$elciclo = " AND ciclo = '".$rowh[0]['ciclo']."'";
		if(ISSET($filtroCiclo)){
			if($filtroCiclo == "Todos"){
				$elciclo = "";
			}else{
				$elciclo = " AND ciclo = '".$filtroCiclo."'";
			}
		}
		*/

		$elEgreso = "";
		if(ISSET($egreso)){$elEgreso = explode(",",$egreso);}
		//if($elEgreso == "" or $egreso == "gasto,costo" ){
			if($egreso == "gasto" or $egreso == "" or $egreso == "gasto,costo"){
				
				$query = ("SELECT * FROM costos order by id_costo desc;");
				$row = $omodelo->_consultar($query);		// ::::::::::::::: MODIFICAR EL QUERY
				$numerofilas = $omodelo->numerofilas;
				if ($row == "si") {
					echo "<p class='dialogo'>Error de consulta gastos</p>";
				}else{
					$lista2 = "";
					$costosd = "";
					$detallecos = "";
					$sumGast = 0;
					// FILTRO DE FECHA	
					for($i=0;$i<$numerofilas;$i++){
						$otroCost = $row[$i]["tipo_costo"];
						if($row[$i]["tipo_costo"] == "Otros gastos"){
							$otroCost =$row[$i]["otro_costo"];
						}
						$unit=$row[$i]["costo"]/$row[$i]["cantidad"];
						$detallecos = '
							<div class="popTabla" id="divPov-'.$row[$i]["id_costo"].$i.'">
							<div id="provT-'.$row[$i]["id_costo"].$i.'" class="table-responsive tablaProv" style="border-radius:20px">
								<div class="modal-header bg-inverse bd-inverse-darken" style="border-radius: 18px 18px 0 0;">
									<h6 class="modal-title">Gasto: <strong>'.$row[$i]["tipo_costo"].'</strong></h6>
								</div>
								<div style="background: aliceblue;border-radius: 0 0 18px 18px;padding: 10px;" class="panel-body">
									<table style="font-size:11px" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover">
										<tr>
											<td style="color: #898989;"><strong>Tipo de gasto</strong></td>
											<td>'.$otroCost.'</td>
										</tr>
										<tr>
											<td style="color: #898989;"><strong>Monto</strong></td>
											<td class="dinero">'.$unit.'</td>
										</tr>
										<tr>
											<td style="color: #898989;"><strong>Cantidad</strong></td>
											<td>'.$row[$i]["cantidad"].'</td>
										</tr>
										<tr>
											<td style="color: #898989;"><strong>Total</strong></td>
											<td class="dinero">'.$row[$i]["costo"].'</td>
										</tr>
										<tr>
											<td style="color: #898989;"><strong>Descripci&oacute;n</strong></td>
											<td>'.$row[$i]["observaciones"].'</td>
										</tr>
									</table>
								</div>
							</div>
							';
						$costosd = ''.$detallecos.'<label style="font-size: 10px;padding: 2px;" id="popTabla-'.$row[$i]["id_costo"].$i.'" class="btn btn-theme-inverse"><i class="fa fa-eye"></i> Ver</label></div>';
						$sumGast = $sumGast + $row[$i]["costo"];
						$lfecha = explode("-",$row[$i]["fecha"]);
						$lista2 .= '
								<tr>
									<td>Gasto</td>						
									<td>'.$row[$i]["folio"].'</td>
									<td>'.$lfecha[2].'-'.$lfecha[1].'-'.$lfecha[0].'</td>
									<td class="dinero sumar" sumaCol="suma3">'.$row[$i]["costo"].'</td>
									<td>'.$costosd.'</td>	
								</tr>';
					}
				}
			}
			if($egreso == ",costo" or $egreso == "" or $egreso == "gasto,costo"){
				$queryf = ("SELECT * FROM lotes order by id_lote desc;");
				$rowf = $omodelo->_consultar($queryf);		// ::::::::::::::: MODIFICAR EL QUERY
				$numerofilasf = $omodelo->numerofilas;
				if ($rowf == "si") {
					echo "<p class='dialogo'>Error de consulta costos</p>";
				}else{
					$costosd = "";
					$detallecos = "";
					$sumCOst = 0;
					// FILTRO DE FECHA
					for($i=0;$i<$numerofilasf;$i++){
						
						$queryd = ("SELECT * FROM detalle_lotes where lote = ".$rowf[$i]['id_lote'].";");
						$rowd = $omodelo->_consultar($queryd);		// ::::::::::::::: MODIFICAR EL QUERY
						$numerofilasd = $omodelo->numerofilas;
						for($j=0;$j<$numerofilasd;$j++){
							$sumCOst = $sumCOst + $rowd[$j]['costo'];
						}
						$queryr = ("SELECT * FROM productos where id_producto = ".$rowf[$i]['producto'].";");
						$rowr = $omodelo->_consultar($queryr);
						$laFoto = 'archivos/fotosProductos/'.$rowr[0]["foto"].'';
						if($rowr[0]["foto"] == ""){
							$laFoto = 'vistas/images/picture.png';
						}
						
						$detallecos = '
							<div class="popTabla" id="divPov-0'.$rowf[$i]["id_lote"].$i.'">
							<div id="provT-0'.$rowf[$i]["id_lote"].$i.'" class="table-responsive tablaProv" style="border-radius:20px">
								<div class="modal-header bg-inverse bd-inverse-darken" style="border-radius: 18px 18px 0 0;">
									<h6 class="modal-title">Costo: <strong>Lote</strong></h6>
								</div>
								<div style="background: aliceblue;border-radius: 0 0 18px 18px;padding: 10px;" class="panel-body">
									<table style="font-size:11px" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover">
										<tr>
											<td style="color: #898989;"><strong>Costo</strong></td>
											<td>Lote de producci&oacute;n</td>
										</tr>
										<tr>
											<td style="color: #898989;"><strong>Producto</strong></td>
											<td><a href="'.$laFoto.'" title="'.$rowr[0]["nombre"].'" class="preview_fancybox"><img id="fot'.$rowr[0]["id_producto"].'" alt="" style="width:50px" src="'.$laFoto.'" class=""/></a><br>'.$rowr[0]["nombre"].'<br>'.$rowr[0]["codigo"].'</td>
										</tr>
										<tr>
											<td style="color: #898989;"><strong>Cantidad</strong></td>
											<td>'.$rowf[$i]["cantidad"].' '.$rowr[0]["medida"].'</td>
										</tr>
										<tr>
											<td style="color: #898989;"><strong>Total</strong></td>
											<td class="dinero">'.$sumCOst.'</td>
										</tr>
										<tr>
											<td style="color: #898989;"><strong>Estatus</strong></td>
											<td>'.$rowf[$i]["estatus"].'</td>
										</tr>
									</table>
								</div>
							</div>
							';
						$costosd = ''.$detallecos.'<label style="font-size: 10px;padding: 2px;" id="popTabla-0'.$rowf[$i]["id_lote"].$i.'" class="btn btn-theme-inverse"><i class="fa fa-eye"></i> Ver</label></div>';
						$sumGast = $sumGast + $sumCOst;
						$lfecha = explode("-",$rowf[$i]["fecha_final"]);
						$lista2 .= '
								<tr>
									<td>Costo</td>						
									<td>'.$rowf[$i]["codigo"].'</td>
									<td>'.$lfecha[2].'-'.$lfecha[1].'-'.$lfecha[0].'</td>
									<td class="dinero sumar" sumaCol="suma3">'.$sumCOst.'</td>
									<td>'.$costosd.'</td>	
								</tr>';
					}
				}
			}
		//}
			$lista3 = '
				<tfoot id="imprimirTf" align="center">
					<tr>
						<td><b>Total</b></td>
						<td></td>
						<td></td>
						<td class="expandible1 dinero sumar" sumaCol="Tsuma3">'.$sumGast.'</td>
						<td></td>
					</tr>
				</tfoot>
			';
			
			$lista1 = '<div class="table-responsive">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover sumando" id="tablaUsuarios">
				<thead id="imprimirTh">
					<tr>
						<th>Egreso</th>
						<th>Folio</th>
						<th>Fecha</th>
						<th>Monto</th>
						<th>Detalle</th>
					</tr>
				</thead>
				<tbody id="imprimirTb" align="center">';
			$lista4 = ''.$lista2.'</tbody>'.$lista3.'</table></div>';
		$lista = $lista1.$lista4;
		return $lista;
	}
	
	public function _consultab(){
		$omodelo = new m_modelo();
		extract($_POST);
		// TIPO DE CAMBIO PARA SISTEMA LOCAL EN LA BARCA
		$divisa = 20.52;
		//$divisa = $this->_tiie();
		// SE CREAN LOS FILTROS DE FECHA Y CICLOS
		$queryh = ("SELECT * FROM axc_ciclos order by id_ciclo desc;");	// ::::::::::::::: MODIFICAR EL QUERY
		$rowh = $omodelo->_consultar($queryh);
		$elciclo = " AND ciclo = '".$rowh[0]['ciclo']."'";
		if(ISSET($filtroCiclo)){
			if($filtroCiclo == "Todos"){
				$elciclo = "";
			}else{
				$elciclo = " AND ciclo = '".$filtroCiclo."'";
			}
		}
		$elEstatus = " AND status = 'Sin liquidar'";
		if(ISSET($tGrafica)){
			if($tGrafica == ""){
				$elEstatus = "";
			}else{
				$elEstatusA = explode(",",$tGrafica);
				$estat = '';
				for($r=0;$r<count($elEstatusA);$r++){
					if($r==0){
						$estat = "'".$elEstatusA[$r]."'";
					}else{
						$estat = $estat.",'".$elEstatusA[$r]."'";
					}
					if($elEstatusA[$r] == "Liquidada"){
						$estat = $estat.",'Liquidada definitiva','Liquidada parcial'";
					}
				}
				$elEstatus = " AND status IN (".$estat.")";
			}
		}

		$elsubyacente = "";
		if(ISSET($filtroSubyacente)){
			if($filtroSubyacente == "0"){
				$elsubyacente = "";
			}else{
				$elsubyacente = " AND subyacente = '".$filtroSubyacente."'";
			}
		}

		$elFolio = "";
		if(ISSET($filtroFolio)){
			if($filtroFolio == "0"){
				$elFolio = "";
			}else{
				$elFolio = " AND id_riesgo = '".$filtroFolio."'";
				$elsubyacente = "";
				$elciclo = "";
			}
		}
		
		$query = ("SELECT * FROM axc_riesgos where estructura = 'Put' ".$elciclo.$elEstatus.$elFolio.$elsubyacente.";");
		$row = $omodelo->_consultar($query);		// ::::::::::::::: MODIFICAR EL QUERY
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			// FILTRO DE FECHA	
			$fecaMes = date ( 'Y-m-j' , strtotime ( '-11 month' , strtotime ( date("Y-m-d") ) ) );
			$fechaMes = explode("-",$fecaMes);
			$rangoFecha =  " AND anio >= '".$fechaMes[0]."'";
			$anioInicial = $fechaMes[0];
			$anioFinal = date ('Y');
			$fI = $fecaMes;
			$fF = date("Y-m-d");
			$elMesActual = date('m')+1;
			$elMesActual = $elMesActual - 1;
			if(ISSET($filtro)){
				$filtro = explode("#",$filtro);
				$anioIni = explode("-",$filtro[0]);
				$anioFin = explode("-",$filtro[1]);
				$anioInicial = $anioIni[0];
				$anioFinal = $anioFin[0];
				$rangoFecha =  " AND anio BETWEEN '".$anioIni[0]."' AND '".$anioFin[0]."'";
				$fI = $filtro[0];
				$fF = $filtro[1];
				//$elMesActual = $anioIni[1]+1;
				$elMesActual = $anioIni[1];
				$elMesActual = $elMesActual - 1;
			}
			
			$meses = array(1,2,3,4,5,6,7,8,9,10,11,12);
			$arMeses = Array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
			$tmesQ = array('eneNeto','febNeto','marNeto','abrNeto','mayNeto','junNeto','julNeto','agoNeto','sepNeto','octNeto','novNeto','dicNeto');
			//$contador = $elMesActual-1;
			$contador = $elMesActual;
			for($m=0;$m<12;$m++){
				$me[] = $arMeses[$contador];
				if ($contador < $elMesActual){
					$arAnio[] = $anioFinal;
				}else{
					$arAnio[] = $anioInicial;
				}
				$ma[] = $tmesQ[$contador];
				$nu[] = $meses[$contador];
				if($contador == 11){
					$contador = 0;
				}else{
					$contador = $contador + 1;
				}
			}
			$fechainicial = new DateTime($fI);
			$fechafinal = new DateTime($fF);
			$diferencia = $fechainicial->diff($fechafinal);
			$Lmeses = ( $diferencia->y * 12 ) + $diferencia->m;
			if($elMesActual == 0){
				$elAnioActual = $anioFinal;
			}else{
				$elAnioActual = $anioInicial; 	// 2015
			}
			$contadorb = $elMesActual-1;	// 0
			$contadorc = $elMesActual;		// 1
			//$anActb = $elAnioActual + 1;	// 2016
			$tmes = array($tenero,$tfebrero,$tmarzo,$tabril,$tmayo,$tjunio,$tjulio,$tagosto,$tseptiembre,$toctubre,$tnoviembre,$tdiciembre);
			for($i=0;$i<$numerofilas;$i++){
				$mes = array($enero,$febrero,$marzo,$abril,$mayo,$junio,$julio,$agosto,$septiembre,$octubre,$noviembre,$diciembre);
				$queryf = ("SELECT * FROM axc_contratos where id_contrato = ".$row[$i]["contrato"].";");
				$rowf = $omodelo->_consultar($queryf);		// ::::::::::::::: MODIFICAR EL QUERY
				if($rowf[0]['estatus'] == "En proceso"){
					
					$tipoCambio = 1;
					if($row[$i]["moneda"] == "dolares"){
						$tipoCambio = $divisa;
						if($row[$i]["divisa"] != "0"){
							$tipoCambio = $row[$i]["divisa"];
						}
					}
					$fechaM = (int)date("m");
					$queryb = ("SELECT * FROM axc_riesgos_mensual where riesgo = ".$row[$i]["id_riesgo"]." ".$rangoFecha.";");				// ::::::::::::::: MODIFICAR EL QUERY
					$rowb = $omodelo->_consultar($queryb);
					$numerofilask = $omodelo->numerofilas;
					for($k=0;$k<$numerofilask;$k++){
						$siMes = 0;
						for($t=0;$t<$Lmeses+1;$t++){
							$mat = $Lmeses+1;
							$anActb = $anioInicial;
							if($siMes == 1){
								$anActb = $anioFinal;
							}
							if($rowb[$k]['anio'] == $anActb){
								$mesRie = (double)$rowb[$k][$ma[$t]] * (double)$tipoCambio;
								$mes[$t] = $mesRie;
							}
							if($ma[$t] == "dicNeto"){
								$siMes = 1;
							}
						}
						$tuti = $tuti + $row[$i]["utilidad"];
					}
					for($j=0;$j<$Lmeses+1;$j++){
						if($fechaM == $nu[$j]){
							$mesRie = (double)$row[$i]["utilidad"] * (double)$tipoCambio;
							$mes[$j] = $mesRie;
							$tmes[$j] = $tuti;
						}else{
							$tmes[$j] = $tmes[$j] + $mes[$j];
						}
					}
				}
			}
		}
		
		$mesTh=$anioTh=$totalTd="";
		for($th=0;$th<$Lmeses+1;$th++){
			$mesTh .= $me[$th]."#";
			$anioTh .= $arAnio[$th]."#";
			$totalTd .= round($tmes[$th], 3)."#";
		}
		echo $mesTh."~".$anioTh."~".$totalTd;
	}	


}
?>