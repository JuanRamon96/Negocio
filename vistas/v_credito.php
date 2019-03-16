	<!--	AQUI CAMBIA EL TIPO DE VENTA A REALIZAR		-->
<div id="fReportes" permiso="PRV" class="elfondo">
	<section class="panel corner-flip">			 
		<div class="panel-body" style="box-shadow: none;">
			<div class="col-md-3" style="float:left">
				<div class="panel-body panel corner-flip" style="border:1px solid rgb(221, 221, 221);border-radius:4px">
					<div class="row">
						<div class="text-center">
							<center>
								<div class="fileinput-new thumbnail" style="cursor:pointer;border-radius:4px;border:2px solid grey;width: 170px;">
									<a id="fotoVentaBuscar" href="vistas/images/picture.png" title="Foto de producto de venta" class="preview_fancybox">
										<img id="fotoProdVen" src="vistas/images/picture.png" alt="Foto producto">
									</a>
								</div>
							</center>
						</div>
					</div>
					<div id="prodSelec" class="form-group">
						<label class="control-label">Producto *</label>
						<div class="input-group"> <span class="input-group-addon"><i class="fa fa-search"></i></span>
							<input value="" name="productoBus" id="productoBus" type="search" class="form-control buscador" placeholder="Buscar...">
							<input value="" name="producto" id="producto" type="hidden" >
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Precio unitario *</label>
						<div class="input-group"> <span class="input-group-addon">$</span>
							<input readonly name="precio" id="precio" type="text" class="form-control dinero" placeholder="Precio del producto" >
							 <span class="input-group-addon"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Cantidad *</label> <label id="pTotal" class="control-label" style="float: right;font-size: 18px;font-weight: bold;">$0.00</label>
						<input value="1" onchange="multiplicarVenB()" inventario="0" name="cantidad" id="cantidad" type="text" class="form-control multiplicarVen numeroDecimales" placeholder="Cantidad de producto" >
						<div style="display:none" class="alert bg-danger">
							<strong>Invalido!! </strong> El valor debe estar entre <b></b> y <b></b>
						</div>
					</div>
					<div class="form-group">
						<center>
							<button id="agregProductVenta" onclick="nuevaVenta()" type="button" class="btn btn-success agregProductVenta-Clase"><i class="fa fa-plus-circle"></i> <strong>Agregar</strong></button>
						</center>
					</div>
				</div>
			</div>	
						
			<div class="col-md-9" style="float:left">
				<div class="table-responsive" width="100%" >
					<table width="100%" style="margin-bottom: 0 !important;color:black;text-align:center" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover table-responsive">
						<thead id="thVtab" width="100%">
							<tr>
								<th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Precio</th><th><span class='tooltip-area'><button id='eliminaTodosTrb' onclick='eliminaTodosTr()' type='button' class='btn btn-danger btn-danger' data-effect='md-flipHor'><i class='fa fa-trash-o'></i></button></span></th>
							</tr>
						</thead>
					</table>
					<div style="max-height: 300px; width: 100%; margin: 0; overflow-y: auto;" class="bodycontainer scrollable">
						<table width="100%" style="margin-bottom: 0 !important;margin: 0; padding: 0;color:black;text-align:center" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover table-responsive table-condensed table-scrollable" id="tablaVentasT">
							<tbody id="tablaVentas">
							
							</tbody>
						</table>
					</div>
					<table width="100%" style="color:black;text-align:center" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover table-responsive">
						<tfoot id="tfTablaVentas">
							<tr>
								<td style="padding:0;border-top:0;border:0;"></td>
								<td style="padding:0;border-top:0;border:0;"></td>
								<td style="padding:0;border-top:0;border:0;"></td>
								<td style="padding:0;border-top:0;border:0;"></td>
								<td style="padding:0;border-top:0;border:0;"></td>
							</tr>
							<tr>
								<td colspan="3" style="border-right-color: white;text-align:center;font-weight:bold;font-size:16px"><strong>Subtotal</strong></td>
								<td style="border-right-color: white;font-weight:bold;font-size:16px" id="subTotalVenta">$0.00</td>
								<td>
								</td>
							</tr>
							<tr>
								<td colspan="3" style="border-right-color: white;text-align:center;font-weight:bold;font-size:15px">
									<label style="color:black;font-size:16px">IVA</label>
								</td>
								<td style="border-right-color: white;font-weight:bold;font-size:16px" id="tdIva">$0.00</td>
								<td>
									<div style="right: 45px;margin-top: -10px;" class="iCheck pull-right"  data-color="green">	
										<input value="1" id="ivaVen" name="ivaVen" type="checkbox" checked>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="3" style="border-right-color: white;text-align:center;font-weight:bold;font-size:15px">
									<label style="color:black;font-size:16px">Descuento</label>
									<br><center>
										<div id="divDescuento" class="input-group oculto">
											<input onkeyup="porcentajeVenta(1)" onchange="porcentajeVenta(1)" style="width: 110px;" name="descuentoPorc" id="descuentoPorc" type="text" class="form-control operacionSumTot numeroDecimales" placeholder="Porcentaje de descuento" >
											 <span class="input-group-addon">%</span>
											 <span class="input-group-addon"> = </span>
											 <span class="input-group-addon">$</span>
											<input onkeyup="porcentajeVenta(2)" onchange="porcentajeVenta(2)" style="width: 110px;" name="descuentoDine" id="descuentoDine" type="text" class="form-control operacionSumTot dinero" placeholder="Monto a descontar" >
										</div>
									</center>
								</td>
								<td style="border-right-color: white;font-weight:bold;font-size:16px">-<span id="tdDesc">$0.00</span></td>
								<td>
									<div style="right: 45px;margin-top: -10px;" class="iCheck pull-right"  data-color="green">
										<input id="descuentoVen" name="descuentoVen" type="checkbox">
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="3" style="border-right-color: white;text-align:center;font-weight:bold;font-size:20px"><strong>Total</strong></td>
								<td style="border-right-color: white;font-weight:bold;font-size:30px" id="totalVenta">$0.00</td>
								<input type="hidden" name="total" id="total">
								<td>
								</td>
							</tr>
							<tr>
								<td colspan="3" style="border-right-color: white;text-align:center;font-weight:bold;font-size:16px"><strong>Importe pagado</strong></td>
								<td style="border-right-color: white;font-weight:bold;font-size:16px" id="imporVenta">
									<center>
										<div class="input-group" style="width: 100px;">
											<span class="input-group-addon">$</span>
											<input onkeyup="cambioVenta()" onchange="cambioVenta()" style="width: 150px;" name="importe" id="importe" type="text" class="form-control dinero" placeholder="Importe pagado" >
											
										</div>
									</center>
								</td>
								<td>
								</td>
							</tr>
							<tr>
								<td colspan="3" style="border-right-color: white;text-align:center;font-weight:bold;font-size:16px"><strong>Cambio</strong></td>
								<td style="border-right-color: white;font-weight:bold;font-size:16px" id="cambioVenta">$0.00</td>
								<td>
								</td>
							</tr>
						</tfoot>
					</table>	
					<div class="form-group offset" style="margin-top: 4%;">
						<center >
							<button style="margin-right: 80px;width: 175px;height: 60px;font-size: 18px;" id="guardar" type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> <strong>Finalizar Venta</strong></button>
							<button style="width: 175px;height: 60px;font-size: 18px;" type="button" class="btn" onclick="$('#ventaCancelar').attr('class','modal fade').addClass(data.effect).modal('show');"><i class="fa fa-times-circle"></i> <strong>Cancelar</strong></button>
						</center>
					</div>	
				</div>
			</div>
		</div>								
	</section>
</div>