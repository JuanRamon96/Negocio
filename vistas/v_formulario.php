
<div class="titulo"><strong>Registro</strong></div>
<div class="fondoForm">
	<div class="container-fluid">
		<form id="FormGuardarNegocio">
		<div class="row">
			<div class="col-lg-5 col-sm-6">
				<div class="form-group">
					<label class="control-label">Nombre de la Empresa</label>
					<input name="nombreEmpresa" id="nombreEmpresa" type="text" class="form-control" parsley-required="true" parsley-trigger="change" placeholder="Ej. Empresas S.A de C.V." required>
				</div>
			</div>
			<div class="col-lg-7 col-sm-12">
				<div class="form-group">
					<label class="control-label">Domicilio</label>
					<input name="domicilioEmpresa" id="domicilioEmpresa" type="text" class="form-control" parsley-required="true" parsley-trigger="change" placeholder="Ej. Calle Centro #25" required>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<label class="control-label">Pais</label>
				<select id="paisCliente" class="form-control">
				</select>
			</div>
			<div class="col-lg-4">
				<label class="control-label">Estado</label>
				<select id="estadoCliente" class="form-control">
					<option value='' selected disabled>Seleccione un estado</option>
				</select>
			</div>
			<div class="col-lg-4">
				<label class="control-label">Ciudad</label>
				<select id="ciudadCliente" class="form-control">
					<option value='' selected disabled>Seleccione una ciudad</option>
				</select>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-3">
				<label class="control-label">Codigo Postal</label>
				<input name="CodigoPostalCliente" id="CodigoPostalCliente" type="number" class="form-control" parsley-required="true" parsley-trigger="change" placeholder="Ej. 45852" required>
			</div>
			<div class="col-lg-5 col-sm-6">
				<div class="form-group">
					<label class="control-label">Telefono</label>
					<input name="telefonoEmpresa" id="telefonoEmpresa" type="tel" class="form-control" parsley-required="true" parsley-trigger="change" placeholder="(XXX) XXXX XXX" required>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6">
				<label class="control-label">Giro</label>
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
		</div>
		<br>
		<hr>
		<br>
		<div class="row">
			<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<label class="control-label">Nombre de gerente</label>
					<input name="nombre" id="nombre" type="text" class="form-control" parsley-required="true" parsley-trigger="change" placeholder="Nombre" required>
				</div>
			</div>
			<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<label class="control-label">Apellidos de gerente</label>
					<input name="apellidos" id="apellidos" type="text" class="form-control" parsley-required="true" parsley-trigger="change" placeholder="Apellidos" required>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-sm-6">
				<label class="control-label">Correo electrónico</label>
				<div class="input-group">	
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="basic-addon1">@</span>
				  </div>
				  <input type="email" class="form-control" placeholder="Ej. ejemplo@gmail.com" aria-label="Username" aria-describedby="basic-addon1" id="correo" name="correo" required>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6">
				<label class="control-label">Celular</label>
				<div class="form-group">
					<input name="telefono" id="telefono" type="tel" class="form-control" parsley-required="true" parsley-trigger="change" placeholder="(XXX) XXXX XXX" required>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6">
				<label class="control-label">Paquete</label>
				<select name="paquete" id="paquete" class="form-control" required>
					<option value="" disabled selected>Seleccione una opción</option>
					<option value="Freemium">Freemium</option>
					<option value="Premium">Premium</option>
					<option value="Plus">Plus</option>
				</select>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-8 col-sm-12">
				<div class="form-group">
					<label class="control-label">Captcha</label>
					<div class="cuadroCaptcha">
						<label id="sCaptcha" class="control-label"></label>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-sm-12">
				<label class="control-label">Ingrese el resultado</label>
				<input name="captcha" id="captcha" type="text" class="form-control" parsley-required="true" parsley-trigger="change" required>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<button class="btn btn-block btn-primary" type="submit">Aceptar</button>
			</div>
		</div>
		</form>
	</div>
</div>
