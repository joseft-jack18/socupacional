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
   
        $ACCIDENTES_ENFERMEDADES = $_POST["accidentes_enfermedades"];
        $HABITOS = $_POST["habitos"];
        $OTRAS_OBSERVACIONES = $_POST["otras_observaciones"];
        $PRESENTACION = $_POST["presentacion"];
        $POSTURA = $_POST["postura"];
        $DISCURSO_RITMO = $_POST["discurso_ritmo"];
        $DISCURSO_TONO = $_POST["discurso_tono"];
        $DISCURSO_ARTICULACION = $_POST["discurso_articulacion"];
        $ORIENTACION_TIEMPO = $_POST["orientacion_tiempo"];
        $ORIENTACION_ESPACIO = $_POST["orientacion_espacio"];
        $ORIENTACION_PERSONA = $_POST["orientacion_persona"];
        $LUCIDO_ATENTO = $_POST["lucido_atento"];
        $PENSAMIENTO = $_POST["pensamiento"];
        $PERCEPCION = $_POST["percepcion"];
        $NIVEL_MEMORIA = $_POST["nivel_memoria"];
        $INTELIGENCIA = $_POST["inteligencia"];
        $APETITO = $_POST["apetito"];
        $SUENO = $_POST["sueno"];
        $PERSONALIDAD = $_POST["personalidad"];
        $AFECTIVIDAD = $_POST["afectividad"];
        $CONDUCTA_SEXUAL = $_POST["conducta_sexual"];
        $AREA_COGNITIVA = $_POST["area_cognitiva"];
        $AREA_EMOCIONAL = $_POST["area_emocional"];
        $RESULTADO = $_POST["resultado"];
        
        $sql_psicologico = "UPDATE $BD..SO_INFORME_PSICOLOGICO SET 
                            ACCIDENTES_ENFERMEDADES = '$ACCIDENTES_ENFERMEDADES',
                            HABITOS = '$HABITOS',
                            OTRAS_OBSERVACIONES = '$OTRAS_OBSERVACIONES',
                            PRESENTACION = '$PRESENTACION',
                            POSTURA = '$POSTURA',
                            DISCURSO_RITMO = '$DISCURSO_RITMO',
                            DISCURSO_TONO = '$DISCURSO_TONO',
                            DISCURSO_ARTICULACION = '$DISCURSO_ARTICULACION',
                            ORIENTACION_TIEMPO = '$ORIENTACION_TIEMPO',
                            ORIENTACION_ESPACIO = '$ORIENTACION_ESPACIO',
                            ORIENTACION_PERSONA = '$ORIENTACION_PERSONA',
                            LUCIDO_ATENTO = '$LUCIDO_ATENTO',
                            PENSAMIENTO = '$PENSAMIENTO',
                            PERCEPCION = '$PERCEPCION',
                            NIVEL_MEMORIA = '$NIVEL_MEMORIA',
                            INTELIGENCIA = '$INTELIGENCIA',
                            APETITO = '$APETITO',
                            SUENO = '$SUENO',
                            PERSONALIDAD = '$PERSONALIDAD',
                            AFECTIVIDAD = '$AFECTIVIDAD',
                            CONDUCTA_SEXUAL = '$CONDUCTA_SEXUAL',
                            AREA_COGNITIVA = '$AREA_COGNITIVA',
                            AREA_EMOCIONAL = '$AREA_EMOCIONAL',
                            RESULTADO = '$RESULTADO' 
                            WHERE COD_ATENCION = $cod_atencion";
        $res_psicologico = sqlsrv_query($conn, $sql_psicologico);

        if($res_psicologico){ 
            $messages[] = "Registro exitoso en la SO_INFORME_PSICOLOGICO";
        } else {
            $errors[]= "Error al registrar en la SO_INFORME_PSICOLOGICO";
        }    
    
    
        //INSERTA PRUEBAS PSICO    
        $number = count($_POST["pruebas"]);
        if($number > 0) {
            for ($i = 0; $i < $number; $i++) {
                if($_POST["pruebas"][$i] != '') {
                    $PRUEBAS = $_POST["pruebas"][$i];
                    $PUNTAJE = $_POST["puntaje"][$i];

                    $sql = "INSERT INTO $BD..SO_PRUEBAS_PSICOLOGICAS (COD_ATENCION, PUNTAJES, PRUEBAS) 
                    VALUES ($cod_atencion, '$PUNTAJE', '$PRUEBAS')";    
                    $res = sqlsrv_query($conn, $sql);
    
                    if ($res) {
                        $messages[] = "Registro exitoso en la SO_PRUEBAS_PSICOLOGICAS";
                    } else {
                        $errors[] = "Error al registrar en la SO_PRUEBAS_PSICOLOGICAS";
                    }
                }
            }
        }


        $sql_atencion = "UPDATE $BD..ADM_ATENCION SET TIP_ESTADO = 1 WHERE COD_ATENCION = $cod_atencion";
        $res_atencion = sqlsrv_query($conn, $sql_atencion);

        if ($res_atencion) {
            $messages[] = "Registro exitoso en la ADM_ATENCION";
        } else {
            $errors[] = "Error al registrar en la ADM_ATENCION";
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