<div class="col-lg-8 col-md-8 col-sm-12">
    <div class="articulos">
        <h1><b>todos</b> los <b>contenidos</b></h1>
        <ul>
            <?php if(isset($articulos)): 
                     foreach($articulos as $item): 
             ?>
                <li>
                    <figure>    
                         <a href="<?php echo base_url('articulo/'.$item['ART_SLUG']) ?>">
                                <img border="0" src="<?php echo $base_url_tod?>?src=<?php echo $base_url_img_articulos . $item['ART_IMAGEN'];?>&amp;w=206&amp;h=130&amp;bg=ffffff&amp;zc=1&amp;q=100" alt="">
                         </a>
                        <img src="<?php echo $base_url_static;?>img/border-btn-leermas.png" class="border-impacto">
                    </figure>
                    <aside>
                        <hgroup>
                            <h2><?php echo strip_tags($item['ART_TITULO']); ?></h2>
                            <date><?php echo convertirFecha($item['ART_FECHA']); ?></date>                 
                        </hgroup>
                        <div class="desc">
                            <p><?php echo strip_tags($item['ART_DESCRIPCION']); ?></p>
                        </div>
                        <div class="leer-mas">
                            <a href="<?php echo base_url('articulo/'.$item['ART_SLUG']) ?>">Leer <b>Más</b></a>
                        </div>
                    </aside>                                
                </li>
            <?php 
                    endforeach;
                endif;
            ?> 
         
            <div class="fix"></div>
        </ul>
    </div>                           
    <div class="row">
        <div class="col-lg-8 col-md-12 center">
            <div class="paginador">
                <nav>
                    <ul>
                        <?php echo $pagination ?>
                    </ul>
                </nav>
            </div>                        
        </div>
    </div> 
     <!--<div class="navigation">
            <ul>
               <?php echo $pagination ?>
            </ul>
    </div>                                            -->
</div> 