<script src="<?php echo $base_url_static;?>js/bootstrap/bootstrap.js"></script>
<script src="<?php echo $base_url_static;?>js/vendor/owl.carousel.js"></script>

<!-- js temporal de dynamik -->
<script src="http://dynamikdemos.a2hosted.com/clients/eltiempo/cyberlunes/temp.js"></script>

<script src="<?php echo $base_url_static;?>js/selectfiltro.js"></script>
<script src="<?php echo $base_url_static;?>js/share.js"></script>
<script src="<?php echo $base_url_static;?>js/jquery.lazyload.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){

    var id_destacados = [];
    var id_nodestacados = [];

    $.each($('#contentPromocionesdestacados').find('li.post'), function(){
      id_destacados.push($(this).attr('data-id'));
    });

    if(id_destacados.length > 0) {
      printOferta(id_destacados);
    }

    $.each($('#contentPromocionesnodestacados').find('li'), function(){
      var id_dest = $(this).attr('data-id');
      if(id_dest != undefined)
        id_nodestacados.push(id_dest);
    });

    if(id_nodestacados.length > 0) {
      printOferta(id_nodestacados);
    }

    var filtro = '<?php echo $this->uri->segment(2) ?>';
    if(filtro != ''){
      onChangeFilter(filtro);
    }

    // I put this here because it makes more sense to group the
    // Omniture functionality here. However, let me state that this
    // feels disorganised as hell.
    //
    // Convention trumps everything, though, so let's breathe and let
    // this be.
    //
    // Ivan (ivan@simian.co) – Apr 14, 2015

    var id_patrocinadores = [];

    $.each($('.content-patrocinadores-destacados .box'), function(){
      id_patrocinadores.push($(this).attr('data-id'));
    });

    if(id_patrocinadores.length > 0) {
      printPatrocinador(id_patrocinadores);
    }

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
      console.log("Duplicados: " + duplicados);
    }

    // Lazy load images
    $(".lazy-load-image").lazyload({
      effect: 'fadeIn'
    });
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