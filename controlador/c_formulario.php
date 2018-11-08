<?php 
require 'contramail/class.phpmailer.php';
require 'contramail/class.smtp.php';
require 'modelo/m_modelo.php';
class formulario{

	private function _enviar($user, $password) {
	    try {
				//Especificamos los datos y configuración del servidor			
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = "ssl";
				$mail->Host = "smtp.gmail.com";
				//$mail->Port = 587;
				$mail->Port = 465;

				//Nos autenticamos con nuestras credenciales en el servidor de correo Gmail
				$mail->Username = "contacto@smartpoint.com.mx";
				$mail->Password = "5Mm01_vkwyv3";
				 
				//Agregamos la información que el correo requiere
				$mail->From = "contacto@smartpoint.com.mx";
				$mail->FromName = "Administrador";
				$mail->Subject = "Nueva contrase&ntilde;a de SmartPoint";
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
	}
	

    public function _insertar() {
    	extract($_POST);
    	$omodelo = new m_modelo();

    	$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$newcontra = "";
		for($i=0;$i<8;$i++) {
			$newcontra .= substr($cadena,rand(0,62),1);
		}

    	$query = "INSERT INTO clientes VALUES (null,'$nombre','$apellidos','$celular','$telefono','$correo','$empresa','$domicilio','$pais','$estado','$ciudad','$cp','$giro','$usuario','$newcontra','$paquete')";

    	$error = $omodelo->_insertar($query);
		if ($error == "si") {
			$mensaje = "Error al guaradar negocio"; 
		}else{
			$mensaje = "El negocio se ha guaradado";
		}

		echo $mensaje;
    }
}


 ?>