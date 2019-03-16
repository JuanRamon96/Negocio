
	<ol class="breadcrumb">
		<li><a href="index.php">Inicio</a></li>
		<li><a href="#">Usuarios</a></li>
	</ol>
	<div id="content">
	<div class="touch-demo" id="touch-dragleft">
	<section recargaReporte="reporte" class="panel corner-flip">
		<header class="panel-heading">
			<h2><strong>Usuarios</strong></h2>
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
			<div id="fReportes" permiso="USV" class="elfondo row">		
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
			<h4 class="modal-title"><p id="modAgrepro" style="width: 70%; display: inline-block;">Agregar nuevo <b>&nbsp; Usuario</b></p>
				<p class="text-right" style="display: inline-block; font-size: 14px;">*campos obligatorios</p>
			</h4>
		</div>
		<div class="modal-body">
			<section class="panel">
				<div class="panel-body">
					<form id="formFoto" enctype="multipart/form-data" action="#" method="post" target="subir_archivos">
						 <input type="hidden" name="nomPagina" id="nomPaginaB" value="v_usuarios">						<!-- MODIFICAR NOMBRE DE PAGINA-->
						 <input type="hidden" name="idR" id="idRB" value="0">
						 <input type="hidden" name="cmo" id="cmoB" value="foto">
						 <input type="hidden" name="nombre" id="nombreB">
						<div class="col-md-6 col-sm-5 col-xs-12">
							<center>
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail Foto" style="width: 250px; height: 170px;cursor:pointer;border-radius:4px;border:2px solid grey;">
									<img id="fotoUsu" onclick="$('#foto').trigger('click');" data-src="assets/plugins/holder/holder.js/100%x100%/text:Preview" src="vistas/images/picture.png" alt="Tu foto">
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
						 <input type="hidden" name="nomPagina" id="nomPagina" value="v_usuarios">
						 <input type="hidden" name="idusuario" id="idusuario" value="0">
						 <input type="hidden" name="cmo" id="cmo" value="insertar">					 
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nombre *</label>
									<input name="nombre" id="nombre" type="text" onchange="$('#nombreB').val($(this).val());" class="form-control"  parsley-required="true"  parsley-trigger="focus"  placeholder="Nombre completo" >
								</div>
								<div class="form-group">
									<label class="control-label">Usuario *</label>
									<div class="input-group"> <span class="input-group-addon">@</span>
										<input data-vertical="left" data-horizontal="top" data-theme="danger" validar="usuario_usuarios" name="correo" id="correoB" type="text" class="valida-campos form-control"  parsley-type="email"  parsley-trigger="change"  placeholder="Correo electronico" >
									</div>
								</div>
								<div id="divSelec" class="form-group">
									<label class="control-label">Estatus *</label>
									<select name="estatus" id="estatus" class="selectpicker form-control show-menu-arrow show-tick" data-style="btn-inverse"  parsley-required="true">
										<option value="">- Selecciona -</option>
										<option data-icon="fa fa-lock" value="Bloqueado">Bloqueado</option>
										<option data-icon="fa fa-unlock" value="Desbloqueado">Desbloqueado</option>
									</select>
								</div>					
							</div>
							<div class="col-md-6 formAgregar">
								<center><h2 class="control-label"><strong>Asignar rol de usuario</strong></h2></center>
							</div>
							
							<div class="col-md-12 col-sm-5 col-xs-12">	
								<div style="margin-top: 4%;">
									<button style="height: 70px; font-size: 15pt;border-radius: 5px;" type="button" class="btnRol col-md-6 col-sm-5 col-xs-12 btn btn-primary btn-transparent" id="Radg"><b><i class="icon  fa fa-unlock"></i> Administrador general</b></button>
									<button style="height: 70px; font-size: 15pt;border-radius: 5px;" type="button" class="btnRol col-md-6 col-sm-5 col-xs-12 btn btn-success btn-transparent" id="Radl"><b><i class="icon  fa fa-unlock-alt"></i> Administrador limitado</b></button>
									<button style="height: 70px; font-size: 15pt;border-radius: 5px;" type="button" class="btnRol col-md-6 col-sm-5 col-xs-12 btn btn-danger btn-transparent" id="Rven"><b><i class="icon  fa fa-shopping-cart"></i> Vendedor</b></button>
									<button style="height: 70px; font-size: 15pt;border-radius: 5px;" type="button" class="btnRol col-md-6 col-sm-5 col-xs-12 btn btn-warning btn-transparent" id="Rfac"><b><i class="icon  fa fa-file-text"></i> Facturación</b></button>
								</div>	
							</div>
							
							<div class="col-md-6 formAgregar">
								<center><h2 class="control-label"><strong>Permisos</strong></h2></center>
							</div>
							
							<div class="col-md-6 col-sm-5 col-xs-12" style="float:left">	
								<div style="margin-top: 4%;" class="">
								
									<section class="panel" style="border: 1px solid gray;">
											<div class="panel-tools" align="right" align="right">
												<ul class="tooltip-area">
													<li><a href="javascript:void(0)" class="btn btn-collapse contraido in" title="Contraer"><i class="fa fa-sort-amount-asc"></i></a></li>
													<li><a href="javascript:void(0)" class="btn btn-close" title="Cerrar"><i class="fa fa-times"></i></a></li>
												</ul>
												<h4 style="text-align: left;margin-top: -11.5%;" class="mediaPermisosTitulos"><strong>Productos</strong></h4>
											</div>
										<div class="panel-body">
										<div class="row" style="margin-top:2%">
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="proA" id="0-0" type="checkbox">
												</div>	
												<label>Agregar</label>
											</div>							
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="proM" id="0-1" type="checkbox">									
												</div>
												<label>Modificar</label>
											</div>							
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="proE" id="0-2" type="checkbox">											
												</div>
												<label>Eliminar</label>
											</div>							
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="proV" id="0-3" type="checkbox">
												</div>
												<label>Ver</label>										
											</div>							
										</div>
										</div>
									</section>								
									
									<section class="panel" style="margin-top: -20px;border: 1px solid gray;">
											<div class="panel-tools" align="right" align="right">
												<ul class="tooltip-area">
													<li><a href="javascript:void(0)" class="btn btn-collapse  contraido in" title="Contraer"><i class="fa fa-sort-amount-asc"></i></a></li>
													<li><a href="javascript:void(0)" class="btn btn-close" title="Cerrar"><i class="fa fa-times"></i></a></li>
												</ul>
												<h4 style="text-align: left;margin-top: -11.5%;" class="mediaPermisosTitulos"><strong>Compras</strong></h4>
											</div>
										<div class="panel-body">
										<center>
										<div class="row" style="margin-top:2%">
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="comA" id="1-0" type="checkbox">
												</div>	
												<label>Agregar</label>
											</div>							
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="comM" id="1-1" type="checkbox">									
												</div>
												<label>Modificar</label>
											</div>							
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="comE" id="1-2" type="checkbox">											
												</div>
												<label>Eliminar</label>
											</div>							
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="comV" id="1-3" type="checkbox">
												</div>
												<label>Ver</label>										
											</div>							
										</div>
										</center>
										</div>
									</section>		
									
									<section class="panel" style="margin-top: -20px;border: 1px solid gray;">
											<div class="panel-tools" align="right" align="right">
												<ul class="tooltip-area">
													<li><a href="javascript:void(0)" class="btn btn-collapse  contraido in" title="Contraer"><i class="fa fa-sort-amount-asc"></i></a></li>
													<li><a href="javascript:void(0)" class="btn btn-close" title="Cerrar"><i class="fa fa-times"></i></a></li>
												</ul>
												<h4 style="text-align: left;margin-top: -11.5%;" class="mediaPermisosTitulos"><strong>Ventas</strong></h4>
											</div>
										<div class="panel-body">
										<center>
										<div class="row" style="margin-top:2%">
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="venA" id="2-0" type="checkbox">
												</div>	
												<label>Agregar</label>
											</div>							
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="venM" id="2-1" type="checkbox">									
												</div>
												<label>Modificar</label>
											</div>							
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="venE" id="2-2" type="checkbox">											
												</div>
												<label>Eliminar</label>
											</div>							
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="venV" id="2-3" type="checkbox">
												</div>
												<label>Ver</label>										
											</div>							
										</div>
										</center>
										</div>
									</section>		
									
									<section class="panel" style="margin-top: -20px;border: 1px solid gray;">
											<div class="panel-tools" align="right" align="right">
												<ul class="tooltip-area">
													<li><a href="javascript:void(0)" class="btn btn-collapse  contraido in" title="Contraer"><i class="fa fa-sort-amount-asc"></i></a></li>
													<li><a href="javascript:void(0)" class="btn btn-close" title="Cerrar"><i class="fa fa-times"></i></a></li>
												</ul>
												<h4 style="text-align: left;margin-top: -11.5%;" class="mediaPermisosTitulos"><strong>Clientes</strong></h4>
											</div>
										<div class="panel-body">
										<center>
										<div class="row" style="margin-top:2%">
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="cliA" id="3-0" type="checkbox">
												</div>	
												<label>Agregar</label>
											</div>							
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="cliM" id="3-1" type="checkbox">									
												</div>
												<label>Modificar</label>
											</div>							
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="cliE" id="3-2" type="checkbox">											
												</div>
												<label>Eliminar</label>
											</div>							
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="cliV" id="3-3" type="checkbox">
												</div>
												<label>Ver</label>										
											</div>							
										</div>
										</center>
										</div>
									</section>		
																
								</div>	
							</div>
							
							<div class="col-md-6 col-sm-5 col-xs-12" style="float:left;">	
								<div style="margin-top: 4%;" class="">
									<section class="panel" style="border: 1px solid gray;">
											<div class="panel-tools" align="right" align="right">
												<ul class="tooltip-area">
													<li><a href="javascript:void(0)" class="btn btn-collapse contraido in" title="Contraer"><i class="fa fa-sort-amount-asc"></i></a></li>
													<li><a href="javascript:void(0)" class="btn btn-close" title="Cerrar"><i class="fa fa-times"></i></a></li>
												</ul>
												<h4 style="text-align: left;margin-top: -11.5%;" class="mediaPermisosTitulos"><strong>Empleados</strong></h4>
											</div>
										<div class="panel-body">
										<center>
										<div class="row" style="margin-top:2%">
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="empA" id="4-0" type="checkbox">
												</div>	
												<label>Agregar</label>
											</div>							
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="empM" id="4-1" type="checkbox">									
												</div>
												<label>Modificar</label>
											</div>							
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="empE" id="4-2" type="checkbox">											
												</div>
												<label>Eliminar</label>
											</div>							
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="empV" id="4-3" type="checkbox">
												</div>
												<label>Ver</label>										
											</div>							
										</div>
										</center>
										</div>
									</section>		
									
									<section class="panel" style="margin-top: -20px;border: 1px solid gray;">
											<div class="panel-tools" align="right" align="right">
												<ul class="tooltip-area">
													<li><a href="javascript:void(0)" class="btn btn-collapse contraido in" title="Contraer"><i class="fa fa-sort-amount-asc"></i></a></li>
													<li><a href="javascript:void(0)" class="btn btn-close" title="Cerrar"><i class="fa fa-times"></i></a></li>
												</ul>
												<h4 style="text-align: left;margin-top: -11.5%;" class="mediaPermisosTitulos"><strong>Proveedores</strong></h4>
											</div>
										<div class="panel-body">
										<center>
										<div class="row" style="margin-top:2%">
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="provA" id="5-0" type="checkbox">
												</div>	
												<label>Agregar</label>
											</div>							
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="provM" id="5-1" type="checkbox">									
												</div>
												<label>Modificar</label>
											</div>							
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="provE" id="5-2" type="checkbox">											
												</div>
												<label>Eliminar</label>
											</div>							
											<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
												<div class="switch switch-small usuSwitch">
													<input name="provV" id="5-3" type="checkbox">
												</div>
												<label>Ver</label>										
											</div>							
										</div>
										</center>
										</div>
									</section>		
									
									<section class="panel" style="margin-top: -20px;border: 1px solid gray;">
										<div class="panel-tools" align="right" align="right">
											<ul class="tooltip-area">
												<li><a href="javascript:void(0)" class="btn btn-collapse contraido in" title="Contraer"><i class="fa fa-sort-amount-asc"></i></a></li>
												<li><a href="javascript:void(0)" class="btn btn-close" title="Cerrar"><i class="fa fa-times"></i></a></li>
											</ul>
											<h4 style="text-align: left;margin-top: -11.5%;" class="mediaPermisosTitulos"><strong>Usuarios</strong></h4>
										</div>
									<div class="panel-body">
									<center>
									<div class="row" style="margin-top:2%">
										<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
											<div class="switch switch-small usuSwitch">
												<input name="usuA" id="6-0" type="checkbox">
											</div>	
											<label>Agregar</label>
										</div>							
										<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
											<div class="switch switch-small usuSwitch">
												<input name="usuM" id="6-1" type="checkbox">									
											</div>
											<label>Modificar</label>
										</div>							
										<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
											<div class="switch switch-small usuSwitch">
												<input name="usuE" id="6-2" type="checkbox">											
											</div>
											<label>Eliminar</label>
										</div>							
										<div class="col-sm-6 col-xs-6 col-md-6 col-iSwitch flat-switch" style="    margin-top: 3%;">
											<div class="switch switch-small usuSwitch">
												<input name="usuV" id="6-3" type="checkbox">
											</div>
											<label>Ver</label>										
										</div>							
									</div>
									</center>
									</div>
								</section>		
								
								</div>	
							</div>
						
						<div class="col-md-12 offset" style="margin-top: 6%;">
							<center>
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
			<h4 class="modal-title">Eliminar <strong> Usuario</strong></h4>
		</div>
		<div class="modal-body">
			<section class="panel">
				<form id="formElimina" action="#" method="post" parsley-validate>
					 <input type="hidden" name="nomPagina" id="nomPagina" value="v_usuarios">
					 <input type="hidden" name="idElimina" id="idElimina" value="0">
					 <input type="hidden" name="cmo" id="" value="eliminar">			 
					<div class="panel-body">
						<center >
							<p> <h3><strong>¿Desea eliminar a este usuario? <br><b id="nomUsuElim"></b></strong></h3></p>
						</center >
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