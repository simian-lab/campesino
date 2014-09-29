<style type="text/css">
.carousel .item{
    cursor: pointer;
}
</style>
<div class="row-fluid" id="slider">                
            <div id="carousel-example-captions" class="carousel slide">        
                <ol class="carousel-indicators">
                    <?php 
                    $i = 0;
                    $out = null;
                    $active = null;
                    foreach ($pautas as $item){ 

                        if($i == 0){
                            $active = ' class="active"';
                        }else{
                            $active = null;
                        }

                        $out .= '<li data-target="#carousel-example-captions" data-slide-to="'.$i.'"'.$active.'></li>';

                        $i++;

                    } 

                    echo $out;
                    ?>
                </ol>
                <div class="carousel-inner carousel-contenido">
                    <?php 
                    $pau_html = null;
                    $i = 0;
                    $active = null;
                    foreach ($pautas as $item){
                        if($i == 0){
                            $active = " active";
                        }else{
                            $active = null;
                        }
                        $pau_html .= '<div class="item'.$active.'">';
                        // $pau_html .= '<a href="http://'. $item['CAR_LINK'].'" target="_blank"><img src="'.$base_url_tod.'?w=1585&amp;h=320&amp;bg=000000&amp;far=C&amp;zc=1&amp;src='.$base_url_img_pautas_slider.$item['CAR_IMAGEN_SLIDER'].'" alt=""></a>';
                        $pau_html .= '<a href="'. prep_url($item['CAR_LINK']).'" target="_blank"><img src="'.$base_url_tod.'?w=1585&amp;h=416&amp;bg=000000&amp;far=C&amp;zc=1&amp;src='.$base_url_img_pautas_slider.$item['CAR_IMAGEN_SLIDER'].'"  title="'.$item['CAR_TITULO'].'" alt="'.strip_tags($item['CAR_DESCRIPCION']).'"></a>';
                        $pau_html .= '</div>';
                        $i++;
                    }

                    echo $pau_html;
                    ?>
                </div>             
                <div class="controls">
                    <div class="cont">
                        <a href="#carousel-example-captions" class="left carousel-control" data-slide="prev">
                            <img src="<?php echo $base_url_static;?>img/arrow-left.png" alt="">                            
                        </a>
                        <a href="#carousel-example-captions" class="right carousel-control" data-slide="next">
                            <img src="<?php echo $base_url_static;?>img/arrow-right.png" alt="">
                        </a>
                    </div>                        
                    <div class="fix"></div>
                </div>
            </div>
        </div>
