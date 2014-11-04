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
                triggerPageThreshold: 9999,
                trigger: 'Cargar más items',
                onPageChange: function(pageNum, pageUrl, scrollOffset) {},
                onLoadItems: function(items){
                    $.each(items, function(){
                        id_destacados.push($(this).attr('data-id'));
                    });
                    id_destacados = [];

                    var duplicados = new Array();
                    console.log('Grandes: '+$(".destacados ul li").size())
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
                }
            });
            //alert(ias)
             jQuery.ias({
                container : '#contentPromocionesnodestacados',
                item: '.post-no-destacados',
                pagination: '.navigation-no-destacados',
                next: '.next-posts-no-destacados a',
                loader: '<img src="' + base_url_static +'/img/loading.gif"/>',                
                triggerPageThreshold: 9999,
                trigger: 'Cargar más items',
                onPageChange: function(pageNum, pageUrl, scrollOffset) {},
                onLoadItems: function(items){
                    $.each(items, function(){
                        id_nodestacados.push($(this).attr('data-id'));
                    });

                    id_nodestacados = [];

                    var duplicados = new Array();
                    console.log('Chicas: '+$(".no-destacados ul li").size())
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
                }
            });
});