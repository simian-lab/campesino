<h4 class="alert_info">Cambiar contraseña</h4>

<article class="module width_full">
	<div class="module_content">
		<p>Ingrese la nueva contraseña</p>
	</div>
</article>

<?php if($message){?><h4 class="alert_error"><?php echo $message;?></h4><?php }?>

<?php echo form_open(current_url());?>
<article class="module width_full">
    <header><h3>Datos</h3></header>
        <div class="module_content">

<!--      <p>Vieja contraseña:<br />
      <?php echo form_input($old_password);?>
      </p>-->
      
      <p>Nueva contraseña (por lo menos <?php echo $min_password_length;?>  caracteres de longitud):<br />
      <?php echo form_input($new_password);?>
      </p>
      
      <p>Confirmar Nueva Contraseña:<br />
      <?php echo form_input($new_password_confirm);?>
      </p>
      
      <?php echo form_input($user_id);?>
      <p><?php echo form_submit('submit', 'Change');?></p>
      
      </div>
</article>
<?php echo form_close();?>