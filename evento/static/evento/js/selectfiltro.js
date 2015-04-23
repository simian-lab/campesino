$(document).ready(function() {

        $( "#selectTienda" ).change(function() {
          //onChangeFilter(this.value)
          $.get('http://' + window.location.host + "/marcas/" + this.value, function(data, status){
            $( "#selectMarca" ).empty().append(data);
          });
          if($( "#selectMarca" ).val() != 'marcas'){
            $( "#selectMarca" ).val('marcas');
          }
          if($( "#selectSubCategoria" ).length != 0){
            $( "#selectSubCategoria" ).val('todos');
          }
        });

        $( "#selectMarca" ).change(function() {
          //onChangeFilter(this.value)
          if($( "#selectSubCategoria" ).length != 0){
            $( "#selectSubCategoria" ).val('todos');
          }
        });

        $( "#selectSubCategoria" ).change(function() {
            //onChangeFilter(this.value)
            $( "#selectTienda" ).val('tiendas');
            $( "#selectMarca" ).val('marcas');
            $.get('http://' + window.location.host + "/marcas/tiendas" , function(data, status){
              $( "#selectMarca" ).empty().append(data);
            });
        });

        $( "#buscarOfertaButton").click(function() {
          var tienda = $( "#selectTienda" ).val();
          var marca = $( "#selectMarca" ).val();
          var subCategoria = $( "#selectSubCategoria" ).val();
          var url="/descuentos/"+ base_descuentosfiltro.categoria + '/' + tienda;
          if(tienda=='tiendas' && marca == 'marcas'){
            if(subCategoria != undefined){
              if(subCategoria == 'todos'){
                url = "/descuentos/" + base_descuentosfiltro.categoria;
              }else{
                url = "/descuentos/" + base_descuentosfiltro.categoria + "/"
                + tienda + "/" + marca + "/" + subCategoria;
              }
            }else{
              url = "/descuentos/";
            }
          }else{
            if(subCategoria != undefined){
              if(subCategoria == 'todos'){
                url = "/descuentos/" + base_descuentosfiltro.categoria + "/"
                + tienda + "/" + marca;
              }else{
                url = "/descuentos/" + base_descuentosfiltro.categoria + "/"
                + tienda + "/" + marca + "/" + subCategoria;
              }
            }else{
              if( marca != 'marcas'){
                url = url + '/' + marca;
              }
            }
          }
          onClickBuscar(tienda, marca);
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
