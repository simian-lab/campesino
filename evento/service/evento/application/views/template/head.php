<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <title><?php echo $meta_title; ?></title>
        
         <?php echo $metatag; ?>
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/vendor/normalize.min.css">
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/bootstrap/bootstrap.css">
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/vendor/owl.carousel.css">
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/screen-<?php echo EVENTO;?>.css">
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/molfis.css">
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/vendor/3dhover.css">

        <?php //if($this->agent->is_mobile()): ?>
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/fix.css">
        <?php //endif; ?>
        
        <link rel="icon" type="image/png" href="<?php echo $base_url_static;?>img/favi_cyberLunes.png">
        
        
        <?php if (ENVIRONMENT == 'production' || ENVIRONMENT == 'origin'): ?>
            <script src="<?php echo $base_url_static?>js/s_code.js"></script>     
        <?php else: ?>
            <script src="<?php echo $base_url_static?>js/s_code_dev.js"></script> 
        <?php endif; ?>
        <script type="text/javascript" src="http://cdn1.smartadserver.com/diff/js/smartadserver.js"></script>
        <script src="<?php echo $base_url_static;?>js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>        
        <script>window.jQuery || document.write('<script src="<?php echo $base_url_static;?>js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
        <script type="text/javascript">
               var base_url_static ="<?php echo $base_url_static;?>";
               var base_descuentosfiltro =<?php echo $descuentosfiltro;?>;
        </script>

        <script type="text/javascript" src="<?php echo $base_url_static;?>js/omniture.js"></script>
        <script type="text/javascript" src="http://cdn1.smartadserver.com/diff/js/smartadserver.js"></script>
        <!--[if lt IE 9]>
            <script src="<?php echo $base_url_static;?>js/vendor/respond.min.js"></script>
            <script src="<?php echo $base_url_static;?>js/vendor/html5shiv.js"></script>
        <![endif]-->
        
        <script type="text/javascript" src="http://ads.eltiempo.com/config.js?nwid=484"></script>
        <script src='http://ads.eltiempo.com/config.js?nwid=484' type="text/javascript"></script>
        <script type="text/javascript">
            sas.setup({ domain: 'http://ads.eltiempo.com'});

            var appdiademoda = {
                jssdkload:false,
                idioma: 'es',              
                data: eval(<?php echo $jsonParam; ?>)
            };
        </script>
        
    </head>
    <body>
              <!-- Google Tag Manager -->
      <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MPFWLN"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
      <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-MPFWLN');</script>
      <!-- End Google Tag Manager -->
      <input type="hidden" it="twitter_tag_line" value="<?php echo TAG_TWITTER;?>"> 
      <input type="hidden" it="facebook_tag_line" value="<?php echo TAG_FACEBOOK;?>"> 