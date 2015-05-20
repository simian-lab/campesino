<article>
    <hgroup>
        <h1><?php echo htmlentities($articulo[0]['ART_TITULO'], ENT_QUOTES) ?></h1>
        <date><?php echo convertirFecha($articulo[0]['ART_FECHA']) ?></date>
    </hgroup>                   
    <figure>
    	<?php $articulo[0]['ART_IMAGEN'] = htmlentities($articulo[0]['ART_IMAGEN'], ENT_QUOTES); ?>
        <img src="<?php echo $base_url_img_articulos ?><?php echo $articulo[0]['ART_IMAGEN'] ?>" alt="">
    </figure>     
    <p><?php echo htmlspecialchars_decode($articulo[0]['ART_DETALLE']) ?></p>
</article>