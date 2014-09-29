<h4 class="alert_info">Editar Proceso</h4>


<?php if($message){?><h4 class="alert_error"><?php echo $message;?></h4><?php }?>

<?php echo form_open(current_url());?>

    <article class="module width_full">
        <header><h3>Datos</h3></header>
            <div class="module_content">
              <fieldset>
                    <label>Process name: </label>
                    <?php echo form_input($process_name);?>
              </fieldset>
              <fieldset>
                    <label>Method: </label>
                    <?php echo form_input($method);?>
              </fieldset>
              <fieldset>
                    <label>Process: </label>
                    <?php echo form_dropdown('process_id',$process_options,$process_id);?>
              </fieldset>
              <fieldset>
                    <label>En Menu: </label>
                    <?php echo form_checkbox($menu);?>
              </fieldset>
              <fieldset>
                    <label>Orden: </label>
                    <?php echo form_input($orden);?>
              </fieldset>
              <fieldset>
                    <label>Estilo CSS: </label>
                    <?php echo form_input($style);?>
              </fieldset>
            </div>
        <footer>
            <div class="submit_link">
                <?php echo form_input($id);?>
                <?php echo form_submit('submit', 'Editar Proceso', ' class="alt_btn"');?>
            </div>
        </footer>
    </article><!-- end of post new article -->
<?php echo form_close();?>
