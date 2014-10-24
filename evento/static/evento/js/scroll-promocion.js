$(document).ready(function() {
            var idPromociones;
            var id_destacados = [];
            var id_nodestacados = [];
            jQuery.ias({
                container : '#contentPromocionesdestacados',
                item: '.post',
                pagination: '.navigation',
                next: '.next-posts a',
                loader: '<img src="' + base_url_static +'/img/loading.gif"/>',                
                triggerPageThreshold: 90,
                trigger: 'Cargar más items',
                onPageChange: function(pageNum, pageUrl, scrollOffset) {},
                onLoadItems: function(items){
                    $.each(items, function(){
                        id_destacados.push($(this).attr('data-id'));
                    });

                    printOferta(id_destacados);
                    id_destacados = [];
                }
            });
            //alert(ias)
             jQuery.ias({
                container : '#contentPromocionesnodestacados',
                item: '.post-no-destacados',
                pagination: '.navigation-no-destacados',
                next: '.next-posts-no-destacados a',
                loader: '<img src="' + base_url_static +'/img/loading.gif"/>',                
                triggerPageThreshold: 90,
                trigger: 'Cargar más items',
                onPageChange: function(pageNum, pageUrl, scrollOffset) {},
                onLoadItems: function(items){
                    $.each(items, function(){
                        id_nodestacados.push($(this).attr('data-id'));
                    });

                    printOferta(id_nodestacados);
                    id_nodestacados = [];
                }
            });
});