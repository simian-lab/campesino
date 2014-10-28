        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        
        <header>
            <div class="container">
                <div class="row head">
                    <div class="col-md-3 col-sm-6 col-xs-6 logo">
                        <a href="<?php echo $base_url;?>">                            
                            <img src="<?php echo $base_url_static?>img/logo.png" alt="cybermonday">           
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6 title">
                        <span>¡Hasta media noche!</span>
                    </div>                    
                    <div class="col-md-5 col-md-offset-1 marcas">
                        <?php /*if(!$this->agent->is_mobile()): ?>
                        <figure>
                            <!--<a href="http://www.mintic.gov.co" target="_blank"><img src="<?php echo $base_url_static;?>img/marca1.png" alt="MinTIC" /></a>-->
                            <script type="text/javascript">
                                sas_pageid='41700/282275'; // Página : Cyberlunes/home
                                sas_formatid=25677;  // Formato : Patrocimio MinTic  97x24
                                sas_target='';   // Segmentación
                                SmartAdServer(sas_pageid,sas_formatid,sas_target);
                            </script>
                            <noscript>
                                <a href="http://ads.eltiempo.com/call/pubjumpi/41700/282275/25677/S/[timestamp]/?" target="_blank">
                                <img src="http://ads.eltiempo.com/call/pubi/41700/282275/25677/S/[timestamp]/?" border="0" alt="" /></a>
                            </noscript>
                        </figure>
                        <figure>
                            <!--<a href="http://wsp.presidencia.gov.co" target="_blank"><img src="<?php echo $base_url_static;?>img/marca2.png" alt="Propiedad para todos" /></a>-->
                            <script type="text/javascript">
                                sas_pageid='41700/282275'; // Página : Cyberlunes/home
                                sas_formatid=25678;  // Formato : Patrocimio Prosperidad 131x24
                                sas_target='';   // Segmentación
                                SmartAdServer(sas_pageid,sas_formatid,sas_target);
                            </script>
                            <noscript>
                                <a href="http://ads.eltiempo.com/call/pubjumpi/41700/282275/25678/S/[timestamp]/?" target="_blank">
                                <img src="http://ads.eltiempo.com/call/pubi/41700/282275/25678/S/[timestamp]/?" border="0" alt="" /></a>
                            </noscript>
                        </figure>
                        <figure>
                            <!--<a href="http://www.vivedigital.gov.co" target="_blank"><img src="<?php echo $base_url_static;?>img/marca3.png" alt="Vive digital" /></a>-->
                            <script type="text/javascript">
                                sas_pageid='41700/282275'; // Página : Cyberlunes/home
                                sas_formatid=25679;  // Formato : Patrocimio Vivedigital 115x24
                                sas_target='';   // Segmentación
                                SmartAdServer(sas_pageid,sas_formatid,sas_target);
                            </script>
                            <noscript>
                                <a href="http://ads.eltiempo.com/call/pubjumpi/41700/282275/25679/S/[timestamp]/?" target="_blank">
                                <img src="http://ads.eltiempo.com/call/pubi/41700/282275/25679/S/[timestamp]/?" border="0" alt="" /></a>
                            </noscript>
                        </figure>
                        <?php endif; */?>
                    </div>
                </div>                             
            </div>            
        </header>

        <!-- MENU -->
             <?php echo $menu_html;?>

        <!-- FIN MENU --> 

        <div class="share">
            <a onClick='shareFacebook();' href="#" class=""><img src="<?php echo $base_url_static ?>img/social_fb.png" alt=""></a>
            <a onClick='shareTwitter();'  href="#" class=""><img src="<?php echo $base_url_static ?>img/social_tw.png" alt=""></a>
        </div>

        