<?php
include '../modelo/m_modelo.php';
include "c_funciones.php";
include "c_usuarios.php";
include "c_polizas.php";
include "c_proveedores.php";
include "c_siniestros.php";
include "c_reportes.php";
include "c_pagos.php";
include "c_expedientes.php";
include "c_recordatorios.php";
include "c_incisos.php";
class enviarecordatorios{
	
	public function _enviarecordatorios(){
		$omodelo = new m_modelo();
		$fechaactual = date("Y-m-d");
		$query = ("SELECT * FROM grecordatorios where gestor='polizas';");	// ::::::::::::::: MODIFICAR EL QUERY
		$row = $omodelo->_consultar($query);
		$numerofilas = $omodelo->numerofilas;
		if ($row == "si") {
			echo "Error de consulta";
		}else{
			for($i=0;$i<$numerofilas;$i++){
				$b = $row[$i]['id_recordatorio'];
				$p = $row[$i]['correos'];
				$fecha = $row[$i]['fecha_notificacion'];
				$y = $row[$i]['observaciones'];
				$m = $row[$i]['asunto'];
				$n = $row[$i]['dias'];
				$r = $row[$i]["reporte"];
				//$fecha = $q[$i];
// ******************************************************************************************************************************************************					
				$querya = "SELECT TIMESTAMPDIFF(YEAR,'$fechaactual','$fecha') as 'fecAnio';";
				$rowa = $omodelo->_consultar($querya);
				if($rowa[0]['fecAnio'] <= 0){
								
					$queryb = "SELECT TIMESTAMPDIFF(MONTH,'$fechaactual','$fecha') as 'fecMes';";
					$rowb = $omodelo->_consultar($queryb);
					if($rowb[0]['fecMes'] <= 0){
															
						$queryc = "SELECT TIMESTAMPDIFF(DAY,'$fechaactual','$fecha') as 'fecDia';";
						$rowc = $omodelo->_consultar($queryc);
						if($rowc[0]['fecDia'] <= 0){																									
							$correoss = str_replace('~',',', $p);					
							if($r != "0"){
								$clase = new reportes();
								switch($r){
									case 'superBienes':
										$repo = '_'.$r;
										$tabla = $clase->$repo();
										$titulo = 'Reporte de Relaci&oacute;n Patrimonial';
									break;
									default :
										$clase = new $r();
										$tabla = $clase->_reporte();
										$titulo = 'Reporte de '.$r;
									break;
								}								
								$tabla = str_replace('vistas/images/icons/print.png',' ', $tabla);
								$tabla = str_replace('vistas/images/icons/mail.png',' ', $tabla);
								$latabla = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Untitled Document</title>
								<style>thead tr{background-color:transparent}
								tfoot tr{font-weight:bold;background-color: #D2D2D2;}
								thead tr td{font-size:14px;height:30px;width: auto;position:relative;float: right;right:50px;margin-top:10px;background-color:transparent;border:0}
								tr{background-color: #F0F8DD;}
								tr:nth-child(2n+1){background-color: #FFFFFF;color:black;}
								th, td{padding: 3px;border: 2px solid #989898 ;border-radius: 3px;}
								th{background-color:#333333;font-size: 13px; color: #FFFFFF;text-align:center;}
								table {padding: 9px;border: 4px solid #C0C0C0;border-radius: 25px;background-color: #F0F0F0 ;text-align:center;width:100%}
								tbody{width:auto}p{font-size: 25px;color: black; text-align:center;background-color:transparent;border:0;width:100%;}
								input{display:none}</style>
								</head><body><center><img width=200 src=http://intranet.alimentosarandas.com/images/logob.png border=0><center><p>'.$titulo.'</p>'.$tabla.'<br><br>Correo enviado desde el sistema de software de p&oacute;lizas de seguros de Alimentos Arandas <br>
								<br> (esta cuenta de correo es utilizada solo para enviar correos y no para recibirlos) <br> *NO RESPONDER A ESTE CORREO </body></html>';
								$mensaje = $this->_enviarRepor($latabla, $correoss, $m);
								echo $mensaje;								
							}else{
								$imagen = '<center><img width=200 src=http://intranet.alimentosarandas.com/images/logob.png border=0><center>';
								$link = "http://intranet.alimentosarandas.com/bienes/";
								$mensaj = 'Correo de notificación de recordatorios sobre las pólizas de seguro de la empresa Alimentos Arandas.<br><br>';
								$mensajetabla = '<p>'.$mensaj.'Fecha de notificación: <b>'. $fecha .'</b></p> <br> <p>Recordatorio: <b> '. $y .'</b><br><br><br> <b>Sistema gestor de pólizas de Alimentos Arandas<b><br><br> *No responder a este mensaje <br><br>'.$link.'</p>';							
								$mensaje = $this->_enviarRepor($mensajetabla, $correoss, $m);
								echo $mensaje;
							}
							if($n != "0"){
								$fNotificacion = date("Y-m-d", strtotime("$fecha + 1 month"));			
								$queri = "UPDATE grecordatorios SET fecha_notificacion = '$fNotificacion' WHERE id_recordatorio = $b;";
								$error = $omodelo->_insertar($queri);
								if ($error == "si") {
									echo "Error de registro";
								}
							}
						}				
					}
				}		
			}
		}
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
}
	$enviarecordatorioso = new enviarecordatorios();
	$enviarecordatorioso -> _enviarecordatorios();

?>
