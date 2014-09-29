<h4 class="alert_info">Crear Proceso</h4>

<article class="module width_full">
	<div class="module_content">
		<p>Ingrese los datos del proceso</p>
	</div>
</article>

<?php if($message){?><h4 class="alert_error"><?php echo $message;?></h4><?php }?>

<?php echo form_open("auth_ion/create_process");?>
<article class="module width_full">
    <header><h3>Datos</h3></header>
        <div class="module_content">
              <fieldset>
                    <label>Process Name: </label>
                    <?php echo form_input($process_name);?>
              </fieldset>
              <fieldset>
                    <label>Method: </label>
                    <?php echo form_input($method);?>
              </fieldset>
              <fieldset>
                    <label>Process: </label>
                    <?php echo form_dropdown('process_id',$process_options,'');?>
              </fieldset>
              <fieldset>
                    <label>En Menu: </label>
                    <?php echo form_checkbox($menu);?>
              </fieldset>
              <fieldset>
                    <label>Orden: </label>
                    <?php echo form_input($orden);?>
              </fieldset>
              <fieldset>
                    <label>Estilo CSS: </label>
                    <?php echo form_input($style);?>
              </fieldset>
            </div>
        <footer>
            <div class="submit_link">
                <?php echo form_submit('submit', 'Crear proceso', ' class="alt_btn"');?>
            </div>
        </footer>
    </article><!-- end of post new article -->

<?php echo form_close();?>