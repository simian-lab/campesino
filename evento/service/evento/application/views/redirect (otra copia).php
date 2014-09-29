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
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/screen-pre-evento.css">


        

        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>        
        <script>window.jQuery || document.write('<script src="<?php echo $base_url_static;?>js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
    	 <script>



				$(document).ready(function() {
  					setTimeout(function() { window.location = '<?php echo $url_redirect;?>' }, 3000);

				  var count = 3;
				  countdown = setInterval(function(){
				    $("#countdown").html(count);

				    count--;
				  }, 1000);
				});

		</script>
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
                        	<br>Si no ha sido redirígido en <span id="countdown" style="font-weight:bold;"></span> segundos persione el boton ir a la pagina. </p>
                        <a href="<?php echo $url_redirect;?>" class="redir">ir a la <b>página</b></a>
                    </div>
                </div>
            </div>
        </section>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>        
        <script>window.jQuery || document.write('<script src="<?php echo $base_url_static;?>js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
       
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
