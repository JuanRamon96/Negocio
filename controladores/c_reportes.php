<?php
class reportes {										// ::::::::::::::: PONER NOMBRE DE CLASE IGUAL QUE EL MENU (solo minusculas)	

	public function _reporte(){
		$nomReportes = 'puts,calls,restantes,coberturasx,pagosp,precio'; //::::::::::::: 	AGREGAR NOMBRE DEL REPORTE
		$resp = "0~".$nomReportes."";
		return $resp;
	}
	
	public function _puts(){
		$omodelo = new m_modelo();
		$query = ("SELECT * FROM axc_riesgos where estructura = 'Put';");
		$row = $omodelo->_consultar($query);		// ::::::::::::::: MODIFICAR EL QUERY
		$numerofilas = $omodelo->numerofilas;
		$elMesActual = date('m'+1);
		$elMesActual = $elMesActual - 1;
		$arMeses = Array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		$tmesQ = array('eneNeto','febNeto','marNeto','abrNeto','mayNeto','junNeto','julNeto','agoNeto','sepNeto','octNeto','novNeto','dicNeto');
		$contador = $elMesActual;
		for($m=0;$m<12;$m++){
			$me[] = $arMeses[$contador];
			$ma[] = $tmesQ[$contador];
			if($contador == 11){
				$contador = 0;
			}else{
				$contador = $contador + 1;
			}
		}
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			$lista1 = '<div id="noImprime" style="margin-top:40px">
			<table id="tgrafica" class="datatabless tablaReporte_0" width="100%" style="font-size:12px">
				<thead id="imprimirTh">
					<tr class="expandible">
						<th id="thprimero" style="border-radius: 5px 0 0;">Folio</th>
						<th>'.$me[0].'</th>
						<th>'.$me[1].'</th>
						<th>'.$me[2].'</th>
						<th>'.$me[3].'</th>
						<th>'.$me[4].'</th>
						<th>'.$me[5].'</th>
						<th>'.$me[6].'</th>
						<th>'.$me[7].'</th>
						<th>'.$me[8].'</th>
						<th>'.$me[9].'</th>
						<th>'.$me[10].'</th>
						<th style="border-radius: 0 5px 0 0;">'.$me[11].'</th>
					</tr>
				</thead>
				<tbody id="imprimirTb">';
			
			if($elMesActual == 0){
				$elAnioActual = date('Y');
			}else{
				$elAnioActual = date('Y')-1;
			}
			$contadorb = $elMesActual-1;
			$contadorc = $elMesActual;
			$anActb = $elAnioActual + 1;
			$mes = array($enero,$febrero,$marzo,$abril,$mayo,$junio,$julio,$agosto,$septiembre,$octubre,$noviembre,$diciembre);
			$tmes = array($tenero,$tfebrero,$tmarzo,$tabril,$tmayo,$tjunio,$tjulio,$tagosto,$tseptiembre,$toctubre,$tnoviembre,$tdiciembre);
			for($i=0;$i<$numerofilas;$i++){
				$fechaM = date("m");
				$queryb = ("SELECT * FROM axc_riesgos_mensual where riesgo = ".$row[$i]["id_riesgo"].";");				// ::::::::::::::: MODIFICAR EL QUERY
				$rowb = $omodelo->_consultar($queryb);
				$numerofilask = $omodelo->numerofilas;
				for($k=0;$k<$numerofilask;$k++){
					for($t=0;$t<12;$t++){
						if($contadorc <= $contadorb){
							if($rowb[$k]['anio'] == $anActb){
								$mes[$t] = $rowb[$k][$ma[$t]];
							}else{
								$mes[$t] = 0;	
							}
						}else{
							if($rowb[$k]['anio'] == $elAnioActual){
								$mes[$t] = $rowb[$k][$ma[$t]];
							}else{
								$mes[$t] = 0;
							}
						}
						if($contadorc == 11){
							$contadorc = 0;
						}else{
							$contadorc = $contadorc + 1;
						}
					}
					$tuti = $tuti + $row[$i]["utilidad"];
				}
				$meses = array(01,02,03,04,05,06,07,08,09,10,11,12);
				for($j=0;$j<count($meses);$j++){
					if($fechaM == $meses[$j]){
						$mes[$j] = $row[$i]["utilidad"];
						$tmes[$j] = $tuti;
					}else{
						$tmes[$j] = $tmes[$j] + $mes[$j];
					}
				}
				if($row[$i]["status"] == "Liquidada"){
					$statu = "liqui";
				}else if($row[$i]["status"] == "Sin liquidar"){
					$statu = "sliqui";
				}else if($row[$i]["status"] == "Pagada"){
					$statu = "pagad";
				}
				$lista2 .= '
					<tr class="'.$statu.'">
						<td class="expandible0">'.$row[$i]["folio"].'</td>						
						<td class="expandible1 dinero ener" sumaCol="ener">'.$mes[0].'</td>
						<td class="expandible2 dinero febr" sumaCol="febr">'.$mes[1].'</td>
						<td class="expandible3 dinero marz" sumaCol="marz">'.$mes[2].'</td>
						<td class="expandible4 dinero abri" sumaCol="abri">'.$mes[3].'</td>
						<td class="expandible5 dinero mayo" sumaCol="mayo">'.$mes[4].'</td>
						<td class="expandible6 dinero juni" sumaCol="juni">'.$mes[5].'</td>
						<td class="expandible7 dinero juli" sumaCol="juli">'.$mes[6].'</td>
						<td class="expandible8 dinero agos" sumaCol="agos">'.$mes[7].'</td>
						<td class="expandible9 dinero sept" sumaCol="sept">'.$mes[8].'</td>
						<td class="expandible10 dinero octu" sumaCol="octu">'.$mes[9].'</td>
						<td class="expandible11 dinero novi" sumaCol="novi">'.$mes[10].'</td>
						<td class="expandible12 dinero dici" sumaCol="dici">'.$mes[11].'</td>
					</tr>';
			}
			$lista3 = '
				<tfoot id="imprimirTf">
					<tr>
						<td class="expandible0" style="text-align:center"><b>Total</b></td>
						<td style="text-align:left" class="expandible1 dinero tener">'.$tmes[0].'</td>
						<td style="text-align:left" class="expandible2 dinero tfebr">'.$tmes[1].'</td>
						<td style="text-align:left" class="expandible3 dinero tmarz">'.$tmes[2].'</td>
						<td style="text-align:left" class="expandible4 dinero tabri">'.$tmes[3].'</td>
						<td style="text-align:left" class="expandible5 dinero tmayo">'.$tmes[4].'</td>
						<td style="text-align:left" class="expandible6 dinero tjuni">'.$tmes[5].'</td>
						<td style="text-align:left" class="expandible7 dinero tjuli">'.$tmes[6].'</td>
						<td style="text-align:left" class="expandible8 dinero tagos">'.$tmes[7].'</td>
						<td style="text-align:left" class="expandible9 dinero tsept">'.$tmes[8].'</td>
						<td style="text-align:left" class="expandible10 dinero toctu">'.$tmes[9].'</td>
						<td style="text-align:left" class="expandible11 dinero tnovi">'.$tmes[10].'</td>
						<td style="text-align:left" class="expandible12 dinero tdici">'.$tmes[11].'</td>
					</tr>
				</tfoot>
			';
			$lista4 = '</tbody></table>
			<div id="Gcp" class="oculto" style="width:1116px; height:400px;position:relative"></div>
			<div id="Glp" class="oculto" style="width:1116px; height:400px;position:relative"></div>
			<div id="Gtcplp" class="oculto" style="width:1116px; height:400px;position:relative"></div>
			</div>';
		}
		$lista = $lista1.$lista2.$lista3.$lista4;
		return utf8_encode($lista);
	}
	
	public function _calls(){
		$omodelo = new m_modelo();
		$query = ("SELECT * FROM axc_riesgos where estructura = 'Call';");
		$row = $omodelo->_consultar($query);		// ::::::::::::::: MODIFICAR EL QUERY
		$numerofilas = $omodelo->numerofilas;
		$elMesActual = date('m'+1);
		$elMesActual = $elMesActual - 1;
		$arMeses = Array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		$tmesQ = array('eneNeto','febNeto','marNeto','abrNeto','mayNeto','junNeto','julNeto','agoNeto','sepNeto','octNeto','novNeto','dicNeto');
		$contador = $elMesActual;
		for($m=0;$m<12;$m++){
			$me[] = $arMeses[$contador];
			$ma[] = $tmesQ[$contador];
			if($contador == 11){
				$contador = 0;
			}else{
				$contador = $contador + 1;
			}
		}
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			$lista1 = '<div id="noImprime" style="margin-top:40px">
			<table id="tgraficaAn" class="datatabless tablaReporte_1" width="100%" style="font-size:12px">
				<thead id="imprimirTh">
					<tr class="expandible">
						<th id="thprimero" style="border-radius: 5px 0 0;">Folio</th>
						<th>'.$me[0].'</th>
						<th>'.$me[1].'</th>
						<th>'.$me[2].'</th>
						<th>'.$me[3].'</th>
						<th>'.$me[4].'</th>
						<th>'.$me[5].'</th>
						<th>'.$me[6].'</th>
						<th>'.$me[7].'</th>
						<th>'.$me[8].'</th>
						<th>'.$me[9].'</th>
						<th>'.$me[10].'</th>
						<th style="border-radius: 0 5px 0 0;">'.$me[11].'</th>
					</tr>
				</thead>
				<tbody id="imprimirTb">';
								
			if($elMesActual == 1){
				$elAnioActual = date('Y');
			}else{
				$elAnioActual = date('Y')-1;
			}
			$contadorb = $elMesActual-1;
			$contadorc = $elMesActual;
			$anActb = $elAnioActual + 1;
			$mes = array($enero,$febrero,$marzo,$abril,$mayo,$junio,$julio,$agosto,$septiembre,$octubre,$noviembre,$diciembre);
			$tmes = array($tenero,$tfebrero,$tmarzo,$tabril,$tmayo,$tjunio,$tjulio,$tagosto,$tseptiembre,$toctubre,$tnoviembre,$tdiciembre);
			for($i=0;$i<$numerofilas;$i++){
				$fechaM = date("m");
				$queryb = ("SELECT * FROM axc_riesgos_mensual where riesgo = ".$row[$i]["id_riesgo"].";");				// ::::::::::::::: MODIFICAR EL QUERY
				$rowb = $omodelo->_consultar($queryb);
				$numerofilask = $omodelo->numerofilas;
				for($k=0;$k<$numerofilask;$k++){
					for($t=0;$t<12;$t++){
						if($contadorc <= $contadorb){
							if($rowb[$k]['anio'] == $anActb){
								$mes[$t] = $rowb[$k][$ma[$t]];
							}else{
								$mes[$t] = 0;	
							}
						}else{
							if($rowb[$k]['anio'] == $elAnioActual){
								$mes[$t] = $rowb[$k][$ma[$t]];
							}else{
								$mes[$t] = 0;	
							}
						}
						if($contadorc == 11){
							$contadorc = 0;
						}else{
							$contadorc = $contadorc + 1;
						}
					}
					$tuti = $tuti + $row[$i]["utilidad"];
				}
				$meses = array(01,02,03,04,05,06,07,08,09,10,11,12);

				for($j=0;$j<count($meses);$j++){
					if($fechaM == $meses[$j]){
						$mes[$j] = $row[$i]["utilidad"];
						$tmes[$j] = $tuti;
					}else{
						$tmes[$j] = $tmes[$j] + $mes[$j];
					}
				}
				if($row[$i]["status"] == "Liquidada"){
					$statu = "liqui";
				}else if($row[$i]["status"] == "Sin liquidar"){
					$statu = "sliqui";
				}else if($row[$i]["status"] == "Pagada"){
					$statu = "pagad";
				}
				$lista2 .= '
					<tr class="'.$statu.'">
						<td class="expandible0">'.$row[$i]["folio"].'</td>						
						<td class="expandible1 dinero ener" sumaCol="ener">'.$mes[0].'</td>
						<td class="expandible2 dinero febr" sumaCol="febr">'.$mes[1].'</td>
						<td class="expandible3 dinero marz" sumaCol="marz">'.$mes[2].'</td>
						<td class="expandible4 dinero abri" sumaCol="abri">'.$mes[3].'</td>
						<td class="expandible5 dinero mayo" sumaCol="mayo">'.$mes[4].'</td>
						<td class="expandible6 dinero juni" sumaCol="juni">'.$mes[5].'</td>
						<td class="expandible7 dinero juli" sumaCol="juli">'.$mes[6].'</td>
						<td class="expandible8 dinero agos" sumaCol="agos">'.$mes[7].'</td>
						<td class="expandible9 dinero sept" sumaCol="sept">'.$mes[8].'</td>
						<td class="expandible10 dinero octu" sumaCol="octu">'.$mes[9].'</td>
						<td class="expandible11 dinero novi" sumaCol="novi">'.$mes[10].'</td>
						<td class="expandible12 dinero dici" sumaCol="dici">'.$mes[11].'</td>
					</tr>';
			}
			$lista3 = '
				<tfoot id="imprimirTf">
					<tr>
						<td class="expandible0" style="text-align:center"><b>Total</b></td>
						<td style="text-align:left" class="expandible1 dinero tener">'.$tmes[0].'</td>
						<td style="text-align:left" class="expandible2 dinero tfebr">'.$tmes[1].'</td>
						<td style="text-align:left" class="expandible3 dinero tmarz">'.$tmes[2].'</td>
						<td style="text-align:left" class="expandible4 dinero tabri">'.$tmes[3].'</td>
						<td style="text-align:left" class="expandible5 dinero tmayo">'.$tmes[4].'</td>
						<td style="text-align:left" class="expandible6 dinero tjuni">'.$tmes[5].'</td>
						<td style="text-align:left" class="expandible7 dinero tjuli">'.$tmes[6].'</td>
						<td style="text-align:left" class="expandible8 dinero tagos">'.$tmes[7].'</td>
						<td style="text-align:left" class="expandible9 dinero tsept">'.$tmes[8].'</td>
						<td style="text-align:left" class="expandible10 dinero toctu">'.$tmes[9].'</td>
						<td style="text-align:left" class="expandible11 dinero tnovi">'.$tmes[10].'</td>
						<td style="text-align:left" class="expandible12 dinero tdici">'.$tmes[11].'</td>
					</tr>
				</tfoot>
			';
			$lista4 = '</tbody></table>
			<div id="GcpA" class="oculto" style="width:1116px; height:400px;position:relative"></div>
			<div id="GlpA" class="oculto" style="width:1116px; height:400px;position:relative"></div>
			<div id="GtcplpA" class="oculto" style="width:1116px; height:400px;position:relative"></div>
			</div>';
		}
		$lista = $lista1.$lista2.$lista3.$lista4;
		return utf8_encode($lista);
	}
	
	public function _restantes(){
		$omodelo = new m_modelo();
		$query = ("SELECT * FROM axc_riesgos where estructura != 'Call' and estructura != 'Put';");
		$row = $omodelo->_consultar($query);		// ::::::::::::::: MODIFICAR EL QUERY
		$numerofilas = $omodelo->numerofilas;
		$elMesActual = date('m'+1);
		$elMesActual = $elMesActual - 1;
		$arMeses = Array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		$tmesQ = array('eneNeto','febNeto','marNeto','abrNeto','mayNeto','junNeto','julNeto','agoNeto','sepNeto','octNeto','novNeto','dicNeto');
		$contador = $elMesActual;
		for($m=0;$m<12;$m++){
			$me[] = $arMeses[$contador];
			$ma[] = $tmesQ[$contador];
			if($contador == 11){
				$contador = 0;
			}else{
				$contador = $contador + 1;
			}
		}
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			$lista1 = '<div id="noImprime" style="margin-top:40px">
			<table class="datatabless tablaReporte_2" width="100%" style="font-size:12px">
				<thead id="imprimirTh">
					<tr class="expandible">
						<th id="thprimero" style="border-radius: 5px 0 0;">Folio</th>
						<th>'.$me[0].'</th>
						<th>'.$me[1].'</th>
						<th>'.$me[2].'</th>
						<th>'.$me[3].'</th>
						<th>'.$me[4].'</th>
						<th>'.$me[5].'</th>
						<th>'.$me[6].'</th>
						<th>'.$me[7].'</th>
						<th>'.$me[8].'</th>
						<th>'.$me[9].'</th>
						<th>'.$me[10].'</th>
						<th style="border-radius: 0 5px 0 0;">'.$me[11].'</th>
					</tr>
				</thead>
				<tbody id="imprimirTb">';
								
			if($elMesActual == 1){
				$elAnioActual = date('Y');
			}else{
				$elAnioActual = date('Y')-1;
			}
			$contadorb = $elMesActual-1;
			$contadorc = $elMesActual;
			$anActb = $elAnioActual + 1;
			$mes = array($enero,$febrero,$marzo,$abril,$mayo,$junio,$julio,$agosto,$septiembre,$octubre,$noviembre,$diciembre);
			$tmes = array($tenero,$tfebrero,$tmarzo,$tabril,$tmayo,$tjunio,$tjulio,$tagosto,$tseptiembre,$toctubre,$tnoviembre,$tdiciembre);
			for($i=0;$i<$numerofilas;$i++){
				$fechaM = date("m");
				$queryb = ("SELECT * FROM axc_riesgos_mensual where riesgo = ".$row[$i]["id_riesgo"].";");				// ::::::::::::::: MODIFICAR EL QUERY
				$rowb = $omodelo->_consultar($queryb);
				$numerofilask = $omodelo->numerofilas;
				for($k=0;$k<$numerofilask;$k++){
					for($t=0;$t<12;$t++){
						if($contadorc <= $contadorb){
							if($rowb[$k]['anio'] == $anActb){
								$mes[$t] = $rowb[$k][$ma[$t]];
							}else{
								$mes[$t] = 0;	
							}
						}else{
							if($rowb[$k]['anio'] == $elAnioActual){
								$mes[$t] = $rowb[$k][$ma[$t]];
							}else{
								$mes[$t] = 0;	
							}
						}
						if($contadorc == 11){
							$contadorc = 0;
						}else{
							$contadorc = $contadorc + 1;
						}
					}
					$tuti = $tuti + $row[$i]["utilidad"];
				}
				$meses = array(01,02,03,04,05,06,07,08,09,10,11,12);
				for($j=0;$j<count($meses);$j++){
					if($fechaM == $meses[$j]){
						$mes[$j] = $row[$i]["utilidad"];
						$tmes[$j] = $tuti;
					}else{
						$tmes[$j] = $tmes[$j] + $mes[$j];
					}
				}
				if($row[$i]["status"] == "Liquidada"){
					$statu = "liqui";
				}else if($row[$i]["status"] == "Sin liquidar"){
					$statu = "sliqui";
				}else if($row[$i]["status"] == "Pagada"){
					$statu = "pagad";
				}
				$lista2 .= '
					<tr class="'.$statu.'">
						<td class="expandible0">'.$row[$i]["folio"].'</td>						
						<td class="expandible1 dinero ener" sumaCol="ener">'.$mes[0].'</td>
						<td class="expandible2 dinero febr" sumaCol="febr">'.$mes[1].'</td>
						<td class="expandible3 dinero marz" sumaCol="marz">'.$mes[2].'</td>
						<td class="expandible4 dinero abri" sumaCol="abri">'.$mes[3].'</td>
						<td class="expandible5 dinero mayo" sumaCol="mayo">'.$mes[4].'</td>
						<td class="expandible6 dinero juni" sumaCol="juni">'.$mes[5].'</td>
						<td class="expandible7 dinero juli" sumaCol="juli">'.$mes[6].'</td>
						<td class="expandible8 dinero agos" sumaCol="agos">'.$mes[7].'</td>
						<td class="expandible9 dinero sept" sumaCol="sept">'.$mes[8].'</td>
						<td class="expandible10 dinero octu" sumaCol="octu">'.$mes[9].'</td>
						<td class="expandible11 dinero novi" sumaCol="novi">'.$mes[10].'</td>
						<td class="expandible12 dinero dici" sumaCol="dici">'.$mes[11].'</td>
					</tr>';
			}
			$lista3 = '
				<tfoot id="imprimirTf">
					<tr>
						<td class="expandible0" style="text-align:center"><b>Total</b></td>
						<td style="text-align:left" class="expandible1 dinero tener">'.$tmes[0].'</td>
						<td style="text-align:left" class="expandible2 dinero tfebr">'.$tmes[1].'</td>
						<td style="text-align:left" class="expandible3 dinero tmarz">'.$tmes[2].'</td>
						<td style="text-align:left" class="expandible4 dinero tabri">'.$tmes[3].'</td>
						<td style="text-align:left" class="expandible5 dinero tmayo">'.$tmes[4].'</td>
						<td style="text-align:left" class="expandible6 dinero tjuni">'.$tmes[5].'</td>
						<td style="text-align:left" class="expandible7 dinero tjuli">'.$tmes[6].'</td>
						<td style="text-align:left" class="expandible8 dinero tagos">'.$tmes[7].'</td>
						<td style="text-align:left" class="expandible9 dinero tsept">'.$tmes[8].'</td>
						<td style="text-align:left" class="expandible10 dinero toctu">'.$tmes[9].'</td>
						<td style="text-align:left" class="expandible11 dinero tnovi">'.$tmes[10].'</td>
						<td style="text-align:left" class="expandible12 dinero tdici">'.$tmes[11].'</td>
					</tr>
				</tfoot>
			';
			$lista4 = '</tbody></table></div>';
		}
		$lista = $lista1.$lista2.$lista3.$lista4;
		return utf8_encode($lista);
	}
	
	public function _coberturasx(){
		$omodelo = new m_modelo();
		$lista1 = '<div id="noImprime" style="margin-top:40px">
		<table class="datatabless tablaReporte_3" width="100%" style="font-size:12px">
			<thead id="imprimirTh">
				<tr class="expandible">
					<th id="thprimero" style="border-radius: 5px 0 0;">Raz&oacute;n social</th>
					<th>Subyacente</th>
					<th>Volumen</th>
					<th>Ciclo</th>
					<th>Costo</th>
					<th>Valor actual</th>
					<th style="border-radius: 0 5px 0 0;">Utilidad &oacute; p&eacute;rdida</th>
				</tr>
			</thead>';
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::	DESDE AQUI	::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		$lsuby = array("SORGO","MAIZ","TRIGO");
		$lista2 = "";
		$queryb = ("SELECT * FROM axc_participantes where participante = 'Comprador';");
		$rowb = $omodelo->_consultar($queryb);
		$numerofilasb = $omodelo->numerofilas;
		for($h=0;$h<$numerofilasb;$h++){
			$queryc = ("SELECT * FROM axc_contratos where razon_social = '".$rowb[$h]['id_participante']."';");
			$rowc = $omodelo->_consultar($queryc);
			$numerofilasc = $omodelo->numerofilas;

			$stonxs = $stonxm = $stonxt = 0;
			$lccostos = $lccostom = $lccostot = 0;
			$valorActuals = $valorActualm = $valorActualt = 0;
			$utilidads = $utilidadm = $utilidadt = 0;
			$subya = 0;
			$sorgo = $maiz = $trigo = 0;
			
			for($x=0;$x<$numerofilasc;$x++){
				$cx = $numerofilasc - 1;
				
			//for($j=0;$j<count($lsuby);$j++){
			
				$query = ("SELECT * FROM axc_riesgos where contrato = '".$rowc[$x]['id_contrato']."';");
				$row = $omodelo->_consultar($query);
				$numerofilas = $omodelo->numerofilas;
				$ncontratos = 0;
				$lcostos = $lcostom = $lcostot = 0;
				$cvalorActuals = $cvalorActualm = $cvalorActualt = 0;
				
				for($i=0;$i<$numerofilas;$i++){
					
					if($row[$i]['estructura'] == "Put"){
					
						if($row[$i]['status'] != "Pagada"){
						
							switch($row[$i]['subyacente']){
								case "SORGO":
									$tonxs = (float)$row[$i]['no_contratos'] * 127.006;
									$ccostos = $tonxs * (float)$row[$i]['costo_prima'];
									$cvalorActuals = $tonxs * (float)$row[$i]['valor_actual'];
									$valorActuals = $valorActuals + $cvalorActuals;
									$stonxs = $stonxs + $tonxs;
									$lccostos = $lccostos + $ccostos;
									$utilidads = $utilidads + (float)$row[$i]['utilidad'];
									$lcostos = $stonxs * $ccostos;
									$ciclos = $row[$i]['ciclo'];
									$subya = 1;
									$sorgo = 1;
								break;
								case "MAIZ":
									$tonxm = (float)$row[$i]['no_contratos'] * 127.006;
									$ccostom = $tonxm * (float)$row[$i]['costo_prima'];
									$cvalorActualm = $tonxm * (float)$row[$i]['valor_actual'];
									$valorActualm = $valorActualm + $cvalorActualm;
									$stonxm = $stonxm + $tonxm;
									$lccostom = $lccostom + $ccostom;
									$utilidadm = $utilidadm + (float)$row[$i]['utilidad'];
									$lcostom = $stonxm * $ccostom;
									$ciclom = $row[$i]['ciclo'];
									$subya = 2;
									$maiz = 1;
								break;
								case "TRIGO":
									$tonxt = (float)$row[$i]['no_contratos'] * 136.08;
									$ccostot = $tonxt * (float)$row[$i]['costo_prima'];
									$cvalorActualt = $tonxt * (float)$row[$i]['valor_actual'];
									$valorActualt = $valorActualt + $cvalorActualt;
									$stonxt = $stonxt + $tonxt;
									$lccostot = $lccostot + $ccostot;
									$utilidadt = $utilidadt + (float)$row[$i]['utilidad'];
									$lcostot = $stonxt * $ccostot;
									$ciclot = $row[$i]['ciclo'];
									$subya = 3;
									$trigo = 1;
								break;
							}
						}
					}
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::	HASTA AQUI	:::::::::::::::::::::::::::::::::::::::::::::::::::::::::
				}
				if($cx == $x){
				if($numerofilasc > 0){
					$tcosto = $tcosto + $lccostos + $lccostom + $lccostot;
					$tvalorActual = $tvalorActual + $valorActuals + $valorActualm + $valorActualt;
					$tutilidad = $tutilidad + $utilidads + $utilidadm + $utilidadt;
					
					if($subya == 1){
						$lista2 .= '
							<tr>
								<td class="expandible0">'.$rowb[$h]['nombre'].'</td>
								<td class="expandible1">SORGO</td>
								<td class="expandible2">'.$stonxs.' Ton.</td>
								<td class="expandible3">'.$ciclos.'</td>
								<td class="expandible4 dinero abri" sumaCol="abri">'.$lccostos.'</td>
								<td class="expandible5 dinero mayo" sumaCol="mayo">'.$valorActuals.'</td>
								<td class="expandible6 dinero juni" sumaCol="juni">'.$utilidads.'</td>
							</tr>';
					}
					if($subya == 2){
						$lista2 .= '
							<tr>
								<td class="expandible0">'.$rowb[$h]['nombre'].'</td>
								<td class="expandible1">MAIZ</td>
								<td class="expandible2">'.$stonxm.' Ton.</td>
								<td class="expandible3">'.$ciclom.'</td>
								<td class="expandible4 dinero abri" sumaCol="abri">'.$lccostom.'</td>
								<td class="expandible5 dinero mayo" sumaCol="mayo">'.$valorActualm.'</td>
								<td class="expandible6 dinero juni" sumaCol="juni">'.$utilidadm.'</td>
							</tr>';
					}
					if($subya == 3){
						$lista2 .= '
							<tr>
								<td class="expandible0">'.$rowb[$h]['nombre'].'</td>
								<td class="expandible1">TRIGO</td>
								<td class="expandible2">'.$stonxt.' Ton.</td>
								<td class="expandible3">'.$ciclot.'</td>
								<td class="expandible4 dinero abri" sumaCol="abri">'.$lccostot.'</td>
								<td class="expandible5 dinero mayo" sumaCol="mayo">'.$valorActualt.'</td>
								<td class="expandible6 dinero juni" sumaCol="juni">'.$utilidadt.'</td>
							</tr>';
					}
				}
				}
			}
		//}
		}
			$lista3 = '
				<tfoot id="imprimirTf">
					<tr>
						<td class="expandible0" style="text-align:left" colspan="4"><b>Total</b></td>
						<td style="text-align:left;width: 106px;" class="expandible4 dinero tabri">'.$tcosto.'</td>
						<td style="text-align:left;width: 165px;" class="expandible5 dinero tmayo">'.$tvalorActual.'</td>
						<td style="text-align:left;width: 226px;" class="expandible6 dinero tjuni">'.$tutilidad.'</td>
					</tr>
				</tfoot>
			';
			$lista4 = '<tbody id="imprimirTb">'.$lista2.'</tbody>'.$lista3.'</table></div>';
		$lista = $lista1.$lista4;
		return utf8_encode($lista);
	}

	public function _pagosp(){
		$omodelo = new m_modelo();
		$query = ("SELECT * FROM axc_pagos;");				// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;	
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
		
		$lista1 = '<div id="noImprime" style="margin-top:40px">
		<table class="datatabless tablaReporte_4" width="100%" style="font-size:12px">
			<thead id="imprimirTh">
				<tr class="expandible">
					<th id="thprimero" style="border-radius: 5px 0 0;">Contrato</th>
					<th>Cobertura</th>
					<th>Raz&oacute;n social</th>
					<th>Utilidad / P&eacute;rdida</th>
					<th>Pago</th>
					<th>Fecha del pago</th>
					<th>Saldo Pendiente de pago</th>
					<th style="border-radius: 0 5px 0 0;">Tipo de pago</th>
				</tr>
			</thead>
			<tbody id="imprimirTb">';
			for($i=0;$i<$numerofilas;$i++){
				$razon = "";
				$queryb = ("SELECT * FROM axc_riesgos where id_riesgo = '".$row[$i]["cobertura"]."';");
				$rowb = $omodelo->_consultar($queryb);
				
				$queryc = ("SELECT * FROM axc_contratos where id_contrato = '".$rowb[0]["contrato"]."';");
				$rowc = $omodelo->_consultar($queryc);
				$saldo = (float)$rowb[0]["utilidad"] - (float)$row[$i]["monto"];
				/*if($saldo <= 0){
					$statu = "Pagada";
				}else{
					$statu = "En proceso";
				}*/
// ::::::::::::::: MODIFICAR (agregar y/o quitar) LOS DATOS A RECIBIR EN LA TABLA
				$utilidad = $utilidad + (float)$rowb[0]["utilidad"];
				$monto = $monto + (float)$row[$i]["monto"];
				$tsaldo = $tsaldo + $saldo;
				$lista2 .= '
						<tr>
							<td class="expandible0">'.$rowc[0]["no_contrato"].'</td>
							<td class="expandible1">'.$rowb[0]["folio"].'</td>
							<td class="expandible2">'.$rowb[0]["razon_social"].'</td>
							<td class="expandible3 dinero abri" sumaCol="abri">'.$rowb[0]["utilidad"].'</td>
							<td class="expandible4 dinero mayo" sumaCol="mayo">'.$row[$i]["monto"].'</td>
							<td class="expandible5">'._fecha($row[$i]["fecha"]).'</td>
							<td class="expandible6 dinero juni" sumaCol="juni">'.$saldo.'</td>
							<td class="expandible7">'.$row[$i]["tipo_pago"].'</td>									
						</tr>';
			}
		$lista3 = '
			<tfoot id="imprimirTf">
				<tr>
					<td class="expandible0" style="text-align:left;width: 300px;" colspan="3"><b>Total</b></td>
					<td style="text-align:left;" class="expandible4 dinero tabri">'.$utilidad.'</td>
					<td style="text-align:left;" class="expandible5 dinero tmayo">'.$monto.'</td><td></td>
					<td style="text-align:left;" class="expandible6 dinero tjuni">'.$tsaldo.'</td><td></td>
				</tr>
			</tfoot>';
		$lista4 = '</tbody></table></div>';
		$lista = $lista1.$lista2.$lista3.$lista4;
		return utf8_encode($lista);
	}
	}

	public function _precio(){
		$omodelo = new m_modelo();
		extract($_POST);
		$lista2 = "";
		$query = ("SELECT * FROM axc_riesgos;");
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		$divisa = $this->_tiie();
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
// ::::::::::::::: MODIFICAR (agregar y/o quitar) LOS NOMBRES DE LAS COLUMNAS DE LA TABLA
			$lista1 = '<div id="noImprime" style="margin-top:40px">
						<table class="datatabless" width="100%" style="text-align:left;font-size:11px">
							<thead id="imprimirTh">
								<tr class="expandible">
									<th id="thprimero" style="border-radius: 5px 0 0;padding-left: 5px;padding-right: 12px;">Subyacente</th>
									<th style="padding-left: 5px;padding-right: 12px;">Origen</th>
									<th style="padding-left: 5px;padding-right: 12px">Ciclo</th>
									<th style="padding-left: 5px;padding-right: 12px">Precio (dls)</th>
									<th style="padding-left: 5px;padding-right: 12px">Precio (mxn)</th>
									<th style="padding-left: 5px;padding-right: 12px;">Costo</th>
									<th style="padding-left: 5px;padding-right: 12px">Valor actual</th>
									<th style="padding-left: 5px;padding-right: 12px">Utilidad o p&eacute;rdida</th>
									<th style="padding-left: 5px;padding-right: 12px">Precio final</th>
									<th style="border-radius: 0 5px 0 0;padding-left: 5px;padding-right: 12px;">Volumen</th>
								</tr>
							</thead>
							<tbody id="imprimirTb">';
			$queryc = ("SELECT * FROM axc_contratos;");
			$rowc = $omodelo->_consultar($queryc);
			$numerofilasc = $omodelo->numerofilas;
			$suby = Array();
			for($h=0;$h<$numerofilas;$h++){
				$subyl = $row[$h]['subyacente'];
				if (!in_array($subyl, $suby)) {
					array_push($suby, $subyl);
				}
			}
			$origin = Array();
			$lcicl = Array();
			for($d=0;$d<$numerofilasc;$d++){
				$cicl = $rowc[$d]['ciclo'];
				if (!in_array($cicl, $lcicl)) {
					array_push($lcicl, $cicl);
				}
				$orige = $rowc[$d]['origen'];
				if (!in_array($orige, $origin)) {
					array_push($origin, $orige);
				}
			}
			
			for($a=0;$a<count($lcicl);$a++){
				for($c=0;$c<count($origin);$c++){
					$subya = 0;
					$tTonels = $tTonelm = $tTonelt = 0;
					$precioDlss =  $precioDlsm =  $precioDlst =  0;
					$precioPesoss = $precioPesosm = $precioPesost = 0;
					$costoSs = $costoSm = $costoSt = 0;
					$vActuals = $vActualm = $vActualt = 0;
					$ganancia = $gananciam = $gananciat = 0;
					$gananciasS = $gananciasM = $gananciasT = 0;
					$precioFinalSa = $precioFinalMa = $precioFinalTa = 0;
					$precioFinalSb = $precioFinalMb = $precioFinalTb = 0;
					$precioFinalS = $precioFinalM = $precioFinalT = 0;
					$precioPesossb = $precioPesosmb = $precioPesostb = 0;
					$precioFinalSc = $precioFinalMc = $precioFinalTc = 0;
						$queryb = ("SELECT * FROM axc_contratos where ciclo = '".$lcicl[$a]."' and origen = '".$origin[$c]."';");
						$rowb = $omodelo->_consultar($queryb);
						$numerofilasb = $omodelo->numerofilas;
						//for($b=0;$b<count($suby);$b++){
						
						for($f=0;$f<$numerofilasb;$f++){
						//echo '<script>alert("'.$rowb[$f]['id_contrato'].'");</script>';
							
							$queryx = ("SELECT * FROM axc_riesgos where contrato = '".$rowb[$f]['id_contrato']."';");
							$rowx = $omodelo->_consultar($queryx);
							$numerofilasx = $omodelo->numerofilas;
							for($m=0;$m<$numerofilasx;$m++){
								if($rowx[$m]['estructura'] == 'Put'){
								switch($rowx[$m]['subyacente']){
									case "SORGO":
											$tonxs = (float)$rowx[$m]['no_contratos'] * 127.006;
											$tTonels = $tTonels + $tonxs;
											$precioDlssb =  $rowb[$f]['precio'] * $tonxs;
											$precioDlss =  $precioDlss + $precioDlssb;
											$precioPesossb = $divisa * $rowb[$f]['precio'];
											if($rowx[$m]['divisa'] != "0"){
												if($rowb[$f]['moneda'] == "Pesos"){
													$precioPesossb = (float)$rowx[$m]['divisa'] * $rowb[$f]['precio'];
												}
											}
											if($rowb[$f]['tipo_cambio'] != "0"){
												$precioPesossb = (float)$rowb[$f]['tipo_cambio'] * $rowb[$f]['precio'];
											}
											$precioPesossbb = $precioPesossb * $tonxs;
											$precioPesoss = $precioPesoss + $precioPesossbb;
											$costoSsb = (float)$rowx[$m]["costo_prima"] * $tonxs;
											$costoSs = $costoSs + $costoSsb;
											$vActualsb = (float)$rowx[$m]["valor_actual"] * $tonxs;
											$vActuals = $vActuals + $vActualsb;
											$ganancia = (float)$rowx[$m]["valor_actual"] - (float)$rowx[$m]["costo_prima"];
											$gananciasSb = $ganancia * $tonxs;
											$gananciasS = $gananciasS + $gananciasSb;
											$precioFinalSa = $precioPesossb - (float)$rowx[$m]["valor_actual"];
											$precioFinalSb = $precioFinalSa + (float)$rowx[$m]["costo_prima"];
											$precioFinalSc = $precioFinalSb * $tonxs;
											$precioFinalS = $precioFinalS + $precioFinalSc;
											$subya = 1;
									break;
									case "MAIZ":
											$tonxm = (float)$rowx[$m]['no_contratos'] * 127.006;
											$tTonelm = $tTonelm + $tonxm;
											$precioDlsmb =  $rowb[$f]['precio'] * $tonxm;
											$precioDlsm =  $precioDlsm + $precioDlsmb;
											$precioPesosmb = $divisa * $rowb[$f]['precio'];
											if($rowx[$m]['divisa'] != "0"){
												if($rowb[$f]['moneda'] == "Pesos"){
													$precioPesosmb = (float)$rowx[$m]['divisa'] * $rowb[$f]['precio'];
												}
											}
											if($rowb[$f]['tipo_cambio'] != "0"){
												$precioPesosmb = (float)$rowb[$f]['tipo_cambio'] * $rowb[$f]['precio'];
											}
											$precioPesosmbb = $precioPesosmb * $tonxm;
											$precioPesosm = $precioPesosm + $precioPesosmbb;
											$costoSmb = (float)$rowx[$m]["costo_prima"] * $tonxm;
											$costoSm = $costoSm + $costoSmb;
											$vActualmb = (float)$rowx[$m]["valor_actual"] * $tonxm;
											$vActualm = $vActualm + $vActualmb;
											$gananciam = (float)$rowx[$m]["valor_actual"] - (float)$rowx[$m]["costo_prima"];
											$gananciasMb = $gananciam * $tonxm;
											$gananciasM = $gananciasM + $gananciasMb;
											$precioFinalMa = $precioPesosmb - (float)$rowx[$m]["valor_actual"];
											$precioFinalMb = $precioFinalMa + (float)$rowx[$m]["costo_prima"];
											$precioFinalMc = $precioFinalMb * $tonxm;
											$precioFinalM = $precioFinalM + $precioFinalMc;
											$subya = 2;
									break;
									case "TRIGO":
											$tonxt = (float)$rowx[$m]['no_contratos'] * 136.08;
											$tTonelt = $tTonelt + $tonxt;
											$precioDlstb =  $rowb[$f]['precio'] * $tonxt;
											$precioDlst =  $precioDlst + $precioDlstb;
											$precioPesostb = $divisa * $rowb[$f]['precio'];
											if($rowx[$m]['divisa'] != "0"){
												if($rowb[$f]['moneda'] == "Pesos"){
													$precioPesostb = (float)$rowx[$m]['divisa'] * $rowb[$f]['precio'];
												}
											}
											if($rowb[$f]['tipo_cambio'] != "0"){
												$precioPesostb = (float)$rowb[$f]['tipo_cambio'] * $rowb[$f]['precio'];
											}
											$precioPesostbb = $precioPesostb * $tonxt;
											$precioPesost = $precioPesost + $precioPesostbb;
											$costoStb = (float)$rowx[$m]["costo_prima"] * $tonxt;
											$costoSt = $costoSt + $costoStb;
											$vActualtb = (float)$rowx[$m]["valor_actual"] * $tonxt;
											$vActualt = $vActualt + $vActualtb;
											$gananciat = (float)$rowx[$m]["valor_actual"] - (float)$rowx[$m]["costo_prima"];
											$gananciasTb = $gananciat * $tonxt;
											$gananciasT = $gananciasT + $gananciasTb;
											$precioFinalTa = $precioPesostb - (float)$rowx[$m]["valor_actual"];
											$precioFinalTb = $precioFinalTa + (float)$rowx[$m]["costo_prima"];
											$precioFinalTc = $precioFinalTb * $tonxt;
											$precioFinalT = $precioFinalT + $precioFinalTc;
											$subya = 3;
									break;
								}
								}
							}
						}
						if($numerofilasx > 0){
							if($subya == 1){
								$precioDls = $precioDlss / $tTonels;
								$precioPsos = $precioPesoss / $tTonels;
								$costo = $costoSs / $tTonels;
								$vActual = $vActuals / $tTonels;
								$ganancias = $gananciasS / $tTonels;
								$precioFinal = $precioFinalS / $tTonels;
								$lista2 .= '
									<tr class="trcobertur">
										<td class="expandible0">SORGO</td>
										<td class="expandible1">'.$origin[$c].'</td>
										<td class="expandible2">'.$lcicl[$a].'</td>
										<td class="expandible3 dinero">'.$precioDls.'</td>
										<td class="expandible4 dinero">'.$precioPsos.'</td>
										<td class="expandible5 dinero">'.$costo.'</td>
										<td class="expandible6 dinero">'.$vActual.'</td>
										<td class="expandible7 dinero">'.$ganancias.'</td>
										<td class="expandible8 dinero">'.$precioFinal.'</td>
										<td class="expandible9">'.$tTonels.' Ton.</td>							
									</tr>';
							}
							if($subya == 2){
								$precioDls = $precioDlsm / $tTonelm;
								$precioPsos = $precioPesosm / $tTonelm;
								$costo = $costoSm / $tTonelm;
								$vActual = $vActualm / $tTonelm;
								$ganancias = $gananciasM / $tTonelm;
								$precioFinal = $precioFinalM / $tTonelm;
								$lista2 .= '
									<tr class="trcobertur">
										<td class="expandible0">MAIZ</td>
										<td class="expandible1">'.$origin[$c].'</td>
										<td class="expandible2">'.$lcicl[$a].'</td>
										<td class="expandible3 dinero">'.$precioDls.'</td>
										<td class="expandible4 dinero">'.$precioPsos.'</td>
										<td class="expandible5 dinero">'.$costo.'</td>
										<td class="expandible6 dinero">'.$vActual.'</td>
										<td class="expandible7 dinero">'.$ganancias.'</td>
										<td class="expandible8 dinero">'.$precioFinal.'</td>
										<td class="expandible9">'.$tTonelm.' Ton.</td>							
									</tr>';
							}
							if($subya == 3){
								$precioDls = $precioDlst / $tTonelt;
								$precioPsos = $precioPesost / $tTonelt;
								$costo = $costoSt / $tTonelt;
								$vActual = $vActualt / $tTonelt;
								$ganancias = $gananciasT / $tTonelt;
								$precioFinal = $precioFinalT / $tTonelt;
								$lista2 .= '
									<tr class="trcobertur">
										<td class="expandible0">TRIGO</td>
										<td class="expandible1">'.$origin[$c].'</td>
										<td class="expandible2">'.$lcicl[$a].'</td>
										<td class="expandible3 dinero">'.$precioDls.'</td>
										<td class="expandible4 dinero">'.$precioPsos.'</td>
										<td class="expandible5 dinero">'.$costo.'</td>
										<td class="expandible6 dinero">'.$vActual.'</td>
										<td class="expandible7 dinero">'.$ganancias.'</td>
										<td class="expandible8 dinero">'.$precioFinal.'</td>
										<td class="expandible9">'.$tTonelt.' Ton.</td>							
									</tr>';
							}
						}
					//}
				}
			}
		}
		$lista4 = '</tbody>
					</table>
					 </div>';
		$lista = $lista1.$lista2.$lista4;
		return utf8_encode($lista);
	}
	
	public function _tiie(){
			$client = new SoapClient(null, array('location' => 'http://www.banxico.org.mx:80/DgieWSWeb/DgieWS?WSDL', 
				'uri'      => 'http://DgieWSWeb/DgieWS?WSDL', 
				'encoding' => 'ISO-8859-1', 
				'trace'    => 1) );						 
			try { 
				$resultado = $client->tasasDeInteresBanxico();
				$resultadob = $client->tiposDeCambioBanxico();
			} 
			catch (SoapFault $exception) 
			{ 
			} 
			if(!empty($resultadob)) {
				$domb = new DomDocument(); 
				$domb->loadXML($resultadob);	
				$xmlDatosb = $domb->getElementsByTagName( "Obs" ); 
				if($xmlDatosb->length>1){ 
				//$domb->save("cliente.xml");
				   $item = $xmlDatosb->item(1);
					$fecha_tcb = date("d-m-Y", strtotime($item->getAttribute('TIME_PERIOD')));	   
					$tcb = $item->getAttribute('OBS_VALUE');
					
				} 
			} 

			if(!empty($resultado)){
				$dom = new DomDocument(); 
				$dom->loadXML($resultado);
				//$dom->save("clientew.xml");	
				$xmlDatos = $dom->getElementsByTagName( "Obs" ); 
				if($xmlDatos->length>1){ 
				   $itemc = $xmlDatos->item(3);
					$fecha_tc = date("d-m-Y", strtotime($itemc->getAttribute('TIME_PERIOD')));	   
					$tc = $itemc->getAttribute('OBS_VALUE');
					$item = $xmlDatos->item(6);
					$fecha_tcd = date("d-m-Y", strtotime($item->getAttribute('TIME_PERIOD')));	   
					$tcd = $item->getAttribute('OBS_VALUE');
					$itema = $xmlDatos->item(7);
					$fecha_tca = date("d-m-Y", strtotime($itema->getAttribute('TIME_PERIOD')));	   
					$tca = $itema->getAttribute('OBS_VALUE');
				} 
			}
			return $tcb;
		}


}
?>