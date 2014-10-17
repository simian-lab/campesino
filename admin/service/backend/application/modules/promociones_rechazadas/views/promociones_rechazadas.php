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

<style>
  .rechazar-promocion.crud-action > img{
    width: 47px;
  }
  .aceptar-promocion.crud-action > img{
    width: 47px;
  }
  .aceptar-promocion.crud-action{
    margin: 0;
    padding: 0;
    float: left;
  }
  .rechazar-promocion.crud-action{
    margin: 0;
    padding: 0;
    float: left;
  }
</style>

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
      var id_user = $('#ID_USER_CREADOR_input_box').text();
      var nombre_promocion = $('#field-PRO_NOMBRE').text();
      var descripcion_promocion = $('#field-PRO_DESCRIPCION').text();
      var precio_inicial_promocion = $('#field-PRO_PRECIO_INICIAL').text();
      var precio_final_promocion = $('#field-PRO_PRECIO_FINAL').text();
      var descuento_promocion = $('#field-PRO_DESCUENTO').text();
      var url_promocion = $('#field-PRO_URL').text();
      var nombre_imagen_promocion_premium = $('#field-PRO_LOGO_PREMIUM').attr('src');
      var nombre_imagen_promocion_general = $('#field-PRO_LOGO_GENERAL').attr('src');
      if(nombre_imagen_promocion_premium != undefined){
        arrayImagenPromocionPremium = nombre_imagen_promocion_premium.split('/');
        nombre_imagen_promocion_premium = arrayImagenPromocionPremium[arrayImagenPromocionPremium.length - 1];
      }
      if(nombre_imagen_promocion_general != undefined){
        arrayImagenPromocionGeneral = nombre_imagen_promocion_general.split('/');
        nombre_imagen_promocion_general = arrayImagenPromocionGeneral[arrayImagenPromocionGeneral.length - 1];
      }
      var tipo_moneda_promocion = $('input[name="PRO_TIPO_MONEDA"]:checked').val();

      if(nombre_imagen_promocion_general != undefined && nombre_imagen_promocion_premium != undefined){
        var seccion = 'premium';
      }
      else if(nombre_imagen_promocion_premium != undefined){
        var seccion = 'premium_home';
      }
      else if(nombre_imagen_promocion_general != undefined){
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

    function rechazarPromocion(id_promocion){
      var motivo_rechazo = prompt('Motivo de rechazo');
      if(motivo_rechazo != null && motivo_rechazo != ''){
        var rechazar_promocion = confirm('¿Esta seguro que desea rechazar esta promoción?');
        if(rechazar_promocion == true){
          $.ajax({
            type: 'POST',
            url: '<?php echo base_url('index.php/promociones_procesos/rechazar_promocion') ?>',
            data: {id_promocion: id_promocion, motivo: motivo_rechazo, user_autorizador: '<?php echo $this->session->userdata('sadmin_user_id') ?>'},
            success: function(data){
               location.reload(); 
            }
          });
        }
      }
      if(motivo_rechazo == ''){
        alert('Debe ingresar un motivo para rechazar la promoción');
      }
    }

    function aceptarPromocion(id_promocion){
      var aceptar_promocion = confirm('¿Esta seguro que desea aceptar esta promoción?');
      if(aceptar_promocion == true){
        $.ajax({
          type: 'POST',
          url: '<?php echo base_url('index.php/promociones_procesos/aceptar_promocion') ?>',
          data: {id_promocion: id_promocion, user_autorizador: '<?php echo $this->session->userdata('sadmin_user_id') ?>'},
          success: function(data){
             location.reload(); 
          }
        });
      }
    }
    
    function showMotivoRechazo(id_promo){
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url('index.php/promociones_procesos/get_motivo_rechazo') ?>',
        data: {id_promo: id_promo},
        success: function(data){//alert(data)
          $('#dialog-motivo-rechazo').append('<p class="contenido-motivo-rechazo">'+data+'</p>');
          $('#dialog-motivo-rechazo').dialog();
        }
      });
      $('.contenido-motivo-rechazo').remove();
    }

    
  </script>

  <script>
  // $("#Categoria_input_box").append('<a href="">agregar</a>');
  $(document).ready(function(){

    $('#crudForm').submit(function(){
      return false;
    });

  });

  </script>

<div id="dialog-motivo-rechazo" title="Basic dialog">
 
</div>