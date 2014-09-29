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
                            <?php if(!$this->agent->is_mobile()): ?>
                                <div class="titulo-publicidad">
                                    <span>Publicidad</span>
                                </div>
                                <script type="text/javascript">
                                    sas_pageid='41700/282275'; // Página : Cyberlunes/home
                                    sas_formatid=9611;  // Formato : Primer Boton 300x100 300x100
                                    sas_target='';   // Segmentación
                                    SmartAdServer(sas_pageid,sas_formatid,sas_target);
                                </script>
                                <noscript>
                                    <a href="http://ads.eltiempo.com/call/pubjumpi/41700/282275/9611/S/[timestamp]/?" target="_blank">
                                    <img src="http://ads.eltiempo.com/call/pubi/41700/282275/9611/S/[timestamp]/?" border="0" alt="" /></a>
                                </noscript>
                            <?php endif; ?>
                            <?php if($this->agent->is_mobile()): ?>
                                <div class="titulo-publicidad">
                                    <span>Publicidad</span>
                                </div>
                                <script type="text/javascript">
                                    sas_pageid='41700/439812'; // Página : Cyberlunes/categoria
                                    sas_formatid=9702;  // Formato : Movil Banner Superior 0x0
                                    sas_target='';   // Segmentación
                                    SmartAdServer(sas_pageid,sas_formatid,sas_target);
                                </script>
                                <noscript>
                                    <a href="http://ads.eltiempo.com/call2/pubjumpmi/41700/439812/9702/S/[timestamp]/?" target="_blank">
                                    <img src="http://ads.eltiempo.com/call2/pubmi/41700/439812/9702/S/[timestamp]/?" border="0" alt="" /></a>
                                </noscript>
                            <?php endif; ?>
                            </div>
                        </div>
                        <div class="item">
                            <!--<a href="#" target="_blank"><img src="<?php echo $base_url_static;?>img/publicidad2.jpg" alt="Owl Image"></a>-->
                            <div class="publi-content">
                            <?php if(!$this->agent->is_mobile()): ?>
                                <div class="titulo-publicidad">
                                    <span>Publicidad</span>
                                </div>
                                <script type="text/javascript">
                                    sas_pageid='41700/282275'; // Página : Cyberlunes/home
                                    sas_formatid=9608;  // Formato : Segundo Boton 300x100 0x0
                                    sas_target='';   // Segmentación
                                    SmartAdServer(sas_pageid,sas_formatid,sas_target);
                                </script>
                                <noscript>
                                    <a href="http://ads.eltiempo.com/call/pubjumpi/41700/282275/9608/S/[timestamp]/?" target="_blank">
                                    <img src="http://ads.eltiempo.com/call/pubi/41700/282275/9608/S/[timestamp]/?" border="0" alt="" /></a>
                                </noscript>
                            <?php endif; ?>
                            <?php if($this->agent->is_mobile()): ?>
                                <div class="titulo-publicidad">
                                    <span>Publicidad</span>
                                </div>
                                <script type="text/javascript">
                                    sas_pageid='41700/282275'; // Página : Cyberlunes/home
                                    sas_formatid=9703;  // Formato : Movil Banner 0x0
                                    sas_target='';   // Segmentación
                                    SmartAdServer(sas_pageid,sas_formatid,sas_target);
                                </script>
                                <noscript>
                                    <a href="http://ads.eltiempo.com/call2/pubjumpmi/41700/282275/9703/M/[timestamp]/?" target="_blank">
                                    <img src="http://ads.eltiempo.com/call2/pubmi/41700/282275/9703/M/[timestamp]/?" border="0" alt="" /></a>
                                </noscript>
                            <?php endif; ?>
                            </div>
                        </div>
                        <div class="item">
                            <!--<a href="#" target="_blank"><img src="<?php echo $base_url_static;?>img/publicidad3.jpg" alt="Owl Image"></a>-->
                            <div class="publi-content">
                            <?php if(!$this->agent->is_mobile()): ?>
                                <div class="titulo-publicidad">
                                    <span>Publicidad</span>
                                </div>
                                <script type="text/javascript">
                                    sas_pageid='41700/282275'; // Página : Cyberlunes/home
                                    sas_formatid=11772;  // Formato : Tercer Boton 300x100 300x100
                                    sas_target='';   // Segmentación
                                    SmartAdServer(sas_pageid,sas_formatid,sas_target);
                                </script>
                                <noscript>
                                    <a href="http://ads.eltiempo.com/call/pubjumpi/41700/282275/11772/S/[timestamp]/?" target="_blank">
                                    <img src="http://ads.eltiempo.com/call/pubi/41700/282275/11772/S/[timestamp]/?" border="0" alt="" /></a>
                                </noscript>
                            <?php endif; ?>
                            <?php if($this->agent->is_mobile()): ?>
                                <div class="titulo-publicidad">
                                    <span>Publicidad</span>
                                </div>
                                <script type="text/javascript">
                                    sas_pageid='41700/439812'; // Página : Cyberlunes/categoria
                                    sas_formatid=9704;  // Formato : Movil Banner Inferior 0x0
                                    sas_target='';   // Segmentación
                                    SmartAdServer(sas_pageid,sas_formatid,sas_target);
                                </script>
                                <noscript>
                                    <a href="http://ads.eltiempo.com/call2/pubjumpmi/41700/439812/9704/M/[timestamp]/?" target="_blank">
                                    <img src="http://ads.eltiempo.com/call2/pubmi/41700/439812/9704/M/[timestamp]/?" border="0" alt="" /></a>
                                </noscript>
                            <?php endif; ?>
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
                    <?php if(!$this->agent->is_mobile()): ?>
                        <!--<img src="<?php echo $base_url_static;?>img/publi_left.jpg" />-->
                        <script type="text/javascript">
                            sas_pageid='41700/439812'; // Página : Cyberlunes/categoria
                            sas_formatid=8932;  // Formato : Desplegable/PushDown 0x0
                            sas_target="<?php echo $sas_taget_lan ?>";   // Segmentación
                            SmartAdServer(sas_pageid,sas_formatid,sas_target);
                        </script>
                        <noscript>
                            <a href="http://ads.eltiempo.com/call/pubjumpi/41700/439812/8932/S/[timestamp]/?" target="_blank">
                            <img src="http://ads.eltiempo.com/call/pubi/41700/439812/8932/S/[timestamp]/?" border="0" alt="" /></a>
                        </noscript>
                        <script type="text/javascript">
                            $(document).ready(function(){
                            
                                $('#sas_8932').ready(function(){
                                    var $img = $('<img>').attr('src', '<?php echo $base_url_static;?>img/publi_left.jpg').css({
                                        width: '2%',
                                        maxHeight: 90,
                                        float: 'left'
                                    });    
                                    $('#sas_8932').find('div').children('a').children('img').css({
                                        width: '98%'
                                    })
                                    $('#sas_8932').find('div').css({
                                        width: '100%'
                                    }).children('a').before($img);
                                }).css({
                                    width: '100%'
                                });
                            });
                        </script>
                    <?php endif; ?>
                    <?php if($this->agent->is_mobile()): ?>
                        <script type="text/javascript">
                            sas_pageid='41700/439810'; // Página : Cyberlunes/infografia
                            sas_formatid=25760;  // Formato : Banner Mercadeo Móviles Cyberlunes 0x0
                            sas_target='';   // Segmentación
                            SmartAdServer(sas_pageid,sas_formatid,sas_target);
                        </script>
                        <noscript>
                            <a href="http://ads.eltiempo.com/call2/pubjumpmi/41700/439810/25760/S/[timestamp]/?" target="_blank">
                            <img src="http://ads.eltiempo.com/call2/pubmi/41700/439810/25760/S/[timestamp]/?" border="0" alt="" /></a>
                        </noscript>
                        <script type="text/javascript">
                            $(document).ready(function(){
                            
                                $('#sas_25760').ready(function(){
                                    var $img = $('<img>').attr('src', '<?php echo $base_url_static;?>img/publi_left.jpg').css({
                                        width: '2%',
                                        height: 50,
                                        float: 'left'
                                    });    
                                    $('#sas_25760').children('a').children('img').css({
                                        width: '98%'
                                    })
                                    $('#sas_25760').css({
                                        width: '100%'
                                    }).children('a').before($img);
                                }).css({
                                    width: '100%'
                                });
                            });
                        </script>
                    <?php endif; ?>
                    
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
                <?php /*if(isset($publicidad_categoria) && !isset($publicidad_home)): ?>
                <div class="row margen">
                    <div class="col-lg-12 publicidad_categoria">
                        <!--<a href="#" target="_blank">
                            <img src="<?php echo $base_url_static;?>img/bannerviaje.jpg" alt="">
                        </a>-->
                        <?php if(!$this->agent->is_mobile()): ?>
                            <!--<img src="<?php echo $base_url_static;?>img/publi_left.jpg" />-->
                            <script type="text/javascript">
                                sas_pageid='41700/439812'; // Página : Cyberlunes/categoria
                                sas_formatid=24725;  // Formato : Desplegable/PushDown Home Nuevos 0x0
                                sas_target='';   // Segmentación
                                SmartAdServer(sas_pageid,sas_formatid,sas_target);
                            </script>
                            <noscript>
                                <a href="http://ads.eltiempo.com/call/pubjumpi/41700/439812/24725/S/[timestamp]/?" target="_blank">
                                <img src="http://ads.eltiempo.com/call/pubi/41700/439812/24725/S/[timestamp]/?" border="0" alt="" /></a>
                            </noscript>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                
                                    $('#sas_24725').ready(function(){
                                        var $img = $('<img>').attr('src', '<?php echo $base_url_static;?>img/publi_left.jpg').css({
                                            width: '2%',
                                            maxHeight: 90,
                                            float: 'left'
                                        });    
                                        $('#sas_24725').find('div').children('a').children('img').css({
                                            width: '98%'
                                        })
                                        $('#sas_24725').find('div').css({
                                            width: '100%'
                                        }).children('a').before($img);
                                    }).css({
                                        width: '100%'
                                    });
                                });
                            </script>
                        <?php endif; ?>
                        <?php if($this->agent->is_mobile()): ?>
                            <script type="text/javascript">
                                sas_pageid='41700/439810'; // Página : Cyberlunes/infografia
                                sas_formatid=25781;  // Formato : Banner Mercadeo 2 Móviles Cyberlunes  0x0
                                sas_target='';   // Segmentación
                                SmartAdServer(sas_pageid,sas_formatid,sas_target);
                            </script>
                            <noscript>
                                <a href="http://ads.eltiempo.com/call2/pubjumpmi/41700/439810/25781/M/[timestamp]/?" target="_blank">
                                <img src="http://ads.eltiempo.com/call2/pubmi/41700/439810/25781/M/[timestamp]/?" border="0" alt="" /></a>
                            </noscript>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                
                                    $('#sas_25781').ready(function(){
                                        var $img = $('<img>').attr('src', '<?php echo $base_url_static;?>img/publi_left.jpg').css({
                                            width: '2%',
                                            height: 50,
                                            float: 'left'
                                        });    
                                        $('#sas_25781').children('a').children('img').css({
                                            width: '98%'
                                        })
                                        $('#sas_25781').css({
                                            width: '100%'
                                        }).children('a').before($img);
                                    }).css({
                                        width: '100%'
                                    });
                                });
                            </script>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif;*/ ?>
            </div>            
        </section> 

        <section style="position: fixed; bottom: 0px; width: 100%; z-index: 99;">
            <div class="container">
                <div class="row">                    
                    <div class="col-lg-12">
                        <!--<a href="#" target="_blank">
                            <img src="<?php echo $base_url_static;?>img/banner-visa.jpg" alt="">
                        </a>-->
                        <?php if(!$this->agent->is_mobile()): ?>
                            <script type="text/javascript">
                                sas_pageid='41700/282275'; // Página : Cyberlunes/home
                                sas_formatid=8941;  // Formato : Barra Fija 0x0
                                sas_target='';   // Segmentación
                                SmartAdServer(sas_pageid,sas_formatid,sas_target);
                            </script>
                            <noscript>
                                <a href="http://ads.eltiempo.com/call/pubjumpi/41700/282275/8941/M/[timestamp]/?" target="_blank">
                                <img src="http://ads.eltiempo.com/call/pubi/41700/282275/8941/M/[timestamp]/?" border="0" alt="" /></a>
                            </noscript>
                            
                        <?php endif; ?>
                        <?php if($this->agent->is_mobile()): ?>
                            <script type="text/javascript">
                                sas_pageid='41700/282275'; // Página : Cyberlunes/home
                                sas_formatid=15271;  // Formato : Movil Barra Fija 0x0
                                sas_target='';   // Segmentación
                                SmartAdServer(sas_pageid,sas_formatid,sas_target);
                            </script>
                            <noscript>
                                <a href="http://ads.eltiempo.com/call2/pubjumpmi/41700/282275/15271/S/[timestamp]/?" target="_blank">
                                <img src="http://ads.eltiempo.com/call2/pubmi/41700/282275/15271/S/[timestamp]/?" border="0" alt="" /></a>
                            </noscript>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                
                                    $('#sas_15271').ready(function(){                                    
                                        $('#sas_15271').children('div').css({
                                            display: 'none'
                                        })
                                        $(this).find('img').css({
                                            verticalAlign: 'top'    
                                        });                            
                                        
                                    }).css({
                                        width: '100%'
                                    });
                                });
                            </script>
                        <?php endif; ?>
                    </div>                
                </div>
            </div>
        </section>