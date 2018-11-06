<?php 
require 'contramail/class.phpmailer.php';
require 'contramail/class.smtp.php';
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
				$mail->Username = "webmaster.teve@gmail.com";
				$mail->Password = "PotYYgrf14";
				 
				//Agregamos la información que el correo requiere
				$mail->From = "webmaster.teve@gmail.com";
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
	
	private function _generacontra () {
		$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$newcontra = "";
		for($i=0;$i<8;$i++) {
		$newcontra .= substr($cadena,rand(0,62),1);
		}
			return $newcontra;     
    }
}


 ?>