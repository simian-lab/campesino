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
//print_R($_SERVER['SERVER_NAME']);
    switch ($_SERVER['SERVER_NAME']){

        case 'pre-evento.eltiempo-co-cyberlunes.dev.brandigital.com':
            $base_url = 'http://pre-evento.eltiempo-co-cyberlunes.dev.brandigital.com/';
            $base_url_static = 'http://pre-evento.eltiempo-co-cyberlunes.dev.brandigital.com/static/pre-evento/'; 
            break;
        case 'pre-evento.eltiempo-co-cyberlunes.stage.brandigital.com':
            $base_url = 'http://pre-evento.eltiempo-co-cyberlunes.stage.brandigital.com/';
            $base_url_static = 'http://pre-evento.eltiempo-co-cyberlunes.stage.brandigital.com/static/pre-evento/'; 
            break;
        case 'pre-evento.eltiempo-co-cyberlunes.live.brandigital.com':
            $base_url = 'http://pre-evento.eltiempo-co-cyberlunes.live.brandigital.com/';
            $base_url_static = 'http://pre-evento.eltiempo-co-cyberlunes.live.brandigital.com/static/pre-evento/'; 
            break;
        case 'www.cyberlunes.com.co':
            $base_url = 'http://www.cyberlunes.com.co/';
            $base_url_static = 'http://pre-evento.eltiempo-co-cyberlunes.live.brandigital.com/static/pre-evento/'; 
            break;
    }
    
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?php echo $base_url_static ?>stylesheets/bootstrap/bootstrap.css">
        <link rel="stylesheet" href="<?php echo $base_url_static ?>stylesheets/errores.css">
        <title>404</title>
    </head>
    <body>
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12"><img src="<?php echo $base_url_static;?>img/logo.png" alt=""></div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <h1>Los <b>mejores</b> descuentos</h1>
                    <img src="<?php echo $base_url_static;?>img/carpa.png" alt="" style="width:90%">
                    <h2 style="margin-bottom: 14px;">¡Lo sentimos!</h2>
                    <span class="numb">404</span>
                    <p>Has llegado a una esquina de nuestro sitio que no hemos finalizado.<br>
                    Mientras la terminamos regresa al inicio o consulta uno de nuestros artículos</p>
                    <a href="<?php echo $base_url; ?>" class="boton">ir al <b>inicio</b></a>
                </div>
            </div>
        </div>
        <script src="<?php echo $base_url_static ?>js/vendor/respond.min.js"></script>
        <script src="<?php echo $base_url_static ?>js/vendor/html5shiv.js"></script>       
    </body>
</html>


<script src="<?php echo $base_url_static ?>js/s_code.js"></script>  

  <script language="JavaScript" type="text/javascript"><!--   
  //  ASIGNAR VALORES A LAS VARIABLES EN  ESTA  SECCION  
s.pageType = "errorPage";    
  /*************  DO  NOT ALTER ANYTHING  BELOW THIS  LINE  ! **************/ 
  var s_code=s.t();if(s_code)document.write(s_code)//--></script> 
  <!--  End SiteCatalyst  code  --> 
  <!-- Codigo  HTML -->
    </body>
</html>
