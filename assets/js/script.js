$(document).ready(function() {
	pais();
	
	function pais(){
		var data="metodo=consultar&accion=Paises";
	    $.ajax({
	        url:"index.php",
	        type: "POST",
	        data:data
	    })
	    .done(function(res){
			$("#paisCliente").html(res);
	    })
	    .fail(function(){
	        alert(res);
	    });
	}


	$(document).on("change", "#paisCliente",function(){
		var data="metodo=estado&accion=SeleccionarEstado&id="+$("#paisCliente option:selected").val();
		$.ajax({
	        url:"index.php",
	        type: "POST",
	        data:data
	    })
	    .done(function(msg){
			$("#estadoCliente").html(msg);
			$("#ciudadCliente").html("<option value='' selected disabled>Seleccione una ciudad</option>");
	    })
	    .fail(function(){
	        alert(msg);
	    });
	});

	$(document).on("change", "#estadoCliente",function(){
		var data="metodo=ciudad&accion=SeleccionarCiudad&id="+$("#estadoCliente option:selected").val();
		$.ajax({
	        url:"index.php",
	        type: "POST",
	        data:data
	    })
	    .done(function(msg){
			$("#ciudadCliente").html(msg);
	    })
	    .fail(function(){
	        alert(msg);
	    });
	});



	var suma = 0;
	CAPTCHA();

	$("#FormGuardarNegocio").submit(function(e) {
		e.preventDefault();

		if (suma == $("#captcha").val()) {
			var data="metodo=insertar&accion=formulario&nombre="+$.trim($("#nombre").val())+"&apellidos="+$.trim($("#apellidos").val())+"&correo="+$.trim($("#correo").val())+"&telefono="+$.trim($("#telefonoEmpresa").val())+"&celular="+$.trim($("#telefono").val())+"&empresa="+$.trim($("#nombreEmpresa").val())+"&telEmpresa="+$.trim($("#telefonoEmpresa").val())+"&domicilio="+$.trim($("#domicilioEmpresa").val())+"&ciudad="+$.trim($("#ciudadCliente option:selected").text())+"&estado="+$.trim($("#estadoCliente option:selected").text())+"&pais="+$.trim($("#paisCliente option:selected").text())+"&cp="+$("#CodigoPostalCliente").val()+"&giro="+$("#giroEmpresa").val()+"&paquete="+$("#paquete").val();
		
			$.ajax({
				url: 'index.php',
				type: 'POST',
				data: data
			})
			.done(function(res) {
				alert(res);
				document.getElementById("FormGuardarNegocio").reset();
				CAPTCHA();
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
		$("#sCaptcha").html(numero1+" + "+numero2);
	}
	// FINALIZA FUNCION DEL CAPTCHA
});