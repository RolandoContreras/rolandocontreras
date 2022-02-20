<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Administrador - Rolando Contreras</title>
        <base href="<?php echo site_url(); ?>">
        <!--[if lt IE 10]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="author" content="Evolución Web" />
        <meta name="robots" content="noindex, nofollow" />
        <!-- favicon-->
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo site_url() . 'assets/welcome/img/logo/favicon/apple-touch-icon.png'; ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo site_url() . 'assets/welcome/img/logo/favicon/favicon-32x32.png'; ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo site_url() . 'assets/welcome/img/logo/favicon/favicon-16x16.png'; ?>">
        <link rel="manifest" href="<?php echo site_url() . 'assets/welcome/img/logo/favicon/site.webmanifest'; ?>">
        <link rel="stylesheet" href="<?php echo site_url() . 'assets/cms/css/style.css'; ?>">
        <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet" media="none" onload="if (media != 'all') media = 'all'">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
        <script>
            var site = "<?php echo site_url(); ?>"
        </script>
    </head>
    <body>
        <div class="auth-wrapper">
            <div class="auth-content">
                <div class="auth-bg">
                    <span class="r"></span><span class="r s"></span><span class="r s"></span><span class="r"></span></div>
                <div class="card">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <img src="<?php echo site_url() . 'assets/page_front/img/logo/logo.png' ?>" alt="logo" width="300"/>
                        </div>
                        <form method="post" action="javascript:void(0);" onsubmit="login();">
                            <div class="input-group mb-3">
                                <input class="form-control" id="email" type="email" placeholder="Email" required>
                            </div>
                            <div class="input-group mb-4">
                                <input class="form-control" id="password" type="password" placeholder="Contrseña" required>
                            </div>
                            <div class="form-group text-left">
                            </div>
                            <button type="submit" onclick="" class="btn btn-primary">Iniciar Sesión</button>
                        </form>
                        <br/>
                        <div id="mensaje"></div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo site_url() . 'assets/cms/js/login.js'; ?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>    
    </body>
</html>
