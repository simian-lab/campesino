$(document).ready(function() {
       $( "#selectTienda" ).change(function() {
            url="/descuentos/"+ base_descuentosfiltro.categoria +'/'+ this.value;
            window.location.href = url;

            //$categoria='todos',$tienda='todos',$marca='todos',$subcategoria='todos'
        });

        $( "#selectMarca" ).change(function() {
     //       url="/descuentos/"+ base_descuentosfiltro.categoria +'/'+ base_descuentosfiltro.tienda+'/'+this.value;
            url="/descuentos/"+ base_descuentosfiltro.categoria +'/todos/'+this.value;
            window.location.href = url;
        });

        $( "#selectSubCategoria" ).change(function() {
          //  url="/descuentos/"+ base_descuentosfiltro.categoria +'/'+ base_descuentosfiltro.tienda+'/'+base_descuentosfiltro.marca+'/'+this.value;
            url="/descuentos/"+ base_descuentosfiltro.categoria +'/todos/todos/'+this.value;
            window.location.href = url;
        });
/*

        console.log(base_descuentosfiltro);

        console.log(base_descuentosfiltro.categoria);
        */

      $('#selectTienda option[value="todos"]').removeAttr('selected');
      $('#selectMarca option[value="todos"]').removeAttr('selected');
      $('#selectSubCategoria option[value="todos"]').removeAttr('selected');


      $('#selectTienda').find('option').each( function() {
          //var $this = $(this);             
          if ($(this).val() == base_descuentosfiltro.tienda) {
                 $(this).attr('selected','selected');
                 return false;
          }
       });

      $('#selectMarca').find('option').each( function() {
          //var $this = $(this);
          if ($(this).val() == base_descuentosfiltro.marca) {
                 $(this).attr('selected','selected');
                 return false;
          }
       });

      $('#selectSubCategoria').find('option').each( function() {
          //var $this = $(this);
          if ($(this).val() == base_descuentosfiltro.subcategoria) {
                 $(this).attr('selected','selected');
                 return false;
          }
       });

      //alert($('#selectTienda').find(':selected').text())
});