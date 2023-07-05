<?php

    session_start();
    require_once "../config/conexion.php";

    //datos del usuario en el login
    $usuario = $_POST['cod_usuario'];
    $password = $_POST['des_password'];
    $sucursal = $_POST['sucursal'];

    if($sucursal == "000"){
        header ('Location: ../login.php?fallos=true');
    } else {     

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


        $sql = "SELECT COD_USUARIO, DES_PASSWORD, NOM_USUARIO, COD_AREAS, TOKEN 
                FROM $BD..MAE_USUARIO WHERE COD_USUARIO = '$usuario'";
        $res = sqlsrv_query($conn, $sql);
        $row = sqlsrv_fetch_array($res);

        //obtengo los datos del usuario
        $cod_usuario = $row['COD_USUARIO'];
        $clave = $row['DES_PASSWORD'];
        $nom_usuario = $row['NOM_USUARIO'];

        //condicion de la busqueda del usuario
        if(!empty($cod_usuario)) {

            //descencriptar la contraseña del usuario
            $il_longi = 0;
            $il_count = 0;
            $il_suma = 0;
            $il_base = 0;    
            $vl_cadena_conv = "";
            $as_cadena_dev = "";
            $as_cadena_ing = $clave;

            $il_base = ord(substr($as_cadena_ing, -1))/2;
            $vl_cadena_conv = substr($as_cadena_ing,1,(strlen($as_cadena_ing)-2));
            $il_longi = round((strlen($vl_cadena_conv)/4),0);
            $vl_cadena_conv = substr($vl_cadena_conv, $il_longi, strlen($vl_cadena_conv) - (2*$il_longi));

            $il_longi = strlen($vl_cadena_conv);
            $il_count = 0;
            $il_suma = 0;

            while($il_count < $il_longi){
                $as_cadena_dev = $as_cadena_dev.chr(ord(substr($vl_cadena_conv, $il_count, 1)) - $il_base);
                $il_count++;
            }

            //condicion para comparar las contraseñas
            if($password == $as_cadena_dev){
                $_SESSION['cod_usuario'] = $cod_usuario;
                $_SESSION['nom_usuario'] = $nom_usuario;
                $_SESSION['sucursal'] = $sucursal;
                $_SESSION['user_login_status'] = 1;   
                

                if($cod_usuario == "ENFERMERIA"){
                    header ('Location: ../triaje.php');
                } else if($cod_usuario == "ADMIN" || $cod_usuario == "FPALMER" || $cod_usuario == "OVERA"){
                    header ('Location: ../vista_admin.php');
                } else {
                    header ('Location: ../vista_medico.php');
                }
                
            } else {
                header ('Location: ../login.php?falloc=true');
            }
        } else {
            header ('Location: ../login.php?fallo=true');
        }
    }    

?>