<br>
<div class="container-fluid">
	<form id="FormGuardarNegocio">
	<div class="row">
		<div class="col-lg-6 col-sm-6">
			<div class="form-group">
				<label class="control-label">Nombre de gerente*</label>
				<input id="nombre" type="text" class="form-control" placeholder="Nombre" required>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6">
			<div class="form-group">
				<label class="control-label">Apellidos de gerente*</label>
				<input id="apellidos" type="text" class="form-control" placeholder="Apellidos" required>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4 col-sm-6">
			<label class="control-label">Correo electrónico*</label>
			<div class="input-group">	
			  <div class="input-group-prepend">
			    <span class="input-group-text" id="basic-addon1">@</span>
			  </div>
			  <input type="email" class="form-control" placeholder="Ej. ejemplo@gmail.com" id="correo" required>
			</div>
		</div>
		<div class="col-lg-4 col-sm-6">
			<label class="control-label">Celular*</label>
			<div class="form-group">
				<input id="telefono" type="tel" class="form-control" placeholder="(XXX) XXXX XXX" required>
			</div>
		</div>
		<div class="col-lg-4 col-sm-12">
			<div class="form-group">
				<label class="control-label">Nombre de usuario*</label>
				<input id="nombreUsuario" type="text" class="form-control"  placeholder="Ej. NombreUsuario123" required>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4 col-sm-6">
			<div class="form-group">
				<label class="control-label">Empresa*</label>
				<input id="nombreEmpresa" type="text" class="form-control" placeholder="Ej. Empresas S.A de C.V." required>
			</div>
		</div>
		<div class="col-lg-4 col-sm-6">
			<div class="form-group">
				<label class="control-label">Telefono*</label>
				<input id="telefonoEmpresa" type="tel" class="form-control" placeholder="(XXX) XXXX XXX" required>
			</div>
		</div>
		<div class="col-lg-4 col-sm-12">
			<div class="form-group">
				<label class="control-label">Domicilio*</label>
				<input id="domicilioEmpresa" type="text" class="form-control" placeholder="Ej. Calle Centro #25" required>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3">
			<label class="control-label">Pais*</label>
			<select id="paisCliente" class="form-control">
			</select>
		</div>
		<div class="col-lg-3">
			<label class="control-label">Estado*</label>
			<select id="estadoCliente" class="form-control">
				<option value="">Selecciona un estado</option>
			</select>
		</div>
		<div class="col-lg-3">
			<label class="control-label">Ciudad*</label>
			<select id="ciudadCliente" class="form-control">
				<option value="">Selecciona una ciudad</option>
			</select>
		</div>
		<div class="col-lg-3">
			<label class="control-label">Codigo Postal*</label>
			<input id="CodigoPostalCliente" type="number" class="form-control" placeholder="Ej. 45852" required>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-4 col-sm-6">
			<label class="control-label">Giro*</label>
			<select name="giroEmpresa" id="giroEmpresa" class="form-control" required>
				<option value="" disabled selected>Seleccione una opción</option>
				<option value="farmacia">Farmacia</option>
				<option value="abarrotes">Abarrotes</option>
				<option value="ferreterias">Ferreterias</option>
				<option value="refaccionaria">Refaccionaria</option>
				<option value="boutique">Boutique</option>
				<option value="servicios">Servicios</option>
				<option value="restaurant">Restaurant</option>
				<option value="otro">Otro</option>
			</select>
		</div>
		<div class="col-lg-4 col-sm-6">
			<label class="control-label">Paquete*</label>
			<select name="paquete" id="paquete" class="form-control" required>
				<option value="" disabled selected>Seleccione una opción</option>
				<option value="Freemium">Freemium</option>
				<option value="Premium">Premium</option>
				<option value="Plus">Plus</option>
			</select>
		</div>
		<div class="col-lg-4 col-sm-12">
			<div class="form-group">
				<label id="sCaptcha" class="control-label"></label>
				<input name="captcha" id="captcha" type="text" class="form-control" required>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<button class="btn btn-block btn-primary" type="submit">Aceptar</button>
		</div>
	</div>
	</form>
</div>