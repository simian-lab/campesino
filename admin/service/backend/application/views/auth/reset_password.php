<article class="width_half">
<h4 class="alert_info width_half">Cambiar contraseña</h4>

<article class="module width_full">
	<div class="module_content">
		<p>La nueva contraseña debe tener al menos 8 caracteres. </p>
	</div>
</article>

<?php if($message){?><h4 class="alert_warning"><?php echo $message;?></h4><?php }?>
<?php echo form_open(current_url());?>      
    <article class="module width_full">
        <header><h3>Datos</h3></header>
            <div class="module_content">
                    <fieldset>
                        <label>Nueva contraseña </label>
                        <?php echo form_input($new_password);?>
                    </fieldset>
                
                    <fieldset>
                        <label>Confirmar nueva contraseña: </label>
                        <?php echo form_input($new_password_confirm);?>
                    </fieldset>
                
                    <?php echo form_input($user_id);?>
                    <?php echo form_hidden($csrf); ?>
                
                    <p><?php echo form_submit('submit', 'Restablecer', ' class="alt_btn"');?></p>
                      
           </div>
    </article>
<?php echo form_close();?>


</article>

