<?php

    $messages = array();
    $errors = array();

    if (empty($_POST['cod_atencion'])) {
        $errors[] = "Código de atención vacío";

    } else if (!empty($_POST['cod_atencion'])) {        
        require_once "../../config/conexion.php";

        $cod_atencion = $_POST['cod_atencion'];
        $sucursal = $_POST['sucursal'];

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
   
        
        $PIEZAS_MAL_ESTADO = $_POST['PIEZAS_MAL_ESTADO'];
        $PIEZAS_FALTANTES = $_POST['PIEZAS_FALTANTES'];

        $sql_odontologia = "UPDATE $BD..SO_RESULTADO_ODONTOLOGIA SET 
                            PIEZAS_MAL_ESTADO = '$PIEZAS_MAL_ESTADO',
                            PIEZAS_FALTANTES = '$PIEZAS_FALTANTES'
                            WHERE COD_ATENCION = $cod_atencion";
        $res_odontologia = sqlsrv_query($conn, $sql_odontologia);

        if($res_odontologia){ 
            $messages[] = "Registro exitoso en la SO_RESULTADO_ODONTOLOGIA";
        } else {
            $errors[]= "Error al registrar en la SO_RESULTADO_ODONTOLOGIA";
        }


        //CAMBIAR ESTADO EN ADM_ATENCION------------------------
        $sql_atencion = "UPDATE $BD..ADM_ATENCION SET TIP_ESTADO = 1 WHERE COD_ATENCION = $cod_atencion";
        $res_atencion = sqlsrv_query($conn, $sql_atencion);

        if($res_atencion){ 
            $messages[] = "Registro exitoso en la ADM_ATENCION";
        } else {
            $errors[]= "Error al registrar en la ADM_ATENCION";
        }


        //GUARDAR HORA DE ATENCION EN HCE_CONSULTA_EXTERNA------------------------
        $sql_consulta = "UPDATE $BD..HCE_CONSULTA_EXTERNA SET FEC_ACTUALIZA = GETDATE() 
                         WHERE COD_ATENCION = $cod_atencion";
        $res_consulta = sqlsrv_query($conn, $sql_consulta);

        if($res_consulta){ 
            $messages[] = "Registro exitoso en la HCE_CONSULTA_EXTERNA";
        } else {
            $errors[]= "Error al registrar en la HCE_CONSULTA_EXTERNA";
        }


        if (count($errors) == 0){
            echo "<script>";
            echo "MensajeGuardar();";
            echo "</script>";
        } else {             
            echo "<script>";
            echo "MensajeError();";
            echo "</script>";
            var_dump($errors);
        }
    }

?>