$(document).ready(function() {
       $( "#selectTienda" ).change(function() {
            s.eVar25 = this.value;
            s.events="event11";

            url="/descuentos/"+ base_descuentosfiltro.categoria +'/'+ this.value;
            window.location.href = url;

            //$categoria='todos',$tienda='todos',$marca='todos',$subcategoria='todos'
        });

        $( "#selectMarca" ).change(function() {
            s.eVar26 = this.value;
            s.events="event11";

     //       url="/descuentos/"+ base_descuentosfiltro.categoria +'/'+ base_descuentosfiltro.tienda+'/'+this.value;
            url="/descuentos/"+ base_descuentosfiltro.categoria +'/tiendas/'+this.value;
            window.location.href = url;
        });

        $( "#selectSubCategoria" ).change(function() {
            s.eVar29 = this.value;
            s.events="event11";

          //  url="/descuentos/"+ base_descuentosfiltro.categoria +'/'+ base_descuentosfiltro.tienda+'/'+base_descuentosfiltro.marca+'/'+this.value;
            url="/descuentos/"+ base_descuentosfiltro.categoria +'/tiendas/marcas/'+this.value;
            window.location.href = url;
        });
/*

        console.log(base_descuentosfiltro);

        console.log(base_descuentosfiltro.categoria);
        */
//alert($('#selectTienda option[value="tiendas"]'))
      /*$('#selectTienda option[value="tiendas"]').removeAttr('selected');
      $('#selectMarca option[value="marcas"]').removeAttr('selected');
      $('#selectSubCategoria option[value="todos"]').removeAttr('selected');*/
     /* $("#selectTienda")[0].selectedIndex = 0;
      $("#selectMarca")[0].selectedIndex = -1;
      $("#selectSubCategoria")[0].selectedIndex = -1;*/
     // $('#selectTienda option[value="tiendas"]').prop('selected',false);

      var contadorTienda = 0;
      var contadorMarca = 0;
      var contadorSubcategoria = 0;
      $('#selectTienda').find('option').each( function() {//alert(contador)
          //var $this = $(this);             
          
          if ($(this).val() == base_descuentosfiltro.tienda) {//alert($(this).val());
                 //$(this).attr('selected','selected');
                 $("#selectTienda")[0].selectedIndex = contadorTienda;
                 //$(this).prop('selected',true);
                 return false;
          }
          contadorTienda++;
       });

      $('#selectMarca').find('option').each( function() {
          //var $this = $(this);
          if ($(this).val() == base_descuentosfiltro.marca) {
                 //$(this).attr('selected','selected');
                 $("#selectMarca")[0].selectedIndex = contadorMarca;
                 return false;
          }
          contadorMarca++;
       });

      $('#selectSubCategoria').find('option').each( function() {
          //var $this = $(this);
          if ($(this).val() == base_descuentosfiltro.subcategoria) {
                 //$(this).attr('selected','selected');
                 $("#selectSubCategoria")[0].selectedIndex = contadorSubcategoria;
                 return false;
          }
          contadorSubcategoria++;
       });


      //alert($('#selectTienda').find(':selected').text())
});