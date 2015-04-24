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
      var id_user = '<?php echo $this->session->userdata('sadmin_user_id') ?>';
      var nombre_promocion = $('#field-PRO_NOMBRE').val();
      var descripcion_promocion = $('#field-PRO_DESCRIPCION').val();
      var precio_inicial_promocion = $('#field-PRO_PRECIO_INICIAL').val();
      var precio_final_promocion = $('#field-PRO_PRECIO_FINAL').val();
      var descuento_promocion = $('#field-PRO_DESCUENTO').val();
      var url_promocion = $('#field-PRO_URL').val();
      var nombre_imagen_promocion_premium = $('.hidden-upload-input').val();
      var tipo_moneda_promocion = $('input[name="PRO_TIPO_MONEDA"]:checked').val();
      //window.open('<?php echo base_url('index.php/main/vista_previa_promociones') ?>/'+nombre_promocion+'/'+descripcion_promocion+'/'+precio_inicial_promocion+'/'+precio_final_promocion+'/'+descuento_promocion+'/'+url_promocion);
      var newWin = window.open();
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url('index.php/vista_previa/vista_previa/vista_previa_promociones') ?>',
        data: {id: id_user, nombre: nombre_promocion, descripcion: descripcion_promocion, precio_inicial: precio_inicial_promocion, precio_final: precio_final_promocion, descuento: descuento_promocion, url: url_promocion, imagen_premium: nombre_imagen_promocion_premium, seccion: 'premium_home', tipo_moneda: tipo_moneda_promocion},
        success: function(data){
          newWin.document.write(data);
          newWin.document.title = 'Vista previa';
        }
      });
    }

    function showMotivoRechazo(id_promo){
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url('index.php/promociones_procesos/get_motivo_rechazo') ?>',
        data: {id_promo: id_promo},
        success: function(data){
          $('#dialog-motivo-rechazo').append('<p class="contenido-motivo-rechazo">'+data+'</p>');
          $('#dialog-motivo-rechazo').dialog();
        }
      });
      $('.contenido-motivo-rechazo').remove();
    }

    
        var field2 = $('select[name="SUB_ID"]');
            //field2.children().remove().end();
            //field2.append('<option value="" ></option>')
            //field2.trigger("liszt:updated"); 

        if($('#field-CAT_ID').val() != ''){
          var sub_id_selected = $('#field-SUB_ID').val();
          $.ajax({
            type: 'POST',
            url: '<?php echo base_url('index.php/tags_subcategorias/get_subcategorias_promociones/index') ?>/'+$('#field-CAT_ID').val(),
            success: function(data){
              obj = JSON.parse(data);
              if(obj){
                field2.removeAttr('disabled');
                field2.children().remove().end();
                field2.append('<option value="" selected></option>');
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
        else{
          field2.children().remove().end();
          field2.append('<option value="" ></option>')
          field2.trigger("liszt:updated");
        }

        $('#field-CAT_ID').on('change', function() {
            $.ajax({
              type: 'POST',
              url: '<?php echo base_url('index.php/tags_subcategorias/get_subcategorias_promociones/index') ?>/'+$('#field-CAT_ID').val(),
              success: function(data){
                obj = JSON.parse(data);
                // Aquí ordeno alfabéticamente las subcategorías.
                var categoriesArray = [];
                for (category in obj) {
                  categoriesArray.push([category, obj[category]]);
                }
                categoriesArray = categoriesArray.sort(function (a, b) {
                  if (a[1] < b[1]) return -1;
                  if (a[1] > b[1]) return 1;
                  return 0;
                });
                if(obj){
                  field2.removeAttr('disabled');
                  field2.children().remove().end();
                  field2.append('<option value="" selected></option>');
                  for (var i=0;i<categoriesArray.length;i++) {
                    field2.append('<option value="' + categoriesArray[i][0] + '" >' + categoriesArray[i][1] + '</option>');
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



});

</script>
<div id="dialog-motivo-rechazo" title="Basic dialog">
 
</div>