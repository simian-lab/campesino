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
        <meta http-equiv="X-Frame-Options" content="deny">

        <?php
             //$this->load->helper('get_url_encode_tod');
             $this->load->helper('get_url_base'); 
             $get_url_base = get_url_base();
             //print_r($get_url_base);
        ?>

        <link rel="stylesheet" href="<?php echo $get_url_base['base_url_style'] ?>bootstrap/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo $get_url_base['base_url_style'] ?>screen.css" />
        <link rel="stylesheet" href="<?php echo $get_url_base['base_url_style'] ?>vendor/owl.carousel.css" />
        <link rel="stylesheet" href="<?php echo $get_url_base['base_url_style'] ?>vendor/owl.transitions.css" />
        <link rel="stylesheet" href="<?php echo $get_url_base['base_url_style'] ?>vendor/animate.css" />

    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <section class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 box no-destacado no-padding-right">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb no-padding">
                        <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 visible-xs aside first-child">
                            <hgroup>
                                <h2><?php echo $nombre_promocion ?></h2>
                                <span>Destino: Cuba</span>
                            </hgroup>
                            <?php if($descuento_promocion != ''): ?>
                            <div class="descuento <?php echo ($descuento_promocion == 100) ? 'font-small' : '' ?>">
                                <?php echo $descuento_promocion ?>%
                            </div> 
                            <?php endif; ?> 
                            <div class="fav-btn true">
                                <a href="#">fav</a>
                            </div>
                        </div>                                  
                        <header class="col-lg-6 col-md-4 col-sm-4 col-xs-6 no-padding">
                            <figure>                    
                                <img src="<?php echo $get_url_base['base_url'] ?>multimedia/promociones/<?php echo $imagen_promocion ?>" />                  
                            </figure>
                        </header>   
                        <div class="col-lg-6 col-md-8 col-sm-8 col-xs-6 hidden-xs aside first-child">
                            <hgroup>
                                <h2><?php echo $nombre_promocion ?></h2>
                                <span>Destino: <?php echo $destino_promocion ?></span>
                            </hgroup>
                            <?php if($descuento_promocion != ''): ?>
                            <div class="descuento <?php echo ($descuento_promocion == 100) ? 'font-small' : '' ?>">
                                <?php echo $descuento_promocion ?>%
                            </div> 
                            <?php endif; ?> 
                            <div class="fav-btn true">
                                <a href="#">fav</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6 aside second-child">
                            <div class="col-lg-12 col-md-4 col-sm-6 col-xs-12">
                                <?php if($precio_final_promocion != ''): ?>  
                                <span>Ahora:</span>
                                <div class="precio">
                                    <span class="black"><?php echo $tipo_moneda_promocion . number_format($precio_final_promocion); ?></span>
                                    <?php if($tipo_moneda_promocion === '$'): ?>
                                    <span>COP</span>
                                <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>          
                            <div class="col-lg-12 col-md-8 col-sm-6 col-xs-12">
                                <?php if($precio_inicial_promocion != ''): ?>
                                <span class="antes">Antes:</span>
                                <span class="tachado"><?php echo $tipo_moneda_promocion . number_format($precio_inicial_promocion); ?> <?php echo ($tipo_moneda_promocion === '$') ? 'COP' : '' ?></span>
                                <?php endif; ?>
                            </div>                          
                        </div>                                      
                        <footer class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="categoria col-lg-7 col-md-7 col-sm-6 col-xs-6 no-padding-left">
                                <div class="cat">
                                    <div class="clipin">
                                        <div class="<?php echo  get_html_categoria_style($cat_slug); ?>"><img src="<?php echo $get_url_base['base_url_img'] ?>icons.png"></div>          
                                    </div>
                                    <span><?php echo $categoria_promocion ?></span>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 text-right no-padding">
                                <a href="<?php echo prep_url($url_promocion) ?>" target="_blank" class="btn-oferta">Ir a la oferta</a>
                                <span>
                                    <a>
                                        Vía 
                                        <?php echo $nombre_tienda; ?>
                                        <?php if($rnt != ''){
                                                echo 'RNT: ' . $rnt;
                                            } ?>
                                    </a>
                                </span>
                            </div>
                            <div class="fix"></div>
                        </footer>                       
                    </div>   
                </div>  
            </div>
        </section>   

      
        
        <script src="<?php echo $get_url_base['base_url_js'] ?>libs/jquery/jquery-1.10.1.min.js"></script>
        <script src="<?php echo $get_url_base['base_url_js'] ?>libs/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo $get_url_base['base_url_js'] ?>libs/vendor/owl.carousel.min.js"></script>
        <script src="<?php echo $get_url_base['base_url_js'] ?>internas/sliders.js"></script>
        <script src="<?php echo $get_url_base['base_url_js'] ?>internas/favoritos.js"></script>
        <script src="<?php echo $get_url_base['base_url_js'] ?>internas/menu-mobile.js"></script>
        
    </body>
</html>