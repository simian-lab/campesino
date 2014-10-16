<section id="formulario">
    <div class="share">
        <a href="https://www.facebook.com/Cyberlunes" target="_blank" ><img src="<?php echo $base_url_static;?>img/fb.png" alt=""></a>
        <a href="https://twitter.com/Cyberlunesco" target="_blank"  ><img src="<?php echo $base_url_static;?>img/tw.png" alt=""></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li>Formulario</li>
                    <li class="active">Participación</li>
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
                        <h1><b>Haz parte de</b> Cyberlunes®</h1>
                        <h2>y llega a <b>miles de usuarios</b></h2>
                    </hgroup>
                    <p>
                        CyberLunes®, un evento de la Cámara Colombiana de Comercio Electrónico (CCCE), está orientado a promover el comercio electrónico en Colombia. Este evento se convierte en la plataforma perfecta para dar a conocer productos y servicios en el mundo de las ventas online.</p>

 

<p>Durante un día (24 horas), muchos compradores online conocerán lo que ofreces y experimentarán tu servicio, convirtiéndose así en tus nuevos clientes recurrentes.</p>

 

<p>Si deseas participar y conocer más acerca de Cyberlunes®, completa los siguientes datos y uno de nuestros asesores comerciales te contactará.
                    </p>                            
                </article>   
                <div class="formulario">
                
                    <?php if(isset($success)): ?>
                        <div style="text-align:center;margin-bottom:15px;">
                            <span style="color:#6FB82E"><?php echo $success ?></span>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="<?php echo base_url() ?>formulario/participacion/send" id="formID" onSubmit="return (validarEmailPart())">
                        <div class="row">
                            <div class="col-lg-3 col-lg-offset-2">
                                <span>*Nombre de la empresa</span>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" class="validate[required]" name="nombre_empresa" value="<?php echo set_value('nombre_empresa') ?>">
                                <?php echo form_error('nombre_empresa'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-lg-offset-2">
                                <span>*Nombre de contacto</span>
                            </div>
                            <div class="col-lg-7">
                                <input class="validate[required]" type="text" id="id-nombre-contacto" name="nombre_contacto" value="<?php echo set_value('nombre_contacto') ?>">
                                <?php echo form_error('nombre_contacto'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-lg-offset-2">
                                <span>*Cargo</span>
                            </div>
                            <div class="col-lg-7">
                                <input class="validate[required]" type="text" name="cargo" value="<?php echo set_value('cargo') ?>">
                                <?php echo form_error('cargo'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-lg-offset-2">
                                <span>*Correo electrónico</span>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" name="email" id="email-form-participacion" class="validate[required,custom[email]]" value="<?php echo set_value('email') ?>">
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-lg-offset-2">
                                <span>*Teléfono móvil</span>
                            </div>
                            <div class="col-lg-7">
                                <input class="validate[required]" id="id-celular" type="text" name="celular" value="<?php echo set_value('celular') ?>">
                                <?php echo form_error('celular'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-lg-offset-2">
                                <span>Teléfono oficina</span>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" name="telefono" id="id-telefono" value="<?php echo set_value('telefono') ?>"> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-lg-offset-2">
                                <span>URL de la tienda</span>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" name="url" value="<?php echo set_value('url') ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 col-lg-offset-2">
                                <textarea name="comentarios" id="" cols="30" rows="10" placeholder="comentarios"><?php echo set_value('comentarios') ?></textarea>
                            </div>
                        </div>
                        <div class="row terminos">
                            <div class="col-lg-10 col-lg-offset-2">
                                <span class="formatos">*Campos obligatorios</span>
                                <input class="validate[required] checkbox" type="checkbox" name="terminos"><label class="tyc">Acepto los términos y condiciones de Cyberlunes.com.co</label>
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
