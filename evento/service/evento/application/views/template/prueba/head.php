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
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/screen.css">
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/molfis.css">
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/vendor/3dhover.css">

        <?php //if($this->agent->is_mobile()): ?>
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/fix.css">
        <?php //endif; ?>
        
        <link rel="icon" type="image/png" href="<?php echo $base_url_static;?>img/favi_cyberLunes.png">
        
        
        <script src="<?php echo $base_url_static;?>js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>        
        <script>window.jQuery || document.write('<script src="<?php echo $base_url_static;?>js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
        <script type="text/javascript">
               var base_url_static ="<?php echo $base_url_static;?>";
               var base_descuentosfiltro =<?php echo $descuentosfiltro;?>;
        </script>

        
        
    </head>
    <body>