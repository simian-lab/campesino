<style type="text/css">
    .publicidad_categoria img {
        float: left;
    }
    .publicidad_categoria div {
        float: left;
        width: 90%;
    }
</style>

<link rel="stylesheet" href="<?php echo $base_url_static;?>stylesheets/jquery.ias.css"> 
<script src="<?php echo $base_url_static;?>js/jquery-ias.js"></script>    
<script src="<?php echo $base_url_static;?>js/scroll-promocion-prueba.js"></script>  

<section class="wrapp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="filtro">
                            <span>Filtrar Promociones por: </span>
                            <?php echo $tiendas ?>
                            <?php echo $marcas ?>
                            <?php echo $subCategorias ?>
                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                        <?php if(!empty($breadcrumb)): ?>
                                <li><a href="<?php echo $base_url ?>">Inicio</a></li>
                        <?php endif; ?>

                        <?php foreach($breadcrumb as $item): ?>
                                <?php if($item != '' && end($breadcrumb) == $item): ?>
                                    <li class="active"><?php echo $item ?></li>
                                <?php elseif($item != '' && end($breadcrumb) != $item): ?>
                                    <li><a href="<?php ($this->uri->segment(2)!='todos')?print($base_url.'descuentos/'.$this->uri->segment(2)):'#' ?>"><?php echo $item ?></a></li>
                                <?php endif; ?>
                        <?php endforeach; ?>

                        </ol>

                        <?php //echo set_breadcrumb(); ?> 
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                           <?php echo $promocionespremium_html ?>     

                    </div>
                </div>                
            </div>            
        </section>

        <section class="wrapp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                          <?php echo $promocionesgenerales_html ?> 
                    </div>
                </div> 



            </div>            
        </section> 