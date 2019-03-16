<?php
//require 'contramail/class.phpmailer.php';
//require 'contramail/class.smtp.php';
require("PHPMailer/PHPMailerAutoload.php");
class usuarios {

	private function _enviar($user, $password) {
		
		
		 try {
			//Especificamos los datos y configuración del servidor			
			$mail = new PHPMailer();
			$mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;  

			//Nos autenticamos con nuestras credenciales en el servidor de correo Gmail
			$mail->Username = "smartpoint.contacto@gmail.com";
			$mail->Password = "smartpoint123";
			 
			//Agregamos la información que el correo requiere
			$mail->From = "smartpoint.contacto@gmail.com";
			$mail->FromName = "Administrador";
			$mail->Subject = "Nueva contrase&ntilde;a de Smart Point";
			$link = 'https://SmartPoint.com.mx/siv';
			$mail->AltBody = "";
			$mail->MsgHTML('<p>Tu usuario es: <b>'. $user .'</b></p> <br> <p>Tu nueva contrase&ntilde;a es: <b>'. $password .'</b></p> <br> <p> Inicia sesi&oacute;n en el siguiente link: </p> <a href="'.$link.'">'.$link.'</a>');
			$mail->AddAddress($user, $user);
			$mail->IsHTML(true);
			 
			//Enviamos el correo electrónico
			$mail->Send();
            return "En un momento te llegara un correo con tu contraseña";
        }
		catch (phpmailerException $e) {
            echo $e->errorMessage(); //Mensaje de error si se produjera.
        }
		
		/*
        try {
			//Especificamos los datos y configuración del servidor			
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ));
			//$mail->SMTPSecure = "ssl";
			$mail->Host = "smtp.gmail.com";
			//$mail->Port = 587;
			$mail->Port = 465;

			//Nos autenticamos con nuestras credenciales en el servidor de correo Gmail
			$mail->Username = "webmaster.teve@gmail.com";
			$mail->Password = "PotYYgrf14";
			 
			//Agregamos la información que el correo requiere
			$mail->From = "webmaster.teve@gmail.com";
			$mail->FromName = "Administrador";
			$mail->Subject = "Nueva contrase&ntilde;a de Confecciones Lizareli";
			$link = 'http://confeccioneslizareli.com';
			$mail->AltBody = "";
			$mail->MsgHTML('<p>Tu usuario es: <b>'. $user .'</b></p> <br> <p>Tu nueva contrase&ntilde;a es: <b>'. $password .'</b></p> <br> <p> Inicia sesi&oacute;n en el siguiente link: </p> <a href="'.$link.'">'.$link.'</a>');
			$mail->AddAddress($user, $user);
			$mail->IsHTML(true);
			 
			//Enviamos el correo electrónico
			$mail->Send();
            return "En un momento te llegara un correo con tu contraseña";
        }
		catch (phpmailerException $e) {
            echo $e->errorMessage(); //Mensaje de error si se produjera.
        }
		*/
    }
	
	private function _generacontra () {
		$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$newcontra = "";
		for($i=0;$i<8;$i++) {
		$newcontra .= substr($cadena,rand(0,62),1);
		}
			return $newcontra;     
    }
	
	public function _insertar(){
		$omodelo = new m_modelo();
		extract($_POST);
		$permisos = "";
		$Pproductos = array($proA,$proM,$proE,$proV);
		$Pcompras = array($comA,$comM,$comE,$comV);
		$Pventas = array($venA,$venM,$venE,$venV);
		$Pclientes = array($cliA,$cliM,$cliE,$cliV);
		$Pempleados = array($empA,$empM,$empE,$empV);
		$Pproveedores = array($provA,$provM,$provE,$provV);
		$Pusuarios = array($usuA,$usuM,$usuE,$usuV);
		$Ppermisos = array($Pproductos,$Pcompras,$Pventas,$Pclientes,$Pempleados,$Pproveedores,$Pusuarios);
		
			foreach($Ppermisos as &$Parreglo){
				$permiso = "";
				foreach($Parreglo as &$Parreglob){
					if(isset($Parreglob)){
						if ($permiso == ""){
							$permiso.="1";
						}else{
							$permiso.=",1";
						}		
					}else {
						if ($permiso == ""){
							$permiso.="0";
						}else{
							$permiso.=",0";
						}
					}
				}
				$permisos.= $permiso.";";
			}
		
		$contrasena = $this->_generacontra();
		$query = ("insert into usuarios (id_usuario, nombre, usuario, contrasena, estatus, permisos) VALUES (null, '$nombre', '$correo', MD5('$contrasena'), '$estatus', '$permisos');");
		$error = $omodelo->_insertar($query);
		
		$query2 = ("SELECT * FROM usuarios order by id_usuario desc limit 1;");
		$row = $omodelo->_consultar($query2);
		
		if ($error == "si") {
			$mensaje = "Error de registro";
		}else{
			$mensaje = $this->_enviar($correo, $contrasena);
		}
		echo $mensaje."#".$error."#".$row[0]['id_usuario'];
	}
	
	public function _modificar(){
		$omodelo = new m_modelo();
		extract($_POST);
		$permisos = "";		
		$Pproductos = array($proA,$proM,$proE,$proV);
		$Pcompras = array($comA,$comM,$comE,$comV);
		$Pventas = array($venA,$venM,$venE,$venV);
		$Pclientes = array($cliA,$cliM,$cliE,$cliV);
		$Pempleados = array($empA,$empM,$empE,$empV);
		$Pproveedores = array($provA,$provM,$provE,$provV);
		$Pusuarios = array($usuA,$usuM,$usuE,$usuV);
		$Ppermisos = array($Pproductos,$Pcompras,$Pventas,$Pclientes,$Pempleados,$Pproveedores,$Pusuarios);

		if(!isset($M_chtodos)){
			foreach($Ppermisos as &$Parreglo){
				$permiso = "";
				foreach($Parreglo as &$Parreglob){
					if(isset($Parreglob)){
						if ($permiso == ""){
							$permiso.="1";
						}else{
							$permiso.=",1";
						}		
					}else {
						if ($permiso == ""){
							$permiso.="0";
						}else{
							$permiso.=",0";
						}
					}
				}
				$permisos.= $permiso.";";
			}
		}else {
			$permisos = "9";
		}
		$query = ("UPDATE usuarios set nombre='$nombre', usuario='$correo', estatus='$estatus', permisos='$permisos' where id_usuario = '$idusuario';");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error de Modificaci&oacute;n"; 
		}else{
			$mensaje = "El usuario se modifico con &eacute;xito";
		}
		echo $mensaje."#".$error."#".$idusuario;
	}

	public function _eliminar(){
		$omodelo = new m_modelo();
		extract($_POST);
		if(file_exists($ligaFotoB)){
			unlink($ligaFotoB);			
		}
		
		$query = ("DELETE FROM usuarios WHERE id_usuario = '$idElimina';");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error de registro de usuario";
		}else{
			$mensaje = "Usuario eliminado";			
		}
		echo $mensaje."#".$error;
	}
	
	public function _foto(){
		$omodelo = new m_modelo();
		extract($_POST);
		if (!empty($_FILES)) {
			//var_dump($_FILES);
			if($ligaFoto != 0){
				$dir = "archivos/fotosUsuarios/".$ligaFoto;
				if(file_exists($dir)){
					unlink($dir);
				}
			}
			if($_FILES["foto"]["size"] > 0){
				$tipob = $_FILES["foto"]["type"];
				$archivob = $_FILES["foto"]["name"];
				$prefijo = substr(md5(uniqid(rand())),0,4);
				$archiv = explode(".",$archivob);
				if ($nombre != "") {
					$nombreEx = explode(" ",$nombre);
					for($w=0;$w<count($nombreEx);$w++){
						$nombreFotoB = $nombreFotoB.$nombreEx[$w];
					}
					$nombreFoto = $nombreFotoB.".".$archiv[1];
					$liga = $prefijo."_".$nombreFoto;
					$destino =  "archivos/fotosUsuarios/".$liga;
					if (copy($_FILES['foto']['tmp_name'],$destino)) {									
						echo "Archivo subido: ".$nombreFoto."";
					} else {
						echo "Error 1 al subir el archivo";
					}
				} else {
					echo "Error 2 al subir archivo";
				}
			}
			$query = ("UPDATE usuarios set foto='$liga' where id_usuario = '$idR';");
			$error = $omodelo->_insertar($query);
			
		}
	}
	
	public function _reporte(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM usuarios;");
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
									<th id="thprimero" style="border-radius: 5px 0 0;">Nombre</th>
									<th>Usuario</th>
									<th>Estatus</th>
									<th>Permisos</th>
									<th style="border-radius: 0 5px 0 0;">Acci&oacute;n</th>
								</tr>
							</thead>
							<tbody id="imprimirTb" align="center">'; 
			
			$contador = 1;
			$row = $omodelo->_consultar($query);
			for($i=0;$i<$numerofilas;$i++){
				if($row[$i]["estatus"] == "Bloqueado"){
					$estatus1 = '<span class="label label-danger">Bloqueado</span>';
				}else{
					$estatus1 = '<span class="label label-success">Desbloqueado</span>';
				}
				
				if($row[$i]["permisos"] == "9"){
					$permisosBD = "Todos";
				}else{
					$permisosBD = explode(";",$row[$i]["permisos"]);			
					$permisosOn = array();
					$longCadena = count($permisosBD);
					$repor = $longCadena - 2;
					for($j=0;$j<$longCadena;$j++){
						$permisosBDB = explode(",",$permisosBD[$j]);
						if($j != $repor){
							if($permisosBDB[0] == "1"){
								$permisosOn[$j] .= "<td class='PermisUsu'><span style='padding:2px' class='btn btn-theme-inverse btn-info'><i class='fa fa-check'></i></span></td>";
							}else{
								$permisosOn[$j] .= "<td class='PermisUsu'><span style='padding:2px' class='btn btn-danger btn-danger'><i class='fa fa-times'></i></span></td>";
							}
							if($permisosBDB[1] == "1"){
								$permisosOn[$j] .= "<td class='PermisUsu'><span style='padding:2px' class='btn btn-theme-inverse btn-info'><i class='fa fa-check'></i></span></td>";
							}else{
								$permisosOn[$j] .= "<td class='PermisUsu'><span style='padding:2px' class='btn btn-danger btn-danger'><i class='fa fa-times'></i></span></td>";
							}
							if($permisosBDB[2] == "1"){
								$permisosOn[$j] .= "<td class='PermisUsu'><span style='padding:2px' class='btn btn-theme-inverse btn-info'><i class='fa fa-check'></i></span></td>";
							}else{
								$permisosOn[$j] .= "<td class='PermisUsu'><span style='padding:2px' class='btn btn-danger btn-danger'><i class='fa fa-times'></i></span></td>";
							}
							if($permisosBDB[3] == "1"){
								$permisosOn[$j] .= "<td class='PermisUsu'><span style='padding:2px' class='btn btn-theme-inverse btn-info'><i class='fa fa-check'></i></span></td>";
							}else{
								$permisosOn[$j] .= "<td class='PermisUsu'><span style='padding:2px' class='btn btn-danger btn-danger'><i class='fa fa-times'></i></span></td>";
							}
						}else{
							if($permisosBDB[0] == "1"){
								$permisosOn[$j] .= " PT - ";
							}
							if($permisosBDB[1] == "1"){
								$permisosOn[$j] .= " CL - ";
							}
							if($permisosBDB[2] == "1"){
								$permisosOn[$j] .= " RS ";
							}
							if($permisosBDB[2] == "1"){
								$permisosOn[$j] .= " CR ";
							}
						}
					}
					
					
					$tablaPermisos = '	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover tablain tabPermA nowrap">											
											<tr><th style="width: 0px;">M&oacute;dulo</th><th>A</th><th>M</th><th>V</th><th>E</th></tr>
											<tr class="tabPermis">
												<td>Productos</td>'.$permisosOn[0].'
											</tr>
											<tr class="tabPermis">
												<td>Compras</td>'.$permisosOn[1].'
											</tr>
											<tr class="tabPermis">
												<td>Ventas</td>'.$permisosOn[2].'
											</tr>														
											<tr class="tabPermis">
												<td>Expedientes</td>'.$permisosOn[3].'
											</tr>	
											<tr class="tabPermis">
												<td>Recordatorios</td>'.$permisosOn[4].'
											</tr>
											<tr class="tabPermis">
												<td>Usuarios</td>'.$permisosOn[5].'
											</tr>																			
										</table>
										<div class="table-responsive col-sm-12">
											<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover tablain tabPermB">
											<tr><th>Reporte</th><th>Costos</th><th>Costo por ciudad</th><th>Otro repor</th><th>Otro repor</th><th>Otro repor</th></tr>
											<tr class="tabPermis">
												<td>Reportes</td>
												<td>'.$permisosOn[7].'</td>
											</tr>										
										</table>
										</div>';
						
					$permisosBD = $tablaPermisos;
					
				}	
				$permi .= '
				<div id="ventaPermisos'.$i.'" class="modal fade" tabindex="-1">
					<div class="modal-header bg-inverse bd-inverse-darken">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
						<h4 class="modal-title">Permisos del usuario: <strong>'.$row[$i]["nombre"].'</strong></h4>
					</div>
					<div class="modal-body" style="background-color: #ffffff;">
					<div style="text-align:center;">
						<b>A: </b>Agregar | <b>M: </b>Modificar | <b>V: </b>Ver | <b>E: </b>Eliminar
					</div>
					<br>	
						'.$permisosBD.'
					</div>
				</div>
				';
				if($row[$i]["foto"] == ""){
					$laFoto = 'assets/img/avatar7.gif';
				}else{
					$laFoto = 'archivos/fotosUsuarios/'.$row[$i]["foto"].'';
				}
				$lista2 .= '										
								<tr>
									<td class=""><a href="'.$laFoto.'" title="'.$row[$i]["nombre"].'" class="preview_fancybox"><img id="fot'.$row[$i]["id_usuario"].'" alt="" style="width:60px" src="'.$laFoto.'" class="circle"/></a><br>'.$row[$i]["nombre"].'</td>
									<td class="">'.$row[$i]["usuario"].'</td>
									<td class="">'.$estatus1.'</td>									
									<td class="tablaPermisos">
										<button type="button" class="ventaPermisos btn btn-theme-inverse btn-info" data-effect="md-flipHor" data-target="'.$i.'" ><i class="fa fa-eye"></i>Ver permisos</button>
									</td>
									<td>
										<span class="tooltip-area">
											<button id="mod-'.$row[$i]["id_usuario"].'" type="button" class="ventaModificar btn btn-theme-inverse btn-info" data-effect="md-flipHor" data-target="0"><i class="fa fa-pencil-square-o"></i></button>
											<button id="eli-'.$row[$i]["id_usuario"].'" type="button" class="ventaEliminar btn btn-danger btn-danger" data-effect="md-flipHor" data-target="0"><i class="fa fa-trash-o"></i></button>
										</span>
									</td>
								</tr>';
				$contador = $contador + 8;
				$permisostodo = "";
				$permisosOn = "";
				$estatus1 = "";
				$estatus2 = "";
			}
		}
		$lista3 = '</tbody>
						</table>
						</div>';
		$lista = $lista1.$lista2.$lista3.$permi;
		return utf8_encode($lista);
		//<td>'.$permisosBD.'</td>
	}		
	
	public function _consulta(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM usuarios;");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "<p class='dialogo'>Error de consulta</p>";
		}else{
			 for($i=0;$i<$numerofilas;$i++){
				$a[] = $numerofilas;						// 0
				$a[] = "14";								// 1
				$a[] = $row[$i]["id_usuario"];				// 2
				$a[] = $row[$i]["nombre"];					// 3
				$a[] = $row[$i]["usuario"];					// 4
				$a[] = $row[$i]["contrasena"];				// 5
				$a[] = $row[$i]["estatus"];					// 6
				$a[] = $row[$i]["permisos"];				// 7
				$a[] = $row[$i]["intentos"];				// 8
				$a[] = $row[$i]["ultimointento"];			// 9
				$a[] = $row[$i]["foto"];					// 10
				$a[] = $row[$i]["sesion"];					// 11
				$a[] = $row[$i]["tiempo_inicio"];			// 12
				$a[] = $row[$i]["tiempo_final"];			// 13
			 }
		}
		foreach($a as $name){
			echo $name . "~";
		}
	}

	public function _consultaValidar($campo,$valo){
		$omodelo = new m_modelo();
		$query = ("SELECT * FROM usuarios where ".$campo." = '".$valo."';");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		echo $numerofilas;
	}
	
	public function _cambiar(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("UPDATE usuarios set contrasena=MD5('$contra2') where id_usuario = ".$_SESSION['id_p'].";");
		$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error de Modificaci&oacute;n"; 
		}else{
			$mensaje = "Tu contrase&ntilde;a se ha cambiado con &eacute;xito <br> *Inicia sesi&oacute;n para continuar"; // ::::::::::::::: MODIFICAR MENSAJES
		}
		echo $mensaje."#".$error;
	}

	public function _olvidocontrasena(){
		$omodelo = new m_modelo();
		extract($_POST);
		$query = ("SELECT * FROM usuarios where usuario = '".$correo2."';");
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($numerofilas == 0) {
			$mensaje = "EL usuario: '".$correo2."' no se encuentra registrado"; 
		}else{
			$contrasena = $this->_generacontra();
			$queryb = ("UPDATE usuarios SET contrasena = MD5('".$contrasena."') where usuario = '".$correo2."';");
			$rowb = $omodelo->_insertar($queryb);
			$this->_enviar($correo2,$contrasena);
			$mensaje = "En un momento te llegar&aacute; un correo con tu nueva contrase&ntilde;a"; // ::::::::::::::: MODIFICAR MENSAJES
		}
		return $mensaje;
	}
	
	private function _logout(){
		echo '<script> document.location="http://confeccioneslizareli.com"</script>';
	}
	
}
?>
