<label>Tienda</label>
<select name="selectTienda" id="selectTienda">
  <option value="tiendas">Todas</option>
  <?php foreach($tiendas as $tienda): ?>
    <option value="<?php echo $tienda['TIE_SLUG'] ?>"><?php echo $tienda['TIE_NOMBRE'] ?></option>
  <?php endforeach; ?>
</select>