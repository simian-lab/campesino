<select name="selectTienda" id="selectTienda" class="custom">
		<option value="tiendas">Tienda</option>
	<?php foreach($tiendas as $tienda): ?>
    	<option value="<?php echo $tienda['TIE_SLUG'] ?>"><?php echo $tienda['TIE_NOMBRE'] ?></option>
	<?php endforeach; ?>
</select>