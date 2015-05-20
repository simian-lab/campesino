<div class="item-filter col-sm-3 col-xs-12">
  <label>Subcategoría</label>
  <select name="selectSubCategoria" id="selectSubCategoria">
    <option value="todos">Todas</option>
    <?php foreach($subCategorias as $subCategoria): ?>
      <option value="<?php echo $subCategoria['SUB_SLUG'] ?>" ><?php echo htmlentities($subCategoria['SUB_NOMBRE'], ENT_QUOTES) ?></option>
    <?php endforeach; ?>
  </select>
</div>
