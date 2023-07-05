<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Clínica La Luz Tacna">
    <meta name="autor" content="CLLTacna">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Clínica La Luz Tacna</title>

    <!-- CSS -->
    <link href="dist/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Estilo propio CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">    
</head>

<body class="skin-default card-no-border">
   
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Clínica La Luz Tacna</p>
        </div>
    </div>

    <!-- Main wrapper -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url(assets/images/background/login-register.jpg);">
            <div class="login-box card">
                <div class="card-body">

                    <form method="POST" accept-charset="utf-8" class="form-horizontal form-material m-4" id="loginform" action="ajax/login_action.php">                
                        <div class=" form-group">
                            <br>
                            <div class="text-center">
                                <img src="assets/images/logoclinica.png" >
                            </div>
                            <br>
                            <br>

                            <?php
                                if(isset($_GET["fallo"]) && $_GET["fallo"] == 'true') {
                                    echo "<div class='alert alert-danger alert-dismissible' role='alert'>¡Error! Usuario inválido</div>";
                                }
                                if(isset($_GET["falloc"]) && $_GET["falloc"] == 'true') {
                                    echo "<div class='alert alert-danger alert-dismissible' role='alert'>¡Error! Contraseña inválida</div>";
                                }   
                                if(isset($_GET["fallos"]) && $_GET["fallos"] == 'true') {
                                    echo "<div class='alert alert-danger alert-dismissible' role='alert'>¡Error! Sucursal No Seleccionada</div>";
                                }   
                            ?>

                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" name="cod_usuario" placeholder="Usuario" required> 
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" name="des_password" placeholder="Contraseña" required> 
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <select class="form-control custom-select" name="sucursal" id="sucursal" required>
                                        <option value="000">-- SELECCIONAR SUCURSAL --</option>
                                        <option value="001">Av. Arequipa N° 1148</option>
                                        <option value="002">Av. Perú 3811</option>
                                        <option value="003">Av. Túpac Amaru 809</option>
                                        <option value="004">IOLL - LIMA</option>
                                        <option value="005">IOLL - CHICLAYO</option>
                                        <option value="006">ETEL</option>
                                        <option value="007">BREÑA</option>
                                        <option value="008" selected>TACNA</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Recordar</label>
                                        </div>    
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <div class="col-xs-12 p-b-20">
                                    <button class="btn btn-block btn-lg btn-danger btn-rounded"name="" type="submit">Ingresar</button>
                                </div>
                                <a href="javascript:void(0)" alt="default" data-toggle="modal" data-target="#verticalcenter" class="text-muted"> ¿Olvidaste tu contraseña?</a> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Wrapper -->
                

    <!-- INICIO MODAL -->
    <div id="verticalcenter" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                     <h4 class="modal-title" id="vcenter">¿Olvidaste tu contraseña?</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">         
                      <p>Ponte en contacto con <a href="mailto:sistemastacna@clinicalaluz.com.pe"> sistemas@clinicalaluz.com.pe</a> o llama al <a>(052) 638720 anexo 1200.</a> </p>
                </div>
                <div class="modal-footer">
                      <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL -->

    <!-- ----------------------------------------------------------------------------------------------------------------------------- -->
    <!-- Jquery -->
    <script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/node_modules/popper/popper.min.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>    
    <!-- Estilo propio JS -->
    <script src="dist/js/custom.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>    
</body>
</html>

