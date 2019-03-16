
	<ol class="breadcrumb">
		<li><a href="index.php">Inicio</a></li>
		<li><a href="#">Proveedores</a></li>
	</ol>
	<div id="content">
		<div class="touch-demo" id="touch-dragleft">
			<section recargaReporte="reporte" class="panel corner-flip">
				<header class="panel-heading">
					<h2><strong>Proveedores</strong></h2>
				</header>
				<div class="panel-tools panel-tools-mini color circle  panelBotones" align="right" data-toolscolor="#F4AD41">
					<div>
						<button type="button" class="btn btn-success btn-success ventaNuevo" data-effect="md-flipHor" data-target="0"><i class="fa fa-file"></i> Nuevo</button>
						<ul class="tooltip-area redonda-lista">
							<li><a href="javascript:void(0)" class="btn btn-inverse btn-collapse" title="Contraer"><i class="fa fa-sort-amount-asc"></i></a></li>
							<li><a href="javascript:void(0)" class="btn btn-inverse btn-reload" reporte="reporte" title="Recargar"><i class="fa fa-retweet"></i></a></li>
							<li><a href="javascript:void(0)" class="btn btn-inverse btn-close" title="Cerrar"><i class="fa fa-times"></i></a></li>
						</ul>
					</div>
				</div>	
				<div class="panel-body">
					<div id="fReportes" permiso="PRV" class="elfondo row">
						<div class="recargaElContenido col-sm-12">#nomReporte#</div> <!-- 	PROHIBIDO ELIMINAR ESTA LINEA 	-->
					</div>
				</div>
			</section>
		</div>
	</div>

	<!--::::::::::::::::::::::::::::::::::::: NUEVO/MODIFICAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
	
	<div id="ventaNuevo0" class="modal fade" tabindex="-1" data-width="700">
		<div class="modal-header bg-inverse bd-inverse-darken">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
			<h4 class="modal-title"><p id="modAgrepro" style="width: 70%; display: inline-block;">Agregar nuevo<b>&nbsp; Proveedor</b></p>
			<p class="text-right" style="display: inline-block; font-size: 14px;">*campos obligatorios</p>
			</h4>
		</div>
		<div class="modal-body">
			<section class="panel">
				<form id="formVentana" action="#" method="post" parsley-validate>
					 <input type="hidden" name="nomPagina" id="nomPagina" value="v_proveedores">						<!-- MODIFICAR NOMBRE DE PAGINA-->
					 <input type="hidden" name="idR" id="idR" value="0">
					 <input type="hidden" name="cmo" id="cmo" value="insertar">					 
					<div class="panel-body">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Razón social </label>
								<input name="empresa" id="empresa" type="text" class="form-control" placeholder="Ej. Telas S.A de C.V." >
							</div>
							<div class="form-group">
								<label class="control-label">Ciudad *</label>
								<input name="ciudad" id="ciudad" type="text" class="form-control" parsley-required="true" placeholder="Ej. Guadalajara" >
							</div>
							<div class="form-group">
								<label class="control-label">Colonia </label>
								<input name="colonia" id="colonia" type="text" class="form-control" placeholder="Ej. El centro" >
							</div>
							<div class="form-group">
								<label class="control-label">Direcci&oacute;n *</label>
								<input name="direccion" id="direccion" type="text" class="form-control"  parsley-required="true"  parsley-trigger="change"  placeholder="Direcci&oacute;n" >
							</div>
							<div class="form-group">
								<label class="control-label">Código postal </label>
								<div class="input-group"> <span class="input-group-addon">#</span>
									<input name="codigop" id="codigop" type="text" class="form-control" placeholder="Ej. 47180" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">RFC </label>
								<input name="rfc" id="rfc" type="text" class="form-control" placeholder="Ej. WAS12345F86" >
							</div>
							<div class="form-group">
								<label class="control-label">No. de cuenta bancaria </label>
								<input name="cuenta" id="cuenta" type="text" class="form-control" placeholder="Ej. 78365244998" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Banco </label>
								<input name="banco" id="banco" type="text" class="form-control" placeholder="Ej. Banamex" >
							</div>
							<div class="form-group">
								<label class="control-label">Contacto *</label>
								<input name="nombre" id="nombre" type="text" class="form-control"  parsley-required="true"  parsley-trigger="change"  placeholder="Nombre" >
							</div>
							<div class="form-group">
								<label class="control-label">Puesto </label>
								<input name="puesto" id="puesto" type="text" class="form-control" placeholder="Puesto laboral" >
							</div>								
							<div class="form-group">
								<label class="control-label">Telef&oacute;no *</label>
								<div class="input-group"><span class="input-group-addon"><i class="icon  fa fa-phone"></i></span>
									<input name="telefono" id="telefono" type="text" class="form-control"  parsley-required="true"  parsley-trigger="change"  placeholder="(XXX) XXXX XXX" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Celular </label>
								<div class="input-group"><span class="input-group-addon"><i class="icon  fa fa-mobile"></i></span>
									<input name="celular" id="celular" type="text" class="form-control" placeholder="(XXX) XXXX XXX" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Correo eléctronico </label>
								<div class="input-group"><span class="input-group-addon">@</span>
									<input name="correo" id="correoe" type="text" class="form-control" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Crédito </label>
								<input name="credito" id="credito" type="text" class="form-control dinero" placeholder="Ej. 2 meses ó $20,000.00">
							</div>
						</div>
					</div>
					<div class="form-group offset" style="margin-top: 1%;">
						<center >
							<button id="guardar" type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> <strong>Guardar</strong></button>
							<button type="reset" class="btn" onclick="$( '#formVentana' ).parsley( 'destroy' )"><i class="fa fa-times-circle"></i> <strong>Cancelar</strong></button>
						</center>
					</div>						
				</form>
				
			</section>
		</div>
	</div>
	
	<!-- ::::::::::::::::::::::::::::::::::::: 	ELIMINAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::: -->
	<div id="ventaEliminar0" class="modal fade" tabindex="-1" data-width="700">
		<div class="modal-header bg-inverse bd-inverse-darken">
			<button id="eliminarCerrar" type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
			<h4 class="modal-title">Eliminar <strong> Proveedor</strong></h4>
		</div>
		<div class="modal-body">
			<section class="panel">
				<form id="formElimina" action="#" method="post" parsley-validate>
					 <input type="hidden" name="nomPagina" id="nomPagina" value="v_proveedores">						<!-- MODIFICAR NOMBRE DE PAGINA-->
					 <input type="hidden" name="idElimina" id="idElimina" value="0">
					 <input type="hidden" name="cmo" id="" value="eliminar">			 
					<div class="panel-body">
						<center>
							<p> <h3><strong>¿Desea eliminar este proveedor? <br><b id="nomUsuElim"></b></strong></h3></p>
						</center>
					</div>
					<div class="form-group offset" style="margin-top: 1%;">
						<center >
							<button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> <strong>Eliminar</strong></button>
							<button type="button" class="btn" onclick="$('#eliminarCerrar').trigger( 'click' );return false;"><i class="fa fa-times-circle"></i> <strong>Cancelar</strong></button>
						</center>
					</div>						
				</form>
				
			</section>
		</div>
	</div>
	
	<!--div class="load-overlay" style="opacity: 1; display: block;"><div><div class="c1"></div><div class="c2"></div><div class="c3"></div><div class="c4"></div></div><span>Guardando...</span></div-->