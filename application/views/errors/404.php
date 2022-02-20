<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="es-PE">
    <!--<![endif]-->
    <?php echo $this->view("head"); ?>
    <body class="templates academy">
        <!-- START CONTAINER -->
        <div class="_container">
            <?php echo $this->view("header"); ?>
            <div class="_main" role="main">
                <div class="_wrapper">
                    <!-- Header -->
                    <!-- 5ta Cata -->
                    <hr style="height:60px;" />
                    <div style="position: static;">
                        <!--Autor movil-->
                        <img data-src="<?php echo site_url() . "assets/page_front/img/autor_m.jpg"; ?>" data-srcset="<?php echo site_url() . "assets/page_front/img/autor_m.jpg"; ?> 2x" class="lazyload tablet_mobile" alt="Rolando Contreras">
                    </div>
                    <div id="group-2" class="_row fixed-width js-waypoint _nopaddingbottom">
                        <div id="group-2" class="_colwrap _centered">
                            <div class="_col" style="width:100%"> </div>
                        </div>
                    </div>
                    <h2 style="text-align:center;">Error 404</h2>
                    <div class="_row fixed-width onecolumn-device padbottom1em">
                        <div class="_colwrap _bi ">
                            <div class="_col _left ">
                                <h2>Esta página no está disponible</h2>
                                <!-- Author's Bio -->
                                <p class="_nospacingtop">Háganos saber cómo podemos ayudar. Cualquier pregunta, sólo escribamos por la sección de contacto y responderemos a su consulta lo antes posible.</p>
                                <p>Atentamente</p>
                                <p><em><b>Rolando Contreras</b></em></p>
                                <!-- End Author's Bio -->
                                <form accept-charset="UTF-8" method="post" action="javascript:void(0);" onclick="inicio();">
                                    <button id="reservar_boton2" class="btn btn-block" type="submit" style="font-size: 20px;background-color: #ffce2a !important;padding: 18px;"><b>VOLVER AL INICIO</b></button>
                                </form>
                                <hr style="height:15px;" />
                            </div>
                            <div class="_col _right ">
                                <!-- Imagen de Author Desktop -->
                                <img data-src="<?php echo site_url() . "assets/page_front/img/autor.jpg"; ?>" data-srcset="<?php echo site_url() . "assets/page_front/img/autor.jpg"; ?> 2x" class="lazyload user-assets compose center _nospacing desktop _nopadding compose full img-round rounded" alt="Rolando Contreras">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $this->load->view("footer"); ?>
        </div>
        <script src="<?php echo site_url() . "assets/seo/lazysizes.min.js"; ?>"></script>
        <script src="<?php echo site_url() . "assets/page_front/js/masterclass.js"; ?>"></script>
        <script src="<?php echo site_url() . "assets/page_front/js/inicio.js"; ?>"></script>
        <script src="<?php echo site_url() . "assets/page_front/js/lazysizes/ls.bgset.min.js"; ?>"></script>
        <script src="<?php echo site_url() . "assets/page_front/js/lazysizes/ls.unveilhooks.min.js"; ?>"></script>
        <script src="<?php echo site_url() . "assets/page_front/js/lazysizes/lazysizes.min.js"; ?>"></script>
        <script src="<?php echo site_url() . "assets/page_front/js/lazysizes/plugins.js"; ?>"></script>
        <script src="<?php echo site_url() . "assets/page_front/js/lazysizes/script.js"; ?>"></script>
        <script src="<?php echo site_url() . "assets/page_front/js/lazysizes/script2.js"; ?>"></script>
    </body>
</html>