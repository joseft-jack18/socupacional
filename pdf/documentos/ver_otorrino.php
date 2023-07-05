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
            DATEDIFF(YEAR,P.FEC_NACIMIENTO,GETDATE()) AS EDAD, P.DES_GENERO, SO.OTITIS_CRONICA, SO.TEC, 
            SO.PAROTIDITIS, SO.WALKMAN, SO.OTOTOXICIDAD, SO.MENINGITIS, SO.SARAMPION, SO.TRAUMA_AUDITIVO,
            SO.TAMPONES, SO.OREJERAS, SO.ALGODONES, SO.OTROS, SO.ACUFENOS, SO.VERTIGO, SO.HIPOACUSIA, 
            SO.OTALGIA, SO.EXPOSICION_RECIENTE, SO.PRACTICAS_RUIDOSAS, SO.OIDO, SO.OTOSCOPIA_DER, PA.PUESTO,
            SO.OTOSCOPIA_IZQ, SO.DIAGNOSTICO, SO.NIVEL_RUIDO, SO.HORAS_EXPOSICION, SO.RECOMENDACIONES
            FROM $BD..ADM_ATENCION A
            INNER JOIN $BD..SO_EVALUACION_AUDIOMETRICA SO ON SO.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..HCE_CONSULTA_EXTERNA H ON H.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..ADM_PACIENTE P ON P.COD_PACIENTE = H.COD_PACIENTE
            INNER JOIN $BD..SO_PACIENTE_ATENCION SA ON SA.COD_ATENCION = A.COD_ATENCION
            INNER JOIN $BD..SO_PACIENTE PA ON PA.ID = SA.ID_SO
            WHERE A.COD_ATENCION = $cod_atencion";
    $res = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($res);

    $NUM_HC = $row['NUM_HC'];
    $PACIENTE = strtoupper($row['PACIENTE']);
    $PUESTO = strtoupper($row['PUESTO']);
    $FEC_ATENCION = $row['FEC_ATENCION']->format('d/m/Y');
    $HORA_ATENCION = "ADICIONAL";
    $EDAD = $row['EDAD'];
    if($row['DES_GENERO'] == "MA"){ $DES_GENERO = "MASCULINO"; } else { $DES_GENERO = "FEMENINO"; }
    $OTITIS_CRONICA = $row['OTITIS_CRONICA'];
    $TEC = $row['TEC'];
    $PAROTIDITIS = $row['PAROTIDITIS'];
    $WALKMAN = $row['WALKMAN'];
    $OTOTOXICIDAD = $row['OTOTOXICIDAD'];
    $MENINGITIS = $row['MENINGITIS'];
    $SARAMPION = $row['SARAMPION'];
    $TRAUMA_AUDITIVO = $row['TRAUMA_AUDITIVO'];
    $TAMPONES = $row['TAMPONES'];
    $OREJERAS = $row['OREJERAS'];
    $ALGODONES = $row['ALGODONES'];
    $OTROS = $row['OTROS'];
    $ACUFENOS = $row['ACUFENOS'];
    $VERTIGO = $row['VERTIGO'];
    $HIPOACUSIA = $row['HIPOACUSIA'];
    $OTALGIA = $row['OTALGIA'];
    $EXPOSICION_RECIENTE = $row['EXPOSICION_RECIENTE'];
    $PRACTICAS_RUIDOSAS = $row['PRACTICAS_RUIDOSAS'];
    $OIDO = strtoupper($row['OIDO']);
    $OTOSCOPIA_DER = strtoupper($row['OTOSCOPIA_DER']);
    $OTOSCOPIA_IZQ = strtoupper($row['OTOSCOPIA_IZQ']);
    $DIAGNOSTICO = strtoupper($row['DIAGNOSTICO']);
    $NIVEL_RUIDO = $row['NIVEL_RUIDO'];
    $HORAS_EXPOSICION = strtoupper($row['HORAS_EXPOSICION']);
    $RECOMENDACIONES = strtoupper($row['RECOMENDACIONES']);


    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    ob_end_clean();
    ob_start();
    include(dirname('__FILE__').'/res/estilos_html.php');
    include(dirname('__FILE__').'/res/ver_otorrino_html.php');
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