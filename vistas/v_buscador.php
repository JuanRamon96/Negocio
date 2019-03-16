<!-- ::::::::::::::::::::::::::::::::::::: 	BUSCADOR PRODUCTO :::::::::::::::::::::::::::::::::::::::::::::::::: -->
	<div id="ventaBuscador" class="modal fade corner-flip" tabindex="-1" data-width="1000">
		<div class="modal-header bg-inverse bd-inverse-darken" style="height: 60px;">
			<button id="CerrarBuscador" type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
			<h4 class="modal-title">Seleccionar <strong> producto</strong>
				<div id="prodSelecV" class="form-group col-md-8" style="float: right;">
					<div class="input-group">
						<input value="" x-webkit-speech onwebkitspeechchange="alert($(this.val()))" name="productoBusV" id="productoBusV" padre="tbodyResult" type="search" class="form-control buscador" placeholder="Buscar...">
						 <span onclick="$(this).prev().trigger('search')" class="input-group-addon" style="cursor:pointer"><i class="fa fa-search"></i></span>
					</div>
				</div>
			</h4>
		</div>
		<div class="modal-body" style="width: 100%;">
			<section class="panel" id="tablaResulP">
				<div class="col-md-12 col-sm-12" style="overflow-x: scroll;">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped">
							<thead>
								<tr>
									<th>Producto</th>
									<th>Nombre</th>
									<th>Descripción</th>
									<th>Precio</th>
									<th>Medida</th>
								</tr>
							</thead>
							<tbody align="center" id="tbodyResult">
								
							</tbody>
						</table>
					</div>
				</div>
			</section>
		</div>
	</div>
	<style>
	  #tbodyResult .ui-selecting { background: #5AB5AD; }
	  #tbodyResult .ui-selected { background: #5AB5AD;}
	  #tbodyResult .ui-selected  td { background: #5AB5AD;}
	</style>