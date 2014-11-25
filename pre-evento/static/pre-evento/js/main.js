$(function() {	
	$('.banner').hover(function() {
		$(this).children('a:first-child').stop().animate({
			width: 93
		});
		$(this).children('a:first-child + a').stop().animate({
			width: 207
		});
	}).mouseout(function() {
		$(this).children('a:first-child').stop().animate({
			width: 0
		});
		$(this).children('a:first-child + a').stop().animate({
			width: 49
		});
	})
	if($(window).width()<1024) {		
		$('#form-collapse').find('header').click(function() {			
			$('#form-collapse').children('section').stop().slideToggle('slow');
		});
	} 		
	setTimeout(function() {
		$('#slider-marcas').show();
	}, 2000);

	if($(window).width()<1024) {
		setTimeout(function() {
			$('#formulario').find('#slider-marcas').show();
		}, 2000);
		setTimeout(function() {
			$('#formulario').find('#slider-marcas-form').show();
		}, 2000);
		setTimeout(function(){
			var slider_mobile = $('#formulario').find('.slider-marcas').bxSlider({
			  minSlides: 3,
			  maxSlides: 6,
			  slideWidth: 170,
			  slideMargin: 10,
			  auto: true
			});		
			$('.bx-next, .bx-prev').click(function(){
				slider_mobile.stopAuto();
	            slider_mobile.startAuto();
			});
		},2001);
			
	} 
 	$('input, textarea').placeholder(); 	
 	//$('#agradecimiento').modal();
 	$('#registrate').modal({
 		keyboard: false,      // Allows the user to close the modal by pressing `ESC`
  		backdrop: 'static'
 	});
	owl = $("#slider-principal").owlCarousel({
		autoPlay: true,
		pagintation: true,
		paginationNumbers: true,
		paginationSpeed : 400,    
		slideSpeed : 300,
		singleItem:true,
		transitionStyle : "fadeUp",
		afterInit: function(){
			img = $('.owl-item').eq(this.currentItem).find('img').attr('alt');
			onClickPauta(img);
        },
		afterMove : function(){
			img = $('.owl-item').eq(this.currentItem).find('img').attr('alt');
			onClickPauta(img);
        }
	});
	$(".next").click(function(){
		owl.trigger('owl.next');
	});
	$(".prev").click(function(){
		owl.trigger('owl.prev');
	});
	/*owlMarcas = $('#slider-marcas-content').owlCarousel({
		autoPlay: true,
		items : 6,
		rewindNav: true,
      	itemsDesktop : [1000,5], //5 items between 1000px and 901px
      	itemsDesktopSmall : [900,3], // betweem 900px and 601px
      	itemsTablet: [600,2], //2 items between 600 and 0
      	itemsMobile : false      	
	});*/	
	setTimeout(function() {
		var slider_home = $('.slider-marcas').bxSlider({
		  minSlides: 3,
		  maxSlides: 6,
		  slideWidth: 170,
		  slideMargin: 10,
		  auto: true
		});	
		$('.bx-next, .bx-prev').click(function(){
			slider_home.stopAuto();
            slider_home.startAuto();
		});			
	},2001);

	owlMarcas = $('#slide-marcas').owlCarousel({
		autoPlay: true,
		items : 1,
		rewindNav: true,
      	itemsDesktop : [1000,5], //5 items between 1000px and 901px
      	itemsDesktopSmall : [900,3], // betweem 900px and 601px
      	itemsTablet: [600,2], //2 items between 600 and 0
      	itemsMobile : false      	
	});
	$('.next-marcas').click(function() {
		owlMarcas.trigger('owl.next');
	});
	$('.prev-marcas').click(function() {
		owlMarcas.trigger('owl.prev');
	});	
	/*$('.next-marcas').click(function() {
		owlMarcas.trigger('owl.next');
	});
	$('.prev-marcas').click(function() {
		owlMarcas.trigger('owl.prev');
	});	

	owlMarcasAside = $('#slide-marcas').owlCarousel({
		autoPlay: true,	
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
	});	*/
	/*var slider_form = $('#slide-marcas').bxSlider({
	  minSlides: 3,
	  maxSlides: 3,
	  slideWidth: 170,
	  slideMargin: 10,
	  auto: true,
	  mode: 'vertical'
	});	
	$('.bx-next, .bx-prev').click(function(){
		slider_form.stopAuto();
        slider_form.startAuto();
	});	*/
	$('#interes-mobile').multiselect({
		numberDisplayed: 1,
		nSelectedText: 'Items',		
		buttonText: function(options) {
	        if (options.length == 0) {
	        	return 'Intereses <b class="caret"></b>';	        	        
	        } else if (options.length == 1) {
	        	var selected = '';
		        options.each(function() {
		            selected += $(this).text() + ', ';
		        });
		        return selected.substr(0, selected.length -2) + ' <b class="caret"></b>';
	        } else {
	          	var selected = '';
	          	options.each(function() {
	            	selected += $(this).text() + ', ';
	          	});
	          	return options.length + ' Items <b class="caret"></b>';
	        }
	    }
	});
	$('#interes-modal').multiselect({
		numberDisplayed: 1,
		nSelectedText: 'Items',
		buttonText: function(options) {
	        if (options.length == 0) {
	        	return 'Intereses  <b class="caret"></b>';	        	        
	        } else if (options.length == 1) {
	        	var selected = '';
		        options.each(function() {
		            selected += $(this).text() + ', ';
		        });
		        return selected.substr(0, selected.length -2) + ' <b class="caret"></b>';
	        } else {
	          	var selected = '';
	          	options.each(function() {
	            	selected += $(this).text() + ', ';
	          	});
	          	return options.length + ' Items <b class="caret"></b>';
	        }
	    }
	})
	$('#interes').multiselect({
		numberDisplayed: 1,
		nSelectedText: 'Items',
		buttonText: function(options) {
	        if (options.length == 0) {
	        	return 'Intereses  <b class="caret"></b>';	        	        
	        } else if (options.length == 1) {
	        	var selected = '';
		        options.each(function() {
		            selected += $(this).text() + ', ';
		        });
		        return selected.substr(0, selected.length -2) + ' <b class="caret"></b>';
	        } else {
	          	var selected = '';
	          	options.each(function() {
	            	selected += $(this).text() + ', ';
	          	});
	          	return options.length + ' Items <b class="caret"></b>';
	        }
	    }
	});
});
