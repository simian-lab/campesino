<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?php echo $base_url_static_evento ?>stylesheets/vendor/normalize.min.css">
        <link rel="stylesheet" href="<?php echo $base_url_static_evento ?>stylesheets/bootstrap/bootstrap.css">
        <link rel="stylesheet" href="<?php echo $base_url_static_evento ?>stylesheets/vendor/owl.carousel.css">
        <link rel="stylesheet" href="<?php echo $base_url_static_evento ?>stylesheets/screen.css">
        <link rel="stylesheet" href="<?php echo $base_url_static_evento ?>stylesheets/molfis.css">

        <script src="<?php echo $base_url_static_evento ?>js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <u>outdated</u> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <section class="wrapp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="filtro">
                            <?php if(isset($tienda)): ?>
                                    <span><u> Tienda: </u><?php echo $tienda['TIE_NOMBRE']; ?>  </span>
                            <?php endif; ?> 
                            <?php if(isset($categoria)): ?>
                                    <span> <u> Categoría:</u> <?php echo $categoria['CAT_NOMBRE']; ?> </span>
                            <?php endif; ?> 
                            <?php if(isset($subcategoria)): ?>
                                    <span> <u> Subcategoría:</u> <?php echo $subcategoria['SUB_NOMBRE']; ?> </span>
                            <?php endif; ?> 
                            <?php if(isset($marca)): ?>
                                    <span><u> Marca:</u> <?php echo $marca['MAR_NOMBRE']; ?></span>
                            <?php endif; ?> 
                        </div>
                    </div>
                     <div class="col-lg-12">
                        <div class="filtro">                          
                            <span><u> Nombre: </u><?php echo $promocion['PRO_NOMBRE']; ?>  </span>
                            <span><u> Descripcion: </u><?php echo $promocion['PRO_DESCRIPCION']; ?>  </span>
                            <span><u> Precio inicial:</u><?php echo $promocion['PRO_PRECIO_INICIAL']; ?>  </span>
                            <span><u> Precio final :</u><?php echo $promocion['PRO_PRECIO_FINAL']; ?>  </span>
                            <span><u> Tipo moneda :</u><?php echo $promocion['PRO_TIPO_MONEDA']; ?>  </span>
                            <span><u> Descuento :</u><?php echo $promocion['PRO_DESCUENTO']; ?>  </span>
                            <span><u> Logo Visa:</u><?php echo ($promocion['PRO_LOGO_VISA'] == 1 ? 'Si' : 'No') ; ?>  </span>
                        </div>
                    </div>
                     <div class="col-lg-12">
                        <div class="filtro">
                          
                            <span><u> Url: </u><?php echo $promocion['PRO_URL']; ?>  </span>

                        </div>
                    </div>
                     
                </div>
            </diV 
        </section>

        <?php if($promocion['PRO_SRC_ID'] == '2' || $promocion['PRO_SRC_ID'] == '3'): ?>   
        <section class="wrapp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                         <div class="destacados">
                                    <ul>           

                                        <?php 
                                                $contador = 1;
                                                //foreach($promociones as $promocion):

                                                $li_class = '';
                                                if($promocion['PRO_DESCUENTO'] != ''){
                                                    $li_class .= 'descuento ';
                                                }
                                                if(($contador % 2) == 0){
                                                    $li_class .= 'nm ';
                                                }
                                            ?>
                                                <li class="<?php echo $li_class; ?> post col-lg-6 col-md-6 col-sm-6 col-sx-12">
                                                    <figure>
                                                        <div class="overlay">
                                                            <p><?php echo $promocion['PRO_DESCRIPCION']; ?></p>
                                                            <?php
                                                                $atts = array(
                                                                    'target'      => '_blank',
                                                                    'class'      => 'link red'
                                                                );
                                                               echo anchor($promocion['PRO_URL'], 'ir a oferta', $atts);
                                                            ?>

                                                            <!--<div class="marca">
                                                                <img src="<?php echo $base_url_static_evento;?>img/visa.jpg" alt="">
                                                            </div>-->
                                                        </div>                           

                                                        <img src="<?php echo $base_url_evento_tod; ?>?w=458&amp;h=347&amp;bg=ffffff&amp;zc=1&amp;q=100&amp;src=<?php echo $base_url_img_promociones . $promocion['PRO_LOGO_PREMIUM'] ?>" alt="<?php echo character_limiter(strip_tags($promocion['PRO_DESCRIPCION']), 50); ?>" title="<?php echo strip_tags($promocion['PRO_NOMBRE']); ?>">
                                                    </figure>
                                                    <article>
                                                        <div class="info">
                                                            <h2><?php echo $promocion['PRO_AUTOR']; ?></h2>
                                                        </div>
                                                        <div class="desc">
                                                            <p><?php echo $promocion['PRO_NOMBRE']; ?></p>     
                                                            <?php if($promocion['PRO_PRECIO_FINAL'] != '' && $promocion['PRO_PRECIO_INICIAL'] != ''): ?>                         
                                                            <span class="ahora"><?php echo $promocion['PRO_PRECIO_FINAL']; ?></span>-
                                                            <span class="antes"><?php echo $promocion['PRO_PRECIO_INICIAL']; ?></span>  
                                                            <?php endif; ?>           
                                                        </div>
                                                        <?php if($promocion['PRO_DESCUENTO'] != ''): ?>
                                                        <div class="porcentaje">
                                                            <img src="<?php echo $base_url_static_evento;?>img/top-percent.png" alt="">
                                                            <span class="num"><?php echo $promocion['PRO_DESCUENTO']; ?></span>
                                                            <span class="signo">%</span>
                                                            <span>Descuento</span> 
                                                        </div>   
                                                        <?php endif; ?>
                                                          <?php
                                                                $atts = array(
                                                                    'target'      => '_blank',
                                                                    'class'      => 'link orange'
                                                                );
                                                               echo anchor($promocion['PRO_URL'], 'ir a oferta', $atts);
                                                            ?>

                                                    </article>                                    
                                                </li>
                                            <?php 
                                                $contador++;
                                             //   endforeach; 
                                            ?>


                                        <div class="fix"></div>
                                    </ul>
                                  
                                </div>


                    </div>
                </div>                
            </div>            
        </section>
        <?php endif; ?>

         <?php //if($promocion['PRO_URL'] == 'general' || $if($promocion['PRO_URL'] == 'premium'): ?>
        <?php if($promocion['PRO_SRC_ID'] == '1' || $promocion['PRO_SRC_ID'] == '3'): ?>
        <section class="wrapp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                             <div class="no-destacados">
                                         <ul>
                                                           <?php
                                                                $contador_basicas = 1; 
                                                            //    foreach($promociones as $promocion): 
                                                                
                                                                $li_class = '';
                                                                if($promocion['PRO_DESCUENTO'] != ''){
                                                                    $li_class .= 'descuento ';
                                                                }
                                                                if(($contador_basicas % 3) == 0){
                                                                    $li_class .= 'nm ';
                                                                }
                                                            ?>
                                                                  <li class="<?php echo $li_class; ?> post-no-destacados col-lg-4 col-md-4 col-sm-6">
                                                                        <figure>
                                                                            <div class="overlay">
                                                                                <p><?php echo $promocion['PRO_DESCRIPCION']; ?></p>
                                                                                 <?php
                                                                                    $atts = array(
                                                                                        'target'      => '_blank',
                                                                                        'class'      => 'link orange'
                                                                                    );
                                                                                   echo anchor($promocion['PRO_URL'], 'ir a oferta', $atts);
                                                                                 ?>
                                                                            </div>
                                                                            <img src="<?php echo $base_url_evento_tod; ?>?w=298&amp;h=298&amp;bg=ffffff&amp;zc=1&amp;q=100&amp;src=<?php echo $base_url_img_promociones . $promocion['PRO_LOGO_GENERAL'] ?>" alt="<?php echo character_limiter(strip_tags($promocion['PRO_DESCRIPCION']), 50); ?>" title="<?php echo strip_tags($promocion['PRO_NOMBRE']); ?>">
                                                                        </figure>
                                                                        <article>
                                                                            <div class="info">
                                                                                  <h2><?php echo $promocion['PRO_AUTOR']; ?></h2>
                                                                            </div>
                                                                            <div class="desc">
                                                                               <p><?php echo $promocion['PRO_NOMBRE']; ?></p>     
                                                                                <?php if($promocion['PRO_PRECIO_FINAL'] != '' && $promocion['PRO_PRECIO_INICIAL'] != ''): ?>                         
                                                                                <span class="ahora"><?php echo $promocion['PRO_PRECIO_FINAL']; ?></span>-
                                                                                <span class="antes"><?php echo $promocion['PRO_PRECIO_INICIAL']; ?></span>  
                                                                                <?php endif; ?>           
                                                                            </div>       
                                                                              <?php if($promocion['PRO_DESCUENTO'] != ''): ?>
                                                                                <div class="porcentaje">
                                                                                    <img src="<?php echo $base_url_static_evento;?>img/top-percent.png" alt="">
                                                                                    <span class="num"><?php echo $promocion['PRO_DESCUENTO']; ?></span>
                                                                                    <span class="signo">%</span>
                                                                                    <span>Descuento</span> 
                                                                                </div>   
                                                                                <?php endif; ?>   
                                                                              <?php
                                                                                    $atts = array(
                                                                                        'target'      => '_blank',
                                                                                        'class'      => 'link orange'
                                                                                    );
                                                                                   echo anchor($promocion['PRO_URL'], 'ir a oferta', $atts);
                                                                                ?>
                                                                        </article>                                    
                                                                 </li>
                                                            <?php 
                                                                $contador_basicas++;
                                                            //    endforeach;
                                                            ?>
                                                        <div class="fix"></div>
                                         </ul>

                                    </div>

                    </div>
                </div> 
            </div>            
        </section>        
        <?php endif; ?>
      
    
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo $base_url_static_evento ?>js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
        <script src="<?php echo $base_url_static_evento ?>js/bootstrap/bootstrap.js"></script>
        <script src="<?php echo $base_url_static_evento ?>js/vendor/owl.carousel.js"></script>
        <script src="<?php echo $base_url_static_evento ?>js/vendor/respond.min.js"></script>
        <script src="<?php echo $base_url_static_evento ?>js/vendor/html5shiv.js"></script>
        <script src="<?php echo $base_url_static_evento ?>js/main.js"></script>
    </body>
</html>
