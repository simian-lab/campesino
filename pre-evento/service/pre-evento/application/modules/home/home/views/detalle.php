<section id="detalle">
    <div class="banner">
        <!--<a href="#">                  
            <img src="<?php echo $base_url_static ?>img/visa-lateral1.jpg" alt="">
        </a>
        <a href="#">
            <img src="<?php echo $base_url_static ?>img/visa-lateral2.jpg" alt="">
        </a>-->
        <script type="text/javascript">
            sas_pageid='<?php echo $sitio_seccion ?>'; // Página : Cyberlunes_Pre-Evento/home
            sas_formatid=25757;  // Formato : Expandible Dercha Banderole  0x0
            sas_target='';   // Segmentación
            SmartAdServer(sas_pageid,sas_formatid,sas_target);
        </script>
        <noscript>
            <a href="http://ads.eltiempo.com/call/pubjumpi/<?php echo $sitio_seccion ?>/25757/M/[timestamp]/?" target="_blank">
            <img src="http://ads.eltiempo.com/call/pubi/<?php echo $sitio_seccion ?>/25757/M/[timestamp]/?" border="0" alt="" /></a>
        </noscript>
    </div>
    <div class="share">
       <a href="#" onClick='shareFacebook(); s.linkTrackVars="events,eVar13";  s.linkTrackEvents="event6";  s.events="event6";  s.eVar13="Facebook";  s.products=";18442";  s.tl(true,"o","Compartir  en  Social  Media");'><img src="<?php echo $base_url_static;?>img/fb.png" alt=""></a>
       <a href="#"  onClick='shareTwitter(); s.linkTrackVars="events,eVar13";  s.linkTrackEvents="event6";  s.events="event6";  s.eVar13="Twitter";  s.products=";18442";  s.tl(true,"o","Compartir  en  Social  Media");'><img src="<?php echo $base_url_static;?>img/tw.png" alt=""></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <?php $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : ''; ?>
                    <li><a href="<?php echo base_url().$page; ?>">Home</a></li>
                    <li>Detalle</li>
                    <li class="active"><?php echo $this->uri->segment(2); ?></li>
                </ol>
            </div>
        </div>                            
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <article>
                    <?php foreach($articulo as $articulo): ?>
                    <hgroup>
                        <h1><?php echo $articulo->ART_TITULO ?></h1>
                        <date><?php echo convertirFecha($articulo->ART_FECHA) ?></date>
                    </hgroup>                   
                    <figure>
                        <img src="<?php echo $base_url_img_articulos.$articulo->ART_IMAGEN ?>" alt="">
                    </figure>     
                        <p><?php echo htmlspecialchars_decode($articulo->ART_DETALLE) ?></p>
                    <?php endforeach; ?>
                </article>
            </div>
            <div class="col-lg-4 col-md-12 aside">
                <figure class="publi">
                    <script type="text/javascript">
                        is_mobile='<?php echo $is_mobile; ?>';
                        sas_pageid='<?php echo $sitio_seccion ?>'; // Página : Cyberlunes_Pre-Evento/home
                        if(is_mobile == 1){
                          sas_formatid=25760;  
                        }
                        else{
                          sas_formatid=9344;  // Formato : Primer Boton 300x100 300x100  
                        }
                        sas_target='';   // Segmentación
                        SmartAdServer(sas_pageid,sas_formatid,sas_target);
                    </script>
                    <noscript>
                        <a href="http://ads.eltiempo.com/call/pubjumpi/<?php echo $sitio_seccion ?>/9344/S/[timestamp]/?" target="_blank">
                        <img src="http://ads.eltiempo.com/call/pubi/<?php echo $sitio_seccion ?>/9344/S/[timestamp]/?" border="0" alt="" /></a>
                    </noscript>
                </figure>                  
                <figure class="publi">
                    <div class="titulo-publi">
                        <span>publicidad</span>
                    </div>
                    <script type="text/javascript">
                        is_mobile='<?php echo $is_mobile; ?>';
                        sas_pageid='<?php echo $sitio_seccion ?>'; // Página : Cyberlunes_Pre-Evento/home
                        if(is_mobile == 1){
                          sas_formatid=9702;  
                        }
                        else{
                          sas_formatid=9611;  // Formato : Primer Boton 300x100 300x100  
                        }
                        sas_target='';   // Segmentación
                        SmartAdServer(sas_pageid,sas_formatid,sas_target); 
                    </script>
                    <noscript>
                        <a href="http://ads.eltiempo.com/call/pubjumpi/<?php echo $sitio_seccion ?>/9611/S/[timestamp]/?" target="_blank">
                        <img src="http://ads.eltiempo.com/call/pubi/<?php echo $sitio_seccion ?>/9611/S/[timestamp]/?" border="0" alt="" /></a>
                    </noscript>
                </figure>
                <figure class="publi"> 
                    <div class="titulo-publi">
                        <span>publicidad</span>
                    </div>
                    <script type="text/javascript">
                        sas_pageid='<?php echo $sitio_seccion ?>'; // Página : Cyberlunes_Pre-Evento/home
                        if(is_mobile == 1){
                          sas_formatid=9703;  
                        }
                        else{
                          sas_formatid=9608;  // Formato : Primer Boton 300x100 300x100  
                        }
                        sas_target='';   // Segmentación
                        SmartAdServer(sas_pageid,sas_formatid,sas_target);
                    </script>
                    <noscript>
                        <a href="http://ads.eltiempo.com/call/pubjumpi/<?php echo $sitio_seccion ?>/9608/S/[timestamp]/?" target="_blank">
                        <img src="http://ads.eltiempo.com/call/pubi/<?php echo $sitio_seccion ?>/9608/S/[timestamp]/?" border="0" alt="" /></a>
                    </noscript>
                </figure>
                <figure class="publi">
                    <div class="titulo-publi">
                        <span>publicidad</span>
                    </div>
                    <script type="text/javascript">
                        sas_pageid='<?php echo $sitio_seccion ?>'; // Página : Cyberlunes_Pre-Evento/home
                        if(is_mobile == 1){
                          sas_formatid=9704;  
                        }
                        else{
                          sas_formatid=11772;  // Formato : Primer Boton 300x100 300x100  
                        }
                        sas_target='';   // Segmentación
                        SmartAdServer(sas_pageid,sas_formatid,sas_target);
                    </script>
                    <noscript>
                        <a href="http://ads.eltiempo.com/call/pubjumpi/<?php echo $sitio_seccion ?>/11772/S/[timestamp]/?" target="_blank">
                        <img src="http://ads.eltiempo.com/call/pubi/<?php echo $sitio_seccion ?>/11772/S/[timestamp]/?" border="0" alt="" /></a>  
                    </noscript>  
                </figure>     
                <div class="articulos">
                    <h1><b>Artículos</b> relacionados</h1>
                    <ul>
                        <?php foreach($articulos_recomendados as $articulo_recomendado): ?>
                        <li class="col-lg-12 col-md-4 col-sm-4">
                            <figure class="col-lg-6 col-md-6 col-sm-6">
                                <a href="<?php echo base_url().'detalle/'.$articulo_recomendado->ART_SLUG ?>"><img border="0" src="<?php echo $base_url_tod?>?src=<?php echo get_url_encode_tod($base_url_img_articulos.$articulo_recomendado->ART_IMAGEN); ?>&amp;w=130&amp;h=145&amp;zc=1&amp;" alt=""></a>
                                <img src="<?php echo $base_url_static?>img/border-btn-leermas.png" class="border-impacto">
                            </figure>
                            <aside class="col-lg-6 col-md-6 col-sm-6">
                                <hgroup>
                                    <a href="<?php echo base_url().'detalle/'.$articulo_recomendado->ART_SLUG ?>"><h3><?php echo $articulo_recomendado->ART_TITULO ?></h3></a>
                                    <date><?php echo convertirFecha($articulo_recomendado->ART_FECHA) ?></date>                                   
                                </hgroup>
                                <div class="desc">
                                    <p><?php echo $articulo_recomendado->ART_DESCRIPCION ?></p>
                                </div>
                                <div class="leer-mas">
                                    <a href="<?php echo base_url().'detalle/'.$articulo_recomendado->ART_SLUG ?>">Leer <b>Más</b></a>
                                </div>
                            </aside>                                    
                        </li>
                        <?php endforeach; ?>
                        <div class="fix"></div>
                    </ul>
                </div>        
            </div>
        </div>
    </div>            
</section>