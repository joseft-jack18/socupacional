<?php

    require_once "../../config/conexion.php";

    $cod_atencion = $_POST["cod_atencion"];
    $sucursal = $_POST["sucursal"];
    $conclusiones = $_POST["conclusiones"];


    if($sucursal == '001' || $sucursal == '002' || $sucursal == '003' || $sucursal == '009') {
        $BD = 'BDV0004';
    } else if($sucursal == '004' || $sucursal == '005'){
        $BD = 'IOLL';
    } else if($sucursal == '006'){
        $BD = 'ETEL';
    } else if($sucursal == '007'){
        $BD = 'CLOFTALMO';
    } else if($sucursal == '008'){
        $BD = 'CLTACNA_TEST';
    }

    $sql_busca = "SELECT COUNT(*) AS CANTIDAD FROM $BD..HCE_INFORME WHERE cod_atencion = $cod_atencion";
    $res_busca = sqlsrv_query($conn, $sql_busca);
    $row_busca = sqlsrv_fetch_array($res_busca);

    if($row_busca['CANTIDAD'] == 0){
        $sql = "INSERT INTO $BD..HCE_INFORME(COD_ATENCION, CONCLUSIONES) 
                VALUES($cod_atencion, '$conclusiones')";
    } else {
        $sql = "UPDATE $BD..HCE_INFORME SET CONCLUSIONES = '$conclusiones' 
                WHERE cod_atencion = $cod_atencion";
    }

    $res = sqlsrv_query($conn, $sql); 

    if($res){
        echo "<script>";
        echo "MensajeGuardar();";
        echo "</script>";
    } else {
        echo "<script>";
        echo "MensajeError();";
        echo "</script>";
    }
 
?>