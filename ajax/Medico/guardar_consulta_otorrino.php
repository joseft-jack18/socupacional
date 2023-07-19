<?php

    $messages = array();
    $errors = array();

    if (empty($_POST['cod_atencion'])) {
        $errors[] = "Código de atención vacío";

    } else if (!empty($_POST['cod_atencion'])) {
        require_once "../../config/conexion.php";

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

    
        $OTITIS_CRONICA = $_POST["otitis_cronica"];
        $OTOTOXICIDAD = $_POST["ototoxicidad"];
        $TEC = $_POST["tec"];
        $MENINGITIS = $_POST["meningitis"];
        $PAROTIDITIS = $_POST["parotiditis"];
        $SARAMPION = $_POST["sarampion"];
        $WALKMAN = $_POST["walkman"];
        $TRAUMA_AUDITIVO = $_POST["trauma_auditivo"];
        $TAMPONES = $_POST["tampones"];
        $OREJERAS = $_POST["orejeras"];
        $ALGODONES = $_POST["algodones"];
        $OTROS = $_POST["otros"];
        $ACUFENOS = $_POST["acufenos"];
        $VERTIGO = $_POST["vertigo"];
        $HIPOACUSIA = $_POST["hipoacusia"];
        $OTALGIA = $_POST["otalgia"];
        $EXPOSICION_RECIENTE = $_POST["exposicion_reciente"];
        $PRACTICAS_RUIDOSAS = $_POST["practicas_ruidosas"]; 
        $OIDO = $_POST["oido"];
        $OTOSCOPIA_DER = $_POST["otoscopia_der"];
        $OTOSCOPIA_IZQ = $_POST["otoscopia_izq"];
        $DIAGNOSTICO = $_POST["diagnostico"];
        $RECOMENDACIONES = $_POST["recomendaciones"];
        $NIVEL_RUIDO = $_POST["nivel_ruido"];
        $HORAS_EXPOSICION = $_POST["horas_exposicion"];


        $sql = "UPDATE $BD..SO_EVALUACION_AUDIOMETRICA SET 
                OTITIS_CRONICA = '$OTITIS_CRONICA', 
                OTOTOXICIDAD = '$OTOTOXICIDAD', 
                TEC = '$TEC', 
                MENINGITIS = '$MENINGITIS', 
                PAROTIDITIS = '$PAROTIDITIS', 
                SARAMPION = '$SARAMPION', 
                WALKMAN = '$WALKMAN', 
                TRAUMA_AUDITIVO = '$TRAUMA_AUDITIVO', 
                TAMPONES = '$TAMPONES', 
                OREJERAS = '$OREJERAS', 
                ALGODONES = '$ALGODONES', 
                OTROS = '$OTROS', 
                ACUFENOS = '$ACUFENOS', 
                VERTIGO = '$VERTIGO', 
                HIPOACUSIA = '$HIPOACUSIA', 
                OTALGIA = '$OTALGIA', 
                EXPOSICION_RECIENTE = '$EXPOSICION_RECIENTE', 
                PRACTICAS_RUIDOSAS = '$PRACTICAS_RUIDOSAS', 
                OIDO = '$OIDO', 
                OTOSCOPIA_DER = '$OTOSCOPIA_DER', 
                OTOSCOPIA_IZQ = '$OTOSCOPIA_IZQ', 
                DIAGNOSTICO = '$DIAGNOSTICO', 
                RECOMENDACIONES = '$RECOMENDACIONES', 
                NIVEL_RUIDO = '$NIVEL_RUIDO', 
                HORAS_EXPOSICION = '$HORAS_EXPOSICION' 
                WHERE COD_ATENCION = $cod_atencion";
        $res = sqlsrv_query($conn, $sql);

        if($res){ 
            $messages[] = "Registro exitoso en la SO_EVALUACION_AUDIOMETRICA";
        } else {
            $errors[]= "Error al registrar en la SO_EVALUACION_AUDIOMETRICA";
        }


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


        //var_dump($messages);
        //var_dump($errors);

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