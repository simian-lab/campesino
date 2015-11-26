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
		
		<?php if (ENVIRONMENT == 'production' || ENVIRONMENT == 'origin'): ?>
            <script src="<?php echo $url['base_url_static'];?>js/s_code.js"></script>     
        <?php else: ?>
            <script src="<?php echo $url['base_url_static'];?>js/s_code_dev.js"></script> 
        <?php endif; ?>
		
		<script>
		
			// ASIGNAR VALORES A LAS VARIABLES EN ESTA SECCION
			s.pageName="<?php echo EVENTO_NOMBRE;?>: redireccion: : ";
			s.channel = "<?php echo EVENTO_NOMBRE;?>: redireccion";
            s.prop1="<?php echo EVENTO_NOMBRE;?>: redireccion: ";
			s.prop2="<?php echo EVENTO_NOMBRE;?>: redireccion: : ";
            /************* DO NOT ALTER ANYTHING BELOW THIS LINE ! **************/
            var s_code = s.t();
            if(s_code)document.write(s_code)//-->
		
		
			function getVarsUrl(){
				var url= location.search.replace("?", "");
				var arrUrl = url.split("&");
				var urlObj={};
				for(var i=0; i<arrUrl.length; i++){
					var x= arrUrl[i].split("=");
					urlObj[x[0]]=x[1]
				}
				return urlObj;
			}

			var objetoj = getVarsUrl();

			if(typeof objetoj.id === 'undefined'){
				s.linkTrackVars = "";
			}
			else{
				s.linkTrackVars = 'events,eVar80,eVar81,eVar83,eVar84,eVar85,products';
				s.linkTrackEvents = 'event36';
				s.events = 'event36';
				s.eVar80 = 'evento';
				s.eVar81 = objetoj.ele;
				s.eVar83 = objetoj.tienda;
				s.eVar84 = objetoj.ori;
				s.eVar85 = objetoj.tipo;
				s.products=";"+objetoj.id;
				s.tl(true, 'o', "clic en oferta");
			}
			
			if(typeof objetoj.idtienda === 'undefined'){
				s.linkTrackVars = "";
			}
			else{
				s.linkTrackVars = 'events,eVar83,eVar84,eVar85';
				s.linkTrackEvents = 'event38';
				s.events = 'event38';
				s.eVar83 = objetoj.idtienda;
				s.eVar84 = objetoj.ori;
				s.eVar85 = objetoj.tipo;
				s.tl(true, 'o', "clic en retail");

			}
		</script>
		
    </head>
    <body>
        <div class="redirect-loading"></div>
                <!-- Google Tag Manager -->
      <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MPFWLN"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
      <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-MPFWLN');</script>
      <!-- End Google Tag Manager -->
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
      <noscript>
        <img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6031250315599&amp;cd[value]=0.01&amp;cd[currency]=EUR&amp;noscript=1" />
      </noscript>

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
        
  
    </body>
</html>
