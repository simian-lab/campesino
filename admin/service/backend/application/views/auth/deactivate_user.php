<h4 class="alert_info">Desactivar usuario</h4>

<article class="module width_full">
	<div class="module_content">
        <p>¿Seguro desea desactivar al usuario '<?php echo $user->username; ?>'?</p>
	</div>
</article>

<?php echo form_open("auth_ion/deactivate/".$user->id);?>
<article class="module width_full">
    <header><h3>Datos</h3></header>
        <div class="module_content">
      <fieldset>
        <label>Si: </label>
            <input type="radio" name="confirm" value="yes" checked="checked" />
      </fieldset>
      <fieldset>
        <label>No: </label>
                <input type="radio" name="confirm" value="no" />
      </fieldset>


		<?php echo form_hidden($csrf); ?>
        <?php echo form_hidden(array('id'=>$user->id)); ?>

        </div>
    <footer>
        <div class="submit_link">
            <?php echo form_submit('submit', 'Desactivar', ' class="alt_btn"');?>
        </div>
    </footer>
</article><!-- end of post new article -->

<?php echo form_close();?>