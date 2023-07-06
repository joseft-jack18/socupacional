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
            DATEDIFF(YEAR,P.FEC_NACIMIENTO,GETDATE()) AS EDAD, P.DES_GENERO, SL.PULMONES, SL.DESCRIPCION,
            SL.FVC, SL.FEV1, SL.FEV1_FVC, SL.FEF, SL.CONCLUSION
            FROM $BD..ADM_ATENCION A
            INNER JOIN $BD..SO_RESULTADO_NEUMOLOGIA SL ON SL.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..HCE_CONSULTA_EXTERNA H ON H.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..ADM_PACIENTE P ON P.COD_PACIENTE = H.COD_PACIENTE
            WHERE A.COD_ATENCION = $cod_atencion";
    $res = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($res);

    $NUM_HC = $row['NUM_HC'];
    $PACIENTE = strtoupper($row['PACIENTE']);
    $EDAD = $row['EDAD'];
    if($row['DES_GENERO'] == "MA"){ $DES_GENERO = "MASCULINO"; } else { $DES_GENERO = "FEMENINO"; }

    $PULMONES = $row['PULMONES'];
    $DESCRIPCION = strtoupper($row['DESCRIPCION']);
    $FVC = $row['FVC'];
    $FEV1 = $row['FEV1'];
    $FEV1_FVC = $row['FEV1_FVC'];
    $FEF = $row['FEF'];
    $CONCLUSION = $row['CONCLUSION'];
    
?>

<!-- AQUI EMPIEZA EL CUERPO -->
<div class="row">                  
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">FUNCION RESPIRATORIA</h4>        

                <form method="post" id="guardar_datos_evaluacion_neumologia" name="guardar_datos_evaluacion_neumologia">
                    <input type="hidden" id="cod_atencion" name="cod_atencion" class="form-control" value="<?=$cod_atencion?>">
                    <input type="hidden" id="sucursal" name="sucursal" class="form-control" value="<?=$sucursal?>">

                    <div class="row p-20">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">PULMONES <span class="text-danger">*</span></label>
                                <select class="custom-select form-control" name="PULMONES" id="PULMONES">
                                    <option value="1" <?php if($PULMONES != 2){ echo "selected"; } ?>>Normal</option>
                                    <option value="2" <?php if($PULMONES == 2){ echo "selected"; } ?>>Anormal</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">DESCRIPCION <span class="text-danger"></span></label>
                                <textarea class="form-control" id="DESCRIPCION" name="DESCRIPCION" rows="3"><?=$DESCRIPCION?></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">FVC <span class="text-danger">*</span></label>
                                <input type="text" id="FVC" name="FVC" class="form-control" value="<?=$FVC?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">FEV1 <span class="text-danger">*</span></label>
                                <input type="text" id="FEV1" name="FEV1" class="form-control" value="<?=$FEV1?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">FEV1/FVC <span class="text-danger">*</span></label>
                                <input type="text" id="FEV1_FVC" name="FEV1_FVC" class="form-control" value="<?=$FEV1_FVC?>" required readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">FEF <span class="text-danger">*</span></label>
                                <input type="text" id="FEF" name="FEF" class="form-control" value="<?=$FEF?>" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">CONCLUSIONES <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="CONCLUSION" name="CONCLUSION" rows="3" required><?=$CONCLUSION?></textarea>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="col-md-12 text-right">                              
                        <button type="submit" id="guardar_registro_neumologia" class="btn waves-effect waves-light btn-bloc btn-success"><i class="mdi mdi-content-save"></i> GUARDAR</button>
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