<style type="text/css">
    .publicidad_categoria img {
        float: left;
    }
    .publicidad_categoria div {
        float: left;
        width: 90%;
    }
</style>

<link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/jquery.ias.css"> 
<script src="<?php echo $base_url_static;?>js/jquery-ias.js"></script>    
<script src="<?php echo $base_url_static;?>js/scroll-promocion.js"></script>  

<section class="wrapp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="filtro">
                            <span>Filtrar Promociones por: </span>
                            <?php echo $tiendas ?>
                            <?php echo $marcas ?>
                            <?php echo $subCategorias ?>
                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                        <?php if(!empty($breadcrumb)): ?>
                                <li><a href="<?php echo $base_url ?>">Inicio</a></li>
                        <?php endif; ?>

                        <?php foreach($breadcrumb as $item): ?>
                                <?php if($item != '' && end($breadcrumb) == $item): ?>
                                    <li class="active"><?php echo $item ?></li>
                                <?php elseif($item != '' && end($breadcrumb) != $item): ?>
                                    <li><a href="<?php ($this->uri->segment(2)!='todos')?print($base_url.'descuentos/'.$this->uri->segment(2)):'#' ?>"><?php echo $item ?></a></li>
                                <?php endif; ?>
                        <?php endforeach; ?>

                        </ol>

                        <?php //echo set_breadcrumb(); ?> 
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                           <?php echo $promocionespremium_html ?>     

                    </div>
                </div>                
            </div>            
        </section>
        <?php if(!isset($publicidad_categoria) && !isset($publicidad_home)): ?>
        <div class="publi">
            <div class="container">
                <div class="row">                    
                    <div id="slide-publi">
                        <div class="item">
                            <!--<a href="#" target="_blank"><img src="<?php echo $base_url_static;?>img/publicidad1.jpg" alt="Owl Image"></a>-->
                            <div class="publi-content">
                                <div class="titulo-publicidad">
                                    <span>Publicidad</span>
                                </div>
                                <script type="text/javascript">
                                 sas.call("std", {
                                  siteId:  41700, // 
                                  pageId:  282275, // Página : Cyberlunes/home
                                  formatId:  9611, // Formato : Primer Boton 300x100 300x100
                                  target:  ''   // Segmentación
                                 });
                                </script>
                                <noscript>
                                 <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=41700&pgname=home&fmtid=9611&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">                
                                  <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=41700&pgname=home&fmtid=9611&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
                                </noscript>
                            </div>
                        </div>
                        <div class="item">
                            <!--<a href="#" target="_blank"><img src="<?php echo $base_url_static;?>img/publicidad2.jpg" alt="Owl Image"></a>-->
                            <div class="publi-content">
                                <div class="titulo-publicidad">
                                    <span>Publicidad</span>
                                </div>
                               <script type="text/javascript">
                                 sas.call("std", {
                                  siteId:  41700, // 
                                  pageId:  282275, // Página : Cyberlunes/home
                                  formatId:  9608, // Formato : Segundo Boton 300x100 300x100
                                  target:  ''   // Segmentación
                                 });
                                </script>
                                <noscript>
                                 <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=41700&pgname=home&fmtid=9608&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">                
                                  <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=41700&pgname=home&fmtid=9608&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
                                </noscript>
                            </div>
                        </div>
                        <div class="item">
                            <!--<a href="#" target="_blank"><img src="<?php echo $base_url_static;?>img/publicidad3.jpg" alt="Owl Image"></a>-->
                            <div class="publi-content">
                                <div class="titulo-publicidad">
                                    <span>Publicidad</span>
                                </div>
                                <script type="text/javascript">
                                 sas.call("std", {
                                  siteId:  41700, // 
                                  pageId:  282275, // Página : Cyberlunes/home
                                  formatId:  11772, // Formato : Tercer Boton 300x100 300x100
                                  target:  ''   // Segmentación
                                 });
                                </script>
                                <noscript>
                                 <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=41700&pgname=home&fmtid=11772&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">                
                                  <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=41700&pgname=home&fmtid=11772&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
                                </noscript>
                            </div>
                        </div>                          
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
        <?php endif; ?>
        <?php if(isset($publicidad_categoria) && !isset($publicidad_home) ): ?>
        <div class="container">
            <div class="row margen">                    
                <div class="col-lg-12 publicidad_categoria">
                    <!--<a href="#" target="_blank">
                        <img src="<?php echo $base_url_static;?>img/banner4000.jpg" alt="">
                    </a>-->
                        <!--<img src="<?php echo $base_url_static;?>img/publi_left.jpg" />-->
                        <script type="text/javascript">
                         sas.call("std", {
                          siteId:  41700, // 
                          pageId:  439811, // Página : Cyberlunes/home_contenido
                          formatId:  12803, // Formato : Megabanner 960x90
                          target:  ''   // Segmentación
                         });
                        </script>
                        <noscript>
                         <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=41700&pgname=home_contenido&fmtid=12803&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">                
                          <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=41700&pgname=home_contenido&fmtid=12803&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
                        </noscript>
                        <script type="text/javascript">
                            $(document).ready(function(){
                            
                                $('#sas_12803').ready(function(){
                                    var $img = $('<img>').attr('src', '<?php echo $base_url_static;?>img/publi_left.jpg').css({
                                        width: '2%',
                                        maxHeight: 90,
                                        float: 'left'
                                    });    
                                    $('#sas_12803').find('div').children('a').children('img').css({
                                        width: '98%'
                                    })
                                    $('#sas_12803').find('div').css({
                                        width: '100%'
                                    }).children('a').before($img);
                                }).css({
                                    width: '100%'
                                });
                            });
                        </script>
                    
                </div>
            </div>
        </div> 
        <?php endif; ?>
        <section class="wrapp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                          <?php echo $promocionesgenerales_html ?> 
                    </div>
                </div> 

                <div class="row banner">                    
                    <div class="col-lg-12">
                        <!--<a href="#" target="_blank">
                            <img src="<?php echo $base_url_static;?>img/banner-visa.jpg" alt="">
                        </a>-->
                        <script type="text/javascript">
                         sas.call("std", {
                          siteId:  41700, // 
                          pageId:  282275, // Página : Cyberlunes/home
                          formatId:  8941, // Formato : Barra Fija 960x30
                          target:  ''   // Segmentación
                         });
                        </script>
                        <noscript>
                         <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=41700&pgname=home&fmtid=8941&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">                
                          <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=41700&pgname=home&fmtid=8941&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
                        </noscript>
                    </div>                
                </div>

            </div>            
        </section> 