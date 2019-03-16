<div style="display:none" class="contactanos" title="Envianos un mensaje">  
   <form id="contactanos" name="contactanos" name="myForm" action="?contact=0" method="post">
     <center><img src="vistas/images/logo.png" width="125"></center>
	 <table>
		<tr class="oblitorio" style="color:white">
			<td style="width:140px"><span>Nombre completo*</span></td>
			<td><input name="nombre" placeholder="Nombre Apellido Apellido" type="text" size="90"  title="Escribe tu nombre completo"></td>
		</tr>
		<tr class="oblitorio" style="color:white">
			<td><span>Correo*</span></td>
			<td><input name="correo" placeholder="ejemplo@correo.com" type="email" size="30" title="Ingresa tu correo electronico"></td>
		</tr>
		<tr class="oblitorio" style="color:white">
			<td><span>Asunto*<span></td>
			<td><input name="asunto" size="100" type="text" title="Ingresa el motivo del mensaje"></td>
		</tr>		
		<tr class="oblitorio" style="color:white">
			<td><span>Mensaje*</span></td>
			<td><textarea class="ui-widget ui-state-default ui-corner-all" name="mensaje" id="mensaje" cols="40" rows="5" title="Escribe el mensaje que enviaras"></textarea></td>		
		</tr>
	  </table>
	  <p style="left:10px; position:relative;color:white;top:100px"><b>* Campos obligatorios</b></p><br>
		<center>
			<div id="divbotonesGC">
				<input type="submit" style="display:none">
				<input id="Guardar" name="enviar" value="Enviar" type="button" class="botonesGC" onclick="validarForm('contactanos')">
			</div>
		</center>
   </form>
</div>