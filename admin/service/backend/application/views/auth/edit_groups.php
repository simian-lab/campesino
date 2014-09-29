<h4 class="alert_info">Editar Grupo</h4>


<?php if($message){?><h4 class="alert_error"><?php echo $message;?></h4><?php }?>

<?php echo form_open(current_url());?>

    <article class="module width_full">
        <header><h3>Datos</h3></header>
            <div class="module_content">
              <fieldset>
                    <label>Nombre: </label>
                    <?php echo form_input($name);?>
              </fieldset>
              <fieldset>
                    <label>Description: </label>
                    <?php echo form_input($description);?>
              </fieldset>
            </div>
        <footer>
            <div class="submit_link">
                <?php echo form_input($id);?>
                <?php echo form_submit('submit', 'Editar grupo', ' class="alt_btn"');?>
            </div>
        </footer>
    </article><!-- end of post new article -->
<?php echo form_close();?>
