<div class="item-filter col-md-3 col-sm-3 col-md-offset-1 col-sm-offset-1">
  <label>Tienda</label>
  <select name="selectTienda" id="selectTienda">
    <option value="tiendas">Tienda</option>
    <?php foreach($tiendas as $tienda): ?>
      <option value="<?php echo $tienda['TIE_SLUG'] ?>"><?php echo $tienda['TIE_NOMBRE'] ?></option>
    <?php endforeach; ?>
  </select>
</div>
