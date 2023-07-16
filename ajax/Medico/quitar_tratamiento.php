<?php

    require_once "../../config/conexion.php";

    $sucursal = $_POST['sucursal'];
    $id = $_POST['id'];

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

    $sql = "DELETE FROM $BD..HCE_ATENCION_TRATAMIENTO WHERE cod_atencion_tratamiento = $id";
    $res = sqlsrv_query($conn, $sql);

    if($res){
        echo 1;
    } else {
        echo 0;
    }

 
?>