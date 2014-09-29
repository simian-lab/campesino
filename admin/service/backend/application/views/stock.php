<h4 class="alert_info">Stock de beneficio</h4>

<article class="module width_full">
	<div class="module_content">
		<p>Ingrese el stock al beneficio : <strong><?php echo $beneficio;?></strong></p>
	</div>
	<div class="module_content">
		<p>Stock actual: <?php echo $stock_actual;?></p>
	</div>
</article>

<?php if($message){?><h4 class="alert_error"><?php echo $message;?></h4><?php }?>

<?php echo form_open(current_url());?>
<article class="module width_full">
    <header><h3>Datos</h3></header>
        <div class="module_content">
			<fieldset>
				<label>Cantidad</label>
                <?php echo form_input($cantidad);?>
			</fieldset>
                <?php echo form_input($ben_id);?>
                <?php echo form_input($stock);?>
            </div>
        <footer>
            <div class="submit_link">
                <?php echo form_submit('submit', 'Agregar Stock', ' class="alt_btn"');?>
                <input type="button" value="Cancelar" onclick="javascript:history.back(-1);" id="cancelar"/>
            </div>
        </footer>
    </article><!-- end of post new article -->

<?php echo form_close();?>
