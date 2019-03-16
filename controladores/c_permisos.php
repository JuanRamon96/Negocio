<?php
// ::::::::::::::::::::	CONTRATOS	:::::::::::::::::::::::::::::::::::::::::::::::::::
	$Scontratos = "COA,COM,COE,COV";
	$contratoA = explode(",",$Scontratos);
	$conTodo = "";
	for($i=0;$i<count($_SESSION['permiso_axc'][0]);$i++){
		if($_SESSION['permiso_axc'][0][$i] == "0"){
			$conTodo = $conTodo + 1;
			echo "<script>$('#Tabs [permiso=".$contratoA[$i]."]').remove()</script>";
		}
	}
	if($conTodo == count($contratoA)){
		echo "<script>$('#menu [permiso=COAMEV]').remove()</script>";
	}
	if($_SESSION['permiso_axc'][0][1] == "0" && $_SESSION['permiso_axc'][0][2] == "0"){
		echo "<script>$('#Tabs [permiso=COME]').remove()</script>";
	}
// ::::::::::::::::::::	COBERTURAS	:::::::::::::::::::::::::::::::::::::::::::::::::::
	$Sriesgos = "RIA,RIM,RIE,RIV";
	$riesgoA = explode(",",$Sriesgos);
	$bTodo = "";
	for($i=0;$i<count($_SESSION['permiso_axc'][1]);$i++){
		if($_SESSION['permiso_axc'][1][$i] == "0"){
			$bTodo = $bTodo + 1;
			echo "<script>$('#Tabs [permiso=".$riesgoA[$i]."]').remove()</script>";
		}
	}
	if($bTodo == count($riesgoA)){
		echo "<script>$('#menu [permiso=RIAMEV]').remove()</script>";
	}
	if($_SESSION['permiso_axc'][1][1] == "0" && $_SESSION['permiso_axc'][1][2] == "0"){
		echo "<script>$('#Tabs [permiso=RIME]').remove()</script>";
	}
// ::::::::::::::::::::	PAGOS	:::::::::::::::::::::::::::::::::::::::::::::::::::
	$Spagos = "PAA,PAM,PAE,PAV";
	$pagoA = explode(",",$Spagos);
	$paTodo = "";
	for($i=0;$i<count($_SESSION['permiso_axc'][2]);$i++){
		if($_SESSION['permiso_axc'][2][$i] == "0"){
			$paTodo = $paTodo + 1;
			echo "<script>$('#Tabs [permiso=".$pagoA[$i]."]').remove()</script>";
		}
	}
	if($paTodo == count($pagoA)){
		echo "<script>$('#menu [permiso=PAAMEV]').remove()</script>";
	}
	if($_SESSION['permiso_axc'][2][1] == "0" && $_SESSION['permiso_axc'][2][2] == "0"){
		echo "<script>$('#Tabs [permiso=PAME]').remove()</script>";
	}
// ::::::::::::::::::::	ARCHIVOS	:::::::::::::::::::::::::::::::::::::::::::::::::::
	$Archivos = "ARA,ARM,ARE,ARV";
	$ArchivosA = explode(",",$Archivos);
	$arTodo = "";
	for($i=0;$i<count($_SESSION['permiso_axc'][3]);$i++){
		if($_SESSION['permiso_axc'][3][$i] == "0"){
			$arTodo = $arTodo + 1;
			echo "<script>$('#Tabs [permiso=".$ArchivosA[$i]."]').remove()</script>";
		}
	}
	if($arTodo == count($ArchivosA)){
		echo "<script>$('#menu [permiso=ARAMEV]').remove()</script>";
	}
	if($_SESSION['permiso_axc'][3][1] == "0" && $_SESSION['permiso_axc'][3][2] == "0"){
		echo "<script>$('#Tabs [permiso=ARME]').remove()</script>";
	}
// ::::::::::::::::::::	RECORDATORIOS	:::::::::::::::::::::::::::::::::::::::::::::::::::
	$Recordatorios = "REA,REM,REE,REV";
	$RecordatoriosA = explode(",",$Recordatorios);
	$recTodo = "";
	for($i=0;$i<count($_SESSION['permiso_axc'][4]);$i++){
		if($_SESSION['permiso_axc'][4][$i] == "0"){
			$recTodo = $recTodo + 1;
			echo "<script>$('#Tabs [permiso=".$RecordatoriosA[$i]."]').remove()</script>";
		}
	}
	if($recTodo == count($RecordatoriosA)){
		echo "<script>$('#menu [permiso=REAMEV]').remove()</script>";
	}
	if($_SESSION['permiso_axc'][4][1] == "0" && $_SESSION['permiso_axc'][4][2] == "0"){
		echo "<script>$('#Tabs [permiso=REME]').remove()</script>";
	}
// ::::::::::::::::::::	USUARIOS	:::::::::::::::::::::::::::::::::::::::::::::::::::
	$Usuarios = "USA,USM,USE,USV";
	$usuarioA = explode(",",$Usuarios);
	$uTodo = "";
	for($i=0;$i<count($_SESSION['permiso_axc'][5]);$i++){
		if($_SESSION['permiso_axc'][5][$i] == "0"){
			$uTodo = $uTodo + 1;
			echo "<script>$('#Tabs [permiso=".$usuarioA[$i]."]').remove()</script>";
		}
	}
	if($uTodo == count($usuarioA)){
		echo "<script>$('#menu [permiso=USAMEV]').remove()</script>";
	}
	if($_SESSION['permiso_axc'][5][1] == "0" && $_SESSION['permiso_axc'][5][2] == "0"){
		echo "<script>$('#Tabs [permiso=USME]').remove()</script>";
	}
// ::::::::::::::::::::	REPORTES	:::::::::::::::::::::::::::::::::::::::::::::::::::
	$Reportes = "PT,CL,RS,CR";
	$reporteA = explode(",",$Reportes);
	$Rtodos = "";
	for($i=0;$i<count($_SESSION['permiso_axc'][6]);$i++){
		if($_SESSION['permiso_axc'][6][$i] == "0"){
			$Rtodos = $Rtodos + 1;
			echo "<script>$('#Tabs [permiso=".$reporteA[$i]."]').remove()</script>";
		}
	}
	if($Rtodos == count($reporteA)){
		echo "<script>$('#menu [permiso=TODREPO]').remove()</script>";
	}
?>