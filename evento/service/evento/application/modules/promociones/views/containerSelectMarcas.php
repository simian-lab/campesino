<div class="item-filter col-md-3 col-sm-3">
  <label>Marca</label>
  <select name="selectMarca" id="selectMarca">
    <option value="marcas">Todas</option>
    <?php foreach($marcas as $marca): ?>
      <option value="<?php echo $marca['MAR_SLUG'] ?>" ><?php echo $marca['MAR_NOMBRE'] ?></option>
    <?php endforeach; ?>
  </select>
</div>
