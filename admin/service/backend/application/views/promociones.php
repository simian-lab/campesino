<!--<h4 class="alert_info"><?php //echo $encabezado;?></h4>-->




<!--  -->

<script type="text/javascript">
$(document).ready(function() {
	$('#SOC_CODIGO_input_box').append('<a href="#" class="various fancybox.ajax" onclick="cambiarValorCodSms(); return false;">Generar</a>');
});
function cambiarValorCodSms(){
	//#field-SOC_NOMBRE
	var txt = $("#field-SOC_NOMBRE").val();
	var str = txt.substr(0,5);
	var strf=str.replace(" ","_"); 
	document.getElementById("field-SOC_CODIGO").value = strf.toUpperCase();
}
</script>

<?php if(isset($introduccion)){?>
    <article class="module width_full">
        <div class="module_content">
            <p><?php echo $introduccion;?></p>
        </div>
    </article>
<?php }?>

<article class="module width_full">
    <header><h3><?php echo $titulo;?></h3></header>
	<?php if(isset($search)){?>
	<?php echo form_open(current_url());?>
        <article class="module width_full">
            <div class="module_content">
                <fieldset>
                    
                    <label>Búsqueda</label>
                    <?php echo form_input($search);?>
                <div class="submit_link">
                    <?php echo form_submit('submit', 'Buscar', ' class="alt_btn"');?>
                </div>
                </fieldset>
                </div>
        </article>
	<?php echo form_close();?>
	<?php }?>
    <?php 
	if(isset($output->output))
		echo $output->output;
	else
		echo $output;?>
</article>

<script type="text/javascript">

    function vista_previa(){
        var id_user = $('#field-PRO_USER_CREADOR').val();
        var nombre_promocion = $('#field-PRO_NOMBRE').val();
        var descripcion_promocion = $('#field-PRO_DESCRIPCION').val();
        var precio_inicial_promocion = $('#field-PRO_PRECIO_INICIAL').val();
        var precio_final_promocion = $('#field-PRO_PRECIO_FINAL').val();
        var descuento_promocion = $('#field-PRO_DESCUENTO').val();
        var url_promocion = $('#field-PRO_URL').val();
        var nombre_imagen_promocion_premium = $('input[name="PRO_LOGO_PREMIUM"]').val();
        var nombre_imagen_promocion_general = $('input[name="PRO_LOGO_GENERAL"]').val();
        var tipo_moneda_promocion = $('input[name="PRO_TIPO_MONEDA"]:checked').val();
        if(nombre_imagen_promocion_premium != undefined){
          arrayImagenPromocionPremium = nombre_imagen_promocion_premium.split('/');
          nombre_imagen_promocion_premium = arrayImagenPromocionPremium[arrayImagenPromocionPremium.length - 1];
        }
        if(nombre_imagen_promocion_general != undefined){
          arrayImagenPromocionGeneral = nombre_imagen_promocion_general.split('/');
          nombre_imagen_promocion_general = arrayImagenPromocionGeneral[arrayImagenPromocionGeneral.length - 1];
        }
        if(nombre_imagen_promocion_general != '' && nombre_imagen_promocion_premium != ''){
          var seccion = 'premium';
        }
        else if(nombre_imagen_promocion_premium != ''){
          var seccion = 'premium_home';
        }
        else if(nombre_imagen_promocion_general != ''){
          var seccion = 'general';
        }
        //alert(nombre_imagen_promocion_general)
        //window.open('<?php echo base_url('index.php/main/vista_previa_promociones') ?>/'+nombre_promocion+'/'+descripcion_promocion+'/'+precio_inicial_promocion+'/'+precio_final_promocion+'/'+descuento_promocion+'/'+url_promocion);
        var newWin = window.open();

        $.ajax({
          type: 'POST',
          url: '<?php echo base_url('index.php/vista_previa/vista_previa/vista_previa_promociones') ?>',
          data: {id: id_user, nombre: nombre_promocion, descripcion: descripcion_promocion, precio_inicial: precio_inicial_promocion, precio_final: precio_final_promocion, descuento: descuento_promocion, url: url_promocion, imagen_premium: nombre_imagen_promocion_premium, imagen_general: nombre_imagen_promocion_general, seccion: seccion, tipo_moneda: tipo_moneda_promocion},
          success: function(data){
            newWin.document.write(data);
            newWin.document.title = 'Vista previa';
          }
        });
    }
    
    $('#field-PRO_DESCRIPCION').keypress(function(e){ 
      var cantCaracteres = $(this).val();
      var limit = $('#field-PRO_DESCRIPCION').attr('maxlength');
      if(limit == undefined){
        limit = 1;
      }
      if(cantCaracteres.length > limit){
        $(this).val(cantCaracteres.substring(0,limit));    
      }
    });

    if($('#field-PRO_NOMBRE').val() != '' && $('#field-PRO_DESCRIPCION').val() != ''){
      if($('#field-PRO_SRC_ID').val() == 2){
        //$('#field-PRO_NOMBRE').val('');
        //$('#field-PRO_DESCRIPCION').val('');
        $('#field-PRO_NOMBRE').attr('maxlength', '35');
        $('#field-PRO_DESCRIPCION').attr('maxlength', '68');
        
      }
      else{
        var cantTitulo = $('#field-PRO_NOMBRE').val();
        var cantDesc = $('#field-PRO_DESCRIPCION').val();
        if(cantTitulo.length > 22){
          $('#field-PRO_NOMBRE').val(cantTitulo.substring(0,22));
        }
        if(cantDesc.length > 23){
          $('#field-PRO_DESCRIPCION').val(cantDesc.substring(0,23));
        }
        //$('#field-PRO_DESCRIPCION').val('');
        $('#field-PRO_NOMBRE').attr('maxlength', '22');
        $('#field-PRO_DESCRIPCION').attr('maxlength', '23');
        //$('#field-PRO_DESCRIPCION').attr('onKeyPress', 'return ( this.value.length < 23 );');
      }
    }

    $('#field-PRO_SRC_ID').on('change',function(){
      if($('#field-PRO_SRC_ID').val() == 2){
        //$('#field-PRO_NOMBRE').val('');
        //$('#field-PRO_DESCRIPCION').val('');
        $('#field-PRO_NOMBRE').attr('maxlength', '35');
        $('#field-PRO_DESCRIPCION').attr('maxlength', '68');
        
      }
      else{
        var cantTitulo = $('#field-PRO_NOMBRE').val();
        var cantDesc = $('#field-PRO_DESCRIPCION').val();
        if(cantTitulo.length > 22){
          $('#field-PRO_NOMBRE').val(cantTitulo.substring(0,22));
        }
        if(cantDesc.length > 23){
          $('#field-PRO_DESCRIPCION').val(cantDesc.substring(0,23));
        }
        //$('#field-PRO_DESCRIPCION').val('');
        $('#field-PRO_NOMBRE').attr('maxlength', '22');
        $('#field-PRO_DESCRIPCION').attr('maxlength', '23');
        //$('#field-PRO_DESCRIPCION').attr('onKeyPress', 'return ( this.value.length < 23 );');
      }
    });
  
    
      
        var field2 = $('select[name="SUB_ID"]');
            //field2.children().remove().end();
            //field2.append('<option value="" ></option>')
            //field2.trigger("liszt:updated"); 

        if($('#field-CAT_ID').val() != '' && $('#field-SUB_ID').val() != ''){
          var sub_id_selected = $('#field-SUB_ID').val();
          $.ajax({
            type: 'POST',
            url: '<?php echo base_url('index.php/tags_subcategorias/get_subcategorias_promociones/index') ?>/'+$('#field-CAT_ID').val(),
            success: function(data){
              obj = JSON.parse(data);
              if(obj){
                field2.removeAttr('disabled');
                field2.children().remove().end();
                for (var key in obj) {
                  if (obj.hasOwnProperty(key)) {
                    if(key == sub_id_selected){
                      selected = 'selected';
                    }
                    else{
                      selected = '';
                    }
                    field2.append('<option '+selected+' value="'+key+'">'+obj[key]+'</option>');
                  }
                }
                field2.trigger("liszt:updated");
              } 
            }
          });
        }
        
        $('#field-CAT_ID').on('change', function() {
            $.ajax({
              type: 'POST',
              url: '<?php echo base_url('index.php/tags_subcategorias/get_subcategorias_promociones/index') ?>/'+$('#field-CAT_ID').val(),
              success: function(data){
                obj = JSON.parse(data);
                if(obj){
                  field2.removeAttr('disabled');
                  field2.children().remove().end();
                  field2.append('<option value="" ></option>');
                  for (var key in obj) {
                    if (obj.hasOwnProperty(key)) {
                      field2.append('<option value="'+key+'">'+obj[key]+'</option>');
                    }
                  }
                  field2.trigger("liszt:updated");
                } 
              }
            });
        });
        
     
    
  </script>

  <script>
  // $("#Categoria_input_box").append('<a href="">agregar</a>');
  $(document).ready(function(){

    $('#crudForm').submit(function(){
      return false;
    });


  });
</script>

