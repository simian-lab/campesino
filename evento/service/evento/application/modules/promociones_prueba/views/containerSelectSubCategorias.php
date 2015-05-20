<select name="selectSubCategoria" id="selectSubCategoria" class="custom">
	<option value="todos">SubCategoría</option>
	<?php foreach($subCategorias as $subCategoria): ?>
    	<option value="<?php echo $subCategoria['SUB_SLUG'] ?>" ><?php echo htmlentities($subCategoria['SUB_NOMBRE'], ENT_QUOTES) ?></option>
	<?php endforeach; ?>
</select>