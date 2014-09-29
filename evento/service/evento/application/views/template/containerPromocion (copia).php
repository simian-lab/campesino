<?php echo $menu_html;?>
<div class="share">
            <a href="#"><img src="<?php echo $base_url_static;?>img/social_fb.png" alt=""></a>
            <a href="#"><img src="<?php echo $base_url_static;?>img/social_tw.png" alt=""></a>
        </div>
        <section class="wrapp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="filtro">
                            <span>Filtrar Promociones por: </span>
                            <?php echo $tiendas ?>
                            <?php echo $marcas ?>
                        </div>
                    </div>
                </div>


                <?php echo $promocionespremium_html ?>     
                           

            </div>            
        </section>

        <div class="publi">
            <div class="container">
                <div class="row">                    
                    <div id="slide-publi">
                        <div class="item"><img src="<?php echo $base_url_static;?>img/publicidad1.jpg" alt="Owl Image"></div>
                        <div class="item"><img src="<?php echo $base_url_static;?>img/publicidad2.jpg" alt="Owl Image"></div>
                        <div class="item"><img src="<?php echo $base_url_static;?>img/publicidad3.jpg" alt="Owl Image"></div>                          
                    </div>                    
                    <a href="#" class="btn next">
                        <img src="<?php echo $base_url_static;?>img/btn-slider_right.png" alt="">
                    </a>
                    <a href="#" class="btn prev">
                        <img src="<?php echo $base_url_static;?>img/btn-slider_left.png" alt="">
                    </a>                    
                </div>
            </div>    
        </div>

          <section class="wrapp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                         <?php echo $promocionesgenerales_html ?> 
                    </div>
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


       