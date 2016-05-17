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
    triggerPageThreshold: 10000000, // 10 million? see explanation below
    trigger: 'Cargar más items',
    onPageChange: function(pageNum, pageUrl, scrollOffset) {},
    onLoadItems: function(items) {
      $.each(items, function() {
        id_destacados.push($(this).attr('data-id'));
      });

      if(id_destacados.length > 0) {
        printOferta(id_destacados);
      }

      id_destacados = [];

      var duplicados = new Array();
      $(".destacados ul li").each(function(k,v){
        var idPromo = ($(v).data("id"));
        var impresiones = new Array();

        $(".destacados,.no-destacados ul li").each(function(k1,v1) {
          if(idPromo == ($(v1).data("id"))) {
            impresiones.push(idPromo);
          }
        });

        if(impresiones.length > 1) {
          duplicados.push(idPromo)
        }
      })

      if(duplicados.length > 1){
        console.log("Duplicados: " + duplicados);
      }
    },
    onRenderComplete: function(items) {
      // Make sure new images are lazy loaded too
      $(".lazy-load-image").lazyload({
        effect: 'fadeIn'
      });
    }
  });

  jQuery.ias({
    container : '#contentPromocionesnodestacados',
    item: '.post-no-destacados',
    pagination: '.navigation-no-destacados',
    next: '.next-posts-no-destacados a',
    loader: '<img src="' + base_url_static +'/img/loading.gif"/>',
    triggerPageThreshold: 10000000, // 10 million? see explanation below
    trigger: 'Cargar más items',
    onPageChange: function(pageNum, pageUrl, scrollOffset) {},
    onLoadItems: function(items) {
      $.each(items, function() {
        id_nodestacados.push($(this).attr('data-id'));
      });

      if(id_nodestacados.length > 0) {
        printOferta(id_nodestacados);  
      }
      
      id_nodestacados = [];

      var duplicados = new Array();

      $(".no-destacados ul li").each(function(k,v) {
        var idPromo = ($(v).data("id"));
        var impresiones = new Array();
        $(".destacados,.no-destacados ul li").each(function(k1,v1){
          if(idPromo == ($(v1).data("id")) ){impresiones.push(idPromo);}
        })
        if(impresiones.length > 1){duplicados.push(idPromo)}
      });

      if(duplicados.length > 1) {
        console.log("Duplicados: " + duplicados);
      }
    },
    onRenderComplete: function(items) {
      // Make sure new images are lazy loaded too
      $(".lazy-load-image").lazyload({
        effect: 'fadeIn'
      });
    }
  });
});

/* 10 Million seems hacky... well, it actually is. But it was the easiest way to guarantee that we will never see the "load more" button. */