<?php

	session_start();
	$sucursal = $_GET['sucursal'];

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

	if (isset($_GET['term'])){
		include("../../config/conexion.php");
		$return_arr = array();

		/* If connection to database, run sql statement. */
		if ($conn) {
    		$var = $_GET['term'];
	
			$fetch = sqlsrv_query($conn, "SELECT TOP 50 cod_especialidad, des_especialidad 
                                          FROM $BD..cve_especialidad 
                                          WHERE des_especialidad LIKE '%$var%'"); 
	
			/* Retrieve and store in array the results of the query.*/
			while ($row = sqlsrv_fetch_array($fetch)) {
				$row_array['value'] = $row['des_especialidad'];
        		$row_array['cod_especialidad'] = $row['cod_especialidad'];		
				array_push($return_arr, $row_array);
    		}	
		}

		/* Free connection resources. */
		sqlsrv_close($conn);

		/* Toss back results as json encoded array. */
		echo json_encode($return_arr);
	}

?>