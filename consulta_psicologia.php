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

    $sql = "SELECT P.NUM_HC, CONCAT(P.APE_PATERNO,' ',P.APE_MATERNO,' ',P.NOM_PACIENTE) AS PACIENTE, P.COD_PACIENTE,
            DATEDIFF(YEAR,P.FEC_NACIMIENTO,GETDATE()) AS EDAD, P.DES_GENERO,
            SO.ACCIDENTES_ENFERMEDADES, SO.HABITOS, SO.OTRAS_OBSERVACIONES,
            SO.PRESENTACION, SO.POSTURA,
            SO.DISCURSO_RITMO, SO.DISCURSO_TONO, SO.DISCURSO_ARTICULACION,
            SO.ORIENTACION_TIEMPO, SO.ORIENTACION_ESPACIO, SO.ORIENTACION_PERSONA,
            SO.LUCIDO_ATENTO, SO.PENSAMIENTO, SO.PERCEPCION,
            SO.NIVEL_MEMORIA, SO.INTELIGENCIA, SO.APETITO,
            SO.SUENO, SO.PERSONALIDAD, SO.AFECTIVIDAD,
            SO.CONDUCTA_SEXUAL, SO.AREA_COGNITIVA, SO.AREA_EMOCIONAL, SO.RESULTADO
            FROM $BD..ADM_ATENCION A
            INNER JOIN $BD..SO_INFORME_PSICOLOGICO SO ON SO.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..HCE_CONSULTA_EXTERNA H ON H.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..ADM_PACIENTE P ON P.COD_PACIENTE = H.COD_PACIENTE
            WHERE A.COD_ATENCION = $cod_atencion";
    $res = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($res);

    $NUM_HC = $row['NUM_HC'];
    $COD_PACIENTE = $row['COD_PACIENTE'];
    $PACIENTE = strtoupper($row['PACIENTE']);
    $EDAD = $row['EDAD'];
    if($row['DES_GENERO'] == "MA"){ $DES_GENERO = "MASCULINO"; } else { $DES_GENERO = "FEMENINO"; }

    $ACCIDENTES_ENFERMEDADES = $row['ACCIDENTES_ENFERMEDADES'];
    $HABITOS = $row['HABITOS'];
    $OTRAS_OBSERVACIONES = $row['OTRAS_OBSERVACIONES'];
    $PRESENTACION = $row['PRESENTACION'];
    $POSTURA = $row['POSTURA'];
    $DISCURSO_RITMO = $row['DISCURSO_RITMO'];
    $DISCURSO_TONO = $row['DISCURSO_TONO'];
    $DISCURSO_ARTICULACION = $row['DISCURSO_ARTICULACION'];
    $ORIENTACION_TIEMPO = $row['ORIENTACION_TIEMPO'];
    $ORIENTACION_ESPACIO = $row['ORIENTACION_ESPACIO'];
    $ORIENTACION_PERSONA = $row['ORIENTACION_PERSONA'];
    $LUCIDO_ATENTO = $row['LUCIDO_ATENTO'];
    $PENSAMIENTO = $row['PENSAMIENTO'];
    $PERCEPCION = $row['PERCEPCION'];
    $NIVEL_MEMORIA = $row['NIVEL_MEMORIA'];
    $INTELIGENCIA = $row['INTELIGENCIA'];
    $APETITO = $row['APETITO'];
    $SUENO = $row['SUENO'];
    $PERSONALIDAD = $row['PERSONALIDAD'];
    $AFECTIVIDAD = $row['AFECTIVIDAD'];
    $CONDUCTA_SEXUAL = $row['CONDUCTA_SEXUAL'];
    $AREA_COGNITIVA = $row['AREA_COGNITIVA'];
    $AREA_EMOCIONAL = $row['AREA_EMOCIONAL'];
    $RESULTADO = $row['RESULTADO'];
    
?>

<!-- AQUI EMPIEZA EL CUERPO -->
<div class="row">                  
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">INFORME PSICOLÓGICO</h4>        

                <form method="post" id="guardar_datos_informe_psicologico" name="guardar_datos_informe_psicologico">
                    <div class="row p-20">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label"><h5><strong>ACCIDENTES Y ENFERMEDADES</strong></h5></label>
                                <input type="hidden" id="cod_atencion" name="cod_atencion" value="<?=$cod_atencion?>">
                                <input type="hidden" id="sucursal" name="sucursal" value="<?=$sucursal?>">
                                <textarea class="form-control" id="accidentes_enfermedades" name="accidentes_enfermedades" rows="3"><?=$ACCIDENTES_ENFERMEDADES?></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label"><h5><strong>HÁBITOS</strong></h5></label>
                                <textarea class="form-control" id="habitos" name="habitos" rows="3"><?=$HABITOS?></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label"><h5><strong>OTRAS OBSERVACIONES</strong></h5></label>
                                <textarea class="form-control" id="otras_observaciones" name="otras_observaciones" rows="3"><?=$OTRAS_OBSERVACIONES?></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label"><h5><strong>OBSERVACIÓN DE CONDUCTAS</strong></h5></label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Presentación</label>
                                <select required class="form-control custom-select" id="presentacion" name="presentacion" data-placeholder="Choose a Category" tabindex="1">
                                    <option value="" <?php if($PRESENTACION == NULL || $PRESENTACION == ''){ echo "selected"; }?>>--</option>
                                    <option value="1" <?php if($PRESENTACION == '1'){ echo "selected"; }?>>Adecuada</option>
                                    <option value="2" <?php if($PRESENTACION == '2'){ echo "selected"; }?>>Inadecuada</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Postura</label>
                                <select required class="form-control custom-select" id="postura" name="postura" data-placeholder="Choose a Category" tabindex="1">
                                    <option value="" <?php if($POSTURA == NULL || $POSTURA == ''){ echo "selected"; }?>>--</option>
                                    <option value="1" <?php if($POSTURA == '1'){ echo "selected"; }?>>Erguida</option>
                                    <option value="2" <?php if($POSTURA == '2'){ echo "selected"; }?>>Encorvada</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Discurso Ritmo</label>
                                <select required class="form-control custom-select" id="discurso_ritmo" name="discurso_ritmo" data-placeholder="Choose a Category" tabindex="1">
                                    <option value="" <?php if($DISCURSO_RITMO == NULL || $DISCURSO_RITMO == ''){ echo "selected"; }?>>--</option>
                                    <option value="1" <?php if($DISCURSO_RITMO == '1'){ echo "selected"; }?>>Lento</option>
                                    <option value="2" <?php if($DISCURSO_RITMO == '2'){ echo "selected"; }?>>Rápido</option>
                                    <option value="3" <?php if($DISCURSO_RITMO == '3'){ echo "selected"; }?>>Fluido</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Discurso Tono</label>
                                <select required class="form-control custom-select" id="discurso_tono" name="discurso_tono" data-placeholder="Choose a Category" tabindex="1">
                                    <option value="" <?php if($DISCURSO_TONO == NULL || $DISCURSO_TONO == ''){ echo "selected"; }?>>--</option>
                                    <option value="1" <?php if($DISCURSO_TONO == '1'){ echo "selected"; }?>>Bajo</option>
                                    <option value="2" <?php if($DISCURSO_TONO == '2'){ echo "selected"; }?>>Moderado</option>
                                    <option value="3" <?php if($DISCURSO_TONO == '3'){ echo "selected"; }?>>Alto</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Discurso Articulación</label>
                                <select required class="form-control custom-select" id="discurso_articulacion" name="discurso_articulacion" data-placeholder="Choose a Category" tabindex="1">
                                    <option value="" <?php if($DISCURSO_ARTICULACION == NULL || $DISCURSO_ARTICULACION == ''){ echo "selected"; }?>>--</option>
                                    <option value="1" <?php if($DISCURSO_ARTICULACION == '1'){ echo "selected"; }?>>Con Dificultad</option>
                                    <option value="2" <?php if($DISCURSO_ARTICULACION == '2'){ echo "selected"; }?>>Sin dificultad</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Orientación Tiempo</label>
                                <select required class="form-control custom-select" id="orientacion_tiempo" name="orientacion_tiempo" data-placeholder="Choose a Category" tabindex="1">
                                    <option value="" <?php if($ORIENTACION_TIEMPO == NULL || $ORIENTACION_TIEMPO == ''){ echo "selected"; }?>>--</option>
                                    <option value="1" <?php if($ORIENTACION_TIEMPO == '1'){ echo "selected"; }?>>Orientado</option>
                                    <option value="2" <?php if($ORIENTACION_TIEMPO == '2'){ echo "selected"; }?>>Desorientado</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Orientación Espacio</label>
                                <select required class="form-control custom-select" id="orientacion_espacio" name="orientacion_espacio" data-placeholder="Choose a Category" tabindex="1">
                                    <option value="" <?php if($ORIENTACION_ESPACIO == NULL || $ORIENTACION_ESPACIO == ''){ echo "selected"; }?>>--</option>
                                    <option value="1" <?php if($ORIENTACION_ESPACIO == '1'){ echo "selected"; }?>>Orientado</option>
                                    <option value="2" <?php if($ORIENTACION_ESPACIO == '2'){ echo "selected"; }?>>Desorientado</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Orientación Persona</label>
                                <select required class="form-control custom-select" id="orientacion_persona" name="orientacion_persona" data-placeholder="Choose a Category" tabindex="1">
                                    <option value="" <?php if($ORIENTACION_PERSONA == NULL || $ORIENTACION_PERSONA == ''){ echo "selected"; }?>>--</option>
                                    <option value="1" <?php if($ORIENTACION_PERSONA == '1'){ echo "selected"; }?>>Orientado</option>
                                    <option value="2" <?php if($ORIENTACION_PERSONA == '2'){ echo "selected"; }?>>Desorientado</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label"><h5><strong>PROCESOS COGNITIVOS</strong></h5></label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Lúcido, atento:</label>
                                <input type="text" id="lucido_atento" name="lucido_atento" class="form-control" value="<?=$LUCIDO_ATENTO?>">
                            </div>
                        </div>  

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Pensamiento:</label>
                                <input type="text" id="pensamiento" name="pensamiento" class="form-control" value="<?=$PENSAMIENTO?>">
                            </div>
                        </div>  

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Percepción:</label>
                                <input type="text" id="percepcion" name="percepcion" class="form-control" value="<?=$PERCEPCION?>">
                            </div>
                        </div>  

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Nivel de Memoria</label>
                                <select required class="form-control custom-select" id="nivel_memoria" name="nivel_memoria" data-placeholder="Choose a Category" tabindex="1">
                                    <option value="" <?php if($NIVEL_MEMORIA == NULL || $NIVEL_MEMORIA == ''){ echo "selected"; }?>>--</option>
                                    <option value="1" <?php if($NIVEL_MEMORIA == '1'){ echo "selected"; }?>>Corto plazo</option>
                                    <option value="2" <?php if($NIVEL_MEMORIA == '2'){ echo "selected"; }?>>Mediano plazo</option>
                                    <option value="3" <?php if($NIVEL_MEMORIA == '3'){ echo "selected"; }?>>Largo plazo</option>
                                </select>
                            </div>
                        </div>  

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Inteligencia</label>
                                <select required class="form-control custom-select" id="inteligencia" name="inteligencia" data-placeholder="Choose a Category" tabindex="1">
                                    <option value="" <?php if($INTELIGENCIA == NULL || $INTELIGENCIA == ''){ echo "selected"; }?>>--</option>
                                    <option value="1" <?php if($INTELIGENCIA == '1'){ echo "selected"; }?>>Muy Superior</option>
                                    <option value="2" <?php if($INTELIGENCIA == '2'){ echo "selected"; }?>>Superior</option>
                                    <option value="3" <?php if($INTELIGENCIA == '3'){ echo "selected"; }?>>Normal Brillante</option>
                                    <option value="4" <?php if($INTELIGENCIA == '4'){ echo "selected"; }?>>N.Promedio</option>
                                    <option value="5" <?php if($INTELIGENCIA == '5'){ echo "selected"; }?>>N.Torpe</option>
                                    <option value="6" <?php if($INTELIGENCIA == '6'){ echo "selected"; }?>>Fronterizo</option>
                                    <option value="7" <?php if($INTELIGENCIA == '7'){ echo "selected"; }?>>RM Leve</option>
                                    <option value="8" <?php if($INTELIGENCIA == '8'){ echo "selected"; }?>>RM Moderado</option>
                                    <option value="9" <?php if($INTELIGENCIA == '9'){ echo "selected"; }?>>RM Severo</option>
                                    <option value="10" <?php if($INTELIGENCIA == '10'){ echo "selected"; }?>>RM Profundo</option>
                                </select>
                            </div>
                        </div>  

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Apetito</label>
                                <input type="text" id="apetito" name="apetito" class="form-control" value="<?=$APETITO?>">
                            </div>
                        </div>  

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Sueño</label>
                                <input type="text" id="sueno" name="sueno" class="form-control" value="<?=$SUENO?>">
                            </div>
                        </div>  

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Personalidad</label>
                                <input type="text" id="personalidad" name="personalidad" class="form-control" value="<?=$PERSONALIDAD?>">
                            </div>
                        </div>  

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Afectividad</label>
                                <input type="text" id="afectividad" name="afectividad" class="form-control" value="<?=$AFECTIVIDAD?>">
                            </div>
                        </div>  

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Conducta Sexual</label>
                                <input type="text" id="conducta_sexual" name="conducta_sexual" class="form-control" value="<?=$CONDUCTA_SEXUAL?>">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label"><h5><strong>PRUEBAS PSICOLÓGICAS</strong></h5></label>
                            </div>
                        </div>   

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="table-responsive">
                                    <table style="border: hidden" id="pruebas_psicologicas" class="col-md-12">  
                                        <tr id="row1">
                                            <td width="70%">
                                                <input type="text" name="pruebas[]" id="pruebas_1" class="form-control" placeholder="Pruebas Psicológicas"/>
                                            </td>  
                                            <td width="20%">
                                                <input type="text" name="puntaje[]" id="puntaje_1" placeholder="Puntaje" class="form-control"/>
                                            </td>
                                            <td width="10%">
                                                <button type="button" name="add_p" id="add_p" class="btn btn-block btn-success">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </td>  
                                        </tr>
                                    </table>  
                                </div>     
                            </div> 
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label"><h5><strong>CONCLUSIONES</strong></h5></label>
                            </div>
                        </div>     

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Área Cognitiva</label>  
                                <textarea class="form-control" id="area_cognitiva" name="area_cognitiva" rows="3"><?=$AREA_COGNITIVA?></textarea>
                            </div>
                        </div>  

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Área Emocional</label>  
                                <textarea class="form-control" id="area_emocional" name="area_emocional" rows="3"><?=$AREA_EMOCIONAL?></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label"><h5><strong>RESULTADO</strong></h5></label>
                            </div>
                        </div>   

                        <div class="col-md-8">
                            <div class="form-group">
                                <select required class="form-control custom-select" id="resultado" name="resultado" data-placeholder="Choose a Category" tabindex="1">
                                    <option value="" <?php if($RESULTADO == NULL || $RESULTADO != ''){ echo "selected"; }?>>--</option>
                                    <option value="1" <?php if($RESULTADO == '1'){ echo "selected"; }?>>APTO</option>
                                    <option value="2" <?php if($RESULTADO == '2'){ echo "selected"; }?>>APTO CON RESTRICCIÓN</option>
                                    <option value="3" <?php if($RESULTADO == '3'){ echo "selected"; }?>>NO APTO</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>   

                    <div class="col-md-12 text-right">                              
                        <button type="submit" id="guardar_informe_psicologico" class="btn waves-effect waves-light btn-bloc btn-success "><i class="mdi mdi-content-save"></i> GUARDAR</button>
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