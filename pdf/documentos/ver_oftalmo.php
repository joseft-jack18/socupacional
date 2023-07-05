<?php

    require_once "../../config/conexion.php";

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
            P.IND_GLAUCOMA, P.IND_DIABETES, P.IND_CATARATA, P.IND_TRAUMA_OCULAR, P.IND_CORRECTOR_OCULAR, A.FEC_ATENCION,
            P.IND_OTROS_ANTECEDENTES, SO.vl_sc_od, SO.vl_sc_oi, SO.vl_cc_od, SO.vl_cc_oi, SO.vc_sc_od, SO.vc_sc_oi, 
            SO.vc_cc_od, SO.vc_cc_oi, SO.VISION_COLORES_OD, SO.VISION_COLORES_OI, SO.PTOSIS_OD, SO.PTOSIS_OI, 
            SO.PTERIGIUM_OD, SO.PTERIGIUM_OI, SO.BLEFARITIS_OD, SO.BLEFARITIS_OI, SO.CHALAZION_OD, SO.CHALAZION_OI,
            SO.DERMATOCALASIA_OD, SO.DERMATOCALASIA_OI, SO.ESTRABISMO_OD, SO.ESTRABISMO_OI, SO.CONJUNTIVITIS_OD, 
            SO.CONJUNTIVITIS_OI, SO.OTROS_ENFERMEDADES, SO.CAMPIMETRIA_OD, SO.CAMPIMETRIA_OI, SO.REFLEJOS_PUPILARES,
            SO.PRESION_OD, SO.PRESION_OI, SO.DIAGNOSTICO, SO.VISION_PROFUNDIDAD, SO.OBSERVACIONES, PA.EMPRESA, A.COD_MEDICO
            FROM $BD..ADM_ATENCION A
            INNER JOIN $BD..SO_EVALUACION_OFTALMOLOGICA SO ON SO.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..HCE_CONSULTA_EXTERNA H ON H.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..ADM_PACIENTE P ON P.COD_PACIENTE = H.COD_PACIENTE
            INNER JOIN $BD..SO_PACIENTE_ATENCION SA ON SA.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..SO_PACIENTE PA ON PA.ID = SA.ID_SO
            WHERE A.COD_ATENCION = $cod_atencion";
    $res = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($res);

    $NUM_HC = $row['NUM_HC'];
    $PACIENTE = strtoupper($row['PACIENTE']);
    $FEC_ATENCION = $row['FEC_ATENCION']->format('d/m/Y');    
    $EDAD = $row['EDAD'];
    if($row['DES_GENERO'] == "MA"){ $DES_GENERO = "MASCULINO"; } else { $DES_GENERO = "FEMENINO"; }
    $EMPRESA = $row['EMPRESA'];
    $COD_MEDICO = $row['COD_MEDICO'];
    if($row["IND_HIPERTEN"] == 1){ $IND_HIPERTEN = "X"; } else { $IND_HIPERTEN = ""; }
    if($row["IND_DIABETES"] == 1){ $IND_DIABETES = "X"; } else { $IND_DIABETES = ""; }
    if($row["IND_CORRECTOR_OCULAR"] == 1){ $IND_CORRECTOR_OCULAR = "X"; } else { $IND_CORRECTOR_OCULAR = ""; }
    if($row["IND_PTERIGIUM"] == 1){ $IND_PTERIGIUM = "X"; } else { $IND_PTERIGIUM = ""; }
    if($row["IND_CATARATA"] == 1){ $IND_CATARATA = "X"; } else { $IND_CATARATA = ""; }
    if($row["IND_GLAUCOMA"] == 1){ $IND_GLAUCOMA = "X"; } else { $IND_GLAUCOMA = ""; }
    if($row["IND_TRAUMA_OCULAR"] == 1){ $IND_TRAUMA_OCULAR = "X"; } else { $IND_TRAUMA_OCULAR = ""; }
    if($row["IND_OTROS_ANTECEDENTES"] == null || $row_antecedentes["IND_OTROS_ANTECEDENTES"] == ""){ $IND_OTROS_ANTECEDENTES = "NINGUNO"; } 
    else { $IND_OTROS_ANTECEDENTES = strtoupper($row["IND_OTROS_ANTECEDENTES"]); }
    $VL_SC_OD = strtoupper($row["vl_sc_od"]);
    $VL_CC_OD = strtoupper($row["vl_cc_od"]);
    $VL_SC_OI = strtoupper($row["vl_sc_oi"]);
    $VL_CC_OI = strtoupper($row["vl_cc_oi"]);
    $VC_SC_OD = strtoupper($row["vc_sc_od"]);
    $VC_CC_OD = strtoupper($row["vc_cc_od"]);
    $VC_SC_OI = strtoupper($row["vc_sc_oi"]);
    $VC_CC_OI = strtoupper($row["vc_cc_oi"]);
    $VISION_COLORES_OD = strtoupper($row['VISION_COLORES_OD']);
    $VISION_COLORES_OI = strtoupper($row['VISION_COLORES_OI']);
    if($row["PTOSIS_OD"] == 1){ $PTOSIS_OD = "X"; } else { $PTOSIS_OD = ""; }
    if($row["PTOSIS_OI"] == 1){ $PTOSIS_OI = "X"; } else { $PTOSIS_OI = ""; }
    if($row["PTERIGIUM_OD"] == 1){ $PTERIGIUM_OD = "X"; } else { $PTERIGIUM_OD = ""; }
    if($row["PTERIGIUM_OI"] == 1){ $PTERIGIUM_OI = "X"; } else { $PTERIGIUM_OI = ""; }
    if($row["BLEFARITIS_OD"] == 1){ $BLEFARITIS_OD = "X"; } else { $BLEFARITIS_OD = ""; }
    if($row["BLEFARITIS_OI"] == 1){ $BLEFARITIS_OI = "X"; } else { $BLEFARITIS_OI = ""; }
    if($row["CHALAZION_OD"] == 1){ $CHALAZION_OD = "X"; } else { $CHALAZION_OD = ""; }
    if($row["CHALAZION_OI"] == 1){ $CHALAZION_OI = "X"; } else { $CHALAZION_OI = ""; }
    if($row["DERMATOCALASIA_OD"] == 1){ $DERMATOCALASIA_OD = "X"; } else { $DERMATOCALASIA_OD = ""; }
    if($row["DERMATOCALASIA_OI"] == 1){ $DERMATOCALASIA_OI = "X"; } else { $DERMATOCALASIA_OI = ""; }
    if($row["ESTRABISMO_OD"] == 1){ $ESTRABISMO_OD = "X"; } else { $ESTRABISMO_OD = ""; }
    if($row["ESTRABISMO_OI"] == 1){ $ESTRABISMO_OI = "X"; } else { $ESTRABISMO_OI = ""; }
    if($row["CONJUNTIVITIS_OD"] == 1){ $CONJUNTIVITIS_OD = "X"; } else { $CONJUNTIVITIS_OD = ""; }
    if($row["CONJUNTIVITIS_OI"] == 1){ $CONJUNTIVITIS_OI = "X"; } else { $CONJUNTIVITIS_OI = ""; }
    $OTROS_ENFERMEDADES = strtoupper($row['OTROS_ENFERMEDADES']);
    if($row["CAMPIMETRIA_OD"] == "1"){ $CAMPIMETRIA_OD = "NORMAL"; } else { $CAMPIMETRIA_OD = "--"; }
    if($row["CAMPIMETRIA_OI"] == "1"){ $CAMPIMETRIA_OI = "NORMAL"; } else { $CAMPIMETRIA_OI = "--"; }
    if($row["REFLEJOS_PUPILARES"] == "1"){ $REFLEJOS_PUPILARES = "NORMAL"; } else { $REFLEJOS_PUPILARES = "--"; }
    $PRESION_OD = strtoupper($row['PRESION_OD']);
    $PRESION_OI = strtoupper($row['PRESION_OI']);
    $DIAGNOSTICO = strtoupper($row['DIAGNOSTICO']);
    $VISION_PROFUNDIDAD = strtoupper($row['VISION_PROFUNDIDAD']);
    $OBSERVACIONES = strtoupper($row['OBSERVACIONES']);
    

    //FIRMAS DE LOS MEDICOS--------------------------------------------------------------------------
    $sql_firma = "SELECT URL_FIRMA FROM $BD..SO_MEDICO_FIRMA WHERE COD_MEDICO = $COD_MEDICO AND COD_ESPECIALIDAD = 41";
    $res_firma = sqlsrv_query($conn, $sql_firma);
    $row_firma = sqlsrv_fetch_array($res_firma);
    if(empty($row_firma['URL_FIRMA'])){ $FIRMA_OF = "firmas/default_img.png"; } 
    else { $FIRMA_OF = $row_firma['URL_FIRMA']; }


    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    ob_end_clean();
    ob_start();
    include(dirname('__FILE__').'/res/estilos_html.php');
    include(dirname('__FILE__').'/res/ver_oftalmo_html.php');
    $content = ob_get_clean();

    try{
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('HISTORIA_OFTALMO_'.$PACIENTE.'.pdf');

    } catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>