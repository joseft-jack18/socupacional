<?php

    require_once "../../config/conexion.php";
	
    $sucursal = $_POST['sucursal'];
    $pais = $_POST['pais'];
    $html = "<option value='0'>-- SELECCIONE --</option>";

    
    if($sucursal == '001' || $sucursal == '002' || $sucursal == '003' || $sucursal == '009') {
        $BD = 'BDV0004_PRUEBA';
    } else if($sucursal == '004' || $sucursal == '005') {
        $BD = 'IOLL_PRUEBA';
    } else if($sucursal == '006') {
        $BD = 'ETEL_PRUEBA';
    } else if($sucursal == '007') {
        $BD = 'CLOFTALMO_PRUEBA';
    } else if($sucursal == '008') {
        $BD = 'CLTACNA_TEST';
    }


    $sql = "SELECT COD_UBIGEO_RENIEC, NOM_DEPARTAMENTO FROM $BD..MAE_UBI_DEPARTAMENTOS
            WHERE COD_PAIS = $pais ORDER BY NOM_DEPARTAMENTO";
	$res = sqlsrv_query($conn, $sql);
	
	while($row = sqlsrv_fetch_array($res)) {
        $codigo = $row['COD_UBIGEO_RENIEC'];
        $nombre = strtoupper($row['NOM_DEPARTAMENTO']);
        
		$html .= "<option value='$codigo'>$nombre</option>";
	}
	
	echo $html;
?>