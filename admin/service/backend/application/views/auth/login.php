<article class="width_half">

<h4 class="alert_info width_half">Login</h4>

<article class="module width_full">
	<div class="module_content">
		<p>Inicia sesión con tu nombre de usuario y contraseña.</p>
	</div>
</article>


	
<?php if($message){?><h4 class="alert_warning"><?php echo $message;?></h4><?php }?>

<?php echo form_open(current_url());?>
<article class="module width_full">
    <header><h3>Datos</h3></header>
        <div class="module_content">

      <fieldset>
            <label>Usuario: </label>
            <?php echo form_input($identity);?>
      </fieldset>
      <fieldset>
            <label>Contraseña: </label>
            <?php echo form_input($password,"","autocomplete='off'");?>
      </fieldset>
      <fieldset>
            <label>Recordarme: </label>
            <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
      </fieldset>
    
            </div>
        <footer>
            <div class="submit_link">
                <?php echo form_submit('submit', 'Login', ' class="alt_btn"');?>
            </div>
        </footer>
    </article><!-- end of post new article -->
    
    
<?php echo form_close();?>

    <!--<article class="module width_full">
        <div class="module_content">
            <p><a href="forgot_password">Olvidó su contraseña?</a></p>
        </div>
    </article>-->

</article>
