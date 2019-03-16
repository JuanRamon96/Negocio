			<canvas id="spiders"></canvas>
			<div id="principal">									
				<div style="position:absolute;bottom:-180px;left:-1400px;height:300px;width:3800px;border-radius:50%;background:rgba(72,209,204,0.5)" id="cirG1"></div>										
				<div style="position:absolute;bottom:-150px;left:-1400px;height:300px;width:3800px;border-radius:50%;background:rgba(72,209,204,0.5)" id="cirG2"></div>
				<!--div style="position:absolute;bottom:-180px;left:-1400px;height:300px;width:3800px;border-radius:50%;background:rgba(245,6,6,0.5)" id="cirG1"></div>										
				<div style="position:absolute;bottom:-150px;left:-1400px;height:300px;width:3800px;border-radius:50%;background:rgba(245,6,6,0.5)" id="cirG2"></div-->
				<div style="position:absolute;bottom:-200px;left:-1400px;height:300px;width:3800px;border-radius:50%;border:3px solid white" id="cirG3"></div>
				<div style="position:absolute;bottom:-200px;left:-1400px;height:300px;width:3800px;border-radius:50%;border:1px solid white" id="cirG4"></div>
				<div style="position:absolute;bottom:-200px;left:-1400px;height:300px;width:3800px;border-radius:50%;border:1px solid white" id="cirG6"></div>
				<div style="position:absolute;bottom:-200px;left:-1400px;height:300px;width:3800px;border-radius:50%;border:1px solid white" id="cirG5"></div>
				<table style="position:absolute;top:0;left:0; padding-left:40px;width:100%;height:100%;">
					<tr style="height:100%;"><td id="principalInner" style="overflow:auto;height:100%;vertical-align:top"></td></tr>
				</table>
			</div>
		<!--canvas id="world"></canvas-->
		
		<div class="real-boxs">
			<div class="container">
				<div class="row">
					<div class="col-lg-24" style="margin-top: -80px;">
						<div class="account-wall">
							<section class="align-lg-center">
								<img src="vistas/images/logoPaloma3.png"></img>
								<!--h1 class="login-title"><span>&#161;Bienvenido a Confecciones Lizareli!</span></h1-->
							</section>
							<form data-effect="md-flipHor" id="form-signin" class="form-signin md-effect box-feed" title="Inicia sesi&oacute;n" name="myForm" action="index.php?cml=login" method="post">
								<section class="align-lg-center">
									<span class="account-avatar easy-chart" data-color="danger" data-track-color="#d7dcde" data-line-width="5" data-size="118">
										<img alt="" id="fotoLogin" src="assets/img/avatar7.gif" class="circle">
									</span>
								</section>
								<section>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-building-o"></i></div>
										<input required type="text" class="form-control rounded" id="idc" name="idc" placeholder="No. de empresa">
									</div>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-user"></i></div>
										<input required type="text" class="form-control rounded" id="usr" name="usr" placeholder="Usuario">
									</div>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-key"></i></div>
										<input required type="password" class="form-control rounded" id="pwd" name="pwd" placeholder="Contrase&ntilde;a">
									</div>
									<input type="submit" style="display:none" id="submitLogin">
									<button class="btn btn-lg btn-theme-inverse btn-block" id="sign-in">Entrar</button>
								</section>
								<section class="clearfix">
									<div class="iCheck pull-left"  data-color="red">
										<input type="checkbox" checked>
										<label>Recordar</label>
									</div>
									<a href="#" onclick="olvidarcontra()" class="pull-right help">Olvido su contrase&ntilde;a?</a>
								</section>		
							</form>
							<a href="#" class="footer-link">&copy;  2018 Smart Point S.A. de C.V. &trade; </a>
						</div>	
						<!-- //account-wall-->
					</div>
					<!-- //col-sm-6 col-md-4 col-md-offset-4-->
				</div>
				<!-- //row-->
			</div>
			<!-- //container-->
		</div>
		<!-- //main-->
		