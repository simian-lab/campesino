        <script src="<?php echo $base_url_static;?>js/bootstrap/bootstrap.js"></script>
        <script src="<?php echo $base_url_static;?>js/vendor/owl.carousel.js"></script>
        <script src="<?php echo $base_url_static;?>js/vendor/respond.min.js"></script>
        <script src="<?php echo $base_url_static;?>js/vendor/html5shiv.js"></script>
        <script src="<?php echo $base_url_static;?>js/main.js"></script>
        <script src="<?php echo $base_url_static;?>js/selectfiltro.js"></script>
        <script src="<?php echo $base_url_static;?>js/omniture.js"></script>
        <script src="<?php echo $base_url_static;?>js/share.js"></script>

        <script type="text/javascript">
        	$(document).ready(function(){

        		var id_destacados = [];
                var id_nodestacados = [];
                
				$.each($('#contentPromocionesdestacados').find('li'), function(){
                    id_destacados.push($(this).attr('data-id'));
                });

                printOferta(id_destacados);

                $.each($('#contentPromocionesnodestacados').find('li'), function(){
                    id_nodestacados.push($(this).attr('data-id'));
                });

                printOferta(id_nodestacados);

                var filtro = '<?php echo $this->uri->segment(2) ?>';
                if(filtro != ''){
                    onChangeFilter(filtro);
                }

        		
        	});
        </script>

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