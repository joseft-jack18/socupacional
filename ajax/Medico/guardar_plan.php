<?php

    require_once "../../config/conexion.php";

    $sucursal = $_POST['sucursal'];
    $cod_atencion = $_POST['cod_atencion'];
    $cod_articulo = $_POST['cod_articulo'];
    $tipo = $_POST['tipo'];

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

    $sql = "INSERT INTO $BD..HCE_ATENCION_PLAN (COD_ATENCION, COD_ARTICULO_SERV, COD_PROVEEDOR) 
            VALUES ($cod_atencion, '$cod_articulo', $tipo)";
    $res = sqlsrv_query($conn, $sql);

    if($res){
        echo 1;
    } else {
        echo 0;
    }

 
?>