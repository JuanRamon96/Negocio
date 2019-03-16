
	<ol class="breadcrumb">
		<li><a href="index.php">Inicio</a></li>
		<li><a href="#">Personal</a></li>
	</ol>
	<div id="content">
	<div class="touch-demo" id="touch-dragleft">
	<section recargaReporte="reporte" class="panel corner-flip">
		<header class="panel-heading">
			<h2><strong>Personal</strong></h2>
		</header>
		<div class="panel-tools panel-tools-mini color circle panelBotones" align="right" data-toolscolor="#F4AD41">
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
			<h4 class="modal-title"><p id="modAgrepro" style="width: 70%; display: inline-block;">Agregar nuevo <b>&nbsp; Empleado</b></p>
				<p class="text-right" style="display: inline-block; font-size: 14px;">*campos obligatorios</p>
			</h4>
		</div>
		<div class="modal-body">
			<section class="panel">
				<div class="panel-body">

					<form id="formFoto" enctype="multipart/form-data" action="#" method="post" target="subir_archivos">
						 <input type="hidden" name="nomPagina" id="nomPaginaB" value="v_empleados">						<!-- MODIFICAR NOMBRE DE PAGINA-->
						 <input type="hidden" name="idR" id="idRB" value="0">
						 <input type="hidden" name="cmo" id="cmoB" value="foto">
						 <input type="hidden" name="nombre" id="nombreB" value="vac">
						 <div class="col-md-6 col-sm-12 col-xs-12" style="float:right;z-index: 2;">
							<center>
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail Foto" style="width: 250px; height: 170px;cursor:pointer;border-radius:4px;border:2px solid grey;">
									<img id="fotoUsu" onclick="$('#foto').trigger('click');" data-src="assets/plugins/holder/holder.js/100%x100%/text:Preview" src="vistas/images/user.gif" alt="Tu foto">
									<input type="hidden" id="ligaFoto" name="ligaFoto" value="0">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
								<div>
									<span class="btn btn-default btn-file">
										<span class="fileinput-new">Selecciona una foto</span>
										<span class="fileinput-exists">Cambiar</span>
										<input id="foto" type="file" name="foto" nombre="foto" accept=".jpg, .gif, .png"/>
										<input type="hidden" name="MAX_FILE_SIZE"  VALUE="8380000"/>
									</span>
									<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">
										<i class="fa fa-trash-o"></i> Eliminar
									</a>
								</div>
							</div>
							</center>
						</div>
						<input id="guardaFoto" type="submit" value="irse" style="display:none"/>
						<iframe width="1" height="1" frameborder="0" name="subir_archivos" style="display: none"></iframe>
					</form>
					
					<form id="formVentana" action="#" method="post" parsley-validate>
						 <input type="hidden" name="nomPagina" id="nomPagina" value="v_empleados">						<!-- MODIFICAR NOMBRE DE PAGINA-->
						 <input type="hidden" name="idR" id="idR" value="0">
						 <input type="hidden" name="cmo" id="cmo" value="insertar">					 
						<div class="panel-body">
							<div class="col-md-6" style="margin-top: 6px;">
								<div class="form-group">
									<label class="control-label">Nombre *</label>
									<input name="nombre" id="nombre" type="text" class="form-control"  parsley-required="true"  parsley-trigger="change"  placeholder="Nombre" >
								</div>
								<div class="form-group"> 
									<label class="control-label">Fecha de nacimiento *</label>
									<div class="input-group date form_datetime" data-picker-position="bottom-left" top-left="40" data-date-time="2" data-date-format="dd MM yyyy" >
										<input type="text" readonly name="fechabb" id="fechabb" class="form-control formatoFecha" eltop="140" elleft="40" >
										<span class="input-group-btn">
											<button style="height: 34px;" class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
											<button style="height: 34px;" class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">Direcci&oacute;n *</label>
									<input name="direccion" id="direccion" type="text" class="form-control"  parsley-required="true"  parsley-trigger="change"  placeholder="Direcci&oacute;n" >
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
										<input name="correo" id="correoe" type="text" class="form-control" parsley-type="email" parsley-trigger="change" >
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Puesto </label>
									<input name="puesto" id="puesto" type="text" class="form-control" placeholder="Vendedor de mostrador" >
								</div>
								<label class="control-label col-md-offset-5">Horario </label>
								<div class="form-group">
									<label class="control-label">Entrada </label>
									<div class="input-group date form_datetime" data-picker-position="bottom-left" top-left="40" data-date-time="0" data-date-format="HH:ii P" >
										<input type="text" readonly name="horarioEntrada" id="horarioEntrada" class="form-control" eltop="165" elleft="40" >
										<span class="input-group-btn">
											<button style="height: 34px;" class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
											<button style="height: 34px;" class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">Salida </label>
									<div class="input-group date form_datetime" data-picker-position="bottom-left" top-left="40" data-date-time="0" data-date-format="HH:ii P" >
										<input type="text" readonly name="horarioSalida" id="horarioSalida" class="form-control" eltop="240" elleft="40" >
										<span class="input-group-btn">
											<button style="height: 34px;" class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
											<button style="height: 34px;" class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">Sueldo </label>
									<div class="input-group"><span class="input-group-addon">$</span>
										<input name="sueldo" id="sueldo" type="text" class="form-control dinero" placeholder="Ej. 1,800.00">
									</div>
								</div>
								<div class="form-group"> 
									<label class="control-label">Fecha de entrada *</label>
									<div class="input-group date form_datetime" data-picker-position="bottom-left" top-left="40" data-date-time="2" data-date-format="dd MM yyyy" >
										<input type="text" readonly name="fechabb2" id="fechabb2" class="form-control formatoFecha" eltop="390" elleft="30" >
										<span class="input-group-btn">
											<button style="height: 34px;" class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
											<button style="height: 34px;" class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
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
				</div>
			</section>
		</div>
	</div>
	
	<!-- ::::::::::::::::::::::::::::::::::::: 	ELIMINAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::: -->
	<div id="ventaEliminar0" class="modal fade" tabindex="-1" data-width="700">
		<div class="modal-header bg-inverse bd-inverse-darken">
			<button id="eliminarCerrar" type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
			<h4 class="modal-title">Eliminar <strong> Personal</strong></h4>
		</div>
		<div class="modal-body">
			<section class="panel">
				<form id="formElimina" action="#" method="post" parsley-validate>
					 <input type="hidden" name="nomPagina" id="nomPagina" value="v_empleados">						<!-- MODIFICAR NOMBRE DE PAGINA-->
					 <input type="hidden" name="idElimina" id="idElimina" value="0">
					 <input type="hidden" name="cmo" id="" value="eliminar">			 
					<div class="panel-body">
						<center>
							<p> <h3><strong>¿Desea eliminar este empleado? <br><b id="nomUsuElim"></b></strong></h3></p>
						</center>
					</div>
					<input type="hidden" name="ligaFotoB" id="ligaFotoB" value="0">
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