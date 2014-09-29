<section class="wrapp">
           <div class="container">    

               
                <div class="row">
                    <div class="col-lg-12">
                       
                        <?php echo set_breadcrumb(); ?> 
                        
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12 img-general">
                        <img src="<?php echo $base_url_static;?>img/img9.jpg" alt="" class="dsktop">
                        <img src="<?php echo $base_url_static;?>img/disfruta_movil.jpg" class="movil" alt="">
                    </div>
                </div>
                
                <div class="row">
                 <!--articulos -->
                           <?php echo $articulos_html;?>

                 <!--articulos -->

                 <!--participantes -->
                           <?php echo $participantes_html;?>
                 <!--participantes -->
                </div>
                <div class="row banner">
                    <div class="col-lg-12">
                        <a href="#">
                            <img src="<?php echo $base_url_static;?>img/banner-visa.jpg" alt="">
                        </a>
                    </div>
                </div>
           </div>
        </section> 