<?php

    require_once "../../config/conexion.php";

    $sucursal = $_POST['sucursal'];
    $cod_atencion = $_POST['cod_atencion'];
    $medicamento = $_POST['medicamento'];
    $forma = $_POST['forma'];
    $dosis = $_POST['dosis'];
    $cantidad = $_POST['cantidad'];

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

    $sql = "INSERT INTO $BD..HCE_ATENCION_TRATAMIENTO (COD_ATENCION, NOMBRE_MEDICAMENTO, FORMA, DOSIS, CANTIDAD) 
            VALUES ($cod_atencion, '$medicamento', '$forma', '$dosis', $cantidad)";
    $res = sqlsrv_query($conn, $sql);

    if($res){
        echo 1;
    } else {
        echo 0;
    }

 
?>