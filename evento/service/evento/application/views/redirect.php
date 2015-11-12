<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>DIRECCIONAMIENTO EXTERNO </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?php echo $url['base_url_static'];?>stylesheets/vendor/normalize.min.css">
        <link rel="stylesheet" href="<?php echo $url['base_url_static'];?>stylesheets/bootstrap/bootstrap.css">
        <link rel="stylesheet" href="<?php echo $url['base_url_static'];?>stylesheets/screen.css">

        <!-- clase fix-->
        <link rel="stylesheet" href="<?php echo $url['base_url_static'];?>stylesheets/molfis.css">
        <link rel="stylesheet" href="<?php echo $url['base_url_static'];?>stylesheets/fix.css">

        <link rel="canonical" href="<?php echo $url['base_url_static'] ?>redireccionamiento/externo/" />

        <script src="<?php echo $url['base_url_static'];?>js/vendor/modernizr-2.6.2.min.js"></script>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo $url['base_url_static'];?>js/vendor/jquery-1.10.1.min.js"><\/script>')</script>        
        <script src="<?php echo $url['base_url_static'];?>js/vendor/respond.min.js"></script>
        <script src="<?php echo $url['base_url_static'];?>js/vendor/html5shiv.js"></script> 
         <script>



            $(document).ready(function() {
               var url = '<?php echo $url_redirect;?>';
               var url_decoded = url.replace(/&amp;/g, '&');
               setTimeout(function() { window.location = url_decoded }, 1500);

              var count = 1.5;
              countdown = setInterval(function(){
                if(count < 0){
                 count = 0;   
                }

                $("#countdown").html(count);

                count--;

              }, 1000);
            });

        </script>
        <?php 

            if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url_redirect)){
                redirect($base_url_static);
            }

        ?>
    </head>
    <body id="redireccion">
                <!-- Google Tag Manager -->
      <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MPFWLN"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
      <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-MPFWLN');</script>
      <!-- End Google Tag Manager -->
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <!-- Google Code for Eventos Redireccionamiento Conversion Page -->
        <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 969745351;
        var google_conversion_language = "en";
        var google_conversion_format = "3";
        var google_conversion_color = "ffffff";
        var google_conversion_label = "3sfYCJvri18Qx8e0zgM";
        var google_remarketing_only = false;
        /* ]]> */
        </script>
        <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
        </script>
        <noscript>
        

<!-- Facebook Conversion Code for LO ENCONTRASTE - Checkouts -->
<script>
(function() {
    var _fbq = window._fbq || (window._fbq = []);
    if (!_fbq.loaded) {
        var fbds = document.createElement('script');
        fbds.async = true;
        fbds.src = '//connect.facebook.net/en_US/fbds.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(fbds, s);
        _fbq.loaded = true;
    }
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', '6031250315599', {'value':'0.01','currency':'EUR'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6031250315599&amp;cd[value]=0.01&amp;cd[currency]=EUR&amp;noscript=1" /></noscript>
  
    </body>
</html>
