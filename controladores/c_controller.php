<?php
include "c_funciones.php";
include "c_login.php";
include "c_usuarios.php";
include "c_sucursales.php";
include "c_proveedores.php";
include "c_productosM.php";
include "c_comprasM.php";
include "c_almacenM.php";
include "c_productosV.php";
include "c_comprasV.php";
include "c_lotesV.php";
include "c_almacenV.php";
include "c_clientes.php";
include "c_empleados.php";
include "c_gastos.php";
include "c_contado.php";
include "c_costosR.php";
include "c_listaventas.php";
class controller {
	protected $paginab;
	public function _layouts(){
		$usuario = $_SESSION['nombre_tel'];
		$noempre = $_SESSION['id_cliente'];
		$foto = "assets/img/avatar7.gif";
		if($_SESSION['foto_tel'] != ""){
			$foto = "archivos/fotosUsuarios/".$_SESSION['foto_tel']."";
		}
		$pagina = file_get_contents('vistas/v_html.php');
		//$botonSesion = file_get_contents('vistas/v_cerrarSesion.php');
		$contacta = file_get_contents('vistas/v_contactanos.php');
		//$envia = file_get_contents('vistas/v_enviar.php');			
		$menu = file_get_contents('vistas/v_menu.php');
		$buscador = file_get_contents('vistas/v_buscador.php');
		$scripts = file_get_contents('vistas/v_scripts.php');
		//$botonSesion = str_replace('#usuario#',$usuario, $botonSesion);
		//$pagina = str_replace('#usuario#',$usuario, $pagina);
		//$pagina = str_replace('#bsesion#',$botonSesion, $pagina);
		$pagina = str_replace('#menu#',$menu,$pagina);
		$pagina = str_replace('#buscador#',$buscador,$pagina);
		$pagina = str_replace('#usuario#',$usuario,$pagina);
		$pagina = str_replace('#noempresa#'," ".$noempre,$pagina);
		$pagina = str_replace('#fotoUsuario#',$foto,$pagina);
		$pagina = str_replace('#scripts#',$scripts,$pagina);
		$pagina = str_replace('#contactanos#',$contacta,$pagina);
		//$pagina = str_replace('#enviar#',$envia,$pagina);
		$pagina = str_replace('#login#',"",$pagina);
		$pagina = str_replace('full-lg','leftMenu nav-collapse',$pagina);
		return $pagina;
	}
	
	public function _vprincipal(){
		$paginab = $this->_layouts();
		$paginab = str_replace('#contenido#',"<div id='divimginicio' style=''><center><img style='width: 350px;' id='imginicio' src='vistas/images/logoPaloma3.png' alt='Logo IPA'></img></center></div>",$paginab);
		$paginab = str_replace('#titulo#',"inicio", $paginab);
		return $paginab;
	}

	public function _vevento($evento,$nomPagina){
		extract($_POST);
		$npagina = explode("_",$nomPagina);
		$cclase = new $npagina[1]();
		$nevento = _.$evento;
		$cclase->$nevento();
	}
	
	/*public function _vevento($evento){
		extract($_POST);
		$npagina = explode("_",$nomPagina);
		$cclase = new $npagina[1]();
		$nevento = _.$evento;
		$paginab = $this->_contenido($nomPagina);

		$elmensaje = $cclase->$nevento();
		$elmensajeB = explode("#",$elmensaje);
		$mano = "thumbs-up";
		if($elmensajeB[1] == "si"){
			$paginab = str_replace('id="btnAlertas" data-theme="primary"','id="btnAlertas" data-theme="danger"', $paginab);
			$mano = "thumbs-down";
		}
		$paginab = str_replace('alertas("");','alertas("<span style=\"font-size:40px;margin-right:20px;height:100%;float: left\" class=\"glyphicon glyphicon-'.$mano.'\"></span> <span> '.$elmensajeB[0].'</span>");', $paginab);
		
		//$paginab = str_replace('alertas("");','alertas("<span style=\"font-size:40px;margin-right:20px;height:100%;float: left\" class=\"glyphicon glyphicon-hand-right\"></span> <span> '.$elmensaje.'</span>");', $paginab);
		$paginab = str_replace('//notificacion','$("#mensajeNotif").trigger("click");', $paginab);
		return $paginab;
	}*/
	
	public function _contenido($npagina){
		$laPagina = file_get_contents('vistas/'.$npagina.'.php');
		$cclase = explode("_",$npagina);
		$ousuarios = new $cclase[1]();
		$reporte = $ousuarios->_reporte();
		$paginab = str_replace('#nomReporte#',$reporte,$laPagina);
		if(method_exists($ousuarios,'_reporteb')){
			$reporteb = $ousuarios->_reporteb();
			$paginab = str_replace('#nomReporteb#',$reporteb,$paginab);
		}
		return $paginab;
	}
	
	public function _consulta($pagina){
		$oobjeto = new $pagina();
		$oobjeto->_consulta();
	}
	
	public function _reporte($pagina,$reporte){
		$oobjeto = new $pagina();
		$nreporte = _.$reporte;
		echo $oobjeto->$nreporte();
	}
	
	public function _consultaValidar($pagina,$campo,$valo){
		$oobjeto = new $pagina();
		$oobjeto->_consultaValidar($campo,$valo);
	}
	
	public function _loginVista(){
		$contenido = file_get_contents('vistas/v_login.php');
		$pagina = file_get_contents('vistas/v_html.php');
		$scripts = file_get_contents('vistas/v_scripts.php');
		$contacta = file_get_contents('vistas/v_contactanos.php');
		$pagina = str_replace('#login#',$contenido, $pagina);
		$pagina = str_replace('#scripts#',$scripts, $pagina);
		$pagina = str_replace('#contactanos#',$contacta, $pagina);
		$pagina = str_replace('#menu#',"", $pagina);
		$pagina = str_replace('#buscador#',"",$pagina);
		$pagina = str_replace('#contenido#',"", $pagina);
		$pagina = str_replace('#enviar#',"", $pagina);
		$pagina = str_replace('leftMenu nav-collapse in',"full-lg", $pagina);
		$pagina = str_replace('#titulo#',"Inicia sesi&oacute;n", $pagina);
		return $pagina;
	}

	public function _login(){
		$clogin = new usuario();
		extract($_POST);
		$clogin->_validar($usr, $pwd, $idc);
	}

	public function _logout(){
		$clogout = new usuario();
		$clogout->_logout();
	}

	public function _cambiarcontrasena(){
		extract($_POST);
		$ccambiar = new usuarios();
		$elmensaje = $ccambiar->_cambiar();
		$url = explode("=",$_SERVER['REQUEST_URI']);		
		$paginab = $this->_vprincipal();
		$paginab = str_replace('ELmensaje(0);','ELmensaje("'.$elmensaje.'", "'.$url[1].'");', $paginab);
		session_destroy();
		return $paginab;
	}
	
	public function _olvidocontra(){
		extract($_POST);
		$ccambiar = new usuarios();
		$elmensaje = $ccambiar->_olvidocontrasena();	
		$paginab = $this->_loginVista();
		$paginab = str_replace('ELmensaje(0);','ELmensaje("'.$elmensaje.'");$("#login").remove();', $paginab);
		return $paginab;
	}	
	
	public function _contactan(){
		extract($_POST);
		$mail_destinatario = 'webmaster.sigepfin@gmail.com';
		echo '<p class="dialogo">'.$correo.'</p>';
		if (isset ($correo)) {
			echo '<p class="dialogo">entra al if</p>';
			$headers .= "From: ".$correo. "rn";
			//if ( mail ($mail_destinatario, $asunto, "Nombre y apellidos : ".$nombre." Asunto: ".stripcslashes ($asunto)."n Mensaje :n ".stripcslashes ($mensaje), $headers )){
			if ( mail ($mail_destinatario, $asunto, "Nombre y apellidos : ".$nombre." <br> Asunto: ".$asunto."<br> Mensaje <br>".$mensaje, $headers )){
				echo '<p class="dialogo">Su mensaje a sido enviado correctamente. Gracias por contactar con nosostros</p>';
				echo "<script>history.back(-1);</script>";	
			}else{	
				echo '<p class="dialogo">Complete todos los campos para enviar el email</p>';
				echo "<script>history.back(-1);</script>";	
			}
		} 
	}

	public function _enviar() {
		extract($_POST);	
		$urlv = explode("=",$url);
		if ($ndias != ""){
			$omodelo = new m_modelo();
			date_default_timezone_set('America/Mexico_City');
			$lafecha = date("Y-m");
			$lafechaDia = date("d");
			if($lafechaDia >= $ndias){
				$fNotificacion = $lafecha."-".$ndias;
				$fNotificacion = date("Y-m-d", strtotime("$fNotificacion + 1 month"));
			}else{
				$fNotificacion = $lafecha."-".$ndias;
				$fNotificacion = date("Y-m-d", strtotime("$fNotificacion"));
			}		
			if($urlRepor == "general"){
				$selecReportes = explode("_",$urlv[1]);
				$selecReportesb = $selecReportes[1];
			}else{
				$selecReportesb = $urlRepor;
			}
			$query = ("insert into grecordatorios () VALUES (null, 'coberturas', '$correo', '$fNotificacion', '', '', '$asunto', '$ndias', '".$selecReportesb."');");
			$error = $omodelo->_insertar($query);
			if ($error == "si") {
				$elmensaje = "Error de registro";
			}else{
				$elmensaje = "Registro exitoso";
			}
		}else{
			$ero = $this->_enviarRepor($cadenamensaje, $correo, $asunto);
			if($ero == 0){
				$elmensaje = 'Su reporte esta siendo enviadofr en estos momentos';
			}else{
				$elmensaje = '¡¡ Hubo un error al enviar su reporte !! Consulte al administrador para resolverlo.';
			}
		}
		$paginab = $this->_contenido($urlv[1]);
		$paginab = str_replace('ELmensaje(0);','ELmensaje("'.$elmensaje.'", "'.$urlv[1].'");$(".datatabless").remove();', $paginab);
		return $paginab;
	}
	
	public function _enviarRepor($tabla, $correo, $asunto) {
		try {					 				
			//Especificamos los datos y configuración del servidor
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "ssl";
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465;
				 
			//Nos autenticamos con nuestras credenciales en el servidor de correo Gmail
			$mail->Username = "webmaster.sigepfin@gmail.com";
			$mail->Password = "yErTGvb14";
				 
			//Agregamos la información que el correo requiere
			$mail->From = "webmaster.sigepfin@gmail.com";
			$mail->FromName = "Administrador";
			$mail->Subject = $asunto;
			$mail->AltBody = "";
			$mail->MsgHTML($tabla);					
			$opciones = explode('~',$correo);
			foreach((array)$opciones as $destinatarios){
				$mail->addAddress($destinatarios);
				$mail->addBcc($destinatarios);
			}
			$mail->IsHTML(true);
			$mail->Send();
			//$error = "En unos minutos te llegara un correo con instrucciones...";
			$error = 0;
		} 
		catch (phpmailerException $e) {
			$error = 1;
			echo $e->errorMessage(); //Mensaje de error si se produjera.
		}
		return $error;
	}
	
	public function _movimientos($modulo,$movimiento,$descripcion){
		date_default_timezone_set('America/Mexico_City');
		$omodelo = new m_modelo();
		$fecha = date("y-m-d H:i:s");
		$usuario = $_SESSION['id_tel'];

		/*$userAgent = $_SERVER[HTTP_USER_AGENT];
		$userAgent = strtolower ($userAgent);
		if(strpos($userAgent, "windows") !== false) 
		{
		$cookie = "OS Client: Windows $_SERVER[REMOTE_ADDR]";
		} 
		if(strpos($userAgent, "linux") !== false) 
		{ 
		$cookie = "OS Client: Linux $_SERVER[REMOTE_ADDR]";
		} */
		//$PHP_OS = PHP_OS;
		//$olp = ", OS Server: $PHP_OS $_SERVER[SERVER_NAME]";
		
		$info= $this->_detect();
 
		$cookie .= "Sistema operativo: ".$info["os"];
		$cookie .= " <br>Navegador: ".$info["browser"];
		$cookie .= " <br>Versión: ".$info["version"];
		$cookie .= " <br>".$_SERVER['HTTP_USER_AGENT'];
		 
		if (isset($_SERVER["HTTP_CLIENT_IP"])){
            $ip =  $_SERVER["HTTP_CLIENT_IP"];
        }elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $ip =  $_SERVER["HTTP_X_FORWARDED_FOR"];
        }elseif (isset($_SERVER["HTTP_X_FORWARDED"])){
            $ip =  $_SERVER["HTTP_X_FORWARDED"];
        }elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){
            $ip =  $_SERVER["HTTP_FORWARDED_FOR"];
        }elseif (isset($_SERVER["HTTP_FORWARDED"])){
            $ip =  $_SERVER["HTTP_FORWARDED"];
        }else{
            $ip =  $_SERVER["REMOTE_ADDR"];
        }
		
		$qmovim = ("insert into movimientos () VALUES (null, '$usuario', '$modulo', '$movimiento', '$fecha', '$descripcion', '$cookie', '$ip');");
		$qmovimE = $omodelo->_insertar($qmovim);
	}

/**
 * Funcion que devuelve un array con los valores:
 *	os => sistema operativo
 *	browser => navegador
 *	version => version del navegador
 */
	function _detect(){
		$browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
		$os=array("WINDOWS","MAC","LINUX");
	 
		# definimos unos valores por defecto para el navegador y el sistema operativo
		$info['browser'] = "OTHER";
		$info['os'] = "OTHER";
	 
		# buscamos el navegador con su sistema operativo
		foreach($browser as $parent)
		{
			$s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
			$f = $s + strlen($parent);
			$version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
			$version = preg_replace('/[^0-9,.]/','',$version);
			if ($s)
			{
				$info['browser'] = $parent;
				$info['version'] = $version;
			}
		}
	 
		# obtenemos el sistema operativo
		foreach($os as $val)
		{
			if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
				$info['os'] = $val;
		}
	 
		# devolvemos el array de valores
		return $info;
	}
	
}
?>