<?php
    class listaventas {
        public function _reporte(){
            $omodelo = new m_modelo();
            extract($_POST);
            $query = ("SELECT * FROM ventas v INNER JOIN clientes c ON c.id_cliente = v.cliente;");
            $row = $omodelo->_consultar($query);
            $numerofilas = $omodelo->numerofilas;
            if ($row == "si") {
                echo "<p class='dialogo'>Error de consulta</p>";
            }else{
                
                $lista1 = '
                            <div class="col-md-12 table-responsive" style="overflow-x:auto;">
                            <table style="width:100%; color:black; font-size:11px" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover" id="tablaUsuarios">
                                <thead id="imprimirTh">
                                    <tr class="expandible">
                                        <th id="thprimero" style="border-radius: 5px 0 0;">Cliente</th>
                                        <th>Empresa</th>
                                        <th>Direccion</th>
                                        <th>Telef&oacute;no</th>
                                        <th>Correo</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Descuento</th>
                                        <th style="border-radius: 0 5px 0 0;">Acci&oacute;n</th>
                                    </tr>
                                </thead>
                                <tbody id="imprimirTb" align="center">'; 
                $provee = "";
                $verMas = "";
                //$row = $omodelo->_consultar($query);
                for($i=0;$i<$numerofilas;$i++){
                    /*$provee = '
                        <div class="popTabla" id="divPov-'.$row[$i]["id_cliente"].$i.'">
                        <div id="provT-'.$row[$i]["id_cliente"].$i.'" class="table-responsive tablaProv" style="border-radius:20px">
                            <div class="modal-header bg-inverse bd-inverse-darken" style="border-radius: 18px 18px 0 0;">
                                <h6 class="modal-title">Contacto: <strong>'.$row[$i]["nombre"].'</strong></h6>
                            </div>
                            <div style="background: aliceblue;border-radius: 0 0 18px 18px;padding: 10px;" class="panel-body">
                                <table style="font-size:11px" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover">
                                    <tr>
                                        <td style="color: #898989;"><strong>Empresa</strong></td>
                                        <td>'.$row[$i]["empresa"].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #898989;"><strong>RFC</strong></td>
                                        <td>'.$row[$i]["rfc"].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #898989;"><strong>Banco</strong></td>
                                        <td>'.$row[$i]["banco"].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #898989;"><strong>No. de cuenta</strong></td>
                                        <td>'.$row[$i]["no_cuenta"].'</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        ';*/
                   
                    $direccion = '<span>Ciudad:</span>    &nbsp; <strong>'.$row[$i]["ciudad"].'</strong><br>
                                 <span>C.P.:</span>       &nbsp; <strong>'.$row[$i]["codigo_postal"].'</strong><br>
                                 <span>Colonia:</span>    &nbsp; <strong>'.$row[$i]["colonia"].'</strong><br>
                                  <span>Direcci&oacute;n:</span>  &nbsp; <strong>'.$row[$i]["direccion"].'</strong><br>
                    ';
                    $telefonos = 'Telef&oacute;no:  &nbsp; <strong>'.$row[$i]["telefono"].'</strong><br>
                                  Celular:   &nbsp; <strong>'.$row[$i]["celular"].'</strong><br>
                    ';
                    //$verMas = $provee.'<label style="font-size: 10px;padding: 2px;" id="popTabla-'.$row[$i]["id_cliente"].$i.'" class="btn btn-theme-inverse"><i class="fa fa-eye"></i> Ver mas</label></div>';
                    $lista2 .= '										
                                    <tr>
                                        <td class="">'. $row[$i]["nombre"] .'</td>
                                        <td class="">'. $row[$i]["empresa"] .'</td>
                                        <td class="" style="text-align:left;width:220px">'.$direccion.'</td>
                                        <td class="" style="text-align:left">'.$telefonos.'</td>
                                        <td class="">'.$row[$i]["correo"].'</td>
                                        <td class="">'.date("d-m-Y",strtotime($row[$i]["fecha"])).'</td>
                                        <td class="">'.$row[$i]["total"].'</td>
                                        <td class="decimal">'.$row[$i]["descuento"].'</td>
                                        <td style="width: 100px;">
                                            <span class="tooltip-area">
                                                <button id="mod-'.$row[$i]["id_cliente"].'" type="button" class="btn btn-theme-inverse btn-info ventaModificar" data-effect="md-flipHor" data-target="0"><i class="fa fa-pencil-square-o"></i></button>
                                                <button id="eli-'.$row[$i]["id_cliente"].'" type="button" class="btn btn-danger btn-danger ventaEliminar" data-effect="md-flipHor" data-target="0"><i class="fa fa-trash-o"></i></button>
                                            </span>
                                        </td>
                                    </tr>';
                }			
            }
            $lista3 = '</tbody>
                            </table>
                            </div>';
            $lista = $lista1.$lista2.$lista3;
            return $lista;
            //return utf8_encode($lista);
            //<td>'.$permisosBD.'</td>
        }		
                
    }
?>