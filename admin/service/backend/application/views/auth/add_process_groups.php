<h4 class="alert_info">Crear Grupo</h4>

<article class="module width_full">
	<div class="module_content">
		<p>Seleccione los permisos a asignar al grupo: "<?php echo $groups;?>"</p>
	</div>
</article>

<?php if($message){?><h4 class="alert_error"><?php echo $message;?></h4><?php }?>

<?php echo form_open(current_url());?>
<article class="module width_full">
    <header><h3>Datos</h3></header>
        <div class="module_content">
	        <?php foreach ($proceso as $input){?>
    	        <?php echo $input;?>
            <?php }?> 
            </div>
        <footer>
            <div class="submit_link">
                <?php echo form_input($id);?>
                <?php echo form_submit('submit', 'Asignar permisos', ' class="alt_btn"');?>
                <?php echo form_submit('reset', 'Cancelar', '');?>
            </div>
        </footer>
    </article><!-- end of post new article -->
<?php echo form_close(); ?>