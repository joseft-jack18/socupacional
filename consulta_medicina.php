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
                    <div class="tab-content tabcontent-border text-left">
                        <!-- FICHA MUSCULO ESQUELETICA -->
                        <div class="tab-pane p-20 active" id="musculo" role="tabpanel">
                            <h4 class="text-center">FICHA MÚSCULO ESQUELÉTICA</h4>
                            <div class="row p-20">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>APTITUD DE ESPALDA</th>
                                                    <th>EXCELENTE: 1</th>
                                                    <th>BUENO: 2</th>
                                                    <th>REGULAR: 3</th>
                                                    <th>MALO: 4</th>
                                                </tr>
                                            </thead>                                        
                                            <tbody>
                                                <tr>
                                                    <td>Flexibilidad / Fuerza ABDOMEN</td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abdomen" id="abdomen1" value = "1">
                                                                <label class="custom-control-label" for="abdomen1"> <img src="images/vista_musculo1.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input  required type="radio" class="custom-control-input" name="abdomen" id="abdomen2" value = "2">
                                                                <label class="custom-control-label" for="abdomen2"> <img src="images/vista_musculo1.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abdomen" id="abdomen3" value = "3">
                                                                <label class="custom-control-label" for="abdomen3"> <img src="images/vista_musculo1.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abdomen" id="abdomen4" value = "4">
                                                                <label class="custom-control-label" for="abdomen4"> <img src="images/vista_musculo1.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>CADERA</td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="cadera" id="cadera1" value = "1">
                                                                <label class="custom-control-label" for="cadera1"> <img src="images/vista_musculo2.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="cadera" id="cadera2" value = "2">
                                                                <label class="custom-control-label" for="cadera2"> <img src="images/vista_musculo2.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="cadera" id="cadera3" value = "3">
                                                                <label class="custom-control-label" for="cadera3"> <img src="images/vista_musculo2.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="cadera" id="cadera4" value = "4">
                                                                <label class="custom-control-label" for="cadera4"> <img src="images/vista_musculo2.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>MUSLO</td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="muslo" id="muslo1" value = "1">
                                                                <label class="custom-control-label" for="muslo1"> <img src="images/vista_musculo3.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="muslo" id="muslo2" value = "2">
                                                                <label class="custom-control-label" for="muslo2"> <img src="images/vista_musculo3.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="muslo" id="muslo3" value = "3">
                                                                <label class="custom-control-label" for="muslo3"> <img src="images/vista_musculo3.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="muslo" id="muslo4" value = "4">
                                                                <label class="custom-control-label" for="muslo4"> <img src="images/vista_musculo3.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                </tr>         
                                                <tr>
                                                    <td>ABDOMEN LATERAL</td>
                                                    <td>
                                                        <div class="form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abdomenla" id="abdomenla1" value = "1">
                                                                <label class="custom-control-label" for="abdomenla1"> <img src="images/vista_musculo4.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abdomenla" id="abdomenla2" value = "2">
                                                                <label class="custom-control-label" for="abdomenla2"> <img src="images/vista_musculo4.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abdomenla" id="abdomenla3" value = "3">
                                                                <label class="custom-control-label" for="abdomenla3"> <img src="images/vista_musculo4.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abdomenla" id="abdomenla4" value = "4">
                                                                <label class="custom-control-label" for="abdomenla4"> <img src="images/vista_musculo4.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                </tr>  
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class = "form-group text-left">
                                        <label class="control-label">OBSERVACIONES</label>
                                        <textarea  class="form-control" id="observaciones_aptitud" name="observaciones_aptitud" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- SEGUNDO CUADRO-->
                            <div class="row p-20">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>RANGOS PARTICULARES</th>
                                                    <th>ÓPTIMO: 1</th>
                                                    <th>LIMITADO: 2</th>
                                                    <th>MUY LIMITADO: 3</th>
                                                    <th>DOLOR CON RESISTENCIA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Abducción de hombro (Normal 0° - 180°)</td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abduccion180" id="abduccion180_1" value = "1">
                                                                <label class="custom-control-label" for="abduccion180_1"> <img src="images/vista_musculo5.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abduccion180" id="abduccion180_2" value = "2">
                                                                <label class="custom-control-label" for="abduccion180_2"> <img src="images/vista_musculo6.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abduccion180" id="abduccion180_3" value = "3">
                                                                <label class="custom-control-label" for="abduccion180_3"> <img src="images/vista_musculo7.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox col-md-12">
                                                            <input  type="checkbox" class="custom-control-input" name="abduccion180_dolor" id="abduccion180_dolor" value="1">
                                                            <label class="custom-control-label" for="abduccion180_dolor">SI</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Adducción de hombro (Normal 0° - 80°)</td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abduccion80" id="abduccion80_1" value = "1">
                                                                <label class="custom-control-label" for="abduccion80_1"> <img src="images/vista_musculo8.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abduccion80" id="abduccion80_2" value = "2">
                                                                <label class="custom-control-label" for="abduccion80_2"> <img src="images/vista_musculo9.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abduccion80" id="abduccion80_3" value = "3">
                                                                <label class="custom-control-label" for="abduccion80_3"> <img src="images/vista_musculo10.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox col-md-12">
                                                            <input  type="checkbox" class="custom-control-input" name="abduccion80_dolor" id="abduccion80_dolor" value="1">
                                                            <label class="custom-control-label" for="abduccion80_dolor">SI</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Rotación externa (Normal 0° - 90°)</td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abduccion90" id="abduccion90_1" value = "1">
                                                                <label class="custom-control-label" for="abduccion90_1"> <img src="images/vista_musculo11.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abduccion90" id="abduccion90_2" value = "2">
                                                                <label class="custom-control-label" for="abduccion90_2"> <img src="images/vista_musculo12.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abduccion90" id="abduccion90_3" value = "3">
                                                                <label class="custom-control-label" for="abduccion90_3"> <img src="images/vista_musculo13.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox col-md-12">
                                                            <input  type="checkbox" class="custom-control-input" name="abduccion90_dolor" id="abduccion90_dolor" value="1">
                                                            <label class="custom-control-label" for="abduccion90_dolor">SI</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Rotación externa de hombro interna</td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="rotacion_interna" id="rotacion_interna_1" value = "1">
                                                                <label class="custom-control-label" for="rotacion_interna_1"> <img src="images/vista_musculo14.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="rotacion_interna" id="rotacion_interna_2" value = "2">
                                                                <label class="custom-control-label" for="rotacion_interna_2"> <img src="images/vista_musculo15.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="rotacion_interna" id="rotacion_interna_3" value = "3">
                                                                <label class="custom-control-label" for="rotacion_interna_3"> <img src="images/vista_musculo16.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox col-md-12">
                                                            <input  type="checkbox" class="custom-control-input" name="rotacion_interna_dolor" id="rotacion_interna_dolor" value="1">
                                                            <label class="custom-control-label" for="rotacion_interna_dolor">SI</label>
                                                        </div>
                                                    </td>
                                                </tr> 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class = "form-group text-left">
                                        <label class="control-label">OBSERVACIONES</label>
                                        <textarea class="form-control" id="observaciones_rangos" name="observaciones_rangos" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- FICHA MEDICA OCUPACIONAL - ANEXO 16 -->
                        <div class="tab-pane p-20" id="ficha" role="tabpanel">
                            <h4 class="text-center">FICHA MÉDICA OCUPACIONAL</h4>
                            <div class="row p-20">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>RANGOS PARTICULARES</th>
                                                    <th>ÓPTIMO: 1</th>
                                                    <th>LIMITADO: 2</th>
                                                    <th>MUY LIMITADO: 3</th>
                                                    <th>DOLOR CON RESISTENCIA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Abducción de hombro (Normal 0° - 180°)</td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abduccion180" id="abduccion180_1" value = "1">
                                                                <label class="custom-control-label" for="abduccion180_1"> <img src="images/vista_musculo5.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abduccion180" id="abduccion180_2" value = "2">
                                                                <label class="custom-control-label" for="abduccion180_2"> <img src="images/vista_musculo6.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abduccion180" id="abduccion180_3" value = "3">
                                                                <label class="custom-control-label" for="abduccion180_3"> <img src="images/vista_musculo7.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox col-md-12">
                                                            <input  type="checkbox" class="custom-control-input" name="abduccion180_dolor" id="abduccion180_dolor" value="1">
                                                            <label class="custom-control-label" for="abduccion180_dolor">SI</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Adducción de hombro (Normal 0° - 80°)</td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abduccion80" id="abduccion80_1" value = "1">
                                                                <label class="custom-control-label" for="abduccion80_1"> <img src="images/vista_musculo8.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abduccion80" id="abduccion80_2" value = "2">
                                                                <label class="custom-control-label" for="abduccion80_2"> <img src="images/vista_musculo9.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abduccion80" id="abduccion80_3" value = "3">
                                                                <label class="custom-control-label" for="abduccion80_3"> <img src="images/vista_musculo10.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox col-md-12">
                                                            <input  type="checkbox" class="custom-control-input" name="abduccion80_dolor" id="abduccion80_dolor" value="1">
                                                            <label class="custom-control-label" for="abduccion80_dolor">SI</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Rotación externa (Normal 0° - 90°)</td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abduccion90" id="abduccion90_1" value = "1">
                                                                <label class="custom-control-label" for="abduccion90_1"> <img src="images/vista_musculo11.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abduccion90" id="abduccion90_2" value = "2">
                                                                <label class="custom-control-label" for="abduccion90_2"> <img src="images/vista_musculo12.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="abduccion90" id="abduccion90_3" value = "3">
                                                                <label class="custom-control-label" for="abduccion90_3"> <img src="images/vista_musculo13.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox col-md-12">
                                                            <input  type="checkbox" class="custom-control-input" name="abduccion90_dolor" id="abduccion90_dolor" value="1">
                                                            <label class="custom-control-label" for="abduccion90_dolor">SI</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Rotación externa de hombro interna</td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="rotacion_interna" id="rotacion_interna_1" value = "1">
                                                                <label class="custom-control-label" for="rotacion_interna_1"> <img src="images/vista_musculo14.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="rotacion_interna" id="rotacion_interna_2" value = "2">
                                                                <label class="custom-control-label" for="rotacion_interna_2"> <img src="images/vista_musculo15.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class = "form-group text-left">
                                                            <label class="control-label">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="rotacion_interna" id="rotacion_interna_3" value = "3">
                                                                <label class="custom-control-label" for="rotacion_interna_3"> <img src="images/vista_musculo16.png"></i></label></label>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox col-md-12">
                                                            <input  type="checkbox" class="custom-control-input" name="rotacion_interna_dolor" id="rotacion_interna_dolor" value="1">
                                                            <label class="custom-control-label" for="rotacion_interna_dolor">SI</label>
                                                        </div>
                                                    </td>
                                                </tr> 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class = "form-group text-left">
                                        <label class="control-label">OBSERVACIONES</label>
                                        <textarea class="form-control" id="observaciones_rangos" name="observaciones_rangos" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- TRABAJO EN ALTURA - ANEXO 2A -->
                        <div class="tab-pane" id="altura" role="tabpanel">                                
                            <div class="row p-20">
                                <div class="col-md-12">
                                    <div class = "form-group text-center">
                                        <label class="control-label"><h4 class="card-title text-center">EXAMEN PARA TRABAJOS SOBRE ALTURA ESTRUCTURAL MAYOR A 1.8 METROS<br>(Según D.S 055-2010-EM. Art. 125)</h4></label>
                                    </div>
                                </div>
            
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ANTECEDENTES</th>
                                                <th>SI</th>
                                                <th>NO</th>
                                                <th>ANTECEDENTES</th>
                                                <th>SI</th>
                                                <th>NO</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                            <tr>
                                                <td>AGORAFOBIA</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="agorafobia" id="agorafobia_si" value = "1">                 
                                                        <label class="custom-control-label" for="agorafobia_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input  required type="radio" class="custom-control-input" name="agorafobia" id="agorafobia_no" value = "0">
                                                        <label class="custom-control-label" for="agorafobia_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td>DIABETES NO CONTROLADA</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="diabetes_no_controlada" id="diabetes_no_controlada_si" value = "1">
                                                        <label class="custom-control-label" for="diabetes_no_controlada_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="diabetes_no_controlada" id="diabetes_no_controlada_no" value = "0">
                                                        <label class="custom-control-label" for="diabetes_no_controlada_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ACROFOBIA</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="acrofobia" id="acrofobia_si" value = "1">
                                                        <label class="custom-control-label" for="acrofobia_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="acrofobia" id="acrofobia_no" value = "0">
                                                        <label class="custom-control-label" for="acrofobia_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td>INSUFICIENCIA CARDÍACA</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="insuficiencia_cardiaca" id="insuficiencia_cardiaca_si" value = "1">
                                                        <label class="custom-control-label" for="insuficiencia_cardiaca_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="insuficiencia_cardiaca" id="insuficiencia_cardiaca_no" value = "0">
                                                        <label class="custom-control-label" for="insuficiencia_cardiaca_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>CONSUMO DE ALCOHOL </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="consumo_alcohol" id="consumo_alcohol_si" value = "1">
                                                        <label class="custom-control-label" for="consumo_alcohol_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="consumo_alcohol" id="consumo_alcohol_no" value = "0">
                                                        <label class="custom-control-label" for="consumo_alcohol_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td>HTA NO CONTROLADA</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="hta_no_controlada" id="hta_no_controlada_si" value = "1">
                                                        <label class="custom-control-label" for="hta_no_controlada_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="hta_no_controlada" id="hta_no_controlada_no" value = "0">
                                                        <label class="custom-control-label" for="hta_no_controlada_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>CONSUMO DE DROGAS </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="consumo_drogas" id="consumo_drogas_si" value = "1">
                                                        <label class="custom-control-label" for="consumo_drogas_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="consumo_drogas" id="consumo_drogas_no" value = "0">
                                                        <label class="custom-control-label" for="consumo_drogas_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td>ARRITMIAS / OTRAS ALTERACIONES CARDIOVASCULARES
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="arritmias" id="arritmias_si" value = "1">
                                                        <label class="custom-control-label" for="arritmias_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="arritmias" id="arritmias_no" value = "0">
                                                        <label class="custom-control-label" for="arritmias_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ANTECEDENTE DE TEC </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="antecedente_tec" id="antecedentes_tec_si" value = "1">
                                                        <label class="custom-control-label" for="antecedentes_tec_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="antecedente_tec" id="antecedentes_tec_no" value = "0">
                                                        <label class="custom-control-label" for="antecedentes_tec_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td>AMETROPÍA DE LEJOS</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="ametropia_lejos" id="ametropia_lejos_si" value = "1">
                                                        <label class="custom-control-label" for="ametropia_lejos_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="ametropia_lejos" id="ametropia_lejos_no" value = "0">
                                                        <label class="custom-control-label" for="ametropia_lejos_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>CONVULSIONES / EPILEPSIA </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="convulsiones" id="convulsiones_si" value = "1">
                                                        <label class="custom-control-label" for="convulsiones_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="convulsiones" id="convulsiones_no" value = "0">
                                                        <label class="custom-control-label" for="convulsiones_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td>ESTEREOPSIA ALTERADA</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="estereopsia_alterada" id="estereopsia_alterada_si" value = "1">
                                                        <label class="custom-control-label" for="estereopsia_alterada_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="estereopsia_alterada" id="estereopsia_alterada_no" value = "0">
                                                        <label class="custom-control-label" for="estereopsia_alterada_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>VÉRTIGOS </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="vertigos" id="vertigos_si" value = "1">
                                                        <label class="custom-control-label" for="vertigos_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="vertigos" id="vertigos_no" value = "0">
                                                        <label class="custom-control-label" for="vertigos_no"></label></label>
                                                    </div>  
                                                </td>

                                                <td>ASMA BRONQUIAL NO CONTROLADA</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="asma_bronquial" id="asma_bronquial_si" value = "1">
                                                        <label class="custom-control-label" for="asma_bronquial_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="asma_bronquial" id="asma_bronquial_no" value = "0">
                                                        <label class="custom-control-label" for="asma_bronquial_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MAREOS</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="mareos" id="mareos_si" value = "1">
                                                        <label class="custom-control-label" for="mareos_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="mareos" id="mareos_no" value = "0">
                                                        <label class="custom-control-label" for="mareos_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td>PATRON OBSTRUCTIVO MODERADO O SEVERO</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="patron_obstructivo" id="patron_obstructivo_si" value = "1">
                                                        <label class="custom-control-label" for="patron_obstructivo_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="patron_obstructivo" id="patron_obstructivo_no" value = "0">
                                                        <label class="custom-control-label" for="patron_obstructivo_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>SINCOPE</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sincope" id="sincope_si" value = "1">
                                                        <label class="custom-control-label" for="sincope_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sincope" id="sincope_no" value = "0">
                                                        <label class="custom-control-label" for="sincope_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td>HIPOACUSIA SEVERA</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="hipoacusia_severa" id="hipoacusia_severa_si" value = "1">
                                                        <label class="custom-control-label" for="hipoacusia_severa_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="hipoacusia_severa" id="hipoacusia_severa_no" value = "0">
                                                        <label class="custom-control-label" for="hipoacusia_severa_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MIOCLONIAS</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="mioclonias" id="mioclonias_si" value = "1">
                                                        <label class="custom-control-label" for="mioclonias_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="mioclonias" id="mioclonias_no" value = "0">
                                                        <label class="custom-control-label" for="mioclonias_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td>ENTRENAMIENTO EN PRIMEROS AUXILIOS</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="entrenamiento_primeros" id="entrenamiento_primeros_si" value = "1">
                                                        <label class="custom-control-label" for="entrenamiento_primeros_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="entrenamiento_primeros" id="entrenamiento_primeros_no" value = "0">
                                                        <label class="custom-control-label" for="entrenamiento_primeros_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ACATISIA</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="acatisia" id="acatista_si" value = "1">
                                                        <label class="custom-control-label" for="acatista_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="acatisia" id="acatista_no" value = "0">
                                                        <label class="custom-control-label" for="acatista_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td>RECIBIÓ ENTRENAMIENTO PARA TRABAJO SOBRE NIVEL</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="recibio_entrenamiento" id="recibio_entrenamiento_si" value = "1">
                                                        <label class="custom-control-label" for="recibio_entrenamiento_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="recibio_entrenamiento" id="recibio_entrenamiento_no" value = "0">
                                                        <label class="custom-control-label" for="recibio_entrenamiento_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>CEFALEA / MIGRAÑA</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="cefalea" id="cefalea_si" value = "1">
                                                        <label class="custom-control-label" for="cefalea_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="cefalea" id="cefalea_no" value = "0">
                                                        <label class="custom-control-label" for="cefalea_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Comentarios / Observaciones</label>
                                        <textarea class="form-control" id="observaciones_antecedentes" name="observaciones_antecedentes" rows="2"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>EXAMEN MÉDICO DIRIGIDO</th>
                                                <th>NORMAL</th>
                                                <th>ANORMAL</th>                                        
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>TIMPANOS</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="timpanos" id="timpanos_si" value = "1">
                                                        <label class="custom-control-label" for="timpanos_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="timpanos" id="timpanos_no" value = "0">
                                                        <label class="custom-control-label" for="timpanos_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>AUDICIÓN</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="audicion" id="audicion_si" value = "1">
                                                        <label class="custom-control-label" for="audicion_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="audicion" id="audicion_no" value = "0">
                                                        <label class="custom-control-label" for="audicion_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>SUSTENTACIÓN EN UN PIE POR 15"</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sustentacion_pie" id="sustentacion_pie_si" value = "1">
                                                        <label class="custom-control-label" for="sustentacion_pie_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sustentacion_pie" id="sustentacion_pie_no" value = "0">
                                                        <label class="custom-control-label" for="sustentacion_pie_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>CAMINAR LIBRE SOBRE RECTA 3 m (SIN DESVIO)</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="caminar_recta" id="caminar_recta_si" value = "1">
                                                        <label class="custom-control-label" for="caminar_recta_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="caminar_recta" id="caminar_recta_no" value = "0">
                                                        <label class="custom-control-label" for="caminar_recta_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>CAMINAR LIBRE OJOS VENDADOS 3 m (SIN DESVIO)</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="caminar_libre" id="caminar_libre_si" value = "1">
                                                        <label class="custom-control-label" for="caminar_libre_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="caminar_libre" id="caminar_libre_no" value = "0">
                                                        <label class="custom-control-label" for="caminar_libre_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>CAMINAR LIBRE OJOS VENDADOS PUNTA TALON 3 m (SIN DESVIO)</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="caminar_libre_punta" id="caminar_libre_punta_si" value = "1">
                                                        <label class="custom-control-label" for="caminar_libre_punta_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="caminar_libre_punta" id="caminar_libre_punta_no" value = "0">
                                                        <label class="custom-control-label" for="caminar_libre_punta_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>LIMITACIÓN EN FUERZA O MOVILIDAD DE EXTREMIDADES</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="limitacion_fuerza" id="limitacion_fuerza_si" value = "1">
                                                        <label class="custom-control-label" for="limitacion_fuerza_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="limitacion_fuerza" id="limitacion_fuerza_no" value = "0">
                                                        <label class="custom-control-label" for="limitacion_fuerza_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>DIADOCOQUINESIA DIRECTA</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="diadocoquinesia_directa" id="diadocoquinesia_directa_si" value = "1">
                                                        <label class="custom-control-label" for="diadocoquinesia_directa_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="diadocoquinesia_directa" id="diadocoquinesia_directa_no" value = "0">
                                                        <label class="custom-control-label" for="diadocoquinesia_directa_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>DIADOCOQUINESIA CRUZADA</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="diadocoquinesia_cruzada" id="diadocoquinesia_cruzada_si" value = "1">
                                                        <label class="custom-control-label" for="diadocoquinesia_cruzada_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="diadocoquinesia_cruzada" id="diadocoquinesia_cruzada_no" value = "0">
                                                        <label class="custom-control-label" for="diadocoquinesia_cruzada_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>NISTAGMUS</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="nistagmus" id="nistagmus_si" value = "1">
                                                        <label class="custom-control-label" for="nistagmus_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="nistagmus" id="nistagmus_no" value = "0">
                                                        <label class="custom-control-label" for="nistagmus_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Observaciones</label>
                                        <textarea class="form-control" id="observaciones_examen" name="observaciones_examen" rows="2"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Estado <span class="text-danger">*</span></label>
                                        <select required class="form-control custom-select" id="estado" name="estado" data-placeholder="Choose a Category" tabindex="1">
                                            <option value="">--</option>
                                            <option value="1">APTO</option>
                                            <option value="2">NO APTO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ALTITUD 2500 M.S.N.M. - ANEXO 16 -->
                        <div class="tab-pane" id="altitud" role="tabpanel">
                            <div class="row p-20">
                                <div class="col-md-12">
                                    <div class = "form-group text-center">
                                        <label class="control-label"><h4 class="card-title text-center">ANEXO 16 A<br>EVALUACIÓN MÉDICA PARA ASCENSO A GRANDES ALTITUDES<br>(Mayor a 2,500 m.s.n.m.)</h4></label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class = "form-group text-left">
                                        <label class="control-label">El (la) paciente (a) ha presentado en los últimos 6 meses lo siguiente:</label>
                                    </div>
                                </div>
                            
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>PATOLOGÍA</th>
                                                <th>SI</th>
                                                <th>NO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Cirugía mayor reciente</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input"  name="cirugia_mayor" id="cirugia_mayor_si" value = "1">
                                                        <label class="custom-control-label" for="cirugia_mayor_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="cirugia_mayor" id="cirugia_mayor_no" value = "0">
                                                        <label class="custom-control-label" for="cirugia_mayor_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Desórdenes de la coagulación, trombosis, otros</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="desordenes_coagulacion" id="desordenes_coagulacion_si" value = "1">
                                                        <label class="custom-control-label" for="desordenes_coagulacion_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="desordenes_coagulacion" id="desordenes_coagulacion_no" value = "0">
                                                        <label class="custom-control-label" for="desordenes_coagulacion_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Diabetes Mellitus</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="diabetes_mellitus" id="diabetes_mellitus_si" value = "1">
                                                        <label class="custom-control-label" for="diabetes_mellitus_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="diabetes_mellitus" id="diabetes_mellitus_no" value = "0">
                                                        <label class="custom-control-label" for="diabetes_mellitus_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hipertensión Arterial</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="hipertension_arterial" id="hipertension_arterial_si" value = "1">
                                                        <label class="custom-control-label" for="hipertension_arterial_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="hipertension_arterial" id="hipertension_arterial_no" value = "0">
                                                        <label class="custom-control-label" for="hipertension_arterial_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Embarazo</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="embarazo" id="embarazo_si" value = "1">
                                                        <label class="custom-control-label" for="embarazo_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="embarazo" id="embarazo_no" value = "0">
                                                        <label class="custom-control-label" for="embarazo_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Problemas neurológicos: epilepsia, vértigos, otros</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="problemas_neurologicos" id="problemas_neurologicos_si" value = "1">
                                                        <label class="custom-control-label" for="problemas_neurologicos_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="problemas_neurologicos" id="problemas_neurologicos_no" value = "0">
                                                        <label class="custom-control-label" for="problemas_neurologicos_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Infecciones recientes (de moderadas a severas)</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="infecciones_recientes" id="infecciones_recientes_si" value = "1">
                                                        <label class="custom-control-label" for="infecciones_recientes_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="infecciones_recientes" id="infecciones_recientes_no" value = "0">
                                                        <label class="custom-control-label" for="infecciones_recientes_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>                        
                                            <tr>
                                                <td>Obesidad</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="obesidad" id="obesidad_si" value = "1">
                                                        <label class="custom-control-label" for="obesidad_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="obesidad" id="obesidad_no" value = "0">
                                                        <label class="custom-control-label" for="obesidad_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Problemas cardiacos: marcapasos, coronariopatía, otros</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="problemas_cardiacos" id="problemas_cardiacos_si" value = "1">
                                                        <label class="custom-control-label" for="problemas_cardiacos_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="problemas_cardiacos" id="problemas_cardiacos_no" value = "0">
                                                        <label class="custom-control-label" for="problemas_cardiacos_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Problemas respiratorios: asma, EPOC, otros</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="problemas_respiratorios" id="problemas_respiratorios_si" value = "1">
                                                        <label class="custom-control-label" for="problemas_respiratorios_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="problemas_respiratorios" id="problemas_respiratorios_no" value = "0">
                                                        <label class="custom-control-label" for="problemas_respiratorios_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Problemas oftalmológicos: retinopatía, glaucoma, otros</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="problemas_oftalmologicos" id="problemas_oftalmologicos_si" value = "1">
                                                        <label class="custom-control-label" for="problemas_oftalmologicos_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="problemas_oftalmologicos" id="problemas_oftalmologicos_no" value = "0">
                                                        <label class="custom-control-label" for="problemas_oftalmologicos_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Problemas digestivos: sangrado digestivo, hepatitis, cirrosis hepática, otros</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="problemas_digestivos" id="problemas_digestivos_si" value = "1">
                                                        <label class="custom-control-label" for="problemas_digestivos_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="problemas_digestivos" id="problemas_digestivos_no" value = "0">
                                                        <label class="custom-control-label" for="problemas_digestivos_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Apnea del sueño</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="apnea_sueño" id="apnea_sueño_si" value = "1">
                                                        <label class="custom-control-label" for="apnea_sueño_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="apnea_sueño" id="apnea_sueño_no" value = "0">
                                                        <label class="custom-control-label" for="apnea_sueño_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Alergias</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="alergias" id="alergias_si" value = "1">
                                                        <label class="custom-control-label" for="alergias_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="alergias" id="alergias_no" value = "0">
                                                        <label class="custom-control-label" for="alergias_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Otra condición médica importante</td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="otra_condicion" id="otra_condicion_si" value = "1">
                                                        <label class="custom-control-label" for="otra_condicion_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="otra_condicion" id="otra_condicion_no" value = "0">
                                                        <label class="custom-control-label" for="otra_condicion_no"></label></label>
                                                    </div>  
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Otra condición médica importante</label>
                                        <textarea class="form-control" id="des_otra_condicion" name="des_otra_condicion" rows="2"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Uso de medicación actual</label>
                                        <textarea class="form-control" id="medicacion_actual" name="medicacion_actual" rows="2"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Hemoglobina<span class="text-danger">*</span></label>
                                        <input  type="text" id="hemoglobina" name="hemoglobina" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Hematocrito<span class="text-danger">*</span></label>
                                        <input  type="text" id="hematocrito" name="hematocrito" class="form-control" >
                                    </div>
                                </div>

                
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label">Resultado de EKG</label>
                                        <input type="text" id="resultado_ekg" name="resultado_ekg" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Estado <span class="text-danger">*</span></label>
                                        <select required class="form-control custom-select" id="estado" name="estado" data-placeholder="Choose a Category" tabindex="1">
                                            <option value="">--</option>
                                            <option value="1">APTO</option>
                                            <option value="2">NO APTO</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Observaciones</label>
                                        <textarea class="form-control" id="observaciones" name="observaciones" rows="2"></textarea>
                                    </div>
                                </div>                                    
                            </div>
                        </div>
                        <!-- SINTOMATICO RESPIRATORIO -->
                        <div class="tab-pane" id="sintomatico" role="tabpanel">
                            <div class="row p-20">
                                <div class="col-md-12 text-center">
                                    <label class="control-label"><h4><strong>CUESTIONARIO DE SINTOMATICO RESPIRATORIO</strong></h4></label>
                                </div>

                                <div class="col-md-12">
                                    <label class="control-label"><b>1. ¿Usted, tiene o ha tenido alguna(s) de las siguientes enfermedades?</b></label>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-center">Nunca</th>
                                                <th class="text-center">Tiene</th>
                                                <th class="text-center">Ha tenido</th>
                                                <th class="text-center">¿Hace cuánto tiempo? ¿En dónde le diagnosticaron y trataron?</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Tuberculosis (TBC)</td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="tuberculosis" id="tuberculosis_nunca" value="1">
                                                        <label class="custom-control-label" for="tuberculosis_nunca"></label></label>
                                                    </div> 
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="tuberculosis" id="tuberculosis_tiene" value="0">
                                                        <label class="custom-control-label" for="tuberculosis_tiene"></label></label>
                                                    </div>  
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="tuberculosis" id="tuberculosis_tenido" value="0">
                                                        <label class="custom-control-label" for="tuberculosis_tenido"></label></label>
                                                    </div>  
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="descripcion_tuberculosis" id="descripcion_tuberculosis">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Asma</td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="asma" id="asma_nunca" value="1">
                                                        <label class="custom-control-label" for="asma_nunca"></label></label>
                                                    </div> 
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="asma" id="asma_tiene" value="0">
                                                        <label class="custom-control-label" for="asma_tiene"></label></label>
                                                    </div>  
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="asma" id="asma_tenido" value="0">
                                                        <label class="custom-control-label" for="asma_tenido"></label></label>
                                                    </div>  
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="descripcion_asma" id="descripcion_asma">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Bronquitis a repetición</td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="bronquitis" id="bronquitis_nunca" value="1">
                                                        <label class="custom-control-label" for="bronquitis_nunca"></label></label>
                                                    </div> 
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="bronquitis" id="bronquitis_tiene" value="0">
                                                        <label class="custom-control-label" for="bronquitis_tiene"></label></label>
                                                    </div>  
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="bronquitis" id="bronquitis_tenido" value="0">
                                                        <label class="custom-control-label" for="bronquitis_tenido"></label></label>
                                                    </div>  
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="descripcion_bronquitis" id="descripcion_bronquitis">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Fibrosis pulmonar</td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="fibrosis" id="fibrosis_nunca" value="1">
                                                        <label class="custom-control-label" for="fibrosis_nunca"></label></label>
                                                    </div> 
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="fibrosis" id="fibrosis_tiene" value="0">
                                                        <label class="custom-control-label" for="fibrosis_tiene"></label></label>
                                                    </div>  
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="fibrosis" id="fibrosis_tenido" value="0">
                                                        <label class="custom-control-label" for="fibrosis_tenido"></label></label>
                                                    </div>  
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="descripcion_fibrosis" id="descripcion_fibrosis">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Neumonía</td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="neumonia" id="neumonia_nunca" value="1">
                                                        <label class="custom-control-label" for="neumonia_nunca"></label></label>
                                                    </div> 
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="neumonia" id="neumonia_tiene" value="0">
                                                        <label class="custom-control-label" for="neumonia_tiene"></label></label>
                                                    </div>  
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="neumonia" id="neumonia_tenido" value="0">
                                                        <label class="custom-control-label" for="neumonia_tenido"></label></label>
                                                    </div>  
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="descripcion_neumonia" id="descripcion_neumonia">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-12">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td><label class="control-label"><b>2. En su casa, ¿hay alguna persona con diagnóstico de tuberculosis?</b></label></td>
                                                <td>
                                                    <select required class="form-control custom-select" id="d_tbc1" name="d_tbc1">
                                                        <option value="0">--</option>
                                                        <option value="1">SI</option>
                                                        <option value="2">NO</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="control-label"><b>3. ¿Ha estado en contacto con alguna persona que haya sido diagnosticada de tuberculosis en los últimos 6 meses?</b></label></td>
                                                <td>
                                                    <select required class="form-control custom-select" id="d_tbc2" name="d_tbc2">
                                                        <option value="0">--</option>
                                                        <option value="1">SI</option>
                                                        <option value="2">NO</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-12">
                                    <table style="width: 100%">
                                        <tbody>
                                            <tr>
                                                <br>
                                                <td>Si su respuesta a las preguntas 2 o 3 fue afirmativa, ¿está usted recibiendo algún tipo de medicación?</td>
                                            </tr>
                                            <tr>
                                                <td><textarea class="form-control" id="medicacion" name="medicacion" rows="3"></textarea></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-12">
                                    <br>
                                    <label class="control-label"><b>4. ¿Presenta usted alguno de los siguientes síntomas?</b></label>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-center">SI</th>
                                                <th class="text-center">NO</th>
                                                <th class="text-center">Observaciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Tos con flema por 15 día o más</td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sintoma1" id="sintoma1_si" value="1">
                                                        <label class="custom-control-label" for="sintoma1_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sintoma1" id="sintoma1_no" value="0">
                                                        <label class="custom-control-label" for="sintoma1_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Cansancio o debilidad muscular</td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sintoma2" id="sintoma2_si" value="1">
                                                        <label class="custom-control-label" for="sintoma2_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sintoma2" id="sintoma2_no" value="0">
                                                        <label class="custom-control-label" for="sintoma2_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Fiebre</td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sintoma3" id="sintoma3_si" value="1">
                                                        <label class="custom-control-label" for="sintoma3_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sintoma3" id="sintoma3_no" value="0">
                                                        <label class="custom-control-label" for="sintoma3_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Sudoración nocturna</td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sintoma4" id="sintoma4_si" value="1">
                                                        <label class="custom-control-label" for="sintoma4_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sintoma4" id="sintoma4_no" value="0">
                                                        <label class="custom-control-label" for="sintoma4_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Pérdida de apetito</td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sintoma5" id="sintoma5_si" value="1">
                                                        <label class="custom-control-label" for="sintoma5_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sintoma5" id="sintoma5_no" value="0">
                                                        <label class="custom-control-label" for="sintoma5_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Pérdida de peso</td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sintoma6" id="sintoma6_si" value="1">
                                                        <label class="custom-control-label" for="sintoma6_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sintoma6" id="sintoma6_no" value="0">
                                                        <label class="custom-control-label" for="sintoma6_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="descripcion_sintoma6" id="descripcion_sintoma6" placeholder="¿Cuántos kg en cuánto tiempo?">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Dolor torácico</td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sintoma7" id="sintoma7_si" value="1">
                                                        <label class="custom-control-label" for="sintoma7_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sintoma7" id="sintoma7_no" value="0">
                                                        <label class="custom-control-label" for="sintoma7_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Dificultad para respirar</td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sintoma8" id="sintoma8_si" value="1">
                                                        <label class="custom-control-label" for="sintoma8_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sintoma8" id="sintoma8_no" value="0">
                                                        <label class="custom-control-label" for="sintoma8_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Expectoración con sangre</td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sintoma9" id="sintoma9_si" value="1">
                                                        <label class="custom-control-label" for="sintoma9_si"></label></label>
                                                    </div> 
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-radio">
                                                        <input required type="radio" class="custom-control-input" name="sintoma9" id="sintoma9_no" value="0">
                                                        <label class="custom-control-label" for="sintoma9_no"></label></label>
                                                    </div>  
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-12">
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td width="90%"><label class="control-label"><b>5. ¿Se ha realizado una radiografía de tórax durante el presente año?</b></label></td>
                                                <td width="10%">
                                                    <select required class="form-control custom-select" id="rayos1" name="rayos1">
                                                        <option value="0">--</option>
                                                        <option value="1">SI</option>
                                                        <option value="2">NO</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-12">                                        
                                    <table style="width: 100%">
                                        <tbody>
                                            <tr>
                                                <br>
                                                <td>Si su respuesta fue afirmativa, ¿cuál fue su resultado?</td>
                                            </tr>
                                            <tr>
                                                <td><textarea class="form-control" id="resultado_rayos" name="resultado_rayos" rows="2"></textarea></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-12">
                                    <br>
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td width="90%"><label class="control-label"><b>6. ¿Alguna vez le han dicho que tiene una imagen sospechosa en su radiografía de tórax?</b></label></td>
                                                <td width="10%">
                                                    <select required class="form-control custom-select" id="rayos2" name="rayos2">
                                                        <option value="0">--</option>
                                                        <option value="1">SI</option>
                                                        <option value="2">NO</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-12">
                                    <br>
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td width="90%"><label class="control-label"><b>CONCLUSION</b> ¿es considerado como SINTOMÁTICO RESPIRATORIO?</label></td>
                                                <td width="10%">
                                                    <select required class="form-control custom-select" id="conclusion" name="conclusion">
                                                        <option value="0">--</option>
                                                        <option value="1">SI</option>
                                                        <option value="2">NO</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- ANTECEDENTES PERSONALES -->
                        <div class="tab-pane" id="personales" role="tabpanel">
                            <div class="row p-20">
                                <div class="col-md-12 text-center">
                                    <label class="control-label"><h5><strong>ANTECEDENTES PATOLOGICOS PERSONALES</strong></h5></label>
                                </div>

                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="alergia" id="alergia" value="1">
                                        <label class="custom-control-label" for="alergia">Alergia</label>
                                    </div>  
                                </div>

                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="diabetes" id="diabetes" value="1">
                                        <label class="custom-control-label" for="diabetes">Diabetes</label>
                                    </div>  
                                </div>

                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="tbc" id="tbc" value="1">
                                        <label class="custom-control-label" for="tbc">TBC</label>
                                    </div>  
                                </div>

                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="hepatitisb" id="hepatitisb" value="1">
                                        <label class="custom-control-label" for="hepatitisb">Hepatitis B</label>
                                    </div>  
                                </div>

                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="asma" id="asma" value="1">
                                        <label class="custom-control-label" for="asma">Asma</label>
                                    </div>  
                                </div>

                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="hta" id="hta" value="1">
                                        <label class="custom-control-label" for="hta">HTA</label>
                                    </div>  
                                </div>

                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="its" id="its" value="1">
                                        <label class="custom-control-label" for="its">ITS</label>
                                    </div>  
                                </div>

                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="tifoidea" id="tifoidea" value="1">
                                        <label class="custom-control-label" for="tifoidea">Tifoidea</label>
                                    </div>  
                                </div>

                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="bronquitis" id="bronquitis" value="1">
                                        <label class="custom-control-label" for="bronquitis">Bronquitis</label>
                                    </div>  
                                </div>

                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="neoplasia" id="neoplasia" value="1">
                                        <label class="custom-control-label" for="neoplasia">Neoplasia</label>
                                    </div>  
                                </div>

                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="convulsiones" id="convulsiones" value="1">
                                        <label class="custom-control-label" for="convulsiones">Convulsiones</label>
                                    </div>  
                                </div>

                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="quemaduras" id="quemaduras" value="1">
                                        <label class="custom-control-label" for="quemaduras">Quemaduras</label>
                                    </div>  
                                </div>

                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="intoxicaciones" id="intoxicaciones" value="1">
                                        <label class="custom-control-label" for="intoxicaciones">Intoxicaciones</label>
                                    </div>  
                                </div>

                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="cirugias" id="cirugias" value="1">
                                        <label class="custom-control-label" for="cirugias">Cirugías</label>
                                    </div>  
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Otros</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="otros" name="otros">
                                        </div>
                                    </div>  
                                </div>

                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>HÁBITOS NOCIVOS</th>
                                                    <th>TIPO</th>
                                                    <th>CANTIDAD</th>
                                                    <th>FRECUENCIA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>ALCOHOL <span class="text-danger">*</span></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select required class="form-control custom-select" id="alcohol_tipo" name="alcohol_tipo" data-placeholder="Choose a Category" tabindex="1">
                                                                <option value="">--</option>
                                                                <option value="1">Niega</option>
                                                                <option value="2">Poco</option>
                                                                <option value="3">Habitual</option>
                                                                <option value="4">Excesivo</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select required class="form-control custom-select" id="alcohol_cantidad" name="alcohol_cantidad" data-placeholder="Choose a Category" tabindex="1">
                                                                <option value="">--</option>
                                                                <option value="1">Niega</option>
                                                                <option value="2">Poco</option>
                                                                <option value="3">Habitual</option>
                                                                <option value="4">Excesivo</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select required class="form-control custom-select" id="alcohol_frecuencia" name="alcohol_frecuencia" data-placeholder="Choose a Category" tabindex="1">
                                                                <option value="">--</option>
                                                                <option value="1">Niega</option>
                                                                <option value="2">Poco</option>
                                                                <option value="3">Habitual</option>
                                                                <option value="4">Excesivo</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>TABACO <span class="text-danger">*</span></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select required class="form-control custom-select" id="tabaco_tipo" name="tabaco_tipo" data-placeholder="Choose a Category" tabindex="1">
                                                                <option value="">--</option>
                                                                <option value="1">Niega</option>
                                                                <option value="2">Poco</option>
                                                                <option value="3">Habitual</option>
                                                                <option value="4">Excesivo</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select required class="form-control custom-select" id="tabaco_cantidad" name="tabaco_cantidad" data-placeholder="Choose a Category" tabindex="1">
                                                                <option value="">--</option>
                                                                <option value="1">Niega</option>
                                                                <option value="2">Poco</option>
                                                                <option value="3">Habitual</option>
                                                                <option value="4">Excesivo</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select required class="form-control custom-select" id="tabaco_frecuencia" name="tabaco_frecuencia" data-placeholder="Choose a Category" tabindex="1">
                                                                <option value="">--</option>
                                                                <option value="1">Niega</option>
                                                                <option value="2">Poco</option>
                                                                <option value="3">Habitual</option>
                                                                <option value="4">Excesivo</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>DROGAS <span class="text-danger">*</span></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select required class="form-control custom-select" id="drogas_tipo" name="drogas_tipo" data-placeholder="Choose a Category" tabindex="1">
                                                                <option value="">--</option>
                                                                <option value="1">Niega</option>
                                                                <option value="2">Poco</option>
                                                                <option value="3">Habitual</option>
                                                                <option value="4">Excesivo</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select required class="form-control custom-select" id="drogas_cantidad" name="drogas_cantidad" data-placeholder="Choose a Category" tabindex="1">
                                                                <option value="">--</option>
                                                                <option value="1">Niega</option>
                                                                <option value="2">Poco</option>
                                                                <option value="3">Habitual</option>
                                                                <option value="4">Excesivo</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select required class="form-control custom-select" id="drogas_frecuencia" name="drogas_frecuencia" data-placeholder="Choose a Category" tabindex="1">
                                                                <option value="">--</option>
                                                                <option value="1">Niega</option>
                                                                <option value="2">Poco</option>
                                                                <option value="3">Habitual</option>
                                                                <option value="4">Excesivo</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group text-left">
                                        <label class="control-label">Medicamentos</label>
                                        <textarea class="form-control" id="medicamentos_antecedentes" name="medicamentos_antecedentes" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ANTECEDENTES FAMILIARES -->
                        <div class="tab-pane" id="familiares" role="tabpanel">
                            <div class="row p-20">
                                <div class="col-md-12 text-center">
                                    <label class="control-label"><h5><strong>ANTECEDENTES PATOLOGICOS FAMILIARES</strong></h5></label>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Padre</label>
                                        <input  type="text" id="padre_antecedentes" name="padre_antecedentes" class="form-control" >  
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Madre</label>
                                        <input  type="text" id="madre_antecedentes" name="madre_antecedentes" class="form-control" >  
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Hermanos</label>
                                        <input  type="text" id="hermanos_antecedentes" name="hermanos_antecedentes" class="form-control" >  
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Esposo(a)</label>
                                        <input  type="text" id="esposo_antecedentes" name="esposo_antecedentes" class="form-control" >  
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-form-label">Hijos Vivos <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input required type="text" id="nhijos_vivos" name="nhijos_vivos" class="form-control" placeholder="N° Hijos Vivos" >  
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-form-label">Hijos Fallecidos <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input required type="text" id="nhijos_fallecidos" name="nhijos_fallecidos" class="form-control" placeholder="N° Hijos Fallecidos" >  
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class = "form-group text-left">
                                        <label class="control-label">Enfermedades y Accidentes (Asociado a trabajo o no) </label>
                                        <textarea class="form-control" id="accidente_antecedentes_fam" name="accidente_antecedentes_fam" rows="2"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group text-left">
                                        <label class="control-label">Asociado al Trabajo</label>
                                        <select class="form-control custom-select" id="asociado_trabajo" name="asociado_trabajo" data-placeholder="Choose a Category" tabindex="1">
                                            <option value="">--</option>
                                            <option value="1">SI</option>
                                            <option value="0">NO</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Año</label>
                                        <input type="text" id="ano_accidente" name="ano_accidente" class="form-control">  
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Días de Descanso</label>
                                        <input type="text" id="dias_descanso" name="dias_descanso" class="form-control">  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- EVALUACIÓN MÉDICA -->
                        <div class="tab-pane" id="evaluacion" role="tabpanel">
                            <div class="row p-20">
                                <div class="col-md-12 text-center">
                                    <label class="control-label"><h5><strong>EVALUACIÓN MÉDICA</strong></h5></label>
                                </div> 

                                <div class="col-md-12">
                                    <div class = "form-group text-left">
                                        <label class="control-label">Anamnesis</label>
                                        <textarea class="form-control" id="anamnesis" name="anamnesis" rows="2"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class = "form-group text-left">
                                        <label class="control-label"><h5><strong>EXAMEN CLÍNICO</strong></h5></label>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Talla(m)</label>
                                        <input readonly type="text" id="talla" name="talla" class="form-control" value="<?=$DES_TALLA?>">  
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Peso (Kg.)</label>
                                        <input readonly type="text" id="peso" name="peso" class="form-control" value="<?=$DES_PESO?>">  
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">IMC</label>
                                        <input readonly type="text" id="imc" name="imc" class="form-control" value="<?=$DES_IMC?>">  
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Perímetro Abdominal</label>
                                        <input readonly type="text" id="perimetro_abdominal" name="perimetro_abdominal" class="form-control" value="<?=$PERIMETRO_ABDOMINAL?>">  
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">F. Resp.</label>
                                        <input readonly type="text" id="f_resp" name="f_resp" class="form-control" value="<?=$DES_FRE_RESPIRA?>">  
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">F. Card.</label>
                                        <input readonly type="text" id="f_card" name="f_card" class="form-control" value="<?=$DES_FRE_CARDIACA?>">  
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">PA</label>
                                        <input readonly type="text" id="pa" name="pa" class="form-control" value="<?=$DES_PRESION_ARTERIAL?>">  
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Temperatura</label>
                                        <input readonly type="text" id="temperatura" name="temperatura" class="form-control" value="<?=$DES_TEMPERATURA?>">  
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Otros</label>
                                        <input type="text" id="otros_hce" name="otros_hce" class="form-control">  
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Ectoscopia</label>
                                        <select  class="form-control custom-select" id="ectoscopia" name="ectoscopia" data-placeholder="Choose a Category" tabindex="1">
                                            <option value="">--</option>
                                            <option value="1">Normal</option>
                                            <option value="2">Anormal</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Estado Mental</label>
                                        <select  class="form-control custom-select" id="estado_mental" name="estado_mental" data-placeholder="Choose a Category" tabindex="1">
                                            <option value="">--</option>
                                            <option value="1">Normal</option>
                                            <option value="2">Anormal</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class = "form-group text-left">
                                        <label class="control-label"><h5><strong>EXAMEN FÍSICO</strong></h5></label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="control-label">Piel</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="piel" id="piel" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="piel">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="piel_hallazgo" style="display: block;">
                                                    <textarea id="piel_hallazgo" name="piel_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="piel_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="" name=""  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="control-label">Cabello</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="cabello" id="cabello" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="cabello">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="cabello_hallazgo" style="display: block;">
                                                    <textarea id="cabello_hallazgo" name="cabello_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="cabello_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="cabello_sinhallazgo" name="cabello_sinhallazgo"  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="control-label">Ojos y Anexos</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="ojosanexos" id="ojosanexos" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="ojosanexos">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="ojosanexos_hallazgo" style="display: block;">
                                                    <textarea id="ojos_hallazgo" name="ojos_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="ojosanexos_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="" name=""  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="control-label">Oídos</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="oidos" id="oidos" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="oidos">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="oidos_hallazgo" style="display: block;">
                                                    <textarea id="oidos_hallazgo" name="oidos_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="oidos_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="" name=""  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="control-label">Nariz</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="nariz" id="nariz" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="nariz">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="nariz_hallazgo" style="display: block;">
                                                    <textarea id="nariz_hallazgo" name="nariz_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="nariz_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="" name=""  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="control-label">Boca</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="boca" id="boca" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="boca">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="boca_hallazgo" style="display: block;">
                                                    <textarea id="boca_hallazgo" name="boca_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="boca_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="" name=""  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class = row>
                                            <div class="col-md-4">
                                                <label class="control-label">Faringe</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="faringe" id="faringe" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="faringe">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="faringe_hallazgo" style="display: block;">
                                                    <textarea id="faringe_hallazgo" name="faringe_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="faringe_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="" name=""  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class = row>
                                            <div class="col-md-4">
                                                <label class="control-label">Cuello</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="cuello" id="cuello" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="cuello">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="cuello_hallazgo" style="display: block;">
                                                    <textarea id="cuello_hallazgo" name="cuello_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="cuello_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="" name=""  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class = row>
                                            <div class="col-md-4">
                                                <label class="control-label">Aparato Respiratorio</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="aparatorespiratorio" id="aparatorespiratorio" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="aparatorespiratorio">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="aparatorespiratorio_hallazgo" style="display: block;">
                                                    <textarea id="aparatorespiratorio_hallazgo" name="aparatorespiratorio_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="aparatorespiratorio_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="" name=""  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class = row>
                                            <div class="col-md-4">
                                                <label class="control-label">Aparato Cardiovascular</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="aparatocardio" id="aparatocardio" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="aparatocardio">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="aparatocardio_hallazgo" style="display: block;">
                                                    <textarea id="aparatocardio_hallazgo" name="aparatocardio_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="aparatocardio_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="" name=""  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class = row>
                                            <div class="col-md-4">
                                                <label class="control-label">Aparato Digestivo</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="aparatodigestivo" id="aparatodigestivo" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="aparatodigestivo">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="aparatodigestivo_hallazgo" style="display: block;">
                                                    <textarea id="aparatodigestivo_hallazgo" name="aparatodigestivo_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="aparatodigestivo_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="" name=""  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class = row>
                                            <div class="col-md-4">
                                                <label class="control-label">Aparato Genitourinario</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="aparatogenito" id="aparatogenito" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="aparatogenito">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="aparatogenito_hallazgo" style="display: block;">
                                                    <textarea id="aparatogenito_hallazgo" name="aparatogenito_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="aparatogenito_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="" name=""  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class = row>
                                            <div class="col-md-4">
                                                <label class="control-label">Aparato Locomotor</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="aparatolocomotor" id="aparatolocomotor" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="aparatolocomotor">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="aparatolocomotor_hallazgo" style="display: block;">
                                                    <textarea id="aparatolocomotor_hallazgo" name="aparatolocomotor_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="aparatolocomotor_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="" name=""  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class = row>
                                            <div class="col-md-4">
                                                <label class="control-label">Marcha</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="marcha" id="marcha" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="marcha">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="marcha_hallazgo" style="display: block;">
                                                    <textarea id="marcha_hallazgo" name="marcha_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="marcha_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="" name=""  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class = row>
                                            <div class="col-md-4">
                                                <label class="control-label">Columna</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="columna" id="columna" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="columna">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="columna_hallazgo" style="display: block;">
                                                    <textarea id="columna_hallazgo" name="columna_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="columna_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="" name=""  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class = row>
                                            <div class="col-md-4">
                                                <label class="control-label">Miembros Superiores</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="miembrosup" id="miembrosup" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="miembrosup">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="miembrosup_hallazgo" style="display: block;">
                                                    <textarea id="miembrosup_hallazgo" name="miembrosup_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="miembrosup_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="" name=""  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class = row>
                                            <div class="col-md-4">
                                                <label class="control-label">Miembros Inferiores</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="miembrosinfe" id="miembrosinfe" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="miembrosinfe">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="miembrosinfe_hallazgo" style="display: block;">
                                                    <textarea id="miembrosinfe_hallazgo" name="miembrosinfe_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="miembrosinfe_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="" name=""  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class = row>
                                            <div class="col-md-4">
                                                <label class="control-label">Sistema Linfático</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="sistemalinfatico" id="sistemalinfatico" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="sistemalinfatico">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="sistemalinfatico_hallazgo" style="display: block;">
                                                    <textarea id="sistemalinfatico_hallazgo" name="sistemalinfatico_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="sistemalinfatico_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="" name=""  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class = row>
                                            <div class="col-md-4">
                                                <label class="control-label">Sistema Nervioso</label>
                                            </div>

                                            <div class="custom-control custom-checkbox col-sm-2">
                                                <input type="checkbox" class="custom-control-input"  name="sistemanervioso" id="sistemanervioso" value = "0" onchange="javascript:showContent(this.id)" >
                                                <label class="custom-control-label" for="sistemanervioso">Sin Hallazgo</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row" id="sistemanervioso_hallazgo" style="display: block;">
                                                    <textarea id="sistemanervioso_hallazgo" name="sistemanervioso_hallazgo" class="form-control" rows="2"></textarea>
                                                </div>

                                                <div class="row" id="sistemanervioso_sinhallazgo" style="display: none;">
                                                    <textarea disabled id="" name=""  class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Diagnósticos Presuntivos</label>
                                        <div class="input-group">
                                            <div class="table-responsive">  
                                                <table style="border: hidden" id="d_presuntivo" class="col-md-12">    
                                                    <tr id="rowp1">
                                                        <td width="200">
                                                            <input type="text" name="codigo_cie[]" id="codigo_cie_1" class="form-control" placeholder="CIE10" readonly/>
                                                        </td>  
                                                        <td width="800">
                                                            <input type="text" name="diagnostico_presuntivo[]" id="diagnostico_presuntivo_1" placeholder="Diagnóstico" class="form-control input_dp"/>
                                                        </td>  
                                                        <td>
                                                            <input id="id_diagnostico_1" name="id_diagnostico[]" type='hidden'>
                                                        </td>
                                                        <td>
                                                            <button type="button" name="add" id="add" class="btn btn-success">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </td>  
                                                    </tr>  
                                                </table>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- CONCLUSIONES -->
                        <div class="tab-pane" id="conclusiones" role="tabpanel">
                            <div class="row p-20">
                                <div class="col-md-12 text-center">
                                    <label class="control-label"><h5><strong>CONCLUSIONES</strong></h5></label>
                                </div>

                                <div class="col-md-12">
                                    <div class = "form-group text-left">
                                        <label class="control-label">Conclusiones de Evaluación Psicológica</label>
                                        <textarea readonly class="form-control" id="conclusiones_psico" name="conclusiones_psico" rows="8"><?="-$AREA_COGNITIVA\n-$AREA_EMOCIONAL"?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class = "form-group text-left">
                                        <label class="control-label">Conclusiones Radiográficas</label>
                                        <textarea readonly class="form-control" id="conclusiones_radio" name="conclusiones_radio" rows="2"><?=$resultado_rx?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class = "form-group text-left">
                                        <label class="control-label">Conclusiones Oftalmológicas</label>
                                        <textarea readonly class="form-control" id="conclusiones_ofta" name="conclusiones_ofta" rows="2"><?=$resultado_oftalmo?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class = "form-group text-left">
                                        <label class="control-label">Hallazgos Patológicos de Laboratorio</label>
                                        <textarea readonly class="form-control" id="hallazgos_patologicos" name="hallazgos_patologicos" rows="9"><?=$resultado_lab?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class = "form-group text-left">
                                        <label class="control-label">Otros</label>
                                        <textarea class="form-control" id="otros_conclusiones" name="otros_conclusiones" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- DIAGNÓSTICO -->
                        <div class="tab-pane" id="diagnostico" role="tabpanel">         
                            <div class="row p-20">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Diagnósticos Definitivos</label>
                                        <div class="input-group">
                                            <div class="table-responsive">  
                                                <table style="border: hidden" id="d_definitivo" class="col-md-12">  
                                                    <tr id="rowd1">
                                                        <td width="200">
                                                            <input type="text" name="codigo_cie2[]" id="codigo_cie2_1" class="form-control" placeholder="CIE10" readonly/>
                                                        </td>  
                                                        <td width="800">
                                                            <input type="text" name="diagnostico_definitivo[]" id="diagnostico_definitivo_1" placeholder="Diagnóstico" class="form-control input_dd"/>
                                                        </td>  
                                                        <td>
                                                            <input id="id_diagnostico_d_1" name="id_diagnostico_d[]" type='hidden'>
                                                        </td>
                                                        <td>
                                                            <button type="button" name="add2" id="add2" class="btn btn-success">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </td> 
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class = "form-group text-left">
                                        <label class="control-label">Recomendaciones / Observaciones / Restricciones</label>
                                        <textarea class="form-control" id="recomendaciones" name="recomendaciones" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Estado <span class="text-danger">*</span></label>
                                        <select required class="form-control custom-select" id="estado_diagnostico" name="estado_diagnostico" data-placeholder="" tabindex="1">
                                            <option value="">--</option>
                                            <option value="1">Apto</option>
                                            <option value="2">Apto con Restricciones</option>
                                            <option value="3">No Apto</option>
                                        </select>
                                    </div>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                    <!--TERMINA EL TAB-->

                    <hr>

                    <div class="col-md-12 text-right">                              
                        <button type="submit" id="guardar_examen_medicina_general" class="btn waves-effect waves-light btn-bloc btn-success">
                            <i class="mdi mdi-content-save"></i> GUARDAR
                        </button>
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