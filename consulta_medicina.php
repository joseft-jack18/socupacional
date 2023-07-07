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
    
?>

<!-- AQUI EMPIEZA EL CUERPO -->
<div class="row">                  
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">HISTORIA CLÍNICA MÉDICA OCUPACIONAL</h4>

                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#musculo" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">FICHA MÚSCULO ESQUELÉTICA</span>
                        </a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#ficha" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">FICHA MEDICA OCUPACIONAL</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#altura" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">TRABAJO ALTURA</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#altitud" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">ALTITUD 2500 M.S.N.M.</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#sintomatico" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">SINTOMATICO RESPIRATORIO</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#personales" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">ANTECEDENTES PERSONALES</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#familiares" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">ANTECEDENTES FAMILIARES</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#evaluacion" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">EVALUACIÓN MÉDICA</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#conclusiones" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">CONCLUSIONES</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#diagnostico" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">DIAGNÓSTICO</span>
                        </a>
                    </li>
                </ul>

                <form method="post" id="guardar_datos_examen_medicina_general" name="guardar_datos_examen_medicina_general">
                    <input type="hidden" id="cod_atencion" name="cod_atencion" class="form-control" value="<?=$cod_atencion?>">
                    <input type="hidden" id="cod_paciente" name="cod_paciente" class="form-control" value="<?=$COD_PACIENTE?>">
                    <input type="hidden" id="sucursal" name="sucursal" class="form-control" value="<?=$sucursal?>">

                    <!--EMPIEZA EL TAB-->
                    
                    <!--TERMINA EL TAB-->
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