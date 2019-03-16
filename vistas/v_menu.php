
		<!--
		/////////////////////////////////////////////////////////////////////////
		//////////     HEADER  CONTENT     ///////////////
		//////////////////////////////////////////////////////////////////////
		-->
		<div id="header">
				<div class="logo-area clearfix">
					<a href="index.php" class="logo"></a>
				</div>
				<!-- //logo-area-->
				<div class="tools-bar">
						<ul class="nav navbar-nav nav-main-xs">
								<li><a href="#" class="icon-toolsbar nav-mini"><i class="fa fa-bars"></i></a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right tooltip-area">
								<li><a data-toggle="tooltip"  data-container="body"  data-placement="bottom" title="Venta" href="#" onclick="$('#venContad').trigger('click')" ><i class="fa fa-shopping-cart hidden-md hidden-lg "></i></a></li>
								<li style="margin-top: 10px;" id="bHora" class="btn btn-theme-inverse btnHora"><span class="cl-digital" id="cl-digital-Menuarr"></span></li>
								<li><a href="#menu-right" data-toggle="tooltip" title="Menu derecho" data-container="body" data-placement="left"><i class="fa fa-align-right"></i></a></li>
								<li class="hidden-xs hidden-sm"><a href="#" class="h-seperate">Ayuda</a></li>
								<li><button class="btn btn-circle btn-header-search" ><i class="fa fa-search"></i></button></li>
								<li><a href="#" class="nav-collapse avatar-header">
												<img alt="" src="#fotoUsuario#"  class="circle">
												<!--span class="badge">3</span-->
										</a>
								</li>
								<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
											<em><strong>Hola</strong>, #usuario# </em> <i class="dropdown-icon fa fa-angle-down"></i>
										</a>
										<ul class="dropdown-menu pull-right icon-right arrow">
												<li><a href="#"><i class="fa fa-user"></i> Perfil</a></li>
												<li><a href="#"><i class="fa fa-cog"></i> Configurar </a></li>
												<li><a href="#"><i class="fa fa-cog"></i> Cambiar contrase&ntilde;a </a></li>
												<li class="divider"></li>
												<li><a href="?cmdo=logout"><i class="fa fa-sign-out"></i> Cerrar sesi&oacute;n </a></li>
										</ul>
										<!-- //dropdown-menu-->
								</li>
								<li class="visible-lg">
									<a href="#" class="h-seperate fullscreen" data-toggle="tooltip" title="Pantalla completa" data-container="body"  data-placement="left">
										<i class="fa fa-expand"></i>
									</a>
								</li>
						</ul>
						<ul class="nav navbar-nav nav-top-xs hidden-xs hidden-sm tooltip-area">
								<li class="h-seperate"></li>
								<li class="dropdown">
									<a data-toggle="tooltip"  data-container="body"  data-placement="bottom" title="Venta" href="#" onclick="$('#hventa').trigger('click')" ><i class="fa fa-shopping-cart"></i></a>
									<!--ul class="dropdown-menu arrow animated fadeInDown fast">
										<li><a href="#" onclick="$('#venContad').trigger('click')"> Venta </a></li>
										<li><a href="#" onclick="$('#venAbono').trigger('click')"> Abono </a></li>
									</ul-->
									<!-- //dropdown-menu-->
								</li>
								<li class="h-seperate"></li>
								<li><a href="#" data-toggle="tooltip" title="Consultar productos" data-container="body"  data-placement="bottom"><i class="fa fa-laptop"></i></a></li>
								<li class="h-seperate"></li>
								<li><a href="#"> No. empresa <b>#noempresa#</b></a></li>
						</ul>
				</div>
				<!-- //tools-bar-->
		</div>
		<!-- //header-->
		
		
		<!--
		/////////////////////////////////////////////////////////////////////////
		//////////     SLIDE LEFT CONTENT     //////////
		//////////////////////////////////////////////////////////////////////
		-->
		<div id="nav">
				<div id="nav-scroll">
						<div class="avatar-slide">
						
								<span class="easy-chart avatar-chart" data-color="theme-inverse" data-percent="100" data-track-color="rgba(255,255,255,0.1)" data-line-width="5" data-size="118">
										<span class="percent"></span>
										<img alt="" src="#fotoUsuario#" class="circle">
								</span>
								<!-- //avatar-chart-->
								
								<div class="avatar-detail">
										<p><strong>#usuario#</strong></p>
										<p><a href="#">Arandas Jal.</a></p>
										<span>110 Ventas</span>
										<span>$110.00 Comisiones</span>
								</div>
								<!-- //avatar-detail-->
								
								<div class="avatar-link btn-group btn-group-justified">
										<a class="btn" href="profile.html"  title="Portfolio"><i class="fa fa-briefcase"></i></a>
										<a class="btn"  data-toggle="modal" href="#md-notification" title="Notification">
												<i class="fa fa-bell-o"></i><em class="green"></em>
										</a>
										<a class="btn"  data-toggle="modal" href="#md-messages"  title="Messages">
												<i class="fa fa-envelope-o"></i><em class="active"></em>
										</a>
										<a class="btn" href="#menu-right" title="Contact List"><i class="fa fa-book"></i></a>
								</div>
								<!-- //avatar-link-->
								
						</div>
						<!-- //avatar-slide-->
						
						
						<div class="widget-collapse dark">
								<header>
										<a data-toggle="collapse" href="#collapseSummary"><i class="collapse-caret fa fa-angle-up"></i> Summary Order </a>
								</header>
								<section class="collapse in" id="collapseSummary">
										<div class="collapse-boby" style="padding:0">
										
												<div class="widget-mini-chart align-xs-left">
														<div class="pull-right" >
																<div class="sparkline mini-chart" data-type="bar" data-color="theme" data-bar-width="10" data-height="35">2,3,4,5,7,4,5</div>
														</div>
														<p>This week's balance</p>
														<h4>$12,788</h4>
												</div>
												<!-- //widget-mini-chart -->
												
												<div class="widget-mini-chart align-xs-right">
														<div class="pull-left">
																<div class="sparkline mini-chart" data-type="bar" data-color="warning" data-bar-width="10" data-height="45">2,3,7,5,4,6,6,3</div>
														</div>
														<p>This week sales</p>
														<h4>1,325 item</h4>
												</div>
												<!-- //widget-mini-chart -->
												
										</div>
										<!-- //collapse-boby-->
										
								</section>
								<!-- //collapse-->
						</div>
						<!-- //widget-collapse-->
						
						
						
						<div class="widget-collapse dark">
								<header>
										<a data-toggle="collapse" href="#collapseTasks"><i class="collapse-caret fa fa-angle-down"></i> (2) Tasks processing </a>
								</header>
								<section class="collapse" id="collapseTasks">
								
										<div class="collapse-boby">
										
												<div class="widget-slider">
														<p>Upload status</p>
														<div class="progress progress-dark progress-xs tooltip-in">
																<div class="progress-bar bg-darkorange" aria-valuetransitiongoal="75"></div>
														</div>
														<label class="progress-label">Master.zip 4 / 5 </label>
														<!-- //progress-->
														
														<div class="progress progress-dark progress-xs">
																<div class="progress-bar bg-theme-inverse" aria-valuetransitiongoal="45"></div>
														</div>
														<label class="progress-label lasted">Profile 2 / 5 </label>
														<!-- //progress-->
														
												</div>
												<!-- //widget-slider-->
												
										</div>
										<!-- //collapse-boby-->
										
								</section>
								<!-- //collapse-->
						</div>
						<!-- //widget-collapse-->
						
						
						
						<div class="widget-collapse dark">
								<header>
										<a data-toggle="collapse" href="#collapseSetting"><i class="collapse-caret fa fa-angle-up"></i> Setting Option </a>
								</header>
								<section class="collapse in" id="collapseSetting">
										<div class="collapse-boby" style="padding:0">
										
												<ul class="widget-slide-setting">
														<li>
																<div class="ios-switch theme pull-right">
																		<div class="switch"><input type="checkbox" name="option"></div>
																</div>
																<label>Switch <span>OFF</span></label>
																<small>Lorem ipsum dolor sit amet</small>
														</li>
														<li>
																<div class="ios-switch theme-inverse pull-right">
																		<div class="switch"><input type="checkbox" name="option_1" checked></div>
																</div>
																<label>Switch <span>ON</span></label>
																<small>Lorem ipsum dolor sit amet</small>
														</li>
												</ul>
												<!-- //widget-slide-setting-->
												
										</div>
										<!-- //collapse-boby-->
										
								</section>
								<!-- //collapse-->
						</div>
						<!-- //widget-collapse-->
						
						
				</div>
				<!-- //nav-scroller-->
		</div>
		<!-- //nav-->

		<!--
		/////////////////////////////////////////////////////////////////////////
		//////////     TOP SEARCH CONTENT     ///////
		//////////////////////////////////////////////////////////////////////
		-->
		<div class="widget-top-search">
			<span class="icon"><a href="#" class="close-header-search"><i class="fa fa-times"></i></a></span>
			<form id="top-search">
					<h2><strong>Busqueda</strong> Rapida</h2>
					<div class="input-group">
							<input id="buscadorPrincipal" type="search" name="q" placeholder="Buscar...." class="form-control buscador" />
							<span class="input-group-btn">
							<button class="btn" type="button" title="Buscar producto de venta"><i class="fa fa-search"></i></button>
							</span>
					</div>
			</form>
		</div>
		<!-- //widget-top-search-->
		
			<!--
		//////////////////////////////////////////////////////////////
		//////////     LEFT NAV MENU     //////////
		///////////////////////////////////////////////////////////
		-->
		<nav id="menu" >
			<ul>
				<li><a href="index.php"><i class="icon  fa fa-home"></i> Inicio </a></li>
				<li><a sonido="abrirVentana2" class="comando" carga="v_sucursales" href="#"><i class="icon  fa fa-map-marker"></i> Sucursales </a></li>
				<li><a sonido="abrirVentana2" class="comando" carga="v_proveedores" href="#"><i class="icon  fa fa-suitcase"></i> Proveedores </a></li>
				<li><a sonido="abrirVentana2" class="comando" carga="v_clientes" href="#"><i class="icon  fa fa-smile-o"></i> Clientes </a></li>
				<li><a sonido="abrirVentana2" class="comando" carga="v_empleados" href="#"><i class="icon  fa fa-users"></i> Personal </a></li>
				<li><span><i class="icon  fa fa-gears"></i> Materia prima</span>
					<ul>		
						<li><a sonido="abrirVentana2" class="comando" carga="v_productosM" href="#"><i class="icon  fa fa-tags"></i> Productos </a></li>
						<li><a sonido="abrirVentana2" class="comando" carga="v_comprasM" href="#"><i class="icon  fa fa-bookmark-o"></i> Compras </a></li>
						<li><a sonido="abrirVentana2" class="comando" carga="v_pagosM" href="#"><i class="icon  fa fa-minus-square"></i> Pagos </a></li>
						<li><a sonido="abrirVentana2" class="comando" carga="v_almacenM" href="#"><i class="icon  fa fa-building-o"></i> Inventario </a></li> 
					</ul>
				</li>
				<li><span><i class="icon  fa fa-tag"></i> Producto a la venta </span>
					<ul>
						<li><a sonido="abrirVentana2" class="comando" carga="v_productosV" href="#"><i class="icon  fa fa-tags"></i> Productos </a></li>
						<li><a sonido="abrirVentana2" class="comando" carga="v_comprasV" href="#"><i class="icon  fa fa-bookmark-o"></i> Compras </a></li>
						<li><a sonido="abrirVentana2" class="comando" carga="v_lotesV" href="#"><i class="icon  fa fa-plus-square"></i> Lotes </a></li>
						<li><a sonido="abrirVentana2" class="comando" carga="v_almacenV" href="#"><i class="icon  fa fa-building-o"></i> Inventario </a></li>
					</ul>
				</li>
				<li><span><i class="icon  fa fa-shopping-cart"></i> Ventas </span>
					<ul>
						<!--li><a sonido="abrirVentana2" class="comando" carga="v_credito" href="#"><i class="icon  fa fa-credit-card"></i> Cr&eacute;dito </a></li-->
						<li><a sonido="abrirVentana2" class="comando" carga="v_listaventas" href="#"><i class="icon  fa fa-money"></i> Ventas </a></li>
						<li><a id="hventa" sonido="abrirVentana2" class="comando" carga="v_contado" href="#"><i class="icon  fa fa-shopping-cart"></i> Hacer venta </a></li>
						<li><a sonido="abrirVentana2" class="comando" carga="v_pedidos" href="#"><i class="icon  fa fa-plane"></i> Pedidos </a></li>
						<li><a sonido="abrirVentana2" class="comando" carga="v_abonos" href="#" id="venAbono"><i class="icon  fa fa-plus-square"></i> Abonos </a></li>
					</ul>
				</li>
				<li><a sonido="abrirVentana2" class="comando" carga="v_gastos" href="#"><i class="icon  fa fa-minus-square"></i> Gastos </a></li>
				<li><a sonido="abrirVentana2" class="comando" carga="v_devoluciones" href="#"><i class="icon  fa fa-mail-reply-all"></i> Devoluciones </a></li>
				<li><span><i class="icon  fa fa-bar-chart-o"></i> Reportes </span>
					<ul>
						<li><a sonido="abrirVentana2" class="comando" carga="v_costosR" href="#"><i class="icon  fa fa-minus-circle"></i> Egresos </a></li>
						<li><a sonido="abrirVentana2" class="comando" carga="v_produccion" href="#"><i class="icon  fa fa-cog"></i> Producci&oacute;n </a></li>
						<li><a sonido="abrirVentana2" class="comando" carga="v_ventasR" href="#"><i class="icon  fa fa-money"></i> Ventas </a></li>
						<li><a sonido="abrirVentana2" class="comando" carga="v_comprasR" href="#"><i class="icon  fa fa-bookmark-o"></i> Compras </a></li>
						<li><a sonido="abrirVentana2" class="comando" carga="v_clientesR" href="#"><i class="icon  fa fa-smile-o"></i> Clientes </a></li>
						<li><a sonido="abrirVentana2" class="comando" carga="v_finanzasR" href="#"><i class="icon  fa fa-bar-chart-o"></i> Finanzas </a></li>
					</ul>
				</li>
				<li><a sonido="abrirVentana2" class="comando" carga="v_usuarios" href="#"><i class="icon  fa fa-user"></i> Usuarios </a></li>
			</ul>
		</nav>
		<!-- //nav left menu-->
		
				<!--
		/////////////////////////////////////////////////////////////////
		//////////     RIGHT NAV MENU     //////////
		/////////////////////////////////////////////////////////////
		-->
		<nav id="menu-right">
				<ul>
						<li class="Label label-lg">Color de tema</li>
						<li>
							<span class="text-center">
								<div id="style0" class="color-themes col0"></div>
								<div id="style1" class="color-themes col1"></div>
								<div id="style2" class="color-themes col2" ></div>
								<div id="style3" class="color-themes col3" ></div>
								<div id="style4" class="color-themes col4" ></div>
								<div id="none" class="color-themes col5" ></div>
							</span>
						</li>
						<li class="Label label-lg">Ganancias de la semana</li>
						<li>
							<section class="panel">
								<div class="widget-clock">
									<div id="clock"></div>
								</div>
							</section>
						</li>
				</ul>
		</nav>
		<!-- //nav right menu-->
