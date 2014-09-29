<h4 class="alert_info"><?php echo $encabezado;?></h4>

<article class="module width_full">
    <header><h3><?php echo $titulo;?></h3></header>
    <?php 
		 echo form_open("main/imagenesm_subasta/".$id);
		?>
    <header><h3>Datos</h3></header>
        <div class="module_content">
	        <fieldset>
                <label> Tipo de imagen: </label>
                <select name="IMG_TIPO">
                <option value="L" <?php echo set_select('IMG_TIPO', 'L', TRUE); ?> >Slide listado</option>
                <option value="D" <?php echo set_select('IMG_TIPO', 'D'); ?> >Slide detalle</option>
                </select> 		
                </fieldset>
            </div>
        <footer>
            <div class="submit_link">
                <?php echo form_submit('submit', 'Siguiente', ' class="alt_btn"');?>
            </div>
        </footer>

	
	<?php 
		echo form_close();

	?>
</article>
