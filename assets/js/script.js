// INICIO DE SESION
function inicioSe(e){
	//Canvas Loading
	var throbber = new Throbber({  size: 32, padding: 17,  strokewidth: 2.8,  lines: 12, rotationspeed: 0, fps: 15 });
	throbber.appendTo(document.getElementById('canvas_loading'));
	throbber.start();
	
	var main=$("#main");
	//scroll to top
	main.animate({
		scrollTop: 0
	}, 500);
	main.addClass("slideDown");		
	// send username and password to php check login
	setTimeout(function () { main.removeClass("slideDown") }, !e ? 500:3000);
	if (e == 'false') {
		//$.notific8('Usuario o contrase\u00F1a incorrectos !! ',{ life:5000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR :); "});
		setTimeout(function () { $("#loading-top span").text("Usuario o contrase\u00F1a incorrectos !! ") }, 1000);
		return false;
	}
	setTimeout(function () { $("#loading-top span").text("Acceso correcto...") }, 1000);
	setTimeout(function () { $("#loading-top span").text("Ingresando al sistema...")  }, 1500);
	setTimeout( "window.location.href='index.php'", 3100 );
	
}

//FOTO DEL LOGIN
function fotoLoginf(nom){
	var datos = {"logi":"usuarios"};
	$.ajax({
		url: "index.php",
		type: "POST",
		data: datos,
		success: function(data) {
			var fot = 'assets/img/avatar7.gif';
			var cadena = data.split("~");
			var contador = 0;
			var contador2 = 0;
			while(contador < cadena[0]){
				if(nom == cadena[4 + contador2]){
					if(cadena[10 + contador2] != ""){
						fot = 'archivos/fotosUsuarios/'+cadena[10 + contador2];
					}
				}
				contador = contador + 1;
				contador2 = contador2 + parseInt(cadena[1]);
			}
			$("#fotoLogin").attr('src',fot);
		}
	});
}

// ANIMACION DE INICIO
function animarInicio() {
	animarG1();
	animarG2();
	animarG3();
	animarG4();
	animarG5();
	animarG6();
}
function animarG1() {
	$("#cirG1").animate({left:"-200px"}, 7500, function () {
  		$("#cirG1").animate({left:"-2400px"}, 7500, function () {
  			animarG1();
  		});
  	});
}
function animarG2() {
	$("#cirG2").animate({left:"-200px"}, 9000, function () {
  		$("#cirG2").animate({left:"-2400px"}, 9000, function () {
  			animarG2();
  		});
  	});
}
function animarG3() {
	$("#cirG3").animate({left:"-200px"}, 6000, function () {
  		$("#cirG3").animate({left:"-2400px"}, 6000, function () {
  			animarG3();
  		});
  	});
}
function animarG4() {
	$("#cirG4").animate({left:"-200px"}, 5000, function () {
  		$("#cirG4").animate({left:"-2400px"}, 5000, function () {
  			animarG4();
  		});
  	});
}
function animarG5() {
	$("#cirG5").animate({left:"-200px"}, 6000, function () {
  		$("#cirG5").animate({left:"-2400px"}, 4000, function () {
  			animarG5();
  		});
  	});
}
function animarG6() {
	$("#cirG6").animate({left:"-200px"}, 5500, function () {
  		$("#cirG6").animate({left:"-2400px"}, 5000, function () {
  			animarG6();
  		});
  	});
}	

/*
function animacionSpiders(){
			//+++++++++++++++++++++	ANIMACION SPIDERS

    var width, height, canvas, ctx, points, target, animateHeader = true;

    // Main
    initHeader();
    initAnimation();
    addListeners();

    function initHeader() {
        width = window.innerWidth;
        height = window.innerHeight;
        target = {
            x: width / 2,
            y: height / 3
        };

        canvas = document.getElementById( 'spiders' );
        canvas.width = width;
        canvas.height = height;
        ctx = canvas.getContext( '2d' );

        // create points
        points = [];
        for ( var x = 0; x < width; x = x + width / 20 ) {
            for ( var y = 0; y < height; y = y + height / 20 ) {
                var px = x + Math.random() * width / 20;
                var py = y + Math.random() * height / 20;
                var p = {
                    x: px,
                    originX: px,
                    y: py,
                    originY: py
                };
                points.push( p );
            }
        }

        // for each point find the 5 closest points
        for ( var i = 0; i < points.length; i++ ) {
            var closest = [];
            var p1 = points[ i ];
            for ( var j = 0; j < points.length; j++ ) {
                var p2 = points[ j ]
                if ( !( p1 == p2 ) ) {
                    var placed = false;
                    for ( var k = 0; k < 5; k++ ) {
                        if ( !placed ) {
                            if ( closest[ k ] == undefined ) {
                                closest[ k ] = p2;
                                placed = true;
                            }
                        }
                    }

                    for ( var k = 0; k < 5; k++ ) {
                        if ( !placed ) {
                            if ( getDistance( p1, p2 ) < getDistance( p1, closest[ k ] ) ) {
                                closest[ k ] = p2;
                                placed = true;
                            }
                        }
                    }
                }
            }
            p1.closest = closest;
        }

        // assign a circle to each point
        for ( var i in points ) {
            var c = new Circle( points[ i ], 2 + Math.random() * 2, 'rgba(255,255,255,0.3)' );
            points[ i ].circle = c;
        }
    }

    // Event handling
    function addListeners() {
        if ( !( 'ontouchstart' in window ) ) {
            window.addEventListener( 'mousemove', mouseMove );
        }
        window.addEventListener( 'scroll', scrollCheck );
        window.addEventListener( 'resize', resize );
    }

    function mouseMove( e ) {
        var posx = posy = 0;
        if ( e.pageX || e.pageY ) {
            posx = e.pageX;
            posy = e.pageY;
        } else if ( e.clientX || e.clientY ) {
            posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
            posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
        }
        target.x = posx;
        target.y = posy;
    }

    function scrollCheck() {
        if ( document.body.scrollTop > height ) animateHeader = false;
        else animateHeader = true;
    }

    function resize() {
        width = window.innerWidth;
        height = window.innerHeight;
        canvas.width = width;
        canvas.height = height;
    }

    // animation
    function initAnimation() {
        animate();
        for ( var i in points ) {
            shiftPoint( points[ i ] );
        }
    }

    function animate() {
        if ( animateHeader ) {
            ctx.clearRect( 0, 0, width, height );
            for ( var i in points ) {
                // detect points in range
                if ( Math.abs( getDistance( target, points[ i ] ) ) < 7000 ) {
                    points[ i ].active = 0.3;
                    points[ i ].circle.active = 0.6;
                } else if ( Math.abs( getDistance( target, points[ i ] ) ) < 40000 ) {
                    points[ i ].active = 0.1;
                    points[ i ].circle.active = 0.3;
                } else if ( Math.abs( getDistance( target, points[ i ] ) ) < 60000 ) {
                    points[ i ].active = 0.02;
                    points[ i ].circle.active = 0.1;
                } else {
                    points[ i ].active = 0;
                    points[ i ].circle.active = 0;
                }

                drawLines( points[ i ] );
                points[ i ].circle.draw();
            }
        }
        requestAnimationFrame( animate );
    }

    function shiftPoint( p ) {
        TweenLite.to( p, 1 + 1 * Math.random(), {
            x: p.originX - 50 + Math.random() * 100,
            y: p.originY - 50 + Math.random() * 100,
            onComplete: function() {
                shiftPoint( p );
            }
        } );
    }

    // Canvas manipulation
    function drawLines( p ) {
        if ( !p.active ) return;
        for ( var i in p.closest ) {
            ctx.beginPath();
            ctx.moveTo( p.x, p.y );
            ctx.lineTo( p.closest[ i ].x, p.closest[ i ].y );
            ctx.strokeStyle = 'rgba(255,255,255,' + p.active + ')';
            ctx.stroke();
        }
    }

    function Circle( pos, rad, color ) {
        var _this = this;

        // constructor
        ( function() {
            _this.pos = pos || null;
            _this.radius = rad || null;
            _this.color = color || null;
        } )();

        this.draw = function() {
            if ( !_this.active ) return;
            ctx.beginPath();
            ctx.arc( _this.pos.x, _this.pos.y, _this.radius, 0, 2 * Math.PI, false );
            ctx.fillStyle = 'rgba(255,255,255,' + _this.active + ')';
            ctx.fill();
        };
    }

    // Util
    function getDistance( p1, p2 ) {
        return Math.pow( p1.x - p2.x, 2 ) + Math.pow( p1.y - p2.y, 2 );
    }


		//++++++++++++++++++++++++++++++++++++++++++++++
}

*/
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function animacionB(){
var ide = $("#world").attr("id");
if(ide != undefined){
(function() {
  var COLORS, Confetti, NUM_CONFETTI, PI_2, canvas, confetti, context, drawCircle, i, range, resizeWindow, xpos;
  NUM_CONFETTI = 100;
  COLORS = [[85, 71, 106], [174, 61, 99], [219, 56, 83], [244, 92, 68], [248, 182, 70], [26, 188, 155], [212, 223, 90]];
  PI_2 = 2 * Math.PI;
  canvas = document.getElementById("world");
  context = canvas.getContext("2d");
  window.w = 0;
  window.h = 0;
  resizeWindow = function() {
    window.w = canvas.width = window.innerWidth;
    return window.h = canvas.height = window.innerHeight;
  };
  window.addEventListener('resize', resizeWindow, false);
  window.onload = function() {
    return setTimeout(resizeWindow, 0);
  };
  range = function(a, b) {
    return (b - a) * Math.random() + a;
  };
  drawCircle = function(x, y, r, style) {
    context.beginPath();
    context.arc(x, y, r, 0, PI_2, false);
    context.fillStyle = style;
    return context.fill();
  };
  xpos = 0.5;
  document.onmousemove = function(e) {
    return xpos = e.pageX / w;
  };
  window.requestAnimationFrame = (function() {
    return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(callback) {
      return window.setTimeout(callback, 1000 / 60);
    };
  })();
  Confetti = (function() {
    function Confetti() {
      this.style = COLORS[~~range(0, 5)];
      this.rgb = "rgba(" + this.style[0] + "," + this.style[1] + "," + this.style[2];
      this.r = ~~range(2, 6);
      this.r2 = 2 * this.r;
      this.replace();
    }
    Confetti.prototype.replace = function() {
      this.opacity = 0;
      this.dop = 0.03 * range(1, 4);
      this.x = range(-this.r2, w - this.r2);
      this.y = range(-20, h - this.r2);
      this.xmax = w - this.r;
      this.ymax = h - this.r;
      this.vx = range(0, 2) + 8 * xpos - 5;
      return this.vy = 0.7 * this.r + range(-1, 1);
    };

    Confetti.prototype.draw = function() {
      var _ref;
      this.x += this.vx;
      this.y += this.vy;
      this.opacity += this.dop;
      if (this.opacity > 1) {
        this.opacity = 1;
        this.dop *= -1;
      }
      if (this.opacity < 0 || this.y > this.ymax) {
        this.replace();
      }
      if (!((0 < (_ref = this.x) && _ref < this.xmax))) {
        this.x = (this.x + this.xmax) % this.xmax;
      }
      return drawCircle(~~this.x, ~~this.y, this.r, "" + this.rgb + "," + this.opacity + ")");
    };

    return Confetti;

  })();

  confetti = (function() {
    var _i, _results;
    _results = [];
    for (i = _i = 1; 1 <= NUM_CONFETTI ? _i <= NUM_CONFETTI : _i >= NUM_CONFETTI; i = 1 <= NUM_CONFETTI ? ++_i : --_i) {
      _results.push(new Confetti);
    }
    return _results;
  })();

  window.step = function() {
    var c, _i, _len, _results;
    requestAnimationFrame(step);
    context.clearRect(0, 0, w, h);
    _results = [];
    for (_i = 0, _len = confetti.length; _i < _len; _i++) {
      c = confetti[_i];
      _results.push(c.draw());
    }
    return _results;
  };

  step();

}).call(this);
}
}

function graficas(){
		var 	bars = false,
				lines = true,
				pie=false;
		var  	createFlot=function($chageType , $change){ 
					var el=$("table"+($change ? $change:".flot-chart"));
					el.each(function() {	  
							var colors = [], data = $(this).data(),
							gridColor=data.tickColor || "rgba(0,0,0,0.2)";
							$(this).find("thead th:not(:first)").each(function() {
							  colors.push($(this).css("color"));
							});
							if($chageType){
								bars = $chageType.indexOf("bars") != -1;
								lines = $chageType.indexOf("lines") != -1;
								pie = $chageType.indexOf("pie") != -1;
								$(this).next(".chart_flot").hide();
							}else{
								if(data.type){
									bars = data.type.indexOf("bars") != -1;
									lines = data.type.indexOf("lines") != -1;
									pie = data.type.indexOf("pie") != -1;
								}
							}
							$(this).graphTable({ series: 'columns', position: data.position || 'after',  width: data.width, height: data.height, colors: colors },
							{
									series: { stack: data.stack ,    pie: { show: pie , innerRadius: data.innerRadius || 0,  stroke: {  shadow: data.pieStyle=="shadow" ? true:false } , label:{ show:data.pieLabel } }, bars: { show: bars , barWidth: data.barWidth || 0.5, fill: data.fill || 1, align: "center"  } ,lines: { show: lines  , fill:0.1 , steps: data.steps } },
									xaxis: { mode:  data.mode || "categories", tickLength: 0 },
									yaxis: { tickColor: gridColor ,max:data.yaxisMax,
										tickFormatter: function number(x) {  var num; if (x >= 1000) { num=(x/1000)+"k"; }else{ num=x; } return num; }
									},  
									grid: { borderWidth: {top: 0, right: 0, bottom: 1, left: 1},color : gridColor },
									tooltip: data.toolTip=="show" ? true:false  ,
									tooltipOpts: { content: (pie ? "%p.0%, %s":"<b>%s</b> :  %y")  }
							});
					});
		}
		// Create Flot Chart
		createFlot();
		
		$(".chart-change a").click(function (e) {
				var el=$(this),data=el.data();
				el.closest(".chart-change").find("a").toggleClass("active");
				el.closest(".chart-change").find("li").toggleClass("active");
				createFlot(data.changeType,data.forId);
		});
		
		$(".label-flot-custom").each(function () {
			var el=$(this), data=el.data() ,colors = [] ,lable=[] , li="";
				$(data.flotId).find("thead th:not(:first)").each(function() {
							  colors.push($(this).css("color"));
							  lable.push($(this).text());
				});			
				for(var i=0;i<lable.length;i++){
					li += '<li><span style="background-color:'+ colors[i] +'"></span>'+ lable[i] +" ( "+$(data.flotId).find("tbody td").eq(i).text()+' ) </li> ';
				}
				el.append("<ul>"+li+"</ul>");
				if($(data.flotId).prev(".label-flot-custom-title")){
					var height=$(data.flotId).next(".chart_flot").css("height");
					$(data.flotId).prev(".label-flot-custom-title").css({"height":height, "line-height":height });
				}
		});
		
		//////////     KNOB  CHART     //////////
		$('.knob').each(function () {
			var thisKnob = $(this) , $data = $(this).data();
			$data.fgColor=$.fillColor( thisKnob ) || "#F37864";
			thisKnob.knob($data);
			if ( $data.animate ) {
				$({  value: 0 }).animate({   value: this.value }, {
					duration: 1000, easing: 'swing',
					step: function () { thisKnob.val(Math.ceil(this.value)).trigger('change'); }
				});
			}
		});
		$('.knob_save').on('click', function() {
			alert("Save  "+$("#add_item").val()+" Item");
		});
		$(".showcase-chart-knob").each(function () {
			var color='', ico=$(this).find("h5 i"),  $label=$(this).find("span"), $knob=$(this).find("input");
			$label.each(function (i) {
				if (i == 0) {
					color = $knob.attr("data-color")  || '#87CEEB' ;
				}else{
					color=$knob.attr("data-bgColor")  || '#CCC';
				}
				$(this).find("i").css("color", color );
				$(this).find("a small").css("color", color );
			});
			ico.css("margin-left",Math.ceil(-1*(ico.width()/2)));
		});
		
		
		
		//////////     SPARKLINE CHART     //////////
		$('.sparkline[data-type="bar"]').each(function () {
				var thisSpark=$(this) , $data = $(this).data();
				$data.barColor = $.fillColor( thisSpark ) || "#6CC3A0";
				$data.minSpotColor = false;
				thisSpark.sparkline($data.data || "html", $data);
		});	
		$('.sparkline[data-type="pie"]').each(function () {
				var thisSpark=$(this) , $data = $(this).data();
				$data.barColor = $.fillColor( thisSpark ) || "#6CC3A0";
				$data.minSpotColor = false;
				thisSpark.sparkline($data.data || "html", $data);
		});	
		var sparklineCreate = function($resize) {
			$('.sparkline[data-type="line"]').each(function () {
					var thisSpark=$(this) , $data = $(this).data();
					$data.lineColor = $.fillColor( thisSpark ) || "#F37864";
					$data.fillColor = $.rgbaColor( ($.fillColor( thisSpark ) || "#F37864") , 0.1 );
					$data.width = $data.width || "100%";
					$data.lineWidth = $data.lineWidth || 3;
					$(this).sparkline($data.data || "html", $data);
					if($data.compositeForm){
						var thisComposite=$($data.compositeForm);
						$comData=thisComposite.data();
						$comData.composite = true;
						$comData.lineWidth = $data.lineWidth || 3;
						$comData.lineColor = $.fillColor( thisComposite ) || "#F37864";
						$comData.fillColor = $.rgbaColor( ($.fillColor( thisComposite ) || "#6CC3A0") , 0.1 );
						$(this).sparkline($comData.data , $comData);
					}
			});
		}
		var sparkResize;
		$(window).resize(function(e) {
			clearTimeout(sparkResize);
			sparkResize = setTimeout(sparklineCreate(true), 500);
		});
		sparklineCreate();
		$('.label-sparkline span[data-color]').each(function(i) {
			var label=$(this);
			label.css("background-color", $.fillColor(label) );
		});
		
		
		
		//////////     EASY PIE CHART     //////////
		$('.easy-c').easyPieChart({
			lineCap: "butt",
			trackColor:'#EEE',
			barColor: "#F19F34",
			scaleColor:false,
			size:138,
			lineWidth:15
			,onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});
		$('.easy-chart').each(function () {
				var thisEasy=$(this) , $data = $(this).data();
				$data.barColor = $.fillColor( thisEasy ) || "#6CC3A0";
				$data.size = $data.size || 119;
				$data.trackColor = $data.trackColor  || "#EEE";
				$data.lineCap = $data.lineCap  || "butt";
				$data.lineWidth = $data.lineWidth  || 20;
				$data.scaleColor = $data.scaleColor || false,
				$data.onStep = function(from, to, percent) {
						//$(this.el).find('.percent').text(Math.round(percent));
						$(this.el).find('.percent').text(percent.toFixed(3));
					}
				thisEasy.find('.percent').css({"line-height": $data.size+"px"});
				thisEasy.easyPieChart($data);
		});	
		$('.js_update').on('click', function() {
			$('.easy-chart').each(function () {
				var chart = window.chart = $(this).data('easyPieChart');			  
				chart.update(Math.random()*100);			  
			});
		});


		// Slider right Flot Chart Real Time 
		var IDrealtimeChart=document.getElementById("realtimeChart");
		if(IDrealtimeChart){
				var livedata = [] , totalPoints = 12;
				function getRealtimeData() {
					if (livedata.length > 0)
						livedata = livedata.slice(1);
						while (livedata.length < totalPoints) {
							var prev = livedata.length > 0 ? livedata[livedata.length - 1] : 20,
								y = prev + Math.random() * 10 - 5;
								if (y < 0) {  y = 0; }else if (y > 30) { 	y = 30; }
							$("#realtimeChartCount  span").text(Math.ceil( y));
							livedata.push(y);
						}
						var res = [];
						for (var i = 0; i < livedata.length; ++i) {
							res.push([i, livedata[i]])
						}
					return res;
				}

				var updateInterval = 1000;
				var realtimePlot = $.plot("#realtimeChart", [ getRealtimeData() ], {
					colors: ["#F37864"],
					series: { lines: { show: true  , fill:0.1 } ,shadowSize: 0 },
					yaxis: { tickColor: "rgba(255,255,255,0.2)" ,min: 0, max: 30,},  
					grid: { borderWidth: { top: 0, right: 0, bottom: 1, left: 1 },color :  "rgba(255,255,255,0.2)" },
					tooltip: true,
					tooltipOpts: { content: ("%y")  },
					xaxis: { show: false}
				});
				function realtimeChart() {
					realtimePlot.setData( [getRealtimeData()] );
					realtimePlot.draw();
					setTimeout(realtimeChart, updateInterval);
				}
				realtimeChart();
		}
		
		$(".color-themes").click( function() {
				var colors=$(this).attr('id');
				chooseStyle(colors, 60);
				setTimeout(function () { 
					navRight.trigger( 'close.mm' );
				}, 500);  
				
		 });
}

//////////     RANGO DE FECHAS      //////////
function rangoFechas(){
		$('#daterange').daterangepicker();
		var laPagina = $("#nomPagina").val();
		$(".rangoFechas").each(function(){
			var ide = $(this).attr("id");
			var elemento = $(this);
			var nDias = 29;
			var nmes = 365;
			if($("#nomPagina").val() == "v_Rputs") {nmes = 335;}
			if($("#nomPagina").val() == "v_Rcalls") {nmes = 335;}
			if($("#nomPagina").val() == "v_Rrestantes") {nmes = 335;}
			if(ide == "reportrangeRec"){
				nDias = nmes;
			}
			$(this).daterangepicker({
				startDate: moment().subtract('days', nDias),
				endDate: moment(),
				minDate: '01/01/2012',
				//maxDate: '31/12/2015',
				dateLimit: { days: nmes },
				/*parentEl:"#main",*/
				timePicker: false,
				timePickerIncrement: 1,
				timePicker12Hour: true,
				ranges: {
				   //'Hoy': [moment(), moment()],
				   //'Ayer': [moment().subtract('days', 1), moment().subtract('days', 1)],
				   //'\u00DAltimos 7 d\u00EDas': [moment().subtract('days', 6), moment()],
				   'Este mes': [moment().startOf('month'), moment().endOf('month')],
				   '\u00DAltimo mes': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
				   '\u00DAltimos 3 meses': [moment().subtract('month', 2), moment()],
				   '\u00DAltimos 6 meses': [moment().subtract('month', 5), moment()],
				   '\u00DAltimos 12 meses': [moment().subtract('month', 11), moment()],
				},
				opens: 'left',
				buttonClasses: ['btn-sm'],
				applyClass: 'btn-inverse',
				cancelClass: 'btn-inverse',
				format: 'DD/MM/YYYY',
				separator: ' A ',
				locale: {
					fromLabel: 'De',
					toLabel: 'A',
					customRangeLabel: 'Rango de fecha',
					daysOfWeek: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie','Sab'],
					monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
					firstDay: 1
				}
			},
			function(start, end) {
				console.log("Callback has been called!");
				$("#"+ide+" span").html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
				var filtroFecha = start.format('YYYY-MM-DD') + '#' + end.format('YYYY-MM-DD');
				var elCilco = $("#cicloMenu").val();
				var elementoX = $(".btn-reload");
				if(ide == "reportrangeRec"){
						var productor = $("#productorSaldosB").val();
						var ciclo = $("#cicloSaldosB").val();
						var subyacente = $("#subyacenteSaldosB").val();
						var origen = $("#origenSaldosB").val();
						switch(laPagina){
							case 'v_Rsaldoproductores':
								grReporReciba("area",filtroFecha,productor,ciclo,subyacente,origen);
							break;
							case 'v_Rputs':
								grReporPuts("area",filtroFecha,productor,ciclo,subyacente);
							break;
							case 'v_Rcalls':
								grReporPuts("area",filtroFecha,productor,ciclo,subyacente);
							break;
							case 'v_Rrestantes':
								grReporPuts("area",filtroFecha,productor,ciclo,subyacente);
							break;
						}
				}else{
					reporteEspecifico(elementoX,filtroFecha,elCilco);
				}
			}
		  );
		  $(".rangoFechas span").text(moment().subtract('days', nDias+1).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
		});
		  //$("#"+ide+" span").html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
		  
		  //reportrange
}

/*
function sonidos(sonido){
	$("#player").attr("src","audios/"+sonido+".mp3");
	document.getElementById('player').play();

	/*var audio = document.createElement("audio");
	audio.src = "piano/3C.mp3";
	document.getElementById('player').play();	
	audio.addEventListener('ended', function () {
	// Esperar 500 ms antes del proximo loop
	setTimeout(function () { audio.play(); }, 500);
	}, false);
	audio.play();
}
*/

//LIMPIAR CARACTERES
function remove_accent(str) {
	//var map={'À':'A','Á':'A','Â':'A','Ã':'A','Ä':'A','Å':'A','Æ':'AE','Ç':'C','È':'E','É':'E','Ê':'E','Ë':'E','Ì':'I','Í':'I','Î':'I','Ï':'I','Ð':'D','Ñ':'N','Ò':'O','Ó':'O','Ô':'O','Õ':'O','Ö':'O','Ø':'O','Ù':'U','Ú':'U','Û':'U','Ü':'U','Ý':'Y','ß':'s','à':'a','á':'a','â':'a','ã':'a','ä':'a','å':'a','æ':'ae','ç':'c','è':'e','é':'e','ê':'e','ë':'e','ì':'i','í':'i','î':'i','ï':'i','ñ':'n','ò':'o','ó':'o','ô':'o','õ':'o','ö':'o','ø':'o','ù':'u','ú':'u','û':'u','ü':'u','ý':'y','ÿ':'y','Ā':'A','ā':'a','Ă':'A','ă':'a','Ą':'A','ą':'a','Ć':'C','ć':'c','Ĉ':'C','ĉ':'c','Ċ':'C','ċ':'c','Č':'C','č':'c','Ď':'D','ď':'d','Đ':'D','đ':'d','Ē':'E','ē':'e','Ĕ':'E','ĕ':'e','Ė':'E','ė':'e','Ę':'E','ę':'e','Ě':'E','ě':'e','Ĝ':'G','ĝ':'g','Ğ':'G','ğ':'g','Ġ':'G','ġ':'g','Ģ':'G','ģ':'g','Ĥ':'H','ĥ':'h','Ħ':'H','ħ':'h','Ĩ':'I','ĩ':'i','Ī':'I','ī':'i','Ĭ':'I','ĭ':'i','Į':'I','į':'i','İ':'I','ı':'i','Ĳ':'IJ','ĳ':'ij','Ĵ':'J','ĵ':'j','Ķ':'K','ķ':'k','Ĺ':'L','ĺ':'l','Ļ':'L','ļ':'l','Ľ':'L','ľ':'l','Ŀ':'L','ŀ':'l','Ł':'L','ł':'l','Ń':'N','ń':'n','Ņ':'N','ņ':'n','Ň':'N','ň':'n','ŉ':'n','Ō':'O','ō':'o','Ŏ':'O','ŏ':'o','Ő':'O','ő':'o','Œ':'OE','œ':'oe','Ŕ':'R','ŕ':'r','Ŗ':'R','ŗ':'r','Ř':'R','ř':'r','Ś':'S','ś':'s','Ŝ':'S','ŝ':'s','Ş':'S','ş':'s','Š':'S','š':'s','Ţ':'T','ţ':'t','Ť':'T','ť':'t','Ŧ':'T','ŧ':'t','Ũ':'U','ũ':'u','Ū':'U','ū':'u','Ŭ':'U','ŭ':'u','Ů':'U','ů':'u','Ű':'U','ű':'u','Ų':'U','ų':'u','Ŵ':'W','ŵ':'w','Ŷ':'Y','ŷ':'y','Ÿ':'Y','Ź':'Z','ź':'z','Ż':'Z','ż':'z','Ž':'Z','ž':'z','ſ':'s','ƒ':'f','Ơ':'O','ơ':'o','Ư':'U','ư':'u','Ǎ':'A','ǎ':'a','Ǐ':'I','ǐ':'i','Ǒ':'O','ǒ':'o','Ǔ':'U','ǔ':'u','Ǖ':'U','ǖ':'u','Ǘ':'U','ǘ':'u','Ǚ':'U','ǚ':'u','Ǜ':'U','ǜ':'u','Ǻ':'A','ǻ':'a','Ǽ':'AE','ǽ':'ae','Ǿ':'O','ǿ':'o'};
	var con = ["Ã","À","Á","Ä","Â","È","É","Ë","Ê","Ì","Í","Ï","Î","Ò","Ó","Ö","Ô","Ù","Ú","Ü","Û","ã","à","á","ä","â","è","é","ë","ê","ì","í","ï","î","ò","ó","ö","ô","ù","ú","ú","ü","û","Ç","ç"];
	var sin = ["A","A","A","A","A","E","E","E","E","I","I","I","I","O","O","O","O","U","U","U","U","a","a","a","a","a","e","e","e","e","i","i","i","i","o","o","o","o","u","u","u","u","u","c","c"];
	for (var i=0;i<str.length;i++){
		for (var x=0;x<sin.length;x++){
			if(str[i] == con[x]){
				str = str.replace(str[i],sin[x]);
			}
		}
	}
	return str;
} 

// 	MENU DE PAGINAS
//	::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function menuPaginas(){
	$(".comando").click(function(){
		var pagina = $(this).attr("carga");
		var sonido = $(this).attr("sonido");
		//sonidos(sonido);
		$("#main div").remove();
		$("#cargaScr").remove();
		var btn=$("#main");
		var datos = {"cmd": pagina};
		$.ajax({
			url: "index.php",
            method: "POST",
            data: datos,
			process: mientrasPagina(btn),
            success: function(data){
				btn.html(data);
				cargaVscript();
			}
        });
	});
}

function mientrasPagina(btnv){
	//var  btn=btnv, panelBody=btn.closest("#main"),
	overlay=$('<div class="load-overlay"><div><div class="c1"></div><div class="c2"></div><div class="c3"></div><div class="c4"></div></div><span>Cargando...</span></div>');
	$(overlay).appendTo(btnv);
	//panelBody.append(overlay);
	overlay.css('opacity',1.5).fadeIn();
	//panelBody.find(overlay).fadeOut("slow",function(){ $(this).remove() });
}

var conTRA = 0;
function cargaVscript(){
	/*
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
	*/	  
	conTRA = conTRA + 1;
	if(conTRA > 12){
		window.location.reload();
	}
	epanelTools();
		$(".md-effect").each(function(event){
			event.preventDefault();
			var data=$(this).data();
			$("#md-effect").attr('class','modal fade').addClass(data.effect).modal('show');
		});
		$("#main .switch")["bootstrapSwitch"]();
		$("#notaPagada").change(function (){
			if( $(this).is(':checked')){
				$("#pagadComMat").text("Pagado");
				$("#estatus").val("Pagado");
				$(".numDiasPag").hide();
			}else{
				$("#pagadComMat").text("Sin pagar");
				$("#estatus").val("Sin pagar");
				$(".numDiasPag").show();
			}
		});
		
		$("form").submit(function(e){
			e.preventDefault();
			if($(this).parsley( 'validate' )){
				
			}
		});
		
		//iCheck[components] validate
		$('input').on('change', function(event){
			$(event.target).parsley( 'validate' );
		});
		$(".preview_fancybox").fancybox({
			'transitionIn'	:	'elastic',
			'transitionOut'	:	'elastic',
			'speedIn'		:	600, 
			'speedOut'		:	800,
			//'titlePosition'		:	'over'
		});		
		//menuPaginas();
		popOverTablaM();
		popOverTablaV();
		formatos();
		ventanas();
		ventaModificar();
		ventaEliminar();
		dataTabla();								//con este hay error
		resizableThead();
		contraido();
		agregaNuevo();
		validarFormularios();
		$("#mensajeNotif").click(function(){
			alertas("");
		});
		//////////     MOBILE CHECK    //////////   
		var iOS = /(iPad|iPhone|iPod)/g.test( navigator.userAgent );
		var android = /mobile|android/i.test (navigator.userAgent);
		if(iOS || android){
			$("html").addClass("isMobile");
			if(iOS) { $(".form-control").css("-webkit-appearance","caret"); }
			$("select.input-sm,select.input-lg ").css("line-height","1.3");
		}
		fechaTiempo();
		selecionColor();
		//guardar(); // ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::	GUARDADO MEDIANTE AJAX
		validarCampos();
		// NO ELIMINAR LA LINEA DE ABAJO
		//notificacion
		var laPagina = $("#nomPagina").val();
		switch(laPagina){
			case "v_comprasM":
				$(".agregProduct").click(function (){
					nuevaCompraM();
				});
			break;
			case "v_comprasV":
				$(".agregProduct").click(function (){
					nuevaCompraM();
				});
			break;
			case "v_lotesV":
				$(".agregProductLo").click(function (){
					nuevOproducLote();
				});
				estatusLote();
				estatusLoteRe();
			break;
			case "v_gastos":
				selecOtrosGastos();
				totalGasto();
			break;
			case "v_costosR":
				BuscarRep();
				filtroEgreso();
				grReporPuts("area");
				cambiaGrafiPuts();
				cambiaGrafiReportePuts();
				filtroGraficaPuts();
				conAjax("coberturas", "folioPuts");
			break;
			case "v_contado":
				scrollStop();
				folioVenta();
				checKiva();
				$('.iCheck [name=ivaVen]').on('ifChanged', function(event){
					recorreTrVenta();
				});
				$('.iCheck [name=descuentoVen]').on('ifChanged', function(event){
					recorreTrVenta();
				});
				function totVent (){
					$("#totalVenta").addClass("btn-warning").delay(100).fadeOut(100).queue(function(){
						$(this).removeClass("btn-warning").fadeIn(100).dequeue();
					});
				}
				time=setInterval(totVent, 7000);
				selecTipoVenta();
			break;
			case "v_usuarios":
				btnrol();
			break;
		}
	// :::::::::::::::::::::::::::::::. 	PRODUCTOS A LA VENTA	::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		seleProveeV();
	// :::::::::::::::::::::::::::::::. 	PRODUCTOS DE MATERIA PRIMA	::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		
		seleProveeM();
		seleProductosM();
		// COMPRAS
		seleSucursalM();
		
	// INVENTARIOS

	// ::::::::::::::::::::::::::::::::::::::::::	LOTES 		::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::.:
		selectProductLote();
		selectProdMatePrimLote();
		
	// ::::::::::::::::::::::::::::::::::::::::::	GASTOS 		::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::.:
	
	// ::::::::::::::::::::::::::::::::::::::::::	VENTAS 		::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::.:
	
	seleClienteM();
	buscaProducto();
	// ::::::::::::::::::::::::::::::::::::::::::	USUARIOS	::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	//contraido();
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
		$('.selectpicker').selectpicker('mobile');
	}
	$('form')[0].reset();
	$('.selectpicker').selectpicker('refresh');
	$(".bfh-number").bfhnumber('refresh');
	//dispositivosM();
	// :::::::::::::::::::::::::::::::. 	REPORTES	::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	rangoFechas();
}

// AGRANDAR IMAGEN EN LOS SELECTS DE PRODUCTOS
function imageGrandCompr(){
	$(".preview_fancybox2").click(function(){
		var ide = $(this).attr("imagen_xpandir");
		$("#imagen_xpandir-"+ide+"").fancybox();
		$("#imagen_xpandir-"+ide+"").trigger("click");
	});
}

function epanelTools(){
		$('.panel-tools .btn-collapse').on('click', function () {
			//sonidos("boton");
            var btn=$(this), panelBody=btn.closest(".panel").find(".panel-body");
			btn.toggleClass("in");
			btn.find("i").toggleClass( "fa-sort-amount-desc" );
			btn.find("i").toggleClass( "fa-sort-amount-asc" );
			if ($(this).hasClass("in")) {
				panelBody.slideUp();
			} else {
				panelBody.slideDown();
			}
        	});	
		$('.panel-tools .btn-reload').click(function (e) {
			//sonidos("boton");
			var  btn=$(this);
			reporteEspecifico(btn);
		});
		$('.panel-tools .btn-print').on('click', function () {
            //var btn=$(this), panelBody=btn.closest(".panel").find(".panel-body");
			//btn.toggleClass("in");
				window.print();
        	});	
		$(".panel-tools").on('click',".btn-close",function(){
			//sonidos("boton");
				var panel=$(this).closest('.panel'), tools=$(this).closest('.panel-tools');
				console.log(tools)
				var confirmGroup=$('<div class="pt-confirm-group">'+'<div class=" btn-group btn-group-justified">'+'<a class="btn btn-inverse close-confirm" href="javascript:void(0)" data-confirm="accept">Si</a>'+'<a class="btn btn-theme btn-close" href="javascript:void(0)">No.</a>'+'</div>'+'</div>');
				var blockClose=$('<div class="blockerClose">');
				tools.toggleClass( "push-in");
				if(tools.hasClass("push-in")){
					tools.append(confirmGroup);
					panel.toggleClass( "push-in");
					blockClose.appendTo("#content");
					blockClose.css({ "height":$("#content").outerHeight() }).fadeTo(400,0.5);
					console.log($("#content").outerHeight())
				}else{
					$(".blockerClose").fadeOut(200,function(){ $(this).remove() }); 
					setTimeout(function () {
						 tools.find(".pt-confirm-group").remove(); 
						 panel.toggleClass( "push-in") ;
					}, 500);  
				}	  
		});
		$(".panel-tools").on('click','.close-confirm',function(){
			//sonidos("boton");
			$(this).closest('.panel').fadeOut(500,function(){
					$(this).remove();
					$(".blockerClose").fadeOut(200,function(){ $(this).remove() }); 
			});
		});
		 $('#content').on('click' ,'.blockerClose', function() {
			//sonidos("boton");
			var el=$(this); 
			el.fadeOut(200,function(){ $(this).remove() }); 
			$(".panel-tools.push-in").toggleClass("push-in",function(){
				var tools=$(this);
				setTimeout(function () { 
					tools.find(".pt-confirm-group").remove();
					tools.closest('.panel').removeClass("push-in");
				}, 500);  
			});	
		 });
}	

function mientras(btnv){
	var  btn=btnv, panelBody=btn.closest(".panel"),
	overlay=$('<div class="load-overlay"><div><div class="c1"></div><div class="c2"></div><div class="c3"></div><div class="c4"></div></div><span>Cargando...</span></div>');
	btn.removeClass("btn-panel-reload").addClass("disabled");
	panelBody.append(overlay);
	overlay.css('opacity',1).fadeIn();
	btn.removeClass("disabled").addClass("btn-panel-reload") ;
	panelBody.find(overlay).fadeOut("slow",function(){ $(this).remove() });
}	

// CALENDARIOS
function fechaTiempo(){
	$('.form_datetime').each(function(){
		var posicion = $(this).attr("data-picker-position");
		var formato = $(this).attr("data-date-format");
		var tiempo = $(this).attr("data-date-time");
		tiempo = parseInt(tiempo);
		var elide = $(this).parent();
		$(this).datetimepicker({
			bornIn: elide,
			pickerPosition : posicion,
			weekStart: 1,
			todayBtn:  1,
			autoclose: 1,
			forceParse: 0,
			todayHighlight: 1,
			startView: tiempo,
			showMeridian: true,
			minView: tiempo,
			format: formato,
		});
	});	
}

//////////     COLOR PICKER     //////////
function selecionColor(){
	$('[data-provide="colorpicker"]').each(function(i) {
		var id="color_"+i, $this=$(this).attr("id",id), data=$(this).data(),
		submit_btn=data.inline ? 0:1;
		if(data.addon && $this.is("input")){
			//$('#'+id).next().css("width",$(this).outerHeight());
			$('#'+id).next().css("width","150px");
		}
		var objeto = $("#ventaNuevo0");
		$this.colpick({
			bornIn:objeto,
			flat: data.inline || false,
			submit: submit_btn,
			layout: data.layout || 'hex',
			color: $this.val() || $.xcolor.random(),
			colorScheme: data.theme || "gray",
			onChange:function(hsb,hex,rgb) {
				$('#'+id).val('#'+hex);
				if(data.addon){
					$('#'+id).css({'border-color':'#'+hex });
					$('#'+id).next().css({'background-color':'#'+hex , 'border-color':'#'+hex });
				}
			},
			onSubmit:function(hsb,hex,rgb,el) {
				$(el).val('#'+hex); 
				$(el).colpickHide();
			}
		});
	});
}

//	::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

//TABLA DATATABLE
function fnShowHide( iCol , table){
	    var oTable = $(table).dataTable(); 
	    var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
	    oTable.fnSetColumnVis( iCol, bVis ? false : true );
}

function dataTabla(){
		var laPagina = $("#nomPagina").val();
	//////////     DATA TABLE  COLUMN TOGGLE    //////////
		$('[data-table="table-toggle-column"]').each(function(i) {
				var data=$(this).data(), 
				table=$(this).data("table-target"), 
				dropdown=$(this).parent().find(".dropdown-menu"),
				col=new Array;
				$(table).find("thead th").each(function(i) {
				 		$("<li><a  class='toggle-column' href='javascript:void(0)' onclick=fnShowHide("+i+",'"+table+"') ><i class='fa fa-check'></i> "+$(this).text()+"</a></li>").appendTo(dropdown);
				});
		});

		//////////     COLUMN  TOGGLE     //////////
		 $("a.toggle-column").on('click',function(){
				$(this).toggleClass( "toggle-column-hide" );  				
				$(this).find('.fa').toggleClass( "fa-times" );  			
		});
		
		var reporteEgr = reporteEgrb = reportfecegr = [];
		if(laPagina == "v_costosR"){
			reporteEgr={
              className: 'btn btn-danger reegreso active',
              text: '<span id="rgastos">Gastos</span>',
              exportOptions: {
                    columns: ':visible'
                },
              init: function(api, node, config) {
                 $(node).removeClass('dt-button buttons-excel buttons-html5 buttons-print '),
				 $(node).attr('reporte','reporte'),
				 $(node).attr('tegre','gasto')
              }
			};
			reporteEgrb={
              className: 'btn btn-theme-inverse reegreso active',
              text: '<span id="rcostos">Costos</span>',
              exportOptions: {
                    columns: ':visible'
                },
              init: function(api, node, config) {
                 $(node).removeClass('dt-button buttons-excel buttons-html5 buttons-print '),
				 $(node).attr('reporte','reporte'),
				 $(node).attr('tegre','costo')
              }
			};
			reportfecegr={
              className: 'nopaddingnoborder',
              text: '<div id="reportrange2" class="rangoFechas" reporte="reporteFecha" style="background: rgba(98, 112, 125, 1); color:#FFF; cursor: pointer; padding: 5px 10px 9px;z-index:5">\
							<i class="fa fa-calendar"></i>&nbsp;<span></span><b class="caret"></b></div>',
              exportOptions: {
                    columns: ':visible'
                },
              init: function(api, node, config) {
                 $(node).removeClass('dt-button buttons-excel buttons-html5 buttons-print ')
              }
			};
		}
		// Call dataTable in this page only
		var table = $('#tablaUsuarios').dataTable({
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "  ",
            "searchPlaceholder": "Buscar...",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        dom:"<'row'<'col-sm-2 col-md-1 ncolum'l><'col-sm-6 col-md-3 bBuscarD'f><'col-sm-4 col-md-8 DTBotones'B>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
		reportfecegr,reporteEgr,reporteEgrb,
        {
                extend: 'excelHtml5',
                className: 'btn btn-success',
              text: '<img src="assets/img/excel.png" width="18px" />',
              exportOptions: {
                    columns: ':visible'
                },
              init: function(api, node, config) {
                 $(node).removeClass('dt-button buttons-excel buttons-html5 buttons-print ')
              }
        },
        {
                extend: 'print',
                className: 'btn btn-primary',
              text: '<span class="glyphicon glyphicon-print"></span>',
              exportOptions: {
                    columns: ':visible'
                },
              init: function(api, node, config) {
                 $(node).removeClass('dt-button buttons-excel buttons-html5 buttons-print ')
              }
        },
        {
              extend: 'colvis',
              className: 'botonColvis',
              text: 'Columnas',
              init: function(api, node, config) {
                 $(node).removeClass('dt-button buttons-collection buttons-colvis dt-button buttons-columnVisibility ')
              }
        }
    ],
		});
    
    $(document).on("click", ".botonColvis", function(){
      $( ".dt-button" ).addClass('downButton').removeClass("dt-button");
    });
		$('table[data-provide="data-table"]').dataTable({
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "   ",
            "searchPlaceholder": "Buscar...",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        dom:"<'row'<'col-sm-1'l><'col-sm-12 col-md-9'f><'col-sm-12 col-md-2 DTBotones'B>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
        {
                extend: 'excelHtml5',
                className: 'btn btn-success',
              text: '<span class="glyphicon glyphicon-print"></span> <b>Excel</b>',
              exportOptions: {
                    columns: ':visible'
                },
        },
        {
                extend: 'print',
                className: 'btn btn-info',
              text: '<span class="glyphicon glyphicon-print"></span> <b>Imprimir</b>',
               exportOptions: {
                    columns: ':visible'
                },
        },
    
    ],

		});
// 	SUMA DE COLUMNAS DE LOS REPORTES (AUN FALTA RETOCAR)
		/*
		var idTabla = $(".dataTables_filter").attr("id").split("_");
		$("#"+idTabla[0]+"_filter_input").on( 'keyup', function () {
			var numerosTrs = $("#tablaUsuarios #imprimirTb tr").attr("numeroSuma");
			for(var i=0;i<parseInt(numerosTrs);i++){
				var mont = 0;
				$("#tablaUsuarios #imprimirTb tr").eq(0).each(function () {
					$(this).find('.tbSuma'+i+'').each(function () {
						var elmes = $(this).text();
						var diner1 = elmes.replace(',','');
						var diner2 = diner1.replace(',','');			
						var dinero = diner2.replace('$','');			
						mont = mont + parseFloat(dinero);
					});
				});
				$(".dataTables_scrollFoot .tfSuma"+i+"").text(mont).formatCurrency();
			}
		});
		*/
}

function resizableThead(){
	setTimeout(function() {
			$('.dataTables_scrollHeadInner #imprimirTh tr #thprimero').trigger("click");
			$('.dataTables_scrollHeadInner #imprimirTh tr #thprimero').trigger("click");
			$('.dataTables_scrollHeadInner #imprimirTh tr #thprimero').trigger("click");
			$('.dataTables_scrollHeadInner #imprimirTh tr #thprimero').trigger("click");
		}, 100 );
}

// MENSAJES DE NOTIFICACIÓN
function alertas(mensaje){
	var nclick=$("#btnAlertas"), data=nclick.data();
	data.verticalEdge=data.vertical || 'right';
	data.horizontalEdge=data.horizontal  || 'top';
	$.notific8(mensaje, data);	
}

//VENTANAS EN MODAL
function ventanas(){
	$(".ventaPermisos").click(function(event){
		event.preventDefault();
		var elid = $(this);
		var data=$(this).data();
		var idvent = elid.attr("data-target");
		$("#ventaPermisos"+idvent+"").attr('class','modal fade').addClass(data.effect).modal('show')
	});
}

//PANELES CONTRAIDOS
function contraido(){
	$(".contraido").each(function(){
		var obj = $(this);
		var panelBody=obj.closest(".panel").find(".panel-body");
		panelBody.slideUp();
	});
}

// **************************************************************************************************************************************************
// **************************************************************************************************************************************************
//VENTANAS EN MODAL AGREGAR NUEVO
function agregaNuevo(){
	$(".ventaNuevo").click(function(event){
		//sonidos("boton");
		event.preventDefault();
		var elid = $(this);
		var data=$(this).data();
		$("#formVentana #cmo").val("insertar");
		//AGREGAR FUNCIONES DE MODULOS
		var nomPagina = $("#nomPagina").val();
		switch(nomPagina){
			case 'v_usuarios':
				nuevoUsuarios();
			break;
			case 'v_productosV':
				nuevoProductoV();
			break;
			case 'v_productosM':
				nuevoProductoM();
			break;
			case 'v_sucursales':
				nuevaSucursal();
			break;
			case 'v_proveedores':
				nuevoProveedor();
			break;
			case 'v_comprasM':
				nuevaVenCompraM();
			break;
			case 'v_comprasV':
				nuevaVenCompraM();
			break;
			case 'v_lotesV':
				nuevoLote();
			break;
			case 'v_clientes':
				nuevoCliente();
			break;
			case 'v_empleados':
				nuevoEmpleado();
			break;
			case 'v_gastos':
				nuevoGasto();
			break;
			case 'v_contado':
				cancelarTrNV();
			break;
		}
		var idvent = elid.attr("data-target");
		$("#ventaNuevo"+idvent+"").attr('class','modal fade').addClass(data.effect).modal('show');
	});
}

//VENTANAS EN MODAL MODIFICAR REGISTRO
function ventaModificar(){
	$(".ventaModificar").click(function(event){
		event.preventDefault();
		var elid = $(this);
		var data=$(this).data();
		$("#formVentana #cmo").val("modificar");
		var idvent = elid.attr("data-target");
		$("#ventaNuevo"+idvent+"").attr('class','modal fade').addClass(data.effect).modal('show');
		var id = elid.attr("id").split("-"); // OBTENER ID DEL REGISTRO
		var pagina = $("#nomPagina").val().split("_");
		elAjax(id[1], pagina[1]);
	});
}

//VENTANAS EN MODAL ELIMINAR REGISTRO
function ventaEliminar(){
	$(".ventaEliminar").click(function(event){
		event.preventDefault();
		var elid = $(this);
		var data=$(this).data();
		var idvent = elid.attr("data-target");
		$("#ventaEliminar"+idvent+"").attr('class','modal fade').addClass(data.effect).modal('show');
		var id = elid.attr("id").split("-"); // OBTENER ID DEL REGISTRO
		//AGREGAR FUNCIONES DE MODULOS
		var nomPagina = $("#nomPagina").val();
		switch(nomPagina){
			case 'v_usuarios':
				usuariosElim(id[1], elid);
			break;
			case 'v_productosV':
				productosElimV(id[1], elid);
			break;
			case 'v_productosM':
				productosElimM(id[1], elid);
			break;
			case 'v_sucursales':
				sucursalesElim(id[1], elid);
			break;
			case 'v_proveedores':
				proveedoresElim(id[1], elid);
			break;
			case 'v_comprasM':
				comprasMElim(id[1], elid);
			break;
			case 'v_comprasV':
				comprasMElim(id[1], elid);
			break;
			case 'v_lotesV':
				lotesMElim(id[1], elid);
			break;
			case 'v_clientes':
				clientesElim(id[1], elid);
			break;
			case 'v_empleados':
				empleadosElim(id[1], elid);
			break;
			case 'v_gastos':
				gastosElim(id[1], elid);
			break;
		}
	});
}

// (MODIFICAR) AGREGAR NOMBRE DE FUNCIONES DE MODULOS QUE SE VAYAN AGREGANDO AL SISTEMA
function elAjax(id, pagina){
	var datos = {"con": pagina};
	var a = "";
	$.ajax({
		url: "index.php",
		type: "POST",
		data: datos,
		success: function(data) {
			var cadena = data.split("~");
			var contador = 0;
			var contador2 = 0;
			while(contador < cadena[0]){
				if(id == cadena[2 + contador2]){
					for(var i=2;i<parseInt(cadena[1]);i++){
						if(a == ""){
							a = cadena[i + contador2];
						}else{
							a = a + "~" + cadena[i + contador2];
						}
					}
					// AGREGAR NOMBRE DE FUNCIONES DE MODULOS QUE SE VAYAN AGREGANDO AL SISTEMA
					switch(pagina){
						case "usuarios":
							usuariosMod(a);
						break;
						case "productosV":
							productosModV(a);
						break;
						case "productosM":
							productosModM(a);
						break;
						case "sucursales":
							sucursalesMod(a);
						break;
						case "proveedores":
							proveedoresMod(a);
						break;
						case "comprasM":
							comprasModM(a);
						break;
						case "comprasV":
							comprasModM(a);
						break;
						case "almacenM":
							inventarioModM(a);
						break;
						case "almacenV":
							inventarioModM(a);
						break;
						case "lotesV":
							lotesModM(a);
						break;
						case "clientes":
							clientesMod(a);
						break;
						case "empleados":
							empleadosMod(a);
						break;
						case "gastos":
							gastosMod(a);
						break;
					}
					$(".dinero").formatCurrency();
				}
				contador = contador + 1;
				contador2 = contador2 + parseInt(cadena[1]);
			}
		}
	});
}

// VALIDAR CAMPOS DE FORMULARIOS
function validarFormularios(){
	//iCheck[components] validar
	$('input').on('ifChanged', function(event){
		$(event.target).parsley( 'validate' );
	});
}

// CONSULTAS POR MEDIO DE AJAX (ENVIAR NOMBRE DEL MODULO Y ELEMENTO SELECT)
function conAjax(pagina, selec){
	var datos = {"con": pagina};
	var a = "";
	$.ajax({
		url: "index.php",
		type: "POST",
		data: datos,
		success: function(data) {
			var cadena = data.split("~");
			var contador = contador3 = 0;
			var contador2 = 0;
			//var color = Array("primary","info","success","warning","danger","inverse","theme","theme-inverse","palevioletred","green","lightseagreen","purple","darkorange","pink");
			var color = Array("primary","info","success","warning","danger","default");
			while(contador < cadena[0]){
				if(contador3 > 5){
					contador3 = 0;
				}
				switch(pagina){
					case "proveedores":
						var opcion = $("<option value='"+cadena[2 + contador2]+"' data-content='<span class=\"label label-"+color[contador3]+"\">"+cadena[3 + contador2]+"</span>' >"+cadena[3 + contador2]+"</option>");
						$(opcion).appendTo("#"+selec+"");
						$("#"+selec+"").selectpicker('refresh');
					break;
					case "clientes":
						var opcion = $("<option value='"+cadena[2 + contador2]+"' data-content='<span class=\"label label-"+color[contador3]+"\">"+cadena[4 + contador2]+"</span>' >"+cadena[4 + contador2]+"</option>");
						$(opcion).appendTo("#"+selec+"");
						$("#"+selec+"").selectpicker('refresh');
					break;
					case "productosM":
						var eje = $("#"+selec+"").hasClass("selecProdComMLote");
						var imag = "vistas/images/picture.png";
						if(cadena[11 + contador2] != ""){
							imag = "archivos/fotosProductos/"+cadena[11 + contador2]+"";
						}
						if(eje == true){
							if(cadena[6 + contador2] != "0"){
								var opcion = $("<option value='"+cadena[2 + contador2]+"' detalle='"+cadena[15 + contador2]+"' medida='"+cadena[14 + contador2]+"' costo='"+cadena[6 + contador2]+"' data-content='<span class=\"label label-"+color[contador3]+"\"><img style=\"width:16px;cursor:pointer\" src=\""+imag+"\" title=\""+cadena[4 + contador2]+"\" imagen_xpandir=\""+cadena[2 + contador2]+"\" class=\"preview_fancybox2\"> "+cadena[4 + contador2]+"</span>' >"+cadena[4 + contador2]+"</option>");
								$(opcion).appendTo("#"+selec+"");
								var imagen = $("<a id=\"imagen_xpandir-"+cadena[2 + contador2]+"\" style=\"display:none\" href=\""+imag+"\" title=\""+cadena[4 + contador2]+"\" class=\"preview_fancybox\"><img style=\"width:16px\" src=\""+imag+"\" title=\""+cadena[4 + contador2]+"\" class=\"preview_fancybox\"></a>");
								$(opcion).appendTo("#"+selec+"");
								var padre = $("#"+selec+"").parent().parent();
								$(imagen).appendTo(padre);
							}
						}else{
							var opcion = $("<option value='"+cadena[2 + contador2]+"' medida='"+cadena[14 + contador2]+"' costo='"+cadena[6 + contador2]+"' data-content='<span class=\"label label-"+color[contador3]+"\"><img style=\"width:16px;cursor:pointer\" src=\""+imag+"\" title=\""+cadena[4 + contador2]+"\" imagen_xpandir=\""+cadena[2 + contador2]+"\" class=\"preview_fancybox2\"> "+cadena[4 + contador2]+"</span>' >"+cadena[4 + contador2]+"</option>");
							$(opcion).appendTo("#"+selec+"");
							var imagen = $("<a id=\"imagen_xpandir-"+cadena[2 + contador2]+"\" style=\"display:none\" href=\""+imag+"\" title=\""+cadena[4 + contador2]+"\" class=\"preview_fancybox\"><img style=\"width:16px\" src=\""+imag+"\" title=\""+cadena[4 + contador2]+"\" class=\"preview_fancybox\"></a>");
							$(opcion).appendTo("#"+selec+"");
							var padre = $("#"+selec+"").parent().parent();
							$(imagen).appendTo(padre);
						}
						$("#"+selec+"").selectpicker('refresh');
					break;
					case "productosV":
						var imag = "vistas/images/picture.png";
						if(cadena[11 + contador2] != ""){
							imag = "archivos/fotosProductos/"+cadena[11 + contador2]+"";
						}
						var opcion = $("<option value='"+cadena[2 + contador2]+"' medida='"+cadena[14 + contador2]+"' data-content='<span class=\"label label-"+color[contador3]+"\"><img style=\"width:16px;cursor:pointer\" src=\""+imag+"\" title=\""+cadena[4 + contador2]+"\" imagen_xpandir=\""+cadena[2 + contador2]+"\" class=\"preview_fancybox2\"> "+cadena[4 + contador2]+"</span>' >"+cadena[4 + contador2]+"</option>");
						var imagen = $("<a precio='"+cadena[7 + contador2]+"' descripcion='"+cadena[5 + contador2]+"' id=\"imagen_xpandir-"+cadena[2 + contador2]+"\" style=\"display:none\" href=\""+imag+"\" title=\""+cadena[4 + contador2]+"\" class=\"preview_fancybox\"><img style=\"width:16px\" src=\""+imag+"\" title=\""+cadena[4 + contador2]+"\" class=\"preview_fancybox\"></a>");
						$(opcion).appendTo("#"+selec+"");
						var padre = $("#"+selec+"").parent().parent();
						$(imagen).appendTo(padre);
						$("#"+selec+"").selectpicker('refresh');
					break;
					case "sucursales":
						var opcion = $("<option value='"+cadena[2 + contador2]+"' data-content='<span class=\"label label-"+color[contador3]+"\">"+cadena[3 + contador2]+"</span>' >"+cadena[3 + contador2]+"</option>");
						$(opcion).appendTo("#"+selec+"");
						$("#"+selec+"").selectpicker('refresh');
					break;
				}
				contador = contador + 1;
				contador3 = contador3 + 1;
				contador2 = contador2 + parseInt(cadena[1]);
			}
			
		}
	});
}

// CONSULTA DE AJAX UNIVERSAL
function consultaAjax(datos){
	var cadena = [];
	$.ajax({
		url: "index.php",
		type: "POST",
		async: false,
		data: datos,
		success: function(data) {
			cadena = data;
			//alert(cadena);
		},
		complete: function( ){
			return cadena;
		}
	});
	return cadena;
}

/*function reporteEspecifico(elemento){
	var reporte = elemento.attr("reporte");
	var pagina = $("#nomPagina").val().split("_");
	var datos = {"rep": pagina[1],"reporte": reporte};
	$.ajax({
        url: "index.php",
        method: "POST",
        data: datos,
		process: mientras(elemento),
        success: function(data){
			recargarContenido(data,reporte);
        }
    });
}*/

function reporteEspecifico(elemento,filtroFecha,egreso,estatus){
	var reporte = elemento.attr("reporte");
	var pagina = $("#nomPagina").val().split("_");
	var datos = {"rep": pagina[1],"reporte": reporte,"egreso": egreso};
	if(estatus != undefined){datos.estatus=estatus;}
	if(filtroFecha != undefined && filtroFecha != ""){datos.filtro=filtroFecha;}
	$.ajax({
        url: "index.php",
        method: "POST",
        data: datos,
		process: mientras(elemento),
        success: function(data){
			recargarContenido(data,reporte);
        }
    });
}

// **************************************************************************************************************************************************
// **************************************************************************************************************************************************

// 	FORMATOS DE NUMEROS
function formatos(){
		$(".numeroDecimales").change(function(){
			 if(isNaN($(this).val())){$(this).val(0);}
			$(this).formatCurrency({
				negativeFormat: '-%s%n',
				roundToDecimalPlace: 3,
				symbol: "",
			});				
		});
		$(".numeroDecimales").formatCurrency({
			negativeFormat: '-%s%n',
			roundToDecimalPlace: 3,
			symbol: "",
		});
		$(".numeros").change(function(){
			 if(isNaN($(this).val())){$(this).val(0);}
			$(this).formatCurrency({
				negativeFormat: '-%s%n',
				symbol: "",
			});				
		});
		$(".numeros").formatCurrency({
			negativeFormat: '-%s%n',
			symbol: "",
		});
		$(".dinero").blur(function(){
			//if(isNaN($(this).val())){$(this).val(0);}
			$(this).formatCurrency({
				negativeFormat: '-%s%n',
				roundToDecimalPlace: 3,
			});				
		});
		$(".dinero").formatCurrency({
			negativeFormat: '-%s%n',
			roundToDecimalPlace: 3,
		});
}

// CONSULTA POR AJAX PARA VALIDAR UN CAMPO UNICO, NO REPETIBLE
function validarCampos(){
	$(".valida-campos").change(function(){
		var campo = $(this);
		var valid = $(this).val();
		var valida = $(this).attr("validar").split("_");
		var datos = {"valid": valida[1],"campo": valida[0],"valor": valid};
		$.ajax({
			url: "index.php",
			type: "POST",
			data: datos,
			success: function(data) {
				if(data != 0){
					var mensaj = "<strong>¡Error! </strong> "+valida[0]+" repetido Ingresa uno nuevo.";
					var nclick=campo, data=nclick.data();
					data.verticalEdge=data.vertical || 'right';
					data.horizontalEdge=data.horizontal  || 'top';
					$.notific8(mensaj, data);
					campo.focus();
					campo.val("");
				}
			}
		});
		
		if(valida[1] == "productosV"){
			var datosv = {"nomPagina": "_"+valida[1],"cmo": "barcode","codigo": valid};
			$.ajax({
				url: "index.php",
				type: "POST",
				data: datosv,
				success: function(datav) {
					d = new Date();
					$("#codigoBarras").attr("src", "https://smartpoint.com.mx/siv/archivos/codeBar/codebar.png?"+d.getTime());
				}
			});
		}
		
	});
}

// VALIDAR LOS CAMPOS NECESARIOS ANTES DE GUARDAR
function validar(v){
	var contador = 0;
	var v=0;
	if($(".valCs").length > 0){
		$("div").removeClass("valCs");
		var trs = $(".trVentaNota").length;
		$(".valCs").each(function (){
			var elem = $(this);
			var elemento = elem.prop('tagName');
			switch(elemento){
				default:
					if(elem.val() != "0" && elem.val() != ""){elem.prev().css("color","black");contador++;}else{elem.prev().css("color","red");}
				break;
			}
		});
		if(contador != $(".valCs").length || trs < 1){
			campo = $("#btnAlertas");
			var mensaj = "<strong>¡Error! </strong> Completa los campos para continuar.";
			data.verticalEdge='left';
			data.horizontalEdge='top';
			data.theme='danger';
			$.notific8(mensaj, data);
			v=1;
		}
	}else{v = 0;}
	return v;
}

// APLICAR AJUSTES ANTES DE GUARADAR
function antesGuardar(){
	$(".dinero").each(function(){
		var diner = $(this).val();
		diner = diner.replace("$","");
		diner = diner.replace(",","");
		diner = diner.replace(",","");
		$(this).val(diner);
	});
	$(".numeroDecimales").each(function(){
		var dec = $(this).val();
		dec = dec.replace(",","");
		dec = dec.replace(",","");
		$(this).val(dec);
	});
	$(".formatoFecha").each(function(){
		var valor = $(this).val();
		var me = "";
		var fechaComp = new Array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		var fechaNum = new Array("0","01","02","03","04","05","06","07","08","09","10","11","12");
		var fechab = valor.split(" ");
		for(var e=0;e<fechaComp.length;e++){
			if(fechaComp[e] == fechab[1]){
				me = fechaNum[e];
			}
		}
		if(fechab.length > 3){
			var fechac = fechab[2]+"-"+me+"-"+fechab[0]+" "+fechab[4];
		}else{
			var fechac = fechab[2]+"-"+me+"-"+fechab[0];
		}
		$(this).val(fechac);
	});
}

// 	ALTAS, BAJAS Y CAMBIOS EN LA BD.
/*function guardar(){
	$("body").on("submit", "form", function () {
		var ide = $(this).attr("id");
		var form = $(this);
		antesGuardar();
		form.parent().parent().prev().children().trigger("click");
		var datos = $(this).serialize();
		/*var archivos = $(this).find($("#foto"));
		var file = archivos.files[0];
		datos.append(file);
		var datos = new FormData();
		inputs = $(this).serialize();
		entradas = inputs.split("&");
		for(x=0;x<entradas.length;x++){
			var temp = entradas[x].split("=");
			valor= replaceAll(decodeURIComponent(temp[1].toString()), "+", " ");
			datos.append(temp[0], valor);
		}		
		var archivos = $(this).find($("input:file"));
		archivos.each(function(){  						
  			datos.append($(this).attr("nombre"),this.files[0]);
  		});
		
		
		
		//:::::::::::::::::::::::::::::::::::::::::::
  		$.ajax({
			url:"index.php",
			type:"POST",
			contentType:false,
			data:datos,
			processData:false,
			cache:false,
			success: function(datosb) {
				var dato = datosb.split("#");
				var mano = "thumbs-up"; 
				if(dato[1] == "si"){
					mano = "thumbs-down";
					$("#btnAlertas").attr("data-theme","danger");
				}
				var boton = $("#btnAlertas");
				var mensaj = "<span style='font-size:40px;margin-right:20px;height:100%;float: left' class='glyphicon glyphicon-"+mano+"'></span> <span> "+dato[0]+"</span>";
				var nclick=boton, data=nclick.data();
				data.verticalEdge=data.vertical || 'right';
				data.horizontalEdge=data.horizontal  || 'top';
				$.notific8(mensaj, data);
				$("#content ul .btn-reload").trigger("click");
	  		}
		});
		//$("#fReportes").fadeIn("fast").html('Ejecutando accion...');					   	 	      
		return false;
	});
}*/

// 	ALTAS, BAJAS Y CAMBIOS EN LA BD.
function guardar(){
	$("body").on("submit", "form", function (e) {
		var ide = $(this).attr("id");
		if(ide == "form-signin" || ide == "top-search"){
			return;
		}
		e.preventDefault();
		if($(this).parsley( 'validate' )){
			var valido = validar();
			if(valido == 1){
				return false;
			}
			var form = $(this);
			if(ide != "formFoto"){
				antesGuardar();
				//var datos = form.serialize();
				var datos = new FormData();
				inputs = $(this).serialize();
				entradas = inputs.split("&");
				var provedor = [];
				for(x=0;x<entradas.length;x++){
					var temp = entradas[x].split("=");
					//valor= replaceAll(decodeURIComponent(temp[1].toString()), "+", " ");
					valor= decodeURIComponent(temp[1].toString());
					valor = valor.split("+").join(" ");
					
					var prove = temp[0].split("%");
					if(prove[0] == "proveedor"){
						provedor.push(valor);
						temp[0] = "proveedor";
						valor = provedor;
					}
					datos.append(temp[0], valor);
					//alert(entradas[x]+" ~ "+temp+"~ "+temp[0]+" ~ "+valor);
				}
				// CERRAR VENTANA FORMULARIO
				var foto = $("#cmoB").val();
				if(foto == "foto"){
					form.prev().parent().parent().parent().prev().children().trigger("click");
				}else{
					form.parent().parent().prev().children().trigger("click");
				}
				if(ide == "formElimina"){
					form.parent().parent().prev().children().trigger("click");
				}
				//:::::::::::::::::::::::::::::::::::::::::::
				$.ajax({
				url:"index.php",
				type:"POST",
					contentType:false,
					data:datos,
					processData:false,
					cache:false,
					success: function(datosb) {
						var dato = datosb.split("#");
						var mano = "thumbs-up"; 
						if(dato[1] == "si"){
							mano = "thumbs-down";
							$("#btnAlertas").attr("data-theme","danger");
						}
						var boton = $("#btnAlertas");
						var mensaj = "<span style='font-size:40px;margin-right:20px;height:100%;float: left' class='glyphicon glyphicon-"+mano+"'></span> <span> "+dato[0]+"</span>";
						var nclick=boton, data=nclick.data();
						data.verticalEdge=data.vertical || 'right';
						data.horizontalEdge=data.horizontal  || 'top';
						$.notific8(mensaj, data);
						if(foto == "foto" && ide != "formElimina"){
							$("#idRB").val(dato[2]);
							//$("#nombreB").val();
							$("#guardaFoto").trigger("click");
						}
						if($("#nomPagina").val() == "v_contado"){
							$("#venContad").trigger("click");
							contarVen = 100;
						}
						$("#content ul .btn-reload").trigger("click");
					}
				});
			}
			else{
				var datos = new FormData();
				inputs = $(this).serialize();
				entradas = inputs.split("&");
				for(x=0;x<entradas.length;x++){
					var temp = entradas[x].split("=");
					//valor= replaceAll(decodeURIComponent(temp[1].toString()), ",", " ");
					valor= decodeURIComponent(temp[1].toString());
					valor = valor.split("+").join(" ");
					datos.append(temp[0], valor);
				}
				var archivos = $(this).find($("input:file"));
				archivos.each(function(){
					datos.append($(this).attr("nombre"),this.files[0]);
				});
				$.ajax({
					url:"index.php",
					type:"POST",
					contentType:false,
					data:datos,
					processData:false,
					cache:false,
					success: function(data) {
						//alert(data);
					}
				});
	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			}
			return false;
		}
	});
}

//	RECARGA LAS FUNCIONES QUE SE NECESITAN PARA LA PAGINA ACTUAL
function recargarContenido(data,reporte){
		
		$("[recargaReporte='"+reporte+"'] .recargaElContenido").children().remove();
		$("[recargaReporte='"+reporte+"'] .recargaElContenido").html(data);
		var tabla = $("[recargaReporte="+reporte+"] .recargaElContenido").children().children().attr("id");
		
		// VENTAS DE CONTADO
		selecTipoVenta();
		//-
		
		formatos();
		agregaNuevo();
		ventaModificar();
		ventaEliminar();
		popOverTablaV();
		ventanas();
		if(tabla == "tablaUsuarios"){
			dataTabla();
		}
		resizableThead();
		filtroEgreso();
		ventanas();
		$("form").submit(function(e){
			e.preventDefault();
			if($(this).parsley( 'validate' )){
				
			}
		});
		selectProdMatePrimLote();
		//iCheck[components] validate
		$('input').on('change', function(event){
			$(event.target).parsley( 'validate' );
		});
		$(".preview_fancybox").fancybox({
			'transitionIn'	:	'elastic',
			'transitionOut'	:	'elastic',
			'speedIn'		:	600, 
			'speedOut'		:	800,
			//'titlePosition'		:	'over'
		});
		estatusLoteRe();
		//dispositivosM();
		
}
/* :::::::::::::::::::LINEA COMENTADA DE DISPOSITIVOS MOVILES::::::::::::::::::::::::::::::::::::::::
function dispositivosM(){
// +++++++++++++++++ 	equipos moviles +++++++++++++++++++++++++++++++++++
	var dispositivo = navigator.userAgent.toLowerCase();
      if( dispositivo.search(/iphone|ipod|ipad|android/) > -1 ){
		$(".ventaNuevo").css({"margin-top":"95px","margin-left":"20%"});
		//$(".panel-tools-mini").css({"margin-top":"-5%","position":"relative","margin-right":"25%"});
		$(".panel-tools-mini").css({"display":"none"});
		$(".dataTables_filter").css({"margin-top":"0"});
	  }
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
}*/

//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::		USUARIOS		:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// FORMATEAR CAMPOOS DE NUEVO USUARIO
function nuevoUsuarios (){
	//TITULO VENTANA
	$("#modAgreusu").html("Agregar nuevo");
	$("#ligaFoto").val("0");
	$("#fotoUsu").parent().next().next().find(".fileinput-exists").trigger("click");
	$("#fotoUsu").attr("src","vistas/images/user.gif");
	$("#estatus option[value='']").attr("selected",true);
	$('#estatus').selectpicker('val', '');
	$('#estatus').selectpicker('val', ['','Relish']);
	$('#nombre').val("");
	$('#correoB').val("");
	$(".contraido").each(function(){
		if(!$(this).hasClass("in")){
			$(this).trigger("click");
		}
	});
	$(".usuSwitch").each(function(){
		$(this).bootstrapSwitch('setState', false);
	});
	$("#idusuario").val("0");
}

//DATOS DEL USUARIO A MODIFICAR
function usuariosMod(a){
	var b = a.split("~");
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idusuario").val(b[0]);
	//TITULO VENTANA
	$("#modAgreusu").html("Modificar");
	//foto
	$("#fotoUsu").parent().next().next().find(".fileinput-exists").trigger("click");
	if(b[8] != ""){
		$("#ligaFoto").val(b[8]);
		$("#fotoUsu").attr("src","archivos/fotosUsuarios/"+b[8]+"");
	}
	$("#foto").change(function(){
		$("#ligaFoto").val(b[8]);
	});
	//nombre
	$("#nombre").attr("value",b[1]);
	$("#nombreB").attr("value",b[1]);
	//usuario
	$("#correoB").attr("value",b[2]);
	//estatus
	if(b[4] == "Bloqueado"){
		$("#estatus option[value='Bloqueado']").attr("selected",true);
		$('#estatus').selectpicker('val', 'Bloqueado');
		$('#estatus').selectpicker('val', ['Bloqueado','Relish']);
	}else{
		$("#estatus option[value='Desbloqueado']").attr("selected",true);
		$('#estatus').selectpicker('val', 'Desbloqueado');
		$('#estatus').selectpicker('val', ['Desbloqueado','Relish']);
	}
	//permisos
	
	$(".contraido").each(function(){
		if($(this).hasClass("in")){	
			$(this).trigger("click");
		}
	});

	var perModulo = b[5].split(";");
	for(var x=0;x<perModulo.length;x++){
		var z = perModulo[x].split(",");
		for(var y=0;y<z.length;y++){
			if (z[y] == "1"){
				//$("#"+x+"-"+y+"").attr('checked', "true");
				$("#"+x+"-"+y+"").parent().bootstrapSwitch('setState', true);
			}else{
				//$("#"+x+"-"+y+"").attr('checked', "false");
				$("#"+x+"-"+y+"").parent().bootstrapSwitch('setState', false);
			}
		}
	}
}

//DATOS DEL USUARIO A ELIMINAR
function usuariosElim(id, elid){
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idElimina").val(id);
	var foto = $("#fot"+id+"").attr("src");
	if(foto == "assets/img/avatar7.gif"){
		$("#ligaFotoB").val("0");
	}else{
		var fotob = foto.split("/");
		$("#ligaFotoB").val(fotob[2]);
	}
	$("#ligaFotoB").val(foto);
	var nomUsu = elid.parent().parent().prev().prev().prev().prev().html();
	$("#nomUsuElim").html(nomUsu);
}

function btnrol(){
	$(".btnRol").click(function(){
		$(".btnRol").removeClass("active");
		var ide=$(this).attr("id");
		$(this).addClass("active");
		
		alert(ide);
	});
	
}

function checPerm() {
	$('.iCheck').each(function(i) {
		var  data=$(this).data(),
		input=$(this).find("input"), 
		li=$(this).find("span"),
		index="cp"+i,
		insert_text,
		iCheckColor = [ "black", "red","green","blue","aero","grey","orange","yellow","pink","purple"],
		callCheck=data.style || "flat";
		if(data.color && data.style !=="polaris" && data.style !=="futurico" ){
			hasColor= jQuery.inArray(data.color, iCheckColor);
			if(hasColor !=-1 && hasColor < iCheckColor.length){
				callCheck=callCheck+"-"+data.color;
			}
		}
		input.each(function(i){
			var self = $(this), label=$(this).next();
			self.attr("id","iCheck-"+index+"-"+i);
			if(data.style=="line"){
				insert_text='<div class="icheck_line-icon"></div><span><label></label></span>';
				label.remove();
				self.iCheck({ checkboxClass: 'icheckbox_'+callCheck, radioClass: 'iradio_'+callCheck, insert:insert_text});
			}else{
				label.attr("for","iCheck-"+index+"-"+i);
			}
		});
		if(data.style!=="line"){
			input.iCheck({ checkboxClass: 'icheckbox_'+callCheck, radioClass: 'iradio_'+callCheck });
		}else{
			li.addClass("line");
		}
		input.parent().css("width","50%");
	});
	$('[type="checkbox"]').on('ifChecked', function(event){
		$(this).parent().css("background","#1ABC9C");
		var perm = $(this).attr("perm");
		var permb = perm.split("-");
		if(permb[0] != "15"){
			if(permb[1] == "1" || permb[1] == "3"){
				$("[perm="+permb[0]+"-2]").parent().css("background","#1ABC9C");
				$("[perm="+permb[0]+"-2]").iCheck('check');
				$("[perm="+permb[0]+"-2]").attr('disabled','disabled');
			}
		}
	});
	$('[type="checkbox"]').on('ifUnchecked', function(event){
	  $(this).parent().css("background","#d9534f");
	  $("#perTodH").val(1);
	  $("#perTod").parent().bootstrapSwitch('setState', false);
	  var perm = $(this).attr("perm");
	  var permb = perm.split("-");
	  if(permb[0] != "15"){
		 if(permb[1] == "1"){
			var elimi = $("[perm="+permb[0]+"-3]").prop("checked");
			if(elimi == false){
				$("[perm="+permb[0]+"-2]").parent().css("background","#d9534f");
				$("[perm="+permb[0]+"-2]").iCheck('uncheck');
				$("[perm="+permb[0]+"-2]").removeAttr('disabled');
			}
		  }
		  if(permb[1] == "3"){
			var elimi = $("[perm="+permb[0]+"-1]").prop("checked");
			if(elimi == false){
				$("[perm="+permb[0]+"-2]").parent().css("background","#d9534f");
				$("[perm="+permb[0]+"-2]").iCheck('uncheck');
				$("[perm="+permb[0]+"-2]").removeAttr('disabled');
			}
		  }
	  }
	});
	
	$("#perTod").change(function(){
		if($("#perTodH").val() == 0){
			var chtodos = $(this).prop("checked");
			if (chtodos == true){
				$('.iCheck [type="checkbox"]').each(function() {
					$(this).iCheck('check'); 
				});
			}else{
				$('.iCheck [type="checkbox"]').each(function() {
					$(this).iCheck('uncheck');				
				});
			}
		}
		$("#perTodH").val(0);
	});
}


//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::		PRODUCTOS A LA VENTA		:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// FORMATEAR CAMPOOS DE NUEVO PRODUCTO
function nuevoProductoV(){
	
	//TITULO VENTANA
	$("#modAgreusu").html("Agregar nuevo");
	$("#ligaFoto").val("0");
	$("#fotoUsu").parent().next().next().find(".fileinput-exists").trigger("click");
	$("#fotoUsu").attr("src","vistas/images/picture.png");
	$("#fotoUsu").attr("style","opacity: .15;");
	
	$('#codigo').val("");
	$('#nombre').val("");
	$('#descripcion').val("");
	$("#tipo option[value='']").attr("selected",true);
	$('#tipo').selectpicker('val', '');
	$('#tipo').selectpicker('val', ['','Relish']);
	$("#material option[value='']").attr("selected",true);
	$('#material').selectpicker('val', '');
	$('#material').selectpicker('val', ['','Relish']);
	$("#categoria option[value='']").attr("selected",true);
	$('#categoria').selectpicker('val', '');
	$('#categoria').selectpicker('val', ['','Relish']);
	$("#proveedor option[value='']").attr("selected",true);
	$('#proveedor').selectpicker('val', '');
	$('#proveedor').selectpicker('val', ['','Relish']);
	$("#medida option[value='']").attr("selected",true);
	$('#medida').selectpicker('val', '');
	$('#medida').selectpicker('val', ['','Relish']);
	$("#precio").val("");
	//$("#codigoBarras").attr("src", "https://smartpoint.com.mx/siv/archivos/codeBar/codebarA.png?"+d.getTime());
	$("#codigoBarras").attr("src", "https://smartpoint.com.mx/siv/archivos/codeBar/codebarA.png");
	$("#idR").val("0");
}

//DATOS DEL PRODUCTO A MODIFICAR
function productosModV(a){
	var b = a.split("~");
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idR").val(b[0]);
	//TITULO VENTANA
	$("#modAgreusu").html("Modificar");
	//foto
	$("#fotoUsu").parent().next().next().find(".fileinput-exists").trigger("click");
	if(b[9] == ""){
		$("#fotoUsu").attr("style","opacity: .15;");
	}
	if(b[9] != ""){
		$("#fotoUsu").attr("style","opacity: 1;");
		$("#ligaFoto").val(b[9]);
		$("#fotoUsu").attr("src","archivos/fotosProductos/"+b[9]+"");
	}
	$("#foto").change(function(){
		$("#ligaFoto").val(b[9]);
	});
	$("#codigo").attr("value",b[1]);
	$("#nombre").attr("value",b[2]);
	$("#nombreB").attr("value",b[2]);
	$("#descripcion").attr("value",b[3]);
	$("#costo").attr("value",b[4]).formatCurrency();
	$("#precio").attr("value",b[5]).formatCurrency();
	//estatus
	var valorTipo = valorMaterial = valorCategoria = "0";
	switch(b[6]){
		case 'Botones': valorTipo = 'Botones'; break;
		case 'Blondas': valorTipo = 'Blondas'; break;
		case 'Cierres': valorTipo = 'Cierres'; break;
		case 'Pasamaneria': valorTipo = 'Pasamaneria'; break;
	}
	switch(b[7]){
		case 'Polester': valorMaterial = 'Polester'; break;
		case 'Algodon': valorMaterial = 'Algodon'; break;
		case 'Seda': valorMaterial = 'Seda'; break;
		case 'Forros': valorMaterial = 'Forros'; break;
	}
	switch(b[8]){
		case 'Accesorios': valorCategoria = 'Accesorios'; break;
		case 'Merceria': valorCategoria = 'Merceria'; break;
		case 'Telas': valorCategoria = 'Telas'; break;
	}
	$('#proveedor').selectpicker('deselectAll');
	$("#proveedor option").each(function(){
		var valo = $(this).attr("value");
		var valores = b[11].split("*");
		for(var r=0;r<valores.length;r++){
			if(valores[r] == valo){
				$("#proveedor option[value='"+valo+"']").attr("selected",true);
				$('#proveedor').selectpicker('refresh');
			}
		}
	});

	$("#medida option[value='"+b[12]+"']").attr("selected",true);
	$('#medida').selectpicker('val', b[12]);
	$('#medida').selectpicker('val', [b[12],'Relish']);
	
	$("#tipo option[value='"+valorTipo+"']").attr("selected",true);
	$('#tipo').selectpicker('val', valorTipo);
	$('#tipo').selectpicker('val', [valorTipo,'Relish']);
	
	$("#material option[value='"+valorMaterial+"']").attr("selected",true);
	$('#material').selectpicker('val', valorMaterial);
	$('#material').selectpicker('val', [valorMaterial,'Relish']);
	
	$("#categoria option[value='"+valorCategoria+"']").attr("selected",true);
	$('#categoria').selectpicker('val', valorCategoria);
	$('#categoria').selectpicker('val', [valorCategoria,'Relish']);
	
		var datosv = {"nomPagina": "_productosV","cmo": "barcode","codigo": b[1]};
		$.ajax({
			url: "index.php",
			type: "POST",
			data: datosv,
			success: function(datav) {
				d = new Date();
				$("#codigoBarras").attr("src", "https://smartpoint.com.mx/siv/archivos/codeBar/codebar.png?"+d.getTime());
			}
		});
	
	
}

//DATOS DEL PRODUCTO A ELIMINAR
function productosElimV(id, elid){
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idElimina").val(id);
	var foto = $("#fot"+id+"").attr("src");
	if(foto == "assets/img/avatar7.gif"){
		$("#ligaFotoB").val("0");
	}else{
		var fotob = foto.split("/");
		$("#ligaFotoB").val(fotob[2]);
	}
	$("#ligaFotoB").val(foto);
	var nomPro = elid.parent().parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();
	$("#nomUsuElim").html(nomPro);
}

// INPUT SELECT DE PROVEEDORES
function seleProveeV(){
	$(".seleProvee").each(function(){
		var selec=$(this).attr("id");
		var pagina = "proveedores";
		conAjax(pagina, selec);
	});
}

/*function popOverTabla(){
	$('.popTabla').each(function(){
		var id = $(this).attr("id").split("-");
		var contenido = $("#divPop-"+id[1]+"").html();
		$(this).popover({
			title: 'Datos del proveedor',
			content: contenido,
			templete: '<div class="popover"><div class="arrow"></div><h3 class="popover-title">Examplre</h3><div class="popover-content">'+contenido+'</div></div>',
			placement: 'top',
			trigger: 'hover'
		},'toggle');
	});
}*/

function popOverTablaV(){
	$('.popTabla').mouseenter(function(){
		var id = $(this).attr("id").split("-");
		$("#provT-"+id[1]+"").show();
	});
	$('.popTabla').mouseleave(function(){
		var id = $(this).attr("id").split("-");
		$("#provT-"+id[1]+"").hide();
	});
	$('.popTabla').click(function(){
		var id = $(this).attr("id").split("-");
		$("#provT-"+id[1]+"").show();
	});
}


// +++++++++++++++++++++++++++++++++ 	LOTES	 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// FORMATEAR CAMPOOS DE NUEVO LOTE
function nuevoLote (){
	//TITULO VENTANA
	$("#modAgrepro").html("Agregar nuevo");
	/*$("#folio").val("");
	$("#sucursal").prop('disabled',false);
	$("#sucursal").selectpicker("refresh");	
	$("#producto").prop('disabled',false);
	$("#producto option[value='']").attr("selected",true);
	$('#producto').selectpicker('val', '');
	$("#producto").selectpicker("refresh");
	$("#productoM option[value='']").attr("selected",true);
	$('#productoM').selectpicker('val', '');
	$("#productoM").selectpicker("refresh");
	$("#sucursalM option[value='']").attr("selected",true);
	$('#sucursalM').selectpicker('val', '');
	$("#sucursalM").selectpicker("refresh");
	$("#cantidad").val("");
	$("#cantidadM").val("");
	$("#fechabb").val("");
	$("#fechabbF").val("");*/
	$("#idR").val("0");
	cancelarLote();
	imageGrandCompr();
}

// CANCELAR NOTA DE COMPRA
function cancelarLote(){
	$("#tablaComprasMP tr").each(function (){
		$(this).remove();
	});
	$("#folio").val("");
	$("#sucursal").prop('disabled',false);
	$("#sucursal option[value='']").attr("selected",true);
	$('#sucursal').selectpicker('val', '');
	$("#sucursal").selectpicker("refresh");	
	$("#producto").prop('disabled',false);
	$("#producto option[value='']").attr("selected",true);
	$('#producto').selectpicker('val', '');
	$("#producto").selectpicker("refresh");
	$("#sucursalM option[value='']").attr("selected",true);
	$('#sucursalM').selectpicker('val', '');
	$("#sucursalM").selectpicker("refresh");
	$("#productoM option[value='']").attr("selected",true);
	$('#productoM').selectpicker('val', '');
	$("#productoM").selectpicker("refresh");
	$("#fechabb").val("");
	$("#fechabbF").val("");
	$("#cantidad").val("");
	$("#cantidad").attr("disabled",false);
	$("#cantidadM").val("");
	$("#totalCPM").text("$0.00");
	$("#total").val("0");
	$("#totalCPPM").text("$0.00");
	$("#totalP").val("0");
	
	$("#estatus").val("En proceso");
	$(".estatLote").removeClass("btn-success");
	$(".estatLote").addClass("btn-primary");
	$("#textoEstaus").text(" En proceso");
	$(".estatLoteEspan").addClass("glyphicon-cog");
	$(".estatLoteEspan").removeClass("glyphicon-ok");
	
	$("#fotoProdVen").attr("src","vistas/images/picture.png");
	$("#fotoProdVen").parent().attr("href","vistas/images/picture.png");
	$("#fotoProdVen").parent().attr("title","Foto de producto de venta");
	$("#nombreProdLo").text("");
	$("#precioProdLo").text("$0.00");
	$("#descripcionProdLo").text("");
	
}

// SELECT DE PRODUCTO DE LOTE
function selectProductLote(){
	$(".selecProdComL").change(function(){
		var id = $(this).val();
		var precio = $("#imagen_xpandir-"+id+"").attr("precio");
		var descripcion = $("#imagen_xpandir-"+id+"").attr("descripcion");
		var imagen = $("#imagen_xpandir-"+id+"").attr("href");
		var title = $("#imagen_xpandir-"+id+"").attr("title");
		$("#fotoProdVen").attr("src",imagen);
		$("#fotoProdVen").parent().attr("href",imagen);
		$("#fotoProdVen").parent().attr("title",title);
		$("#nombreProdLo").text(title);
		$("#descripcionProdLo").text(descripcion);
		$("#precioProdLo").text(precio).formatCurrency();
	});
}

// MATERIA PRIMA Y SUS ATRIBUTOS
function selectProdMatePrimLote(){
	$(".selecProdComMLote").on('change', function(){
		var valu = $(this).val();
		var rango = $(this).find("option:selected").attr("detalle");
		if(valu != ""){	
			$("#sucursalM option").prop("disabled",true);
			$("#sucursalM option").attr("rango","[0,0]");
			$("#sucursalM option[value='']").attr("selected",true);
			$('#sucursalM').selectpicker('val', '');
			$("#sucursalM").selectpicker("refresh");
			rangox = rango.split(",");
			var range = 0;
			for(var x=0;x<rangox.length-1;x++){
				var rangoD = rangox[x].split("#");
				range = parseFloat(rangoD[1]);
				if(range < 1){
					$("#sucursalM option[value='"+rangoD[0]+"']").prop("disabled",true);
				}else{
					$("#sucursalM option[value='"+rangoD[0]+"']").prop("disabled",false);
					$("#sucursalM option[value='"+rangoD[0]+"']").attr("rango","[1,"+rangoD[1]+"]");
				}
			}
			$("#sucursalM").selectpicker("refresh");
			$("#cantidadM").val("");	
		}
	});
	$("#sucursalM").on('change', function(){
		var rangos = $(this).find("option:selected").attr("rango");
		$("#cantidadM").attr("parsley-range",rangos);
	});
	rangoInven();
}

// AGREGAR NUEVO PRODUCTO A LA LISTA DE LOTES
var contarPrLote = 100;
function nuevOproducLote(){
	var sucursal = $("#sucursal option:selected").text();
	var fechabb = $("#fechabb").val();
	var fechabbf = $("#fechabbF").val();
	var cantidad = $("#cantidad").val();
	var folio = $("#folio").val();
	var producto = $("#producto option:selected").text();
	var idProducto = $("#producto option:selected").val();
	var sucursalT = $("#sucursalM option:selected").text();
	var productoT = $("#productoM option:selected").text();
	var cantidadM = $("#cantidadM").val();
	
	if(producto != "- Selecciona -" && cantidad != "" && cantidad != "0" && sucursal != "- Selecciona -" && fechabb != "" && fechabbf != "" && folio != ""&& productoT != "- Selecciona -" && sucursalT != "- Selecciona -" && cantidadM != ""){
		if(contarPrLote == 100){
			$("#sucursal").prop('disabled',true);
			$("#sucursal").selectpicker("refresh");
			$("#producto").prop('disabled',true);
			$("#producto").selectpicker("refresh");
			$("#cantidad").attr("disabled",true);		
		}
		
		var productoM = $("#productoM option:selected").text();
		var idProductoM = $("#productoM option:selected").val();
		var costoM = $("#productoM option:selected").attr("costo");
		var medida = $("#productoM option:selected").attr("medida");
		var sucursalM = $("#sucursalM option:selected").text();
		var idSucursalM = $("#sucursalM option:selected").val();
		
		var costoUnitar = parseFloat(costoM) * parseFloat(cantidadM);
		var total = totalB = 0;
		if($("#totalP").val() != ""){
			total = $("#totalP").val();
			totalB = $("#total").val();
		}
		var idimagen = $("#imagen_xpandir-"+idProductoM+"").attr("href");
		var imagen = '<a href="'+idimagen+'" title="'+producto+'" class="preview_fancybox2"><img style="width:23px" src="'+idimagen+'" title="'+producto+'"></a>';
		total = parseFloat(total) + parseFloat(costoUnitar);
		totalB = parseFloat(total) / parseFloat(cantidad);
		var eltr = "<tr class='trCompraMateria' id='eltrCPM-"+contarPrLote+"'>\
						<td class='idproductoB clDetalCompra' idproducto='"+idProductoM+"'>"+imagen+" " +productoM+"</td>\
						<td><b class='clDetalCompra'>"+cantidadM+"</b>"+medida+"</td>\
						<td><b idSucursalM='"+idSucursalM+"' class='idSucursalM clDetalCompra'>"+sucursalM+"</b></td>\
						<td class='dineroComp clDetalCompra' id='costoUTCPM-"+contarPrLote+"'>"+costoM+"</td>\
						<td class='dineroComp clDetalCompra' id='costoTCPM-"+contarPrLote+"'>"+costoUnitar+"</td>\
						<td><span class='tooltip-area'>\
							<button id='eliCPM-"+contarPrLote+"' onclick='eliminarTrLote($(this).attr(\"id\"))' type='button' class='btn btn-danger btn-danger' data-effect='md-flipHor'><i class='fa fa-trash-o'></i></button></span>\
						</td></tr>";
		$(eltr).appendTo($("#tablaComprasMP"));
		$("#totalCPPM").text(totalB).formatCurrency();
		$("#total").val(totalB);
		$("#totalCPM").text(total).formatCurrency();
		$("#totalP").val(total);
		$("#productoM option[value='']").attr("selected",true);
		$('#productoM').selectpicker('val', '');
		$("#productoM").selectpicker("refresh");
		$("#sucursalM option[value='']").attr("selected",true);
		$('#sucursalM').selectpicker('val', '');
		$("#sucursalM").selectpicker("refresh");	
		
		
		$("#cantidadM").val("");
		$(".dineroComp").formatCurrency();
		imageGrandCompr();
		contarPrLote = contarPrLote + 1;
	}else{
		return false;
	}
}

//DATOS DEL LOTE A MODIFICAR
function lotesModM(a){
	cancelarLote();
	var b = a.split("~");
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idR").val(b[0]);
	//TITULO VENTANA
	$("#modAgrepro").html("Modificar");
	var detalles = b[7].split("#");
	$("#folio").val(b[1]);
	$("#sucursal option[value='"+b[6]+"']").attr("selected",true);
	$('#sucursal').selectpicker('val', b[6]);
	$("#sucursal").prop('disabled',true);
	$("#sucursal").selectpicker("refresh");
	$("#producto option[value='"+b[4]+"']").attr("selected",true);
	$('#producto').selectpicker('val', b[4]);
	$("#producto").prop('disabled',true);
	$("#producto").selectpicker("refresh");
	$("#cantidad").val(b[5]);
	$("#cantidad").attr("disabled",true);
	var fec = b[2].split(" ");
	var feca = fec[0].split("-");
	var fecF = b[3].split(" ");
	var fecaF = fecF[0].split("-");
	var mes = new Array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$("#fechabb").val(feca[2]+" "+mes[parseInt(feca[1])]+" "+feca[0]+" "+fec[1]);
	$("#fechabbF").val(fecaF[2]+" "+mes[parseInt(fecaF[1])]+" "+fecaF[0]+" "+fecF[1]);
	var contar = totalP = 0;
	for(var i=0;i<detalles[0];i++){
		var costoUni = parseFloat(detalles[5 + contar]) / parseFloat(detalles[4 + contar]);
		totalP = totalP + parseFloat(detalles[5 + contar]);
		var imagen = '<a href="archivos/fotosProductos/'+detalles[7 + contar]+'" title="'+detalles[9 + contar]+'" class="preview_fancybox2"><img style="width:23px" src="archivos/fotosProductos/'+detalles[7 + contar]+'" title="'+detalles[9 + contar]+'"></a>';
	
		var eltr = "<tr class='trCompraMateria' id='eltrCPM-"+i+"'>\
						<td class='idproductoB clDetalCompra' idproducto='"+detalles[3 + contar]+"'>"+imagen+" "+detalles[9 + contar]+"</td>\
						<td><b class='clDetalCompra'>"+detalles[4 + contar]+"</b>"+detalles[11 + contar]+"</td>\
						<td><b idSucursalM='"+detalles[10 + contar]+"' class='idSucursalM clDetalCompra'>"+detalles[6 + contar]+"</b></td>\
						<td class='dineroComp clDetalCompra' id='costoUTCPM-"+i+"'>"+costoUni+"</td>\
						<td class='dineroComp clDetalCompra' id='costoTCPM-"+i+"'>"+detalles[5 + contar]+"</td>\
						<td><span class='tooltip-area'>\
					<button id='eliCPM-"+i+"' onclick='eliminarTrLote($(this).attr(\"id\"))' type='button' class='btn btn-danger btn-danger' data-effect='md-flipHor'><i class='fa fa-trash-o'></i></button></span></td></tr>";
		$(eltr).appendTo($("#tablaComprasMP"));
		
		$("#totalCPM").text(totalP).formatCurrency();
		$("#totalP").val(totalP);
		contar = contar + 12;
	}
		if(b[8] == "Terminado"){
			$(".estatLote").addClass("btn-success");
			$(".estatLote").removeClass("btn-primary");
			$("#textoEstaus").text(" Terminado");
			$(".estatLoteEspan").removeClass("glyphicon-cog");
			$(".estatLoteEspan").addClass("glyphicon-ok");
			$("#estatus").val("Terminado");
		}else{
			$(".estatLote").removeClass("btn-success");
			$(".estatLote").addClass("btn-primary");
			$("#textoEstaus").text(" En proceso");
			$(".estatLoteEspan").addClass("glyphicon-cog");
			$(".estatLoteEspan").removeClass("glyphicon-ok");
			$("#estatus").val("En proceso");
		}
	
		var total = parseFloat(totalP) / parseFloat(b[5]);
		$("#totalCPPM").text(total).formatCurrency();
		$("#total").val(total);
		$(".dineroComp").formatCurrency();
		imageGrandCompr();
		$(".preview_fancybox2").fancybox();
}

// ELIMINAR PRODUCTO DE LA LISTA
function eliminarTrLote(ide){
	var id = ide.split("-");
	var total = $("#totalP").val();
	var totalU = $("#total").val();
	
	var costo = $("#costoTCPM-"+id[1]+"").text();
	costo = costo.replace("$","");
	costo = costo.replace(",","");
	costo = costo.replace(",","");
	
	var costoU = $("#cantidad").val();
	costoU = costoU.replace("$","");
	costoU = costoU.replace(",","");
	costoU = costoU.replace(",","");
	
	total = parseFloat(total) - parseFloat(costo);
	totalU = parseFloat(total) / parseFloat(costoU);
	
	$("#totalCPPM").text(totalU).formatCurrency();
	$("#total").val(totalU);
	$("#totalCPM").text(total).formatCurrency();
	$("#totalP").val(total);
	$("#eltrCPM-"+id[1]+"").remove();
}

// DATOS DEL LOTE A ELIMINAR
function lotesMElim(id, elid){
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idElimina").val(id);
	var nomUsu = elid.parent().parent().prev().prev().prev().prev().prev().prev().prev().prev().html();
	$("#nomUsuElim").html(nomUsu);
}

// ANTES DE GUARDAR EL LOTE
function notaLoteG(id){
	var contador = 0;
	var texto = "";
	$("#"+id+" tr .clDetalCompra").each(function(){
		if(contador == 5){
			contador = 0;
		}
		var texto2 = "";
		var laclase = $(this).attr("class");
		laclase = laclase.split(" ");
		if(laclase[0] == "dineroComp"){
			texto2 = $(this).text().replace("$","");
			texto2 = texto2.replace(",","");
			texto2 = texto2.replace(",","");
		} 
		else if(laclase[0] == "idproductoB"){
			texto2 = $(this).attr("idproducto");
		}else if(laclase[0] == "idSucursalM"){
			texto2 = $(this).attr("idSucursalM");
		}else{
			texto2 = $(this).text();
		}
		if(texto == ""){
			texto = texto2;
		}else{
			if(contador == 0){
				texto = texto + "#" + texto2;
			}else{
				texto = texto + "~" + texto2;
			}
		}
		contador = contador + 1;
	});
	$("#detalles").val(texto);
	$("#sucursal").prop('disabled',false);
	$("#sucursal").selectpicker("refresh");
	$("#producto").prop('disabled',false);
	$("#producto").selectpicker("refresh");
	$("#cantidad").attr("disabled",false);	
}

// ESTATUS DEL LOTE EN PRODUCCIÓN
function estatusLote(){
	$(".estatLote").mouseenter(function(){
		var estatusActual = $("#estatus").val();
		if(estatusActual == "En proceso"){
			$(this).addClass("btn-success");
			$(this).removeClass("btn-primary");
			$("#textoEstaus").text(" Terminado");
			$(".estatLoteEspan").removeClass("glyphicon-cog");
			$(".estatLoteEspan").addClass("glyphicon-ok");
		}else{
			$(this).removeClass("btn-success");
			$(this).addClass("btn-primary");
			$("#textoEstaus").text(" En proceso");
			$(".estatLoteEspan").addClass("glyphicon-cog");
			$(".estatLoteEspan").removeClass("glyphicon-ok");
		}
	});
	$(".estatLote").mouseleave(function(){
		var estatusActual = $("#estatus").val();
		if(estatusActual == "Terminado"){
			$(this).addClass("btn-success");
			$(this).removeClass("btn-primary");
			$("#textoEstaus").text(" Terminado");
			$(".estatLoteEspan").removeClass("glyphicon-cog");
			$(".estatLoteEspan").addClass("glyphicon-ok");
		}else{
			$(this).removeClass("btn-success");
			$(this).addClass("btn-primary");
			$("#textoEstaus").text(" En proceso");
			$(".estatLoteEspan").addClass("glyphicon-cog");
			$(".estatLoteEspan").removeClass("glyphicon-ok");
		}
	});
	$(".estatLote").click(function(){
		var estatusActualv = $("#estatus").val();
		if(estatusActualv == "En proceso"){
			$(this).addClass("btn-success");
			$(this).removeClass("btn-primary");
			$(".estatLoteEspan").removeClass("glyphicon-cog");
			$(".estatLoteEspan").addClass("glyphicon-ok");
			$("#textoEstaus").text(" Terminado");
			$("#estatus").val("Terminado");
		}else{
			$(this).removeClass("btn-success");
			$(this).addClass("btn-primary");
			$(".estatLoteEspan").addClass("glyphicon-cog");
			$(".estatLoteEspan").removeClass("glyphicon-ok");
			$("#textoEstaus").text(" En proceso");
			$("#estatus").val("En proceso");
		}
		
	});
}

/*
// ESTATUS DEL LOTE EN PRODUCCIÓN EN EL REPORTE
function estatusLoteRe(){
	$(".estatLoteb").mouseenter(function(){
		var ide = $(this).attr("id").split("-");
		var estatusActual = $("#estatusv-"+ide[1]).val();
		if(estatusActual == "En proceso"){
			$(this).addClass("btn-success");
			$(this).removeClass("btn-primary");
			$("#textoEstaus-"+ide[1]).text(" Terminado");
			$(".estatLoteEspan").removeClass("glyphicon-cog");
			$(".estatLoteEspan").addClass("glyphicon-ok");
		}else{
			$(this).removeClass("btn-success");
			$(this).addClass("btn-primary");
			$("#textoEstaus-"+ide[1]).text(" En proceso");
			$(".estatLoteEspan").addClass("glyphicon-cog");
			$(".estatLoteEspan").removeClass("glyphicon-ok");
		}
	});
	$(".estatLoteb").mouseleave(function(){
		var ide = $(this).attr("id").split("-");
		var estatusActual = $("#estatusv-"+ide[1]).val();
		if(estatusActual == "Terminado"){
			$(this).addClass("btn-success");
			$(this).removeClass("btn-primary");
			$("#textoEstaus-"+ide[1]).text(" Terminado");
			$(".estatLoteEspan").removeClass("glyphicon-cog");
			$(".estatLoteEspan").addClass("glyphicon-ok");
		}else{
			$(this).removeClass("btn-success");
			$(this).addClass("btn-primary");
			$("#textoEstaus-"+ide[1]).text(" En proceso");
			$(".estatLoteEspan").addClass("glyphicon-cog");
			$(".estatLoteEspan").removeClass("glyphicon-ok");
		}
	});
	$(".estatLoteb").click(function(){
		//var  btn= $('.panel-tools .btn-reload');
		//reporteEspecifico(btn);
		//var  btn=$("#fReportes");
		//mientras();
		var ide = $(this).attr("id").split("-");
		var estatusActualv = $("#estatusv-"+ide[1]).val();
		if(estatusActualv == "En proceso"){
			$(this).addClass("btn-success");
			$(this).removeClass("btn-primary");
			$(".estatLoteEspan").removeClass("glyphicon-cog");
			$(".estatLoteEspan").addClass("glyphicon-ok");
			$("#textoEstaus-"+ide[1]).text(" Terminado");
			$("#estatusv-"+ide[1]).val("Terminado");
		}else{
			$(this).removeClass("btn-success");
			$(this).addClass("btn-primary");
			$(".estatLoteEspan").addClass("glyphicon-cog");
			$(".estatLoteEspan").removeClass("glyphicon-ok");
			$("#textoEstaus").text(" En proceso");
			$("#estatusv-"+ide[1]).val("En proceso");
		}
		event.preventDefault();
		var elid = $(this);
		var data=$(this).data();
		var idvent = elid.attr("data-target");
		$("#ventaEstatus"+idvent+"").attr('class','modal fade').addClass(data.effect).modal('show');
		$("#fechafE").click(function(){
			$("#fechaTermino .datetimepicker").css({"top":"160px","left":"165px"});
		});
		$("#modiEstatus").click(function(){
			if($("#fechafE").val() != ""){
				$('#estatCerrar').trigger( 'click' );
				var datos = {"cmo": "modificarEstatus","nomPagina": "v_lotesV","id": ide[1],"estatus":estatusActualv};
				$.ajax({
					url:"index.php",
					type:"POST",
					data:datos,
					success: function(datosb) {
						var dato = datosb.split("#");
						var mano = "thumbs-up"; 
						if(dato[1] == "si"){
							mano = "thumbs-down";
							$("#btnAlertas").attr("data-theme","danger");
						}
						var boton = $("#btnAlertas");
						var mensaj = "<span style='font-size:40px;margin-right:20px;height:100%;float: left' class='glyphicon glyphicon-"+mano+"'></span> <span> "+dato[0]+"</span>";
						var nclick=boton, data=nclick.data();
						data.verticalEdge=data.vertical || 'right';
						data.horizontalEdge=data.horizontal  || 'top';
						$.notific8(mensaj, data);
						$("#content ul .btn-reload").trigger("click");
					}
				});
			}else{
				$("#errFeca").show("drop",{direction:"up"}, "slow").delay(3000).hide("drop",{direction:"up"}, "slow");
				return false;
			}
		});
	});
}
*/
// ESTATUS DEL LOTE EN PRODUCCIÓN EN EL REPORTE
function estatusLoteRe(){
	$(".fechEs").click(function(){
		$("#fechaTermino .datetimepicker").css({"top": "160px", "left": "170px"});
	});
	$(".estatLoteb").mouseenter(function(){
		var ide = $(this).attr("id").split("-");
		var estatusActual = $("#estatusv-"+ide[1]).val();
		if(estatusActual == "En proceso"){
			$(this).addClass("btn-success");
			$(this).removeClass("btn-primary");
			$("#textoEstaus-"+ide[1]).text(" Terminado");
			$(".estatLoteEspan").removeClass("glyphicon-cog");
			$(".estatLoteEspan").addClass("glyphicon-ok");
		}else{
			$(this).removeClass("btn-success");
			$(this).addClass("btn-primary");
			$("#textoEstaus-"+ide[1]).text(" En proceso");
			$(".estatLoteEspan").addClass("glyphicon-cog");
			$(".estatLoteEspan").removeClass("glyphicon-ok");
		}
	});
	$(".estatLoteb").mouseleave(function(){
		var ide = $(this).attr("id").split("-");
		var estatusActual = $("#estatusv-"+ide[1]).val();
		if(estatusActual == "Terminado"){
			$(this).addClass("btn-success");
			$(this).removeClass("btn-primary");
			$("#textoEstaus-"+ide[1]).text(" Terminado");
			$(".estatLoteEspan").removeClass("glyphicon-cog");
			$(".estatLoteEspan").addClass("glyphicon-ok");
		}else{
			$(this).removeClass("btn-success");
			$(this).addClass("btn-primary");
			$("#textoEstaus-"+ide[1]).text(" En proceso");
			$(".estatLoteEspan").addClass("glyphicon-cog");
			$(".estatLoteEspan").removeClass("glyphicon-ok");
		}
	});
	$(".estatLoteb").click(function(event){
		event.preventDefault();
		var elid = $(this);
		var data=$(this).data();
		var idvent = elid.attr("data-target");
		$("#ventaEstatus"+idvent+"").attr('class','modal fade').addClass(data.effect).modal('show');
		var ide = $(this).attr("id").split("-");
		var estatusActualv = $("#estatusv-"+ide[1]).val();
		if(estatusActualv == "Terminado"){
			$("#fechaTermino").addClass("oculto");
			$("#fechafE").val("");
		}else{
			$("#fechaTermino").removeClass("oculto");
			$("#fechafE").val("");
		}
	// CLICK EN ACEPTAR MODIFICAR
		$(".modEstatus").click(function(event){
			var fechafi = $("#fechafE").val();
			if(estatusActualv == "En proceso"){
				if(fechafi != ""){
					var me = "";
					var fechaComp = new Array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					var fechaNum = new Array("0","01","02","03","04","05","06","07","08","09","10","11","12");
					var fechab = fechafi.split(" ");
					for(var e=0;e<fechaComp.length;e++){
						if(fechaComp[e] == fechab[1]){
							me = fechaNum[e];
						}
					}
					if(fechab.length > 3){
						fechafi = fechab[2]+"-"+me+"-"+fechab[0]+" "+fechab[4];
					}else{
						fechafi = fechab[2]+"-"+me+"-"+fechab[0];
					}
				}
				if(fechafi == ""){
					$("#errFeca").show("drop",{direction:"up"}, "slow").delay(3000).hide("drop",{direction:"up"}, "slow");
					return false;
				}
				$('#estatCerrar').trigger( 'click' );
				$("#estatLote-"+ide[1]).addClass("btn-success");
				$("#estatLote-"+ide[1]).removeClass("btn-primary");
				$(".estatLoteEspan").removeClass("glyphicon-cog");
				$(".estatLoteEspan").addClass("glyphicon-ok");
				$("#textoEstaus-"+ide[1]).text(" Terminado");
				$("#estatusv-"+ide[1]).val("Terminado");
			}else{
				$('#estatCerrar').trigger( 'click' );
				$("#estatLote-"+ide[1]).removeClass("btn-success");
				$("#estatLote-"+ide[1]).addClass("btn-primary");
				$(".estatLoteEspan").addClass("glyphicon-cog");
				$(".estatLoteEspan").removeClass("glyphicon-ok");
				$("#textoEstaus").text(" En proceso");
				$("#estatusv-"+ide[1]).val("En proceso");
			}
			var datos = {"cmo": "modificarEstatus","nomPagina": "v_lotesV","id": ide[1], "estatus": estatusActualv, "fechaF": fechafi};
			$.ajax({
				url:"index.php",
				type:"POST",
				data:datos,
				success: function(datosb) {
					var dato = datosb.split("#");
					var mano = "thumbs-up"; 
					if(dato[1] == "si"){
						mano = "thumbs-down";
						$("#btnAlertas").attr("data-theme","danger");
					}
					var boton = $("#btnAlertas");
					var mensaj = "<span style='font-size:40px;margin-right:20px;height:100%;float: left' class='glyphicon glyphicon-"+mano+"'></span> <span> "+dato[0]+"</span>";
					var nclick=boton, data=nclick.data();
					data.verticalEdge=data.vertical || 'right';
					data.horizontalEdge=data.horizontal  || 'top';
					$.notific8(mensaj, data);
					$("[carga='v_lotesV']").trigger("click");
					//$("#content ul .btn-reload").trigger("click");
				}
			});
		});
	});
}


//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::		PRODUCTOS DE MATERIA PRIMA		:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// FORMATEAR CAMPOOS DE NUEVO PRODUCTO
function nuevoProductoM (){
	//TITULO VENTANA
	$("#modAgreusu").html("Agregar nuevo");
	$("#ligaFoto").val("0");
	$("#fotoUsu").attr("src","vistas/images/picture.png");
	$("#fotoUsu").attr("style","opacity: .15;");
	$("#fotoUsu").parent().next().next().find(".fileinput-exists").trigger("click");
	
	$('#codigo').val("");
	$('#nombre').val("");
	$('#descripcion').val("");
	$("#tipo option[value='']").attr("selected",true);
	$('#tipo').selectpicker('val', '');
	$('#tipo').selectpicker('val', ['','Relish']);
	$("#material option[value='']").attr("selected",true);
	$('#material').selectpicker('val', '');
	$('#material').selectpicker('val', ['','Relish']);
	$("#categoria option[value='']").attr("selected",true);
	$('#categoria').selectpicker('val', '');
	$('#categoria').selectpicker('val', ['','Relish']);
	$("#proveedor option[value='']").attr("selected",true);
	$('#proveedor').selectpicker('val', '');
	$('#proveedor').selectpicker('val', ['','Relish']);
	$("#medida option[value='']").attr("selected",true);
	$('#medida').selectpicker('val', '');
	$('#medida').selectpicker('val', ['','Relish']);
	$("#color_0").val("");
	//$("#color_0").colpick();
	$("#idR").val("0");
}

//DATOS DEL PRODUCTO A MODIFICAR
function productosModM(a){
	var b = a.split("~");
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idR").val(b[0]);
	//TITULO VENTANA
	$("#modAgreusu").html("Modificar");
	//foto
	$("#fotoUsu").parent().next().next().find(".fileinput-exists").trigger("click");
	if(b[9] == 0){
		$("#fotoUsu").attr("style","opacity: .15;");
	}
	if(b[9] != 0){
		$("#fotoUsu").attr("style","opacity: 1;");
		$("#ligaFoto").val(b[9]);
		$("#fotoUsu").attr("src","archivos/fotosProductos/"+b[9]+"");
	}
	$("#foto").change(function(){
		$("#ligaFoto").val(b[9]);
	});
	$("#codigo").attr("value",b[1]);
	$("#nombre").attr("value",b[2]);
	$("#nombreB").attr("value",b[2]);
	$("#descripcion").attr("value",b[3]);
	//estatus
	var valorTipo = valorMaterial = valorCategoria = "0";
	switch(b[6]){
		case 'Botones': valorTipo = 'Botones'; break;
		case 'Blondas': valorTipo = 'Blondas'; break;
		case 'Cierres': valorTipo = 'Cierres'; break;
		case 'Pasamaneria': valorTipo = 'Pasamaneria'; break;
	}
	switch(b[7]){
		case 'Polester': valorMaterial = 'Polester'; break;
		case 'Algodon': valorMaterial = 'Algodon'; break;
		case 'Seda': valorMaterial = 'Seda'; break;
		case 'Forros': valorMaterial = 'Forros'; break;
	}
	switch(b[8]){
		case 'Accesorios': valorCategoria = 'Accesorios'; break;
		case 'Merceria': valorCategoria = 'Merceria'; break;
		case 'Telas': valorCategoria = 'Telas'; break;
	}
	$('#proveedor').selectpicker('deselectAll');
	$("#proveedor option").each(function(){
		var valo = $(this).attr("value");
		var valores = b[11].split("*");
		for(var r=0;r<valores.length;r++){
			if(valores[r] == valo){
				$("#proveedor option[value='"+valo+"']").attr("selected",true);
				$('#proveedor').selectpicker('refresh');
			}
		}
	});
	
	$("#medida option[value='"+b[12]+"']").attr("selected",true);
	$('#medida').selectpicker('val', b[12]);
	$('#medida').selectpicker('val', [b[12],'Relish']);
	$("#color_0").val(b[14]);
	$("#tipo option[value='"+valorTipo+"']").attr("selected",true);
	$('#tipo').selectpicker('val', valorTipo);
	$('#tipo').selectpicker('val', [valorTipo,'Relish']);
	
	$("#material option[value='"+valorMaterial+"']").attr("selected",true);
	$('#material').selectpicker('val', valorMaterial);
	$('#material').selectpicker('val', [valorMaterial,'Relish']);
	
	$("#categoria option[value='"+valorCategoria+"']").attr("selected",true);
	$('#categoria').selectpicker('val', valorCategoria);
	$('#categoria').selectpicker('val', [valorCategoria,'Relish']);
}

//DATOS DEL PRODUCTO A ELIMINAR
function productosElimM(id, elid){
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idElimina").val(id);
	var foto = $("#fot"+id+"").attr("src");
	if(foto == "assets/img/avatar7.gif"){
		$("#ligaFotoB").val("0");
	}else{
		var fotob = foto.split("/");
		$("#ligaFotoB").val(fotob[2]);
	}
	$("#ligaFotoB").val(foto);
	var nomPro = elid.parent().parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();
	$("#nomUsuElim").html(nomPro);
}

// INPUT SELECT DE PROVEEDORES
function seleProveeM(){
	$(".seleProveeM").each(function(){
		var selec=$(this).attr("id");
		var pagina = "proveedores";
		conAjax(pagina, selec);
	});
}

/*function popOverTabla(){
	$('.popTabla').each(function(){
		var id = $(this).attr("id").split("-");
		var contenido = $("#divPop-"+id[1]+"").html();
		$(this).popover({
			title: 'Datos del proveedor',
			content: contenido,
			templete: '<div class="popover"><div class="arrow"></div><h3 class="popover-title">Examplre</h3><div class="popover-content">'+contenido+'</div></div>',
			placement: 'top',
			trigger: 'hover'
		},'toggle');
	});
}*/

function popOverTablaM(){
	$('.popTabla').mouseenter(function(){
		var id = $(this).attr("id").split("-");
		$("#provT-"+id[1]+"").show();
	});
	$('.popTabla').mouseleave(function(){
		var id = $(this).attr("id").split("-");
		$("#provT-"+id[1]+"").hide();
	});
}

// +++++++++++++++++++++++++++++++++ 	COMPRAS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// FORMATEAR CAMPOOS DE NUEVA COMPRA
function nuevaVenCompraM (){
	//TITULO VENTANA
	$("#modAgreusu").html("Agregar nuevo");
	$("#folio").val("");
	$("#sucursal").prop('disabled',false);
	$("#sucursal").selectpicker("refresh");
	cancelarTrCPM();
	$("#proveedor").prop('disabled',false);
	$("#proveedor option[value='']").attr("selected",true);
	$('#proveedor').selectpicker('val', '');
	$("#proveedor").selectpicker("refresh");
	$("#fechabb").val("");
	$("#producto option[value='']").attr("selected",true);
	$('#producto').selectpicker('val', '');
	$("#producto").selectpicker("refresh");
	$("#cantidad").val("");
	$("#precio").val("");
	$("#dias").val("1");
	$("#idR").val("0");
	imageGrandCompr();
}

// INPUT SELECT DE SUCURSALES
function seleSucursalM(){
	$(".seleSucursalM").each(function(){
		var selec=$(this).attr("id");
		var pagina = "sucursales";
		conAjax(pagina, selec);
	});
}

// INPUT SELECT DE PRODUCTOS
function seleProductosM(){
	$(".selecProdComM").each(function(){
		var selec=$(this).attr("id");
		var pagina = "productosM";
		conAjax(pagina, selec);
	});
	// NO ELIMINAR EL CICLO DE ABAJO YA QUE ES ESPECIAL AUNQUE PAREZCA IGUAL
	$(".selecProdComMLote").each(function(){
		var selec=$(this).attr("id");
		var pagina = "productosM";
		conAjax(pagina, selec);
	});
	$(".selecProdComV").each(function(){
		var selec=$(this).attr("id");
		var pagina = "productosV";
		conAjax(pagina, selec);
	});
	// NO ELIMINAR EL CICLO DE ABAJO YA QUE ES ESPECIAL AUNQUE PAREZCA IGUAL
	$(".selecProdComL").each(function(){
		var selec=$(this).attr("id");
		var pagina = "productosV";
		conAjax(pagina, selec);
	});
}

// AGREGAR NUEVO PRODUCTO A LA LISTA
var contarCPM = 100;
function nuevaCompraM(){
	var proveedor = $("#proveedor option:selected").text();
	var sucursa = $("#sucursal option:selected").text();
	var fechabb = $("#fechabb").val();
	var producto = $("#producto option:selected").text();
	var idProducto = $("#producto option:selected").val();
	
	var idimagen = $("#imagen_xpandir-"+idProducto+"").attr("href");
	var imagen = '<a href="'+idimagen+'" title="'+producto+'" class="preview_fancybox2"><img style="width:23px" src="'+idimagen+'" title="'+producto+'"></a>';
	var cantidad = $("#cantidad").val();
	var precioU = $("#precio").val();
	if(producto != "- Selecciona -" && cantidad != "" && precioU != "" && proveedor != "- Selecciona -" && sucursa != "- Selecciona -" && fechabb != ""){
		if(contarCPM == 100){
			$("#proveedor").prop('disabled',true);
			$("#proveedor").selectpicker("refresh");
			$("#sucursal").prop('disabled',true);
			$("#sucursal").selectpicker("refresh");
		}
		var precio = precioU.replace("$","");
		precio = precio.replace(",","");
		precio = precio.replace(",","");
		
		var total = $("#totalCPM").text();
		total = total.replace("$","");
		total = total.replace(",","");
		total = total.replace(",","");
		
		precio = parseFloat(precio) * parseFloat(cantidad);
		total = parseFloat(total) + precio;
		var eltr = "<tr class='trCompraMateria' id='eltrCPM-"+contarCPM+"'><td class='idproductoB clDetalCompra' idproducto='"+idProducto+"'>"+imagen+"  "+producto+"</td><td><b class='clDetalCompra'>"+cantidad+"</b></td><td class='dineroComp clDetalCompra'>"+precioU+"</td><td class='dineroComp clDetalCompra' id='precioTCPM-"+contarCPM+"'>"+precio+"</td><td><span class='tooltip-area'>\
					<button id='eliCPM-"+contarCPM+"' onclick='eliminarTrCPM($(this).attr(\"id\"))' type='button' class='btn btn-danger btn-danger' data-effect='md-flipHor'><i class='fa fa-trash-o'></i></button></span></td></tr>";
		$(eltr).appendTo($("#tablaComprasMP"));
		$("#totalCPM").text(total).formatCurrency();
		$("#total").val(total);
		$("#precioTCPM-"+contarCPM+"").formatCurrency();
		$("#producto option[value='']").attr("selected",true);
		$('#producto').selectpicker('val', '');
		$("#producto").selectpicker("refresh");
		$("#cantidad").val("");
		$("#precio").val("");
		$(".dineroComp").formatCurrency();
		imageGrandCompr();
		$(".preview_fancybox2").fancybox();
		contarCPM = contarCPM + 1;
	}else{
		return false;
	}
}

//DATOS DE LA COMPRA A MODIFICAR
function comprasModM(a){
	cancelarTrCPM();
	var b = a.split("~");
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idR").val(b[0]);
	//TITULO VENTANA
	$("#modAgreusu").html("Modificar");
	var detalles = b[6].split("#");
	$("#folio").val(b[7]);
	$("#proveedor option[value='"+b[3]+"']").attr("selected",true);
	$('#proveedor').selectpicker('val', b[3]);
	$("#proveedor").prop('disabled',true);
	$("#proveedor").selectpicker("refresh");
	var fec = b[1].split(" ");
	var feca = fec[0].split("-");
	var mes = new Array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$("#fechabb").val(feca[2]+" "+mes[parseInt(feca[1])]+" "+feca[0]+" "+fec[1]);
	var total = 0;
	var contar = 0;
	for(var i=0;i<detalles[0];i++){
		var precio = parseFloat(detalles[4 + contar]) * parseFloat(detalles[5 + contar]);
		total = parseFloat(total) + precio;

		var imagen = '<a href="archivos/fotosProductos/'+detalles[8 + contar]+'" title="'+detalles[6 + contar]+'" class="preview_fancybox2"><img style="width:23px" src="archivos/fotosProductos/'+detalles[8 + contar]+'" title="'+detalles[6 + contar]+'"></a>';
	
		var eltr = "<tr class='trCompraMateria' id='eltrCPM-"+i+"'><td class='idproductoB clDetalCompra' idproducto='"+detalles[3 + contar]+"'>"+imagen+" "+detalles[6 + contar]+"</td><td><b class='clDetalCompra'>"+detalles[4 + contar]+"</b></td><td class='dineroComp clDetalCompra'>"+detalles[5 + contar]+"</td><td class='dineroComp clDetalCompra' id='precioTCPM-"+i+"'>"+precio+"</td><td><span class='tooltip-area'>\
					<button id='eliCPM-"+i+"' onclick='eliminarTrCPM($(this).attr(\"id\"))' type='button' class='btn btn-danger btn-danger' data-effect='md-flipHor'><i class='fa fa-trash-o'></i></button></span></td></tr>";
		$(eltr).appendTo($("#tablaComprasMP"));
		$("#totalCPM").text(total).formatCurrency();
		$("#total").val(total);
		$("#precioTCPM-"+i+"").formatCurrency();
		$(".dineroComp").formatCurrency();
		contar = contar + 9;
	}
	$("#sucursal option[value='"+detalles[7]+"']").attr("selected",true);
	$('#sucursal').selectpicker('val', detalles[7]);
	$("#sucursal").prop('disabled',true);
	$("#sucursal").selectpicker("refresh");
	if( b[5] == "Pagado"){
			$("#notaPagada").parent().bootstrapSwitch('setState', true);
			$("#pagadComMat").text("Pagado");
			$("#estatus").val("Pagado");
			$("#dias").val("1");
		}else{
			$("#notaPagada").parent().bootstrapSwitch('setState', false);
			$("#pagadComMat").text("Sin pagar");
			$("#estatus").val("Sin pagar");
			$("#dias").val(b[8]);
		}
		imageGrandCompr();
		$(".preview_fancybox2").fancybox();
}

//DATOS DE LA COMPRA A ELIMINAR
function comprasMElim(id, elid){
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idElimina").val(id);
	var nomUsu = elid.parent().parent().prev().prev().prev().prev().prev().prev().prev().prev().html();
	$("#nomUsuElim").html(nomUsu);
}

// ELIMINAR PRODUCTO DE LA LISTA
function eliminarTrCPM(ide){
	var id = ide.split("-");
	var total = $("#totalCPM").text();
	total = total.replace("$","");
	total = total.replace(",","");
	total = total.replace(",","");
	
	var precio = $("#precioTCPM-"+id[1]+"").text();
	precio = precio.replace("$","");
	precio = precio.replace(",","");
	precio = precio.replace(",","");
	total = parseFloat(total) - parseFloat(precio);
	$("#totalCPM").text(total).formatCurrency();
	$("#total").val(total);
	$("#detalles").val(producto+"~"+cantidad+"~"+precio);
	$("#eltrCPM-"+id[1]+"").remove();
}

// CANCELAR NOTA DE COMPRA
function cancelarTrCPM(){
	$("#tablaComprasMP tr").each(function (){
		$(this).remove();
		$("#folio").val("");
		$("#totalCPM").text("$0.00");
		$("#total").val("0");
		$("#producto option:selected").val("0");
		$("#producto").selectpicker('deselectAll');
		$("#producto").selectpicker("refresh");
		$("#proveedor").prop('disabled',false);
		$("#proveedor").selectpicker("refresh");
	});
}

// ANTES DE GUARDAR LA COMPRA
function notaCompraM(id){
	var contador = 0;
	var texto = "";
	$("#"+id+" tr .clDetalCompra").each(function(){
		if(contador == 4){
			contador = 0;
		}
			var texto2 = "";
			var laclase = $(this).attr("class");
			laclase = laclase.split(" ");
			if(laclase[0] == "dineroComp"){
				texto2 = $(this).text().replace("$","");
				texto2 = texto2.replace(",","");
				texto2 = texto2.replace(",","");
			}
			else if(laclase[0] == "idproductoB"){
				texto2 = $(this).attr("idproducto");
			}else{
				texto2 = $(this).text();
			}
			
			if(texto == ""){
				texto = texto2;
			}else{
				if(contador == 0){
					texto = texto + "#" + texto2;
				}else{
					texto = texto + "~" + texto2;
				}
			}
			contador = contador + 1;
	});
	$("#detalles").val(texto);
	$("#fechabb").attr('disabled',false);
	$("#proveedor").prop('disabled',false);
	$("#proveedor").selectpicker("refresh");
	$("#sucursal").prop('disabled',false);
	$("#sucursal").selectpicker("refresh");
}

//	++++++++++++++++++++++++++++++++++++++	INVENTARIOS	+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//DATOS DEL INVENTARIO A MODIFICAR
function inventarioModM(a){
	var b = a.split("~");
	var c = b[4].split("#");
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idR").val(b[0]);
	//TITULO VENTANA
	$("#modAgrepro").next().html(b[1]);
	$("#cantidad").val("");
	$("#cantidad").parent().next().css("display","none");
	$("#desucursal").selectpicker('deselectAll');
	$("#asucursal").selectpicker('deselectAll');
	$("#asucursal").selectpicker("refresh");
	$("#desucursal option").prop("disabled",true);
	$("#desucursal").selectpicker("refresh");
	if(b[5] != ""){
		$("#fotoProAl").attr("src","archivos/fotosProductos/"+b[5]+"");
	}
	var contar = 0;
	for(var i=0;i<c[1];i++){
		if(c[5 + contar] != 0){
			$("#desucursal option[value='"+c[4 + contar]+"']").attr("rango","[1,"+c[5 + contar]+"]");
			$("#desucursal option[value='"+c[4 + contar]+"']").prop("disabled",false);
			$("#desucursal").selectpicker("refresh");
		}
		contar = contar + parseInt(c[0]);
	}
	$("#desucursal option[value='']").prop("disabled",false);
	$("#desucursal").selectpicker("refresh");
	
	$("#desucursal").on('change', function(){
		$("#asucursal option").prop("disabled",false);
		$("#asucursal").selectpicker('deselectAll');
		$("#cantidad").val("");
		var rango = $(this).find("option:selected").attr("rango");
		var valor = $(this).find("option:selected").val();
		$("#asucursal option[value='"+valor+"']").prop("disabled",true);
		$("#asucursal").selectpicker("refresh");
		$("#cantidad").attr("parsley-range",rango);
		rangoInven();
	});
}

function rangoInven(){
	//iCheck[components] validate
	$('.validaRango').on('change', function(event){
		var valor = $(this).val();
		var rango = $(this).attr("parsley-range");
		if(valor == NaN){
			$(this).val("1");
		}
		rango = rango.replace("[","");
		rango = rango.replace("]","");
		rango = rango.split(",");
		if(valor <  parseFloat(rango[0])){
			$(this).val(rango[0]);
			$(this).parent().next().children().next().text(rango[0]);
			$(this).parent().next().children().next().next().text(rango[1]);
			$(this).parent().next().show("drop",{direction:"up"}, "slow").delay(3000).hide("drop",{direction:"up"}, "slow");
		}
		if(valor > parseFloat(rango[1])){
			$(this).val(rango[1]);
			$(this).parent().next().children().next().text(rango[0]);
			$(this).parent().next().children().next().next().text(rango[1]);
			$(this).parent().next().show("drop",{direction:"up"}, "slow").delay(3000).hide("drop",{direction:"up"}, "slow");
		}
		//$(event.target).parsley( 'validate' );
	});
}

//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::		SUCURSALES		:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// FORMATEAR CAMPOOS DE NUEVA SUCURSAL
function nuevaSucursal (){
	//TITULO VENTANA
	$("#modAgreusu").html("Agregar nueva");
	$('#nombre').val("");
	$('#direccion').val("");
	$('#telefono').val("");
	$("#idR").val("0");
}

//DATOS DEL PRODUCTO A MODIFICAR
function sucursalesMod(a){
	var b = a.split("~");
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idR").val(b[0]);
	//TITULO VENTANA
	$("#modAgreusu").html("Modificar");

	$("#nombre").attr("value",b[1]);
	$("#direccion").attr("value",b[2]);
	$("#telefono").attr("value",b[3]);
}

//DATOS DEL PRODUCTO A ELIMINAR
function sucursalesElim(id, elid){
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idElimina").val(id);
	var nomPro = elid.parent().parent().prev().prev().prev().html();
	$("#nomUsuElim").html(nomPro);
}

//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::		PROVEEDORES		:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// FORMATEAR CAMPOOS DE NUEVO PROVEEDOR
function nuevoProveedor (){
	//TITULO VENTANA
	$("#modAgreusu").html("Agregar nuevo");
	$('#nombre').val("");
	$('#direccion').val("");
	$('#telefono').val("");
	$('#ciudad').val("");
	$('#empresa').val("");
	$('#colonia').val("");
	$('#codigop').val("");
	$('#rfc').val("");
	$('#cuenta').val("");
	$('#banco').val("");
	$('#puesto').val("");
	$('#celular').val("");
	$('#correoe').val("");
	$('#credito').val("");
	$("#idR").val("0");
}

//DATOS DEL PROVEEDOR A MODIFICAR
function proveedoresMod(a){
	var b = a.split("~");
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idR").val(b[0]);
	//TITULO VENTANA
	$("#modAgreusu").html("Modificar");

	$("#nombre").attr("value",b[1]);
	$("#direccion").attr("value",b[2]);
	$("#telefono").attr("value",b[3]);
	$("#ciudad").attr("value",b[4]);
	$("#empresa").attr("value",b[5]);
	$('#colonia').attr("value",b[6]);
	$('#codigop').attr("value",b[7]);
	$('#puesto').attr("value",b[8]);
	
	$('#correoe').attr("value",b[9]);
	$('#rfc').attr("value",b[10]);
	$('#credito').attr("value",b[11]);
	$('#celular').attr("value",b[12]);
	$('#cuenta').attr("value",b[13]);
	$('#banco').attr("value",b[14]);
}

//DATOS DEL PROVEEDOR A ELIMINAR
function proveedoresElim(id, elid){
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idElimina").val(id);
	var nomPro = elid.parent().parent().prev().prev().prev().prev().prev().prev().prev().html();
	$("#nomUsuElim").html(nomPro);
}

//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::		CLIENTES		:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// FORMATEAR CAMPOOS DE NUEVO CLIENTE
function nuevoCliente (){
	//TITULO VENTANA
	$("#modAgreusu").html("Agregar nuevo");
	$('#nombre').val("");
	$('#fechabb').val("");
	$('#direccion').val("");
	$('#telefono').val("");
	$('#ciudad').val("");
	$('#empresa').val("");
	$('#colonia').val("");
	$('#codigop').val("");
	$('#rfc').val("");
	$('#cuenta').val("");
	$('#banco').val("");
	$('#descuento').val("");
	$('#celular').val("");
	$('#correoe').val("");
	$('#credito').val("");
	$("#idR").val("0");
	
	$("#ligaFoto").val("0");
	$("#fotoUsu").parent().next().next().find(".fileinput-exists").trigger("click");
	$("#fotoUsu").attr("src","vistas/images/user.gif");
}

//DATOS DEL CLIENTE A MODIFICAR
function clientesMod(a){
	var b = a.split("~");
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idR").val(b[0]);
	//TITULO VENTANA
	$("#modAgreusu").html("Modificar");
	$("#nombre").attr("value",b[2]);
	$("#nombreB").attr("value",b[2]);
	$("#direccion").attr("value",b[3]);
	$("#telefono").attr("value",b[4]);
	$('#celular').attr("value",b[5]);
	$("#ciudad").attr("value",b[6]);
	$('#colonia').attr("value",b[7]);
	$('#codigop').attr("value",b[8]);
	$('#descuento').attr("value",b[9]);
	$('#credito').attr("value",b[10]);
	$('#correoe').attr("value",b[11]);
	var feca = b[12].split("-");
	var mes = new Array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$("#fechabb").val(feca[2]+" "+mes[parseInt(feca[1])]+" "+feca[0]);
	//foto
	$("#fotoUsu").parent().next().next().find(".fileinput-exists").trigger("click");
	if(b[15] != ""){
		$("#ligaFoto").val(b[15]);
		$("#fotoUsu").attr("src","archivos/fotosClientes/"+b[15]+"");
	}
	$("#foto").change(function(){
		$("#ligaFoto").val(b[15]);
	});
	$('#rfc').attr("value",b[16]);
	$("#empresa").attr("value",b[17]);
	$('#cuenta').attr("value",b[18]);
	$('#banco').attr("value",b[19]);
}

//DATOS DEL CLIENTE A ELIMINAR
function clientesElim(id, elid){
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idElimina").val(id);
	var foto = $("#fot"+id+"").attr("src");
	if(foto == "assets/img/avatar7.gif"){
		$("#ligaFotoB").val("0");
	}else{
		var fotob = foto.split("/");
		$("#ligaFotoB").val(fotob[2]);
	}
	$("#ligaFotoB").val(foto);
	var nomPro = elid.parent().parent().prev().prev().prev().prev().prev().prev().prev().prev().html();
	$("#nomUsuElim").html(nomPro);
	
}

//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::		EMPLEADOS		:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// FORMATEAR CAMPOOS DE NUEVO EMPLEADO
function nuevoEmpleado (){
	//TITULO VENTANA
	$("#modAgrepro").html("Agregar nuevo");
	$('#nombre').val("");
	$('#fechabb').val("");
	$('#fechabb2').val("");
	$('#direccion').val("");
	$('#telefono').val("");
	$('#ciudad').val("");
	$('#colonia').val("");
	$('#sueldo').val("");
	$('#horarioEntrada').val("");
	$('#horarioSalida').val("");
	$('#celular').val("");
	$('#correoe').val("");
	$('#puesto').val("");
	$("#idR").val("0");
	
	$("#ligaFoto").val("0");
	$("#fotoUsu").parent().next().next().find(".fileinput-exists").trigger("click");
	$("#fotoUsu").attr("src","vistas/images/user.gif");
}

//DATOS DEL EMPLEADO A MODIFICAR
function empleadosMod(a){
	var b = a.split("~");
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idR").val(b[0]);
	//TITULO VENTANA
	$("#modAgrepro").html("Modificar");
	$("#nombre").attr("value",b[1]);
	$("#nombreB").attr("value",b[1]);
	$("#direccion").attr("value",b[2]);
	$("#telefono").attr("value",b[3]);
	$('#celular').attr("value",b[4]);
	$("#ciudad").attr("value",b[5]);
	$('#colonia').attr("value",b[6]);
	$('#puesto').attr("value",b[7]);
	$('#correoe').attr("value",b[8]);
	$('#descuento').attr("value",b[9]);
	$('#sueldo').attr("value",b[14]);
	var horario = b[13].split("-");
	$('#horarioEntrada').attr("value",horario[0]);
	$('#horarioSalida').attr("value",horario[1]);
	var feca = b[9].split("-");
	var feca2 = b[11].split("-");
	var mes = new Array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$("#fechabb").val(feca[2]+" "+mes[parseInt(feca[1])]+" "+feca[0]);
	$("#fechabb2").val(feca2[2]+" "+mes[parseInt(feca2[1])]+" "+feca2[0]);
	//foto
	$("#fotoUsu").parent().next().next().find(".fileinput-exists").trigger("click");
	if(b[12] != ""){
		$("#ligaFoto").val(b[12]);
		$("#fotoUsu").attr("src","archivos/fotosEmpleados/"+b[12]+"");
	}
	$("#foto").change(function(){
		$("#ligaFoto").val(b[12]);
	});
}

//DATOS DEL EMPLEADO A ELIMINAR
function empleadosElim(id, elid){
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idElimina").val(id);
	var foto = $("#fot"+id+"").attr("src");
	if(foto == "assets/img/avatar7.gif"){
		$("#ligaFotoB").val("0");
	}else{
		var fotob = foto.split("/");
		$("#ligaFotoB").val(fotob[2]);
	}
	$("#ligaFotoB").val(foto);
	var nomPro = elid.parent().parent().prev().prev().prev().prev().prev().prev().prev().prev().html();
	$("#nomUsuElim").html(nomPro);
	
}

//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::		GASTOS		:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// FORMATEAR CAMPOOS DE NUEVO GASTO
function nuevoGasto(){
	//TITULO VENTANA
	$("#modAgrepro").html("Agregar nuevo");
	$('#folio').val("");
	$('#gasto').val("");
	$('#cantidad').val("");
	$('#descripcion').val("");	
	$('#fechabb').val("");
	$("#idR").val("0");
	$('#otroGasto').val("");
}

//DATOS DEL GASTO A MODIFICAR
function gastosMod(a){
	var b = a.split("~");
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idR").val(b[0]);
	//TITULO VENTANA
	$("#modAgrepro").html("Modificar");
	$("#folio").attr("value",b[1]);
	var feca = b[2].split("-");
	var mes = new Array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$("#fechabb").val(feca[2]+" "+mes[parseInt(feca[1])]+" "+feca[0]);
	$("#cantidad").attr("value",b[3]);
	$("#tipoGasto option[value='"+b[4]+"']").attr("selected",true);
	$('#tipoGasto').selectpicker('val', b[4]);
	$("#tipoGasto").selectpicker("refresh");
	if(b[4] == "Otros gastos"){
		$("#otroGa").removeClass("oculto");
		$("#otroGasto").val("");
		$('#otroGasto').attr("value",b[5]);
	}else{
		$("#otroGa").addClass("oculto");
		$("#otroGasto").val("");
	}
	$("#gasto").attr("value",b[6]).formatCurrency();
	var total = parseFloat(b[6]) * parseFloat(b[3]);
	$("#total").val(total).formatCurrency();
	$('#descripcion').attr("value",b[7]);
}

//DATOS DEL GASTO A ELIMINAR
function gastosElim(id, elid){
	// ID DEL REGISTRO (NO MODIFICAR)
	$("#idElimina").val(id);
	var nomPro = elid.parent().parent().prev().prev().prev().prev().prev().prev().prev().html();
	$("#nomUsuElim").html(nomPro);
	
}

function selecOtrosGastos(){
	$("#tipoGasto").change(function(){
		var valor = $(this).val();
		if(valor == "Otros gastos"){
			$("#otroGa").removeClass("oculto");
			$("#otroGasto").val("");
		}else{
			$("#otroGa").addClass("oculto");
			$("#otroGasto").val("");
		}
	});
}

function totalGasto(){
	$(".totalGast").change(function(){
		var cantidad = 1;
		var gasto = $("#gasto").val();
		gasto = gasto.replace("$","");
		gasto = gasto.replace(",","");
		gasto = gasto.replace(",","");
		if($("#cantidad").val() != ""){
			cantidad = $("#cantidad").val();
		}
		var total = parseFloat(cantidad) * parseFloat(gasto);
		if(!isNaN(total)){
			$("#total").val(total).formatCurrency();
		}
	});
}

//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::		VENTAS		:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// SELECT DE CLIENTES
function seleClienteM(){
	$(".seleClienteM").each(function(){
		var selec=$(this).attr("id");
		var pagina = "clientes";
		conAjax(pagina, selec);
	});
}

// INPUT SELECT DE SUCURSALES EN VENTAS
function seleSucursalVenta(){
	$("#fotoVentaBuscar").attr("href","vistas/images/picture.png");
	$("#fotoProdVen").attr("src","vistas/images/picture.png");
	$("#productoBus").val("");
	$("#precio").val("");
	$("#cantidad").val("");
	$("#pTotal").text("$0.00");
}

// AGREGA EL FOLIO SIGUIENTE DE VENTA EN AUTOMATICO
function folioVenta(){
	var datos = {"con": "contado"};
	res = consultaAjax(datos);
	var cont = contador2 = 0;
	var valor = 1;
	res = res.split("~");
	while(cont < res[0]){
		if(cont+1 == res[0]){
			valor = parseInt(res[2 + contador2]) + 1;
		}
		cont = cont + 1;
		contador2 = contador2 + parseInt(res[1]);
	}
	$("#folioVenta").val(valor);
}

// INICIA LA PAGINA DE VENTA EN AUTOSCROLL
function scrollStop(){
	$( "#main" ).scrollTop( 67 );
}

// SE CREA LA TABALA DE LA BUSQUEDA DEL PRODUCTO
function buscaProductoVentana(buscar,id){
		var datos = {"cmo": "consultaProducto","nomPagina": "v_productosV","buscar":buscar};
		res = consultaAjax(datos);
		res = res.split("~");
		var cont = contador2 = 0;
		$("#tbodyResult tr").remove();
		var elTbody = "";
		var sucursal = $("#sucursal option:selected").val();
		while(cont < parseInt(res[0])){
			var codigo = res[3 + contador2];
			var nombre = res[4 + contador2];
			var descripcion = res[5 + contador2];
			var precio = res[7 + contador2];
			var medida = res[14 + contador2];
			var sucursales = res[15 + contador2].split("*");
			var cantidades = res[16 + contador2].split("*");
			var contSu = cantidad = 0;
			while(contSu < sucursales.length){
				if(sucursales[contSu] == sucursal){
					cantidad = cantidad + parseFloat(cantidades[contSu]);
				}
				contSu = contSu + 1;
			}
			//var precio = precioS.formatCurrency();
			var foto = res[11 + contador2];
			if(foto == ""){
				foto = "vistas/images/picture.png";
			}else{foto = "archivos/fotosProductos/"+foto;}
			elTbody += "<tr id='"+res[2 + contador2]+"' no='"+cont+"' cantidad='"+cantidad+"' class='ui-widget-content' style='color:black;font-size: 16px;cursor:pointer' nombre='"+codigo+" "+nombre+" "+descripcion+" "+precio+"' tipo='fila'>\
									<td><a campo='foto' href='"+foto+"' title='"+nombre+"' class='preview_fancybox'><img id='fot"+res[2 + contador2]+"' style='width:50px' src='"+foto+"' /></a><br><span campo='codigo'>"+codigo+"</span></td>\
									<td campo='nombre'>"+nombre+"</td>\
									<td campo='descripcion'>"+descripcion+"</td>\
									<td campo='precio'><b class='dinero'>"+precio+"</b></td>\
									<td campo='unidad'>"+medida+"</td>\
								</tr>";
			cont = cont + 1;
			contador2 = contador2 + parseInt(res[1]);
		}
		if(elTbody == ""){
			elTbody = "<tr><td colspan='5' style='font-size:24px;color:black' ><b>Sin resultados</b></td></tr>";
		}
		$("#tbodyResult").html(elTbody);
		$(".dinero").formatCurrency();
		$(".preview_fancybox").fancybox({
			'transitionIn'	:	'elastic',
			'transitionOut'	:	'elastic',
			'speedIn'		:	600, 
			'speedOut'		:	800,
			//'titlePosition'		:	'over'
		});

		$("#tbodyResult").selectable({
			filter: "tr",
			stop: function() {
			$( ".ui-selected", this ).each(function() {
				// ENTRA AQUI SOLO SI EL BUSCADOR ES EL DE VENTAS
				function checkKey(e) {
					e = e || window.event;
					//arriba
					if(e.keyCode == 38){
						$( "#tbodyResult").find(".ui-selected").each(function() {
							$(this).prev().addClass("ui-selected"); //habilitado
							$(this).removeClass("ui-selected");  //deshabilitado
							if(id != "buscadorPrincipal"){
								$("#fotoVentaBuscar").attr("href",$(this).prev().find("[campo='foto']").attr("href"));
								$("#fotoProdVen").attr("src",$(this).prev().find("[campo='foto']").attr("href"));
								$("#productoBus").val($(this).prev().find("[campo='nombre']").text());
								$("#producto").val($(this).prev().attr("id"));
								$("#precio").val($(this).prev().find("[campo='precio']").text());
								$("#precio").next().text($(this).find("[campo='unidad']").text());
								var canti = diferenciaInventario($(this).prev().attr("id"));
								canti = parseFloat($(this).prev().attr("cantidad")) - parseFloat(canti);
								$("#cantidad").attr("inventario",canti);
								multiplicarVenB();
							}
						});
					}
					//abajo
					if(e.keyCode == 40){
						$( "#tbodyResult").find(".ui-selected").each(function() {
							$(this).next().addClass("ui-selected"); //habilitado
							$(this).removeClass("ui-selected");  //deshabilitado
							if(id != "buscadorPrincipal"){
								$("#fotoVentaBuscar").attr("href",$(this).next().find("[campo='foto']").attr("href"));
								$("#fotoProdVen").attr("src",$(this).next().find("[campo='foto']").attr("href"));
								$("#productoBus").val($(this).next().find("[campo='nombre']").text());
								$("#producto").val($(this).next().attr("id"));
								$("#precio").val($(this).next().find("[campo='precio']").text());
								$("#precio").next().text($(this).find("[campo='unidad']").text());
								var canti = diferenciaInventario($(this).next().attr("id"));
								canti = parseFloat($(this).next().attr("cantidad")) - parseFloat(canti);
								$("#cantidad").attr("inventario",canti);
								multiplicarVenB();
							}
						});
					}
					if(e.keyCode == 13){
						$("#CerrarBuscador").trigger("click");
					}
				}
				document.onkeydown = checkKey;
				if(id != "buscadorPrincipal"){
					//$(this).css("background-color","#5AB5AD");
					$("#fotoVentaBuscar").attr("href",$(this).find("[campo='foto']").attr("href"));
					$("#fotoProdVen").attr("src",$(this).find("[campo='foto']").attr("href"));
					$("#productoBus").val($(this).find("[campo='nombre']").text());
					$("#producto").val($(this).attr("id"));
					$("#precio").val($(this).find("[campo='precio']").text());
					$("#precio").next().text($(this).find("[campo='unidad']").text());
					var canti = diferenciaInventario($(this).attr("id"));
					canti = parseFloat($(this).attr("cantidad")) - parseFloat(canti);
					$("#cantidad").attr("inventario",canti);
					multiplicarVenB();
				}
			});
		  }
		});
		
		$( "#tbodyResult").find("[no='0']").each(function() {
			$(this).addClass("ui-selected");
			if(id != "buscadorPrincipal"){
				$("#fotoVentaBuscar").attr("href",$(this).find("[campo='foto']").attr("href"));
				$("#fotoProdVen").attr("src",$(this).find("[campo='foto']").attr("href"));
				$("#productoBus").val($(this).find("[campo='nombre']").text());
				$("#producto").val($(this).attr("id"));
				$("#precio").val($(this).find("[campo='precio']").text());
				$("#precio").next().text($(this).find("[campo='unidad']").text());
				if($("#tbodyResult tr").length < 2){
					$("#CerrarBuscador").trigger("click");
				}
				var canti = diferenciaInventario($(this).attr("id"));
				canti = parseFloat($(this).attr("cantidad")) - parseFloat(canti);
				$("#cantidad").attr("inventario",canti);
				multiplicarVenB();
			}
		});
		
}

// FILTRO DEL BUSCADOR DE PRODUCTOS
function buscaProducto(){
	$(".buscador").on("change", function(){
		var elemento = $(this).attr("id");
		if(elemento != "productoBusV"){
			$("#productoBusV").val($(this).val());
			$("#ventaBuscador").attr('class','modal fade').addClass("md-flipHor").modal('show');
		}else{
			$("#productoBus").val($(this).val());
			$("#buscadorPrincipal").val($(this).val());
		}
		var buscar = $(this).val();
		var id = $(this).attr("id");
		buscaProductoVentana(buscar,id);
	});
	/*$("#prodSelecV").on("keyup", "[type=search]", function () {
		if ($(this).val()!="") {
			$("#"+$(this).attr("padre")+" > tr[tipo=fila]").not("tr[nombre*='"+$(this).val().toLowerCase()+"']").hide("highlight");
			$("#"+$(this).attr("padre")+" > tr[nombre*='"+$(this).val().toLowerCase()+"']").show("highlight");
		}else{
			$("#"+$(this).attr("padre")+" tr[tipo=fila]").show("highlight");
		}
	}).on("search", "[type=search]", function () {
		if ($(this).val()!="") {
			$("#"+$(this).attr("padre")+" > tr[tipo=fila]").not("tr[nombre*='"+$(this).val().toLowerCase()+"']").hide("highlight");
			$("#"+$(this).attr("padre")+" > tr[nombre*='"+$(this).val().toLowerCase()+"']").show("highlight");
		}
		else{
			$("#"+$(this).attr("padre")+" tr[tipo=fila]").show("highlight");
		}
	});*/

}

// MUESTRA EL TOTAL PARCIAL DEL PRODUCTO
function multiplicarVen(){
	$(".multiplicarVen").focusout(function(){
		multiplicarVenB();
	});
}

// MUESTRA EL TOTAL PARCIAL DEL PRODUCTO
function multiplicarVenB(){
	var precio = cantidad = 1;
	if($("#precio").val() != "" && $("#precio").val() != 0){
		precio = $("#precio").val().replace("$","");
		precio = precio.replace(",","");
		precio = precio.replace(",","");
	}
	var cantidadB = $("#cantidad").val();
	var inventario = $("#cantidad").attr("inventario");
	if($("#cantidad").val() != "" && $("#cantidad").val() > 0){
		cantidad = $("#cantidad").val();
		if(parseFloat(inventario) < 1 || parseFloat(inventario) < parseFloat(cantidad)){
			$("#cantidad").next().children().next().text(1);
			$("#cantidad").next().children().next().next().text(inventario);
			$("#cantidad").next().show("drop",{direction:"up"}, "slow").delay(3000).hide("drop",{direction:"up"}, "slow");
			$("#cantidad").val("");
			return false;
		}
	}
	var total = parseFloat(precio) * parseFloat(cantidad);
	$("#pTotal").text(total).formatCurrency();
	return 1;
}

// CANCELAR NOTA DE VENTA
function cancelarTrNV(){
	//$('#formVentana').parsley('destroy');
	$("#fotoVentaBuscar").attr("href","vistas/images/picture.png");
	$("#fotoProdVen").attr("src","vistas/images/picture.png");
	$("#productoBus").val("");
	$("#precio").val("");
	$("#cantidad").val("");
	$("#pTotal").text("$0.00");

	$("#tventa").selectpicker('deselectAll');
	$("#tventa").prop('disabled',false);
	$("#tventa").selectpicker("refresh");
	$("#sucursal").selectpicker('deselectAll');
	$("#sucursal").prop('disabled',false);
	$("#sucursal").selectpicker("refresh");
	$("#cliente").selectpicker('deselectAll');
	$("#cliente").selectpicker("refresh");
	contarVen = 100;
	eliminaTodosTr();
}

function eliminaTodosTr(){
	$("#tablaVentas tr").each(function (){
		$(this).remove();
	});	
	$("#totalVenta").text("$0.00");
	$("#total").val("0");
	recorreTrVenta();
}

// ELIMINAR PRODUCTO DE LA LISTA
function eliminarTrVnt(ide){
	var id = ide.split("-");
	var total = $("#totalVenta").text();
	total = total.replace("$","");
	total = total.replace(",","");
	total = total.replace(",","");
	
	var precio = $("#precioTCPM-"+id[1]+"").text();
	precio = precio.replace("$","");
	precio = precio.replace(",","");
	precio = precio.replace(",","");
	total = parseFloat(total) - parseFloat(precio);
	$("#totalVenta").text(total).formatCurrency();
	$("#total").val(total);
	$("#detalles").val(producto+"~"+cantidad+"~"+precio);
	$("#eltrCPM-"+id[1]+"").remove();
	recorreTrVenta();
}

// AGREGAR NUEVO PRODUCTO A LA LISTA
var contarVen = 100;
function nuevaVenta(){
	var si = multiplicarVenB();
	if(si == 1){
		var tventa = $("#tventa option:selected").text();
		var sucursa = $("#sucursal option:selected").text();
		var cliente = $("#cliente option:selected").text();
		var producto = $("#productoBus").val();
		var idProducto = $("#producto").val();

		var idimagen = $("#fotoVentaBuscar").attr("href");
		var imagen = '<a href="'+idimagen+'" title="'+producto+'" class="preview_fancybox2"><img style="width:23px" src="'+idimagen+'" title="'+producto+'"></a>';
		var cantidad = $("#cantidad").val();
		var precioU = $("#precio").val();
		var inventario = $("#cantidad").attr("inventario");
		if(idProducto != "" && cantidad > 0 && precioU != ""){
			if(parseFloat(inventario) < 1 || parseFloat(inventario) < parseFloat(cantidad)){
				$("#cantidad").next().children().next().text(1);
				$("#cantidad").next().children().next().next().text(inventario);
				$("#cantidad").next().show("drop",{direction:"up"}, "slow").delay(3000).hide("drop",{direction:"up"}, "slow");
				$("#cantidad").val("");
				return false;
			}
			if(contarVen == 100){
				$("#tventa").prop('disabled',true);
				$("#tventa").selectpicker("refresh");
				$("#sucursal").prop('disabled',true);
				$("#sucursal").selectpicker("refresh");
			}
			var precio = precioU.replace("$","");
			precio = precio.replace(",","");
			precio = precio.replace(",","");
			
			var total = $("#totalVenta").text();
			total = total.replace("$","");
			total = total.replace(",","");
			total = total.replace(",","");

			cantidad = cantidad.replace(",","");
			var unidad = $("#precio").next().text();
			precio = parseFloat(precio) * parseFloat(cantidad);
			total = parseFloat(total) + precio;
			var eltr = "<tr class='trVentaNota' id='eltrCPM-"+contarVen+"'><td class='idproductoB clDetalVenta' idproducto='"+idProducto+"'>"+imagen+"  "+producto+"</td><td><b class='clDetalVenta'>"+cantidad+"</b> <small>"+unidad+"</small></td><td class='dineroComp'>"+precioU+"</td><td class='dineroComp clDetalVenta' id='precioTCPM-"+contarVen+"'>"+precio+"</td><td><span class='tooltip-area'>\
					<button id='eliCPM-"+contarVen+"' onclick='eliminarTrVnt($(this).attr(\"id\"))' type='button' class='btn btn-danger btn-danger' data-effect='md-flipHor'><i class='fa fa-trash-o'></i></button></span></td></tr>";
			$(eltr).appendTo($("#tablaVentas"));
			$("#totalVenta").text(total).formatCurrency();
			$("#total").val(total);
			$("#precioTCPM-"+contarVen+"").formatCurrency();
			
			$("#fotoVentaBuscar").attr("href","vistas/images/picture.png");
			$("#fotoProdVen").attr("src","vistas/images/picture.png");
			$("#productoBus").val("");
			$("#precio").val("");
			$("#cantidad").val("");
			$("#pTotal").text("$0.00");
			$(".dineroComp").formatCurrency();
			recorreTrVenta();
			imageGrandCompr();
			$(".preview_fancybox2").fancybox();
			$("#productoBus").focus();
			contarVen = contarVen + 1;
		}else{
			campo = $("#folioVenta");
			var mensaj = "<strong>¡Error! </strong> Completa los campos para continuar.";
			var nclick=campo, data=nclick.data();
			data.verticalEdge=data.vertical || 'right';
			data.horizontalEdge=data.horizontal  || 'top';
			$.notific8(mensaj, data);
			return false;
		}
	}
}

// CHECKBOX DE IVA Y DESCUENTO
function checKiva(){
	//$(".iCheck input").iCheck();
	//////////     ICHECK     //////////
	var i = 0;
		  $('.iCheck').each(function(i) {
				var  data=$(this).data() , 
				 input=$(this).find("input") , 
				 li=$(this).find("li") ,
				 index="cp"+i , 
				 insert_text,
				 iCheckColor = [ "black", "red","green","blue","aero","grey","orange","yellow","pink","purple"],
				 callCheck=data.style || "flat";
			 if(data.color && data.style !=="polaris" && data.style !=="futurico" ){
					hasColor= jQuery.inArray(data.color, iCheckColor);
					if(hasColor !=-1 && hasColor < iCheckColor.length){
						callCheck=callCheck+"-"+data.color;
					}
			}
			input.each(function(i) {
				var self = $(this), label=$(this).next(), label_text=label.html();
				self.attr("id","iCheck-"+index+"-"+i);
				if(data.style=="line"){
					insert_text='<div class="icheck_line-icon"></div><span>'+label_text+'</span>';
					label.remove();
					self.iCheck({ checkboxClass: 'icheckbox_'+callCheck, radioClass: 'iradio_'+callCheck, insert:insert_text  });
				}else{
					label.attr("for","iCheck-"+index+"-"+i);
				}
			});
			if(data.style!=="line"){
				input.iCheck({ checkboxClass: 'icheckbox_'+callCheck, radioClass: 'iradio_'+callCheck });
			}else{
				li.addClass("line");
			}
			i = i + 1;
		  });
		  
}

// OBTENER PORCENTAJE O MONTO DE DESCUENTO
function porcentajeVenta(i){
	var porciento = $("#descuentoPorc").val();
	var dinero = $("#descuentoDine").val();
	dinero = dinero.replace("$","");
	dinero = dinero.replace(",","");
	dinero = dinero.replace(",","");
	porciento = porciento.replace(",","");
	if(dinero > 0 || porciento > 0){
		var precio = 0;
		$(".trVentaNota").each(function(){
			var ide = $(this).attr("id").split("-");
			var preciob = $("#precioTCPM-"+ide[1]+"").text();
			preciob = preciob.replace("$","");
			preciob = preciob.replace(",","");
			preciob = preciob.replace(",","");
			precio = precio + parseFloat(preciob);
		});
		if(i == 1 && porciento > 0){
			var porcientoP = (parseFloat(porciento) * precio) / 100;
			$("#descuentoDine").val(porcientoP).formatCurrency({
				negativeFormat: '-%s%n',
				roundToDecimalPlace: 3,
			});
		}
		if(i == 2){
			var dineroP = (parseFloat(dinero) * 100) / precio;
			$("#descuentoPorc").val(dineroP).formatCurrency({
				negativeFormat: '-%s%n',
				roundToDecimalPlace: 3,
				symbol: "",
			});
		}
		recorreTrVenta(0);
	}
}

// RECORRE TODOS LOS TR DE LA LISTA DE VENTA
function recorreTrVenta(e){
	var precio = iva = dineroDesc = 0;
	$(".trVentaNota").each(function(){
		var ide = $(this).attr("id").split("-");
		var preciob = $("#precioTCPM-"+ide[1]+"").text();
		preciob = preciob.replace("$","");
		preciob = preciob.replace(",","");
		preciob = preciob.replace(",","");
		precio = precio + parseFloat(preciob);
	});
	if($('.iCheck [name=descuentoVen]').is(":checked")){
		$("#divDescuento").removeClass("oculto");
		if(e != 0){
			porcentajeVenta(1);
		}
	}else{
		$("#descuentoPorc").val("");
		$("#descuentoDine").val("");
		$("#divDescuento").addClass("oculto");
	}
	
	var dineroD = $("#descuentoDine").val();
	if(dineroD != ""){
		dineroDesc = dineroD.replace("$","");
		dineroDesc = dineroDesc.replace(",","");
		dineroDesc = dineroDesc.replace(",","");
	}
	if(precio != 0){
		var ivaText = $("#tdIva").text();
		ivaText = ivaText.replace("$","");
		ivaText = ivaText.replace(",","");
		ivaText = ivaText.replace(",","");
		$("#ivaVen").val(0);
		$("#subTotalVenta").text(precio).formatCurrency();
		if($('.iCheck [name=ivaVen]').is(":checked")){
			$("#ivaVen").val(1);
			iva = precio*0.16;
			precio = parseFloat(precio) + parseFloat(iva);
		}
	}
	if(precio == 0){
		$("#subTotalVenta").text(0).formatCurrency();
	}
	precio = parseFloat(precio) - parseFloat(dineroDesc);
	$("#tdDesc").text(dineroDesc).formatCurrency();
	$("#tdIva").text(iva).formatCurrency();
	$("#totalVenta").text(precio).formatCurrency();
	$("#total").val(precio);
	if($(".trVentaNota").length > 4 && $(".trVentaNota").length < 6){
		$("#tablaVentas").parent().parent().css("width","102%");
	}
	if($(".trVentaNota").length < 5 && $(".trVentaNota").length > 3){
		$("#tablaVentas").parent().parent().css("width","100%");
	}
	ajustarAnchoTd();
	cambioVenta();
}

function ajustarAnchoTd(){
	var elwidt = [];
	$("#tablaVentas tr:first td").each(function(){
		elwidt.push( $(this).width() );
	});
	var ccontado = 0;
	$("#thVtab tr:first th").each(function(){
		$(this).width(elwidt[ccontado]);
		ccontado++;
	});
	var ccontado2 = 0;
	$("#tfTablaVentas tr:first td").each(function(){
		$(this).width(elwidt[ccontado2]);
		ccontado2++;
	});
}

// ANTES DE GUARDAR LA VENTA
function notaVenta(id){
	var contador = 0;
	var texto = "";
	$("#"+id+" tr .clDetalVenta").each(function(){
		if(contador == 3){
			contador = 0;
		}
		var texto2 = "";
		var laclase = $(this).attr("class");
		laclase = laclase.split(" ");
		if(laclase[0] == "dineroComp"){
			texto2 = $(this).text().replace("$","");
			texto2 = texto2.replace(",","");
			texto2 = texto2.replace(",","");
		}
		else if(laclase[0] == "idproductoB"){
			texto2 = $(this).attr("idproducto");
		}else{
			texto2 = $(this).text();
		}
		if(texto == ""){
			texto = texto2;
		}else{
			if(contador == 0){
				texto = texto + "#" + texto2;
			}else{
				texto = texto + "~" + texto2;
			}
		}
		contador = contador + 1;
	});
	$("#detalles").val(texto);
	$("#sucursal").prop('disabled',false);
	$("#sucursal").selectpicker("refresh");
	$("#tventa").prop('disabled',false);
	$("#tventa").selectpicker("refresh");
}

// OPERACION PARA DAR EL CAMBIO
function cambioVenta(){
	var valor = $("#importe").val();
	if(valor != ""){
		valor = valor.replace("$","");
		valor = valor.replace(",","");
		valor = valor.replace(",","");
		var totalVenta = $("#totalVenta").text().replace("$","");
		totalVenta = totalVenta.replace(",","");
		totalVenta = totalVenta.replace(",","");
		var total = parseFloat(valor) - parseFloat(totalVenta);
		if(totalVenta == 0){
			total = 0;
			$("#importe").val("");
		}
		$("#cambioVenta").text(total).formatCurrency({negativeFormat: '-%s%n'});
	}
}

function diferenciaInventario(produ){
	var cantidad = 0;
	var contador = 0;
	$(".trVentaNota .clDetalVenta").each(function(){
		if(contador == 3){
			contador = 0;
		}
		var texto2 = "";
		var laclase = $(this).attr("class");
		laclase = laclase.split(" ");
		if(laclase[0] == "idproductoB"){
			texto2 = $(this).attr("idproducto");
		}
		if(texto2 == produ){
			cantidad = cantidad + parseFloat($(this).next().find(".clDetalVenta").text());
		}
		contador = contador + 1;
	});
	return cantidad;
}

function selecTipoVenta(){
	$("#tventa").change(function(){
		var valor = $(this).val();
		alert(valor);
	});
}

//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::		REPORTE COSTOS		:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function BuscarRep(){
	$("#tablaUsuarios_filter input").change(function () {
		var arreglo = new Array();
		$("#imprimirTb .sumar").each(function(){
			var sumaColb = $(this).attr('sumaCol');
			var arr = jQuery.inArray(sumaColb,arreglo);
			if(arr < 0){
				arreglo.push(sumaColb);
			}
		});
		for(var x=0;x<arreglo.length;x++){
			var suma = 0;
			$("#imprimirTb [sumaCol="+arreglo[x]+"]").each(function(){
				var valor = $(this).text();
				valor = valor.replace(',','');
				valor = valor.replace(',','');
				valor = valor.replace('$','');			
				suma = suma + parseFloat(valor);
			});
			$("#imprimirTf [sumaCol='T"+arreglo[x]+"']").text(suma);
		}
		var pagin = $("#nomPagina").val();
		if(pagin == "v_Rcomercializacion"){
			var pactado = $("#trpactado").text();
			var recibido = $("#trrecibido").text();
			var facturado = $("#tfacturaD").text();
			var pagado = $("#tpagadoD").text();
			var recibidob = (parseFloat(recibido) * 100) / parseFloat(pactado);
			var facturadob = (parseFloat(facturado) * 100) / parseFloat(recibido);
			var pagadob = (parseFloat(pagado) * 100) / parseFloat(facturado);
			$("#porcReci").attr("aria-valuetransitiongoal",recibidob);
			$("#porcReci").attr("aria-valuenow",recibidob);
			$("#porcReci").css("width",recibidob);
			$(".porcReci").text(recibidob);
			
			$("#porcFact").attr("aria-valuetransitiongoal",facturadob);
			$("#porcFact").attr("aria-valuenow",facturadob);
			$("#porcFact").css("width",facturadob);
			$(".porcFact").text(facturadob);
			
			$("#porcPagd").attr("aria-valuetransitiongoal",pagadob);
			$("#porcPagd").attr("aria-valuenow",pagadob);
			$("#porcPagd").css("width",pagadob);
			$(".porcPagd").text(pagadob);
		}
		$(".dinero").formatCurrency({
			negativeFormat: '-%s%n',
			roundToDecimalPlace: 3,
		});
		$(".numeroDecimales").formatCurrency({
			negativeFormat: '-%s%n',
			roundToDecimalPlace: 3,
			symbol: "",
		});
	});
}

function filtroEgreso(){
	var filEgreso = $("#filEgreso").val();
	if(filEgreso != ""){
		if(filEgreso == "gasto"){
			$("[tegre=gasto]").removeClass("btn-default");
			$("[tegre=gasto]").addClass("btn-danger");
			$("[tegre=gasto]").addClass("active");
			
			$("[tegre=costo]").removeClass("btn-theme-inverse");
			$("[tegre=costo]").addClass("btn-default");
			$("[tegre=costo]").removeClass("active");
		}else if(filEgreso == ",costo"){				
			$("[tegre=gasto]").removeClass("btn-danger");
			$("[tegre=gasto]").addClass("btn-default");
			$("[tegre=gasto]").removeClass("active");
			
			$("[tegre=costo]").removeClass("btn-default");
			$("[tegre=costo]").addClass("btn-theme-inverse");
			$("[tegre=costo]").addClass("active");
		}
	}
	$(".reegreso").click(function(){
		var id = $(this).children().children().attr("id");
		
		if($(this).hasClass("active")){
			$(this).removeClass("active");
		}else{
			$(this).addClass("active");
		}
		if(id == "rgastos"){
			egreso = "gasto";
			if($(this).hasClass("active")){
				$(this).removeClass("btn-default");
				$(this).addClass("btn-danger");
			}else{				
				$(this).removeClass("btn-danger");
				$(this).addClass("btn-default");
			}
		}
		if(id == "rcostos"){
			egreso = "costo";
			if($(this).hasClass("active")){
				$(this).removeClass("btn-default");
				$(this).addClass("btn-theme-inverse");
			}else{
				$(this).removeClass("btn-theme-inverse");
				$(this).addClass("btn-default");
			}
		}
		
		$(this).button('refresh');
		var fechaMes = {Ene:'01', Feb:'02', Mar:'03', Abr:'04', May:'05', Jun:'06', Jul:'07', Ago:'08', Sep:'09', Oct:'10', Nov:'11', Dic:'12'};
		var fecha = $("#reportrange2 span").text().split(" - ");
		var filtroFecha = "";
		
		if(fecha != ""){
			var fechaI = fecha[0].split(" ");
			var fechaInicialB = new Date(fechaI[2],fechaMes[fechaI[0]],fechaI[1].replace(",",""));
			var fechaInicial = fechaInicialB.getFullYear() + "-" + fechaInicialB.getMonth() + "-" + fechaInicialB.getDate();
			var fechaF = fecha[1].split(" ");
			var fechaFinalB = new Date(fechaF[2],fechaMes[fechaF[0]],fechaF[1].replace(",",""));
			var fechaFinal = fechaFinalB.getFullYear() + "-" + fechaFinalB.getMonth() + "-" + fechaFinalB.getDate();
			filtroFecha = fechaInicial+'#'+fechaFinal;
		}
		var egreso = "";
		if($("[tegre=gasto]").hasClass("active")){egreso = "gasto"}
		if($("[tegre=costo]").hasClass("active")){egreso = egreso+",costo"}
		$("#filEgreso").val(egreso);
		reporteEspecifico($(this),filtroFecha,egreso);
	});
}

// GRAFICAS REPORTE PUTS ::::::::::::::::::::::::::::::
function grReporPuts(modo,fecha,folio,ciclo,subyacente){
// :::::::::::::::::::::::::::::::::::::::::::::: MORRIS CHART ::::::::::::::::::::::::::::::::::
	var pagina = $("#nomPagina").val();
	if(pagina == "v_Rputs" || pagina == "v_Rcalls" || pagina == "v_Rrestantes"){
		var laConsulta = $("#divCambiaGrafica .active").attr("grafica");
		var datos = {"cmo": "consultab","nomPagina":pagina,"tGrafica":laConsulta};
		if(fecha != undefined){datos.filtro=fecha;}
		if(folio != undefined){datos.filtroFolio=folio;}
		if(ciclo != undefined){datos.filtroCiclo=ciclo;}
		if(subyacente != undefined){datos.filtroSubyacente=subyacente;}
		var morris = ("<div id='morrisArea'></div>");
		$("#morrisArea").remove();
		$(morris).appendTo("#divmorrisArea");
		res = consultaAjax(datos);
		var cadena2 = res.split("~");
		var mes = cadena2[0].split("#");
		var anio = cadena2[1].split("#");
		var tota = cadena2[2].split("#");
		var contador2 = totalP = 0;
		var datosc = [];
		var sumContrato = sumLibre = 0;
		while(contador2 < mes.length-1){
			var datosb = {};
			var fecha = mes[contador2]+"-"+anio[contador2];
			feca = Date.parse(""+anio[contador2]+"-"+mes[contador2],"Y-m");
			totalP = totalP + parseFloat(tota[contador2]);
			datosc.push({ y: fecha, a: parseFloat(tota[contador2])});
			contador2 = contador2 + 1;
		}
		switch(modo){
			case "area": 
				new Morris.Area({
					element: 'morrisArea',
					data: datosc,
					xkey: 'y',
					ykeys: ['a'],
					/*ymax: 20000,*/
					parseTime: false,
					labels: ['Total'],
					gridTextColor: "#fff",
					gridLineColor: '#fff',
					lineColors: ['purple']
				});
			break;
			case "lines": 
				new Morris.Line({
					element: 'morrisArea',
					data: datosc,
					xkey: 'y',
					ykeys: ['a'],
					parseTime: false,
					labels: ['Total'],
					gridTextColor: "#fff",
					gridLineColor: '#fff',
					lineColors: ['purple']
				});
			break;
			case "bars": 
				new Morris.Bar({
					element: 'morrisArea',
					data: datosc,
					xkey: 'y',
					ykeys: ['a'],
					parseTime: false,
					labels: ['Total'],
					gridTextColor: "#fff",
					gridLineColor: '#fff',
					barColors: ['purple'],
					barSizeRatio: .8,
				});
			break;
			case "donut": 
				new Morris.Donut({
					element: 'morrisArea',
					data: [
						{label: "Total", value: totalP},
					],
					colors: ['#0090d9']
				});
			break;
		}
	}
}

// CAMBIAR GRAFICAS REPORTE PUTS ::::::::::::::::::::::::::::::
function cambiaGrafiReportePuts(){
	$(".cambiaGrafica").click(function(){
		$(".cambiaGrafica").removeClass("active");
		$(this).addClass("active");
		var tipo = $("#divTipoGrafica .active").attr("tipo");
		var foliop = $("#folioPuts").val();
		var ciclo = $("#cicloSaldosB").val();
		var subyacente = $("#subyacenteSaldosB").val();
		var fechaMes = {Ene:'01', Feb:'02', Mar:'03', Abr:'04', May:'05', Jun:'06', Jul:'07', Ago:'08', Sep:'09', Oct:'10', Nov:'11', Dic:'12'};
		var fecha = $("#reportrangeRec span").text().split(" - ");
		var fechaI = fecha[0].split(" ");
		var fechaInicialB = new Date(fechaI[2],fechaMes[fechaI[0]],fechaI[1].replace(",",""));
		var fechaInicial = fechaInicialB.getFullYear() + "-" + fechaInicialB.getMonth() + "-" + fechaInicialB.getDate();
		var fechaF = fecha[1].split(" ");
		var fg = fechaF[1].replace(",","");
		var fechaFinalB = new Date(fechaF[2],fechaMes[fechaF[0]],fg);
		var fechaFinal = fechaFinalB.getFullYear() + "-" + fechaFinalB.getMonth() + "-" + fechaFinalB.getDate();
		var filtroFecha = fechaInicial+'#'+fechaFinal;
		grReporPuts(tipo,filtroFecha,foliop,ciclo,subyacente);
	});
}

// CAMBIAR TIPO DE GRAFICA REPORTE PUTS ::::::::::::::::::::::::::::::
function cambiaGrafiPuts(){
	$(".cambiaGraf").click(function(){
		$(".cambiaGraf").removeClass("active");
		$(this).addClass("active");
		var tipo = $(this).attr("tipo");
		var foliop = $("#folioPuts").val();
		var ciclo = $("#cicloSaldosB").val();
		var subyacente = $("#subyacenteSaldosB").val();
		var fechaMes = {Ene:'01', Feb:'02', Mar:'03', Abr:'04', May:'05', Jun:'06', Jul:'07', Ago:'08', Sep:'09', Oct:'10', Nov:'11', Dic:'12'};
		var fecha = $("#reportrangeRec span").text().split(" - ");
		var fechaI = fecha[0].split(" ");
		var fechaInicialB = new Date(fechaI[2],fechaMes[fechaI[0]],fechaI[1].replace(",",""));
		var fechaInicial = fechaInicialB.getFullYear() + "-" + fechaInicialB.getMonth() + "-" + fechaInicialB.getDate();
		var fechaF = fecha[1].split(" ");
		var fg = fechaF[1].replace(",","");
		var fechaFinalB = new Date(fechaF[2],fechaMes[fechaF[0]],fg);
		var fechaFinal = fechaFinalB.getFullYear() + "-" + fechaFinalB.getMonth() + "-" + fechaFinalB.getDate();
		var filtroFecha = fechaInicial+'#'+fechaFinal;
		grReporPuts(tipo,filtroFecha,foliop,ciclo,subyacente);
	});
}

function filtroGraficaPuts(){
	$(".selecGraficas").change(function(){
		var foliop = $("#folioPuts").val();
		var ciclo = $("#cicloSaldosB").val();
		var subyacente = $("#subyacenteSaldosB").val();
		var fechaMes = {Ene:'01', Feb:'02', Mar:'03', Abr:'04', May:'05', Jun:'06', Jul:'07', Ago:'08', Sep:'09', Oct:'10', Nov:'11', Dic:'12'};
		var fecha = $("#reportrangeRec span").text().split(" - ");
		var fechaI = fecha[0].split(" ");
		var fechaInicialB = new Date(fechaI[2],fechaMes[fechaI[0]],fechaI[1].replace(",",""));
		var fechaInicial = fechaInicialB.getFullYear() + "-" + fechaInicialB.getMonth() + "-" + fechaInicialB.getDate();
		var fechaF = fecha[1].split(" ");
		var fechaFinalB = new Date(fechaF[2],fechaMes[fechaF[0]],fechaF[1].replace(",",""));
		var fechaFinal = fechaFinalB.getFullYear() + "-" + fechaFinalB.getMonth() + "-" + fechaFinalB.getDate();
		var filtroFecha = fechaInicial+'#'+fechaFinal;
		grReporPuts("area",filtroFecha,foliop,ciclo,subyacente);
	});
}


 /*
 :::::::: CODIGO DE TECLAS	::::::::::::::::
 http://keycode.info/
 if(isNaN($(this).val())){$(this).val(0);}
 ----- CARACTERES ESPECIALES -------
\u00BF   ¿
Carácter	HTML	Unicode
	Á	&Aacute;	\u00C1
	á	&aacute;	\u00E1
	É	&Eacute;	\u00C9
	é	&eacute;	\u00E9
	Í	&Iacute;	\u00CD
	í	&iacute;	\u00ED
	Ó	&Oacute;	\u00D3
	ó	&oacute;	\u00F3
	Ú	&Uacute;	\u00DA
	ú	&uacute;	\u00FA
	Ü	&Uuml;		\u00DC
	ü	&uuml;		\u00FC
	Ṅ	&Ntilde;	\u00D1
	ñ	&ntilde;	\u00F1
*/