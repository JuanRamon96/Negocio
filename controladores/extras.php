<?php 
	
	# ############################################# #
	#                                               #
	#   			D E V E L O P E D 				#
	#   											#
	#   		    [Y]assin [T]aliouan 			#
	#                                               #
	# ############################################# #

	# BASE DATOS 
	$Config[]	=	'localhost';					# HOSTING
	$Config[]	=	'USER';				# USER PHPMYADMIN
	$Config[]	=	'PASS';					# PASS PHPMYADMIN
	$Config[]	=	'USER';			# NAME DATEBASE PHPMYADMIN
	
	error_reporting(0);								# ZERO REPORTS

	# CLASE DE CONEXION GLOBAL
	class SQL{
		private static $Host;
		private static $User;
		private static $Pass;
		private static $Base;

		public function __construct($Host_db,$User_db,$Pass_db,$Base_db){
			self::$Host = $Host_db;
			self::$User = $User_db;
			self::$Pass = $Pass_db;
			self::$Base = $Base_db;
		}

		public static function Conect(){
			global $DB;
			$DB = new mysqli(self::$Host, self::$User, self::$Pass, self::$Base);
			if($DB->connect_errno > 0){
    			die('Imposible conectar con la base de datos [' . $DB->connect_error . ']');
			}
		}

		public static function vB($Query){
			global $DB;
			$Consulta = mysqli_query($DB,"SET NAMES 'utf8'");
			$Consulta = mysqli_query($DB," ".$Query." ");
			return $Consulta;
		}
		
		public static function Snd($var){
			if(!is_array($var))
				return addslashes($var);
		
			$new_var = array();
		
			foreach($var as $k => $v)
				$new_var[addslashes($k)] = self::Snd($v);
			
				return $new_var;
		}

	}

	# CONEXION A LA BASE DE DATOS
	$DB = New SQL($Config[0], $Config[1], $Config[2], $Config[3]);
	SQL::Conect();

	# FUNCION PARA BUSQUEDA EN EL CONFIG
	function DB($var){
		$Boomar 		= SQL::vB("SELECT * FROM config");
		$bomardesign 	= mysqli_fetch_assoc($Boomar);
		$Bom 			= $bomardesign[$var];
		return $Bom;
	}

	# ENLACE DE LA WEB EN UNA VARIABLE "WWW"
	$WwW 	=	DB('www');
	$VvV 	=	DB('vpanel');

	# DEFINIMOS ENLACE DE LA WEB "WwW"
	define('WwW', ''.$WwW.'');
	# DEFINIMOS ENLACE DE LA ADMINISTRACION "VvV"
	define('VvV', ''.$VvV.'');

	# FECHA DE MEXICO (DF)
	date_default_timezone_set('America/Mexico_City');
	setlocale(LC_ALL, "es_ES");

	# ENCRIPTAMOS UNA VARIABLE
	function vCRIPT($encript){
        $special 	= htmlspecialchars($encript);
        $base 		= base64_encode($special);
        $entities 	= htmlentities($base);
        $md 		= md5($entities);
        $sha 		= sha1($md);
        $asl 		= addslashes($sha);
        $convert 	= convert_uuencode($asl);
        return $convert;
	}

	# LIMPIAMOS UNA CADENA DE STRINGS HTML JS
	function vCLEN($var){
		global $DB;
		$var = htmlentities($var);
		$var = mysqli_real_escape_string($DB,$var);
        return $var;
	}

	# LIMPIAMOS CADENAS SIN NUMERO NI ESPACIOS
	function vSPAC($vArea){
		$vArea = trim($vArea);
	    $vArea = str_replace(' ','',$vArea);
	    $vArea = vCLEN($vArea);
	    $vArea = preg_replace('/[0-9]+/', '', $vArea);
	    return $vArea;
	}
	
	# ALERTAS GENERALES CON TY = TIPO DE ALERTA (SUC = success, DAN = danger) & TT = TEXTO
	function vALERT($TT,$TY){
		if($TY == 'DAN'){
			echo '<div class="alert alert-danger" role="alert"><div class="fa fa-close" data-dismiss="alert"></div>
			<strong>Advertencia de error: </strong> '.$TT.' </div>';
		}else{
			echo '<div class="alert alert-success" role="alert"><div class="fa fa-close" data-dismiss="alert"></div>
			<strong>Acción con éxito: </strong> '.$TT.' </div>';
		}
	}

    function vHEADER($vX){
    	$xH = header('Location: '.$vX.'');
    	return $xH;
    }

	# REEDIRIGIMOS HACIA X LUGAR EN Y TIEMPO
	function vGO($X,$Y){
		echo '<meta http-equiv="Refresh" content="'.$Y.';url='.$X.'">';
	}

	# REFRESCAMOS LA MISMA PAGINA EN 1 SEGUNDO
    function vACT(){
        echo '<meta http-equiv="Refresh" content="1;url=">';
    }

    # ACORTAMOS UN "mysqli_fetch_assoc()"
    function vASSOC($vA){
    	$vB = mysqli_fetch_assoc($vA);
    	return $vB;
    }

    # ACORTAMOS UN "mysqli_num_rows()"
    function vNUM($vA){
    	$vB = mysqli_num_rows($vA);
    	return $vB;
    }

	# PROTECCION A PANEL
	function vSEC(){
		if($_SESSION['ID'] == NULL){
			$vXX = VvV."/home.php";
			echo vHEADER($vXX);
		}else{
			$vRANKID = $_SESSION['ID'];
		}
	}

    # NOS ASEGURAMOS DE QUE SEA UN NUMERO
    function vISNUM($vA){
    	if(is_numeric($vA) != TRUE){
    		echo vHEADER(WwW."/index.php");
    	}else{
    		$vB = $vA;
    		return $vB;
    	}
    }

    # BUSCAMOS DENTRO DE CATEGORIAS MEDIANTE ID
    function vCATS($vA,$vB){
    	$vAREA = SQL::vB("SELECT * FROM categorias WHERE id = '$vA'");
    	$vAA   = vASSOC($vAREA);
    	$cA    = $vAA[$vB];
    	return $cA;
    }

    # BUSCAMOS INFORMACION DE UN USUARIO MEDIANTE ID
    function vUS($vA,$vB){
    	$vUSER = SQL::vB("SELECT * FROM users WHERE id = '$vA'");
    	$vAA   = vASSOC($vUSER);
    	$cA    = $vAA[$vB];
    	return $cA;
    }

    # OBTENEMOS LA FECHA (AÑO-MES-DIA)
	function vTIME(){
		$DATE = date("Y-m-d");
		return $DATE;
	}

	# OBTENEMOS LA IP 
	function vIP(){
		if (isset($_SERVER["HTTP_CLIENT_IP"])){
            return $_SERVER["HTTP_CLIENT_IP"];
        }elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }elseif (isset($_SERVER["HTTP_X_FORWARDED"])){
            return $_SERVER["HTTP_X_FORWARDED"];
        }elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){
            return $_SERVER["HTTP_FORWARDED_FOR"];
        }elseif (isset($_SERVER["HTTP_FORWARDED"])){
            return $_SERVER["HTTP_FORWARDED"];
        }else{
            return $_SERVER["REMOTE_ADDR"];
        }
	}

	# OBTENEMOS EL TOTAL DE REGISTROS DE UNA TABLA ($W = WHERE)
	function vCOUNT($T,$W){
		# SI NO TENEMOS UN WHERE
		if($W == NULL OR $W == '0'){
			$vCOUNT = SQL::vB("SELECT * FROM '$T'");
		}else{
			$vCOUNT = SQL::vB("SELECT * FROM '$T' '$W'");
		}
			$vCNT = vNUM($vCOUNT);
			return $vCNT;
	}
	
	function vMobil(){
		$es_movil = '0';
		if(preg_match('/(android|wap|phone|ipad)/i',strtolower($_SERVER['HTTP_USER_AGENT']))){
			$es_movil++;
		}
		if($es_movil>0){
			$res = 'Estás usando un móvil :P';
		}else{
			$res = 'Estás usando un pc :)';
		 }
		 return $res;
	}
?>