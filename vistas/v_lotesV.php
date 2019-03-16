
	<ol class="breadcrumb">
		<li><a href="index.php">Inicio</a></li>
		<li><a href="#">Producto a la venta</a></li>
		<li><a href="#">Lotes de productos</a></li>
	</ol>
	<div id="content">
		<div class="touch-demo" id="touch-dragleft">
			<section recargaReporte="reporte" class="panel corner-flip">
				<header class="panel-heading">
					<h2><strong>Lotes</strong></h2>
				</header>
				<div class="panel-tools panel-tools-mini color circle panelBotones" align="right" data-toolscolor="#F4AD41">
					<div>
						<button type="button" class="btn btn-success btn-success ventaNuevo" data-effect="md-flipHor" data-target="0"><i class="fa fa-file"></i> Nuevo Lote</button>
						<ul class="tooltip-area redonda-lista">
							<li><a href="javascript:void(0)" class="btn btn-inverse btn-collapse" title="Contraer"><i class="fa fa-sort-amount-asc"></i></a></li>
							<li><a href="javascript:void(0)" class="btn btn-inverse btn-reload" reporte="reporte" title="Recargar"><i class="fa fa-retweet"></i></a></li>
							<li><a href="javascript:void(0)" class="btn btn-inverse btn-close" title="Cerrar"><i class="fa fa-times"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="panel-body">
					<div id="fReportes" permiso="PRV" class="elfondo row">		
						<div class="recargaElContenido col-md-12">#nomReporte#</div> <!-- 	PROHIBIDO ELIMINAR ESTA LINEA 	-->
					</div>
				</div>
				<div class="flip" />
			</section>
		</div>
	</div>

	<!--::::::::::::::::::::::::::::::::::::: NUEVO/MODIFICAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
	
	<div id="ventaNuevo0" class="modal fade corner-flip" tabindex="-1" data-width="1200">
		<div class="modal-header bg-inverse bd-inverse-darken">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
			<h4 class="modal-title"><p id="modAgrepro" style="width: 70%; display: inline-block;">Agregar nuevo <b>&nbsp; Lote de productos</b></p> 
				<p class="text-right" style="display: inline-block; font-size: 14px;">*campos obligatorios</p>
			</h4>
		</div>
		<div class="modal-body">
			<section class="panel corner-flip">
				<form id="formVentana" onsubmit="notaLoteG('tablaComprasMP');" action="#" method="post" parsley-validate>
					 <input type="hidden" name="nomPagina" id="nomPagina" value="v_lotesV">						<!-- MODIFICAR NOMBRE DE PAGINA-->
					 <input type="hidden" name="idR" id="idR" value="0">
					 <input type="hidden" name="cmo" id="cmo" value="insertar">	
					 <input type="hidden" name="detalles" id="detalles">					 
					<div class="panel-body row">
						<div class="col-sm-12 col-md-3">
							<div class="panel-body panel corner-flip" style="border:1px solid rgb(221, 221, 221);border-radius:4px">
								<div class="form-group">
									<label class="control-label">Folio *</label>
									<input data-vertical="left" data-horizontal="top" data-theme="danger" validar="codigo_lotesV" name="folio" id="folio" type="text" parsley-required="true"  parsley-trigger="focus" class="valida-campos form-control" placeholder="Folio &uacute;nico del lote" >
								</div>
								<div id="prodSelec" class="form-group">
									<label class="control-label">Producto elaborado*</label>
									<select name="producto" id="producto" class="selecProdComL selectpicker form-control show-menu-arrow show-tick"  data-size="8" data-live-search="true" data-style="btn-inverse">
										<option value="" >- Selecciona -</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Fecha inicial*</label>
									<div class="input-group date form_datetime" data-picker-position="bottom-left" data-date-time="2" data-date-format="dd MM yyyy" >
										<input type="text" readonly name="fechabb" id="fechabb" class="form-control formatoFecha">
										<span class="input-group-btn">
											<button style="height: 34px;" class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
											<button style="height: 34px;" class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">Fecha final*</label>
									<div class="input-group date form_datetime" data-picker-position="bottom-left" data-date-time="2" data-date-format="dd MM yyyy" >
										<input type="text" readonly name="fechabbF" id="fechabbF" class="form-control formatoFecha">
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
								<div class="form-group">
									<label class="control-label">Cantidad *</label>
									<input name="cantidad" id="cantidad" type="text" class="form-control" placeholder="Cantidad de producto elaborado" >
								</div>
							</div>
							
							<div class="panel-body panel corner-flip" style="border:1px solid rgb(221, 221, 221);border-radius:4px">
								<div id="prodSelec" class="form-group">
									<label class="control-label">Producto de materia prima*</label>
									<select name="productoM" id="productoM" class="selecProdComMLote selectpicker form-control show-menu-arrow show-tick"  data-size="8" data-live-search="true" data-style="btn-inverse">
										<option value="">- Selecciona -</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Sucursal de la materia prima*</label>
									<select name="sucursalM" id="sucursalM" rango="[0,0]" class="seleSucursalM selectpicker form-control show-menu-arrow show-tick" data-style="btn-inverse" data-size="8" data-live-search="true">
										<option value="">- Selecciona -</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Cantidad *</label>
									<input name="cantidadM" id="cantidadM" type="text" class="form-control bfh-number validaRango" parsley-range="[0,0]" parsley-trigger="change" parsley-validation-minlength="1" data-min="1" data-max="1" placeholder="Solo n&uacute;meros">
									<div style="display:none" class="alert bg-danger">
										<strong>Error!! </strong> El valor debe estar entre <b></b> y <b></b>
									</div>
								</div>
								<div class="form-group">
									<center>
										<button id="agregProduct-0" type="button" class="btn btn-success agregProductLo"><i class="fa fa-plus-circle"></i> <strong>Agregar</strong></button>
									</center>
								</div>
							</div>
						</div>	
						
						<div class="col-sm-12 col-md-9">
							<div class="widget-rating row">
								<div class="col-xs-12 col-md-6">
									<div class="well corner-flip flip-gray flip-bg-white bg-palevioletred-darken">
										<div class="row">
											<div class="col-xs-6 col-md-5 text-center">
												<div class="fileinput-new thumbnail col-xs-12" style="cursor:pointer;border-radius:4px;border:2px solid grey;">
													<a href="vistas/images/picture.png" title="Foto de producto de venta" class="preview_fancybox">
														<img id="fotoProdVen" src="vistas/images/picture.png" alt="Foto producto">
													</a>
												</div>
											</div>
											<div class="col-xs-6 col-md-7">
												<table>
													<tr style="border-bottom:1px solid gray" class="text-left"><td><label>Nombre: </label> </td>
														<td style="color:white" id="nombreProdLo"> </td>
													</tr>
													<tr style="border-bottom:1px solid gray" class="text-left"><td><label>Descripción: </label></td>
														<td style="color:white" id="descripcionProdLo"> </td>
													</tr>
													<tr style="border-bottom:1px solid gray" class="text-left"><td><label>Precio de venta: &nbsp;</label></td>
														<td style="color:white" id="precioProdLo"> </td>
													</tr>
												</table>
											</div>
										</div>
									</div>
				
								</div>
								<div class="col-sm-12 col-md-6">
									<div style="margin-top: 15%;">
										<button type="button" class="btn btn-primary estatLote"><span class="estatLoteEspan glyphicon glyphicon-cog"></span><span id="textoEstaus"> &nbsp;En proceso</span></button>
										<input type="hidden" id="estatus" name="estatus" value="En proceso">
									</div>
								</div>
							</div>
							<div class="table-responsive" width="100%">
								<table width="100%" style="color:black;text-align:center" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover" id="tablaComprasM">
								<thead id="" width="100%">
									<tr>
										<th>Producto</th><th>Cantidad</th><th>Sucursal</th><th>Costo Unitario</th><th>Costo</th><th></th>
									</tr>
								</thead>
								<tbody id="tablaComprasMP">
									
								</tbody>
								<tfoot id="tfTablaComprasMP">
									<tr><td colspan="4" style="text-align:center;font-weight:bold;font-size:15px"><strong>Costo por Producto elaborado </strong></td><td style="font-weight:bold;font-size:15px" id="totalCPPM">$0.00</td>
										<input value="0" type="hidden" name="total" id="total">
										<td>
										</td>						
									</tr>
									<tr><td colspan="4" style="text-align:center;font-weight:bold;font-size:15px"><strong>Costo Total</strong></td><td style="font-weight:bold;font-size:15px" id="totalCPM">$0.00</td>
										<input value="0" type="hidden" name="totalP" id="totalP">
										<td>
										</td>
									</tr>
								</tfoot>
								</table>
							</div>
						</div>
					</div>
					<br>
					<div class="form-group offset">
						<center >
							<button id="guardar" type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> <strong>Guardar</strong></button>
							<button type="reset" class="btn" onclick="$( '#formVentana' ).parsley( 'destroy' );cancelarLote();"><i class="fa fa-times-circle"></i> <strong>Cancelar</strong></button>
						</center>
					</div>						
				</form>
				<div class="flip" />
			</section>
		</div>
	</div>

	<!-- ::::::::::::::::::::::::::::::::::::: 	ELIMINAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::: -->
	<div id="ventaEliminar0" class="modal+ fade" tabindex="-1" data-width="700">
		<div class="modal-header bg-inverse bd-inverse-darken">
			<button id="eliminarCerrar" type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
			<h4 class="modal-title">Eliminar <strong> Lote</strong></h4>
		</div>
		<div class="modal-body">
			<section class="panel">
				<form id="formElimina" action="#" method="post" parsley-validate>
					 <input type="hidden" name="nomPagina" id="nomPagina" value="v_lotesV">
					 <input type="hidden" name="idElimina" id="idElimina" value="0">
					 <input type="hidden" name="cmo" id="" value="eliminar">			 
					<div class="panel-body">
						<center >
							<p> <h3><strong>&iquest;Desea eliminar este lote de productos? <br><b id="nomUsuElim"></b></strong></h3></p>
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
	
	<!-- ::::::::::::::::::::::::::::::::::::: 	MODIFICAR ESTATUS :::::::::::::::::::::::::::::::::::::::::::::::::: -->
	<div id="ventaEstatus0" class="modal fade" tabindex="-1" data-width="700">
		<div class="modal-header bg-inverse bd-inverse-darken">
			<button id="estatCerrar" type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
			<h4 class="modal-title">Modificar estatus del <strong> Lote</strong></h4>
		</div>
		<div class="modal-body">
			<section class="panel">
				 <input type="hidden" name="nomPaginax" id="nomPaginax" value="v_lotesV">
				 <input type="hidden" name="idEstatus" id="idEstatus" value="0">
				 <input type="hidden" name="cmo" id="" value="estatus">			 
				<div class="panel-body">
					<center >
						<p> <h3><strong>&iquest;Desea modificar el estatus de este lote? <br><b id="estatusMod"></b></strong></h3></p>
					</center >
				</div>
				<center>
				<div id="fechaTermino" class="form-group offset" style="margin-top: 1%;">
					<label class="control-label">Fecha de término del lote*</label>
					<div class="input-group date form_datetime col-md-6" data-picker-position="bottom-left" data-date-time="2" data-date-format="dd MM yyyy" >
						<input type="text" readonly name="fechafE" id="fechafE" class="fechEs form-control formatoFecha">						
						<span class="input-group-btn">
							<button style="height: 34px;" class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
							<button style="height: 34px;" class="btn btn-default fechEs" type="button"><i class="fa fa-calendar"></i></button>
						</span>
					</div>
					<br>
					<div id="errFeca" style="display:none;width: 60%;" class="alert bg-danger">
						<strong>Error!! </strong> Tienes que seleccionar una fecha para continuar
					</div>
				</div>
				<div class="form-group offset" style="margin-top: 1%;">
						<button type="button" class="btn btn-primary modEstatus"><i class="fa fa-check-circle"></i> <strong>Aceptar</strong></button>
						<button type="button" class="btn" onclick="$('#estatCerrar').trigger( 'click' );return false;"><i class="fa fa-times-circle"></i> <strong>Cancelar</strong></button>
				</div>
				</center>
			</section>
		</div>
	</div>
	
	<!--div class="load-overlay" style="opacity: 1; display: block;"><div><div class="c1"></div><div class="c2"></div><div class="c3"></div><div class="c4"></div></div><span>Guardando...</span></div-->
