$(document).ready(function() {
        
            jQuery.ias({
                container : '#contentPromocionesdestacados',
                item: '.post',
                pagination: '.navigation',
                next: '.next-posts a',
                loader: '<img src="' + base_url_static +'/img/loading.gif"/>',                
                triggerPageThreshold: 30,
                onPageChange: function(pageNum, pageUrl, scrollOffset) {
                    // console.log('Cargo');
                    //hoverPromociones();
                //   path = jQuery('<a/>').attr('href',pageUrl)[0].pathname.replace(/^[^\/]/,'/');                
               //    ga('send', 'pageview', path + '?provincia=' + filtro.ciudad + '&categoria='+filtro.categoria);
                }
            });
             jQuery.ias({
                container : '#contentPromocionesnodestacados',
                item: '.post-no-destacados',
                pagination: '.navigation-no-destacados',
                next: '.next-posts-no-destacados a',
                loader: '<img src="' + base_url_static +'/img/loading.gif"/>',                
                triggerPageThreshold: 30,
                onPageChange: function(pageNum, pageUrl, scrollOffset) {
                    // console.log('Cargo');
                    //hoverPromociones();
                //   path = jQuery('<a/>').attr('href',pageUrl)[0].pathname.replace(/^[^\/]/,'/');                
               //    ga('send', 'pageview', path + '?provincia=' + filtro.ciudad + '&categoria='+filtro.categoria);
                }
            });
});