
	<ol class="breadcrumb">
		<li><a href="index.php">Inicio</a></li>
		<li><a href="#">Materia prima</a></li>
		<li><a href="#">Inventario</a></li>
	</ol>
	<div id="content">
	<div class="touch-demo" id="touch-dragleft">
	<section recargaReporte="reporte" class="panel corner-flip">
		<header class="panel-heading">
			<h2><strong>Inventario</strong></h2>
		</header>
		<div class="panel-tools panel-tools-mini color circle panelBotones" align="right" data-toolscolor="#F4AD41">
			<div>
				<button style="display:none"></button>
				<ul class="tooltip-area redonda-lista">
					<li><a href="javascript:void(0)" class="btn btn-inverse btn-collapse" title="Contraer"><i class="fa fa-sort-amount-asc"></i></a></li>
					<li><a href="javascript:void(0)" class="btn btn-inverse btn-reload" reporte="reporte" title="Recargar"><i class="fa fa-retweet"></i></a></li>
					<li><a href="javascript:void(0)" class="btn btn-inverse btn-close" title="Cerrar"><i class="fa fa-times"></i></a></li>
				</ul>
			</div>
		</div>	
		<div class="panel-body">
			<div id="fReportes" permiso="SUV" class="elfondo row">
				<div class="recargaElContenido col-md-12">#nomReporte#</div> <!-- 	PROHIBIDO ELIMINAR ESTA LINEA 	-->
			</div>
		</div>
	</section>
	</div>
	</div>

	<!--::::::::::::::::::::::::::::::::::::: NUEVO/MODIFICAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
	
	<div id="ventaNuevo0" class="modal fade" tabindex="-1" data-width="500">
		<div class="modal-header bg-inverse bd-inverse-darken">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
			<h4 class="modal-title"><p id="modAgrepro" style="width: 70%; display: inline-block;">Mover producto <p>&nbsp; </p></p> 
				<p class="text-right" style="display: inline-block; font-size: 14px;">*campos obligatorios</p>
			</h4>
		</div>
		<div class="modal-body">
			<section class="panel">
				<form id="formVentana" action="#" method="post" parsley-validate>
					 <input type="hidden" name="nomPagina" id="nomPagina" value="v_almacenM">						<!-- MODIFICAR NOMBRE DE PAGINA-->
					 <input type="hidden" name="idR" id="idR" value="0">
					 <input type="hidden" name="cmo" id="cmo" value="insertar">					 
					<div class="panel-body">
						<div class="col-md-12">
							<div class="form-group">
								<center><img id="fotoProAl" style="width: 170px;"  alt="" src="vistas/images/picture.png" class=""/></center>
							</div>
							<div class="form-group">
								<label class="control-label">De *</label>
								<select name="desucursal" id="desucursal" rango="[0,0]" class="seleSucursalM selectpicker form-control show-menu-arrow show-tick" data-style="btn-inverse" data-size="8" data-live-search="true" parsley-required="true">
									<option value="">- Selecciona -</option>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label">A *</label>
								<select name="asucursal" id="asucursal" class="seleSucursalM selectpicker form-control show-menu-arrow show-tick" data-style="btn-inverse" data-size="8" data-live-search="true" parsley-required="true">
									<option value="">- Selecciona -</option>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label">Cantidad *</label>
								<input name="cantidad" id="cantidad" style="" type="text" class="form-control bfh-number validaRango" parsley-range="[0,0]" parsley-trigger="change" parsley-validation-minlength="1" data-min="1" data-max="1" placeholder="Solo n&uacute;meros">
								<div style="display:none" class="alert bg-danger">
									<strong>Invalido!! </strong> El valor debe estar entre <b></b> y <b></b>
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
				
			</section>
		</div>
	</div>
	
	<!-- ::::::::::::::::::::::::::::::::::::: 	ELIMINAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::: -->