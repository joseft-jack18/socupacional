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
	
			$fetch = sqlsrv_query($conn, "SELECT TOP 30 cod_articulo_serv, des_articulo_serv 
                                          FROM $BD..log_articulo_serv 
                                          WHERE des_articulo_serv LIKE '%$var%' AND cod_articulo_serv LIKE 'EXAU%'"); 
	
			/* Retrieve and store in array the results of the query.*/
			while ($row = sqlsrv_fetch_array($fetch)) {
				$row_array['value'] = $row['cod_articulo_serv']." - ".$row['des_articulo_serv'];
        		$row_array['cod_articulo_serv'] = $row['cod_articulo_serv'];		
				array_push($return_arr, $row_array);
    		}	
		}

		/* Free connection resources. */
		sqlsrv_close($conn);

		/* Toss back results as json encoded array. */
		echo json_encode($return_arr);
	}

?>