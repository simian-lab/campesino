function onClickPublicidad(nombre, posicion){
	s.linkTrackVars = "events,eVar18,eVar19";
	s.linkTrackEvents = "event16";
	s.events = "event16";
	s.eVar18 = posicion;
	s.eVar19 = nombre;
	s.tl(true,"o","Click publicidad");
}

function onClickCarrousel(nombre, posicion){
	s.linkTrackVars = "events,eVar18,eVar19";
	s.linkTrackEvents = "event12";
	s.events = "event12";
	s.eVar19 = nombre;
	s.eVar18 = posicion;
	s.tl(true,"o","Click carrousel");
}

function onClickRegistro(nombre, posicion){
	s.linkTrackVars = "events,eVar16,eVar34";
	s.linkTrackEvents = "event5";
	s.events = "event5";
	s.eVar16 = nombre;
	s.eVar34 = posicion;
	s.tl(true,"o","Registro");
}

function onClickCerrarLightbox(nombre){
	s.linkTrackVars = "events,eVar16";
	s.linkTrackEvents = "event17";
	s.events = "event17";
	s.eVar16 = nombre;
	s.tl(true,"o","Cerrar lightbox");
}

function onClickSocialMedia(canal){
	s.linkTrackVars = "events,eVar13";
	s.linkTrackEvents = "event22";
	s.events = "event22";
	s.eVar13 = canal;
	s.tl(true,"o","Click Redes Sociales");
}

function onClickArticulo(nombre, posicion){
	s.linkTrackVars = "events,eVar17,eVar18";
	s.linkTrackEvents = "event15";
	s.events = "event15";
	s.eVar17 = nombre;
	s.eVar18 = posicion;
	s.tl(true,"o","Click Articulo");
}

function onClickShare(canal, nombre){
	s.linkTrackVars = "events,eVar13";
	s.linkTrackEvents = "event6";
	s.events = "event6";
	s.eVar13 = canal;
	s.tl(true,"o","Compartir");
}

function onSubmitFormulario(nombre){
	s.linkTrackVars = "events,eVar16";
	s.linkTrackEvents = "event21";
	s.events = "event21";
	s.eVar16 = nombre;
	s.tl(true,"o","Formulario");
}

/*function onChangeFilter(valor){
	s.linkTrackVars = "events,eVar25";
	s.linkTrackEvents = "event11";
	s.events = "event11";
	s.eVar25 = valor;
	s.tl(true,"o","Filtro");
}*/

function onClickBuscar(tienda, marca, subcategoria){
	if(marca == "marcas") {
		marca = "Todas";
	}
	
	if(tienda == "tiendas") {
		tienda = "Todas";
	}
	
	s.linkTrackVars="events,eVar24,eVar25";
	s.linkTrackEvents="event11";
	s.events="event11";
	s.eVar25 = tienda;
	s.eVar24 = marca;
	
	if(subcategoria != undefined) {
		s.linkTrackVars="events,eVar24,eVar25,eVar28";
		if(subcategoria == 'todos') {
			subcategoria = 'Todas';
		}
		s.eVar28 = subcategoria;
	}

	s.tl(true, "o", "filtro");
}

function onClickOferta(id, posicion, tienda, evento, paquete){
	s.linkTrackVars = "events,eVar80,eVar81,eVar82,eVar83,eVar84,eVar85,products";
	s.linkTrackEvents = "event36";
	s.events = "event36";
	s.eVar80 = 'evento';
	s.eVar81 = 'hover';
	s.eVar82 = posicion;
	s.eVar83 = "ofeloe-"+tienda;
	s.eVar84 = 'evento-'+evento;
	s.eVar85 = paquete;
	s.products = ";ofenav-"+id;
	s.tl(true,"o","Click en Oferta");
	
	// pixel de google
	/*dataLayer.push({
		'event' : 'event.clicOfertas',
		'clicOfertas' : true
	});*/
}

function onClickPatrocinador(id, posicion, evento, paquete) {
  s.linkTrackVars="events,eVar82,eVar83,eVar84,eVar85";
  s.linkTrackEvents="event38";
  s.events="event38";
  s.eVar82=posicion;
  s.eVar83="ofeloe-"+id;
  s.eVar84="evento-"+evento;
  s.eVar85=paquete;
  s.tl(true,"o","Click en Comercio");
  // pixel de google
	/*dataLayer.push({
		'event' : 'event.clicOfertas',
		'clicOfertas' : true
	});*/
}

function onClickOfertasDestacadas() {
  s.linkTrackVars = "events,eVar30";
  s.linkTrackEvents = "event14";
  s.events = "event14";
  s.eVar30 = "botón ofertas destacadas";
  s.tl(true, "o", "uso de botón");
}

function onClickTodasLasTiendas() {
	s.linkTrackVars = "events,eVar30";
	s.linkTrackEvents = "event14";
	s.events = "event14";
	s.eVar30 = "tab todas las tiendas";
	s.tl(true, "o", "uso de tab");
}

function onClickBotonTodasLasOfertas() {
	s.linkTrackVars = "events,eVar30";
	s.linkTrackEvents = "event14"; 
	s.events = "event14";
	s.eVar30 = "boton todas las ofertas";
	s.tl(true, "o", "uso de boton");
}

function onClickTabTodasLasOfertas() {
	s.linkTrackVars = "events,eVar30";
	s.linkTrackEvents = "event14";
	s.events = "event14";
	s.eVar30 = "tab todas las ofertas";
	s.tl(true, "o", "uso de tab");
}

function onClickFacebook() {
	s.linkTrackVars = "events,eVar13";
	s.linkTrackEvents = "event6";
	s.events = "event6";
	s.eVar13 = "Facebook";
	s.tl(true, "o", "redes sociales");
}

function onClickTwitter() {
	s.linkTrackVars = "events,eVar13";
	s.linkTrackEvents = "event6";
	s.events = "event6";
	s.eVar13 = "Twitter";
	s.tl(true, "o", "redes sociales");
}

function printOferta(array_id){
	s.linkTrackVars = "events,products";
	s.linkTrackEvents = "event37";
	s.events = "event37";
	s.products = '';

	for(var i = 0; i < array_id.length; i++) {
		if(array_id[i] != undefined) {
			s.products += ";ofenav-" + array_id[i];
			if(i < array_id.length - 1){
				s.products += ",";
			}
		}
	}

	s.tl(true, "o", "Impresión Oferta");
}

function printPatrocinador(array_id) {
	s.linkTrackVars = "events,list1";
	s.linkTrackEvents = "event40";
	s.events = "event40";
	s.list1 = '';

	for(var i = 0; i < array_id.length; i++) {
		if(array_id[i] != undefined) {
			if(i > 0) {
				s.list1 += ";ofeloe-" + array_id[i];
			} else {
				s.list1 += "ofeloe-" +array_id[i];
			}
		}
	}

	s.tl(true,"o","Impresión Retail");
}

function clickHeader(valor){
	s.linkTrackVars = 'events,eVar86';
	s.linkTrackEvents = 'event80';
	s.events = 'event80';
	s.eVar86 = valor;
	s.tl(true, 'o', 'clic header');
}

function clickMenu(valor){
	s.linkTrackVars = 'events,eVar17';
	s.linkTrackEvents = 'event12';
	s.events = 'event12';
	s.eVar17 = valor;
	s.tl(true, 'o', 'clic menu');
}