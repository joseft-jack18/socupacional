<?php

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
            $sql = 'SELECT id, internal_id, description FROM items 
                    WHERE (description LIKE "%'.$var.'%" OR second_name LIKE "%'.$var.'%"
                    OR name LIKE "%'.$var.'%") AND stock > 0 limit 20';
            $query = "SELECT * FROM openquery(MYSQL, '$sql')";
			$fetch = sqlsrv_query($conn, $query);

			/* Retrieve and store in array the results of the query.*/
		    while ($row = sqlsrv_fetch_array($fetch)) {
				$row_array['value'] = $row['internal_id']." | ".$row['description'];
		        $row_array['cod_articulo_serv'] = $row['internal_id'];
				$row_array['des_articulo_serv'] = $row['description'];
				array_push($return_arr, $row_array);
		    }
		}

		/* Free connection resources. */
		sqlsrv_close($conn);

		/* Toss back results as json encoded array. */
		echo json_encode($return_arr);
	}
?>