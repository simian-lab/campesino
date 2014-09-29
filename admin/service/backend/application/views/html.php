<link type="text/css" rel="stylesheet" href="http://mastercard-rg-plataformalealtad.dev.cba.brandigital.com/admin/service/backend/assets/grocery_crud/themes/flexigrid/css/flexigrid.css" />
	
<h4 class="alert_info"><?php echo $encabezado;?></h4>
<?php if(isset($introduccion)){?>
    <article class="module width_full">
        <div class="module_content">
            <p><?php echo $introduccion;?></p>
        </div>
    </article>
<?php }?>

<article class="module width_full">
    <header><h3><?php echo $titulo;?></h3></header>
    <?php 
	if(isset($output->output))
		echo $output->output;
	else
		echo $html;?>
</article>