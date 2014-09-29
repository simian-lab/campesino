<section id="formulario">
    <div class="share">
        <a href="https://www.facebook.com/Cyberlunes" target="_blank" onClick='s.linkTrackVars="events,eVar13";  s.linkTrackEvents="event6";  s.events="event6";  s.eVar13="Facebook";  s.products=";18442";  s.tl(true,"o","Compartir  en  Social  Media");'><img src="<?php echo $base_url_static;?>img/fb.png" alt=""></a>
        <a href="https://twitter.com/Cyberlunesco" target="_blank"  onClick='s.linkTrackVars="events,eVar13";  s.linkTrackEvents="event6";  s.events="event6";  s.eVar13="Twitter";  s.products=";18442";  s.tl(true,"o","Compartir  en  Social  Media");'><img src="<?php echo $base_url_static;?>img/tw.png" alt=""></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo $base_url; ?>">Home</a></li>
                    <li>Formulario</li>
                    <li class="active">Sorteo</li>
                </ol>
            </div>
        </div>   
        <div class="row">
            <div class="col-lg-12">
                <div id="slider-marcas-form">                    
                    <img src="<?php echo $base_url_static?>img/border-left-slider-marcas.png" class="border-left"> 
                    <ul class="slider-marcas">
                        <?php 
                            foreach($slider_patrocinadores as $patrocinador): 
                        ?>
                        <li><a target="_blank" href="<?php echo $patrocinador->PAT_URL; ?>"><img src="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" alt=""></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <img src="<?php echo $base_url_static?>img/border-right-slider-marcas.png" class="border-right" alt="">                    
                </div>
            </div>
        </div>                          
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <article>
                    <hgroup>
                        <h1><b>Registra</b> tus facturas y participa</h1>
                        <h2>en el sorteo de <b>espectaculares premios.</b></h2>
                    </hgroup>
                    <p>
                                Queremos premiarte por haber hecho parte de esta jornada. Cuéntanos que promoción de CyberLunes® compraste, adjunta tu factura y llena tus datos personales.
                            </p>
                            <p>Recuerda que para reclamar tu premio, debes presentar tu factura original de compra y esta se verificará internamente (ver <a href="#" data-toggle="modal" data-target="#terminos">términos y condiciones</a>).</p>
                </article>   
                <div class="formulario">
                    <?php if(isset($success)):?>
                        <div style="text-align:center;margin-bottom:15px;">
                            <span style="color:#6FB82E"><?php echo $success ?></span>
                        </div>
                    <?php endif;?>
                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url('formulario/sorteo/send') ?>" id="form_sorteo" name="form_sorteo" onSubmit="return (validarEmail())">
                        <div class="row">
                            <div class="col-lg-3 col-lg-offset-2">
                                <span>*Nombre</span>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" name="nombre" id="id-nombre" value="<?php echo set_value('nombre') ?>">
                                <?php echo form_error('nombre'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-lg-offset-2">
                                <span>*Dirección</span>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" name="dir" value="<?php echo set_value('dir') ?>">
                                <?php echo form_error('dir'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-lg-offset-2">
                                <span>*Email</span>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" name="email" value="<?php echo set_value('email') ?>" id="email-form-sorteo">
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-lg-offset-2">
                                <span>*Celular</span>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" name="cel" id="id-celular" value="<?php echo set_value('cel') ?>">
                                <?php echo form_error('cel'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-lg-offset-2">
                                <span>*Tienda donde compraste</span>
                            </div>
                            <div class="col-lg-7">
                                <select name="tiendas" id="">
                                    <?php foreach($tiendas as $tienda): ?>
                                    <option value="<?php echo $tienda->TIE_NOMBRE ?>" <?php echo set_select('tiendas', $tienda->TIE_NOMBRE); ?>><?php echo $tienda->TIE_NOMBRE ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('tiendas'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-lg-offset-2">
                                <span>*Adjuntar factura</span>
                            </div>
                            <div class="col-lg-7">
                                <input type="file" name="factura">
                                <i class="formatos">En formato PDF, JPG o PNG</i>
                                <?php echo form_error('factura'); ?>
                                <?php if(isset($error_file)):?>
                                    <span style="font-size:0.835em;color:#FF0000"><?php echo $error_file ?></span>
                                <?php endif;?>
                                <?php /*if(isset($error_file)):?>
                                    <span style="font-size:0.835em;color:#FF0000">El formato del archivo es incorrecto</span>
                                <?php endif;*/?>
                            </div>
                        </div>
                        <div class="row terminos">
                            <div class="col-lg-10 col-lg-offset-2">
                                <span class="formatos">*Campos obligatorios</span>
                                <input type="checkbox" name="terminos"><label class="tyc">Acepto los <a href="#" data-toggle="modal" data-target="#terminos">términos y condiciones</a> de Cyberlunes.com.co</label>
                                <?php echo form_error('terminos'); ?>
                                <input type="submit" value="ENVIAR">                                
                                <div class="fix"></div>
                            </div>                                
                        </div>
                    </form>
                </div>                     
            </div>
            <div class="col-lg-4 col-md-12 aside">
                <h1><b>Marcas </b>participantes</h1>
                <div class="slide-marcas-participantes">
                    <a href="#" class="prev-marcas" id="prev-marcas-aside"><img src="<?php echo $base_url_static?>img/controls-marcas-left.png" alt=""></a>  
                    <div id="slide-marcas">
                        <div class="item">
                            <ul>
                                <?php 
                                    $contador = 0;
                                    foreach($slider_patrocinadores as $patrocinador): 
                                ?>
                                <li><a target="_blank" href="<?php echo $patrocinador->PAT_URL; ?>"><img src="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" alt=""></a></li>
                                <?php 
                                    $contador++;
                                    if($contador == 6){
                                        echo '<div class="fix"></div>
                                            </ul>
                                        </div>     
                                        <div class="item">
                                            <ul>';
                                        $contador = 0;
                                    }
                                ?>
                                <?php endforeach; ?> 
                            </ul>
                        </div>                     
                    </div>
                    <a href="#" class="next-marcas"  id="next-marcas-aside"><img src="<?php echo $base_url_static?>img/controls-marcas-right.png" alt=""></a>  
                </div>
                <figure class="publi">
                    <!--<div class="titulo-publi">
                        <span>publicidad</span>
                    </div>-->
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
                        SmartAdServerAjax(sas_pageid,sas_formatid,sas_target); 
                    </script>
                    <noscript>
                        <a href="http://ads.eltiempo.com/call/pubjumpi/<?php echo $sitio_seccion ?>/9611/S/[timestamp]/?" target="_blank">
                        <img src="http://ads.eltiempo.com/call/pubi/<?php echo $sitio_seccion ?>/9611/S/[timestamp]/?" border="0" alt="" /></a>
                    </noscript>
                </figure>
                <figure class="publi"> 
                    <!--<div class="titulo-publi">
                        <span>publicidad</span>
                    </div>-->
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
                    <!--<div class="titulo-publi">
                        <span>publicidad</span>
                    </div>-->
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
            </div>
        </div>
    </div>            
</section>