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


    $sql = "SELECT H.cod_atencion_plan, L.DES_ARTICULO_SERV 
            FROM $BD..HCE_ATENCION_PLAN H
            INNER JOIN $BD..LOG_ARTICULO_SERV L ON L.COD_ARTICULO_SERV = H.cod_articulo_serv
            WHERE H.cod_atencion = $cod_atencion AND H.cod_proveedor = $tipo";
	$res = sqlsrv_query($conn, $sql);
	
	while($row = sqlsrv_fetch_array($res)) {
        $id = $row['cod_atencion_plan'];
        $nombre = $row['DES_ARTICULO_SERV'];
        
		$html .= "<tr><td style='width: 100%'><input readonly type='text' class='form-control' value='$nombre'/></td><td><button type='button' onclick='quitar_plan($id)' class='btn btn-danger'><i class='fa fa-minus'></i></button></td></tr>";
	}

    $html .= "</table></div>";
	
	echo $html;
?>