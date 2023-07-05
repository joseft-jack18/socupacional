<?php

    $dni = $_POST['dni'];
    //$dni = '76610984';
    //$dni = '93168412';
    $reniec = array();
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://apiperu.dev/api/dni/$dni?api_token=dd1f2f24ed8e4b673a70d1fed774e7a1de7c8a54376299e6a84d4f5d69695796",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_SSL_VERIFYPEER => false
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $info = json_decode($response, true);

        if($info['success'] == true){ 
            $reniec['message'] = 1;
            $reniec['documento'] = $info['data']['numero'];
            $reniec['apellido_paterno'] = $info['data']['apellido_paterno'];
            $reniec['apellido_materno'] = $info['data']['apellido_materno'];
            $reniec['nombres'] = $info['data']['nombres'];
            $reniec['codigo_verificacion'] = $info['data']['codigo_verificacion'];
            $ubigeo = $info['data']['ubigeo_reniec'];
            $reniec['direccion'] = $info['data']['direccion'];
            $reniec['departamento'] = substr($ubigeo,0,2);
            $reniec['provincia'] = substr($ubigeo,2,2);
            $reniec['distrito'] = substr($ubigeo,4,2);
        } else { 
            $reniec['message'] = 0;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($reniec);

?>