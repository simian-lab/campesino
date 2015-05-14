<div class="col-lg-4 col-md-4 col-sm-12 aside">
		<h1><b>marcas</b>participantes</h1>
		<div class="slide-marcas-participantes">
		    <a href="#" class="prev-marcas" id="prev-marcas-aside"><img src="<?php echo $base_url_static;?>img/controls-marcas-left.png" alt=""></a>  
		    <div id="slide-marcas">
		        <div class="item">
		            <ul>
		            	<?php 
                            $contador = 0;
                            foreach($participantes as $patrocinador): 
                        ?>
                    	<?php $patrocinador->PAT_LOGO = htmlentities($patrocinador->PAT_LOGO, ENT_QUOTES); ?>
                        <li><a target="_blank" href="<?php echo $patrocinador->PAT_URL; ?>"><img src="<?php echo $base_url_img_aliados . $patrocinador->PAT_LOGO ?>" alt=""></a></li>
                        <?php 
                            $contador++;
                            if($contador == 6){
                                echo '<div class="fix"></div>
                                    </ul>
                                </div>     
                                <div class="item">
                                    <ul>';
                            }
                        ?>
                        <?php endforeach; ?> 
                    </ul>
		        </div>                           
		    </div>
		    <a href="#" class="next-marcas"  id="next-marcas-aside"><img src="<?php echo $base_url_static;?>img/controls-marcas-right.png" alt=""></a>  
		</div>
		<figure class="publi">
		    <img src="<?php echo $base_url_static;?>img/publi1.jpg" alt="">
		</figure><!--
		--><figure class="publi">
		    <img src="<?php echo $base_url_static;?>img/publi2.jpg" alt="">
		</figure><!--               
		--><figure class="publi">
		    <img src="<?php echo $base_url_static;?>img/publi3.jpg" alt="">
		</figure>                                                   
	</div>
