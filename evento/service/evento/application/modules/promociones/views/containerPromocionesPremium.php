<div id="contentPromocionesdestacados">
  <div class="destacados">
    <ul>

      <?php
      $contador = 1;

      foreach($promociones as $promocion):

      /* if(!get_mime_by_extension($base_url_img_promociones . $promocion['PRO_LOGO_PREMIUM'])){
      //$contador = $contador - 1;
      unset($promociones[$promocion['PRO_ID']]);
      continue;
    }*/

    if($offset == 0){
      $posicion = $contador;
    }
    else{
      $posicion = $contador + $offset;
    }

    $li_class = '';
    if($promocion['PRO_DESCUENTO'] != ''){
      $li_class .= 'descuento ';
    }
    if(($contador % 2) == 0){
      $li_class .= 'nm ';
    }

    ?>
    <li class="<?php echo $li_class; ?> post col-lg-6 col-md-6 col-sm-6 col-sx-12" data-id="<?php echo $promocion['PRO_ID'] ?>">
      <figure>
        <div style="display:none;" class="idPromo"><?php echo $promocion['PRO_ID'] ?>;</div>
        <div class="overlay">
          <p><?php echo $promocion['PRO_DESCRIPCION']; ?></p>
          <?php

          echo get_url_promocion($promocion['PRO_HASH'], 'ir a oferta',0, array($posicion, $promocion['TIE_NOMBRE'], $promocion['PRO_ID']));
          ?>
          <!--<a data-keyboard="false" data-backdrop="static" data-toggle="modal" data-target="#redirect_oferta" href="#" class="link red" onClick="s.linkTrackVars='events,eVar38,eVar39,products';s.linkTrackEvents='event36';s.events='event36';s.eVar38='<?php echo $posicion?>';s.eVar39='<?php echo $promocion['PRO_USER_CREADOR']?>';s.products=';<?php echo $promocion['PRO_ID']?>';s.tl(true,'o','Clic en Promoción');tagManager(window,document,'script','dataLayer','GTM-NGBVTZ');facebookPixel();redirectPromocion('<?php echo $promocion['PRO_URL']; ?>');">ir a oferta</a>-->
            <!--<div class="marca">
            <img src="<?php echo $base_url_static;?>img/visa.jpg" alt="">
          </div>-->

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

        <!--<a onClick="s.linkTrackVars='events,eVar38,eVar39,products';s.linkTrackEvents='event36';s.events='event36';s.eVar38='<?php echo $posicion?>';s.eVar39='<?php echo $promocion['PRO_USER_CREADOR']?>';s.products=';<?php echo $promocion['PRO_ID']?>';s.tl(true,'o','Clic en Promoción');" style="display: block;" target="_blank" href="<?php echo get_url_encrypt($promocion['PRO_URL']) ?>"><img src="<?php echo $base_url_tod; ?>?w=458&amp;h=347&amp;bg=ffffff&amp;zc=1&amp;q=100&amp;src=<?php echo get_url_encode_tod($base_url_img_promociones . $promocion['PRO_LOGO_PREMIUM']); ?>" alt="<?php echo character_limiter(strip_tags($promocion['PRO_DESCRIPCION']), 50); ?>" title="<?php echo strip_tags($promocion['PRO_NOMBRE']); ?>"></a>-->
        <a onClick="onClickOferta('<?php echo $promocion['PRO_ID'] ?>', '<?php echo $posicion ?>','<?php echo $promocion['TIE_NOMBRE']; ?>')" style="display: block;" target="_blank" href="<?php echo $base_url ?>redireccionamiento/externo/?url=<?php echo $promocion['PRO_HASH'] ?>"><img src="<?php echo ($base_url_img_promociones . $promocion['PRO_LOGO_PREMIUM']); ?>" alt="<?php echo character_limiter(strip_tags($promocion['PRO_DESCRIPCION']), 50); ?>" title="<?php echo strip_tags($promocion['PRO_NOMBRE']); ?>"></a>
      </figure>

      <article>
        <div class="info">
          <h2><?php echo $promocion['TIE_NOMBRE']; ?></h2>
        </div>
        <div class="desc">
          <p><?php echo $promocion['PRO_NOMBRE']; ?></p>
          <?php if($promocion['PRO_PRECIO_FINAL'] != ''): ?>
            <span class="ahora">Ahora <?php echo $promocion['PRO_TIPO_MONEDA']; echo number_format($promocion['PRO_PRECIO_FINAL']); ?></span><?php ($promocion['PRO_PRECIO_INICIAL'] != '') ? print(' - ') : print('') ?>
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
        echo get_url_promocion($promocion['PRO_HASH'], 'ir a oferta',0, array($posicion, $promocion['TIE_NOMBRE'], $promocion['PRO_ID']));
        ?>
      </article>
    </li>
    <?php
    $contador++;
    endforeach;
    ?>

    <div class="fix"></div>
  </ul>

</div>
<div class="navigation">
  <ul>
    <li><?php echo $nextpage - 1;?></li>
    <li class="next-posts"><a href="<?php echo $pagination;?>/"><?php echo $nextpage;?></a></li>
  </ul>
</div>
</div>


