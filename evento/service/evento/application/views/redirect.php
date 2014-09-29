<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>DIRECCIONAMIENTO EXTERNO </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/vendor/normalize.min.css">
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/bootstrap/bootstrap.css">
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/screen.css">

        <!-- clase fix-->
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/molfis.css">

        <link rel="canonical" href="<?php echo $base_url ?>redireccionamiento/externo/" />

        <script src="<?php echo $base_url_static;?>js/vendor/modernizr-2.6.2.min.js"></script>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo $base_url_static;?>js/vendor/jquery-1.10.1.min.js"><\/script>')</script>        
        <script src="<?php echo $base_url_static;?>js/vendor/respond.min.js"></script>
        <script src="<?php echo $base_url_static;?>js/vendor/html5shiv.js"></script> 
         <script>



            $(document).ready(function() {
                /*var myVariable = "<?php echo $url_redirect;?>";
                if(/^([a-z]([a-z]|\d|\+|-|\.)*):(\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?((\[(|(v[\da-f]{1,}\.(([a-z]|\d|-|\.|_|~)|[!\$&'\(\)\*\+,;=]|:)+))\])|((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=])*)(:\d*)?)(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*|(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)){0})(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(myVariable)) {
                  
                } else {
                  window.location.href = '<?php echo base_url() ?>';
                }*/

               setTimeout(function() { window.location = '<?php echo $url_redirect;?>' }, 1500);

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
                redirect($base_url);
            }

        ?>
    </head>
    <body id="redireccion">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <figure class="logo">
                            <img src="<?php echo $base_url_static;?>img/redireccion.png" alt="">
                        </figure>
                    </div>
                </div>
            </div>
        </header>
        
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <span class="small">Los <b>mejores</b> descuentos </span>
                        <img src="<?php echo $base_url_static;?>img/redireccion_.png" alt="">
                        <span class="medium"><b>redireccionamiento</b></span>
                        <span class="large">externo</span>
                        <p>Usted está saliendo de Cyberlunes.com, se le llevará a la página<br>
                                <a href="<?php echo $url_redirect;?>"><?php echo $url_redirect;?></a>
                            <br>Si no ha sido redirigido en <b id="countdown"></b> segundos, presione el botón.</p>
                        <a href="<?php echo $url_redirect;?>" class="redir">ir a la <b>página</b></a>
                    </div>
                </div>
            </div>
        </section>                            
        <!-- Google Tag Manager -->
        <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NGBVTZ"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NGBVTZ');</script>
        <!-- End Google Tag Manager -->

        <!-- Facebook Conversion Code for Pixel El Tiempo -->
        <script type="text/javascript">
        var fb_param = {};
        fb_param.pixel_id = '6014934086599';
        fb_param.value = '0.01';
        fb_param.currency = 'EUR';
        (function(){
          var fpw = document.createElement('script');
          fpw.async = true;
          fpw.src = '//connect.facebook.net/en_US/fp.js';
          var ref = document.getElementsByTagName('script')[0];
          ref.parentNode.insertBefore(fpw, ref);
        })();
        </script>
        <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/offsite_event.php?id=6014934086599&amp;value=0.01&amp;currency=EUR" /></noscript>

    </body>
</html>
