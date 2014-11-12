<section id="home">
    <div class="banner">
        <script type="text/javascript">
         sas.call("std", {
          siteId:  '<?php echo $siteId ?>', // 
          pageId:  '<?php echo $pageId ?>', // Página : Cyberlunes_Pre-Evento/home
          formatId:  25757, // Formato : Expandible Derecha Banderole  0x0
          target:  ''   // Segmentación
         });
        </script>
        <noscript>
         <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=<?php echo $siteId ?>&pgname=home&fmtid=25757&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">                
          <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=<?php echo $siteId ?>&pgname=home&fmtid=25757&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
        </noscript>
    </div>
    <div class="share">
        <a href="#" onClick='shareFacebook();'><img src="<?php echo $base_url_static;?>img/fb.png" alt=""></a>
        <a href="#"  onClick='shareTwitter();'><img src="<?php echo $base_url_static;?>img/tw.png" alt=""></a>
    </div>
    <div class="container">
        <!-- Máximo 7 imagenes, con 8 se rompen los controles, por favor verificar eso en el administrsdor -->
        <div class="slider">
            <div id="slider-principal" class="owl-carousel owl-theme">
                <?php 

                    foreach($slider_pautas as $pauta): 
                    if($pauta->PAU_TARGET == 1){
                        $target = 'target="_blank"';
                    }
                    else{
                       $target = ''; 
                    }

                    if($this->agent->is_mobile()){
                        $img = $pauta->PAU_MOVIL_IMAGEN;
                    }
                    else{
                        $img = $pauta->PAU_IMAGEN;
                    }
                ?>
                <div class="item"><a <?php echo $target ?> href="<?php echo prep_url($pauta->PAU_URL) ?>"><img src="<?php echo $base_url_img_pautas;?><?php echo $img ?>" alt=""></a></div>
                <?php endforeach; ?>
            </div>       
            <div class="countDown">
                <span class="title">FALTAN</span>
                <div id="defaultCountdown"></div>
                <script>
                    var date = new Date(Date.UTC(2014,11,01,5,0,0)); 
                    $('#defaultCountdown').countdown({until: date, format: 'dHM', labels:['', '', '', '', '', '', ''], labels1:['', '', '', '', '', '', ''], padZeroes:true}); 
                </script> 
                <ul class="tiempo">
                    <li style="padding-left:4px">Dias</li>
                    <li>Horas</li>
                    <li>Minutos</li>
                </ul>
            </div> 
            <?php if(count($slider_pautas) > 1): ?>          
            <div class="customNavigation bg">
                <div class="navigation">
                    <a class="prev">Previous</a>
                    <a class="next">Next</a>      
                    <div class="fix"></div>                        
                </div>                                            
            </div>
            <?php endif; ?>
            <div class="box-form main">
                <header>
                    <hgroup>
                        <h1>SÉ EL PRIMERO EN RECIBIR LAS OFERTAS</h1>
                    </hgroup>
                </header>                        
                <section>
                    <form action="http://www.elabs10.com/functions/mailing_list.html" method="post" name="UPTml251011" onSubmit='return (!(UPTvalidateform(document.UPTml251011)));'>
                        <input type="hidden" name="submitaction" value="3">
                        <input type="hidden" name="mlid" value="251010">
                        <input type="hidden" name="siteid" value="2010001358">
                        <input type="hidden" name="tagtype" value="q2">
                        <input type="hidden" name="demographics" value="-1,58933,66010,66009">
                        <input type="hidden" name="redirection" value="<?php echo base_url(); ?>gracias">
                        <input type="hidden" name="uredirection" value="">
                        <input type="hidden" name="welcome" value="">
                        <input type="hidden" name="double_optin" value="">
                        <input type="hidden" name="append" value="">
                        <input type="hidden" name="update" value="on">
                        <input type="hidden" name="activity" value="submit">
                        <input type="hidden" name="val_66095" value=""/>

                        <input type="text" name="val_58933" placeholder="Nombre" value="" id="nombre"/>
                        <input type="text" name="email" placeholder="Email" value="" />
                        <?php if(!$this->agent->is_mobile()): ?>
                        <select name="val_66010[]" id="interes" multiple="multiple">
                            <option value="Tecnologia">Tecnología</option>
                            <option value="Moviles">Móviles</option>
                            <option value="Viajes y turismo">Viajes y turismo</option>
                            <option value="Moda">Moda</option>
                            <option value="Otras categorias">Otras categorías</option>
                        </select>
                        <?php endif; ?>     
                        <?php if($this->agent->is_mobile()): ?>
                        <select name="val_66010[]" id="interes">
                            <option value="" disabled selected>Intereses</option>
                            <option value="Tecnologia">Tecnología</option>
                            <option value="Moviles">Móviles</option>
                            <option value="Viajes y turismo">Viajes y turismo</option>
                            <option value="Moda">Moda</option>
                            <option value="Otras categorias">Otras categorías</option>
                        </select>
                        <?php endif; ?>                           
                        <div class="bases">
                            <input type="hidden" name="val_66009" value="on"/>
                            <span style="width:100%">Al hacer clic en suscribirte estás aceptando los <a href="#" data-toggle="modal" data-target="#terminos">términos y condiciones</a> y la <a href="#" data-toggle="modal" data-target="#politicas">política de privacidad</a> del portal.</span>           
                        </div> 
                        <!--<div class="bases">
                            <input type="checkbox" name="val_66095"/>
                            <span>Acepto recibir correos de Portales de Casa Editorial El Tiempo</span>         
                        </div> -->                             
                        <input type="hidden" id="showpopup" value="on" name="showpopup">
                        <input type="submit" value="SUSCRÍBETE"/>
                    </form>
                </section>
                <footer>
                    <img src="<?php echo $base_url_static;?>img/bottom-form.png" alt="" />          
                </footer>
            </div>
        </div>   
        <div class="row-fluid">
            <span><b>Marcas</b> participantes</span>
            <span class="right"><a class="underline" href="<?php echo base_url('formulario/participacion') ?>">Cómo hacer que tu marca participe en Cyberlunes - Clic aquí</a></span>
            <div class="fix"></div>
        </div>                      
        <div id="slider-marcas">      
            <img src="<?php echo $base_url_static;?>img/border-left-slider-marcas.png" class="border-left" alt="">
            <ul class="slider-marcas">
                <?php foreach($slider_patrocinadores as $patrocinador): ?>                      
                <li>
                        <?php  if($patrocinador->PAT_URL!=''): ?>
                                <a target="_blank" href="<?php echo prep_url($patrocinador->PAT_URL); ?>">
                                        <img src="<?php echo $base_url_img_aliados;?><?php echo $patrocinador->PAT_LOGO ?>" alt="">
                                </a>
                        <?php  else: ?>
                                        <img src="<?php echo $base_url_img_aliados;?><?php echo $patrocinador->PAT_LOGO ?>" alt="">
                        <?php  endif; ?>
                </li> 
                <?php endforeach; ?>
            </ul>                    
            <img src="<?php echo $base_url_static;?>img/border-right-slider-marcas.png" class="border-right" alt="">
        </div>  
        <div class="row-fluid participa">
            <span>Entérate de lo último en <b>comercio electrónico</b></span>
        </div>      
        <div class="row-fluid">
            <div class="col-lg-8 col-md-12 col-sm-12 articulos">
                <?php 

                    $contador_articulos = 0;
                    $cantidad_articulos = count($articulos);
                    foreach($articulos as $articulo):
                    $page = ($this->uri->segment(1)) ? $this->uri->segment(1) : '';
                    if($page=='gracias'){
                        $page='';
                    }

                    if($contador_articulos % 2 == 0):
                ?>
                <div class="row">
                    <ul>
                <?php endif; ?>
                        <li class="col-lg-6 col-md-6 col-sm-6">
                            <figure class="col-lg-6 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('detalle/'.$articulo->ART_SLUG.'/'.$page) ?>"><img border="0" src="<?php echo $base_url_tod?>?src=<?php echo ($base_url_img_articulos . $articulo->ART_IMAGEN) ?>&amp;w=130&amp;h=145&amp;zc=1" alt=""></a>
                                <img src="<?php echo $base_url_static;?>img/border-btn-leermas.png" class="border-impacto">
                            </figure>
                            <aside class="col-lg-6 col-md-6 col-sm-6">
                                <hgroup>
                                    <a href="<?php echo base_url('detalle/'.$articulo->ART_SLUG.'/'.$page) ?>"><h3><?php echo $articulo->ART_TITULO ?></h3></a>
                                    <date><?php echo convertirFecha($articulo->ART_FECHA) ?></date>                 
                                </hgroup>
                                <div class="desc">
                                    <p>
                                    <?php 
                                        echo $articulo->ART_DESCRIPCION;
                                     ?>
                                    </p>
                                </div>
                                <div class="leer-mas">
                                    <a href="<?php echo base_url('detalle/'.$articulo->ART_SLUG.'/'.$page) ?>">Leer <b>Más</b></a>
                                </div>
                            </aside>                                
                        </li>
                <?php 
                    $contador_articulos++;
                    if($contador_articulos % 2 == 0 || ($contador_articulos % 2 != 0 && $cantidad_articulos == $contador_articulos)):
                ?>
                    </ul>
                </div>
                <?php
                    endif;
                    endforeach;
                ?>
            </div>
            <div class="col-lg-4 col-md-12 publicidades">
                <figure>
                    <div class="titulo-publi">
                        <span>publicidad</span>
                    </div>
                    <script type="text/javascript">
                     sas.call("std", {
                      siteId:  '<?php echo $siteId ?>', // 
                      pageId:  '<?php echo $pageId ?>',
                      formatId:  9611, // Formato : Primer Boton 300x100 300x100
                      target:  ''   // Segmentación
                     });
                    </script>
                    <noscript>
                     <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=<?php echo $siteId ?>&pgname=home&fmtid=9611&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">                
                      <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=<?php echo $siteId ?>&pgname=home&fmtid=9611&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
                    </noscript>
                </figure>
                <figure>
                    <div class="titulo-publi">
                        <span>publicidad</span>
                    </div>
                    <script type="text/javascript">
                     sas.call("std", {
                      siteId:  '<?php echo $siteId ?>', // 
                      pageId:  '<?php echo $pageId ?>',
                      formatId:  9608, // Formato : Primer Boton 300x100 300x100
                      target:  ''   // Segmentación
                     });
                    </script>
                    <noscript>
                     <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=<?php echo $siteId ?>&pgname=home&fmtid=9611&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">                
                      <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=<?php echo $siteId ?>&pgname=home&fmtid=9611&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
                    </noscript>
                </figure>
                <figure>
                    <div class="titulo-publi">
                        <span>publicidad</span>
                    </div>
                    <script type="text/javascript">
                     sas.call("std", {
                      siteId:  '<?php echo $siteId ?>', // 
                      pageId:  '<?php echo $pageId ?>',
                      formatId:  11772, // Formato : Primer Boton 300x100 300x100
                      target:  ''   // Segmentación
                     });
                    </script>
                    <noscript>
                     <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=<?php echo $siteId ?>&pgname=home&fmtid=9611&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">                
                      <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=<?php echo $siteId ?>&pgname=home&fmtid=9611&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
                    </noscript> 
                </figure>                   
            </div>
        </div>
        <?php if($total_articulos[0]->TOTAL > 6):  ?>
        <div class="row-fluid">    
            <div class="col-lg-8 col-md-12 center">
                <div class="paginador">
                    <nav>
                        <ul>
                            <?php echo $paginador_articulos ?>
                        </ul>
                    </nav>
                    
                </div>                        
            </div>   
        </div>      
        <?php endif; ?>          
        <div class="col-md-4"></div>             
    </div>                           
</section>  