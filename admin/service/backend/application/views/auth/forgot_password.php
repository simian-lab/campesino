<article class="width_half">
<h4 class="alert_info width_half">Olvidó su contraseña</h4>

<article class="module width_full">
	<div class="module_content">
		<p>Por favor, introduzca su dirección de correo electrónico para que podamos enviarle un correo electrónico para restablecer la contraseña</p>
	</div>
</article>


<?php if($message){?><div><h4 class="alert_warning"><?php echo $message;?></h4></div><?php }?>

<?php echo form_open(current_url());?>
<article class="module width_full">
    <header><h3>Datos</h3></header>
        <div class="module_content">
            <fieldset>
                <label>Dirección de correo : </label>
                <?php echo form_input($email);?>
            </fieldset>
        </div>
        <footer>
            <div class="submit_link">
                <?php echo form_submit('submit', 'Enviar', ' class="alt_btn"');?>
            </div>
        </footer>
    </article><!-- end of post new article -->
      
<?php echo form_close();?>
</article>