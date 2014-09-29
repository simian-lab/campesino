<h4 class="alert_info"><?php echo $encabezado;?></h4>

<?php if(isset($error['error'])){
	if($error['error']!= '<p>You did not select a file to upload.</p>'){
	?>
    <h4 class="alert_error">
	   <?php 	
		if($error['error']!= 'You did not select a file to upload.')
			echo 'Se produjo un error, vuelva a intentar.';
	   ?>
	</h4>
<?php 
	}
} ?>


<?php if(isset($data)){
	?>
    <h4 class="alert_success">
    	Se ejecuto el archivo con éxito.
	</h4>
<?php 
} ?>

<?PHP 
if(isset($exito)){
	?>
    <article class="module width_full">
        <header><h3><?php echo $titulo;?></h3></header>
        <div class="module_content">
        <p>Se cargo el archivo con éxito.</p>
        </div>
    </article>
<?PHP 
}else{
?>
<article class="module width_full">
    <header><h3><?php echo $titulo;?></h3></header>
	<?php echo form_open_multipart('main/list_codigos_beneficios/'.$BEN_ID);?>
    <header><h3>Datos</h3></header>
        <div class="module_content">
        <p>Formato archivo: <strong>CODIGO</strong></p>
	        <fieldset>
                <label> Archivo csv: </label>
                <input type="file" name="userfile" size="20" />		
                </fieldset>
            </div>
        <footer>
            <div class="submit_link">
                <?php echo form_submit('submit', 'Ejecutar', ' class="alt_btn"');?>
            </div>
        </footer>

	
	<?php 
		echo form_close();

	?>
    <?php echo $output->output;?>
</article>
<?php 
} ?>
