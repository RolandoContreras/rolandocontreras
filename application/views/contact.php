<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="es-PE">
    <!--<![endif]-->
    <?php echo $this->view("head");?>
    <body class="templates academy">
        <!-- START CONTAINER -->
        <div class="_container">
            <?php echo $this->view("header");?>
            <div class="_main" role="main">
                <div class="_wrapper">
                    <!-- Header -->
                    <!-- 5ta Cata -->
                    <div style="position:relative;">
                        <hr style="height:60px;" />
                        <div class="bg-lp-absolute lazyload" data-bgset="<?php echo site_url() . "assets/page_front/img/im_footer.jpg"; ?> 1440w, <?php echo site_url() . "assets/page_front/img/im_footer.jpg"; ?> 2880w"
                             data-sizes="1440px" style="background-color:#f7f7f7;"></div> 
                        <img data-src="<?php echo site_url() . "assets/page_front/img/immovil.jpg"; ?>" data-srcset="<?php echo site_url() . "assets/page_front/img/immovil.jpg"; ?> 2x"
                             class="bg-lp-mobile lazyload img-full">
                        <div class="_row fixed-width aside-left">
                            <div class="_colwrap _quarters ">
                                <div class="_col _aside "> </div>
                                <div class="_col _article heading-txt signup-btm">
                                    <hr class="mobile tablet" style="height:20px;" />
                                    <hr class="desktop" style="height:30px;" />
                                    <h2 style="text-align:center;" class="_nomarginbottom">Contáctanos</h2>
                                    <hr style="height:30px;" />
                                    <h6 style="text-align:center;" class="playing-now-black txt-normal text-uppercase"><i class="fa fa-user" aria-hidden="true"></i> ESTAREMOS ENCANTANDO DE CONTESTARTE</h6>
                                    <hr style="height:30px;" />
                                    <hr style="height:2px;" />
                                    <div class="lp-signup new2019">
                                        <hr style="height:10px;" />
                                        <p style="text-align:center;" class="formtitle txt-white"><strong>Déjanos tus datos personales y estaremos en comunicación contigo a la brevedad posible. Gracias por tu confianza.</p>
                                        <div class="_row fixed-width padleftright10 padbottom1em">
                                            <div class="_colwrap _centered">
                                                <div class="container">
                                                    <div class="_col" style="width:100%"> 
                                                        <form accept-charset="UTF-8" method="post" action="javascript:void(0);" onsubmit="send_message();" id="contactForm">
                                                            <div class="form-group required" id="div_id_name">
                                                                <label class="control-label white-color" for="id_name">Nombre <span class="red-color">*</span></label>
                                                                <div class="controls ">
                                                                    <input class="textinput textInput form-control form-control" id="name" name="name" type="text" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group required" id="div_id_email">
                                                                <label class="control-label white-color" for="id_email">Correo Electrónico <span class="red-color">*</span></label>
                                                                <div class="controls ">
                                                                    <input class="textinput textInput form-control form-control" id="email" name="email" type="email" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group required" id="div_id_email">
                                                                <label class="control-label white-color" for="id_email">Teléfono <span class="red-color">*</span> (agregar código de país)</label>
                                                                <div class="controls ">
                                                                    <input class="textinput textInput form-control form-control" id="phone" name="phone" type="text" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group required" id="div_id_email">
                                                                <label class="control-label white-color" for="id_message">Mensaje <span class="red-color">*</span></label>
                                                                <div class="controls">
                                                                    <input class="textinput textInput form-control form-control" id="message" name="message" type="text" required="">
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="google-response-token" id="google-response-token">
                                                            <button  id="contact_boton" class="btn btn-block" type="submit" style="font-size: 20px;background-color: #ffce2a !important;padding: 18px;"><b>ENVIAR MENSAJE</b></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- GDPR -->
                                    <div class="_row fixed-width ">
                                        <div class="_colwrap _centered">
                                            <div class="_col" style="width:100%">
                                                <p style="text-align: center; font-size: 0.75rem;padding: 0px 35px;"> Al hacer clic en el botón de arriba, usted está creando una cuenta en www.rolandocontreras.com y está de acuerdo con nuestra <a href="<?php echo site_url() . "politica-de-privacidad"; ?>">Política de privacidad </a> y <a href="<?php echo site_url() . "terminos-y-condiciones"; ?>"> Condiciones de uso</a>,  incluyendo la recepción de correos electrónicos. </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END GDPR -->
                                    <hr style="height:20px;" />
                                    <!-- END SIGN UP FORM -->
                                </div>
                            </div>
                        </div>
                        <hr style="height:10px;" />
                    </div>
                </div>
            </div>
            <?php echo $this->load->view("footer");?>
        <script src='https://www.google.com/recaptcha/api.js?render=6Ld1reMZAAAAAH7vlrl4cRnb9LMmKaNF-5v3GeHl'></script>
        </div>
        <script src="<?php echo site_url() . "assets/seo/lazysizes.min.js"; ?>"></script>
        <script src="<?php echo site_url() . "assets/page_front/js/contact.js"; ?>"></script>
        <script src="<?php echo site_url() . "assets/page_front/js/lazysizes/ls.bgset.min.js"; ?>"></script>
        <script src="<?php echo site_url() . "assets/page_front/js/lazysizes/ls.unveilhooks.min.js"; ?>"></script>
        <script src="<?php echo site_url() . "assets/page_front/js/lazysizes/lazysizes.min.js"; ?>"></script>
        <script src="<?php echo site_url() . "assets/page_front/js/lazysizes/plugins.js"; ?>"></script>
        <script src="<?php echo site_url() . "assets/page_front/js/lazysizes/script.js"; ?>"></script>
        <script src="<?php echo site_url() . "assets/page_front/js/lazysizes/script2.js"; ?>"></script>
</body>
</html>