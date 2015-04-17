<option value="marcas">Todas</option>
<?php foreach($marcas as $marca): ?>
  <option value="<?php echo $marca['MAR_SLUG'] ?>" ><?php echo $marca['MAR_NOMBRE'] ?></option>
<?php endforeach; ?>
