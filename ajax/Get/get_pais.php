<?php

    require_once "../../config/conexion.php";
	
	$sucursal = $_POST['sucursal'];
    $html= "<option value='0'>-- SELECCIONE --</option>";

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
	

    $sql = "SELECT COD_PAIS, NOM_PAIS FROM $BD..MAE_PAIS";
	$res = sqlsrv_query($conn, $sql);

    while($row = sqlsrv_fetch_array($res)) {
        $codigo = $row['COD_PAIS'];
        $nombre = $row['NOM_PAIS'];  
        
        if($codigo == '144') { $selected = "selected"; } else { $selected = ""; }

		$html .= "<option value='$codigo' $selected>$nombre</option>";
	}
	
    echo $html;

?>