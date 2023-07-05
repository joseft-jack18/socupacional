<?php

    require_once "../../config/conexion.php";
	
    $sucursal = $_POST['sucursal'];
    $provincia = $_POST['provincia'];
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


    $sql = "SELECT COD_UBIGEO_RENIEC, NOM_DISTRITO FROM $BD..MAE_UBI_DISTRITOS
            WHERE COD_UBIGEO_RENIEC LIKE '$provincia%'
            ORDER BY NOM_DISTRITO";
	$res = sqlsrv_query($conn, $sql);
	
	while($row = sqlsrv_fetch_array($res)) {
        $codigo = $row['COD_UBIGEO_RENIEC'];
        $nombre = strtoupper($row['NOM_DISTRITO']);
        
		$html .= "<option value='$codigo'>$nombre</option>";
	}
	
	echo $html;
?>