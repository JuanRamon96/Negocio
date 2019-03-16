<div style="display:none" id="ventanadeEnviar" class="enviar" title="Envia Reporte">
	<input type="hidden" id="ventanaEnvia">
   <form id="enviar" name="enviar" name="myForm" action="?contact=1" method="post">
	<input type="hidden" name="url" id="url">
	<input type="hidden" name="urlRepor" id="urlRepor">
	<table>
		<tr style="color:white">
			<td></td>
			<td><div class="radios">
			<input type="checkbox" class="cheksAgregar" id="envioRepEnviar" name="envMensua" onclick="envioMensual('enviar')"><label for="envioRepEnviar">Enviar mensualmente</label></div></td>
		</tr>
		<tr style="color:white">
			<td style="width:160px"></td>
			<td id="envioRept">
				<div class="oculto" id="repetiti"> cada: <input class="ui-widget ui-state-default ui-corner-all recDias" type="number" min="1" max="31" id="ndias-0" name="ndias" style="width:40px"/> de cada mes</div>
				<input type="hidden" name="ultimoDia" id="ultimoDia-0" value="0">
			</td>
		</tr>
		<tr class="obligatorio" style="color:white">
			<td><span>Asunto*<span></td>
			<td><input name="asunto" size="100" type="text"></td>
		</tr>
		<tr style="color:white">
			<td><span>Agregar Correo</span></td>
			<td style="width:230px">
				<input type="email" name="correosEn" id="correose9" title="Ingresa los correos a los cuales ser&aacute; enviado el reporte">
				<img id="" src="vistas/images/addB.png" onclick="spancorreos('e9')" class="agregarCorr">
			</td>
		</tr>
		</table>
		<table>
			<tr style="color:white" class="obligatorioCorreo">
				<td><span id="core">Correos*</span></td>
					<div >
						<td style="width:700px;height:auto" class="borde tdcontactos" id="tdcontactose9"></td>
					</div>
				<input type="hidden" id="correo" name="correo">
			</tr>
		</table>
		<textarea id="cadenamensaje" name="cadenamensaje" style="display:none"></textarea>
		<p style="left:10px; position:relative;color:white;top:100px"><b>* Campos obligatorios</b></p><br>
		<center>
			<div id="divbotonesGC">
				<input type="submit" style="display:none">
				<input id="Guardar" name="enviar" value="Enviar" type="button" class="botonesGC" onclick="validarForm('enviar')">
			</div>
		</center>
   </form>
</div>