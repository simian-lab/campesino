<div class="item-filter col-md-3">
  <label>Tienda</label>
  <select>
    <option value="tiendas">Tienda</option>
    <?php foreach($tiendas as $tienda): ?>
      <option value="<?php echo $tienda['TIE_SLUG'] ?>"><?php echo $tienda['TIE_NOMBRE'] ?></option>
    <?php endforeach; ?>
  </select>
</div>