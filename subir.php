<?php 
    require_once "parte_superior.php";
    require_once "config/conexion.php"; 

    $cod_atencion = $_GET['cod_atencion'];
    $sucursal = $_GET['sucursal'];

    if($sucursal == '001' || $sucursal == '002' || $sucursal == '003' || $sucursal == '009') {
        $BD = 'BDV0004';
    } else if($sucursal == '004' || $sucursal == '005') {
        $BD = 'IOLL';
    } else if($sucursal == '006') {
        $BD = 'ETEL';
    } else if($sucursal == '007') {
        $BD = 'CLOFTALMO';
    } else if($sucursal == '008') {
        $BD = 'CLTACNA_TEST';
    }


    function calculaedad($fechanacimiento){
        $nacimiento = new DateTime($fechanacimiento);
        $ahora = new DateTime(date("Y-m-d"));
        $diferencia = $ahora->diff($nacimiento);
        return $diferencia->format("%y");
    }

    //DATOS DEL PACIENTE------------------------------------------------------------------------------------------------
    $sql_paciente = "SELECT PA.APE_PATERNO, PA.APE_MATERNO, PA.NOM_PACIENTE, PA.NUM_HC, PA.FEC_NACIMIENTO, PA.DES_GENERO
                     FROM $BD..ADM_ATENCION A 
                     INNER JOIN $BD..ADM_EXPEDIENTE E ON E.COD_EXPEDIENTE = A.COD_EXPEDIENTE
                     INNER JOIN $BD..ADM_PACIENTE PA ON PA.COD_PACIENTE = E.COD_PACIENTE
                     INNER JOIN $BD..MAE_AUXILIAR MA ON MA.COD_AUXILIAR = PA.COD_AUXILIAR
                     WHERE A.COD_ATENCION = $cod_atencion";
	$res_paciente = sqlsrv_query($conn, $sql_paciente);
	$row_paciente = sqlsrv_fetch_array($res_paciente);

    $NUM_HC = $row_paciente['NUM_HC'];
    $NOM_PACIENTE = $row_paciente['APE_PATERNO'].' '.$row_paciente['APE_MATERNO'].' '.$row_paciente['NOM_PACIENTE'];
    $EDAD = calculaedad($row_paciente['FEC_NACIMIENTO']->format('Y-m-d'));
    if($row_paciente["DES_GENERO"] == "MA"){ $GENERO = "MASCULINO"; } else { $GENERO = "FEMENINO"; }


    //CARGAR DATOS DE LA CONCLUSION-------------------------------------------------------------------------------------
    $detalle_conclusion = "";
    $sql_conclusion = "SELECT * FROM $BD..HCE_INFORME WHERE cod_atencion = $cod_atencion";
    $res_conclusion = sqlsrv_query($conn, $sql_conclusion);
    $row_conclusion = sqlsrv_fetch_array($res_conclusion);
    $detalle_conclusion = $row_conclusion['conclusiones'];

?>

<!-- AQUI EMPIEZA EL CUERPO -->
<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">INFORME - SALUD OCUPACIONAL</h4>
                <hr>

                <div class="row p-10 col-md-12 text-center">
                    <form method="POST" action="ajax/Medico/cargar_archivos.php" enctype="multipart/form-data">
                        <label class="form-control">
                            <input required="" type="file" name="file" id="exampleInputFile">
                            <input required="" type="hidden" name="cod_atencion" id="cod_atencion" value="<?=$cod_atencion?>">
                        </label>
                        <button class="btn waves-effect waves-light btn-danger" type="submit"> <i class="fas fa-upload"></i> Cargar Fichero</button>
                    </form> 
                </div>

                <form method="POST" id="guardar_informe" name="guardar_informe">
                    <div class="col-md-12 text-center"> 
                        <div class="panel panel-primary">
                            <div class="panel-heading"></div>       
                   
                            <div class="panel-body">    
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="7%">#</th>
                                            <th width="70%">Nombre del Archivo</th>
                                            <th width="13%">Descargar</th>
                                            <th width="10%">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php              
                                            $ruta = "subidas/".$cod_atencion."/";
                                            if (!file_exists($ruta)) {
                                                $archivos = 0;
                                            } else {
                                                $archivos = scandir($ruta);
                                            }              
                                            $num = 0;

                                            if (!empty($archivos)) {              
                                                for ($i=2; $i<count($archivos); $i++) {
                                                    $num++;
                                        ?>

                                        <p></p>
                    
                                        <tr>
                                            <th scope="row"><?=$num?></th>
                                            <td><?=$archivos[$i]?></td>
                                            <td>
                                                <a title="Descargar Archivo" href="subidas/<?=$cod_atencion.'/'.$archivos[$i]?>" download="<?=$archivos[$i]?>">
                                                    <span class="btn-label"><i class="fas fa-download"></i></span>
                                                </a>
                                            </td>
                                            <td>
                                                <a title="Eliminar Archivo" href="ajax/Medico/eliminar_archivo.php?name=../../subidas/<?=$cod_atencion.'/'.$archivos[$i]?>" onclick="return confirm('Esta seguro de eliminar el archivo?');"> 
                                                    <span class="btn-label"><i class="fas fa-trash"></i></span>
                                                </a>
                                            </td>
                                        </tr>

                                        <?php   }
                                            }
                                        ?> 
            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>            

                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label for="message-text" class="control-label">Conclusiones</label>
                            <textarea rows="5" class="form-control" id="conclusiones" name="conclusiones"><?=$detalle_conclusion?></textarea>
                            <input type="hidden" id="cod_atencion" name="cod_atencion" value="<?=$cod_atencion?>">
                            <input type="hidden" id="sucursal" name="sucursal" value="<?=$sucursal?>">
                        </div>
                    </div>

                    <hr>

                    <div class="col-md-12 text-right">
                        <button type="submit" id="guardar_datosinforme" class="btn waves-effect waves-light btn-bloc btn-success "><i class="mdi mdi-content-save"></i> GUARDAR</button>
                        <div id="resultados_ajax"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-3">                                
        <div class="card">
            <div class="card-body">     
                <h4 class="card-title">DATOS DEL PACIENTE</h4>
                <hr>

                <div class="row">          
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">N° HC</label>
                            <input readonly type="text" id="numero_hc" class="form-control" value="<?=$NUM_HC?>"> 
                        </div>
                    </div>

                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label class="control-label">Apellidos y nombres</label>
                            <input readonly type="text" id="apellidos_nombres" class="form-control" value="<?=$NOM_PACIENTE?>">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Edad</label>
                            <input readonly type="text" id="edad" class="form-control" value="<?=$EDAD?>">
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">   
                            <label class="control-label">Sexo</label>
                            <input readonly type="text" id="edad" class="form-control" value="<?=$GENERO?>">
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

<?php require_once "parte_inferior.php"; ?>
<script type="text/javascript" src="js/subir_informe.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>