<?php

    require_once "../../config/conexion.php";
	
    $sucursal = $_POST['sucursal'];
    $departamento = $_POST['departamento'];
    $html = "<option value='0'>-- SELECCIONE --</option>";

    
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


    $sql = "SELECT COD_UBIGEO_RENIEC, NOM_PROVINCIA FROM $BD..MAE_UBI_PROVINCIAS
            WHERE COD_UBIGEO_RENIEC LIKE '$departamento%' 
            ORDER BY NOM_PROVINCIA";
	$res = sqlsrv_query($conn, $sql);
	
	while($row = sqlsrv_fetch_array($res)) {
        $codigo = $row['COD_UBIGEO_RENIEC'];
        $nombre = strtoupper($row['NOM_PROVINCIA']);
        
		$html .= "<option value='$codigo'>$nombre</option>";
	}
	
	echo $html;
?>