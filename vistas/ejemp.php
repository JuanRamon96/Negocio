			
					<!DOCTYPE html>
<html lang="es">
<head></head>
<body>
				<form id="formFoto" enctype="multipart/form-data" action="../index.php" method="post" target="subir_archivos">
						 <input type="hidden" name="nomPagina" id="nomPaginaB" value="v_usuarios">						<!-- MODIFICAR NOMBRE DE PAGINA-->
						 <input type="hidden" name="idR" id="idRB" value="0">
						 <input type="hidden" name="cmo" id="cmoB" value="foto">
						 <input type="hidden" name="nombre" id="nombreB">
						<div class="col-md-6" style="float:right">
							<center>
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 250px; height: 170px;cursor:pointer;border-radius:4px;border:2px solid grey;">
									<img id="fotoUsu" onclick="$('#foto').trigger('click');" data-src="assets/plugins/holder/holder.js/100%x100%/text:Preview" src="vistas/images/picture.png" alt="Tu foto">
									<input type="hidden" id="ligaFoto" name="ligaFoto" value="0">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
								<div>
									<span class="btn btn-default btn-file">
										<span class="fileinput-new">Selecciona una foto</span>
										<span class="fileinput-exists">Cambiar</span>
										<input id="foto" type="file" name="foto" nombre="foto" accept=".jpg, .gif, .png"/>
										<input type="hidden" name="MAX_FILE_SIZE"  VALUE="8380000"/>
									</span>
									<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">
										<i class="fa fa-trash-o"></i> Eliminar
									</a>
								</div>
							</div>
							</center>
						</div>
						<input id="guardaFoto" style="" type="submit" value="irse"/>
						<iframe width="1" height="1" frameborder="0" name="subir_archivos" style="display: none"></iframe>
					</form>
					</body>
					</html>
					