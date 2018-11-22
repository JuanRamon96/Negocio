<?php 
require("PHPMailer/PHPMailerAutoload.php");
require 'modelo/m_modelo.php';


class formulario{

	private function email($destino, $asunto, $mensaje)
	{
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
		    //Server settings
		    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'smartpoint.contacto@gmail.com';                 // SMTP username
		    $mail->Password = 'smartpoint123';                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom('smartpoint.contacto@gmail.com', 'Sistema Inteligente de Venta');
		    $mail->addAddress($destino);     // Add a recipient

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $asunto;
		    $mail->Body    = $mensaje;
		    $mail->AltBody = $mensaje;

		    $mail->send();
		    //echo 'Message has been sent';
		} catch (Exception $e) {
		    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
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

    	$query = "INSERT INTO clientes VALUES (null,'$nombre','$apellidos','$celular','$telefono','$correo','$empresa','$domicilio','$pais','$estado','$ciudad','$cp','$giro','$paquete')";

    	$error = $omodelo->_crear($query);
		if ($error == "si") {
			$mensaje = "Error al guaradar negocio"; 
		}else{
			$query1 = "INSERT INTO usuarios (id_usuario, nombre, usuario, contrasena, estatus, permisos) VALUES (null, '$nombre $apellidos', '$correo', MD5('$newcontra'), 'Desbloqueado', '1,1,1,1;1,1,1,1;1,1,1,1;1,1,1,1;1,1,1,1;1,1,1,1;1,1,1,1;')";

	    	$error1 = $omodelo->_insertar($query1);
			if ($error1 == "si") {
				$mensaje = "Error al guaradar el usuario"; 
			}else{
				$mensaje = "El negocio se ha guardado";
				$this->email($correo, "Smartpoint", "<h2>Tu cuenta en Smartpoint ha sido creada</h2><p>Los datos de tu cuenta son los siguientes:</p><br><p>Usuario: $correo</p><br><p>Contraseña: $newcontra</p>");
				
			}
		}

		echo $mensaje;
    }

}

class Paises{

	public function _consultar() {
    	extract($_POST);
    	$omodelo = new m_modelo();

    	$query = "SELECT * FROM countries";

    	$row = $omodelo->_consultar($query);
		$filas = $omodelo->numerofilas;
		if ($row == "si") {
			$mensaje = "Error al Consultar pais"; 
		}else{
			echo "<option value='' selected disabled>Seleccione un País</option>";
			for ($i=0; $i < $filas ; $i++) { 
				 $mensaje = "<option value='".$row[$i]["id"]."'>".$row[$i]["name"]."</option>";
				 echo $mensaje;
			}
			
		}

		
    }
}

class SeleccionarEstado{

	public function _consultar() {
    	extract($_POST);
    	$omodelo = new m_modelo();

    	$query = "SELECT * FROM states WHERE country_id = $id";

    	$row = $omodelo->_consultar($query);
		$filas = $omodelo->numerofilas;
		if ($row == "si") {
			$mensaje = "Error al Consultar Estado"; 
		}else{
			echo "<option value='' selected disabled>Seleccione un estado</option>";
			for ($i=0; $i < $filas ; $i++) { 
				 $mensaje = "<option value='".$row[$i]["id"]."'>".$row[$i]["name"]."</option>";
				 echo $mensaje;
			}
			
		}

		
    }
}

class SeleccionarCiudad{

	public function _consultar() {
    	extract($_POST);
    	$omodelo = new m_modelo();

    	$query = "SELECT * FROM cities WHERE state_id = $id";

    	$row = $omodelo->_consultar($query);
		$filas = $omodelo->numerofilas;
		if ($row == "si") {
			$mensaje = "Error al Consultar Estado"; 
		}else{
			echo "<option value='' selected disabled>Seleccione una ciudad</option>";
			for ($i=0; $i < $filas ; $i++) { 
				 $mensaje = "<option value='".$row[$i]["id"]."'>".$row[$i]["name"]."</option>";
				 echo $mensaje;
			}
			
		}

		
    }
}
 ?>
