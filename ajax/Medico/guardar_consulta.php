<?php

    $messages = array();
    $errors = array();

    if (empty($_POST['cod_atencion'])) {
        $errors[] = "Código de atención vacío";

    } else if (!empty($_POST['cod_atencion'])) {
        require_once "../../config/conexion.php";

        $cod_atencion = $_POST['cod_atencion'];
        $cod_paciente = $_POST['cod_paciente'];
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
        
        $t_enfermedad = $_POST['t_enfermedad'];
        $des_tiempo = $_POST['des_tiempo'];
        $motivo = $_POST['motivo'];
        $funciones = $_POST['funciones'];
        $sed = $_POST['sed'];
        $apetito = $_POST['apetito'];
        $sueno = $_POST['sueno'];
        $ritmo_urinario = $_POST['ritmo_urinario'];
        $ritmo_evacuatorio = $_POST['ritmo_evacuatorio'];
        $antecedentes_personales = $_POST['antecedentes_personales'];
        $antecedentes_alergias = $_POST['antecedentes_alergias'];
        $antecedentes_familiares = $_POST['antecedentes_familiares'];
        if(empty($_POST['lotepc'])){ $lotepc = ""; }
        else { $lotepc = "LUCIDO, ORIENTADO EN TIEMPO, ESPACIO Y PERSONA. "; }
        if(empty($_POST['exa_ge'])){ $exa_ge = ""; }
        elseif($_POST['exa_ge'] == "abegc"){ $exa_ge = "APARENTE BUEN ESTADO GENERAL. "; }
        elseif($_POST['exa_ge'] == "aregc"){ $exa_ge = "APARENTE REGULAR ESTADO GENERAL. "; }
        elseif($_POST['exa_ge'] == "amegc"){ $exa_ge = "APARENTE MAL ESTADO GENERAL. "; }
        $examen_general = $lotepc.$exa_ge.$_POST['examen_general'];
        $examen_preferencial = $_POST['examen_preferencial'];
        $medidas_higienicas = $_POST['medidas_higienicas'];
        $observacion = $_POST['observacion'];
        $fecha_proximacita = $_POST['fecha_proximacita'];


        //ACTUALIZA DATOS DE HCE_CONSULTA_EXTERNA
        $sql2 = "UPDATE $BD..HCE_CONSULTA_EXTERNA SET
                 DES_TIEMPO_ENF = '$t_enfermedad $des_tiempo',
                 FEC_ACTUALIZA = GETDATE(),
                 DES_MOTIVO_CONS = '$motivo',
                 DES_FUNCIONES = '$funciones',
                 DES_SED = '$sed',
                 DES_APETITO = '$apetito',
                 DES_SUENO = '$sueno',
                 DES_RITMO_URINARIO = '$ritmo_urinario',
                 DES_RITMO_EVACUA = '$ritmo_evacuatorio',
                 DES_EXAMEN_GENERAL = '$examen_general',
                 DES_EXAMEN_PREFERENTE = '$examen_preferencial',
                 DES_OBSERVACIONES = '$observacion', 
                 FEC_PROXIMA_CITA = '$fecha_proximacita', 
                 MEDIDAS_HIGIENICAS = '$medidas_higienicas' 
                 WHERE COD_ATENCION = $cod_atencion";
        $res2 = sqlsrv_query($conn, $sql2);

        if ($res2) { 
            $messages[] = "registro satisfactorio en HCE_CONSULTA_EXTERNA";
        } else {
            $errors[] = "Error en HCE_CONSULTA_EXTERNA - $sql2";
        }


        //ACTUALIZA ANTECEDENTES EN ADM_PACIENTE
        $sql_antecedente = "UPDATE $BD..ADM_PACIENTE SET 
                            DES_ALER_CIRU = '$antecedentes_personales',
                            DES_ANTE_ALERGIAS = '$antecedentes_alergias',
                            DES_ANTE_FAMILIARES = '$antecedentes_familiares' 
                            WHERE COD_PACIENTE = $cod_paciente";
        $res_antecedente = sqlsrv_query($conn, $sql_antecedente);

        if($res_antecedente) { 
            $messages[] = "registro satisfactorio en ADM_PACIENTE";
        } else {
            $errors[] = "Error en ADM_PACIENTE - $sql_antecedente";
        }


        //ACTUALIZA ESTADO DE LA CONSULTA
        $sql_atencion = "UPDATE $BD..ADM_ATENCION SET TIP_ESTADO = 1 WHERE COD_ATENCION = $cod_atencion";
	    $res_atencion = sqlsrv_query($conn, $sql_atencion);
		
		if ($res_atencion) {
			$messages[] = "ESTADO DE ATENCION CAMBIADA CORRECTAMENTE";
        } else {          
			$errors[] = "ERROR EN ADM_ATENCION - $sql_atencion";
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

