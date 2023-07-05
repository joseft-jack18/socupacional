<?php

    session_start();
    require_once "../../config/conexion.php";

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] != NULL)?$_REQUEST['action']:'';    

    if($action == 'ajax'){        
        $sucursal = $_REQUEST['sucursal'];
        $fecha1 = $_REQUEST['fecha1'];
        $fecha2 = $_REQUEST['fecha2'];
        $usuario = $_SESSION['cod_usuario'];


        if($sucursal == '001' || $sucursal == '002' || $sucursal == '003' || $sucursal == '009') {
            $BD = 'BDV0004';
            if($sucursal == '001' || $sucursal == '002' || $sucursal == '003'){
                $cod_sucursal = $sucursal;      
            } else if($sucursal == '009'){
                $cod_sucursal = '004';      
            }
        } else if($sucursal == '004' || $sucursal == '005') {
            $BD = 'IOLL';
            if($sucursal == '004') {
                $cod_sucursal = '001';
            } else if($sucursal == '005') {
                $cod_sucursal ='002';
            } 
        } else if($sucursal == '006') {
            $BD = 'ETEL';
            $cod_sucursal = '001';
        } else if($sucursal == '007') {
            $BD = 'CLOFTALMO';
            $cod_sucursal = '001';
        } else if($sucursal == '008') {
            $BD = 'CLTACNA_TEST';
            $cod_sucursal = '001';
        }


        $sql_medico = "SELECT COD_MEDICO FROM $BD..CVE_MEDICO WHERE COD_USUARIO_MEDICO = '$usuario'";
        $res_medico = sqlsrv_query($conn, $sql_medico);
        $row_medico = sqlsrv_fetch_array($res_medico);
        $cod_medico = $row_medico['COD_MEDICO'];


        $sql = "SELECT A.COD_ATENCION, A.FEC_ATENCION, V.COD_DOCUMENTO, F.DES_COBERTURA, P.APE_PATERNO, 
                P.APE_MATERNO, P.NOM_PACIENTE, P.NUM_HC, A.TIP_ESTADO, A.COD_ESPECIALIDAD
                FROM $BD..VEN_COMPROBANTES V
                INNER JOIN $BD..ADM_ATENCION A ON A.COD_ATENCION = V.COD_ATENCION
                INNER JOIN $BD..ADM_ATENCION_COBERTURA C ON C.COD_ATENCION = A.COD_ATENCION
                INNER JOIN $BD..ADM_EXPEDIENTE E ON E.COD_EXPEDIENTE = A.COD_EXPEDIENTE 
                INNER JOIN $BD..ADM_PACIENTE P ON P.COD_PACIENTE = E.COD_PACIENTE 
                INNER JOIN $BD..CVE_COBERTURA F ON F.COD_COBERTURA = C.COD_COBERTURA
                WHERE A.FEC_ATENCION >= '$fecha1' AND A.FEC_ATENCION <= '$fecha2' AND C.COD_COBERTURA = 347
                AND V.COD_SUCURSAL = '$cod_sucursal' AND V.TIP_ESTADO IS NULL AND A.COD_MEDICO = $cod_medico
                ORDER BY A.FEC_ATENCION DESC";
        $res = sqlsrv_query($conn, $sql);
        $i = 1;

?>

    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>                         
                <th class="text-center">#</th>   
                <th class="text-center">Concepto</th>
                <th class="text-center">Paciente</th>
                <th class="text-center">Fecha Atención</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>                                  
            </tr>
        </thead>
        <tbody>
            <?php while($row = sqlsrv_fetch_array($res)) { 
                $cod_atencion = $row['COD_ATENCION'];
                $cod_especialidad = $row['COD_ESPECIALIDAD'];
                $fec_atencion = $row['FEC_ATENCION']->format('d/m/Y');
                $cod_documento = $row['COD_DOCUMENTO'];
                $cobertura = $row['DES_COBERTURA'];
                $estado = $row['TIP_ESTADO'];            
                $paciente = strtoupper($row['APE_PATERNO'].' '.$row['APE_MATERNO'].' '.$row['NOM_PACIENTE']);
                $num_hc = $row['NUM_HC'];

                if($cod_documento == 'BV' || $cod_documento == 'FV' || $cod_documento == 'PP') {
                    $status = 'Pagado';
                    $label = 'badge-pill badge-info';
                } else if($cod_documento == 'OS') {
                    $status = 'Reservado';
                    $label = 'badge-pill badge-warning';
                }
            ?>
            <tr>
                <td class="text-center"><?=$i?></td>
                <td><?=$cobertura?></td>
                <td><?=$paciente?> <br> <small><?=$num_hc?></small> </td>
                <td class="text-center"><?=$fec_atencion?></td>
                <td class="text-center"><span class="badge <?=$label?>"><?=$status?></span></td>
                <td class="text-center">                    
                    <button type="button" class="btn waves-effect waves-light btn-success" onclick="atender(<?=$cod_atencion?>,<?=$cod_especialidad?>)">
                        <i class="mdi mdi-check"></i> Atender
                    </button>

                    <button type="button" class="btn waves-effect waves-light btn-warning" onclick="atender(<?=$cod_atencion?>,<?=$cod_especialidad?>)">
                        <i class="mdi mdi-printer"></i> Editar
                    </button>
                    <button type="button" class="btn waves-effect waves-light btn-danger" onclick="ver_historia(<?=$cod_atencion?>,<?=$cod_especialidad?>)">
                        <i class="mdi mdi-printer"></i> Consulta
                    </button>

                    <button type="button" class="btn waves-effect waves-light btn-danger" onclick="subir(<?=$cod_atencion?>)">
                        <i class="mdi mdi-upload"></i> Informe
                    </button>
                </td>
            </tr>
            <?php $i++; } ?>
        </tbody>
    </table>
<?php } ?>


<!-- DataTables CSS -->
<link href="assets/datatables/jquery.dataTables.min.css" rel="stylesheet">
<!-- DataTables JS -->
<script src="assets/datatables/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "scrollX": true,
            "info": false,
            "lengthChange": false,
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    } );
</script>