<?php require_once "parte_superior.php"; ?>
<?php $sucursal = $_SESSION['sucursal']; ?>

<!-- AQUI EMPIEZA EL CUERPO -->
<div class="card-group">
    <div class="card">
        <div class="card-body">
    		<h2 class="card-title text-center">Lista de Citas</h2>

            <div class="row pt-3">
                <div class="form-group col-md-3">
                    <label class="control-label">Sucursal</label>
                    <select class="form-control custom-select" id="sucursal" onchange="load(1)">
                        <option value="000">-- SELECCIONAR SUCURSAL --</option>
                        <option value="001" <?php if($sucursal == '001'){ echo "selected"; }?>>Av. Arequipa N° 1148</option>
                        <option value="002" <?php if($sucursal == '002'){ echo "selected"; }?>>Av. Perú 3811</option>
                        <option value="003" <?php if($sucursal == '003'){ echo "selected"; }?>>Av. Túpac Amaru 809</option>
                        <option value="004" <?php if($sucursal == '004'){ echo "selected"; }?>>IOLL - LIMA</option>
                        <option value="005" <?php if($sucursal == '005'){ echo "selected"; }?>>IOLL - CHICLAYO</option>
                        <option value="006" <?php if($sucursal == '006'){ echo "selected"; }?>>ETEL</option>
                        <option value="007" <?php if($sucursal == '007'){ echo "selected"; }?>>BREÑA</option>
                        <option value="008" <?php if($sucursal == '008'){ echo "selected"; }?>>TACNA</option>
                        <option value="009" <?php if($sucursal == '009'){ echo "selected"; }?>>San Juan De Lurigancho</option>
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label class="control-label">Desde</label>
                    <input type="date" class="form-control" id="fecha_inicio" value="<?=date("Y-m-d")?>" onchange='load(1)'>
                </div>

                <div class="form-group col-md-2">
                    <label class="control-label">Hasta dsfsdf</label>
                    <input type="date" class="form-control" id="fecha_final" value="<?=date("Y-m-d")?>" onchange='load(1)'>
                </div>
            </div>

            <div id="resultados"></div>
            <div class='outer_div'></div>
        </div>
    </div> 
</div>
<!-- AQUI TERMINA EL CUERPO -->

<?php require_once "parte_inferior.php"; ?>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script type="text/javascript" src="js/vista_medico.js"></script>
