
	<ol class="breadcrumb">
		<li><a href="index.php">Inicio</a></li>
		<li><a href="#">Producto a la venta</a></li>
		<li><a href="#">Compras</a></li>
	</ol>
	<div id="content">
	<div class="touch-demo" id="touch-dragleft">
	<section recargaReporte="reporte" class="panel corner-flip">
		<header class="panel-heading">
			<h2><strong>Compras</strong></h2>
		</header>
		<div class="panel-tools panel-tools-mini color circle panelBotones" align="right" data-toolscolor="#F4AD41">
			<div>
				<button type="button" class="btn btn-success btn-success ventaNuevo" data-effect="md-flipHor" data-target="0"><i class="fa fa-file"></i> Nueva</button>
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
	
	<div id="ventaNuevo0" class="modal fade corner-flip" tabindex="-1" data-width="1200">
		<div class="modal-header bg-inverse bd-inverse-darken">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
			<h4 class="modal-title"><p id="modAgrepro" style="width: 70%; display: inline-block;">Agregar nueva <b>&nbsp; Compra</b></p> 
				<p class="text-right" style="display: inline-block; font-size: 14px;">*campos obligatorios</p>
			</h4>
		</div>
		<div class="modal-body">
			<section class="panel corner-flip">
				<form id="formVentana" onsubmit="notaCompraM('tablaComprasMP');" action="#" method="post" parsley-validate>
					 <input type="hidden" name="nomPagina" id="nomPagina" value="v_comprasV">						<!-- MODIFICAR NOMBRE DE PAGINA-->
					 <input type="hidden" name="idR" id="idR" value="0">
					 <input type="hidden" name="cmo" id="cmo" value="insertar">	
					 <input type="hidden" name="detalles" id="detalles">					 
					<div class="panel-body row">
						<div class="col-sm-12 col-md-3">
							<div class="panel-body panel corner-flip" style="border:1px solid rgb(221, 221, 221);border-radius:4px">
								<div class="form-group">
									<label class="control-label">Folio *</label>
									<input data-vertical="left" data-horizontal="top" data-theme="danger" validar="folio_comprasM" name="folio" id="folio" type="text" parsley-required="true"  parsley-trigger="focus" class="valida-campos form-control" placeholder="Folio &uacute;nico de la compra" >
								</div>
								<div id="divSelec" class="form-group">
									<label class="control-label">Proveedor *</label>
									<select name="proveedor" id="proveedor" class="seleProveeM selectpicker form-control show-menu-arrow show-tick" data-style="btn-inverse" data-size="8" data-live-search="true" parsley-required="true">
										<option value="">- Selecciona -</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Fecha *</label>
									<div class="input-group date form_datetime" data-picker-position="bottom-left" data-date-time="2" data-date-format="dd MM yyyy HH:ii:ss P" >
										<input type="text" readonly name="fechabb" id="fechabb" class="form-control formatoFecha">
										<span class="input-group-btn">
											<button style="height: 34px;" class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
											<button style="height: 34px;" class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">Sucursal *</label>
									<select name="sucursal" id="sucursal" class="seleSucursalM selectpicker form-control show-menu-arrow show-tick" data-style="btn-inverse" data-size="8" data-live-search="true" parsley-required="true">
										<option value="">- Selecciona -</option>
									</select>
								</div>
							</div>
							
							<div class="panel-body panel corner-flip" style="border:1px solid rgb(221, 221, 221);border-radius:4px">
								<div id="prodSelec" class="form-group">
									<label class="control-label">Producto *</label>
									<select name="producto" id="producto" class="selecProdComV selectpicker form-control show-menu-arrow show-tick"  data-size="8" data-live-search="true" data-style="btn-inverse">
										<option value="">- Selecciona -</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Cantidad *</label>
									<input name="cantiddad" id="cantidad" type="text" class="form-control" placeholder="Cantidad de producto" >
								</div>
								<div class="form-group">
									<label class="control-label">Precio unitario *</label>
									<div class="input-group"> <span class="input-group-addon">$</span>
										<input name="precio" id="precio" type="text" class="form-control dinero" placeholder="Precio del producto" >
									</div>
								</div>
								<div class="form-group">
									<center>
										<button id="agregProduct-0" type="button" class="btn btn-success agregProduct"><i class="fa fa-plus-circle"></i> <strong>Agregar</strong></button>
									</center>
								</div>
							</div>
						</div>	
						
						<div class="col-sm-12 col-md-9">
							<div class="table-responsive" width="100%" >
								<table width="100%" style="color:black;text-align:center" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover" id="tablaComprasM">
								<thead id="" width="100%">
									<tr>
										<th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Precio</th><th></th>
									</tr>
								</thead>
								<tbody id="tablaComprasMP">
									
								</tbody>
								<tfoot id="tfTablaComprasMP">
									<tr><td colspan="3" style="text-align:center;font-weight:bold;font-size:15px"><strong>Total</strong></td><td style="font-weight:bold;font-size:15px" id="totalCPM">$0.00</td>
									<input type="hidden" name="total" id="total">
									<td>
								</td></tr>
								</tfoot>
								</table>
								<table class="widget-slide-setting">
									<tr>
										<td style="padding-right: 10px;"><label style="color:black;font-size:16px"><strong id="pagadComMat">Sin pagar</strong></label></td>
										<td style="padding-right: 10px;"><div class="ios-switch theme-inverse pull-right"><div class="switch"><input type="checkbox" id="notaPagada" name="notaPagada"></div></div></td>
										<td class="numDiasPag" style="padding-right: 10px;"><label style="color:black;font-size:16px" class="control-label">D&iacute;as para pagar*</label></td>
										<td class="numDiasPag"><input name="dias" id="dias" style="width: 70px;" type="text" class="form-control bfh-number" parsley-min="1" parsley-required="true" parsley-validation-minlength="1" data-min="1" placeholder="Solo n&uacute;meros"></td>
										<input type="hidden" name="estatus" value="Sin pagar" id="estatus">
									</tr>
								</table>
							</div>
						</div>
					</div>
					<br>
					<div class="form-group offset">
						<center >
							<button id="guardar" type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> <strong>Guardar</strong></button>
							<button type="reset" class="btn" onclick="$( '#formVentana' ).parsley( 'destroy' );cancelarTrCPM();"><i class="fa fa-times-circle"></i> <strong>Cancelar</strong></button>
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
			<h4 class="modal-title">Eliminar <strong> Producto</strong></h4>
		</div>
		<div class="modal-body">
			<section class="panel">
				<form id="formElimina" action="#" method="post" parsley-validate>
					 <input type="hidden" name="nomPagina" id="nomPagina" value="v_comprasV">
					 <input type="hidden" name="idElimina" id="idElimina" value="0">
					 <input type="hidden" name="cmo" id="" value="eliminar">			 
					<div class="panel-body">
						<center >
							<p> <h3><strong>&iquest;Desea eliminar a esta compra? <br><b id="nomUsuElim"></b></strong></h3></p>
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