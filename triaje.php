<?php require_once "parte_superior.php"; ?>
<?php $sucursal = $_SESSION['sucursal']; ?>

<div class="card">
    <div class="card-body">
	    <h2 class="card-title text-center">Lista de Triaje</h2>

        <div class="row p-20">
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Desde</label> 
                    <input type="hidden" id="sucursal" value="<?=$sucursal?>">
                    <input type="date" id="fecha1" class="form-control" value="<?=date('Y-m-d')?>" onchange='load(1)'>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Hasta</label> 
                    <input type="date" id="fecha2" class="form-control" value="<?=date('Y-m-d')?>" onchange='load(1)'>
                </div>
            </div>
        </div>

        <div id="resultados"></div>
		<div class='outer_div'></div>
    </div>
</div>

<?php require_once "parte_inferior.php"; ?>
<script type="text/javascript" src="js/triaje.js"></script>