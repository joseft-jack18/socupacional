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

    
    $sql = "SELECT P.NUM_HC, CONCAT(P.APE_PATERNO,' ',P.APE_MATERNO,' ',P.NOM_PACIENTE) AS PACIENTE,
            DATEDIFF(YEAR,P.FEC_NACIMIENTO,GETDATE()) AS EDAD, MA.DES_AUXILIAR AS MEDICO, ME.NUM_CMP, ME.NUM_RNE,
            ES.DES_ESPECIALIDAD, H.FEC_ACTUALIZA, P.DES_ALER_CIRU, P.DES_ANTE_ALERGIAS, P.DES_ANTE_FAMILIARES, 
            A.COD_EXPEDIENTE, H.DES_TIEMPO_ENF, H.DES_MOTIVO_CONS, H.DES_FUNCIONES, H.DES_SED, H.DES_APETITO,
            H.DES_SUENO, H.DES_RITMO_URINARIO, H.DES_RITMO_EVACUA, H.DES_EXAMEN_GENERAL,
            H.DES_EXAMEN_PREFERENTE, H.DES_OBSERVACIONES, H.FEC_PROXIMA_CITA, H.MEDIDAS_HIGIENICAS
            FROM $BD..ADM_ATENCION A
            INNER JOIN $BD..HCE_CONSULTA_EXTERNA H ON H.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..ADM_PACIENTE P ON P.COD_PACIENTE = H.COD_PACIENTE
            INNER JOIN $BD..CVE_ESPECIALIDAD ES ON ES.COD_ESPECIALIDAD = A.COD_ESPECIALIDAD
            INNER JOIN $BD..CVE_MEDICO ME ON ME.COD_MEDICO = A.COD_MEDICO
            INNER JOIN $BD..MAE_AUXILIAR MA ON MA.COD_AUXILIAR = ME.COD_AUXILIAR
            WHERE A.COD_ATENCION = $cod_atencion";
    $res = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($res);

    $NUM_HC = $row['NUM_HC'];
    $PACIENTE = strtoupper($row['PACIENTE']);
    $EDAD = $row['EDAD'];
    $ESPECIALIDAD = strtoupper($row['DES_ESPECIALIDAD']);
    $MEDICO = strtoupper($row['MEDICO']);
    if($row['NUM_CMP'] == NULL || $row['NUM_CMP'] == ""){ $NUM_CMP = "--"; } else { $NUM_CMP = $row['NUM_CMP']; }
    if($row['NUM_RNE'] == NULL || $row['NUM_RNE'] == ""){ $NUM_RNE = "--"; } else { $NUM_RNE = $row['NUM_RNE']; }
    $FEC_ATENCION = $row['FEC_ACTUALIZA']->format('d/m/Y');
    $HOR_ATENCION = $row['FEC_ACTUALIZA']->format('H:i');
    $DES_ALER_CIRU = strtoupper($row['DES_ALER_CIRU']);
    $DES_ANTE_ALERGIAS = strtoupper($row['DES_ANTE_ALERGIAS']);
    $DES_ANTE_FAMILIARES = strtoupper($row['DES_ANTE_FAMILIARES']);
    $COD_EXPEDIENTE = $row['COD_EXPEDIENTE'];
    $DES_TIEMPO_ENF = strtoupper($row['DES_TIEMPO_ENF']);
    $DES_MOTIVO_CONS = strtoupper($row['DES_MOTIVO_CONS']);
    $DES_FUNCIONES = strtoupper($row['DES_FUNCIONES']);
    if ($row['DES_SED'] == 1 || $row['DES_SED'] == "DISMINUIDO"){ $DES_SED = "DISMINUIDO"; }
    elseif ($row['DES_SED'] == 2 || $row['DES_SED'] == "NORMAL" ){ $DES_SED = "NORMAL"; }
    elseif ($row['DES_SED'] == 3 || $row['DES_SED'] == "AUMENTADO"){ $DES_SED = "AUMENTADO"; }
    else { $DES_SED = "--"; }
    if ($row['DES_APETITO'] == 1 || $row['DES_APETITO'] == "DISMINUIDO"){ $DES_APETITO = "DISMINUIDO"; }
    elseif ($row['DES_APETITO'] == 2 || $row['DES_APETITO'] == "NORMAL" ){ $DES_APETITO = "NORMAL"; }
    elseif ($row['DES_APETITO'] == 3 || $row['DES_APETITO'] == "AUMENTADO"){ $DES_APETITO = "AUMENTADO"; }
    else { $DES_APETITO = "--"; }
    if ($row['DES_SUENO'] == 1 || $row['DES_SUENO'] == "DISMINUIDO"){ $DES_SUENO = "DISMINUIDO"; }
    elseif ($row['DES_SUENO'] == 2 || $row['DES_SUENO'] == "NORMAL" ){ $DES_SUENO = "NORMAL"; }
    elseif ($row['DES_SUENO'] == 3 || $row['DES_SUENO'] == "AUMENTADO"){ $DES_SUENO = "AUMENTADO"; }
    else { $DES_SUENO = "--"; }
    if ($row['DES_RITMO_URINARIO'] == 1 || $row['DES_RITMO_URINARIO'] == "DISMINUIDO"){ $DES_RITMO_URINARIO = "DISMINUIDO"; }
    elseif ($row['DES_RITMO_URINARIO'] == 2 || $row['DES_RITMO_URINARIO'] == "NORMAL" ){ $DES_RITMO_URINARIO = "NORMAL"; }
    elseif ($row['DES_RITMO_URINARIO'] == 3 || $row['DES_RITMO_URINARIO'] == "AUMENTADO"){ $DES_RITMO_URINARIO = "AUMENTADO"; }
    else { $DES_RITMO_URINARIO = "--"; }
    if ($row['DES_RITMO_EVACUA'] == 1 || $row['DES_RITMO_EVACUA'] == "DISMINUIDO"){ $DES_RITMO_EVACUA = "DISMINUIDO"; }
    elseif ($row['DES_RITMO_EVACUA'] == 2 || $row['DES_RITMO_EVACUA'] == "NORMAL" ){ $DES_RITMO_EVACUA = "NORMAL"; }
    elseif ($row['DES_RITMO_EVACUA'] == 3 || $row['DES_RITMO_EVACUA'] == "AUMENTADO"){ $DES_RITMO_EVACUA = "AUMENTADO"; }
    else { $DES_RITMO_EVACUA = "--"; }

    $DES_EXAMEN_GENERAL = strtoupper($row['DES_EXAMEN_GENERAL']);
    $DES_EXAMEN_PREFERENTE = strtoupper($row['DES_EXAMEN_PREFERENTE']);
    $DES_OBSERVACIONES = strtoupper($row['DES_OBSERVACIONES']);
    //$FEC_PROXIMA_CITA = $row['FEC_PROXIMA_CITA'];
    $MEDIDAS_HIGIENICAS = strtoupper($row['MEDIDAS_HIGIENICAS']);


    //DATOS DEL TRIAJE-----------------------------------------------------------------------
    $sql_triaje = "SELECT DISTINCT H.DES_TALLA, H.DES_PESO, H.DES_IMC, H.DES_FRE_RESPIRA, H.DES_FRE_CARDIACA, 
                   H.DES_PRESION_ARTERIAL, H.DES_TEMPERATURA
                   FROM $BD..HCE_CONSULTA_EXTERNA H
                   INNER JOIN $BD..ADM_ATENCION A ON A.COD_ATENCION = H.COD_ATENCION
                   WHERE A.COD_EXPEDIENTE = $COD_EXPEDIENTE AND H.DES_TALLA IS NOT NULL 
                   AND H.DES_PESO IS NOT NULL AND H.DES_IMC IS NOT NULL AND H.DES_FRE_RESPIRA IS NOT NULL 
                   AND H.DES_FRE_CARDIACA IS NOT NULL AND H.DES_PRESION_ARTERIAL IS NOT NULL 
                   AND H.DES_TEMPERATURA IS NOT NULL";
    $res_triaje = sqlsrv_query($conn, $sql_triaje);
    $row_triaje = sqlsrv_fetch_array($res_triaje);

    $DES_TALLA = $row_triaje['DES_TALLA'];
    $DES_PESO = $row_triaje['DES_PESO'];
    $DES_IMC = $row_triaje['DES_IMC'];
    $DES_FRE_RESPIRA = $row_triaje['DES_FRE_RESPIRA'];
    $DES_FRE_CARDIACA = $row_triaje['DES_FRE_CARDIACA'];
    $DES_PRESION_ARTERIAL = $row_triaje['DES_PRESION_ARTERIAL'];
    $DES_TEMPERATURA = $row_triaje['DES_TEMPERATURA'];


    //DIAGNOSTICOS-----------------------------------------------------------------------------
    $sql_dia = "SELECT D.COD_DIAGNOSTICO, D.DES_DIAGNOSTICO, H.tipo
                FROM $BD..HCE_ATENCION_DIAGNOSTICO H
                INNER JOIN $BD..HCE_DIAGNOSTICO D ON D.COD_DIAGNOSTICO = H.cod_diagnostico
                WHERE H.cod_atencion = $cod_atencion";
	$res_dia = sqlsrv_query($conn, $sql_dia);


    //PLAN DE TRABAJO--------------------------------------------------------------------------
    $sql_pla = "SELECT L.DES_ARTICULO_SERV, H.cod_proveedor
                FROM $BD..HCE_ATENCION_PLAN H
                INNER JOIN $BD..LOG_ARTICULO_SERV L ON L.COD_ARTICULO_SERV = H.cod_articulo_serv
                WHERE H.cod_atencion = $cod_atencion
                ORDER BY H.cod_proveedor";
	$res_pla = sqlsrv_query($conn, $sql_pla);


    //INTERCONSULTAS---------------------------------------------------------------------------
    $sql_int = "SELECT E.DES_ESPECIALIDAD 
                FROM $BD..HCE_ATENCION_INTERCONSULTA H
                INNER JOIN $BD..CVE_ESPECIALIDAD E ON E.COD_ESPECIALIDAD = H.cod_especialidad
                WHERE H.cod_atencion = $cod_atencion";
	$res_int = sqlsrv_query($conn, $sql_int);


    //TRATAMIENTO------------------------------------------------------------------------------
    $sql_tra = "SELECT nombre_medicamento, forma, dosis, cantidad 
                FROM $BD..HCE_ATENCION_TRATAMIENTO WHERE cod_atencion = $cod_atencion";
	$res_tra = sqlsrv_query($conn, $sql_tra);
    
    

    //FIRMAS DE LOS MEDICOS--------------------------------------------------------------------------
    /*$sql_firma = "SELECT URL_FIRMA FROM $BD..SO_MEDICO_FIRMA WHERE COD_MEDICO = $COD_MEDICO AND COD_ESPECIALIDAD = 41";
    $res_firma = sqlsrv_query($conn, $sql_firma);
    $row_firma = sqlsrv_fetch_array($res_firma);
    if(empty($row_firma['URL_FIRMA'])){ $FIRMA_OF = "firmas/default_img.png"; } 
    else { $FIRMA_OF = $row_firma['URL_FIRMA']; }*/


    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    ob_end_clean();
    ob_start();
    include(dirname('__FILE__').'/res/estilos_html.php');
    include(dirname('__FILE__').'/res/ver_consulta_html.php');
    $content = ob_get_clean();

    try{
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('HISTORIA_'.$PACIENTE.'.pdf');

    } catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>