<?php
    // Cómo subir el archivo
    $fichero = $_FILES["file"];
    $cod_atencion = $_POST["cod_atencion"];

    // Cargando el fichero en la carpeta "subidas"
    $path = "../../subidas/".$cod_atencion;
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }

    move_uploaded_file($fichero["tmp_name"], "../../subidas/".$cod_atencion."/".$fichero["name"]);
    // Redirigiendo hacia atrás
    header("Location: " . $_SERVER["HTTP_REFERER"]);

?>