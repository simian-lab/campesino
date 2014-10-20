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
    </body>
</html>