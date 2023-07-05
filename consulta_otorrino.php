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
            DATEDIFF(YEAR,P.FEC_NACIMIENTO,GETDATE()) AS EDAD, P.DES_GENERO, SO.OTITIS_CRONICA, SO.TEC, 
            SO.PAROTIDITIS, SO.WALKMAN, SO.OTOTOXICIDAD, SO.MENINGITIS, SO.SARAMPION, SO.TRAUMA_AUDITIVO,
            SO.TAMPONES, SO.OREJERAS, SO.ALGODONES, SO.OTROS, SO.ACUFENOS, SO.VERTIGO, SO.HIPOACUSIA, 
            SO.OTALGIA, SO.EXPOSICION_RECIENTE, SO.PRACTICAS_RUIDOSAS, SO.OIDO, SO.OTOSCOPIA_DER, 
            SO.OTOSCOPIA_IZQ, SO.DIAGNOSTICO, SO.NIVEL_RUIDO, SO.HORAS_EXPOSICION, SO.RECOMENDACIONES
            FROM $BD..ADM_ATENCION A
            INNER JOIN $BD..SO_EVALUACION_AUDIOMETRICA SO ON SO.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..HCE_CONSULTA_EXTERNA H ON H.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..ADM_PACIENTE P ON P.COD_PACIENTE = H.COD_PACIENTE
            WHERE A.COD_ATENCION = $cod_atencion";
    $res = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($res);

    $NUM_HC = $row['NUM_HC'];
    $PACIENTE = strtoupper($row['PACIENTE']);
    $EDAD = $row['EDAD'];
    if($row['DES_GENERO'] == "MA"){ $DES_GENERO = "MASCULINO"; } else { $DES_GENERO = "FEMENINO"; }
    $OTITIS_CRONICA = $row['OTITIS_CRONICA'];
    $TEC = $row['TEC'];
    $PAROTIDITIS = $row['PAROTIDITIS'];
    $WALKMAN = $row['WALKMAN'];
    $OTOTOXICIDAD = $row['OTOTOXICIDAD'];
    $MENINGITIS = $row['MENINGITIS'];
    $SARAMPION = $row['SARAMPION'];
    $TRAUMA_AUDITIVO = $row['TRAUMA_AUDITIVO'];
    $TAMPONES = $row['TAMPONES'];
    $OREJERAS = $row['OREJERAS'];
    $ALGODONES = $row['ALGODONES'];
    $OTROS = $row['OTROS'];
    $ACUFENOS = $row['ACUFENOS'];
    $VERTIGO = $row['VERTIGO'];
    $HIPOACUSIA = $row['HIPOACUSIA'];
    $OTALGIA = $row['OTALGIA'];
    $EXPOSICION_RECIENTE = $row['EXPOSICION_RECIENTE'];
    $PRACTICAS_RUIDOSAS = $row['PRACTICAS_RUIDOSAS'];
    $OIDO = $row['OIDO'];
    $OTOSCOPIA_DER = $row['OTOSCOPIA_DER'];
    $OTOSCOPIA_IZQ = $row['OTOSCOPIA_IZQ'];
    $DIAGNOSTICO = $row['DIAGNOSTICO'];
    $NIVEL_RUIDO = $row['NIVEL_RUIDO'];
    $HORAS_EXPOSICION = $row['HORAS_EXPOSICION'];
    $RECOMENDACIONES = $row['RECOMENDACIONES'];

    
?>

<!-- AQUI EMPIEZA EL CUERPO -->
<div class="row">                  
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">FICHA DE EVALUACIÓN AUDIOMÉTRICA</h4>        

                <form method="post" id="guardar_datos_evaluacion_audiometrica" name="guardar_datos_evaluacion_audiometrica">
                    <div class="row p-20">
                        <div class="col-md-12">
                            <div class = "form-group text-left">
                                <label class="control-label"><h5>ANTECEDENTES O.R.L.</h5></label>
                                <input type="hidden" id="cod_atencion" name="cod_atencion" class="form-control" value="<?=$cod_atencion?>">
                                <input type="hidden" id="sucursal" name="sucursal" class="form-control" value="<?=$sucursal?>">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ANTECEDENTES</th>
                                        <th class="text-center">SI</th>
                                        <th class="text-center">NO</th>
                                        <th>ANTECEDENTES</th>
                                        <th class="text-center">SI</th>
                                        <th class="text-center">NO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Otitis Crónica:</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="otitis_cronica" id="otitis_cronica_si" value="1" <?php if($OTITIS_CRONICA == 1){ echo "checked"; }?>>                 
                                                <label class="custom-control-label" for="otitis_cronica_si"></label></label>
                                            </div> 
                                        </td>
                                        <td class="text-center">
                                            <div class="custom-control custom-radio">
                                                <input  required type="radio" class="custom-control-input" name="otitis_cronica" id="otitis_cronica_no" value="0" <?php if($OTITIS_CRONICA == 0){ echo "checked"; }?>>
                                                <label class="custom-control-label" for="otitis_cronica_no"></label></label>
                                            </div>  
                                        </td>
                                        <td>Ototoxicidad:</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="ototoxicidad" id="ototoxicidad_si" value="1" <?php if($OTOTOXICIDAD == 1){ echo "checked"; }?>>
                                                <label class="custom-control-label" for="ototoxicidad_si"></label></label>
                                            </div> 
                                        </td>
                                        <td class="text-center">
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="ototoxicidad" id="ototoxicidad_no" value="0" <?php if($OTOTOXICIDAD == 0){ echo "checked"; }?>>
                                                <label class="custom-control-label" for="ototoxicidad_no"></label></label>
                                            </div>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>T.E.C.</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="tec" id="tec_si" value="1" <?php if($TEC == 1){ echo "checked"; }?>>                 
                                                <label class="custom-control-label" for="tec_si"></label></label>
                                            </div> 
                                        </td>
                                        <td class="text-center">
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="tec" id="tec_no" value="0" <?php if($TEC == 0){ echo "checked"; }?>>
                                                <label class="custom-control-label" for="tec_no"></label></label>
                                            </div>  
                                        </td>
                                        <td>Meningitis:</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="meningitis" id="meningitis_si" value="1" <?php if($MENINGITIS == 1){ echo "checked"; }?>>
                                                <label class="custom-control-label" for="meningitis_si"></label></label>
                                            </div> 
                                        </td>
                                        <td class="text-center">
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="meningitis" id="meningitis_no" value="0" <?php if($MENINGITIS == 0){ echo "checked"; }?>>
                                                <label class="custom-control-label" for="meningitis_no"></label></label>
                                            </div>  
                                        </td>
                                    </tr>                        
                                    <tr>
                                        <td>Parotiditis:</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="parotiditis" id="parotiditis_si" value="1" <?php if($PAROTIDITIS == 1){ echo "checked"; }?>>
                                                <label class="custom-control-label" for="parotiditis_si"></label></label>
                                            </div> 
                                        </td>
                                        <td class="text-center">
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="parotiditis" id="parotiditis_no" value="0" <?php if($PAROTIDITIS == 0){ echo "checked"; }?>>
                                                <label class="custom-control-label" for="parotiditis_no"></label></label>
                                            </div>  
                                        </td>
                                        <td>Sarampión:</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="sarampion" id="sarampion_si" value="1" <?php if($SARAMPION == 1){ echo "checked"; }?>>                 
                                                <label class="custom-control-label" for="sarampion_si"></label></label>
                                            </div> 
                                        </td>
                                        <td class="text-center">
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="sarampion" id="sarampion_no" value="0" <?php if($SARAMPION == 0){ echo "checked"; }?>>
                                                <label class="custom-control-label" for="sarampion_no"></label></label>
                                            </div>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Música coin audífonos:</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="walkman" id="walkman_si" value="1" <?php if($WALKMAN == 1){ echo "checked"; }?>>
                                                <label class="custom-control-label" for="walkman_si"></label></label>
                                            </div> 
                                        </td>
                                        <td class="text-center">
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="walkman" id="walkman_no" value="0" <?php if($WALKMAN == 0){ echo "checked"; }?>>
                                                <label class="custom-control-label" for="walkman_no"></label></label>
                                            </div>  
                                        </td>
                                        <td>Trauma Auditivo:</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="trauma_auditivo" id="trauma_auditivo_si" value="1" <?php if($TRAUMA_AUDITIVO == 1){ echo "checked"; }?>>                 
                                                <label class="custom-control-label" for="trauma_auditivo_si"></label></label>
                                            </div> 
                                        </td>
                                        <td class="text-center">
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="trauma_auditivo" id="trauma_auditivo_no" value="0" <?php if($TRAUMA_AUDITIVO == 0){ echo "checked"; }?>>
                                                <label class="custom-control-label" for="trauma_auditivo_no"></label></label>
                                            </div>  
                                        </td>
                                    </tr>                    
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Protección Auricular personal en áreas de ruido</th>
                                        <th>Tiempo de Uso Siempre (A)<br>En ocasiones (B)<br>Nunca (C)</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr>
                                        <td>Tampones</td>
                                        <td>
                                            <select required class="form-control custom-select" id="tampones" name="tampones" data-placeholder="Choose a Category" tabindex="1">
                                                <option value="" <?php if($TAMPONES == NULL){ echo "selected"; }?>>--</option>
                                                <option value="A" <?php if($TAMPONES == "A"){ echo "selected"; }?>>A</option>
                                                <option value="B" <?php if($TAMPONES == "B"){ echo "selected"; }?>>B</option>
                                                <option value="C" <?php if($TAMPONES == "C"){ echo "selected"; }?>>C</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Orejeras</td>
                                        <td>
                                            <select required class="form-control custom-select" id="orejeras" name="orejeras" data-placeholder="Choose a Category" tabindex="1">
                                                <option value="" <?php if($OREJERAS == NULL){ echo "selected"; }?>>--</option>
                                                <option value="A" <?php if($OREJERAS == "A"){ echo "selected"; }?>>A</option>
                                                <option value="B" <?php if($OREJERAS == "B"){ echo "selected"; }?>>B</option>
                                                <option value="C" <?php if($OREJERAS == "C"){ echo "selected"; }?>>C</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Algodones</td>
                                        <td>
                                            <select required class="form-control custom-select" id="algodones" name="algodones" data-placeholder="Choose a Category" tabindex="1">
                                                <option value="" <?php if($ALGODONES == NULL){ echo "selected"; }?>>--</option>
                                                <option value="A" <?php if($ALGODONES == "A"){ echo "selected"; }?>>A</option>
                                                <option value="B" <?php if($ALGODONES == "B"){ echo "selected"; }?>>B</option>
                                                <option value="C" <?php if($ALGODONES == "C"){ echo "selected"; }?>>C</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Otros</td>
                                        <td>
                                            <select required class="form-control custom-select" id="otros" name="otros" data-placeholder="Choose a Category" tabindex="1">
                                                <option value="" <?php if($OTROS == NULL){ echo "selected"; }?>>--</option>
                                                <option value="A" <?php if($OTROS == "A"){ echo "selected"; }?>>A</option>
                                                <option value="B" <?php if($OTROS == "B"){ echo "selected"; }?>>B</option>
                                                <option value="C" <?php if($OTROS == "C"){ echo "selected"; }?>>C</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12">
                            <div class = "form-group text-left">
                                <label class="control-label"><h5>SINTOMATOLOGÍA ACTUAL</h5></label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SINTOMATOLOGÍA ACTUAL</th>
                                        <th>SI</th>
                                        <th>NO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Acúfenos</td>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="acufenos" id="acufenos_si" value="1" <?php if($ACUFENOS == 1){ echo "checked"; }?>>                 
                                                <label class="custom-control-label" for="acufenos_si"></label></label>
                                            </div> 
                                        </td>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="acufenos" id="acufenos_no" value="0" <?php if($ACUFENOS == 0){ echo "checked"; }?>>
                                                <label class="custom-control-label" for="acufenos_no"></label></label>
                                            </div>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Vértigo</td>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="vertigo" id="vertigo_si" value="1" <?php if($VERTIGO == 1){ echo "checked"; }?>>                 
                                                <label class="custom-control-label" for="vertigo_si"></label></label>
                                            </div> 
                                        </td>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="vertigo" id="vertigo_no" value="0" <?php if($VERTIGO == 0){ echo "checked"; }?>>
                                                <label class="custom-control-label" for="vertigo_no"></label></label>
                                            </div>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hipoacusia</td>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="hipoacusia" id="hipoacusia_si" value="1" <?php if($HIPOACUSIA == 1){ echo "checked"; }?>>                 
                                                <label class="custom-control-label" for="hipoacusia_si"></label></label>
                                            </div> 
                                        </td>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="hipoacusia" id="hipoacusia_no" value="0" <?php if($HIPOACUSIA == 0){ echo "checked"; }?>>
                                                <label class="custom-control-label" for="hipoacusia_no"></label></label>
                                            </div>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Otalgia</td>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="otalgia" id="otalgia_si" value="1" <?php if($OTALGIA == 1){ echo "checked"; }?>>                 
                                                <label class="custom-control-label" for="otalgia_si"></label></label>
                                            </div> 
                                        </td>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="otalgia" id="otalgia_no" value="0" <?php if($OTALGIA == 0){ echo "checked"; }?>>
                                                <label class="custom-control-label" for="otalgia_no"></label></label>
                                            </div>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Exposición reciente a Ruido 14 HORAS Previas</td>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="exposicion_reciente" id="exposicion_reciente_si" value="1" <?php if($EXPOSICION_RECIENTE == 1){ echo "checked"; }?>>                 
                                                <label class="custom-control-label" for="exposicion_reciente_si"></label></label>
                                            </div> 
                                        </td>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="exposicion_reciente" id="exposicion_reciente_no" value="0" <?php if($EXPOSICION_RECIENTE == 0){ echo "checked"; }?>>
                                                <label class="custom-control-label" for="exposicion_reciente_no"></label></label>
                                            </div>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Prácticas Ruidosas: Tiro, Frecuencia de discotecas</td>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="practicas_ruidosas" id="practicas_ruidosas_si" value="1" <?php if($PRACTICAS_RUIDOSAS == 1){ echo "checked"; }?>>                 
                                                <label class="custom-control-label" for="practicas_ruidosas_si"></label></label>
                                            </div> 
                                        </td>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" class="custom-control-input" name="practicas_ruidosas" id="practicas_ruidosas_no" value="0" <?php if($PRACTICAS_RUIDOSAS == 0){ echo "checked"; }?>>
                                                <label class="custom-control-label" for="practicas_ruidosas_no"></label></label>
                                            </div>  
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12">
                            <div class = "form-group text-left">
                                <label class="control-label"><h5>EXAMEN O.R.L.</h5></label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>EXAMEN O.R.L.</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Oído</td>
                                        <td>
                                            <textarea class="form-control" name="oido" id="oido" rows="3"><?=$OIDO?></textarea> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Otoscopía Oído Der.</td>
                                        <td>
                                            <textarea class="form-control" name="otoscopia_der" id="otoscopia_der" rows="3"><?=$OTOSCOPIA_DER?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Otoscopía Oído Izq.</td>
                                        <td>
                                            <textarea class="form-control" name="otoscopia_izq" id="otoscopia_izq" rows="3"><?=$OTOSCOPIA_IZQ?></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">DIAGNÓSTICO</label>
                                <input type="text" id="diagnostico" name="diagnostico" class="form-control" value="<?=$DIAGNOSTICO?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Nivel de Ruido en el Trabajo</label>
                                <select required class="form-control custom-select" id="nivel_ruido" name="nivel_ruido" data-placeholder="Choose a Category" tabindex="1">
                                    <option value="1" <?php if($NIVEL_RUIDO == "1"){ echo "selected"; }?>>Bajo</option>
                                    <option value="2" <?php if($NIVEL_RUIDO == "2"){ echo "selected"; }?>>Medio</option>
                                    <option value="3" <?php if($NIVEL_RUIDO == "3"){ echo "selected"; }?>>Alto</option>
                                </select>  
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">H. Exposición</label>
                                <input type="text" id="horas_exposicion" name="horas_exposicion" class="form-control" value="<?=$HORAS_EXPOSICION?>">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">RECOMENDACIONES</label>
                                <textarea class="form-control" id="recomendaciones" name="recomendaciones" rows="2"><?=$RECOMENDACIONES?></textarea>
                            </div>
                        </div>
                    </div>

                    <hr>
    
                    <div class="col-md-12 text-right">                              
                        <button type="submit" id="guardar_evaluacion_audiometrica" class="btn waves-effect waves-light btn-bloc btn-success "><i class="mdi mdi-content-save"></i> GUARDAR</button>
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