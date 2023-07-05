<?php
    
    session_start();
    require_once "../../config/conexion.php";

    $messages = array();
    $errors = array();
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


    $usuario = $_SESSION['cod_usuario'];
    $fre_cardiaca = $_POST['fre_cardiaca'];
    $fre_respiratoria = $_POST['fre_respiratoria'];
    $pre_arterial = $_POST['pre_arterial'];
    $temperatura = $_POST['temperatura'];
    $peso = $_POST['peso'];
    $talla = $_POST['talla'];
    $imc = $_POST['imc'];
    $per_abdominal = $_POST['per_abdominal'];
    $cintura = $_POST['cintura'];
    $cadera = $_POST['cadera'];
    $icc = $_POST['icc'];
    $estado_civil = $_POST['estado_civil'];
    $residente = $_POST['residente'];
    $tiempo_residencia = $_POST['tiempo_residencia'];
    $seguro = $_POST['seguro'];
    $grado_instruccion = $_POST['grado_instruccion'];
    $saturacion = $_POST['saturacion'];
    $menstruacion = $_POST['menstruacion'];
    
    
    //OBTENER EL COD_EXPEDIENTE---------------------------------------------------------------------------
    $sql_busca = "SELECT COD_EXPEDIENTE FROM $BD..ADM_ATENCION WHERE COD_ATENCION = $cod_atencion";
    $res_busca = sqlsrv_query($conn, $sql_busca);
    $row_busca = sqlsrv_fetch_array($res_busca);        
    $COD_EXPEDIENTE = $row_busca['COD_EXPEDIENTE'];


    //INGRESAR EN TODOS LOS CODIGOS DE ATENCION
    $sql_ing = "SELECT COD_ATENCION FROM $BD..ADM_ATENCION WHERE COD_EXPEDIENTE = $COD_EXPEDIENTE";
    $res_ing = sqlsrv_query($conn, $sql_ing);
    while($row_ing = sqlsrv_fetch_array($res_ing)){
        $cod_atencion2 = $row_ing["COD_ATENCION"];
    
        $sql_tri = "UPDATE $BD..HCE_CONSULTA_EXTERNA SET
                    DES_FRE_CARDIACA = '$fre_cardiaca',
                    DES_FRE_RESPIRA = '$fre_respiratoria',
                    DES_PRESION_ARTERIAL = '$pre_arterial',
                    DES_TEMPERATURA = '$temperatura',
                    DES_PESO = '$peso',
                    DES_TALLA = '$talla',
                    DES_IMC = '$imc',
                    PERIMETRO_ABDOMINAL = '$per_abdominal',
                    DES_CINTURA = '$cintura',
                    DES_CADERA = '$cadera',
                    DES_ICC = '$icc',
                    ESTADO_CIVIL = '$estado_civil',
                    RESIDENTE = '$residente',
                    TIEMPO_RESIDENTE = '$tiempo_residencia',
                    ESSALUD = '$seguro',
                    GRADO_INSTRUCCION = $grado_instruccion,
                    FECHA_TRIAJE = GETDATE(),
                    ESTADO_TRIAJE = 1,
                    USUARIO_TRIAJE = '$usuario',
                    SATURACION = '$saturacion',
                    MENSTRUACION = '$menstruacion'
                    WHERE COD_ATENCION = $cod_atencion2";
        $res_tri = sqlsrv_query($conn, $sql_tri);

        if($res_tri){ 
            $messages[] = "Registro Exitoso en HCE_CONSULTA_EXTERNA - $cod_atencion2";
        } else {
            $errors[] = "ERROR en HCE_CONSULTA_EXTERNA - $sql_tri";
        }
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
    
?>