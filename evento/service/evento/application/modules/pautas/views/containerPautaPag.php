<div id="contentPautas">
	    <?php if(isset($pautas)): ?>
            <?php foreach ($pautas as $pauta): ?>
          	   <div class="row contenidos figure-image-auto">
	             	<?php foreach ($pauta as $item): ?>
			
		                    <div class="col-md-4 col-xs-12 post">
		                        <div class="box">
		                            <hgroup>
		                                <h2><?php echo $item['PAU_NOMBRE']; ?></h2>
		                            </hgroup>
		                            <a href="<?php echo base_url("lo-mejor-del-2013/" .$item['PAU_SLUG']); ?>">
			                            <figure >
			                                <img src="<?php echo $base_url_tod.'?w=360&amp;h=194&amp;bg=000000&amp;far=C&amp;zc=1&amp;src='.$base_url_img_pautas . $item['PAU_MOVIL_IMAGEN']; ?>" width="360" height="194" alt="<?php echo character_limiter(strip_tags($item['PAU_DESCRIPCION']),100); ?>" title="<?php echo strip_tags($item['PAU_NOMBRE']); ?>">
			                                <div class="more_cont">
			                                    <span>Leer contenido completo</span>
			                                    <img src="<?php echo $base_url_static;?>img/arrow_.png" alt="">                          
			                                </div>
			                                <div class="hover"></div>                                
			                            </figure>
		                        	</a>
		                            <article>
		                                <div class="desc">
		                                    <p>
		                                        <?php echo character_limiter(strip_tags($item['PAU_DESCRIPCION']),150); ?>
		                                    </p>
		                                </div>
		                            </article>
		                        </div>
		                    </div>
		                    
						                                       
	                <?php endforeach; ?>     
                </div> 
            <?php endforeach; ?>                     
    <?php endif; ?> 
    <div class="navigation" style="display:none">
            <ul>
               <li><?php echo $nextpage - 1;?></li>
               <li class="next-posts"><a href="<?php echo $pagination;?>/"><?php echo $nextpage;?></a></li>
            </ul>
    </div>
</div>      
              