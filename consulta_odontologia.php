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
            DATEDIFF(YEAR,P.FEC_NACIMIENTO,GETDATE()) AS EDAD, P.DES_GENERO, SL.PIEZAS_MAL_ESTADO,
            SL.PIEZAS_FALTANTES
            FROM $BD..ADM_ATENCION A
            INNER JOIN $BD..SO_RESULTADO_ODONTOLOGIA SL ON SL.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..HCE_CONSULTA_EXTERNA H ON H.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..ADM_PACIENTE P ON P.COD_PACIENTE = H.COD_PACIENTE
            WHERE A.COD_ATENCION = $cod_atencion";
    $res = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($res);

    $NUM_HC = $row['NUM_HC'];
    $PACIENTE = strtoupper($row['PACIENTE']);
    $EDAD = $row['EDAD'];
    if($row['DES_GENERO'] == "MA"){ $DES_GENERO = "MASCULINO"; } else { $DES_GENERO = "FEMENINO"; }

    $PIEZAS_MAL_ESTADO = strtoupper($row['PIEZAS_MAL_ESTADO']);
    $PIEZAS_FALTANTES = strtoupper($row['PIEZAS_FALTANTES']);
    
?>

<!-- AQUI EMPIEZA EL CUERPO -->
<div class="row">                  
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">REVISION ODONTOLÓGICA</h4>        

                <form method="post" id="guardar_datos_evaluacion_odontologia" name="guardar_datos_evaluacion_odontologia">
                    <input type="hidden" id="cod_atencion" name="cod_atencion" class="form-control" value="<?=$cod_atencion?>">
                    <input type="hidden" id="sucursal" name="sucursal" class="form-control" value="<?=$sucursal?>">

                    <div class="row p-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">PIEZAS EN MAL ESTADO <span class="text-danger">*</span></label>
                                <input type="text" id="PIEZAS_MAL_ESTADO" name="PIEZAS_MAL_ESTADO" class="form-control" value="<?=$PIEZAS_MAL_ESTADO?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">PIEZAS QUE FALTAN <span class="text-danger">*</span></label>
                                <input type="text" id="PIEZAS_FALTANTES" name="PIEZAS_FALTANTES" class="form-control" value="<?=$PIEZAS_FALTANTES?>" required>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="col-md-12 text-right">                              
                        <button type="submit" id="guardar_registro_odontologia" class="btn waves-effect waves-light btn-bloc btn-success"><i class="mdi mdi-content-save"></i> GUARDAR</button>
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