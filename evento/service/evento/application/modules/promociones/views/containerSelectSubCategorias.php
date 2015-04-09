<div class="item-filter col-md-3">
  <label>Subcategoría</label>
  <select>
    <option value="todos">SubCategoría</option>
    <?php foreach($subCategorias as $subCategoria): ?>
      <option value="<?php echo $subCategoria['SUB_SLUG'] ?>" ><?php echo $subCategoria['SUB_NOMBRE'] ?></option>
    <?php endforeach; ?>
  </select>
</div>