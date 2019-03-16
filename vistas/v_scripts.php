<script>
	$(document).ready(function(){
		// OBTENER COOKIES
		/*alert(document.cookie);
		alert(myip);
		function obteCokie(){
			var coc = document.cookie;
			alert(coc);
			coc = coc.split(';');
			for(var xs=0;xs<coc.length;xs++){
				var elimi = coc[xs].split('=');
				alert(elimi[0]);
				document.cookie = elimi[0]+'=; expires=Thu, 01 Jan 1970 00:00:00 UTC';
			}
			alert(document.cookie);
		}
		obteCokie();
		$('nav#menu-ver').mmenu({
			searchfield   :  true,	
			slidingSubmenus	: false //  change setting slidingSubmenus from true to false
		}).on( "closing.mm", function(){
			setTimeout(function () { closeSub() }, 200);
			function closeSub(){
				var nav=$('nav#menu-ver');
					nav.find("li").each(function(i) {
						$(this).removeClass("mm-opened");	
					});
			}
		});
		//Drag Left
		var touchWrapper=document.getElementById("wrapper");
		if(touchWrapper){
			var wrapper= Hammer( touchWrapper );
			 wrapper.on("swiperight", function(event) {	// hold , tap, doubletap ,dragright ,swipe, swipeup, swipedown, swipeleft, swiperight
				if((event.gesture.deltaY<=7 && event.gesture.deltaY>=-7) && event.gesture.deltaX >100){
					$('nav#menu').trigger( 'open.mm' );
				}
			 });
			 wrapper.on("dragleft", function(event) {
				if((event.gesture.deltaY<=5 && event.gesture.deltaY>=-5) && event.gesture.deltaX <-100){
					$('nav#contact-right').trigger( 'open.mm' );
				}
			 });
		}
		 */
		menuPaginas();
		animacionB();
		animarInicio();
		$("#usr").change(function(){
			fotoLoginf($(this).val());
		});
		// SONIDO INICIO
		//document.getElementById('player').play();
		function toCenter(){
			var mainH=$("#main").outerHeight();
			var accountH=$(".account-wall").outerHeight();
			var marginT=(mainH-accountH)/2;
		   if(marginT>30){
			   $(".account-wall").css("margin-top",marginT-15);
			}else{
				$(".account-wall").css("margin-top",30);
			}
		}
		toCenter();
		var toResize;
		$(window).resize(function(e) {
			clearTimeout(toResize);
			toResize = setTimeout(toCenter(), 1000);
		});
		/*		
		//Canvas Loading
		var throbber = new Throbber({  size: 32, padding: 17,  strokewidth: 2.8,  lines: 12, rotationspeed: 0, fps: 15 });
		throbber.appendTo(document.getElementById('canvas_loading'));
		throbber.start();*/
		guardar(); // ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::	GUARDADO MEDIANTE AJAX
		// animacionSpiders();
		//epanelTools();
	});

</script>