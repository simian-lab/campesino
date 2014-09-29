
       <section class="wrapp">
           <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                       
                        <?php echo set_breadcrumb(); ?> 
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 img-general">
                        <img src="<?php echo $base_url_static ?>img/img9.jpg" alt="" class="dsktop">
                        <img src="<?php echo $base_url_static ?>img/disfruta_movil.jpg" class="movil" alt="">
                    </div>
                </div>      
                <div class="row">
                    <div class="col-md-8 detalle">
                        <?php echo $articulo_html ?>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 aside">
                        <h1>patrocinado <b>por:</b></h1>                    
                        <figure>
                            <img src="<?php echo $base_url_static ?>img/patrocinio.jpg" alt="">
                        </figure> 
                        <?php echo $articulos_recomendados_html ?>                                             
                    </div>
                </div>    
                <div class="row banner">
                    <div class="col-lg-12">
                        <a href="#">
                            <img src="<?php echo $base_url_static ?>img/banner-visa.jpg" alt="">
                        </a>
                    </div>
                </div>     
           </div>
        </section>        