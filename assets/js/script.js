$(document).ready(function() {
	var suma = 0;
	CAPTCHA();

	$("#FormGuardarNegocio").submit(function(e) {
		e.preventDefault();

		if (suma == $("#captcha").val()) {
			var data="metodo=insertar&accion=formulario&nombre="+$.trim($("#nombre").val())+"&apellidos="+$.trim($("#apellidos").val())+"&correo="+$.trim($("#correo").val())+"&telefono="+$.trim($("#telefonoEmpresa").val())+"&celular="+$.trim($("#telefono").val())+"&usuario="+$.trim($("#nombreUsuario").val())+"&empresa="+$.trim($("#nombreEmpresa").val())+"&telEmpresa="+$.trim($("#telefonoEmpresa").val())+"&domicilio="+$.trim($("#domicilioEmpresa").val())+"&ciudad="+$.trim($("#ciudadCliente").val())+"&estado="+$.trim($("#estadoCliente").val())+"&pais="+$.trim($("#paisCliente").val())+"&cp="+$("#CodigoPostalCliente").val()+"&giro="+$("#giroEmpresa").val()+"&paquete="+$("#paquete").val();
		
			$.ajax({
				url: 'index.php',
				type: 'POST',
				data: data
			})
			.done(function(res) {
				alert(res);
				document.getElementById("FormGuardarNegocio").reset();
			})
			.fail(function() {
				console.log("Error");
			});
		}else{
			alert("El captcha es incorrecto");
			CAPTCHA();
			$("#captcha").val("");
		}
	});
	

	// INICIA FUNCION DEL CAPTCHA
	function CAPTCHA() {
		var numero1 = Math.round(Math.random() * (10 - 1) + 1);
		var numero2 = Math.round(Math.random() * (10 - 1) + 1);
		suma=numero1+numero2;
		$("#sCaptcha").html(numero1+" + "+numero2+" = ");
	}
	// FINALIZA FUNCION DEL CAPTCHA
});