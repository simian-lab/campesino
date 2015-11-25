<?php
/*
switch (ENVIRONMENT)
{
	case  'development':
		 $base_url='eltiempo-co-teconviene.dev.cba.brandigital.com';
	break;
	case '';	    	
               $base_url= 'gni-ar-redisenio.live.ec2us.brandigital.com':
	break;
	default:
		define('ENVIRONMENT', 'production');	
	break;
}
*/
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<?php 
$base_url = 'http://'.$_SERVER['SERVER_NAME'].'/';
$base_url_static = 'http://'.$_SERVER['SERVER_NAME'].'/static/evento/';
    
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?php echo $base_url_static ?>stylesheets/bootstrap/bootstrap.css">
        <link rel="stylesheet" href="<?php echo $base_url_static ?>stylesheets/errores.css">
        <title>404</title>
		
    </head>
    <body class="conbg">
                <!-- Google Tag Manager -->
      <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MPFWLN"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
      <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-MPFWLN');</script>
      <!-- End Google Tag Manager -->
        <!-- img principal desktop -->
        <div class="principal-content">
            <img src="<?php echo $base_url_static;?>img/pagina_404_bk_principal.png">
        </div>
        <!-- img principal 720 -->
        <div class="principal-content-720">
            <img src="<?php echo $base_url_static;?>img/pagina_404_bk_principal-720.png">
        </div>
        <!-- img principal 420 -->
        <div class="principal-content-420">
            <img src="<?php echo $base_url_static;?>img/pagina_404_bk_principal-420.png">
        </div>
        <div class="button_back_404">
            <a href="<?php echo $base_url ?>">volver</a>
        </div>
        <script src="<?php echo $base_url_static ?>js/vendor/respond.min.js"></script>
        <script src="<?php echo $base_url_static ?>js/vendor/html5shiv.js"></script>  
<?php if (ENVIRONMENT == 'production' || ENVIRONMENT == 'origin'): ?>
            <script src="<?php echo $base_url_static?>js/s_code.js"></script>     
        <?php else: ?>
            <script src="<?php echo $base_url_static?>js/s_code_dev.js"></script> 
        <?php endif; ?>
		
		
  <script language="JavaScript" type="text/javascript"><!--
            			
			// ASIGNAR VALORES A LAS VARIABLES EN ESTA SECCION
			s.pageName="<?php echo EVENTO_NOMBRE;?>: error404: : ";
			s.channel = "<?php echo EVENTO_NOMBRE;?>: error404";
            s.pageType = "errorPage";
            /************* DO NOT ALTER ANYTHING BELOW THIS LINE ! **************/
            var s_code = s.t();
            if(s_code)document.write(s_code)//-->
			
			s.linkTrackVars = "events,eVar62,eVar63";
			s.linkTrackEvents = "event99";
			s.events = "event99";
			s.eVar62 = "<?php  echo $_SERVER['HTTP_REFERER'];?>";
			s.eVar63 = window.location.href;
			s.tl(true,"o","Error");
			
			

        </script>
		
    </body>
</html>



    
