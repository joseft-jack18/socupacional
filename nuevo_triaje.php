<?php 
    require_once "parte_superior.php";
    require_once "config/conexion.php";

    $sucursal = $_GET['sucursal'];
    $cod_atencion = $_GET['cod_atencion'];

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

    $sql = "SELECT CONCAT(P.APE_PATERNO,' ',P.APE_MATERNO,' ',P.NOM_PACIENTE) AS PACIENTE, P.NUM_HC, 
            DATEDIFF(YEAR,P.FEC_NACIMIENTO,GETDATE()) AS EDAD, P.DES_GENERO, H.DES_FRE_CARDIACA, 
            H.DES_FRE_RESPIRA, H.DES_PRESION_ARTERIAL, H.DES_TEMPERATURA, H.DES_PESO, H.DES_TALLA, 
            H.DES_IMC, H.PERIMETRO_ABDOMINAL, H.DES_CINTURA, H.DES_CADERA, H.DES_ICC, H.ESTADO_CIVIL, 
            H.RESIDENTE, H.TIEMPO_RESIDENTE, H.ESSALUD, H.GRADO_INSTRUCCION, H.SATURACION, H.MENSTRUACION
            FROM $BD..HCE_CONSULTA_EXTERNA H
            INNER JOIN $BD..ADM_PACIENTE P ON P.COD_PACIENTE = H.COD_PACIENTE
            WHERE H.COD_ATENCION = $cod_atencion";
    $res = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($res);

    $PACIENTE = strtoupper($row['PACIENTE']);
    $NUM_HC = $row['NUM_HC'];
    $EDAD = $row['EDAD'];
    if($row['DES_GENERO'] == "MA"){ $DES_GENERO = "MASCULINO"; } else { $DES_GENERO = "FEMENINO"; }

    $DES_FRE_CARDIACA = $row['DES_FRE_CARDIACA'];
    $DES_FRE_RESPIRA = $row['DES_FRE_RESPIRA'];
    $DES_PRESION_ARTERIAL = $row['DES_PRESION_ARTERIAL'];
    $DES_TEMPERATURA = $row['DES_TEMPERATURA'];
    $DES_PESO = $row['DES_PESO'];
    $DES_TALLA = $row['DES_TALLA'];
    $DES_IMC = $row['DES_IMC'];
    $PERIMETRO_ABDOMINAL = $row['PERIMETRO_ABDOMINAL'];
    $DES_CINTURA = $row['DES_CINTURA'];
    $DES_CADERA = $row['DES_CADERA'];
    $DES_ICC = $row['DES_ICC'];
    $ESTADO_CIVIL = $row['ESTADO_CIVIL'];
    $RESIDENTE = $row['RESIDENTE'];
    $TIEMPO_RESIDENTE = $row['TIEMPO_RESIDENTE'];
    $ESSALUD = $row['ESSALUD'];
    $GRADO_INSTRUCCION = $row['GRADO_INSTRUCCION'];
    $SATURACION = $row['SATURACION'];
    $MENSTRUACION = $row['MENSTRUACION'];

?>

<div class="row">                  
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">    
                <form method="post" id="guardar_triaje" name="guardar_triaje">   
                    <h4 class="card-title text-center">REGISTRAR TRIAJE</h4>
                    <hr>

                    <div class="row p-20">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Frecuencia cardiaca <small>(x minuto)</small> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="fre_cardiaca" name="fre_cardiaca" value="<?=$DES_FRE_CARDIACA?>" required>
                                <input type="hidden" class="form-control" id="cod_atencion" name="cod_atencion" value="<?=$cod_atencion?>">
                                <input type="hidden" class="form-control" id="sucursal" name="sucursal" value="<?=$sucursal?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Frecuencia respiratoria <small>(x minuto)</small> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="fre_respiratoria" name="fre_respiratoria" value="<?=$DES_FRE_RESPIRA?>" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Presión arterial <small>(mmHg)</small> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="pre_arterial" name="pre_arterial" value="<?=$DES_PRESION_ARTERIAL?>" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Temperatura <small>(°C)</small> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="temperatura" name="temperatura" value="<?=$DES_TEMPERATURA?>" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">PESO<small>(kg)</small> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="peso" name="peso" value="<?=$DES_PESO?>" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">TALLA <small>(m)</small> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="talla" name="talla" value="<?=$DES_TALLA?>" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">IMC</label>
                                <input type="text" class="form-control" id="imc" name="imc" readonly value="<?=$DES_IMC?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">PERIMETRO ABDOMINAL <small>(cm)</small> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="per_abdominal" name="per_abdominal" value="<?=$PERIMETRO_ABDOMINAL?>" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">CINTURA<small>(cm)</small> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="cintura" name="cintura" value="<?=$DES_CINTURA?>" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">CADERA <small>(cm)</small> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="cadera" name="cadera" value="<?=$DES_CADERA?>" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">ICC</label>
                                <input type="text" class="form-control" id="icc" name="icc" readonly value="<?=$DES_ICC?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">ESTADO CIVIL <span class="text-danger">*</span></label>
                                <select class="form-control custom-select" id="estado_civil" name="estado_civil" value="<?=$ESTADO_CIVIL?>" required>
                                    <option value="SOLTERO" <?php if($ESTADO_CIVIL == "SOLTERO"){ echo "selected"; } ?>>SOLTERO(A)</option>
                                    <option value="CONVIVIENTE" <?php if($ESTADO_CIVIL == "CONVIVIENTE"){ echo "selected"; } ?>>CONVIVIENTE</option>
                                    <option value="CASADO" <?php if($ESTADO_CIVIL == "CASADO"){ echo "selected"; } ?>>CASADO(A)</option>
                                    <option value="SEPARADO" <?php if($ESTADO_CIVIL == "SEPARADO"){ echo "selected"; } ?>>SEPARADO(A)</option>
                                    <option value="DIVORCIADO" <?php if($ESTADO_CIVIL == "DIVORCIADO"){ echo "selected"; } ?>>DIVORCIADO(A)</option>
                                    <option value="VIUDO" <?php if($ESTADO_CIVIL == "VIUDO"){ echo "selected"; } ?>>VIUDO(A)</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">SATURACION <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="saturacion" name="saturacion" value="<?=$SATURACION?>">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">RESIDENTE <span class="text-danger">*</span></label>
                                <select class="form-control custom-select" id="residente" name="residente" value="<?=$RESIDENTE?>" required>
                                    <option value="SI" <?php if($RESIDENTE == "SI"){ echo "selected"; } ?>>SI</option>
                                    <option value="NO" <?php if($RESIDENTE == "NO"){ echo "selected"; } ?>>NO</option>
                                </select>
                            </div>
                        </div>  

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">TIEMPO DE RESIDENCIA </label>
                                <input type="text" class="form-control" id="tiempo_residencia" name="tiempo_residencia" value="<?=$TIEMPO_RESIDENTE?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">SEGURO <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="seguro" name="seguro" value="<?=$ESSALUD?>" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">GRADO DE INSTRUCCION <span class="text-danger">*</span></label>
                                <select class="form-control custom-select" id="grado_instruccion" name="grado_instruccion" required>
                                    <option value="">-- SELECCIONAR --</option>
                                    <option value="1" <?php if($GRADO_INSTRUCCION == "1"){ echo "selected"; } ?>>Analfabeto(a)</option>
                                    <option value="2" <?php if($GRADO_INSTRUCCION == "2"){ echo "selected"; } ?>>Primaria Completa</option>
                                    <option value="3" <?php if($GRADO_INSTRUCCION == "3"){ echo "selected"; } ?>>Primaria Imcompleta</option>
                                    <option value="4" <?php if($GRADO_INSTRUCCION == "4"){ echo "selected"; } ?>>Secundaria Completa</option>
                                    <option value="5" <?php if($GRADO_INSTRUCCION == "5"){ echo "selected"; } ?>>Secundaria Incompleta</option>
                                    <option value="6" <?php if($GRADO_INSTRUCCION == "6"){ echo "selected"; } ?>>Educación Técnica</option>
                                    <option value="7" <?php if($GRADO_INSTRUCCION == "7"){ echo "selected"; } ?>>Educación Universitaria</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">ULTIMA MENSTRUACION</label>
                                <input type="text" class="form-control" id="menstruacion" name="menstruacion" value="<?=$MENSTRUACION?>">
                            </div>
                        </div>

                        <div class="col-md-12 text-right">                              
                            <button type="submit" id="guardar_datos_triaje" class="btn waves-effect waves-light btn-bloc btn-success ">
                                <i class="mdi mdi-content-save"></i> GUARDAR
                            </button>
                            <div id="resultados_ajax"></div>                        
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- CARD LATERAL -->
    <div class="col-md-3">                    
        <div class="card">
            <div class="card-body">     
                <h4 class="card-title">DATOS DEL PACIENTE</h4>
                <hr>

                <div class="row">
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label class="control-label">Nro Documento</label>
                            <input type="text" id="nom_paciente" class="form-control" value="<?=$NUM_HC?>" readonly>
                        </div>
                    </div>

                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label class="control-label">Apellidos y nombres</label>
                            <input type="text" id="nom_paciente" class="form-control" value="<?=$PACIENTE?>" readonly>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Edad</label>
                            <input type="text" id="edad_paciente" class="form-control" value="<?=$EDAD?>" readonly>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">   
                            <label class="control-label">Sexo</label>
                            <input type="text" id="sexo_paciente" class="form-control" value="<?=$DES_GENERO?>" readonly>
                        </div>
                    </div>              
                </div>
            </div>
        </div>   
    </div>
</div>

<?php require_once "parte_inferior.php"; ?>
<script type="text/javascript" src="js/triaje.js"></script>



