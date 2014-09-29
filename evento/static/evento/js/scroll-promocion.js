$(document).ready(function() {
            var idPromociones;
            jQuery.ias({
                container : '#contentPromocionesdestacados',
                item: '.post',
                pagination: '.navigation',
                next: '.next-posts a',
                loader: '<img src="' + base_url_static +'/img/loading.gif"/>',                
                triggerPageThreshold: 90,
                trigger: 'Cargar más items',
                onPageChange: function(pageNum, pageUrl, scrollOffset) {//alert(1)
                    s.linkTrackVars="events,products";
                    s.linkTrackEvents="event41";
                    s.events="event41";
                    s.products=$('.idPromo').text();
                    s.tl(this,"o","impresion elemento");
                    // console.log('Cargo');
                    //hoverPromociones();
                //   path = jQuery('<a/>').attr('href',pageUrl)[0].pathname.replace(/^[^\/]/,'/');                
               //    ga('send', 'pageview', path + '?provincia=' + filtro.ciudad + '&categoria='+filtro.categoria);
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
                onPageChange: function(pageNum, pageUrl, scrollOffset) {
                    s.linkTrackVars="events,products";
                    s.linkTrackEvents="event41";
                    s.events="event41";
                    s.products=$('.idPromo').text();
                    s.tl(this,"o","impresion elemento");
                    // console.log('Cargo');
                    //hoverPromociones();
                //   path = jQuery('<a/>').attr('href',pageUrl)[0].pathname.replace(/^[^\/]/,'/');                
               //    ga('send', 'pageview', path + '?provincia=' + filtro.ciudad + '&categoria='+filtro.categoria);
                }
            });
});