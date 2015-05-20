<select name="selectTienda" id="selectTienda" class="custom">
		<option value="tiendas">Tienda</option>
	<?php foreach($tiendas as $tienda): ?>
    	<option value="<?php echo $tienda['TIE_SLUG'] ?>"><?php echo htmlentities($tienda['TIE_NOMBRE'], ENT_QUOTES) ?></option>
	<?php endforeach; ?>
</select>