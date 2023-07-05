<?php
    session_start();
    if(empty($_SESSION['cod_usuario'])){
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">    
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Clínica La Luz Tacna</title>

    <!--Toaster Popup message CSS -->
    <link href="assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- stylish-tooltip css -->
    <link href="dist/css/pages/stylish-tooltip.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="assets/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- page css -->
    <link href="dist/css/pages/icon-page.css" rel="stylesheet">
    <!-- Calendario CSS -->
    <link href="dist/css/fullcalendar.css" rel="stylesheet"/>
</head>

<body class="skin-red fixed-layout">

    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Clínica La Luz Tacna</p>
        </div>
    </div>

    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <b>
                            <img src="assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>               
                        <span class="hidden-xs"><span class="font-bold">Clínica</span> La Luz</span>
                    </a>
                </div>
                
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto">              
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                    </ul>
                   
                    <ul class="navbar-nav my-lg-0">                        
                        <li class="nav-item dropdown u-pro">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/user2.jpg" alt="user" class=""> <span class="hidden-md-down"><?=$_SESSION['nom_usuario']?> &nbsp;<i class="mdi mdi-chevron-down"></i></span> </a>

                            <div class="dropdown-menu dropdown-menu-right animated flipInY">                       
                                <a href="javascript:void(0)" class="dropdown-item"><i class="ti-user"></i> Mi Perfil</a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="ti-settings"></i> Configuración</a>
                                <div class="dropdown-divider"></div>
                                <a href="ajax/login_close.php" class="dropdown-item"><i class="ti-power-off"></i> Cerrar Sesión</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <?php if($_SESSION['cod_usuario'] == "ENFERMERIA"){ ?>
                        <li class="nav-small-cap">--- ENFERMERIA</li>
                        <!-- PAGINA DE INICIO -->
                        <li>
                            <a class="waves-effect waves-dark" href="triaje.php" aria-expanded="false">
                                <i class="ti-layout-grid2"></i>
                                <span class="hide-menu">Triaje</span>
                            </a>
                        </li>
                        <?php } else if($_SESSION['cod_usuario'] == "ADMIN" || $_SESSION['cod_usuario'] == "FPALMER" || $_SESSION['cod_usuario'] == "OVERA"){ ?>
                        <li class="nav-small-cap">--- Mantenimiento</li>
                        <!-- PAGINA DE INICIO -->
                        <li>
                            <a class="waves-effect waves-dark" href="vista_admin.php" aria-expanded="false">
                                <i class="ti-layout-grid2"></i>
                                <span class="hide-menu">Administrador</span>
                            </a>
                        </li>
                        <?php } else { ?>
                            <li class="nav-small-cap">--- Mantenimiento</li>
                        <!-- PAGINA DE INICIO -->
                        <li>
                            <a class="waves-effect waves-dark" href="vista_medico.php" aria-expanded="false">
                                <i class="ti-layout-grid2"></i>
                                <span class="hide-menu">Lista de citas</span>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="page-wrapper">        
            <div class="container-fluid">
                <br>