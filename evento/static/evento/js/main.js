function getScrollOffsets() {
  if ( window.pageXOffset != null ) {
    return {
      x: window.pageXOffset,
      y: window.pageYOffset
    };
  }

  var doc = window.document;

  if ( document.compatMode === "CSS1Compat" ) {
    return {
      x: doc.documentElement.scrollLeft,
      y: doc.documentElement.scrollTop
    };
  }

  return {
    x: doc.body.scrollLeft,
    y: doc.body.scrollTop
  };
}


$(function() {
  setTimeout(function() {
    var sliderPubli = $("#slide-publi").owlCarousel({
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items : 3,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3],
      itemsMobile : [768,1],
    });

    $(".next").click(function(event){
      event.preventDefault();
      sliderPubli.trigger('owl.next');
    });

    $(".prev").click(function(event){
      event.preventDefault();
      sliderPubli.trigger('owl.prev');
    });
  }, 1000);


  owlMarcas = $('#slider-marcas-content').owlCarousel({
    autoPlay: true,
    items : 6,
    itemsMobile: [479,3],
    itemsTablet: [992,4]
  });

  $('.next-marcas').click(function() {
    owlMarcas.trigger('owl.next');
  });

  $('.prev-marcas').click(function() {
    owlMarcas.trigger('owl.prev');
  });

  owlMarcasAside = $('#slide-marcas').owlCarousel({
    singleItem:true,
    itemsDesktop: [1200,6],
    itemsTablet: [992,5]
  });

  $('#next-marcas-aside').click(function(event) {
    event.preventDefault();
    owlMarcasAside.trigger('owl.next');
  });

  $('#prev-marcas-aside').click(function(event) {
    event.preventDefault();
    owlMarcasAside.trigger('owl.prev');
  });

  $(window).scroll(function(event) {
    var getScrollY = getScrollOffsets();
    var scrollY = getScrollY.y;
    var resta = (window.innerHeight+window.outerHeight)-scrollY;

    if(scrollY > 71) {
      $('#menu').css({
        position: 'fixed',
        top: 0,
        'z-index': 99,
        width: '100%',
        opacity: 0.9
      });
      $('.wrapper-filter').css({
        position: 'fixed',
        left: '0px',
        margin: '36px 0px 0px 0px',
        'z-index': 99
      });
      $('.wrapper-filter .filter').css({
        position: 'relative',
        width: '980px',
        float: 'none'
      });


    }
    else {
      $('#menu').css({
        position: 'relative'
      });
      $('.wrapper-filter').css({
        position: 'relative'
      });
      $('.wrapper-filter .filter').css({
        position: 'relative'
      });
    }
  });
});