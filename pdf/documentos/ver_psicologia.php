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


    $sql = "SELECT P.NUM_HC, CONCAT(P.APE_PATERNO,' ',P.APE_MATERNO,' ',P.NOM_PACIENTE) AS PACIENTE, A.FEC_ATENCION,
            DATEDIFF(YEAR,P.FEC_NACIMIENTO,GETDATE()) AS EDAD, P.DES_GENERO, P.FEC_NACIMIENTO, A.COD_MEDICO,
            H.GRADO_INSTRUCCION, PA.EMPRESA, PA.TIPO_EMO, PA.PUESTO,
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
            INNER JOIN $BD..SO_PACIENTE_ATENCION SA ON SA.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..SO_PACIENTE PA ON PA.ID = SA.ID_SO
            WHERE A.COD_ATENCION = $cod_atencion";
    $res = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($res);

    $EMPRESA = strtoupper($row['EMPRESA']);
    if($row['TIPO_EMO'] == 'EI'){ $TIPO_EMO = "EMO INGRESO"; }
    else if($row['TIPO_EMO'] == 'EP'){ $TIPO_EMO = "EMO PERIODICO"; }
    else if($row['TIPO_EMO'] == 'ER'){ $TIPO_EMO = "EMO RETIRO"; }
    else if($row['TIPO_EMO'] == 'EU'){ $TIPO_EMO = "EMO RE-UBICACION"; }
    $PUESTO = strtoupper($row['PUESTO']);
    $NUM_HC = $row['NUM_HC'];
    $PACIENTE = strtoupper($row['PACIENTE']);
    $PUESTO = strtoupper($row['PUESTO']);
    $FEC_ATENCION = $row['FEC_ATENCION']->format('d/m/Y');
    $HORA_ATENCION = "ADICIONAL";
    $COD_MEDICO = $row['COD_MEDICO'];
    $EDAD = $row['EDAD'];    
    $FEC_NACIMIENTO = $row['FEC_NACIMIENTO']->format('d/m/Y');
    if($row['DES_GENERO'] == "MA"){ $DES_GENERO = "MASCULINO"; } else { $DES_GENERO = "FEMENINO"; }
    if($row['GRADO_INSTRUCCION'] == '1'){ $GRADO_INSTRUCCION = "ANALFABETO(A)"; }
    else if($row['GRADO_INSTRUCCION'] == '2'){ $GRADO_INSTRUCCION = "PRIMARIA COMPLETA"; }
    else if($row['GRADO_INSTRUCCION'] == '3'){ $GRADO_INSTRUCCION = "PRIMARIA INCOMPLETA"; }
    else if($row['GRADO_INSTRUCCION'] == '4'){ $GRADO_INSTRUCCION = "SECUNDARIA COMPLETA"; }
    else if($row['GRADO_INSTRUCCION'] == '5'){ $GRADO_INSTRUCCION = "SECUNDARIA INCOMPLETA"; }
    else if($row['GRADO_INSTRUCCION'] == '6'){ $GRADO_INSTRUCCION = "EDUCACION TECNICA"; }
    else if($row['GRADO_INSTRUCCION'] == '7'){ $GRADO_INSTRUCCION = "EDUCACION UNIVERSITARIA"; }
    else { $GRADO_INSTRUCCION = "--"; }
    if($row['ACCIDENTES_ENFERMEDADES'] == null || $row['ACCIDENTES_ENFERMEDADES'] == ""){ $ACCIDENTES_ENFERMEDADES = "--"; } 
    else { $ACCIDENTES_ENFERMEDADES = $row['ACCIDENTES_ENFERMEDADES']; }
    if($row['HABITOS'] == null || $row['HABITOS'] == ""){ $HABITOS = "--"; } 
    else { $HABITOS = $row['HABITOS']; }
    if($row['OTRAS_OBSERVACIONES'] == null || $row['OTRAS_OBSERVACIONES'] == ""){ $OTRAS_OBSERVACIONES = "--"; } 
    else { $OTRAS_OBSERVACIONES = $row['OTRAS_OBSERVACIONES']; } 
    if($row['PRESENTACION'] == 1){ $PRESENTACION = "ADECUADA"; } else { $PRESENTACION = "INADECUADA"; }
    if($row['POSTURA'] == 1){ $POSTURA = "ERGUIDA"; } else { $POSTURA = "ENCORVADA"; }
    if ($row['DISCURSO_RITMO'] == 1){ $DISCURSO_RITMO = "LENTO"; }
    else if ($row['DISCURSO_RITMO'] == 2){ $DISCURSO_RITMO = "RÁPIDO"; }
    else if ($row['DISCURSO_RITMO'] == 3){ $DISCURSO_RITMO = "FLUIDO"; }
    if ($row['DISCURSO_TONO'] == 1) { $DISCURSO_TONO = "BAJO"; }
    else if ($row['DISCURSO_TONO'] == 2) { $DISCURSO_TONO = "MODERADO"; }
    else if ($row['DISCURSO_TONO'] == 3) { $DISCURSO_TONO = "ALTO"; }
    if ($row['DISCURSO_ARTICULACION'] == 1) { $DISCURSO_ARTICULACION = "CON DIFICULTAD"; } 
    else { $DISCURSO_ARTICULACION = "SIN DIFICULTAD"; }
    if ($row['ORIENTACION_TIEMPO'] == 1) { $ORIENTACION_TIEMPO = "ORIENTADO"; } 
    else { $ORIENTACION_TIEMPO = "DESORIENTADO"; }
    if ($row['ORIENTACION_ESPACIO'] == 1) { $ORIENTACION_ESPACIO = "ORIENTADO"; } 
    else { $ORIENTACION_ESPACIO = "DESORIENTADO"; }
    if ($row['ORIENTACION_PERSONA'] == 1) { $ORIENTACION_PERSONA = "ORIENTADO"; } 
    else { $ORIENTACION_PERSONA = "DESORIENTADO"; }
    if($row['LUCIDO_ATENTO'] == null || $row['LUCIDO_ATENTO'] == ""){ $LUCIDO_ATENTO = "--"; } 
    else { $LUCIDO_ATENTO = strtoupper($row['LUCIDO_ATENTO']); }
    if($row['PENSAMIENTO'] == null || $row['PENSAMIENTO'] == ""){ $PENSAMIENTO = "--"; } 
    else { $PENSAMIENTO = strtoupper($row['PENSAMIENTO']); }
    if($row['PERCEPCION'] == null || $row['PERCEPCION'] == ""){ $PERCEPCION = "--"; } 
    else { $PERCEPCION = strtoupper($row['PERCEPCION']); }
    if ($row['NIVEL_MEMORIA'] == 1) { $NIVEL_MEMORIA = "CORTO PLAZO"; }
    else if ($row['NIVEL_MEMORIA'] == 2) { $NIVEL_MEMORIA = "MEDIANO PLAZO"; }
    else if ($row['NIVEL_MEMORIA'] == 3) { $NIVEL_MEMORIA = "LARGO PLAZO"; }
    if($row['INTELIGENCIA'] == 1) { $INTELIGENCIA = "MUY SUPERIOR"; }
    else if($row['INTELIGENCIA'] == 2) { $INTELIGENCIA = "SUPERIOR"; }
    else if($row['INTELIGENCIA'] == 3) { $INTELIGENCIA = "NORMAL BRILLANTE"; }
    else if($row['INTELIGENCIA'] == 4) { $INTELIGENCIA = "N.PROMEDIO"; }
    else if($row['INTELIGENCIA'] == 5) { $INTELIGENCIA = "N.TORPE"; }
    else if($row['INTELIGENCIA'] == 6) { $INTELIGENCIA = "FRONTERIZO"; }
    else if($row['INTELIGENCIA'] == 7) { $INTELIGENCIA = "RM LEVE"; }   
    else if($row['INTELIGENCIA'] == 8) { $INTELIGENCIA = "RM MODERADO"; }
    else if($row['INTELIGENCIA'] == 9) { $INTELIGENCIA = "RM SEVERO"; }
    else if($row['INTELIGENCIA'] == 10) { $INTELIGENCIA = "RM PROFUNDO"; }
    if($row['APETITO'] == null || $row['APETITO'] == ""){ $APETITO = "--"; } 
    else { $APETITO = strtoupper($row['APETITO']); }
    if($row['SUENO'] == null || $row['SUENO'] == ""){ $SUENO = "--"; } 
    else { $SUENO = strtoupper($row['SUENO']); }
    if($row['PERSONALIDAD'] == null || $row['PERSONALIDAD'] == ""){ $PERSONALIDAD = "--"; } 
    else { $PERSONALIDAD = strtoupper($row['PERSONALIDAD']); }
    if($row['AFECTIVIDAD'] == null || $row['AFECTIVIDAD'] == ""){ $AFECTIVIDAD = "--"; } 
    else { $AFECTIVIDAD = strtoupper($row['AFECTIVIDAD']); }
    if($row['CONDUCTA_SEXUAL'] == null || $row['CONDUCTA_SEXUAL'] == ""){ $CONDUCTA_SEXUAL = "--"; } 
    else { $CONDUCTA_SEXUAL = strtoupper($row['CONDUCTA_SEXUAL']); }
    if($row['AREA_COGNITIVA'] == null || $row['AREA_COGNITIVA'] == ""){ $AREA_COGNITIVA = "--"; } 
    else { $AREA_COGNITIVA = strtoupper($row['AREA_COGNITIVA']); }
    if($row['AREA_EMOCIONAL'] == null || $row['AREA_EMOCIONAL'] == ""){ $AREA_EMOCIONAL = "--"; } 
    else { $AREA_EMOCIONAL = strtoupper($row['AREA_EMOCIONAL']); }
    if ($row['RESULTADO'] == 1) { $RESULTADO = "APTO"; }
    else if ($row['RESULTADO'] == 2) { $RESULTADO = "APTO CON RESTRICCIÓN"; } 
    else if ($row['RESULTADO'] == 3) { $RESULTADO = "NO APTO"; }


    //DATOSPRUEBAS PSICO----------------------------------------------------------------------------------------------
    $sql_pruebas = "SELECT * FROM $BD..SO_PRUEBAS_PSICOLOGICAS WHERE COD_ATENCION = $cod_atencion ";
    $res_pruebas = sqlsrv_query($conn, $sql_pruebas);



    //FIRMAS DE LOS MEDICOS---------------------------------------------------------------------------------------------
    $sql_firmas = "SELECT URL_FIRMA FROM $BD..SO_MEDICO_FIRMA WHERE COD_MEDICO = $COD_MEDICO AND COD_ESPECIALIDAD = 49";
    $res_firmas = sqlsrv_query($conn, $sql_firmas);
    $row_firmas = sqlsrv_fetch_array($res_firmas);

    if(empty($row_firmas['URL_FIRMA'])){ $FIRMA_PS = "firmas/default_img.png"; } 
    else { $FIRMA_PS = $row_firmas['URL_FIRMA']; }



    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    ob_end_clean();
    ob_start();
    include(dirname('__FILE__').'/res/estilos_html.php');
    include(dirname('__FILE__').'/res/ver_psicologia_html.php');
    $content = ob_get_clean();

    try{
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('HISTORIA_OTORRINO_'.$PACIENTE.'.pdf');

    } catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>