
	<ol class="breadcrumb">
		<li><a href="index.php">Inicio</a></li>
		<li><a href="#">Abonos</a></li>
	</ol>
	<div id="content">
	<div class="touch-demo" id="touch-dragleft">
	<section recargaReporte="reporte" class="panel corner-flip">
		<header class="panel-heading">
			<h2><strong>Abonos</strong></h2>
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
			<h4 class="modal-title"><span id="modAgrepro">Agregar nuevo</span> <strong>&nbsp; Gasto</strong></h4>
			<span style="float: right;margin-top: -20px;margin-right: 10%;">*campos obligatorios</span>
		</div>
		<div class="modal-body">
			<section class="panel">
					<form id="formVentana" action="#" method="post" parsley-validate>
						 <input type="hidden" name="nomPagina" id="nomPagina" value="v_gastos">						<!-- MODIFICAR NOMBRE DE PAGINA-->
						 <input type="hidden" name="idR" id="idR" value="0">
						 <input type="hidden" name="cmo" id="cmo" value="insertar">					 
						<div class="panel-body">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Folio *</label>
									<input data-vertical="left" data-horizontal="top" data-theme="danger" validar="folio_gastos" name="folio" id="folio" type="text" class="form-control valida-campos"  parsley-required="true"  parsley-trigger="change"  placeholder="Folio" >
								</div>
								<div class="form-group"> 
									<label class="control-label">Fecha *</label>
									<div class="input-group date form_datetime" data-picker-position="bottom-left" top-left="40" data-date-time="2" data-date-format="dd MM yyyy" >
										<input type="text" readonly name="fechabb" id="fechabb" class="form-control formatoFecha" eltop="140" elleft="40" >
										<span class="input-group-btn">
											<button style="height: 34px;" class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
											<button style="height: 34px;" class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">Tipo de gasto *</label>
									<select style="color:black" name="tipoGasto" id="tipoGasto" class="selectpicker form-control show-menu-arrow show-tick" placeholder="Tipo de gasto" data-style="btn-inverse">
										<option>Producción</option>
										<option>Mantenimiento</option>
										<option>Matería prima</option>
										<option>Transporte</option>
										<option>Inmobiliaría</option>
										<option>Otros gastos</option>
									</select>
								</div>
								<div id="otroGa" class="form-group oculto">
									<label class="control-label">Otro gasto *</label>
									<input name="otroGasto" id="otroGasto" type="text" class="form-control" placeholder="Ej. Recibo de luz" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Gasto </label>
									<div class="input-group"> <span class="input-group-addon">$</span>
										<input name="gasto" id="gasto" type="text" class="form-control dinero totalGast" placeholder="Ej. $1,200.00" >
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">Cantidad </label>
									<input name="cantidad" id="cantidad" type="text" class="form-control totalGast" placeholder="Ej. 2" >
								</div>
								<div class="form-group">
									<label class="control-label">Total </label>
									<div class="input-group"> <span class="input-group-addon">$</span>
										<input readonly name="total" id="total" type="text" value="$0.00" class="form-control dinero">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">Descripci&oacute;n </label>
									<textarea name="descripcion" id="descripcion" type="text" class="form-control" placeholder="Describe el gasto" ></textarea>
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
			<h4 class="modal-title">Eliminar <strong> Costo</strong></h4>
		</div>
		<div class="modal-body">
			<section class="panel">
				<form id="formElimina" action="#" method="post" parsley-validate>
					 <input type="hidden" name="nomPagina" id="nomPagina" value="v_gastos">						<!-- MODIFICAR NOMBRE DE PAGINA-->
					 <input type="hidden" name="idElimina" id="idElimina" value="0">
					 <input type="hidden" name="cmo" id="" value="eliminar">			 
					<div class="panel-body">
						<center>
							<p> <h3><strong>¿Desea eliminar este costo? <br><b id="nomUsuElim"></b></strong></h3></p>
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