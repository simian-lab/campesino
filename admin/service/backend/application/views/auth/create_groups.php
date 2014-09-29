<h4 class="alert_info">Crear Grupo</h4>

<article class="module width_full">
	<div class="module_content">
		<p>Ingrese los datos del grupo</p>
	</div>
</article>

<?php if($message){?><h4 class="alert_error"><?php echo $message;?></h4><?php }?>

<?php echo form_open("auth_ion/create_groups");?>
<article class="module width_full">
    <header><h3>Datos</h3></header>
        <div class="module_content">
      <fieldset>
            <label>Nombre: </label>
            <?php echo form_input($name);?>
      </fieldset>
      <fieldset>
            <label>Descripcion: </label>
            <?php echo form_input($description);?>
      </fieldset>
            </div>
        <footer>
            <div class="submit_link">
                <?php echo form_submit('submit', 'Crear grupo', ' class="alt_btn"');?>
            </div>
        </footer>
    </article><!-- end of post new article -->

<?php echo form_close();?>