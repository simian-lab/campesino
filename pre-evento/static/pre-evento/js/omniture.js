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

function onClickRegistro(email){
	s.linkTrackVars = "events,eVar12";
	s.linkTrackEvents = "event5";
	s.events = "event5";
	s.eVar12 = email;
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

function onClickPauta(nombre){
	s.linkTrackVars = "events,products";
	s.linkTrackEvents = "event41";
	s.events = "event41";
	s.products = ";"+nombre;
	s.tl(true,"o","Pauta"); 
}

function onClickComercio(id, posicion) {
	s.linkTrackVars = "events,eVar38,eVar39";
	s.linkTrackEvents = "event37";
	s.events = "event37";
	s.eVar39 = id;
	s.eVar38 = "Posicion " + posicion;
	s.tl(true,"o","clic en comercio");
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
