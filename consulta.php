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


    //DATOS DE LA HISTORIA------------------------------------------------------------------------------------------------
    $sql = "SELECT P.DES_ALER_CIRU, P.DES_ANTE_ALERGIAS, P.DES_ANTE_FAMILIARES, A.COD_EXPEDIENTE,
            H.DES_TIEMPO_ENF, H.DES_MOTIVO_CONS, H.DES_FUNCIONES, H.DES_SED, H.DES_APETITO,
            H.DES_SUENO, H.DES_RITMO_URINARIO, H.DES_RITMO_EVACUA, H.DES_EXAMEN_GENERAL,
            H.DES_EXAMEN_PREFERENTE, H.DES_OBSERVACIONES, H.FEC_PROXIMA_CITA, H.MEDIDAS_HIGIENICAS
            FROM $BD..ADM_ATENCION A 
            INNER JOIN $BD..HCE_CONSULTA_EXTERNA H ON H.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..ADM_PACIENTE P ON P.COD_PACIENTE = H.COD_PACIENTE
            WHERE A.COD_ATENCION = $cod_atencion";
	$res = sqlsrv_query($conn, $sql);
	$row = sqlsrv_fetch_array($res);

    $COD_EXPEDIENTE = $row['COD_EXPEDIENTE'];
    if($row['DES_ALER_CIRU'] == null || $row['DES_ALER_CIRU'] == ""){ $DES_ANTECEDENTES = "NINGUNO"; } 
    else { $DES_ANTECEDENTES = strtoupper($row['DES_ALER_CIRU']); }
    if($row['DES_ANTE_ALERGIAS'] == null || $row['DES_ANTE_ALERGIAS'] == ""){ $DES_ANTE_ALERGIAS = "NINGUNO"; } 
    else { $DES_ANTE_ALERGIAS = strtoupper($row['DES_ANTE_ALERGIAS']); }
    if($row['DES_ANTE_FAMILIARES'] == null || $row['DES_ANTE_FAMILIARES'] == ""){ $DES_ANTE_FAMILIARES = "NINGUNO"; } 
    else { $DES_ANTE_FAMILIARES = strtoupper($row['DES_ANTE_FAMILIARES']); }

    $DES_TIEMPO_ENF = $row['DES_TIEMPO_ENF'];
    if($DES_TIEMPO_ENF == null || $DES_TIEMPO_ENF == ''){
        $cantidad = ''; 
        $tiempo = '';
    } else {
        $dividir = explode(" ", $DES_TIEMPO_ENF);
        $cantidad = $dividir[0]; 
        $tiempo = $dividir[1];
    }    
    $DES_MOTIVO_CONS = strtoupper($row['DES_MOTIVO_CONS']);
    $DES_FUNCIONES = strtoupper($row['DES_FUNCIONES']);
    $DES_SED = $row['DES_SED'];
    $DES_APETITO = $row['DES_APETITO'];
    $DES_SUENO = $row['DES_SUENO'];
    $DES_RITMO_URINARIO = $row['DES_RITMO_URINARIO'];
    $DES_RITMO_EVACUA = $row['DES_RITMO_EVACUA'];


    $DES_EXAMEN_GENERAL = $row['DES_EXAMEN_GENERAL'];
    if (strpos($DES_EXAMEN_GENERAL, 'LUCIDO, ORIENTADO EN TIEMPO, ESPACIO Y PERSONA. ') === false) { 
        $lotep = ""; $des_examen_genera1 = $des_examen_general; 
    } else { 
        $lotep = "checked"; $des_examen_genera1 = substr($des_examen_general, 48); 
    }



    $DES_EXAMEN_PREFERENTE = strtoupper($row['DES_EXAMEN_PREFERENTE']);
    $DES_OBSERVACIONES = strtoupper($row['DES_OBSERVACIONES']);
    //$FEC_PROXIMA_CITA = $row['FEC_PROXIMA_CITA'];
    $MEDIDAS_HIGIENICAS = strtoupper($row['MEDIDAS_HIGIENICAS']);


    //DATOS DE TRIAJE----------------------------------------------------------------------------------------------
    $sql_triaje = "SELECT DISTINCT H.DES_TALLA, H.DES_PESO, H.DES_IMC, H.DES_FRE_RESPIRA, H.DES_FRE_CARDIACA, 
                   H.DES_PRESION_ARTERIAL, H.DES_TEMPERATURA, CONCAT(P.APE_PATERNO,' ',P.APE_MATERNO,' ',P.NOM_PACIENTE) AS PACIENTE,
                   P.NUM_HC, P.COD_PACIENTE, DATEDIFF(YEAR,P.FEC_NACIMIENTO,GETDATE()) AS EDAD, P.DES_GENERO
                   FROM $BD..HCE_CONSULTA_EXTERNA H
                   INNER JOIN $BD..ADM_ATENCION A ON A.COD_ATENCION = H.COD_ATENCION
                   INNER JOIN $BD..ADM_PACIENTE P ON P.COD_PACIENTE = H.COD_PACIENTE
                   WHERE A.COD_EXPEDIENTE = $COD_EXPEDIENTE AND H.DES_TALLA IS NOT NULL AND H.DES_PESO IS NOT NULL 
                   AND H.DES_IMC IS NOT NULL AND H.DES_FRE_RESPIRA IS NOT NULL AND H.DES_FRE_CARDIACA IS NOT NULL 
                   AND H.DES_PRESION_ARTERIAL IS NOT NULL AND H.DES_TEMPERATURA IS NOT NULL";
    $res_triaje = sqlsrv_query($conn, $sql_triaje);
    $row_triaje = sqlsrv_fetch_array($res_triaje);

    $DES_TALLA = $row_triaje['DES_TALLA'];
    $DES_PESO = $row_triaje['DES_PESO'];
    $DES_IMC = $row_triaje['DES_IMC'];
    $DES_FRE_RESPIRA = $row_triaje['DES_FRE_RESPIRA'];
    $DES_FRE_CARDIACA = $row_triaje['DES_FRE_CARDIACA'];
    $DES_PRESION_ARTERIAL = $row_triaje['DES_PRESION_ARTERIAL'];
    $DES_TEMPERATURA = $row_triaje['DES_TEMPERATURA'];
    $NUM_HC = $row_triaje['NUM_HC'];
    $COD_PACIENTE = $row_triaje['COD_PACIENTE'];
    $PACIENTE = strtoupper($row_triaje['PACIENTE']);
    $EDAD = $row_triaje['EDAD'];
    if($row_triaje['DES_GENERO'] == "MA"){ $DES_GENERO = "MASCULINO"; } else { $DES_GENERO = "FEMENINO"; }

?>

    <div class="row">
        <div class="col-md-9">
            <form method="post" id="guardar_consulta" name="guardar_consulta">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">CONSULTA EXTERNA</h4>

                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#enfermedad" role="tab">
                                    <span class="hidden-sm-up"></span> <span class="hidden-xs-down">ENFERMEDAD</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#antecedentes" role="tab">
                                    <span class="hidden-sm-up"></span> <span class="hidden-xs-down">ANTECEDENTES</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#examenfisico" role="tab">
                                    <span class="hidden-sm-up"></span> <span class="hidden-xs-down">EXAMEN FISICO</span>
                                </a>
                            </li>                         
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#diagnostico" role="tab">
                                    <span class="hidden-sm-up"></span> <span class="hidden-xs-down">DIAGNOSTICO</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#plandetrabajo" role="tab">
                                    <span class="hidden-sm-up"></span> <span class="hidden-xs-down">PLAN DE TRABAJO</span>
                                </a>
                            </li> 
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tratamiento" role="tab">
                                    <span class="hidden-sm-up"></span> <span class="hidden-xs-down">TRATAMIENTO</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#observaciones" role="tab">
                                    <span class="hidden-sm-up"></span> <span class="hidden-xs-down">OBSERVACIONES</span>
                                </a>
                            </li>
                        </ul>

                        <!-- empieza el tab-->
                        <div class="tab-content tabcontent-border text-left">
                            <!--ENFERMEDAD-->
                            <div class="tab-pane active" id="enfermedad" role="tabpanel">                               
                                <div class="p-30">                                       
                                    <div class="row">                                           
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Tiempo de Enfermedad</label>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" id="t_enfermedad" name="t_enfermedad" class="form-control" value="<?=$cantidad?>">
                                                        <input type="hidden" id="cod_atencion" name="cod_atencion" value="<?=$cod_atencion?>">
                                                        <input type="hidden" id="cod_paciente" name="cod_paciente" value="<?=$COD_PACIENTE?>">
                                                        <input type="hidden" id="sucursal" name="sucursal" value="<?=$sucursal?>">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select class="form-control custom-select" id="des_tiempo" name="des_tiempo">
                                                        <option value="" <?php if($tiempo == ''){ echo "selected"; } ?>>--</option>
                                                        <option value="horas" <?php if($tiempo == 'horas'){ echo "selected"; } ?>>Horas</option>
                                                        <option value="dias" <?php if($tiempo == 'dias'){ echo "selected"; } ?>>Días</option>
                                                        <option value="meses" <?php if($tiempo == 'meses'){ echo "selected"; } ?>>Meses</option>
                                                        <option value="años" <?php if($tiempo == 'años'){ echo "selected"; } ?>>Años</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="control-label">Motivo de Consulta <span class="text-danger">*</span></label>
                                                <input required type="text" id="motivo" name="motivo" class="form-control" value="<?=$DES_MOTIVO_CONS?>">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Signos y Síntomas Principales <span class="text-danger">*</span></label>
                                                <textarea required class="form-control" id="funciones" name="funciones" rows="2"><?=$DES_FUNCIONES?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">Sed <span class="text-danger"></span></label>
                                                <select class="form-control custom-select" id="sed" name="sed" data-placeholder="Choose a Category" tabindex="1">
                                                    <option value="" <?php if($DES_SED == "" || $DES_SED == null){ echo "selected"; }?>>--</option>
                                                    <option value="1" <?php if($DES_SED == "1"){ echo "selected"; }?>>Disminuido</option>
                                                    <option value="2" <?php if($DES_SED == "2"){ echo "selected"; }?>>Normal</option>
                                                    <option value="3" <?php if($DES_SED == "3"){ echo "selected"; }?>>Aumentado</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">Apetito <span class="text-danger"></span></label>
                                                <select class="form-control custom-select" id="apetito" name="apetito" data-placeholder="Choose a Category" tabindex="1">
                                                    <option value="" <?php if($DES_APETITO == "" || $DES_APETITO == null){ echo "selected"; }?>>--</option>
                                                    <option value="1" <?php if($DES_APETITO == "1"){ echo "selected"; }?>>Disminuido</option>
                                                    <option value="2" <?php if($DES_APETITO == "2"){ echo "selected"; }?>>Normal</option>
                                                    <option value="3" <?php if($DES_APETITO == "3"){ echo "selected"; }?>>Aumentado</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">Sueño <span class="text-danger"></span></label>
                                                <select class="form-control custom-select" id="sueno" name="sueno" data-placeholder="Choose a Category" tabindex="1">
                                                    <option value="" <?php if($DES_SUENO == "" || $DES_SUENO == null){ echo "selected"; }?>>--</option>
                                                    <option value="1" <?php if($DES_SUENO == "1"){ echo "selected"; }?>>Disminuido</option>
                                                    <option value="2" <?php if($DES_SUENO == "2"){ echo "selected"; }?>>Normal</option>
                                                    <option value="3" <?php if($DES_SUENO == "3"){ echo "selected"; }?>>Aumentado</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Ritmo Urinario <span class="text-danger"></span></label>
                                                <select class="form-control custom-select" id="ritmo_urinario" name="ritmo_urinario" data-placeholder="Choose a Category" tabindex="1">
                                                    <option value="" <?php if($DES_RITMO_URINARIO == "" || $DES_RITMO_URINARIO == null){ echo "selected"; }?>>--</option>
                                                    <option value="1" <?php if($DES_RITMO_URINARIO == "1"){ echo "selected"; }?>>Disminuido</option>
                                                    <option value="2" <?php if($DES_RITMO_URINARIO == "2"){ echo "selected"; }?>>Normal</option>
                                                    <option value="3" <?php if($DES_RITMO_URINARIO == "3"){ echo "selected"; }?>>Aumentado</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Ritmo Evacuatorio <span class="text-danger"></span></label>
                                                <select class="form-control custom-select" id="ritmo_evacuatorio" name="ritmo_evacuatorio" data-placeholder="Choose a Category" tabindex="1">
                                                    <option value="" <?php if($DES_RITMO_EVACUA == "" || $DES_RITMO_EVACUA == null){ echo "selected"; }?>>--</option>
                                                    <option value="1" <?php if($DES_RITMO_EVACUA == "1"){ echo "selected"; }?>>Disminuido</option>
                                                    <option value="2" <?php if($DES_RITMO_EVACUA == "2"){ echo "selected"; }?>>Normal</option>
                                                    <option value="3" <?php if($DES_RITMO_EVACUA == "3"){ echo "selected"; }?>>Aumentado</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>                                   
                                </div>
                            </div>

                            <!--ANTECEDENTES-->
                            <div class="tab-pane" id="antecedentes" role="tabpanel">
                                <div class="p-30">
                                    <div class="row">                                                                
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="control-label">Antecedentes Personales <span class="text-danger">*</span></label>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="custom-control custom-checkbox col-sm-2">
                                                            <input type="checkbox" class="custom-control-input" name="checkbox11" id="checkbox11" value="Ninguno" onchange="javascript:showContent_ap()" >
                                                            <label class="custom-control-label" for="checkbox11">Ninguno</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="row" id="ap" style="display: block;">
                                                                <textarea id="antecedentes_personales" name="antecedentes_personales" class="form-control" rows="3"><?=$DES_ANTECEDENTES?></textarea>
                                                            </div>

                                                            <div class="row" id="ap_v" style="display: none;">
                                                                <textarea disabled id="1" name="1" class="form-control" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="control-label">Antecedentes Alergias <span class="text-danger">*</span></label>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="custom-control custom-checkbox col-sm-2">
                                                            <input type="checkbox" class="custom-control-input" name="checkbox12" id="checkbox12" value = "Ninguno" onchange="javascript:showContent_aa()"  >
                                                            <label class="custom-control-label" for="checkbox12">Ninguno</label>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="row" id="aa" style="display: block;">
                                                                <textarea id="antecedentes_alergias" name="antecedentes_alergias" class="form-control" rows="3"><?=$DES_ANTE_ALERGIAS?></textarea>
                                                            </div>

                                                            <div class="row" id="aa_v" style="display: none;">
                                                                <textarea disabled id="2" name="2" class="form-control" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="control-label">Antecedentes Familiares <span class="text-danger">*</span></label>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="custom-control custom-checkbox col-sm-2">
                                                            <input type="checkbox" class="custom-control-input" name="checkbox13" id="checkbox13" value="Ninguno" onchange="javascript:showContent_af()" >
                                                            <label class="custom-control-label" for="checkbox13">Ninguno</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="row" id="af" style="display: block;">
                                                                <textarea id="antecedentes_familiares" name="antecedentes_familiares" class="form-control" rows="3"><?=$DES_ANTE_FAMILIARES?></textarea>
                                                            </div>

                                                            <div class="row" id="af_v" style="display: none;">
                                                                <textarea disabled id="3" name="3" class="form-control" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- EXAMEN FISICO -->
                            <div class="tab-pane" id="examenfisico" role="tabpanel">
                                <div class="p-30">
                                    <div class="row">                                              
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Frecuencia cardiaca <small>(por minuto)</small></label>
                                                <input readonly type="text" id="frecuencia_cardiaca" name="frecuencia_cardiaca" class="form-control" value="<?=$DES_FRE_CARDIACA?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Frecuencia respiratoria <small>(por minuto)</small></label>
                                                <input readonly type="text" id="frecuencia_respiratoria" name="frecuencia_respiratoria" class="form-control" value="<?=$DES_FRE_RESPIRA?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Presión arterial <small>(mmHg)</small></label>
                                                <input readonly type="text" id="presion" name="presion" class="form-control" value="<?=$DES_PRESION_ARTERIAL?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Temperatura <small>(°C)</small></label>
                                                <input readonly type="text" id="temperatura" name="temperatura" class="form-control" value="<?=$DES_TEMPERATURA?>">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">Peso<small>(kg)</small></label>
                                                <input readonly type="text" id="peso" name="peso" class="form-control" value="<?=$DES_PESO?>">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">Talla <small>(m)</small></label>
                                                <input readonly type="text" id="talla" name="talla" class="form-control" value="<?=$DES_TALLA?>">
                                            </div>
                                        </div>                         

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">IMC</label>
                                                <input readonly type="text" id="imc" name="imc" class="form-control" value="<?=$DES_IMC?>">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label class="control-label">Examen General</label>
                                                    </div>
              
                                                    <div class="custom-control custom-checkbox col-md-2">
                                                        <input type="checkbox" class="custom-control-input"  name="lotepc" id="lotepc" value = "lotepc">
                                                        <label class="custom-control-label" for="lotepc">LOTEP</label>
                                                    </div>

                                                    <div class="custom-control custom-radio col-sm-1">
                                                        <input type="radio" class="custom-control-input" name="exa_ge" id="abegc" value = "abegc">
                                                        <label class="custom-control-label" for="abegc">ABEG</label>
                                                    </div>        

                                                    <div class="custom-control custom-radio col-sm-1">
                                                        <input type="radio" class="custom-control-input" name="exa_ge" id="aregc" value = "aregc">
                                                        <label class="custom-control-label" for="aregc">AREG</label>
                                                    </div>

                                                    <div class="custom-control custom-radio col-sm-1">
                                                        <input type="radio" class="custom-control-input" name="exa_ge" id="amegc" value = "amegc" >
                                                        <label class="custom-control-label" for="amegc">AMEG</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="row" id="vacio" style="display: block;">
                                                            <textarea class="form-control" id="examen_general" name="examen_general" rows="3"><?=$DES_EXAMEN_GENERAL?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                                    

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Examen Preferencial</label>
                                                <textarea class="form-control" id="examen_preferencial" name="examen_preferencial" rows="3"><?=$DES_EXAMEN_PREFERENTE?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- DIAGNOSTICO -->                                
                            <div class="tab-pane" id="diagnostico" role="tabpanel">
                                <div class="p-30">
                                    <div class="row">                                
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h4 class="box-title">Diagnósticos Presuntivos <span class="text-danger">*</span></h4>
                                                <div class="input-group">
                                                    <div class="table-responsive">  
                                                        <table style="border: hidden" class="col-md-12">    
                                                            <tr>
                                                                <td style="width: 100%">
                                                                    <input type="text" name="d_presuntivo" id="d_presuntivo" placeholder="Diagnóstico" class="form-control"/>
                                                                </td>
                                                            </tr>                                                            
                                                        </table>  
                                                    </div>
                                                    <div class="table-responsive" id="diagnosticos_presuntivos"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h4 class="box-title">Diagnósticos Definitivos</h4>
                                                <div class="input-group">
                                                    <div class="table-responsive">  
                                                        <table style="border: hidden" class="col-md-12">  
                                                            <tr>
                                                                <td style="width: 100%">
                                                                    <input type="text" name="d_definitivo" id="d_definitivo" placeholder="Diagnóstico" class="form-control"/>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="table-responsive" id="diagnosticos_definitivos"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                                
                                </div>
                            </div>

                            <!-- PLAN DE TRABAJO -->
                            <div class="tab-pane" id="plandetrabajo" role="tabpanel">
                                <div class="p-30">                                                                        
                                    <div class="row">                                                                            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Exámenes de Laboratorio</label>
                                                <div class="input-group">
                                                    <div class="table-responsive">  
                                                        <table style="border: hidden" class="col-md-12">  
                                                            <tr>  
                                                                <td><input type="text" name="examen_laboratorio" id="examen_laboratorio" class="form-control"/></td>
                                                            </tr>  
                                                        </table>  
                                                    </div>
                                                    <div class="table-responsive" id="examenes_laboratorio"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Exámenes Radiológicos</label>
                                                <div class="table-responsive">  
                                                    <table style="border: hidden" class="col-md-12">  
                                                        <tr>                                                         
                                                             <td><input type="text" name="examen_radiologico" id="examen_radiologico" class="form-control"/></td>
                                                        </tr>  
                                                    </table>  
                                                </div>
                                                <div class="table-responsive" id="examenes_radiologicos"></div>
                                            </div>
                                        </div>                            

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Procedimiento Especiales</label> 
                                                <div class="table-responsive">  
                                                    <table style="border: hidden" class="col-md-12">  
                                                        <tr> 
                                                            <td><input type="text" name="procedimiento_especial" id="procedimiento_especial" class="form-control"/></td>
                                                        </tr>  
                                                    </table>  
                                                </div>
                                                <div class="table-responsive" id="procedimientos_especiales"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Interconsultas</label>
                                                <div class="table-responsive">
                                                    <table style="border: hidden" class="col-md-12">
                                                        <tr>     
                                                            <td><input type="text" name="interconsulta" id="interconsulta"  class="form-control"/></td>
                                                        </tr>  
                                                    </table>  
                                                </div>
                                                <div class="table-responsive" id="interconsultas"></div>
                                            </div>                    
                                        </div>                                                                    
                                    </div>
                                </div>
                            </div>

                            <!-- TRATAMIENTO -->                                   
                            <div class="tab-pane" id="tratamiento" role="tabpanel">
                                <div class="p-30">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group"> 
                                                <div class="table-responsive">  
                                                    <table style="border: hidden" class="col-md-12">  
                                                        <tr>
                                                            <td width="800"><input type="text" name="medicamento" id="medicamento" class="form-control" placeholder="Nombre Medicamento"/></td>  
                                                            <td width="200"><input type="text" name="forma" id="forma" placeholder="Forma" class="form-control"/></td>  
                                                            <td rowspan="2"><button type="button" class="btn btn-block btn-success" style="height: 70px" onclick="guardar_tratamiento()"><i class="fa fa-plus"></i></button></td> 
                                                        </tr>
                                                        <tr>
                                                            <td width="800"><input type="text" name="dosis" id="dosis" class="form-control" placeholder="Dosis"/></td>  
                                                            <td width="200"><input type="text" name="cantidad" id="cantidad" placeholder="Cantidad" class="form-control"/></td>  
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="table-responsive" id="tratamientos"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Medidas Higiénico Dietéticas <span class="text-danger">*</span></label>
                                                <textarea class="form-control" id="medidas_higienicas" name="medidas_higienicas" rows="3"><?=$MEDIDAS_HIGIENICAS?></textarea>
                                            </div>
                                        </div>                                                
                                    </div>                                                
                                </div>
                            </div>

                            <!-- OBSERVACIONES -->
                            <div class="tab-pane" id="observaciones" role="tabpanel">
                                <div class="p-30">
                                    <div class="row">                                            
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Observaciones</label>
                                                <textarea class="form-control" id="observacion" name="observacion" rows="3"><?=$DES_OBSERVACIONES?></textarea>
                                            </div>                                                
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Próxima Cita</label>
                                                <input type="date" min="<?php echo date("Y-m-d");?>" id="fecha_proximacita" name="fecha_proximacita" class="form-control">   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- FIN DEL TAB-->                                
                            <hr>

                            <div class="col-md-12 text-right">                              
                                <button type="submit" id="guardar_datos" class="btn waves-effect waves-light btn-bloc btn-success">
                                    <i class="mdi mdi-content-save"></i> GUARDAR</button>
                                <div id="resultados_ajax"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">DATOS DEL PACIENTE</h4>

                    <div class = "row" >
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Apellidos y Nombres</label>
                                <input readonly type="text" id="apellidos_nombres" name="apellidos_nombres" class="form-control" value="<?=$PACIENTE?>">  
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Documento de Identidad</label>
                                <input readonly type="text" id="documento_identidad" name="documento_identidad" class="form-control" value="<?=$NUM_HC?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Edad</label>
                                <input readonly type="text" id="edad" name="edad" class="form-control" value="<?=$EDAD?>">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label">Sexo</label>
                                <input readonly type="text" id="sexo" name="sexo" class="form-control" value="<?=$DES_GENERO?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once "parte_inferior.php"; ?>
<link rel="stylesheet" href="//code.jquery.com/ui/jquery-ui-git.css">
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="js/vista_medico.js"></script>
