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
        $lotepc = $_POST['lotepc'];
        $exa_ge = $_POST['exa_ge'];
        $abegc = $_POST['abegc'];
        $aregc = $_POST['aregc'];
        $amegc = $_POST['amegc'];
        $examen_general = $_POST['examen_general'];
        $examen_preferencial = $_POST['examen_preferencial'];
        $medidas_higienicas = $_POST['medidas_higienicas'];
        $observacion = $_POST['observacion'];
        $fecha_proximacita = $_POST['fecha_proximacita'];


        echo 
        $t_enfermedad." || ".
        $des_tiempo." || ".
        $motivo." || ".
        $funciones." || ".
        $sed." || ".
        $apetito." || ".
        $sueno." || ".
        $ritmo_urinario." || ".
        $ritmo_evacuatorio." || ".
        $antecedentes_personales." || ".
        $antecedentes_alergias." || ".
        $antecedentes_familiares." || ".
        $lotepc." || ".
        $exa_ge." || ".
        $abegc." || ".
        $aregc." || ".
        $amegc." || ".
        $examen_general." || ".
        $examen_preferencial." || ".
        $medidas_higienicas." || ".
        $observacion." || ".
        $fecha_proximacita;
        



        //if (count($errors) == 0){
        //    echo "<script>";
        //    echo "MensajeGuardar();";
        //    echo "</script>";
        //} else {             
        //    echo "<script>";
        //    echo "MensajeError();";
        //    echo "</script>";
        //    var_dump($errors);
        //}
    }

?>

<?php

    /*$messages = array();
    $errors = array();

    if (empty($_POST['cod_atencion'])) {
        $errors[] = "Código de atención vacio";
    
    } elseif (!empty($_POST['cod_atencion'])) {
		require_once ("../../config/conexion.php");
       
        $sucursal = $_POST["sucursal"];
        $cod_atencion = $_POST["cod_atencion"];

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


        $sql_paciente = sqlsrv_query($conn, "SELECT B.COD_PACIENTE FROM $BD..HCE_CONSULTA_EXTERNA A 
                                             INNER JOIN $BD..ADM_PACIENTE B ON A.COD_PACIENTE = B.COD_PACIENTE 
                                             WHERE A.COD_ATENCION = $cod_atencion");
        $row_paciente = sqlsrv_fetch_array($sql_paciente);
    
        $COD_PACIENTE = $row_paciente['COD_PACIENTE'];
        //$FECHA_HOY = date('Y-m-d H:i:s');
        $COD_EMPRESA = "0001";

		$t_enfermedad = $_POST["t_enfermedad"];
        $des_tiempo = $_POST["des_tiempo"];
        $DES_TIEMPO_ENF = $t_enfermedad.' '.$des_tiempo;
        $DES_MOTIVO_CONS = $_POST["motivo"];
        $DES_FUNCIONES = $_POST["funciones"];
		$DES_SED = intval($_POST["sed"]);
		$DES_APETITO = intval($_POST["apetito"]);
        $DES_SUENO = intval($_POST["sueno"]);
		$DES_RITMO_URINARIO = intval($_POST["ritmo_urinario"]);
		$DES_RITMO_EVACUA = intval($_POST["ritmo_evacuatorio"]);


        //CHECKBOX ANTECEDENTES
        if(isset($_POST['checkbox11'])) { $DES_ANTECEDENTES = "NINGUNO"; }
        else { $DES_ANTECEDENTES = $_POST["antecedentes_personales"]; }
        
        if(isset($_POST['checkbox12'])) { $DES_ANTECEDENTES_ALE = "NINGUNO"; }
        else { $DES_ANTECEDENTES_ALE = $_POST["antecedentes_alergias"]; }

        if(isset($_POST['checkbox13'])) { $DES_ANTECEDENTES_FAM = "NINGUNO"; }
        else { $DES_ANTECEDENTES_FAM = $_POST["antecedentes_familiares"]; }

        
        $DES_FRE_CARDIACA = $_POST["frecuencia_cardiaca"];  
		$DES_FRE_RESPIRA = $_POST["frecuencia_respiratoria"];
		$DES_PRESION_ARTERIAL = $_POST["presion"];
		$DES_TEMPERATURA = $_POST["temperatura"];
		$DES_PESO = $_POST["peso"];
		$DES_TALLA = $_POST["talla"];
        $DES_IMC = $_POST["imc"];

        //CHECKBOX RADIO BUTTOM EXAMEN FISICO
        $lotep = "LUCIDO, ORIENTADO EN TIEMPO, ESPACIO Y PERSONA.";

        if ( isset($_POST['exa_ge']) && $_POST['exa_ge'] == "abegc" &&  isset($_POST['lotepc'])) {
            $DES_EXAMEN_GENERAL = $lotep.' '."APARENTE BUEN ESTADO GENERAL. ".' '.$_POST["examen_general"];
        } else if ( isset($_POST['exa_ge']) && $_POST['exa_ge'] == "aregc" &&  isset($_POST['lotepc'])) {
            $DES_EXAMEN_GENERAL = $lotep.' '."APARENTE REGULAR ESTADO GENERAL.".' '.$_POST["examen_general"];
        } else if ( isset($_POST['exa_ge']) && $_POST['exa_ge'] == "amegc" &&  isset($_POST['lotepc'])) {
            $DES_EXAMEN_GENERAL = $lotep.' '."APARENTE MAL ESTADO GENERAL.".' '.$_POST["examen_general"];
        } else if ( isset($_POST['exa_ge']) && $_POST['exa_ge'] == "abegc") {
            $DES_EXAMEN_GENERAL = "APARENTE BUEN ESTADO GENERAL.".' '.$_POST["examen_general"];
        } else if ( isset($_POST['exa_ge']) && $_POST['exa_ge'] == "aregc") {
            $DES_EXAMEN_GENERAL = "APARENTE REGULAR ESTADO GENERAL.".' '.$_POST["examen_general"];
        } else if ( isset($_POST['exa_ge']) && $_POST['exa_ge'] == "amegc") {
            $DES_EXAMEN_GENERAL = "APARENTE MAL ESTADO GENERAL.".' '.$_POST["examen_general"];
        } else if(isset($_POST['lotepc'])) {
            $DES_EXAMEN_GENERAL = "LUCIDO, ORIENTADO EN TIEMPO, ESPACIO Y PERSONA.".' '.$_POST["examen_general"];          
        } else {
            $DES_EXAMEN_GENERAL = $_POST["examen_general"];          
        }
       
        $DES_EXAMEN_PREFERENTE = $_POST["examen_preferencial"];
        $MEDIDAS_HIGIENICAS = $_POST["medidas_higienicas"];
		$DES_OBSERVACIONES = $_POST["observacion"];
		$FEC_PROXIMA_CITA = $_POST["fecha_proximacita"];


        //ACTUALIZA DATOS DE HCE_CONSULTA_EXTERNA
        $sql2 = "UPDATE $BD..HCE_CONSULTA_EXTERNA SET 
                 DES_TIEMPO_ENF = '$DES_TIEMPO_ENF',
                 COD_PACIENTE = '$COD_PACIENTE',
                 FEC_ACTUALIZA = GETDATE(), 
                 COD_EMPRESA = '$COD_EMPRESA', 
                 DES_MOTIVO_CONS = '$DES_MOTIVO_CONS', 
                 DES_FUNCIONES = '$DES_FUNCIONES', 
                 DES_SED = '$DES_SED', 
                 DES_APETITO = '$DES_APETITO', 
                 DES_SUENO = '$DES_SUENO', 
                 DES_RITMO_URINARIO = '$DES_RITMO_URINARIO', 
                 DES_RITMO_EVACUA = '$DES_RITMO_EVACUA',
                 DES_FRE_CARDIACA = '$DES_FRE_CARDIACA',
                 DES_FRE_RESPIRA = '$DES_FRE_RESPIRA',
                 DES_PRESION_ARTERIAL = '$DES_PRESION_ARTERIAL',
                 DES_TEMPERATURA = '$DES_TEMPERATURA',
                 DES_PESO = '$DES_PESO', 
                 DES_TALLA = '$DES_TALLA', 
                 DES_IMC = '$DES_IMC',
                 DES_EXAMEN_GENERAL = '$DES_EXAMEN_GENERAL', 
                 DES_EXAMEN_PREFERENTE = '$DES_EXAMEN_PREFERENTE',
                 DES_OBSERVACIONES = '$DES_OBSERVACIONES', 
                 FEC_PROXIMA_CITA = '$FEC_PROXIMA_CITA', 
                 MEDIDAS_HIGIENICAS = '$MEDIDAS_HIGIENICAS' 
                 WHERE COD_ATENCION = $cod_atencion";
        $res2 = sqlsrv_query($conn, $sql2);

        if ($res2) { 
            $messages[] = "registro satisfactorio en HCE_CONSULTA_EXTERNA";
        } else {
            $errors[] = "Error en HCE_CONSULTA_EXTERNA";
        }



        //ACTUALIZA ANTECEDENTES EN ADM_PACIENTE
        $sql_antecedentes = "UPDATE $BD..ADM_PACIENTE SET 
                             DES_ALER_CIRU = '$DES_ANTECEDENTES',
                             DES_ANTE_ALERGIAS = '$DES_ANTECEDENTES_ALE',
                             DES_ANTE_FAMILIARES = '$DES_ANTECEDENTES_FAM' 
                             WHERE COD_PACIENTE = $COD_PACIENTE";
        $res_antecedentes = sqlsrv_query($conn, $sql_antecedentes);

        if ($res_antecedentes) { 
            $messages[] = "registro satisfactorio en ADM_PACIENTE";
        } else {
            $errors[] = "Error en ADM_PACIENTE";
        }
        

        



        
		
        //ACTUALIZA ESTADO DE LA CONSULTA
        $sql_atencion = "UPDATE $BD..ADM_ATENCION SET TIP_ESTADO = 1 WHERE COD_ATENCION = $cod_atencion";
	    $res_atencion = sqlsrv_query($conn, $sql_atencion);
		
		if ($res_atencion) {
			$messages[] = "La anamnesis ha sido registrada satisfactoriamente.";
        } else {          
			$errors[] = "Lo siento algo ha salido mal intenta nuevamente todo.";
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
           
    } else {
        $errors[] = "Error desconocido.";
    }
*/
?>

