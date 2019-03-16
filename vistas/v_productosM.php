
	<ol class="breadcrumb">
		<li><a href="index.php">Inicio</a></li>
		<li><a href="#">Materia prima</a></li>
		<li><a href="#">Productos</a></li>
	</ol>
	<div id="content">
	<div class="touch-demo" id="touch-dragleft">
	<section recargaReporte="reporte" class="panel corner-flip">
		<header class="panel-heading">
			<h2><strong>Productos</strong></h2>
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
			<h4 class="modal-title"><p id="modAgrepro" style="width: 70%; display: inline-block;">Agregar nuevo <b>&nbsp; Producto</b></p>
				<p class="text-right" style="display: inline-block; font-size: 14px;">*campos obligatorios</p>
			</h4>
		</div>
		<div class="modal-body">
			<section class="panel">
				<div class="panel-body">
					<form id="formFoto" enctype="multipart/form-data" action="#" method="post" target="subir_archivos">
						 <input type="hidden" name="nomPagina" id="nomPaginaB" value="v_productosM">						<!-- MODIFICAR NOMBRE DE PAGINA-->
						 <input type="hidden" name="idR" id="idRB" value="0">
						 <input type="hidden" name="cmo" id="cmoB" value="foto">
						 <input type="hidden" name="nombre" id="nombreB">
						<div class="col-md-6" style="float:right">
							<center>
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 250px; height: 170px;cursor:pointer;border-radius:4px;border:2px solid grey;">
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
						<button id="guardaFoto" style="display:none" type="submit"></button>
						<iframe width="1" height="1" frameborder="0" name="subir_archivos" style="display: none"></iframe>
					</form>
			
					<form id="formVentana" action="#" method="post" class="row" parsley-validate>
						<input type="hidden" name="nomPagina" id="nomPagina" value="v_productosM">						<!-- MODIFICAR NOMBRE DE PAGINA-->
						<input type="hidden" name="idR" id="idR" value="0">
						<input type="hidden" name="cmo" id="cmo" value="insertar">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">C&oacute;digo *</label>
								<div class="input-group"> <span class="input-group-addon">#</span>
									<input data-vertical="left" data-horizontal="top" data-theme="danger" validar="codigo_productosM" name="codigo" id="codigo" type="text" class="form-control valida-campos"  parsley-required="true"  parsley-trigger="focus"  placeholder="C&oacute;digo del producto (&uacute;nico)" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Nombre *</label>
								<input name="nombre" id="nombre" type="text" onchange="$('#nombreB').val($(this).val());" class="form-control"  parsley-required="true"  parsley-trigger="focus"  placeholder="Nombre de producto" >
							</div>
							<div class="form-group">
								<label class="control-label">Medida *</label>
								<select name="medida" id="medida" class="selectpicker form-control show-menu-arrow show-tick" placeholder="Unidad de medida del producto" data-style="btn-inverse">
									<option value="Pzs.">Unidades <small>(Pzs)</small></option>
									<option value="Kgs.">Kilogramos <small>(Kgs)</small></option>
									<option value="Mts.">Metros <small>(Mts)</small></option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<label class="control-label">Selecciona el color </label>
									<div id="retyu">
										<div class="row">
											<div class="input-group">
												<input id="elcolor" name="elcolor" type="text" class="form-control" data-provide="colorpicker" data-layout="full" data-addon="true" />
												<span class="input-group-addon"></span>
											</div>
										</div>
									</div>
							</div><!-- //form-group-->
							<div class="form-group">
								<label class="control-label">Descripci&oacute;n </label>
								<textarea name="descripcion" id="descripcion" type="text" class="form-control" placeholder="Describe el producto" ></textarea>
							</div>
							<div id="divSelec" class="form-group">
								<label class="control-label">Categor&iacute;a *</label>
								<select name="categoria" id="categoria" class="selectpicker form-control show-menu-arrow show-tick" data-style="btn-inverse"  parsley-required="true">
									<option value="">- Selecciona -</option>
									<option data-icon="fa fa-dot-circle-o" value="Accesorios">Accesorios</option>
									<option data-icon="fa fa-cog" value="Merceria">Mercer&iacute;a</option>
									<option data-icon="fa fa-road" value="Telas">Telas</option>
								</select>
							</div>
							<div id="divSelec" class="form-group">
								<label class="control-label">Material</label>
								<select name="material" id="material" class="selectpicker form-control show-menu-arrow show-tick" data-style="btn-inverse">
									<option value="">- Selecciona -</option>
									<option data-icon="fa fa-dot-circle-o" value="Poliester">P&oacute;liester</option>
									<option data-icon="fa fa-cog" value="Algodon">Algod&oacute;n</option>
									<option data-icon="fa fa-road" value="Seda">Seda</option>
									<option data-icon="fa fa-flag" value="Forros">Forros</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div id="divSelec" class="form-group">
								<label class="control-label">Proveedor</label>
								<select multiple name="proveedor[]" id="proveedor" class="seleProvee selectpicker form-control show-menu-arrow show-tick" data-style="btn-inverse" data-size="8" data-live-search="true">
									<option value="">- Selecciona -</option>
								</select>
							</div>
							<div id="divSelec" class="form-group">
								<label class="control-label">Tipo</label>
								<select name="tipo" id="tipo" class="selectpicker form-control show-menu-arrow show-tick" data-style="btn-inverse">
									<option value="">- Selecciona -</option>
									<option data-icon="fa fa-dot-circle-o" value="Economico">Económico</option>
									<option data-icon="fa fa-cog" value="Elegante">Elegante</option>
								</select>
							</div>
						</div>	
						<div class="col-md-12" style="margin-top: 6%;">
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
			<h4 class="modal-title">Eliminar <strong> Producto</strong></h4>
		</div>
		<div class="modal-body">
			<section class="panel">
				<form id="formElimina" action="#" method="post" parsley-validate>
					 <input type="hidden" name="nomPagina" id="nomPagina" value="v_productosM">
					 <input type="hidden" name="idElimina" id="idElimina" value="0">
					 <input type="hidden" name="cmo" id="" value="eliminar">			 
					<div class="panel-body">
						<center >
							<p> <h3><strong>¿Desea eliminar a este producto? <br><b id="nomUsuElim"></b></strong></h3></p>
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
