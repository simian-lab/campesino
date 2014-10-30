        <script src="<?php echo $base_url_static;?>js/bootstrap/bootstrap.js"></script>
        <script src="<?php echo $base_url_static;?>js/vendor/owl.carousel.js"></script>
        <script src="<?php echo $base_url_static;?>js/vendor/respond.min.js"></script>
        <script src="<?php echo $base_url_static;?>js/vendor/html5shiv.js"></script>
        <script src="<?php echo $base_url_static;?>js/main.js"></script>
        <script src="<?php echo $base_url_static;?>js/selectfiltro.js"></script>

        <script type="text/javascript">
        	$(document).ready(function(){

        		var id_destacados = [];
                var id_nodestacados = [];
                
				$.each($('#contentPromocionesdestacados').find('li'), function(){
                    id_destacados.push($(this).attr('data-id'));
                });


                $.each($('#contentPromocionesnodestacados').find('li'), function(){
                    id_nodestacados.push($(this).attr('data-id'));
                });


                var filtro = '<?php echo $this->uri->segment(2) ?>';
                var duplicados = new Array();
                $(".destacados,.no-destacados ul li").each(function(k,v){
                    var idPromo = ($(v).data("id"));
                    var impresiones = new Array();
                    $(".destacados,.no-destacados ul li").each(function(k1,v1){
                     if(idPromo == ($(v1).data("id")) ){impresiones.push(idPromo);}
                    })
                    if(impresiones.length > 1){duplicados.push(idPromo)}
                })
                
                if(duplicados.length > 1){
                    alert("Duplicados: " + duplicados);
                }

                setInterval(function () {
                    var iScroll = $(window).scrollTop();
                    iScroll = iScroll + 2000;
                    $('html, body').animate({
                        scrollTop: iScroll
                    }, 10);
                }, 20);
        		
        	});
        </script>

        
    </body>
</html>