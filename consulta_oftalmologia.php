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
            DATEDIFF(YEAR,P.FEC_NACIMIENTO,GETDATE()) AS EDAD, P.DES_GENERO, P.IND_HIPERTEN, P.IND_PTERIGIUM, 
            P.IND_GLAUCOMA, P.IND_DIABETES, P.IND_CATARATA, P.IND_TRAUMA_OCULAR, P.IND_CORRECTOR_OCULAR,
            P.IND_OTROS_ANTECEDENTES, SO.vl_sc_od, SO.vl_sc_oi, SO.vl_cc_od, SO.vl_cc_oi, SO.vc_sc_od, SO.vc_sc_oi, 
            SO.vc_cc_od, SO.vc_cc_oi, SO.VISION_COLORES_OD, SO.VISION_COLORES_OI, SO.PTOSIS_OD, SO.PTOSIS_OI, 
            SO.PTERIGIUM_OD, SO.PTERIGIUM_OI, SO.BLEFARITIS_OD, SO.BLEFARITIS_OI, SO.CHALAZION_OD, SO.CHALAZION_OI,
            SO.DERMATOCALASIA_OD, SO.DERMATOCALASIA_OI, SO.ESTRABISMO_OD, SO.ESTRABISMO_OI, SO.CONJUNTIVITIS_OD, 
            SO.CONJUNTIVITIS_OI, SO.OTROS_ENFERMEDADES, SO.CAMPIMETRIA_OD, SO.CAMPIMETRIA_OI, SO.REFLEJOS_PUPILARES,
            SO.PRESION_OD, SO.PRESION_OI, SO.DIAGNOSTICO, SO.VISION_PROFUNDIDAD, SO.OBSERVACIONES
            FROM $BD..ADM_ATENCION A
            INNER JOIN $BD..SO_EVALUACION_OFTALMOLOGICA SO ON SO.COD_ATENCION = A.COD_ATENCION
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

    $IND_HIPERTEN = $row['IND_HIPERTEN'];
    $IND_PTERIGIUM = $row['IND_PTERIGIUM'];
    $IND_GLAUCOMA = $row['IND_GLAUCOMA'];
    $IND_DIABETES = $row['IND_DIABETES'];
    $IND_CATARATA = $row['IND_CATARATA'];
    $IND_TRAUMA_OCULAR = $row['IND_TRAUMA_OCULAR'];
    $IND_CORRECTOR_OCULAR = $row['IND_CORRECTOR_OCULAR'];
    $IND_OTROS_ANTECEDENTES = $row['IND_OTROS_ANTECEDENTES'];
    $vl_sc_od = $row['vl_sc_od'];
    $vl_sc_oi = $row['vl_sc_oi'];
    $vl_cc_od = $row['vl_cc_od'];
    $vl_cc_oi = $row['vl_cc_oi'];
    $vc_sc_od = $row['vc_sc_od'];
    $vc_sc_oi = $row['vc_sc_oi'];
    $vc_cc_od = $row['vc_cc_od'];
    $vc_cc_oi = $row['vc_cc_oi'];
    $VISION_COLORES_OD = $row['VISION_COLORES_OD'];
    $VISION_COLORES_OI = $row['VISION_COLORES_OI'];
    $PTOSIS_OD = $row['PTOSIS_OD'];
    $PTOSIS_OI = $row['PTOSIS_OI'];
    $PTERIGIUM_OD = $row['PTERIGIUM_OD'];
    $PTERIGIUM_OI = $row['PTERIGIUM_OI'];
    $BLEFARITIS_OD = $row['BLEFARITIS_OD'];
    $BLEFARITIS_OI = $row['BLEFARITIS_OI'];
    $CHALAZION_OD = $row['CHALAZION_OD'];
    $CHALAZION_OI = $row['CHALAZION_OI'];
    $DERMATOCALASIA_OD = $row['DERMATOCALASIA_OD'];
    $DERMATOCALASIA_OI = $row['DERMATOCALASIA_OI'];
    $ESTRABISMO_OD = $row['ESTRABISMO_OD'];
    $ESTRABISMO_OI = $row['ESTRABISMO_OI'];
    $CONJUNTIVITIS_OD = $row['CONJUNTIVITIS_OD'];
    $CONJUNTIVITIS_OI = $row['CONJUNTIVITIS_OI'];
    $OTROS_ENFERMEDADES = $row['OTROS_ENFERMEDADES'];
    $CAMPIMETRIA_OD = $row['CAMPIMETRIA_OD'];
    $CAMPIMETRIA_OI = $row['CAMPIMETRIA_OI'];
    $REFLEJOS_PUPILARES = $row['REFLEJOS_PUPILARES'];
    $PRESION_OD = $row['PRESION_OD'];
    $PRESION_OI = $row['PRESION_OI'];
    $DIAGNOSTICO = $row['DIAGNOSTICO'];
    $VISION_PROFUNDIDAD = $row['VISION_PROFUNDIDAD'];
    $OBSERVACIONES = $row['OBSERVACIONES'];
    
?>

<!-- AQUI EMPIEZA EL CUERPO -->
<div class="row">                  
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">EVALUACIÓN OFTALMOLÓGICA</h4>        

                <form method="post" id="guardar_datos_evaluacion_oftalmologica" name="guardar_datos_evaluacion_oftalmologica">
                    <div class="row p-20">
                        <div class="col-md-12">
                            <label class="control-label"><h5><strong>ANTECEDENTES</strong></h5></label>
                            <input type="hidden" id="cod_atencion" name="cod_atencion" class="form-control" value="<?=$cod_atencion?>"> 
                            <input type="hidden" id="cod_paciente" name="cod_paciente" class="form-control" value="<?=$COD_PACIENTE?>"> 
                            <input type="hidden" id="sucursal" name="sucursal" class="form-control" value="<?=$sucursal?>"> 
                        </div>

                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="ind_hiperten" id="ind_hiperten" value="1" <?php if($IND_HIPERTEN == '1'){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="ind_hiperten">Hipertensión Arterial</label>
                            </div>  
                        </div>

                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="ind_pterigium" id="ind_pterigium" value="1" <?php if($IND_PTERIGIUM == '1'){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="ind_pterigium">Pterigium</label>
                            </div>  
                        </div>

                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox ">
                                <input type="checkbox" class="custom-control-input" name="ind_glaucoma" id="ind_glaucoma" value="1" <?php if($IND_GLAUCOMA == '1'){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="ind_glaucoma">Glaucoma</label>
                            </div> 
                        </div>

                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox ">
                                <input type="checkbox" class="custom-control-input" name="ind_diabetes" id="ind_diabetes" value="1" <?php if($IND_DIABETES == '1'){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="ind_diabetes">Diabetes</label>
                            </div> 
                        </div>

                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox ">
                                <input type="checkbox" class="custom-control-input" name="ind_catarata" id="ind_catarata" value="1" <?php if($IND_CATARATA == '1'){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="ind_catarata">Catarata</label>
                            </div> 
                        </div>

                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="ind_trauma_ocular" id="ind_trauma_ocular" value="1" <?php if($IND_TRAUMA_OCULAR == '1'){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="ind_trauma_ocular">Traumatismo ocular</label>
                            </div> 
                        </div>
                        
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="ind_corrector_ocular" id="ind_corrector_ocular" value="1" <?php if($IND_CORRECTOR_OCULAR == '1'){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="ind_corrector_ocular">Correctores Oculares</label>
                            </div> 
                        </div>

                        <div class="col-md-12">
                            <label class="col-form-label">Otros</label>
                            <input type="text" id="ind_otros_antecedentes" name="ind_otros_antecedentes" class="form-control" value="<?=$IND_OTROS_ANTECEDENTES?>">
                        </div>                          
                    </div>

                    <hr>

                    <div class="row p-10">
                        <div class="col-md-12">
                            <label class="control-label"><h5><strong>AGUDEZA VISUAL</strong></h5></label>
                        </div>

                        <!-- TABLA AGUDEZA VISUAL -->

                        <div class="col-md-4">
                            <label class="control-label"></label>
                        </div>

                        <div class="col-md-4 text-center" style="border: 1px solid #ECECEC;">
                            <label class="control-label"><b>Sin Corregir</b></label>
                        </div>

                        <div class="col-md-4 text-center" style="border: 1px solid #ECECEC;">
                            <label class="control-label"><b>Corregida</b></label>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label"></label>
                        </div>

                        <div class="col-md-2 text-center">
                            <label class="control-label">Ojo Derecho</label>
                        </div>

                        <div class="col-md-2 text-center">
                            <label class="control-label ">Ojo Izquierdo</label>
                        </div>

                        <div class="col-md-2 text-center">
                            <label class="control-label">Ojo Derecho</label>
                        </div>

                        <div class="col-md-2 text-center">
                            <label class="control-label ">Ojo Izquierdo</label>
                        </div>


                        <div class="col-md-4">
                            <label class="control-label"><b>Visión de Lejos</b></label>
                        </div>

                        <div class="col-md-2">
                             <input type="text" id="vl_sc_od" name="vl_sc_od" class="form-control" value="<?=$vl_sc_od?>">
                        </div>

                        <div class="col-md-2">
                             <input type="text" id="vl_sc_oi" name="vl_sc_oi" class="form-control" value="<?=$vl_sc_oi?>">
                        </div>

                        <div class="col-md-2">
                             <input type="text" id="vl_cc_od" name="vl_cc_od" class="form-control" value="<?=$vl_cc_od?>">
                        </div>

                        <div class="col-md-2">
                             <input type="text" id="vl_cc_oi" name="vl_cc_oi" class="form-control" value="<?=$vl_cc_oi?>">
                        </div>


                        <div class="col-md-4">
                            <label class="control-label"><b>Visión de Cerca</b></label>
                        </div>

                        <div class="col-md-2">
                             <input type="text" id="vc_sc_od" name="vc_sc_od" class="form-control" value="<?=$vc_cc_oi?>">
                        </div>

                        <div class="col-md-2">
                             <input type="text" id="vc_sc_oi" name="vc_sc_oi" class="form-control" value="<?=$vc_cc_oi?>">
                        </div>

                        <div class="col-md-2">
                             <input type="text" id="vc_cc_od" name="vc_cc_od" class="form-control" value="<?=$vc_cc_oi?>">
                        </div>

                        <div class="col-md-2">
                             <input type="text" id="vc_cc_oi" name="vc_cc_oi" class="form-control" value="<?=$vc_cc_oi?>">
                        </div>
                        <!-- FIN AGUDEZA VISUAL -->
                    </div>

                    <hr>

                    <div class="row p-10">
                        <div class="col-md-12">
                            <label class="control-label"><h5><strong>VISIÓN DE COLORES: TEST DE ISHIHARA</strong></h5></label>
                        </div>

                        <div class="col-md-6">
                            <label class="control-label"><b>Ojo Derecho</b></label>
                            <input type="text" id="vision_colores_od" name="vision_colores_od" class="form-control" value="<?=$VISION_COLORES_OD?>">
                        </div>

                        <div class="col-md-6">
                            <label class="control-label"><b>Ojo Izquierdo</b></label>
                            <input type="text" id="vision_colores_oi" name="vision_colores_oi" class="form-control" value="<?=$VISION_COLORES_OI?>">
                        </div>
                    </div>

                    <hr>

                    <div class="row p-10">
                        <div class="col-md-12">
                            <label class="control-label"><h5><strong>ENFERMEDADES OCULARES:</strong></h5></label>
                        </div>

                        <!-- TABLA PATOLOGIA CABEZA-->
                        <div class="col-md-4">
                            <label class="control-label"></label>
                        </div>

                        <div class="col-md-1 ">
                            <label class="control-label">O.D.</label>
                        </div>

                        <div class="col-md-1 ">
                            <label class="control-label">O.I.</label>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label"></label>
                        </div>

                        <div class="col-md-1 ">
                            <label class="control-label">O.D.</label>
                        </div>

                        <div class="col-md-1 ">
                            <label class="control-label">O.I.</label>
                        </div>

                        <!-- TABLA PATOLOGIA BODY-->
                        <div class="col-md-4">
                            <label class="control-label">Ptosis</label>
                        </div>

                        <div class="col-md-1">
                            <div class="custom-control custom-checkbox col-md-2">
                                <input type="checkbox" class="custom-control-input" name="ptosis_od" id="ptosis_od" value="1" <?php if($PTOSIS_OD == 1){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="ptosis_od"></label>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="custom-control custom-checkbox col-md-2">
                                <input type="checkbox" class="custom-control-input" name="ptosis_oi" id="ptosis_oi" value="1" <?php if($PTOSIS_OI == 1){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="ptosis_oi"></label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">Pterigium</label>
                        </div>

                        <div class="col-md-1">
                            <div class="custom-control custom-checkbox col-md-2 ">
                                <input type="checkbox" class="custom-control-input" name="pterigium_od" id="pterigium_od" value="1" <?php if($PTERIGIUM_OD == 1){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="pterigium_od"></label>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="custom-control custom-checkbox col-md-2 ">
                                <input type="checkbox" class="custom-control-input" name="pterigium_oi" id="pterigium_oi" value="1" <?php if($PTERIGIUM_OI == 1){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="pterigium_oi"></label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">Blefaritis</label>
                        </div>

                        <div class="col-md-1">
                            <div class="custom-control custom-checkbox col-md-2">
                                <input type="checkbox" class="custom-control-input" name="blefaritis_od" id="blefaritis_od" value="1" <?php if($BLEFARITIS_OD == 1){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="blefaritis_od"></label>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="custom-control custom-checkbox col-md-2">
                                <input type="checkbox" class="custom-control-input" name="blefaritis_oi" id="blefaritis_oi" value="1" <?php if($BLEFARITIS_OI == 1){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="blefaritis_oi"></label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">Chalazión</label>
                        </div>

                        <div class="col-md-1 ">
                            <div class="custom-control custom-checkbox col-md-2">
                                <input type="checkbox" class="custom-control-input" name="chalazion_od" id="chalazion_od" value="1" <?php if($CHALAZION_OD == 1){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="chalazion_od"></label>
                            </div>
                        </div>

                        <div class="col-md-1 ">
                            <div class="custom-control custom-checkbox col-md-2">
                                <input type="checkbox" class="custom-control-input" name="chalazion_oi" id="chalazion_oi" value="1" <?php if($CHALAZION_OI == 1){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="chalazion_oi"></label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">Dermatocalasia</label>
                        </div>

                        <div class="col-md-1 ">
                            <div class="custom-control custom-checkbox col-md-2">
                                <input type="checkbox" class="custom-control-input" name="dermatocalasia_od" id="dermatocalasia_od" value="1" <?php if($DERMATOCALASIA_OD == 1){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="dermatocalasia_od"></label>
                            </div>
                        </div>

                        <div class="col-md-1 ">
                            <div class="custom-control custom-checkbox col-md-2">
                                <input type="checkbox" class="custom-control-input" name="dermatocalasia_oi" id="dermatocalasia_oi" value="1" <?php if($DERMATOCALASIA_OI == 1){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="dermatocalasia_oi"></label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">Estrabismo</label>
                        </div>

                        <div class="col-md-1 ">
                            <div class="custom-control custom-checkbox col-md-2">
                                <input type="checkbox" class="custom-control-input" name="estrabismo_od" id="estrabismo_od" value="1" <?php if($ESTRABISMO_OD == 1){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="estrabismo_od"></label>
                            </div>
                        </div>

                        <div class="col-md-1 ">
                            <div class="custom-control custom-checkbox col-md-2">
                                <input type="checkbox" class="custom-control-input" name="estrabismo_oi" id="estrabismo_oi" value="1" <?php if($ESTRABISMO_OI == 1){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="estrabismo_oi"></label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">Conjuntivitis</label>
                        </div>

                        <div class="col-md-1 ">
                            <div class="custom-control custom-checkbox col-md-2">
                                <input type="checkbox" class="custom-control-input" name="conjuntivitis_od" id="conjuntivitis_od" value="1" <?php if($CONJUNTIVITIS_OD == 1){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="conjuntivitis_od"></label>
                            </div>
                        </div>

                        <div class="col-md-1 ">
                            <div class="custom-control custom-checkbox col-md-2">
                                <input type="checkbox" class="custom-control-input" name="conjuntivitis_oi" id="conjuntivitis_oi" value="1" <?php if($CONJUNTIVITIS_OI == 1){ echo "checked"; } ?>>
                                <label class="custom-control-label" for="conjuntivitis_oi"></label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="col-form-label">Otros</label>
                        </div>

                        <div class="col-md-2">
                            <input type="text" id="otros_enfermedades" name="otros_enfermedades" class="form-control" value="<?=$OTROS_ENFERMEDADES?>">
                        </div>
                        <!-- FIN TABLA PATOLOGIA -->
                    </div>

                    <hr>

                    <div class="row p-10">
                        <div class="col-md-8">
                            <label class="control-label"><h5><strong>CAMPIMETRÍA POR CONFRONTACIÓN</strong></h5></label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Ojo Derecho</label>
                                        <select class="custom-select form-control" name="campimetria_od" id="campimetria_od">
                                            <option value="" <?php if($CAMPIMETRIA_OD != 1){ echo "selected"; } ?>>--</option>
                                            <option value="1" <?php if($CAMPIMETRIA_OD == 1){ echo "selected"; } ?>>Normal</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Ojo Izquierdo</label>
                                        <select class="custom-select form-control" name="campimetria_oi" id="campimetria_oi">
                                            <option value="" <?php if($CAMPIMETRIA_OI != 1){ echo "selected"; } ?>>--</option>
                                            <option value="1" <?php if($CAMPIMETRIA_OI == 1){ echo "selected"; } ?>>Normal</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label"><h5><strong>REFLEJOS PUPILARES</strong></h5></label>
                            <div class="form-group">
                                <label class="control-label">Reflejos Pupilares</label>
                                <select class="custom-select form-control" name="reflejos_pupilares" id="reflejos_pupilares">
                                    <option value="" <?php if($REFLEJOS_PUPILARES != 1){ echo "selected"; } ?>>--</option>
                                    <option value="1" <?php if($REFLEJOS_PUPILARES == 1){ echo "selected"; } ?>>Normal</option>
                                </select>
                            </div>
                        </div>                        
                    </div>

                    <hr>

                    <div class="row p-10">
                        <div class="col-md-12">
                            <label class="control-label"><h5><strong>PRESIÓN INTRAOCULAR</strong></h5></label>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Ojo Derecho</label>
                                <input type="text" id="presion_od" name="presion_od" class="form-control" value="<?=$PRESION_OD?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Ojo Izquierdo</label>
                                <input type="text" id="presion_oi" name="presion_oi" class="form-control" value="<?=$PRESION_OI?>">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row p-10">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label"><h5><strong>DIAGNÓSTICO</strong></h5></label>
                                <input type="text" id="diagnostico" name="diagnostico" class="form-control" value="<?=$DIAGNOSTICO?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"><h5><strong>VISIÓN DE PROFUNDIDAD</strong></h5></label>
                                <input type="text" id="vision_profundidad" name="vision_profundidad" class="form-control" value="<?=$VISION_PROFUNDIDAD?>">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row p-10">
                        <div class="col-md-12 ">
                            <label class="control-label"><h5><strong>OBSERVACIONES Y/O RECOMENDACIONES</strong></h5></label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="3"><?=$OBSERVACIONES?></textarea>
                        </div>
                    </div>

                    <hr>
    
                    <div class="col-md-12 text-right">                              
                        <button type="submit" id="guardar_evaluacion_oftalmologica" class="btn waves-effect waves-light btn-bloc btn-success"><i class="mdi mdi-content-save"></i> GUARDAR</button>
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