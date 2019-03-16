    <ol class="breadcrumb">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="#">Ventas</a></li>
    </ol>
	<div id="content">
        <div class="touch-demo" id="touch-dragleft">
            <section recargaReporte="reporte" class="panel corner-flip">
                <header class="panel-heading">
                    <h2><strong>Lista Ventas</strong></h2>
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