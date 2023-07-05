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
   
        
        $PULMONES = $_POST['PULMONES'];
        $DESCRIPCION = $_POST['DESCRIPCION'];
        $FVC = $_POST['FVC'];
        $FEV1 = $_POST['FEV1'];
        $FEV1_FVC = $_POST['FEV1_FVC'];
        $FEF = $_POST['FEF'];
        $CONCLUSION = $_POST['CONCLUSION'];

        $sql_neumologia = "UPDATE $BD..SO_RESULTADO_NEUMOLOGIA SET 
                           PULMONES = '$PULMONES',
                           DESCRIPCION = '$DESCRIPCION',
                           FVC = '$FVC',
                           FEV1 = '$FEV1',
                           FEV1_FVC = '$FEV1_FVC',
                           FEF = '$FEF',
                           CONCLUSION = '$CONCLUSION'
                           WHERE COD_ATENCION = $cod_atencion";
        $res_neumologia = sqlsrv_query($conn, $sql_neumologia);

        if($res_neumologia){ 
            $messages[] = "Registro exitoso en la SO_RESULTADO_NEUMOLOGIA";
        } else {
            $errors[]= "Error al registrar en la SO_RESULTADO_NEUMOLOGIA";
        }


        //CAMBIAR ESTADO EN ADM_ATENCION------------------------
        $sql_atencion = "UPDATE $BD..ADM_ATENCION SET TIP_ESTADO = 1 WHERE COD_ATENCION = $cod_atencion";
        $res_atencion = sqlsrv_query($conn, $sql_atencion);

        if($res_atencion){ 
            $messages[] = "Registro exitoso en la ADM_ATENCION";
        } else {
            $errors[]= "Error al registrar en la ADM_ATENCION";
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