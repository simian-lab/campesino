<div class="row-fluid" id="slider">                
    <div id="carousel-example-captions" class="carousel slide">        
        <ol class="carousel-indicators">
              <?php 
                 $active = ' class="active"';
                 $i = 0;
                 foreach ($pautas as $item): ?>
                    <li data-target="#carousel-example-captions" data-slide-to="<?php echo $i;?>" <?php echo $active;?>></li>                    
                <?php 
                     $active = null;
                    $i++;
                  endforeach; 
                ?> 
        </ol>
        <div class="carousel-inner">
       
              <?php 
                 $active = ' active';
                 $i = 0;
                 $pau_html='';
                 foreach ($pautas as $item): 
                     
                    $pau_html .= '<div class="item'.$active.'">';   
                    $pau_html .= '<a href="'.base_url('lo-mejor-del-2013/'.$item['PAU_SLUG']).'/">';   
                    $pau_html .= '<img src="'.$base_url_tod.'?w=1585&amp;h=416&amp;bg=000000&amp;far=C&amp;zc=1&amp;src='.$base_url_img_pautas . $item['PAU_IMAGEN'].'" width="1585" height="320" 
                    title="'.character_limiter(strip_tags($item['PAU_NOMBRE']),100).'" alt="'.character_limiter(strip_tags($item['PAU_DESCRIPCION']),100).'">';
                    $pau_html .= '</a>';
                    $pau_html .= '</div>';
                
                     $active = null;
                    $i++;
                  endforeach; 
                   echo $pau_html;
                ?>            

        </div>             
        <div class="controls">
            <div class="cont">
                <a href="#carousel-example-captions" class="left carousel-control" data-slide="prev">
                <!--<span class="glyphicon glyphicon-chevron-left">-->
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