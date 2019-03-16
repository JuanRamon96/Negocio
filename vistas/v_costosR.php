
	<div id="content">
		<div class="row" id="touch-dragleft">
			<section recargaReporte="reporte" class="panel corner-flip">
				<header class="panel-heading">
					<h2><strong>Egresos</strong></h2>
				</header>
				<div class="panel-tools panel-tools-mini color circle" align="right" data-toolscolor="#F4AD41">
					<ul class="tooltip-area redonda-lista">
						<li><a href="javascript:void(0)" class="btn btn-inverse btn-collapse" title="Contraer"><i class="fa fa-sort-amount-asc"></i></a></li>
						<li><a href="javascript:void(0)" class="btn btn-inverse btn-reload" reporte="reporte" title="Recargar"><i class="fa fa-retweet"></i></a></li>
						<li><a href="javascript:void(0)" class="btn btn-inverse btn-print"  title="Imprimir"><i class="fa fa-print"></i></a></li>
						<li><a href="javascript:void(0)" class="btn btn-inverse btn-close" title="Cerrar"><i class="fa fa-times"></i></a></li>
					</ul>
				</div>
				 <input type="hidden" name="nomPagina" id="nomPagina" value="v_costosR" class="reporGrafi">
				<div class="panel-body">
					<div id="fReportes" permiso="USV" class="elfondo">
						
						<div class="recargaElContenido">#nomReporte#</div> <!-- 	PROHIBIDO ELIMINAR ESTA LINEA 	-->
					</div>
				</div>
			</section>
			
			<section recargaReporte="consultab" class="panel corner-flip">
				<header class="panel-heading">
					<h3><strong class="" id="titGrafRecib">Gráficas</strong>
						<div id="divCambiaGrafica" class="btn-group" style="left: 29%;">
							<button type="button" class="cambiaGrafica btn btn-purple btn-transparent active" grafica="Sin liquidar">Sin liquidar</button>
							<button type="button" class="cambiaGrafica btn btn-purple btn-transparent" grafica="Liquidadas">Liquidadas</button>
							<button type="button" class="cambiaGrafica btn btn-purple btn-transparent" grafica="Pagadas">Pagadas</button>
						</div>
					</h3>
					<input type="hidden" name="filEgreso" id="filEgreso" value="">
					<div style="top: 0;" class="panel-tools panel-tools-mini color circle" align="right" data-toolscolor="#F4AD41">
						<ul class="tooltip-area redonda-lista">
							<li><a href="javascript:void(0)" class="btn btn-inverse btn-collapse" title="Contraer"><i class="fa fa-sort-amount-asc"></i></a></li>
							<li><a href="javascript:void(0)" class="btn btn-inverse btn-reload" reporte="consultab" title="Recargar"><i class="fa fa-retweet"></i></a></li>
							<li><a href="javascript:void(0)" class="btn btn-inverse btn-print"  title="Imprimir"><i class="fa fa-print"></i></a></li>
							<li><a href="javascript:void(0)" class="btn btn-inverse btn-close" title="Cerrar"><i class="fa fa-times"></i></a></li>
						</ul>
					</div>
				</header>
				<div class="bg-lightseagreen bg-gradient-green recargaElContenido">
					<div class="panel-body">
							<div id="reportrangeRec" class="pull-right rangoFechas selecGraficas" reporte="reporteFechaGra" style="cursor: pointer; padding: 5px 10px 10px; margin-top:5px;">
								<i class="fa fa-calendar"></i>&nbsp;
								<span>
								</span>
								<b class="caret"></b>
							</div>

							<div class="pull-left col-md-2" style="">
								<select name="subyacenteSaldosB" id="subyacenteSaldosB" class="selecGraficas form-control show-menu-arrow show-tick selectpicker" parsley-required="true" data-size="8" data-live-search="true" data-style="btn-transparent">
									<option style="color:black" value="0">Todos los subyacentes</option>
									<option style="color:black" value="SORGO">Sorgo</option>
									<option style="color:black" value="MAIZ BLANCO">Ma&iacute;z blanco</option>
									<option style="color:black" value="MAIZ AMARILLO">Ma&iacute;z amarillo</option>
									<option style="color:black" value="TRIGO">Trigo</option>
									<option style="color:black" value="CARTAMO">C&aacute;rtamo</option>
									<option style="color:black" value="CEBADA">Cebada</option>
									<option style="color:black" value="AVENA">Avena</option>
								</select>
							</div>
							<div class="pull-left col-md-2" style="">
								<select name="cicloSaldosB" id="cicloSaldosB" class="selecGraficas form-control show-menu-arrow show-tick selectpicker" parsley-required="true" data-size="8" data-live-search="true" data-style="btn-transparent">
								</select>
							</div>
							<div class="pull-left col-md-2" style="">
								<select name="folioPuts" id="folioPuts" class="selecGraficas form-control show-menu-arrow show-tick selectpicker" parsley-required="true" data-size="8" data-live-search="true" data-style="btn-transparent">
									<option value="0">Todos los folios</option>
								</select>
							</div>
						
					</div>
					<div id="divmorrisArea" class="widget-chart chart-dark">
						<div id="morrisArea"></div>
					</div>
					<footer class="panel-footer align-lg-center" style="background-color:white">
						<div id="divTipoGrafica" class="btn-group">
							<button type="button" class="cambiaGraf btn btn-theme btn-transparent active" tipo="area">Area</button>
							<button type="button" class="cambiaGraf btn btn-theme btn-transparent" tipo="lines">Lineas</button>
							<button type="button" class="cambiaGraf btn btn-theme btn-transparent" tipo="bars">Barras</button>
							<button type="button" class="cambiaGraf btn btn-theme btn-transparent" tipo="donut">Dona</button>
						</div>
					</footer>
				</div> <!-- 	PROHIBIDO ELIMINAR ESTA LINEA 	-->
			</section>
		</div>
	</div>
	

