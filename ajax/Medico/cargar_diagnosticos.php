<?php

    require_once "../../config/conexion.php";
	
    $sucursal = $_POST['sucursal'];
    $cod_atencion = $_POST['cod_atencion'];
    $tipo = $_POST['tipo'];
    $html = "<div class='table-responsive'><table style='border: hidden' class='col-md-12'>";
    
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


    $sql = "SELECT H.cod_atencion_diagnostico, D.COD_DIAGNOSTICO, D.DES_DIAGNOSTICO 
            FROM $BD..HCE_ATENCION_DIAGNOSTICO H
            INNER JOIN $BD..HCE_DIAGNOSTICO D ON D.COD_DIAGNOSTICO = H.cod_diagnostico
            WHERE H.cod_atencion = $cod_atencion and H.tipo = $tipo";
	$res = sqlsrv_query($conn, $sql);
	
	while($row = sqlsrv_fetch_array($res)) {
        $id = $row['cod_atencion_diagnostico'];
        $codigo = $row['COD_DIAGNOSTICO'];
        $nombre = $row['DES_DIAGNOSTICO'];
        
		$html .= "<tr><td width='1000'><input readonly type='text' class='form-control' value='$codigo - $nombre'/></td><td><button type='button' onclick='quitar_diagnostico($id)' class='btn btn-danger'><i class='fa fa-minus'></i></button></td></tr>";
	}

    $html .= "</table></div>";
	
	echo $html;
?>