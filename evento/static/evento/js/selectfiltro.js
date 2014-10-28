$(document).ready(function() {
       $( "#selectTienda" ).change(function() {
            //onChangeFilter(this.value)
            url="/descuentos/"+ base_descuentosfiltro.categoria +'/'+ this.value;
            window.location.href = url;
        });

        $( "#selectMarca" ).change(function() {
            //onChangeFilter(this.value)
            url="/descuentos/"+ base_descuentosfiltro.categoria +'/tiendas/'+this.value;
            window.location.href = url;
        });

        $( "#selectSubCategoria" ).change(function() {
            //onChangeFilter(this.value)
            url="/descuentos/"+ base_descuentosfiltro.categoria +'/tiendas/marcas/'+this.value;
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