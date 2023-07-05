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
  
        function calculaedad($fechanacimiento){
            $nacimiento = new DateTime($fechanacimiento);
            $ahora = new DateTime(date("Y-m-d"));
            $diferencia = $ahora->diff($nacimiento);
            return $diferencia->format("%y");
        }

        /* If connection to database, run sql statement. */
        if ($conn) {
            $var = $_GET['term'];
            $fetch = sqlsrv_query($conn,"SELECT TOP 30 A.NUM_DOC_IDENTIDAD, A.DES_AUXILIAR, A.COD_AUXILIAR, P.DES_GENERO,
                                    P.COD_PACIENTE, C.COD_CLIENTE, P.FEC_NACIMIENTO, A.DES_DIRECCION, A.NUM_TELEFONO, 
                                    A.NUM_EMAIL, P.LUGAR_NACIMIENTO
                                    FROM $BD..MAE_AUXILIAR A
                                    INNER JOIN $BD..ADM_PACIENTE P ON P.COD_AUXILIAR = A.COD_AUXILIAR
                                    INNER JOIN $BD..CXC_CLIENTE C ON C.COD_AUXILIAR = A.COD_AUXILIAR
                                    WHERE A.NUM_DOC_IDENTIDAD LIKE '%$var%' OR A.DES_AUXILIAR LIKE '%$var%'");
  
  	        /* Retrieve and store in array the results of the query.*/
  	        while ($row = sqlsrv_fetch_array($fetch)) {

                $num_documento = $row['NUM_DOC_IDENTIDAD'];
                $nom_paciente = strtoupper($row['DES_AUXILIAR']);
                $cod_auxiliar = $row['COD_AUXILIAR'];
                $cod_paciente = $row['COD_PACIENTE'];
                $cod_cliente = $row['COD_CLIENTE'];
                $email_paciente = $row['NUM_EMAIL'];
                $lugar_nacimiento = strtoupper($row['LUGAR_NACIMIENTO']);
                $dir_paciente = strtoupper($row['DES_DIRECCION']);
                $cel_paciente = $row['NUM_TELEFONO'];

                if($row['DES_GENERO'] == NULL){ $genero = "-"; }
                else if($row['DES_GENERO'] == 'MA'){ $genero = "MASCULINO"; } 
                else if($row['DES_GENERO'] == 'FE'){ $genero = "FEMENINO"; } 

                if($row['FEC_NACIMIENTO'] == NULL){ $edad = 0; }
                else { $edad = calculaedad($row['FEC_NACIMIENTO']->format('Y-m-d')); }              
                

  		        $row_array['value'] = $num_documento.' '.$nom_paciente;
                $row_array['num_documento'] = $num_documento;
                $row_array['nom_paciente'] = $nom_paciente;
                $row_array['cod_auxiliar'] = $cod_auxiliar;
                $row_array['cod_paciente'] = $cod_paciente;
                $row_array['cod_cliente'] = $cod_cliente;
                $row_array['genero'] = $genero;
                $row_array['edad'] = $edad;
                $row_array['lugar_nacimiento'] = $lugar_nacimiento;
                $row_array['direccion'] = $dir_paciente;
                $row_array['celular'] = $cel_paciente;
                $row_array['email'] = $email_paciente;
          
  		        array_push($return_arr, $row_array);
            }    
        }

        /* Free connection resources. */
        sqlsrv_close($conn);

        /* Toss back results as json encoded array. */
        echo json_encode($return_arr);
    }
    
?>