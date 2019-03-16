<?php
include 'modelo/m_modelo.php';
class usuario {
	public function _validar($usuario, $password, $idcliente){
		date_default_timezone_set('America/Mexico_City');
		$omodelo = new m_modelo();	
		$resultados = ("select * from usuarios where usuario = '$usuario' and contrasena = MD5('$password');");
		//$resultados = ("select * from usuarios;");
		$row = $omodelo->_consultar($resultados);
		$numerofilas = $omodelo->numerofilas;
			if ($numerofilas !=0){
				if ($row[0]['estatus'] == 'Bloqueado'){
					$tiempoactual = date("y-m-d H:i:s");
					$ultim = $row[0]['ultimointento'];
					$queryg = "select time_to_sec(timediff('$tiempoactual','$ultim'))as intervalo;";
					//$resultadog = mysql_query ($queryg);
					$rowg = $omodelo->_consultar($queryg);
					$error = $omodelo->error;
					if ($error == "si") {
						//echo "<p class='dialogoa' style='z-index:100'>'Usuario y contrase\u00f1a incorrecto'</p>";
						echo "<script>inicioSe('false');</script>";
					}	
					if ($rowg[0][0] <= 7199){
						echo "<p class='dialogoa' style='z-index:100'> El usuario: " .$usuario. " esta bloqueado, cominicate con el administrador para ser desbloqueado</p>";
						return false;
					}else{
						$queryh = "update usuarios set estatus = 'Desbloqueado';";
						$errorb = $omodelo->_insertar($queryh);
						if ($errorb == "si") {
							echo "<p class='dialogoa'>Error de consulta</p>";
						}
					}
				}
				$queryf = "update usuarios set ultimointento = '', intentos = 0 where usuario = '$usuario';";
				$errorf = $omodelo->_insertar($queryf);
				if ($errorf == "si") {
				  //echo "<p class='dialogoa' style='z-index:100'>Usuario y contrase\u00f1a incorrecto</p>";
				  echo "<script>inicioSe('false');</script>";
				}
				//echo "<script> alert ('Bienvenido: " .$usuario."');</script>";
				session_start();
				$_SESSION['user_tel'] = $usuario;
			    $_SESSION['id_tel'] = $row[0]['id_usuario'];
			    $_SESSION['cusuario_tel'] = $row[0]['usuario'];    
			    $_SESSION['contrasena_tel'] = $row[0]['contrasena'];
				$_SESSION['nombre_tel'] = $row[0]['nombre'];
				$_SESSION['foto_tel'] = $row[0]['foto'];
				//$_SESSION['permiso_p'] = $row[0]['permisos'];
				$permisos = $row[0]['permisos'];
				
				if($permisos == "9"){
					$permisosBD = "Todos";
				}else{
					$permisosBD = explode(";",$permisos);
					$_SESSION['permiso_tel'] = array();
					for($j=0;$j<count($permisosBD);$j++){
						$permisosBDB = explode(",",$permisosBD[$j]);
						$c=0;
						foreach((array)$permisosBDB as $valor){
								$_SESSION['permiso_tel'][$j][$c] = $valor;				
							$c++;
						}
					}					
				}
				$inicio = date("Y-m-d H:i:s");
				$queryI = ("UPDATE usuarios SET sesion = '1', tiempo_inicio='".$inicio."' where id_usuario = '".$row[0]['id_usuario']."';");
				$rowI = $omodelo->_insertar($queryI);
				//echo "<script> document.location = 'index.php' </script>";
				echo "<script>inicioSe('true');</script>";
			}
		
			if($numerofilas == 0){
				$fecha = date("y-m-d H:i:s");
				$query = "update usuarios set ultimointento = '$fecha', intentos = intentos + 1 where usuario = '$usuario';";
				$resultadob = $omodelo->_insertar($query);
				if ($resultadob == "si") {
				  //echo "<p class='dialogoa' style='z-index:100'>Usuario y contrase\u00f1a incorrecto </p>";
				  echo "<script>inicioSe('false');</script>";
				}
				$queryb = "select intentos from usuarios where usuario = '$usuario';";
				$rowb = $omodelo->_consultar($queryb);
				$resultadoc = $omodelo->error;
				if ($resultadoc == "si") {
				    //echo "<p class='dialogoa' style='z-index:100'>Usuario y contrase\u00f1a incorrecto 23</p>";
					echo "<script>inicioSe('false');</script>";
				}	
				if($rowb[0]['intentos'] >= 5){
					$queryd = "update usuarios set estatus = 'Bloqueado' where usuario = '$usuario';";
					$resultadod = $omodelo->_insertar($queryd);
					if ($resultadod == "si") {
				    	echo "<p class='dialogoa' style='z-index:100'>Has superado el n&uacute;mero maximo de intentos de inicio de sesi&oacute;n. Tu cuenta ha sido bloqueada</p>";
					}
					echo "<p class='dialogoa' style='z-index:100'>Has superado el n&uacute;mero maximo de intentos de inicio de sesion. Tu cuenta ha sido bloqueada</p>";
				}
				//echo "<p class='dialogoa' style='z-index:100'>Tu usuario o contrase&ntilde;a no son validos</p>";
				echo "<script>inicioSe('false');</script>";
			}			
	}
	
	public function _logout(){
		session_start();
		$omodelo = new m_modelo();	
		date_default_timezone_set('America/Mexico_City');
		$final = date("Y-m-d H:i:s");
		$queryI = ("UPDATE usuarios SET sesion = '0', tiempo_final='".$final."' where id_usuario = '".$_SESSION['id_tel']."';");
		$rowI = $omodelo->_insertar($queryI);
		$_SESSION = array();
		session_destroy();
		echo '<script> document.location="index.php"</script>';
	}
	
}
?>
