<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Administración - Expansión Consciente</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="author" content="Evolution Web">
        <meta name="distribution" content="Global">
        <!--favicon-->
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo site_url() . 'assets/page_front/images/logo/favico/apple-touch-icon.png'; ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo site_url() . 'assets/page_front/images/logo/favico/favicon-32x32.png'; ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo site_url() . 'assets/page_front/images/logo/favico/favicon-16x16.png'; ?>">
        <link rel="manifest" href="<?php echo site_url() . 'assets/page_front/images/logo/favico/site.webmanifest'; ?>">  
        <!--estilos-->
        <link rel="stylesheet" href="<?php echo site_url() . 'assets/cms/css/style.css'; ?>">
        <link rel="stylesheet" href="<?php echo site_url() . 'assets/cms/css/my_style.css'; ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
        <link rel="stylesheet" href="<?php echo site_url() . 'assets/cms/css/animate.min.css'; ?>">
        <script src="https://unpkg.com/feather-icons"></script>
        <script type="text/javascript">
            var site = '<?php echo site_url(); ?>';
        </script>
        <script src="<?php echo site_url() . 'assets/cms/js/core/bootbox.all.min.js'; ?>"></script>
        <script src="<?php echo site_url() . 'assets/cms/js/core/jquery-1.11.1.min.js'; ?>"></script>
        <script src="<?php echo site_url() . 'assets/cms/js/core/bootstrap.min.js'; ?>"></script>
        <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
        <!--//swetaler2-->
        <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="<?php echo site_url() . 'assets/cms/css/animate.min.css'; ?>">
        <link rel="stylesheet" href="<?php echo site_url() . 'assets/cms/chosen/chosen.min.css'; ?>">
        <script src="<?php echo site_url() . 'assets/cms/css/chosen.css'; ?>"></script>
        <link rel="stylesheet" href="http://html.codedthemes.com/datta-able/bootstrap/assets/plugins/bootstrap-tagsinput-latest/css/bootstrap-tagsinput.css">


    </head>
    <body class="layout-6" style="background-color:#000;">
        <nav class="pcoded-navbar menu-light brand-lightblue menupos-static">
            <div class="navbar-wrapper">
                <div class="navbar-brand header-logo">
                    <a href="<?php echo site_url() . 'dashboard/panel'; ?>" class="b-brand">
                        <img src="<?php echo site_url() . 'assets/page_front/images/logo/evolucion_logo.png'; ?>" alt="Logo" width="40"/>
                        <span class="b-title">Administración</span>
                    </a>
                    <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a></div>
                <div class="navbar-content scroll-div">
                    <ul class="nav pcoded-inner-navbar">
                        <li class="nav-item pcoded-menu-caption"><label>Navegación</label></li>
                        <?php
                        $url = explode("/", uri_string());
                        if (isset($url[1])) {
                            $nav = $url[1];
                        } else {
                            $nav = "";
                        }
                        $panel_syle = null;
                        $mantenimiento_syle = null;
                        $reportes_syle = null;
                        switch ($nav) {
                            case "panel":
                                $panel_syle = "active";
                                break;
                            case "reportes":
                                $reportes_syle = "active";
                                break;
                            default:
                                $mantenimiento_syle = "active";
                                break;
                        }
                        ?>
                        <li class="nav-item">
                            <a href="<?php echo site_url() . 'dashboard/panel'; ?>" class="nav-link <?php echo $panel_syle; ?>">
                                <span class="pcoded-micon">
                                    <i data-feather="home"></i>
                                </span>
                                <span class="pcoded-mtext">Panel</span>
                            </a>
                        </li>
                        <li class="nav-item pcoded-menu-caption"><label>CRUD de Tablas</label></li>
                        <li class="nav-item pcoded-hasmenu">
                            <a href="#!" class="<?php echo $mantenimiento_syle; ?>">
                                <span class="pcoded-micon">
                                    <i data-feather="sliders"></i>
                                </span>
                                <span class="pcoded-mtext">Mantenimientos</span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="pcoded-hasmenu"><a href="<?php echo site_url() . "dashboard/clientes"; ?>"><i class="icon-large icon-th"></i>Clientes</a></li>
                                <li class="pcoded-hasmenu" ><a href="<?php echo site_url() . "dashboard/comentarios"; ?>"><i class="icon-large icon-th"></i>Comentarios</a></li>
                                <li class="pcoded-hasmenu" ><a href="<?php echo site_url() . "dashboard/usuarios"; ?>"><i class="icon-large icon-th"></i>Usuarios</a></li>
                            </ul>
                        </li>
                        <li class="nav-item pcoded-menu-caption"><label>Reportes</label></li>
                        <li class="nav-item pcoded-hasmenu">
                            <a href="#!" class="<?php echo $reportes_syle; ?>">
                                <span class="pcoded-micon">
                                    <i data-feather="external-link"></i>
                                </span>
                                <span class="pcoded-mtext">Reportes</span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="pcoded-hasmenu"><a href="#"><i class="icon-large icon-th"></i>Clientes</a></li>
                                <li class="pcoded-hasmenu" ><a href="#"><i class="icon-large icon-th"></i>Estadísticas</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <header class="navbar pcoded-header navbar-expand-lg navbar-light">
            <div class="m-header"><a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
                <a href="<?php echo site_url() . 'panel'; ?>" class="b-brand">
                    <img src="<?php echo site_url() . 'assets/page_front/images/logo/evolucion_logo.png'; ?>" alt="Logo" width="40"/>
                    <span class="b-title">Administración</span></a>
            </div>
            <a class="mobile-menu" id="mobile-header" href="#!">
                <i class="feather icon-more-horizontal"></i>
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li>
                        <a href="#!" class="full-screen" onclick="javascript:toggleFullScreen()">
                            <i data-feather="maximize"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li>
                        <div class="dropdown drp-user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i data-feather="settings"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-notification">
                                <div class="pro-head">
                                    <img src="<?php echo site_url() . 'assets/cms/img/avatar.jpg'; ?>" class="img-radius" alt="<?php echo $_SESSION['usercms']['name']; ?>">
                                    <span><?php echo $_SESSION['usercms']['name']; ?></span>
                                </div>
                                <ul class="pro-body">
                                    <li>
                                        <a href="<?php echo site_url() . 'dashboard/logout'; ?>" class="dropdown-item"><i data-feather="power"></i> Salir</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        <?php echo $body; ?>
      <!--[if lt IE 11]> <div class="ie-warning"> <h1>Warning!!</h1> <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website. </p> <div class="iew-container"> <ul class="iew-download"> <li> <a href="http://www.google.com/chrome/"> <img src="../assets/images/browser/chrome.png" alt="Chrome"> <div>Chrome</div> </a> </li> <li> <a href="https://www.mozilla.org/en-US/firefox/new/"> <img src="../assets/images/browser/firefox.png" alt="Firefox"> <div>Firefox</div> </a> </li> <li> <a href="http://www.opera.com"> <img src="../assets/images/browser/opera.png" alt="Opera"> <div>Opera</div> </a> </li> <li> <a href="https://www.apple.com/safari/"> <img src="../assets/images/browser/safari.png" alt="Safari"> <div>Safari</div> </a> </li> <li> <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie"> <img src="../assets/images/browser/ie.png" alt=""> <div>IE (11 & above)</div> </a> </li> </ul> </div> <p>Sorry for the inconvenience!</p> </div> <![endif]-->
        <script src="<?php echo site_url() . 'assets/cms/js/core/vendor-all.min.js'; ?>"></script>
        <script src="<?php echo site_url() . 'assets/cms/chosen/chosen.jquery.min.js'; ?>"></script>
        <script src="<?php echo site_url() . 'assets/cms/js/core/pcoded.min.js'; ?>"></script>
        <script src="<?php echo site_url() . 'assets/cms/js/core/datatables.min.js'; ?>"></script>
        <script src="<?php echo site_url() . 'assets/cms/js/core/tbl-datatable-custom.js'; ?>"></script>
        <script src="<?php echo site_url() . 'assets/cms/js/core/chosen.jquery.js'; ?>"></script>
        <script src="http://html.codedthemes.com/datta-able/bootstrap/assets/plugins/bootstrap-tagsinput-latest/js/bootstrap-tagsinput.min.js"></script>
        <script src="http://html.codedthemes.com/datta-able/bootstrap/assets/js/pages/form-advance-custom.js"></script>
        <script>
            feather.replace();
        </script>
    </body>
</html>