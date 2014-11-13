        <footer class="main" id="footer_main">
            <div class="container">
                <div class="row sponsor">                            
                    <div class="col-md-12 center">
                        <div class="marcas-mobile clearfix">
                            <figure class="col-xs-4">
                                <a href="http://www.mintic.gov.co" target="_blank" onclick="onClickPublicidad('MinTIC', 'Footer')" ><img src="<?php echo $base_url_static;?>img/mintic.png" alt="MinTIC" /></a>
                            </figure>
                            <figure class="col-xs-4">
                                <a href="http://www.vivedigital.gov.co" target="_blank" onclick="onClickPublicidad('Vive digital', 'Footer')"><img src="<?php echo $base_url_static;?>img/digital.png" alt="Vive digital" /></a>
                            </figure>
                            <figure class="col-xs-4">
                                <a href="http://wsp.presidencia.gov.co" target="_blank" onclick="onClickPublicidad('Gobierno de Colombia', 'Footer')"><img src="<?php echo $base_url_static;?>img/colombia.png" alt="Gobierno de Colombia" /></a>
                            </figure>
                        </div>
                        <div class="invita">
                            <div class="texto">
                                <span>evento de:</span><!--
                                --><span>invita:</span>
                            </div>
                            <div class="logos">                                
                                <a href="http://ccce.org.co/" target="_blank" onclick="onClickPublicidad('CCCE', 'Footer')"><img src="<?php echo $base_url_static;?>img/camara.png" alt=""></a>
                                <a href="http://www.eltiempo.com/" target="_blank" onclick="onClickPublicidad('El tiempo', 'Footer')"><img src="<?php echo $base_url_static;?>img/eltiempo.png" alt=""></a>              
                            </div>
                        </div>
                    </div>
                    <div class="social">
                        <a target="_blank" class="fb" href="https://www.facebook.com/Cyberlunes"><img src="<?php echo $base_url_static?>img/f.png" alt=""></a>
                        <a target="_blank" class="tw" href="https://twitter.com/Cyberlunesco" ><img src="<?php echo $base_url_static?>img/t.png" alt=""></a>
                    </div>
                </div>                                   
            </div>                
            <div class="row terminos">
                <div class="row ">
                    <div class="col-md-12 center">                    
                        <div>
                            <span><a href="#" data-toggle="modal" data-target="#terminos">términos y condiciones</a>  -  <a href="mailto:cyberlunes@eltiempo.com">Contáctanos</a>  -  <a href="#" data-toggle="modal" data-target="#uso_marca">Uso de marca Cyberlunes&reg;</a></span>
                            <span>Cyberlunes es una marca registrada de la CCCE. Prohibido su uso sin autorización.</span>
                            <span>© 2014 - Cyberlunes Todos los derechos reservados .</span>
                            <span>Entidad de protección al consumidor <a href="http://www.sic.gov.co" target="_blank">www.sic.gov.co</a></span>
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
                     sas.call("std", {
                      siteId:  '<?php echo $siteId ?>', // 
                      pageId:  '<?php echo $pageId ?>', // Página : Cyberlunes/home
                      formatId:  8941, // Formato : Barra Fija 960x30
                      target:  ''   // Segmentación
                     });
                    </script>
                    <noscript>
                     <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=<?php echo $siteId ?>&pgname=home&fmtid=8941&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">                
                      <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=<?php echo $siteId ?>&pgname=home&fmtid=8941&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
                    </noscript>
                </div>
            </div>
            <?php endif; ?>
            <?php if(!$this->config->item('contingencia')): ?>
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
                                <form action="http://www.elabs10.com/functions/mailing_list.html" method="post" name="UPTml251010" onSubmit='return (!(UPTvalidateform(document.UPTml251010)));'>
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
            <?php endif; ?>
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
