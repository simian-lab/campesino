<div id="contentPromocionesnodestacados">
    <div class="no-destacados">
         <ul>
                           <?php
                                $contador_basicas = 1; 
                                foreach($promociones as $promocion)://print_R($promocion);

                                if($offset == 0){
                                    $posicion = $contador_basicas;
                                }
                                else{
                                    $posicion = $contador_basicas + $offset;
                                }
                                
                                $li_class = '';
                                if($promocion['PRO_DESCUENTO'] != ''){
                                    $li_class .= 'descuento ';
                                }
                                if(($contador_basicas % 3) == 0){
                                    $li_class .= 'nm ';
                                }
                            ?>
                                  <li class="<?php echo $li_class; ?> post-no-destacados col-lg-4 col-md-4 col-sm-6" data-id="<?php echo $promocion['PRO_ID'] ?>">
                                                <div style="display:none;" class="idPromo"><?php echo $promocion['PRO_ID'] ?>;</div>
                                                <figure>
                                                    <div class="overlay">
                                                        <p><?php echo $promocion['PRO_DESCRIPCION']; ?></p>
                                                          <?php                                    
                                                               echo get_url_promocion($promocion['PRO_HASH'], 'ir a oferta', 1, array($posicion, $promocion['OMNITURE_ID'], $promocion['PRO_ID'], EVENTO_NOMBRE));
                                                            ?>
                                                            <!--<a data-keyboard="false" data-backdrop="static" data-toggle="modal" data-target="#redirect_oferta" href="#" class="link orange" onClick="s.linkTrackVars='events,eVar38,eVar39,products';s.linkTrackEvents='event36';s.events='event36';s.eVar38='<?php echo $posicion?>';s.eVar39='<?php echo $promocion['PRO_USER_CREADOR']?>';s.products=';<?php echo $promocion['PRO_ID']?>';s.tl(true,'o','Clic en Promoción');tagManager(window,document,'script','dataLayer','GTM-NGBVTZ');facebookPixel();redirectPromocion('<?php echo $promocion['PRO_URL']; ?>');">ir a oferta</a>-->
                                                         <?php if($promocion['TIE_LOGO_VISA'] == 1): ?>
                                                            <div class="marca">
                                                                <div class="visa_logo">
                                                                    <img src="<?php echo $base_url_static;?>img/visa.jpg" alt="">
                                                                </div>         
                                                                <div class="isologo">
                                                                    <span>
                                                                        <?php echo $promocion['TIE_TEXTO_VISA'] ?>
                                                                    </span>
                                                                </div>                          
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    
                                                    <!--<a onClick="s.linkTrackVars='events,eVar38,eVar39,products';s.linkTrackEvents='event36';s.events='event36';s.eVar38='<?php echo $posicion?>';s.eVar39='<?php echo $promocion['PRO_USER_CREADOR']?>';s.products=';<?php echo $promocion['PRO_ID']?>';s.tl(true,'o','Clic en Promoción');" style="display: block;" target="_blank" href="<?php echo get_url_encrypt($promocion['PRO_URL']) ?>"><img src="<?php echo $base_url_tod; ?>?w=298&amp;h=298&amp;bg=ffffff&amp;zc=1&amp;q=100&amp;src=<?php echo get_url_encode_tod($base_url_img_promociones . $promocion['PRO_LOGO_GENERAL']); ?>" alt="<?php echo character_limiter(strip_tags($promocion['PRO_DESCRIPCION']), 50); ?>" title="<?php echo strip_tags($promocion['PRO_NOMBRE']); ?>"></a>-->
                                                    <a onClick="onClickOferta('<?php echo $promocion['PRO_ID'] ?>', '<?php echo $posicion ?>','<?php echo $promocion['OMNITURE_ID']?>', '<?php echo EVENTO_NOMBRE;?>', 'general')" style="display: block;" target="_blank" href="<?php echo get_url_encrypt($promocion['PRO_URL']) ?>"><img src="<?php echo ($base_url_img_promociones . $promocion['PRO_LOGO_GENERAL']); ?>" alt="<?php echo character_limiter(strip_tags($promocion['PRO_DESCRIPCION']), 50); ?>" title="<?php echo strip_tags($promocion['PRO_NOMBRE']); ?>"></a>
                                                    
                                                </figure>
                                                <article>
                                                    <div class="info">
                                                          <h2><?php echo htmlentities($promocion['TIE_NOMBRE'], ENT_QUOTES); ?></h2>
                                                    </div>
                                                    <div class="desc">
                                                       <p><?php echo htmlentities($promocion['PRO_NOMBRE'], ENT_QUOTES); ?></p>     
                                                        <?php if($promocion['PRO_PRECIO_FINAL'] != ''): ?>                         
                                                        <span class="ahora">Ahora <?php echo $promocion['PRO_TIPO_MONEDA']; echo number_format($promocion['PRO_PRECIO_FINAL']); ?></span>
                                                        <?php endif; ?>
                                                        <?php if($promocion['PRO_PRECIO_INICIAL'] != ''): ?>
                                                        <span class="antes">Antes <?php echo $promocion['PRO_TIPO_MONEDA']; echo number_format($promocion['PRO_PRECIO_INICIAL']); ?></span>  
                                                        <?php endif; ?>          
                                                    </div>       
                                                      <?php if($promocion['PRO_DESCUENTO'] != ''): ?>
                                                        <div class="porcentaje">
                                                            <img src="<?php echo $base_url_static;?>img/top-percent.png" alt="">
                                                            <span class="num"><?php echo $promocion['PRO_DESCUENTO']; ?></span>
                                                            <span class="signo">%</span>
                                                            <span>Descuento</span> 
                                                        </div>   
                                                        <?php endif; ?>   
                                                      <?php                                    
                                                           echo get_url_promocion($promocion['PRO_HASH'], 'ir a oferta');
                                                        ?>
                                                </article>                                    
                                 </li>
                            <?php 
                                $contador_basicas++;
                                endforeach;
                            ?>
                        <div class="fix"></div>
         </ul>

    </div>

    <div class="navigation-no-destacados">
        <ul>
           <li><?php echo $nextpage - 1;?></li>
           <li class="next-posts-no-destacados"><a href="<?php echo $pagination;?>/"><?php echo $nextpage;?></a></li>
        </ul>
    </div>   
</div>  
