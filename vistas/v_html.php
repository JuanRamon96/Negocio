<!DOCTYPE html>
<html lang="es">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
 <!--meta name="viewport" content="width=device-width, initial-scale=.5, minimum-scale=.5, maximum-scale=.9"-->
 <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
 <title>Smart Point</title>
    <!-- Bootstrap core CSS -->
	<link type="text/css" rel="stylesheet" media="print" href="assets/css/imprimir.css" />
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css" />
	<link type="text/css" rel="stylesheet" href="assets/css/bootstrap/bootstrap-themes.css" />
	<link type="text/css" rel="stylesheet" href="assets/css/style.css" />
	<link rel="stylesheet" rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.5.1/css/colReorder.dataTables.min.css">
	 <link rel="stylesheet" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
	 <link type="text/css" rel="stylesheet" href="assets/css/css.css" />
	<!--<link type="text/css" rel="stylesheet" href="assets/plugins/datable/colvis.css" />-->
	<link rel="stylesheet" rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
	
	
	<!-- Styleswitch if  you don't chang theme , you can delete -->
	<link type="text/css" rel="alternate stylesheet" media="screen" title="style0" href="assets/css/styleTheme0.css" />
	<link type="text/css" rel="alternate stylesheet" media="screen" title="style1" href="assets/css/styleTheme1.css" />
	<link type="text/css" rel="alternate stylesheet" media="screen" title="style2" href="assets/css/styleTheme2.css" />
	<link type="text/css" rel="alternate stylesheet" media="screen" title="style3" href="assets/css/styleTheme3.css" />
	<link type="text/css" rel="alternate stylesheet" media="screen" title="style4" href="assets/css/styleTheme4.css" />
	<link rel="shortcut icon" href="vistas/images/favicon.ico">
</head>
<body class="leftMenu nav-collapse in">

 <audio id="player" src="audios/inicio.mp3"> </audio>
<!--div class="titulo">
<h1 style="width:1200px"> <b id="eltitulo" style="text-transform: capitalize;">#titulo#</b> </h1>
</div-->
<div id="wrapper" style="">
#menu#
#buscador#
	<div id="loading-top">
		<div id="canvas_loading"></div>
		<span>Identificando....</span>
	</div>
<div id="main" style="background: #e5e9ec;">
	<div>
	#login#
	#contenido#
	</div>
</div>
<input type="hidden" id="imprVentana" value="0">
<input type="hidden" id="mensajeNotif" name="mensajeNotif">
#enviar#
<!-- MENSAJES DE NOTIFICACIĂ“N  -->
<button id="btnAlertas" data-vertical="right" data-theme="primary" data-horizontal="top" class="btn btn-primary notific" style="display:none"></button>
</div>

   <!-- Jquery Library -->
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.ui.min.js"></script>
	<script type="text/javascript" src="assets/plugins/bootstrap/bootstrap.min.js"></script>
	<!-- Modernizr Library For HTML5 And CSS3 -->
	<script type="text/javascript" src="assets/js/modernizr/modernizr.js"></script>
	<script type="text/javascript" src="assets/plugins/mmenu/jquery.mmenu.js"></script>
	<script type="text/javascript" src="assets/js/styleswitch.js"></script>
	<!-- Library 10+ Form plugins-->
	<script type="text/javascript" src="assets/plugins/form/form.js"></script>
	<script type="text/javascript" src="assets/plugins/ckeditor/ckeditor.js"></script>
	<!-- Library Chart-->
	<script type="text/javascript" src="assets/plugins/chart/chart.js"></script>
	<!-- Library  5+ plugins for bootstrap -->
	<script type="text/javascript" src="assets/plugins/pluginsForBS/pluginsForBS.js"></script>
	<!-- Library 10+ miscellaneous plugins -->
	<script type="text/javascript" src="assets/plugins/miscellaneous/miscellaneous.js"></script>
	<!-- Library Themes Customize-->
	<script type="text/javascript" src="assets/js/caplet.custom.js"></script>
	<!-- Librerias de Datatables-->
	<!--<script type="text/javascript" src="assets/plugins/datable/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="assets/plugins/datable/dataTables.bootstrap.js"></script>
	<script type="text/javascript" src="assets/plugins/datable/tablesTools.js"></script>
	<script type="text/javascript" src="assets/plugins/datable/colvis.js"></script>-->
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" type="text/javascript" src="assets/js/script.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
	<!-- Library Editable -->
	<!--link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script-->
	<script type="text/javascript" src="assets/plugins/typeahead/typeahead.bundle.min.js"></script>
	<!-- Librerias de numeros -->
	<script type="text/javascript" src="assets/plugins/formatCurrency/jquery.formatCurrency-1.4.0.js"></script>
	<script type="text/javascript" src="assets/plugins/formatCurrency/jquery.formatCurrency-1.4.0.min.js"></script>
	<script type="text/javascript" src="assets/plugins/formatCurrency/jquery.formatCurrency-1.4.0.pack.js"></script>
	<script type="text/javascript" src="assets/plugins/formHelper/bootstrap-formhelpers.js"></script>
	<!-- Datetime plugins -->
	<script type="text/javascript" src="assets/plugins/datetime/datetime.js"></script>
	<!-- The Swipebox plugin -->
	<link href="assets/plugins/fancybox/jquery.fancybox.css" rel="stylesheet" />
	<script type="text/javascript" src="assets/plugins/fancybox/jquery.fancybox.js"></script>
	<script type="text/javascript" src="assets/plugins/gallery/jquery.loadImage.js"></script>
	<script type="text/javascript" src="assets/plugins/gallery/script.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.15.1/TweenLite.min.js"></script>
	<!--script type="text/javascript" src="http://l2.io/ip.js?var=myip"></script-->
	#scripts#	
</body>
</html>