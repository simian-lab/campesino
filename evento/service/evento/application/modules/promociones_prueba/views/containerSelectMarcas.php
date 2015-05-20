<select name="selectMarca" id="selectMarca" class="custom">
	<option value="marcas">Marca</option>
	<?php foreach($marcas as $marca): ?>
    	<option value="<?php echo $marca['MAR_SLUG'] ?>" ><?php echo htmlentities($marca['MAR_NOMBRE'], ENT_QUOTES) ?></option>
	<?php endforeach; ?>
</select>
