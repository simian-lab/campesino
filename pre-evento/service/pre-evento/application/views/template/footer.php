        <footer class="main" <?php //(isset($hide_form)?print('style="margin-bottom:0px"'):print('')) ?> style="margin-bottom:0px">
            <div class="container">
                <div class="row sponsor">                            
                    <div class="col-md-12 center">
                        <div class="marcas-mobile">
                            <figure class="col-xs-4">
                                <a href="http://www.mintic.gov.co" target="_blank"><img src="<?php echo $base_url_static;?>img/marca1.png" alt="MinTIC" /></a>
                            </figure>
                            <figure class="col-xs-4">
                                <a href="http://wsp.presidencia.gov.co" target="_blank"><img src="<?php echo $base_url_static;?>img/marca2.png" alt="Prosperidad para todos" /></a>
                            </figure>
                            <figure class="col-xs-4">
                                <a href="http://www.vivedigital.gov.co" target="_blank"><img src="<?php echo $base_url_static;?>img/marca3.png" alt="Vive digital" /></a>
                            </figure>
                            <?php /*if($this->agent->is_mobile()): ?>
                            <figure>
                                <script type="text/javascript">
                                    sas_pageid='<?php echo $sitio_seccion ?>';
                                    sas_formatid=25677;  
                                    sas_target='';   
                                    SmartAdServer(sas_pageid,sas_formatid,sas_target);
                                </script>
                                <noscript>
                                    <a href="http://ads.eltiempo.com/call/pubjumpi/<?php echo $sitio_seccion ?>/25677/M/[timestamp]/?" target="_blank">
                                    <img src="http://ads.eltiempo.com/call/pubi/<?php echo $sitio_seccion ?>/25677/M/[timestamp]/?" border="0" alt="" /></a>
                                </noscript>
                            </figure>
                            <figure>
                                <script type="text/javascript">
                                    sas_pageid='<?php echo $sitio_seccion ?>';
                                    sas_formatid=25678;  
                                    sas_target='';   
                                    SmartAdServer(sas_pageid,sas_formatid,sas_target);
                                </script>
                                <noscript>
                                    <a href="http://ads.eltiempo.com/call/pubjumpi/<?php echo $sitio_seccion ?>/25678/M/[timestamp]/?" target="_blank">
                                    <img src="http://ads.eltiempo.com/call/pubi/<?php echo $sitio_seccion ?>/25678/M/[timestamp]/?" border="0" alt="" /></a>
                                </noscript>
                            </figure>
                            <figure>
                                <script type="text/javascript">
                                    sas_pageid='<?php echo $sitio_seccion ?>';
                                    sas_formatid=25679;  
                                    sas_target='';   
                                    SmartAdServer(sas_pageid,sas_formatid,sas_target);
                                </script>
                                <noscript>
                                    <a href="http://ads.eltiempo.com/call/pubjumpi/<?php echo $sitio_seccion ?>/25679/M/[timestamp]/?" target="_blank">
                                    <img src="http://ads.eltiempo.com/call/pubi/<?php echo $sitio_seccion ?>/25679/M/[timestamp]/?" border="0" alt="" /></a>
                                </noscript>
                            </figure>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    $('.marcas-mobile').find('figure').css({width: '30%'});
                                });
                            </script>
                            <?php endif;*/ ?>
                        </div>
                        <div class="invita">
                            <div class="texto">
                                <span>evento de:</span><!--
                                --><span>invita:</span>
                            </div>
                            <div class="logos">                                
                                <a href="http://ccce.org.co/" target="_blank"><img src="<?php echo $base_url_static;?>img/camara.png" alt=""></a>
                                <a href="http://www.eltiempo.com/" target="_blank"><img src="<?php echo $base_url_static;?>img/eltiempo.png" alt=""></a>              
                            </div>
                        </div>
                    </div>
                    <div class="social">
                        <a target="_blank" class="fb" href="https://www.facebook.com/Cyberlunes" onClick='s.linkTrackVars="events,eVar13";  s.linkTrackEvents="event6";  s.events="event6";  s.eVar13="Facebook";  s.products=";18442";  s.tl(true,"o","Compartir  en  Social  Media");'><img src="<?php echo $base_url_static?>img/f.png" alt=""></a>
                        <a target="_blank" class="tw" href="https://twitter.com/Cyberlunesco" onClick='s.linkTrackVars="events,eVar13";  s.linkTrackEvents="event6";  s.events="event6";  s.eVar13="Twitter";  s.products=";18442";  s.tl(true,"o","Compartir  en  Social  Media");'><img src="<?php echo $base_url_static?>img/t.png" alt=""></a>
                    </div>
                </div>                                   
            </div>                
            <div class="row terminos">
                <div class="row ">
                    <div class="col-md-12 center">                    
                        <div>
                            <span><a href="#" data-toggle="modal" data-target="#terminos">términos y condiciones</a>  -  cyberlunes@eltiempo.com</span>
                            <span>Cyberlunes es una marca registrada de la CCCE. Prohibido su uso sin autorización.</span>
                            <span>© 2014 - Cyberlunes Todos los derechos reservados .</span>
                        </div>
                    </div>
                </div>
            </div>            
        </footer>
        
        <div class="form-bottom">
            <?php if($is_mobile == 1): ?>
            <div class="row">
                <div class="col-lg-12 banner-visa">
                    <!--<a href="#">
                        <img src="<?php echo $base_url_static;?>img/banner-visa.jpg" alt="">
                    </a>-->
                    <script type="text/javascript">
                        sas_pageid='<?php echo $sitio_seccion ?>'; // Página : Cyberlunes_Pre-Evento/home
                        sas_formatid=20592;  // Formato : Movil Barra Fija 0x0
                        sas_target='';   // Segmentación
                        SmartAdServer(sas_pageid,sas_formatid,sas_target);
                    </script>
                    <noscript>
                        <a href="http://ads.eltiempo.com/call2/pubjumpmi/<?php echo $sitio_seccion ?>/15271/M/[timestamp]/?" target="_blank">
                        <img src="http://ads.eltiempo.com/call2/pubmi/<?php echo $sitio_seccion ?>/15271/M/[timestamp]/?" border="0" alt="" /></a>
                    </noscript>
                </div>
            </div>
            <?php endif; ?>
            <?php //if(!isset($hide_form)): ?>
            <div class="row-fluid panel-group titulo" id="accordion" style="display:none">
              <div class="panel">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-parent="#accordion" href="#collapseOne" id="slidetoggle">
                      <span> SUSCRÍBETE Y RECIBE LAS OFERTAS ANTES QUE LOS DEMÁS</span>
                    </a>
                  </h4>
                  <div style="float: left; width: 100%; text-align: right; margin-top: -31px;">
                    <img src="<?php echo $base_url_static?>img/arrow-down.png" id="icon-collapse-form" style="width:25px"/>
                  </div>
                </div>
                <div id="collapseOne" class="panel-collapse">
                  <div class="panel-body">
                    <div class="container form">                
                        <div class="row">
                            <div class="col-lg-3">
                                <h2>Suscríbete</h2>
                                <p>Registra tus datos, cuéntanos las categorías en las que quieres recibir descuentos ¡y listo!</p>
                            </div>
                            <div class="col-lg-9">
                                <form action="http://www.elabs10.com/functions/mailing_list.html" method="post" name="UPTml251010" onSubmit='s.linkTrackVars="events,eVar38"; s.linkTrackEvents="event5"; s.eVar38="footer";s.events="event5";s.tl(true,"o","Formulario Registro"); return (!(UPTvalidateform(document.UPTml251010)));'>
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

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input type="text" name="val_58933" placeholder="Nombre" value="" id="nombre_form_bottom"/>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="text" name="email" placeholder="Email" value="" />
                                        </div>
                                        <div class="col-lg-4 dropup">
                                            <?php if(!$this->agent->is_mobile()): ?>
                                            <select name="val_66010[]" id="interes-mobile" multiple="multiple">
                                                <option value="Tecnologia">Tecnología</option>
                                                <option value="Moviles">Móviles</option>
                                                <option value="Viajes y turismo">Viajes y turismo</option>
                                                <option value="Moda">Moda</option>
                                                <option value="Otras categorias">Otras categorías</option>
                                            </select>
                                            <?php endif; ?>     
                                            <?php if($this->agent->is_mobile()): ?>
                                            <select name="val_66010[]" id="interes-mobile">
                                                <option value="" disabled selected>Intereses</option>
                                                <option value="Tecnologia">Tecnología</option>
                                                <option value="Moviles">Móviles</option>
                                                <option value="Viajes y turismo">Viajes y turismo</option>
                                                <option value="Moda">Moda</option>
                                                <option value="Otras categorias">Otras categorías</option>
                                            </select>
                                            <?php endif; ?>  
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <div class="bases">
                                                <input type="hidden" name="val_66009" value="on"/>
                                                <span>Al hacer clic en suscribirte estás aceptando los <a href="#" data-toggle="modal" data-target="#terminos">términos y condiciones</a> y la <a href="#" data-toggle="modal" data-target="#politicas">política de privacidad</a> del portal.</span>   
                                            </div>
                                            <!--<div class="bases">
                                                <input type="checkbox" name="val_66095"/>
                                                <span>Acepto recibir correos de Portales de Casa Editorial El Tiempo</span>
                                            </div>-->
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="hidden" id="showpopup" value="on" name="showpopup">
                                            <input type="submit" value="SUSCRÍBETE" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> 
                  </div>
                </div>
              </div>
            </div>
            <?php //endif; ?>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo $base_url_static?>js/vendor/jquery-1.10.1.min.js"><\/script>')</script>        
        <script src="<?php echo $base_url_static?>js/vendor/owl.carousel.js"></script>
        <script src="<?php echo $base_url_static?>js/vendor/jquery.bxslider.min.js"></script> 
        <script src="<?php echo $base_url_static?>js/vendor/jquery.placeholder.js"></script>
        <script src="<?php echo $base_url_static?>js/vendor/respond.min.js"></script>
        <script src="<?php echo $base_url_static?>js/vendor/html5shiv.js"></script>                      
        <script src="<?php echo $base_url_static?>js/bootstrap/bootstrap.min.js"></script>       
        <script src="<?php echo $base_url_static?>js/bootstrap/bootstrap-multiselect.js"></script>          
        <script src="<?php echo $base_url_static?>js/main.js"></script>
        <script src="<?php echo $base_url_static;?>js/jquery.alphanum.js"></script>

        <script language="JavaScript" type="text/javascript"><!--   
        //  ASIGNAR VALORES A LAS VARIABLES EN  ESTA  SECCION  
        s.pageName="<?php echo $s_pageName; ?>";
        s.channel =   "<?php echo $s_channel; ?>";       
        <?php if( isset($s_prop1)) { echo  "s.prop1=\"".$s_prop1."\";"; }  ?>      
        <?php if( isset($s_prop2)) { echo  "s.prop2=\"".$s_prop2."\";"; } ?>
        /*************  DO  NOT ALTER ANYTHING  BELOW THIS  LINE  ! **************/ 
        var s_code=s.t();if(s_code)document.write(s_code)//--></script> 
        <!--  End SiteCatalyst  code  --> 

        <!-- Google Tag Manager -->
        <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NGBVTZ"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NGBVTZ');</script>
        <!-- End Google Tag Manager -->
    </body>
</html>
