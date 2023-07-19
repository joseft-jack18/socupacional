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
            ES.DES_ESPECIALIDAD, H.FEC_ACTUALIZA
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