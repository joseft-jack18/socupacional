<?php

    session_start();
    require_once "../../config/conexion.php";

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

    if($action == 'ajax'){
        $sucursal = $_REQUEST['sucursal'];
        $fecha1 = $_REQUEST['fecha1'];
        $fecha2 = $_REQUEST['fecha2'];

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

    
        $sql = "SELECT A.COD_ATENCION, A.FEC_ATENCION, E.DES_ESPECIALIDAD, MA.DES_AUXILIAR, H.ESTADO_TRIAJE,
                CONCAT(P.APE_PATERNO,' ',P.APE_MATERNO,' ',P.NOM_PACIENTE) AS PACIENTE, P.NUM_HC
                FROM $BD..VEN_COMPROBANTES V
                INNER JOIN $BD..ADM_ATENCION A ON A.COD_ATENCION = V.COD_ATENCION
                INNER JOIN $BD..ADM_ATENCION_COBERTURA C ON C.COD_ATENCION = A.COD_ATENCION
                INNER JOIN $BD..CVE_ESPECIALIDAD E ON E.COD_ESPECIALIDAD = A.COD_ESPECIALIDAD
                INNER JOIN $BD..CVE_MEDICO ME ON ME.COD_MEDICO = A.COD_MEDICO
                INNER JOIN $BD..MAE_AUXILIAR MA ON MA.COD_AUXILIAR = ME.COD_AUXILIAR
                INNER JOIN $BD..HCE_CONSULTA_EXTERNA H ON H.COD_ATENCION = A.COD_ATENCION
                INNER JOIN $BD..ADM_PACIENTE P ON P.COD_PACIENTE = H.COD_PACIENTE
                WHERE A.FEC_ATENCION BETWEEN '$fecha1' AND '$fecha2' AND V.TIP_ESTADO IS NULL
                AND V.COD_SUCURSAL = '$cod_sucursal' AND A.COD_ESPECIALIDAD = 31 AND C.COD_COBERTURA = 347
                ORDER BY A.FEC_ATENCION DESC";
        $res = sqlsrv_query($conn, $sql);
        $i = 1;

?>

    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">F. Atención</th>
                <th class="text-center">Paciente</th>
                <th class="text-center">Médico</th>
                <th class="text-center">Especialidad</th>
                <th class="text-center">Acciones</th>                                  
            </tr>
        </thead>
        <tbody>
            <?php while ($row = sqlsrv_fetch_array($res)){
                $cod_atencion = $row['COD_ATENCION'];
                $fec_atencion = $row['FEC_ATENCION']->format('d/m/Y');
                $documento = $row['NUM_HC'];
                $paciente = strtoupper($row['PACIENTE']);
                $medico = strtoupper($row['DES_AUXILIAR']);
                $especialidad = strtoupper($row['DES_ESPECIALIDAD']);
                $estado = $row['ESTADO_TRIAJE'];
            ?>                                         
                            
            <tr>
                <td class="text-center"><?=$i?></td>
                <td class="text-center"><?=$fec_atencion?></td>
                <td><?=$paciente?> <br> <small><?=$documento?></small></td>
                <td><?=$medico?></td>
                <td><?=$especialidad?></td>
                <td class="text-center">
                    <a href="nuevo_triaje.php?sucursal=<?=$sucursal?>&cod_atencion=<?=$cod_atencion?>">
                        <?php if($estado == 1) { ?>
                        <button type="button" class="btn waves-effect waves-light btn-warning">
                            <i class="mdi mdi-pencil"></i> Editar
                        </button>
                        <?php } else {?>
                        <button type="button" class="btn waves-effect waves-light btn-success">
                            <i class="fas fa-check"></i> Atender
                        </button>
                        <?php } ?>
                    </a>  
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
