
<div class="articulos relacionados">
                            <h1><b>artículos</b>relacionados</h1>
                            <ul>
                                <?php foreach($articulosRecomendados as $articulo): ?>
                                    <li>
                                        <figure>
                                            <?php $articulo->ART_IMAGEN = htmlentities($articulo->ART_IMAGEN, ENT_QUOTES); ?>
                                            <img border="0" src="<?php echo $base_url_tod?>?src=<?php echo $base_url_img_articulos . $articulo->ART_IMAGEN;?>&amp;w=130&amp;h=145&amp;zc=1&amp;" alt="">
                                            <img src="<?php echo $base_url_static ?>img/border-btn-leermas.png" class="border-impacto">
                                        </figure>
                                        <aside>
                                            <hgroup>
                                                <h3><?php echo htmlentities($articulo->ART_TITULO, ENT_QUOTES) ?></h3>
                                                <date><?php echo convertirFecha($articulo->ART_FECHA) ?></date>                                   
                                            </hgroup>
                                            <div class="desc">
                                                <p><?php echo $articulo->ART_DESCRIPCION ?></p>
                                            </div>
                                            <div class="leer-mas">
                                                <a href="<?php echo base_url('articulo/'.$articulo->ART_SLUG) ?>">Leer <b>Más</b></a>
                                            </div>
                                        </aside>                                    
                                    </li>
                                <?php endforeach; ?>
                                <div class="fix"></div>
                            </ul>
                        </div>    