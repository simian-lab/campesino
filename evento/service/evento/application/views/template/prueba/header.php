        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        
        <header>
            <div class="container">
                <div class="row head">
                    <div class="col-md-3 col-sm-6 col-xs-6 logo">
                        <a href="<?php echo $base_url;?>" onclick="clickHeader('logo LOE')">                            
                            <img src="<?php echo $base_url_static?>img/logo.png" alt="cybermonday">           
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6 title">
                        <?php if(!$this->agent->is_mobile()): ?>
                        <span>¡Hasta media noche!</span>
                        <?php endif; ?>
                    </div>                    
                    <div class="col-md-5 col-md-offset-1 marcas">
                        <figure>
                            <a href="http://www.mintic.gov.co" target="_blank" onclick="onClickPublicidad('MinTIC', 'Header')"><img src="<?php echo $base_url_static;?>img/mintic_mobile.png" alt="MinTIC" /></a>
                        </figure>
                        <figure>
                            <a href="http://www.vivedigital.gov.co" target="_blank" onclick="onClickPublicidad('Vive digital', 'Header')"><img src="<?php echo $base_url_static;?>img/digital_mobile.png" alt="Vive digital" /></a>
                        </figure>
                        <figure>
                            <a href="http://wsp.presidencia.gov.co" target="_blank" onclick="onClickPublicidad('Gobierno de Colombia', 'Header')"><img src="<?php echo $base_url_static;?>img/colombia_mobile.png" alt="Gobierno de Colombia" /></a>
                        </figure>
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

        