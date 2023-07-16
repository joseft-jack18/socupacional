<?php

    require_once "../../config/conexion.php";
	
    $sucursal = $_POST['sucursal'];
    $cod_atencion = $_POST['cod_atencion'];
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


    $sql = "SELECT cod_atencion_tratamiento, nombre_medicamento, forma, dosis, cantidad 
            FROM $BD..HCE_ATENCION_TRATAMIENTO WHERE cod_atencion = $cod_atencion";
	$res = sqlsrv_query($conn, $sql);
	
	while($row = sqlsrv_fetch_array($res)) {
        $id = $row['cod_atencion_tratamiento'];
        $nombre = $row['nombre_medicamento'];
        $forma = $row['forma'];
        $dosis = $row['dosis'];
        $cantidad = $row['cantidad'];
        
		$html .= "<tr>
        <td width='800'><input type='text' class='form-control' value='$nombre' readonly/></td>  
        <td width='200'><input type='text' class='form-control' value='$forma' readonly/></td>  
        <td rowspan='2'><button type='button' class='btn btn-block btn-danger' style='height: 70px' onclick='quitar_tratamiento($id)'><i class='fa fa-minus'></i></button></td> 
        </tr>
        <tr>
        <td width='800'><input type='text' class='form-control' value='$dosis' readonly/></td>  
        <td width='200'><input type='text' class='form-control' value='$cantidad' readonly/></td>  
        </tr>";
	}

    $html .= "</table></div>";
	
	echo $html;
?>