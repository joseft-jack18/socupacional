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

    $sql = "SELECT P.NUM_HC, CONCAT(P.APE_PATERNO,' ',P.APE_MATERNO,' ',P.NOM_PACIENTE) AS PACIENTE, 
            DATEDIFF(YEAR,P.FEC_NACIMIENTO,GETDATE()) AS EDAD, P.DES_GENERO, SL.GRUPO_SANGUINEO, 
            SL.FACTOR_RH, SL.HEMOGLOBINA, SL.HEMATOCRITO, SL.GLUCOSA, SL.COLESTEROL_TOTAL, SL.TRIGLICERIDOS, 
            SL.ORINA, SL.RIESGO_CORONARIO
            FROM $BD..ADM_ATENCION A
            INNER JOIN $BD..SO_RESULTADO_LABORATORIO SL ON SL.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..HCE_CONSULTA_EXTERNA H ON H.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..ADM_PACIENTE P ON P.COD_PACIENTE = H.COD_PACIENTE
            WHERE A.COD_ATENCION = $cod_atencion";
    $res = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($res);

    $NUM_HC = $row['NUM_HC'];
    $PACIENTE = strtoupper($row['PACIENTE']);
    $EDAD = $row['EDAD'];
    if($row['DES_GENERO'] == "MA"){ $DES_GENERO = "MASCULINO"; } else { $DES_GENERO = "FEMENINO"; }
    $GRUPO_SANGUINEO = $row['GRUPO_SANGUINEO'];
    $FACTOR_RH = $row['FACTOR_RH'];
    $HEMOGLOBINA = $row['HEMOGLOBINA'];
    $HEMATOCRITO = $row['HEMATOCRITO'];
    $GLUCOSA = $row['GLUCOSA'];
    $COLESTEROL_TOTAL = $row['COLESTEROL_TOTAL'];
    $TRIGLICERIDOS = $row['TRIGLICERIDOS'];
    $ORINA = $row['ORINA'];
    $RIESGO_CORONARIO = $row['RIESGO_CORONARIO'];
    
?>

<!-- AQUI EMPIEZA EL CUERPO -->
<div class="row">                  
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">RESULTADO DE ANALISIS</h4>        

                <form method="post" id="guardar_datos_registro_laboratorio" name="guardar_datos_evaluacion_audiometrica">
                    <input type="hidden" id="cod_atencion" name="cod_atencion" class="form-control" value="<?=$cod_atencion?>">
                    <input type="hidden" id="sucursal" name="sucursal" class="form-control" value="<?=$sucursal?>">

                    <div class="row p-20">
                        <div class="col-md-12">
                            <label class="control-label"><h5><strong>GRUPO Y FACTOR RH</strong></h5></label>
                        </div> 
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Grupo Sanguíneo <span class="text-danger">*</span></label>
                                <input type="text" id="grupo_sanguineo" name="grupo_sanguineo" class="form-control" value="<?=$GRUPO_SANGUINEO?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Factor RH <span class="text-danger">*</span></label>
                                <input type="text" id="factor_rh" name="factor_rh" class="form-control" value="<?=$FACTOR_RH?>" required>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row p-20">
                        <div class="col-md-4">
                            <label class="control-label"><h5><strong>HEMOGRAMA COMPLETO</strong></h5></label>
                            <div class="form-group">
                                <label class="control-label">Hemoglobina <span class="text-danger">*</span></label>
                                <input type="text" id="hemoglobina" name="hemoglobina" class="form-control" value="<?=$HEMOGLOBINA?>" required>
                            </div>
                        </div> 

                        <div class="col-md-4">
                            <label class="control-label"><h5><strong>HEMATOCRITO</strong></h5></label>
                            <div class="form-group">
                                <label class="control-label">Hematocrito <span class="text-danger">*</span></label>
                                <input type="text" id="hematocrito" name="hematocrito" class="form-control" value="<?=$HEMATOCRITO?>" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label"><h5><strong>GLUCOSA</strong></h5></label>
                            <div class="form-group">
                                <label class="control-label">Glucosa <span class="text-danger">*</span></label>
                                <input type="text" id="glucosa" name="glucosa" class="form-control" value="<?=$GLUCOSA?>" required>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row p-20">
                        <div class="col-md-12">
                            <label class="control-label"><h5><strong>PERFIL LIPÍDICO</strong></h5></label>
                        </div> 

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Colesterol <span class="text-danger">*</span></label>
                                <input type="text" id="colesterol_total" name="colesterol_total" class="form-control" value="<?=$COLESTEROL_TOTAL?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Trigliceridos <span class="text-danger">*</span></label>
                                <input type="text" id="trigliceridos" name="trigliceridos" class="form-control" value="<?=$TRIGLICERIDOS?>" required>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row p-20">
                        <div class="col-md-12">
                            <label class="control-label"><h5><strong>EXAMEN COMPLETO DE ORINA</strong></h5></label>
                        </div> 

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Orina Completa <span class="text-danger">*</span></label>
                                <input type="text" id="orina" name="orina" class="form-control" value="<?=$ORINA?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Riesgo Coronario <span class="text-danger">*</span></label>
                                <input type="text" id="riesgo_coronario" name="riesgo_coronario" class="form-control" value="<?=$RIESGO_CORONARIO?>" required>
                            </div>
                        </div>                            
                    </div>

                    <hr>

                    <div class="col-md-12 text-right">                              
                        <button type="submit" id="guardar_registro_laboratorio" class="btn waves-effect waves-light btn-bloc btn-success "><i class="mdi mdi-content-save"></i> GUARDAR</button>
                        <div id="resultados_ajax"></div>
                    </div>
                </form>
            </div>
        </div>  
    </div>

    <!-- CARD LATERAL -->
    <div class="col-md-3">                    
        <div class="card">
            <div class="card-body">     
                <h4 class="card-title">DATOS DEL PACIENTE</h4>
                <hr>

                <div class="row">
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label class="control-label">Nro Documento</label>
                            <input type="text" id="nom_paciente" class="form-control" value="<?=$NUM_HC?>" readonly>
                        </div>
                    </div>

                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label class="control-label">Apellidos y nombres</label>
                            <input type="text" id="nom_paciente" class="form-control" value="<?=$PACIENTE?>" readonly>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Edad</label>
                            <input type="text" id="edad_paciente" class="form-control" value="<?=$EDAD?>" readonly>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">   
                            <label class="control-label">Sexo</label>
                            <input type="text" id="sexo_paciente" class="form-control" value="<?=$DES_GENERO?>" readonly>
                        </div>
                    </div>              
                </div>
            </div>
        </div>   
    </div>
</div>
<!-- AQUI TERMINA EL CUERPO -->

<?php require_once "parte_inferior.php"; ?>
<script type="text/javascript" src="js/vista_medico.js"></script>