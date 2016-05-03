<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Vista Previa</title>
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width" />

        <?php
        //$this->load->helper('get_url_encode_tod');
        $this->load->helper('get_url_base');
        $get_url_base = get_url_base();
        //print_r($get_url_base);
        ?>

        <link rel="stylesheet" href="<?php echo $get_url_base['base_url'] ?>vistaprevia/stylesheets/vendor/normalize.min.css" />
        <link rel="stylesheet" href="<?php echo $get_url_base['base_url'] ?>vistaprevia/stylesheets/bootstrap/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo $get_url_base['base_url'] ?>vistaprevia/stylesheets/vendor/owl.carousel.css" />
        <link rel="stylesheet" href="<?php echo $get_url_base['base_url'] ?>vistaprevia/stylesheets/screen.css" />
        <link rel="stylesheet" href="<?php echo $get_url_base['base_url'] ?>vistaprevia/stylesheets/molfis.css" />
        <link rel="stylesheet" href="<?php echo $get_url_base['base_url'] ?>vistaprevia/stylesheets/vendor/3dhover.css" />
        <?php //die($url_static); ?>

        <script src="<?php echo $get_url_base['base_url'] ?>vistaprevia/js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <?php
        $arrEventos = explode(',', $eventos);
        foreach ($arrEventos as $evento) {
            foreach ($eventos2 as $value) {
                if ($value['EVE_NOMBRE'] == $evento) {
                    $prefijo_evento = 'evento-' . $value['EVE_PREFIJO'];
                }
            }
            if ($seccion == 'premium_home' || $seccion == 'premium'):
                ?>
                <hr><h1 style="font-weight: bolder;text-transform: uppercase;margin-left: 40px;"><?php echo $evento; ?></h1><hr>
                <div class="wrapp section <?php echo $prefijo_evento; ?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="contentPromocionesdestacados">
                                    <div class="destacados">
                                        <ul>
                                            <?php
                                            $li_class = '';
                                            if ($descuento_promocion != '') {
                                                $li_class .= 'descuento ';
                                            }
                                            ?>
                                            <li class="<?php echo $li_class; ?> post col-lg-6 col-md-6 col-sm-6 col-sx-12">
                                                <div class="figure">
                                                    <div class="overlay">
                                                        <p><?php echo $descripcion_promocion ?></p>
        <?php if ($url_promocion != ''): ?>
                                                            <a href="<?php echo $url_promocion ?>" class="link red">ir a oferta</a>
                                                        <?php endif; ?>
                                                        <?php if ($logo_visa == 1): ?>
                                                            <div class="marca">
                                                                <div class="visa_logo">
                                                                    <img src="<?php echo $get_url_base['base_url'] ?>vistaprevia/img/visa.jpg" alt="" />
                                                                </div>
                                                                <div class="isologo">
                                                                    <span>
            <?php echo $texto_visa; ?>
                                                                    </span>
                                                                </div>
                                                            </div>
        <?php endif; ?>
                                                    </div>
                                                    <img src="<?php echo $get_url_base['base_url'] ?>multimedia/promociones/<?php echo $imagen_premium_promocion ?>" alt="" />
                                                </div>
                                                <div class="article">
                                                    <div class="info">
                                                        <h2><?php echo $nombre_tienda; ?></h2>
                                                    </div>
                                                    <div class="desc">
                                                        <p><?php echo $nombre_promocion ?></p>
        <?php if ($precio_final_promocion != ''): ?>
                                                            <span class="ahora">Ahora <?php echo $tipo_moneda_promocion . number_format($precio_final_promocion); ?></span><?php ($precio_inicial_promocion != '') ? print(' - ') : print('') ?>
                                                        <?php endif; ?>
                                                        <?php if ($precio_inicial_promocion != ''): ?>
                                                            <span class="antes">Antes <?php echo $tipo_moneda_promocion . number_format($precio_inicial_promocion); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                        <?php if ($descuento_promocion != ''): ?>
                                                        <div class="porcentaje">
                                                            <img src="<?php echo $get_url_base['base_url'] ?>vistaprevia/img/top-percent.png" alt="" />
                                                            <span class="num"><?php echo $descuento_promocion ?></span>
                                                            <span class="signo">%</span>
                                                            <span>Descuento</span>
                                                        </div>
        <?php endif; ?>
                                                    <a href="<?php echo $url_promocion ?>" class="link orange">ir a oferta</a>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <?php endif; ?>

            <?php if ($seccion == 'general' || $seccion == 'premium'): ?>
                <hr><h1 style="font-weight: bolder;text-transform: uppercase;margin-left: 40px;"><?php echo $evento; ?></h1><hr>
                <div class="wrapp section <?php echo $prefijo_evento; ?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="contentPromocionesnodestacados">
                                    <div class="no-destacados">
                                        <ul>
        <?php
        $li_class = '';
        if ($descuento_promocion != '') {
            $li_class .= 'descuento ';
        }
        ?>
                                            <li class="<?php echo $li_class; ?> post-no-destacados col-lg-4 col-md-4 col-sm-6">
                                                <div class="figure">
                                                    <div class="overlay">
                                                        <p><?php echo $descripcion_promocion ?></p>
        <?php if ($url_promocion != ''): ?>
                                                            <a target="_blank" href="<?php echo $url_promocion ?>" class="link orange">ir a oferta</a>
        <?php endif; ?>
                                                        <?php if ($logo_visa == 1): ?>
                                                            <div class="marca">
                                                                <div class="visa_logo">
                                                                    <img src="<?php echo $get_url_base['base_url'] ?>vistaprevia/img/visa.jpg" alt="" />
                                                                </div>
                                                                <div class="isologo">
                                                                    <span>
            <?php echo $texto_visa; ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                                    <?php endif; ?>
                                                    </div>
                                                    <img src="<?php echo $get_url_base['base_url'] ?>multimedia/promociones/<?php echo $imagen_general_promocion ?>" alt="" />

                                                </div>
                                                <div class="article">
                                                    <div class="info">
                                                        <h2><?php echo $nombre_tienda; ?></h2>
                                                    </div>
                                                    <div class="desc">
                                                        <p><?php echo $nombre_promocion ?></p>
        <?php if ($precio_final_promocion != ''): ?>
                                                            <span class="ahora">Ahora <?php echo $tipo_moneda_promocion . number_format($precio_final_promocion); ?></span>
        <?php endif; ?>
                                                        <?php if ($precio_inicial_promocion != ''): ?>
                                                            <span class="antes">Antes <?php echo $tipo_moneda_promocion . number_format($precio_inicial_promocion); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                        <?php if ($descuento_promocion != ''): ?>
                                                        <div class="porcentaje">
                                                            <img src="<?php echo $get_url_base['base_url'] ?>vistaprevia/img/top-percent.png" alt="" />
                                                            <span class="num"><?php echo $descuento_promocion ?></span>
                                                            <span class="signo">%</span>
                                                            <span>Descuento</span>
                                                        </div>
        <?php endif; ?>
                                                    <a target="_blank" href="<?php echo $url_promocion ?>" class="link orange">ir a oferta</a>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <?php endif;
}; ?>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="<?php echo $get_url_base['base_url'] ?>vistaprevia/js/vendor/jquery-1.10.1.min.js"></script>
        <script src="<?php echo $get_url_base['base_url'] ?>vistaprevia/js/bootstrap/bootstrap.js"></script>
        <script src="<?php echo $get_url_base['base_url'] ?>vistaprevia/js/vendor/owl.carousel.js"></script>
        <script src="<?php echo $get_url_base['base_url'] ?>vistaprevia/js/vendor/respond.min.js"></script>
        <script src="<?php echo $get_url_base['base_url'] ?>vistaprevia/js/vendor/html5shiv.js"></script>
        <script src="<?php echo $get_url_base['base_url'] ?>vistaprevia/js/main.js"></script>

    </body>
</html>
