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
			<a onClick="onClickOferta('<?php echo $promocion['PRO_ID'] ?>', '<?php echo $posicion ?>','<?php echo $promocion['OMNITURE_ID']?>', '<?php echo EVENTO_NOMBRE;?>', 'general')" style="display: block;" target="_blank" href="<?php echo $base_url ?>redireccionamiento/externo/?url=<?php echo $promocion['PRO_HASH'] ?>">
				<div style="display:none;" class="idPromo"><?php echo $promocion['PRO_ID'] ?>;</div>
				<figure>
					<div class="overlay">
						<p><?php echo $promocion['PRO_DESCRIPCION']; ?></p>
						<a class="ofertaDesktop">ir a oferta</a>
						<?php
							//echo get_url_promocion($promocion['PRO_HASH'], 'ir a oferta', 1, array($posicion, $promocion['OMNITURE_ID'], $promocion['PRO_ID'], EVENTO_NOMBRE));
							if($promocion['TIE_LOGO_VISA'] == 1): 
						?>
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
						<?php 
							endif; 
						?>
					</div>

					<?php $promocion['PRO_LOGO_GENERAL'] = htmlentities($promocion['PRO_LOGO_GENERAL'], ENT_QUOTES); ?>

					<img data-original="<?php echo ($base_url_img_promociones . $promocion['PRO_LOGO_GENERAL']); ?>" alt="<?php echo character_limiter(strip_tags($promocion['PRO_DESCRIPCION']), 50); ?>" title="<?php echo strip_tags(htmlentities($promocion['PRO_NOMBRE'], ENT_QUOTES)); ?>" class="lazy-load-image imgj">
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
					<?php //echo get_url_promocion($promocion['PRO_HASH'], 'ir a oferta', 1, array($posicion, $promocion['OMNITURE_ID'], $promocion['PRO_ID'], EVENTO_NOMBRE)); ?>
					<div class="ofertaMobile">ir a oferta</div>
				</article>
			</a>
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
