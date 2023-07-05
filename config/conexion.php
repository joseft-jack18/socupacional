<?php

    date_default_timezone_set('America/Lima'); 
    $serverName = "191.98.191.120"; //serverName\instanceName
    //$serverName = "TCP:213.136.78.116\SQLEXPRESS"; //serverName\instanceName
    $connectionInfo = array( "Database"=>'CLTACNA_TEST', "UID"=>"dialyma", "PWD"=>"P@ssw0rd1", "CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if(!$conn){
        die("imposible conectarse: ".mysqli_error($conn));
    }
    if (@mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }

?>
