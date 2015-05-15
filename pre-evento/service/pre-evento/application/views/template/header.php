<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Cyberlunes</title>

        <?php echo $metatag; ?>

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/vendor/normalize.min.css">
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/bootstrap/bootstrap.css">
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/vendor/owl.carousel.css">
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/vendor/owl.transitions.css">
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/vendor/jquery.bxslider.css">
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/screen.css">
        <!-- clase fix-->
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/molfis.css">
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/fix.css">
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/logos.css">
        <link rel="icon" type="image/png" href="<?php echo $base_url_static;?>img/favi_cyberLunes.png">

        <?php if (ENVIRONMENT == 'production' || ENVIRONMENT == 'origin'): ?>
            <script src="<?php echo $base_url_static?>js/s_code.js"></script>
        <?php else: ?>
            <script src="<?php echo $base_url_static?>js/s_code_dev.js"></script>
        <?php endif; ?>
        <script src="<?php echo $base_url_static;?>js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="<?php echo $base_url_static;?>js/jquery-1.10.2.min.js"></script>
        <script src="<?php echo $base_url_static;?>js/jquery.plugin.js"></script>
        <script src="<?php echo $base_url_static;?>js/jquery.countdown.js"></script>
        <script src="<?php echo $base_url_static;?>js/jquery.alphanum.js"></script>

        <script type="text/javascript" src="http://cdn1.smartadserver.com/diff/js/smartadserver.js"></script>
        <script src='http://ads.eltiempo.com/config.js?nwid=484' type="text/javascript"></script>
        <script type="text/javascript">

            sas.setup({ domain: 'http://ads.eltiempo.com',async: true, renderMode: 0});

            sas_tmstp=Math.round(Math.random()*10000000000);sas_masterflag=1;

            function sasmobile(sas_pageid,sas_formatid,sas_target) {
                if (sas_masterflag==1) {sas_masterflag=0;sas_master='M';} else {sas_master='S';};
                document.write('<scr'+'ipt src="http://ads.eltiempo.com/call2/pubmj/'+sas_pageid+'/'+sas_formatid+'/'+sas_master+'/'+sas_tmstp+'/'+escape(sas_target)+'?"></scr'+'ipt>');
            }

            function sascc(sas_imageid,sas_pageid) {
                img=new Image();
                img.src='http://ads.eltiempo.com/call/clicpixel/'+sas_imageid+'/'+sas_pageid+'/'+sas_tmstp+'?';
            }

            var appdiademoda = {
                jssdkload:false,
                idioma: 'es',
                data: eval(<?php echo $jsonParam; ?>)
            };

        </script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <style>
            #defaultCountdown ul li{
                margin-left: 2px;
            }
            iframe{
                width: 100%;
                height: 300px;
            }
        </style>
        <header>
            <div class="container">
                <div class="row head">
                    <div class="col-md-3 col-sm-6 col-xs-6 logo">
                        <a href="<?php echo $base_url;?>">
                            <img src="<?php echo $base_url_static?>img/logo.png" alt="cybermonday">
                        </a>
                    </div>
                    <?php if(!$this->agent->is_mobile()): ?>
                    <div class="col-md-3 col-sm-6 col-xs-6 title">
                        <!--<span>19 de Mayo <br>--><span>Espera el evento con los mejores descuentos</span>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-6 marcas">
                        <figure>
                            <a href="https://www.bbva.com.co/web/personas/tarjetas" target="_blank" onclick="onClickPublicidad('BBVA', 'Header')"><img src="<?php echo $base_url_static;?>img/BBVA_87X35.png" alt="BBVA" /></a>
                        </figure>
                        <figure>
                            <a href="http://www.mintic.gov.co" target="_blank" onclick="onClickPublicidad('MinTIC', 'Header')"><img src="<?php echo $base_url_static;?>img/mintic.png" alt="MinTIC" /></a>
                        </figure>
                        <figure>
                            <a href="http://www.vivedigital.gov.co" target="_blank" onclick="onClickPublicidad('Vive digital', 'Header')"><img src="<?php echo $base_url_static;?>img/digital.png" alt="Vive digital" /></a>
                        </figure>
                        <figure>
                            <a href="http://wsp.presidencia.gov.co" target="_blank" onclick="onClickPublicidad('Gobierno de Colombia', 'Header')"><img src="<?php echo $base_url_static;?>img/colombia.png" alt="Gobierno de Colombia" /></a>
                        </figure>
                    </div>
                </div>
            </div>
        </header>
