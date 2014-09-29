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
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/vendor/owl.carousel.css">
        <link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/screen.css">

        <script src="<?php echo $base_url_static;?>js/vendor/modernizr-2.6.2.min.js"></script>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>        
        <script>window.jQuery || document.write('<script src="<?php echo $base_url_static;?>js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
    	 <script>



				$(document).ready(function() {
  					setTimeout(function() { window.location = '<?php echo $url_redirect;?>' }, 3000);

				  var count = 3;
				  countdown = setInterval(function(){
				    $(".countdown").html(count);

				    count--;
				  }, 1000);
				});

		</script>
    </head>
    <body>
        

        <section class="wrapp">
           <div class="container">
            
                <div class="row">
                    <div class="col-lg-12">
                        <div class="articulos">
                            <h1><b>DIRECCIONAMIENTO EXTERNO </b></h1>
                         
                    
                                <h2>Usted esta saliendo de Cyberlunes.com.co,  se le llevará a la página </h2>
                                <h2><a href="<?php echo $url_redirect;?>"><?php echo $url_redirect;?></a></h2>  

                                   
                            
                            
                                <p>Si no ha sido redirígido en <span class="countdown" style="font-weight:bold;"></span> segundos persione el boton ir a la pagina. </p>
                                     
                            
                            <div class="fix"></div>
                    
                        </div>                                                                                                  
                    </div>      

                     <div class="col-lg-12">
                        <div class="articulos">                            
                       
                            <p>
                            	<a href="<?php echo $url_redirect;?>" class="link orange">ir a la pagina</a>
                      		
                      		</p>                       
                            
                            <div class="fix"></div>
                    
                        </div>                                                                                                  
                    </div>                    
                  
                </div>
             
           </div>
        </section>                
       
    
    </body>
</html>
