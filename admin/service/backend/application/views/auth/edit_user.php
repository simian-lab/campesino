<h4 class="alert_info">Editar Usuario</h4>

<article class="module width_full">
	<div class="module_content">
		<p>Ingrese la informacion de usuario</p>
	</div>
</article>


<?php if($message){?><h4 class="alert_error"><?php echo $message;?></h4><?php }?>

<?php echo form_open(current_url());?>
<article class="module width_full">
    <header><h3>Datos</h3></header>
        <div class="module_content">

      <fieldset>
            <label>First Name: </label>
            <?php echo form_input($first_name);?>
      </fieldset>
      <fieldset>
            <label>Last Name: </label>
            <?php echo form_input($last_name);?>
      </fieldset>
      <fieldset>
            <label>Company Name: </label>
            <?php echo form_input($company);?>
      </fieldset>
      <fieldset>
            <label>Phone: </label>
            <?php echo form_input($phone1);?><?php echo form_input($phone2);?><?php echo form_input($phone3);?>
      </fieldset>
      <fieldset>
            <label>Password: </label>
            <?php echo form_input($password);?>
      </fieldset>
      <fieldset>
            <label>Confirm Password: </label>
            <?php echo form_input($password_confirm);?>
      </fieldset>



            </div>
        <footer>
            <div class="submit_link">
			  <?php echo form_hidden('id', $user->id);?>
              <?php echo form_hidden($csrf); ?>
        
              <?php echo form_submit('submit', 'Save User', ' class="alt_btn"');?>
            </div>
        </footer>
    </article><!-- end of post new article -->



<?php echo form_close();?>