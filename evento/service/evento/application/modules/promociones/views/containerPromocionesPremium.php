<div id="contentPromocionesdestacados">
  <div class="destacados">
    <ul>
      <?php
      $contador = 1;
      foreach($promociones as $promocion):

        if($offset == 0) {
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
			  echo get_url_promocion($promocion['PRO_HASH'], 'ir a oferta', 0, array($posicion, $promocion['OMNITURE_ID'], $promocion['PRO_ID'], EVENTO_NOMBRE));
              ?>

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

            <?php $promocion['PRO_LOGO_PREMIUM'] = htmlentities($promocion['PRO_LOGO_PREMIUM'], ENT_QUOTES); ?>

            <a onClick="onClickOferta('<?php echo $promocion['PRO_ID'] ?>', '<?php echo $posicion ?>','<?php echo htmlentities($promocion['TIE_NOMBRE'], ENT_QUOTES); ?>')" style="display: block;" target="_blank" href="<?php echo $base_url ?>redireccionamiento/externo/?url=<?php echo $promocion['PRO_HASH'] ?>">
              <img data-original="<?php echo ($base_url_img_promociones . $promocion['PRO_LOGO_PREMIUM']); ?>" alt="<?php echo character_limiter(strip_tags($promocion['PRO_DESCRIPCION']), 50); ?>" title="<?php echo strip_tags($promocion['PRO_NOMBRE']); ?>" class="lazy-load-image">
            </a>
          </figure>

          <article>
            <div class="info">
              <h2><?php echo htmlentities($promocion['TIE_NOMBRE'], ENT_QUOTES); ?></h2>
            </div>
            <div class="desc">
              <p><?php echo htmlentities($promocion['PRO_NOMBRE'], ENT_QUOTES); ?></p>
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
            echo get_url_promocion($promocion['PRO_HASH'], 'ir a oferta', 0, array($posicion, $promocion['OMNITURE_ID'], $promocion['PRO_ID'], EVENTO_NOMBRE));
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