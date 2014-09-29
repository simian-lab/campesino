<article>
    <hgroup>
        <h1><?php echo $articulo[0]['ART_TITULO'] ?></h1>
        <date><?php echo convertirFecha($articulo[0]['ART_FECHA']) ?></date>
    </hgroup>                   
    <figure>
        <img src="<?php echo $base_url_img_articulos ?><?php echo $articulo[0]['ART_IMAGEN'] ?>" alt="">
    </figure>     
    <p><?php echo htmlspecialchars_decode($articulo[0]['ART_DETALLE']) ?></p>
</article>