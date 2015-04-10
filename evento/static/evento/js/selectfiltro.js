$(document).ready(function() {

        $( "#selectSubCategoria" ).change(function() {
            //onChangeFilter(this.value)
            url="/descuentos/"+ base_descuentosfiltro.categoria +'/tiendas/marcas/'+this.value;
            window.location.href = url;
        });

        $( "#buscarOfertaButton").click(function() {
          var tienda = 'tiendas';
          if( $( "#selectTienda" ).val() != ''){
            tienda = $( "#selectTienda" ).val();
          }
          var url="/descuentos/"+ base_descuentosfiltro.categoria + '/' + tienda;
          if( $( "#selectMarca" ).val() != 'marcas'){
            url = url + '/' + $( "#selectMarca" ).val();
          }
          window.location.href = url;
        });


      var contadorTienda = 0;
      var contadorMarca = 0;
      var contadorSubcategoria = 0;
      $('#selectTienda').find('option').each( function() {

          if ($(this).val() == base_descuentosfiltro.tienda) {
                 $("#selectTienda")[0].selectedIndex = contadorTienda;
                 return false;
          }
          contadorTienda++;
       });

      $('#selectMarca').find('option').each( function() {
          if ($(this).val() == base_descuentosfiltro.marca) {
                 $("#selectMarca")[0].selectedIndex = contadorMarca;
                 return false;
          }
          contadorMarca++;
       });

      $('#selectSubCategoria').find('option').each( function() {
          if ($(this).val() == base_descuentosfiltro.subcategoria) {
                 $("#selectSubCategoria")[0].selectedIndex = contadorSubcategoria;
                 return false;
          }
          contadorSubcategoria++;
       });

});
