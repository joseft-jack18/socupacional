<?php

    $messages = array();
    $errors = array();

    if (empty($_POST['cod_atencion'])) {
        $errors[] = "Código de atención vacío";

    } else if (!empty($_POST['cod_atencion'])) {        
        require_once "../../config/conexion.php";

        $cod_paciente = $_POST['cod_paciente'];
        $cod_atencion = $_POST['cod_atencion'];
        $sucursal = $_POST['sucursal'];

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
   
        //ANTECEDENTES DEL PACIENTE ----------------------------
        if(isset($_POST["ind_hiperten"])) { $IND_HIPERTEN = $_POST["ind_hiperten"]; } else { $IND_HIPERTEN = null; }
        if(isset($_POST["ind_pterigium"])) { $IND_PTERIGIUM = $_POST["ind_pterigium"]; } else { $IND_PTERIGIUM = null; }
        if(isset($_POST["ind_glaucoma"])) { $IND_GLAUCOMA = $_POST["ind_glaucoma"]; } else { $IND_GLAUCOMA = null; }
        if(isset($_POST["ind_diabetes"])) { $IND_DIABETES = $_POST["ind_diabetes"]; } else { $IND_DIABETES = null; }
        if(isset($_POST["ind_catarata"])) { $IND_CATARATA  = $_POST["ind_catarata"]; } else { $IND_CATARATA = null; }
        if(isset($_POST["ind_trauma_ocular"])) { $IND_TRAUMA_OCULAR  = $_POST["ind_trauma_ocular"]; } else { $IND_TRAUMA_OCULAR  = null; }
        if(isset($_POST["ind_corrector_ocular"])) { $IND_CORRECTOR_OCULAR  = $_POST["ind_corrector_ocular"]; } else { $IND_CORRECTOR_OCULAR  = null; }
        $IND_OTROS_ANTECEDENTES = $_POST["ind_otros_antecedentes"];

        $sql_antecedentes = "UPDATE $BD..ADM_PACIENTE SET 
                             IND_HIPERTEN = '$IND_HIPERTEN', 
                             IND_PTERIGIUM = '$IND_PTERIGIUM', 
                             IND_GLAUCOMA = '$IND_GLAUCOMA', 
                             IND_DIABETES = '$IND_DIABETES', 
                             IND_CATARATA = '$IND_CATARATA', 
                             IND_TRAUMA_OCULAR = '$IND_TRAUMA_OCULAR', 
                             IND_CORRECTOR_OCULAR = '$IND_CORRECTOR_OCULAR', 
                             IND_OTROS_ANTECEDENTES = '$IND_OTROS_ANTECEDENTES' 
                             WHERE COD_PACIENTE = $cod_paciente";
        $res_antecedentes = sqlsrv_query($conn, $sql_antecedentes);

        if($res_antecedentes){ 
            $messages[] = "Registro exitoso en la ADM_PACIENTE";
        } else {
            $errors[]= "Error al registrar en la ADM_PACIENTE";
        }


        //GUARDAR DATOS EN SO_EVALUACION_OFTALMOLOGICA--------------------------------
        $VL_SC_OD = $_POST["vl_sc_od"];
        $VL_CC_OD = $_POST["vl_cc_od"];
        $VL_SC_OI = $_POST["vl_sc_oi"];
        $VL_CC_OI = $_POST["vl_cc_oi"];
        $VC_SC_OD = $_POST["vc_sc_od"];
        $VC_CC_OD = $_POST["vc_cc_od"];
        $VC_SC_OI = $_POST["vc_sc_oi"];
        $VC_CC_OI = $_POST["vc_cc_oi"];    
        $VISION_COLORES_OD = $_POST["vision_colores_od"];
        $VISION_COLORES_OI = $_POST["vision_colores_oi"];
        $CAMPIMETRIA_OD = $_POST["campimetria_od"];
        $CAMPIMETRIA_OI = $_POST["campimetria_oi"];
        $REFLEJOS_PUPILARES = $_POST["reflejos_pupilares"];
        $PRESION_OD = $_POST["presion_od"];
        $PRESION_OI = $_POST["presion_oi"];
        $DIAGNOSTICO = $_POST["diagnostico"];
        $VISION_PROFUNDIDAD = $_POST["vision_profundidad"];
        $OBSERVACIONES = $_POST["observaciones"];

        if(isset($_POST["ptosis_od"])) { $PTOSIS_OD = $_POST["ptosis_od"]; } else { $PTOSIS_OD = null; }
        if(isset($_POST["ptosis_oi"])) { $PTOSIS_OI = $_POST["ptosis_oi"]; } else { $PTOSIS_OI = null; }
        if(isset($_POST["pterigium_od"])) { $PTERIGIUM_OD = $_POST["pterigium_od"]; } else { $PTERIGIUM_OD = null; }
        if(isset($_POST["pterigium_oi"])) { $PTERIGIUM_OI = $_POST["pterigium_oi"]; } else { $PTERIGIUM_OI = null; }
        if(isset($_POST["blefaritis_od"])) { $BLEFARITIS_OD = $_POST["blefaritis_od"]; } else { $BLEFARITIS_OD = null; }
        if(isset($_POST["blefaritis_oi"])) { $BLEFARITIS_OI = $_POST["blefaritis_oi"]; } else { $BLEFARITIS_OI = null; }
        if(isset($_POST["chalazion_od"])) { $CHALAZION_OD = $_POST["chalazion_od"]; } else { $CHALAZION_OD = null; }
        if(isset($_POST["chalazion_oi"])) { $CHALAZION_OI = $_POST["chalazion_oi"]; } else { $CHALAZION_OI = null; }
        if(isset($_POST["dermatocalasia_od"])) { $DERMATOCALASIA_OD = $_POST["dermatocalasia_od"]; } else { $DERMATOCALASIA_OD = null; }
        if(isset($_POST["dermatocalasia_oi"])) { $DERMATOCALASIA_OI = $_POST["dermatocalasia_oi"]; } else { $DERMATOCALASIA_OI = null; }
        if(isset($_POST["estrabismo_od"])) { $ESTRABISMO_OD = $_POST["estrabismo_od"]; } else { $ESTRABISMO_OD = null; }
        if(isset($_POST["estrabismo_oi"])) { $ESTRABISMO_OI = $_POST["estrabismo_oi"]; } else { $ESTRABISMO_OI = null; }
        if(isset($_POST["conjuntivitis_od"])) { $CONJUNTIVITIS_OD = $_POST["conjuntivitis_od"]; } else { $CONJUNTIVITIS_OD = null; }
        if(isset($_POST["conjuntivitis_oi"])) { $CONJUNTIVITIS_OI = $_POST["conjuntivitis_oi"]; } else { $CONJUNTIVITIS_OI = null; }
        $OTROS_ENFERMEDADES = $_POST["otros_enfermedades"];


        $sql_evaluacion = "UPDATE $BD..SO_EVALUACION_OFTALMOLOGICA SET 
                           VL_SC_OD = '$VL_SC_OD', 
                           VL_CC_OD = '$VL_CC_OD', 
                           VL_SC_OI = '$VL_SC_OI', 
                           VL_CC_OI = '$VL_CC_OI', 
                           VC_SC_OD = '$VC_SC_OD', 
                           VC_CC_OD = '$VC_CC_OD', 
                           VC_SC_OI = '$VC_SC_OI', 
                           VC_CC_OI = '$VC_CC_OI', 
                           VISION_COLORES_OD = '$VISION_COLORES_OD',
                           VISION_COLORES_OI = '$VISION_COLORES_OI', 
                           PTOSIS_OD = '$PTOSIS_OD', 
                           PTOSIS_OI = '$PTOSIS_OI', 
                           PTERIGIUM_OD = '$PTERIGIUM_OD',
                           PTERIGIUM_OI = '$PTERIGIUM_OI', 
                           BLEFARITIS_OD = '$BLEFARITIS_OD',
                           BLEFARITIS_OI = '$BLEFARITIS_OI', 
                           CHALAZION_OD = '$CHALAZION_OD', 
                           CHALAZION_OI = '$CHALAZION_OI',
                           DERMATOCALASIA_OD = '$DERMATOCALASIA_OD', 
                           DERMATOCALASIA_OI = '$DERMATOCALASIA_OI',
                           ESTRABISMO_OD = '$ESTRABISMO_OD', 
                           ESTRABISMO_OI = '$ESTRABISMO_OI', 
                           CONJUNTIVITIS_OD = '$CONJUNTIVITIS_OD', 
                           CONJUNTIVITIS_OI = '$CONJUNTIVITIS_OI', 
                           OTROS_ENFERMEDADES = '$OTROS_ENFERMEDADES', 
                           CAMPIMETRIA_OD = '$CAMPIMETRIA_OD', 
                           CAMPIMETRIA_OI = '$CAMPIMETRIA_OI',
                           REFLEJOS_PUPILARES = '$REFLEJOS_PUPILARES',
                           PRESION_OD = '$PRESION_OD', 
                           PRESION_OI = '$PRESION_OI',
                           DIAGNOSTICO = '$DIAGNOSTICO', 
                           VISION_PROFUNDIDAD = '$VISION_PROFUNDIDAD', 
                           OBSERVACIONES = '$OBSERVACIONES' 
                           WHERE COD_ATENCION = $cod_atencion";
        $res_evaluacion = sqlsrv_query($conn, $sql_evaluacion);

        if($res_evaluacion){ 
            $messages[] = "Registro exitoso en la SO_EVALUACION_OFTALMOLOGICA";
        } else {
            $errors[]= "Error al registrar en la SO_EVALUACION_OFTALMOLOGICA";
        }


        //CAMBIAR ESTADO EN ADM_ATENCION------------------------
        $sql_atencion = "UPDATE $BD..ADM_ATENCION SET TIP_ESTADO = 1 WHERE COD_ATENCION = $cod_atencion";
        $res_atencion = sqlsrv_query($conn, $sql_atencion);

        if($res_atencion){ 
            $messages[] = "Registro exitoso en la ADM_ATENCION";
        } else {
            $errors[]= "Error al registrar en la ADM_ATENCION";
        }
        

        //GUARDAR HORA DE ATENCION EN HCE_CONSULTA_EXTERNA------------------------
        $sql_consulta = "UPDATE $BD..HCE_CONSULTA_EXTERNA SET FEC_ACTUALIZA = GETDATE() 
                         WHERE COD_ATENCION = $cod_atencion";
        $res_consulta = sqlsrv_query($conn, $sql_consulta);

        if($res_consulta){ 
            $messages[] = "Registro exitoso en la HCE_CONSULTA_EXTERNA";
        } else {
            $errors[]= "Error al registrar en la HCE_CONSULTA_EXTERNA";
        }



        if (count($errors) == 0){
            echo "<script>";
            echo "MensajeGuardar();";
            echo "</script>";           
        } else {             
            echo "<script>";
            echo "MensajeError();";
            echo "</script>";
            var_dump($errors);
        } 
    }

?>