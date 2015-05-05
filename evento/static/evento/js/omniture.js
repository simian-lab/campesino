function onClickPublicidad(nombre, posicion){
	s.linkTrackVars = "events,eVar27,eVar30";
	s.linkTrackEvents = "event20";
	s.events = "event20";
	s.eVar27 = nombre;
	s.eVar30 = posicion;
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

function onChangeFilter(valor){
	s.linkTrackVars = "events,eVar25";
	s.linkTrackEvents = "event11";
	s.events = "event11";
	s.eVar25 = valor;
	s.tl(true,"o","Filtro");
}

function onClickBuscar(tienda, marca, subcategoria){
	s.linkTrackVars="events,eVar24,eVar25";
	s.linkTrackEvents="event11";
	s.events="event11";

	if(marca == "marcas") {
		marca = "Todas";
	}

	if(tienda == "tiendas") {
		tienda = "Todas";
	}

	s.eVar25 = tienda;
	s.eVar24 = marca;
	
	if(subcategoria != undefined) {
		s.linkTrackVars="events,eVar24,eVar25,eVar28";
		s.eVar28 = subcategoria;
	}

	s.tl(true, "o", "filtro");
}

function onClickOferta(id, posicion, tienda){
	s.linkTrackVars = "events,eVar38,eVar39,products";
	s.linkTrackEvents = "event36";
	s.events = "event36";
	s.eVar38 = posicion;
	s.eVar39 = tienda;
	s.products = ";"+id;
	s.tl(true,"o","Click en Oferta");
}

function onClickPatrocinador(id, posicion) {
  s.linkTrackVars="events,eVar38,eVar39";
  s.linkTrackEvents="event37";
  s.events="event37";
  s.eVar38=posicion;
  s.eVar39=id;
  s.tl(true,"o","Click en Comercio");
}

function onClickOfertasDestacadas() {
  s.linkTrackVars = "events,eVar18";
  s.linkTrackEvents = "event14";
  s.events = "event14";
  s.eVar18 = "botón ofertas destacadas";
  s.tl(true, "o", "uso de botón");
}

function onClickTodasLasTiendas() {
	s.linkTrackVars = "events,eVar18";
	s.linkTrackEvents = "event14";
	s.events = "event14";
	s.eVar18 = "tab todas las tiendas";
	s.tl(true, "o", "uso de tab");
}

function onClickBotonTodasLasOfertas() {
	s.linkTrackVars = "events,eVar18";
	s.linkTrackEvents = "event14"; 
	s.events = "event14";
	s.eVar18 = "boton todas las ofertas";
	s.tl(true, "o", "uso de boton");
}

function onClickTabTodasLasOfertas() {
	s.linkTrackVars = "events,eVar18";
	s.linkTrackEvents = "event14";
	s.events = "event14";
	s.eVar18 = "tab todas las ofertas";
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
	s.linkTrackEvents = "event41";
	s.events = "event41";
	s.products = '';

	for(var i = 0; i < array_id.length; i++) {
		if(array_id[i] != undefined) {
			s.products += ";" + array_id[i];
			if(i < array_id.length - 1){
				s.products += ",";
			}
		}
	}

	s.tl(true, "o", "Impresión Oferta");
}

function printPatrocinador(array_id) {
	s.linkTrackVars = "events,list1";
	s.linkTrackEvents = "event42";
	s.events = "event42";
	s.list1 = '';

	for(var i = 0; i < array_id.length; i++) {
		if(array_id[i] != undefined) {
			if(i > 0) {
				s.list1 += ";" + array_id[i];
			} else {
				s.list1 += array_id[i];
			}
		}
	}

	s.tl(true,"o","Impresión Retail");
}
