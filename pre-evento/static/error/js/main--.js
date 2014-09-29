$(function() {		
	if(window.innerWidth>768) {
		var li = $('.collapse').children('ul.nav').find('li');
		li.on('mouseover', function() {
			var linea = $(this).children('.hover');
			var lineaColor = $('<div></div>').addClass('row linea-color');

			var azul = $('<div></div>').addClass('col-md-3 col-sm-3 col-xs-3 azul').appendTo(lineaColor);
			var amarillo = $('<div></div>').addClass('col-md-3 col-sm-3 col-xs-3 amarillo').appendTo(lineaColor);
			var naranja = $('<div></div>').addClass('col-md-3 col-sm-3 col-xs-3 naranja').appendTo(lineaColor);
			var marron = $('<div></div>').addClass('col-md-3 col-sm-3 col-xs-3 marron').appendTo(lineaColor);
			
			linea.append(lineaColor);
			linea.show();
		}).on('mouseout', function() {
			var linea = $(this).children('.hover');			
			linea.empty();
			linea.hide();
		});
	}	
});
