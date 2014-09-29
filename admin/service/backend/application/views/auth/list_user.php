<h4 class="alert_info">Usuarios</h4>

<?php if($message){?><h4 class="alert_success"><?php echo $message;?></h4><?php }?>
<article class="module width_full">
    <header><h3>Listado de usuarios</h3></header>
    <?php 
		echo $output->output;
	?>
</article>