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
    (function($) {
      $(document).ready(function() {
        var field2 = $('select[name="SUB_ID"]');
            field2.children().remove().end();
            field2.append('<option value="Value1">Value1</option>')
            field2.trigger("liszt:updated");    
            
        $('#field-CAT_ID').on('change', function() {
            $.ajax({
              type: 'POST',
              url: '../get_subcategorias_promociones_premium',
              success: function(data){
                //alert(data)
              }
            });
            if( (document.getElementById('field-CAT_ID').value)==1 )
            {
                field2.removeAttr('disabled');
                field2.children().remove().end();
                field2.append('<option value="Value1">Value1</option>')
                field2.append('<option value="Value2">Value2</option>')
                field2.append('<option value="Value3">Value3</option>')
                field2.trigger("liszt:updated");
            }else{
                field2.children().remove().end();
                field2.append('<option value="Value1">Value1</option>')
                field2.trigger("liszt:updated");        
            };
        });
        
      });
    })(jQuery);
  </script>

<script>
// $("#Categoria_input_box").append('<a href="">agregar</a>');
$(document).ready(function(){


// $(".form-div").append("<div class='form-field-box odd'><div id='label' class='form-display-as-box'>Vista previa</div> <div id='vista-previa' class='form-input-box'><a href='javascript:;' id='open'>Vista previa</a></div> </div> ");
$("#PRO_DESCUENTO_field_box").append("<div class='form-field-box odd'><div id='label' class='form-display-as-box'>Vista previa</div> <div id='vista-previa' class='form-input-box' style='margin-top:5px'><a href='javascript:;' id='open'>Vista previa</a></div> </div> ");
// $("#PRO_URL_field_box").append("<a href='javascript:;' id='open'>Vista previa</a>");



  $('#open').click(function(){
    //'+window.location.host+'
       $('#popup').fadeIn('slow'); //hidden-upload-input
       $('#Imagen').append( '<img src="../../../../multimedia/promociones/'+ $('.hidden-upload-input').attr("value") +'" width="468" height="189" />') 
       $('#texto').append( $('#field-PRO_NOMBRE').attr("value") + '<span> <strong>'+ $('#field-PRO_DESCUENTO').attr("value")  +'%</strong></span>' ); 
       $('#antes').append( $('#field-PRO_PRECIO_INICIAL').attr("value")  ); 
       $('#ahora').append( $('#field-PRO_PRECIO_FINAL').attr("value")  ); 
       //$('#destino').append( $('#field-SUB_ID option:selected').html()  ); 
      // $("#miCombo ").html();


   

    });

    $('#close').click(function(){
        $('#popup').fadeOut('slow');
        $('#Imagen').html('');
        $('#texto').html('');
        $('#antes').html(''); 
        $('#ahora').html(''); 
        //$('#destino').html(''); 
    });
});

</script>

 <div id="popup" style="display: none;">
    <div class="content-popup">
        <div class="close"><a href="javascript:;" id="close">x</a></div>
        <h1 style="color:#444444;margin:0 0 5px 0;">Vista previa.</h1>
       
      <div >
        <div id="Imagen" class="contenedor-imagen" style="width:468px;height:189px;">

        </div>
        <div id="info" style="width:446px;height:50px; padding: 6px 11px;background-color: white; color: rgb(100, 100, 100); border:1px solid rgb(109, 203, 229);">
          <p id="texto" style="font-size: 1.1em;color:#000000">
          </p>
        </div>
        
        <div id="info2" style="padding: 0 11px;width:446px;height:50px;background-color: white; border-left:1px solid rgb(109, 203, 229); border-right:1px solid rgb(109, 203, 229); border-bottom:1px solid rgb(109, 203, 229)">
  
             <div style="float:right;height:50px;">
                <div  style="float:left;height:50px; margin-right:20px;margin-top:10px">Antes <div id="antes" style="text-decoration:line-through;"></div></div>
                <div  style="float:right;height:50px;color:#219BF1;font-size:18px;">Ahora <div id="ahora"></div></div>
             </div>
        </div>

        <div class="clear"></div> 
      </div>

      <div style="text-align:center;padding:5px;" id="mensaje"></div>

    </div>
</div>