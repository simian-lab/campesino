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
<script src="<?php echo $base_url_static;?>js/scroll-promocion.js"></script>

<section class="wrapp">
  <div class="ancla">
    <a href="#anchor-ofertas-destacadas">
      <img class="esc" src="http://dynamikdemos.a2hosted.com/clients/eltiempo/cyberlunes/assets/ancla.png">
      <img class="mov" src="http://dynamikdemos.a2hosted.com/clients/eltiempo/cyberlunes/assets/ancla-mov.png">
    </a>
  </div>
  <div class="container">
    <div class="wrapper-filter">
      <img src="http://dynamikdemos.a2hosted.com/clients/eltiempo/cyberlunes/assets/extra-left-filter.png" class="extra-left">
      <img src="http://dynamikdemos.a2hosted.com/clients/eltiempo/cyberlunes/assets/extra-right-filter.png" class="extra-right">
      <div class="filter row col-md-12">
        <?php echo $tiendas ?>

        <?php echo $marcas ?>

        <div class="button-search col-md-3 col-xs-12" id="buscarOfertaButton" name="buscarOfertaButton">
          <input type="submit" name="Buscar" value="Buscar">
        </div>
      </div><!--End Filter-->
    </div><!-- End wrapper Filter-->

    <div class="menu-tabs">
      <ul>
        <li class="active">
          <a href="<?php echo $base_url;?>">TODAS LAS TIENDAS</a>
        </li>
        <li>
          <a href="<?php echo $base_url."descuentos"?>">TODAS LAS OFERTAS</a>
        </li>
      </ul>
    </div>

    <div class="important-brand col-md-12 content-patrocinadores-destacados">
      <h2>PATROCINADORES <small>DESTACADOS</small></h2>

      <?php foreach($patrocinadores_oro_plus as $patrocinador): ?>
        <div class="wrapper-box col-md-3 col-xs-12 ">
          <div class="box" data-id="<?php echo $patrocinador->PAT_ID; ?>">
            <?php if($patrocinador->PAT_URL_EVENT!=''): ?>
              <a target="_blank" href="<?php echo $base_url ?>redireccionamiento/externo/?url=<?php echo $patrocinador->PAT_HASH_URL_EVENT ?>">
                <img data-original="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" class="lazy-load-image">
                <span>Ir a la tienda</span>
              </a>
            <?php else: ?>
              <img data-original="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" class="lazy-load-image">
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="clear"></div>
      <hr>
    </div><!-- End important-brand-->

    <div class="clear"></div>

    <div class="publicidad col-xs-12">
      <div class="box col-md-4">
        <a href="" target="_blank">
          <p>Publicidad</p>
          <img src="http://dynamikdemos.a2hosted.com/clients/eltiempo/cyberlunes/assets/publicidad1.jpg">
        </a>
      </div>
      <div class="box col-md-4">
        <a href="" target="_blank">
          <p>Publicidad</p>
          <img src="http://dynamikdemos.a2hosted.com/clients/eltiempo/cyberlunes/assets/publicidad1.jpg">
        </a>
      </div>
      <div class="box col-md-4">
        <a href="" target="_blank">
          <p>Publicidad</p>
          <img src="http://dynamikdemos.a2hosted.com/clients/eltiempo/cyberlunes/assets/publicidad1.jpg">
        </a>
      </div>
      <div class="clear"></div>
      <hr>
    </div><!-- End publicidad-->

    <div class="clear"></div>

    <div class="important-brand col-md-12 content-patrocinadores-destacados">

      <?php foreach($patrocinadores_oro as $patrocinador): ?>
        <div class="wrapper-box col-md-3 col-xs-12">
          <div class="box" data-id="<?php echo $patrocinador->PAT_ID; ?>">
            <?php if($patrocinador->PAT_URL_EVENT!=''): ?>
              <a target="_blank" href="<?php echo $base_url ?>redireccionamiento/externo/?url=<?php echo $patrocinador->PAT_HASH_URL_EVENT ?>">
                <img data-original="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" class="lazy-load-image">
                <span>Ir a la tienda</span>
              </a>
            <?php else: ?>
              <img data-original="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" class="lazy-load-image">
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="clear"></div>
    </div><!-- End important-brand-->

    <div class="clear"></div>

    <div class="comercios col-md-12 content-patrocinadores-destacados">
      <h2>COMERCIOS <small>PARTICIPANTES</small></h2>

      <?php foreach($patrocinadores_plata as $patrocinador): ?>
        <div class="wrapper-box col-md-2 col-xs-4">
          <div class="box" data-id="<?php echo $patrocinador->PAT_ID; ?>">
            <?php if($patrocinador->PAT_URL_EVENT!=''): ?>
              <a target="_blank" href="<?php echo $base_url ?>redireccionamiento/externo/?url=<?php echo $patrocinador->PAT_HASH_URL_EVENT ?>">
                <img data-original="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" class="lazy-load-image">
                <span>Ir a la tienda</span>
              </a>
            <?php else: ?>
              <img data-original="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" class="lazy-load-image">
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="clear"></div>
      <hr>
    </div><!-- End Comercios -->

    <div class="clear"></div>

    <div class="comercios col-md-12 content-patrocinadores-destacados">
      <?php foreach($patrocinadores_bronce as $patrocinador): ?>
        <div class="wrapper-box col-md-2 col-xs-4">
          <div class="box" data-id="<?php echo $patrocinador->PAT_ID; ?>">
            <?php if($patrocinador->PAT_URL_EVENT!=''): ?>
              <a target="_blank" href="<?php echo prep_url($patrocinador->PAT_URL_EVENT); ?>">
                <img data-original="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" class="lazy-load-image">
                <span>Ir a la tienda</span>
              </a>
            <?php else: ?>
              <img data-original="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" class="lazy-load-image">
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="clear"></div>
      <hr>
    </div><!-- End Comercios -->

    <div class="clear"></div>

    <div class="comercios col-md-12 content-patrocinadores-destacados">
      <?php foreach($patrocinadores_platino as $patrocinador): ?>
        <div class="wrapper-box col-md-2 col-xs-4">
          <div class="box" data-id="<?php echo $patrocinador->PAT_ID; ?>">
            <?php if($patrocinador->PAT_URL_EVENT!=''): ?>
              <a target="_blank" href="<?php echo $base_url ?>redireccionamiento/externo/?url=<?php echo $patrocinador->PAT_HASH_URL_EVENT ?>">
                <img data-original="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" class="lazy-load-image">
                <span>Ir a la tienda</span>
              </a>
            <?php else: ?>
              <img data-original="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" class="lazy-load-image">
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="clear"></div>
      <hr>
    </div><!-- End Comercios -->

    <div class="clear"></div>

    <!-- Head's up! anchor-ofertas-destacadas is here. Why?, pray, isn't it below,
      in the actual Offers? good question! unfortunately, we didn't have much time for
      this, and since we have a fixed menu, leaving the anchor below would leave the
      title *below* the menu. This should be better handled through js, so list that
      under the improvements you can make :). -->
    <div class="mini col-md-12 content-patrocinadores-destacados" id="anchor-ofertas-destacadas">
      <?php foreach($patrocinadores_general as $patrocinador): ?>
        <div class="wrapper-box">
          <div class="box" data-id="<?php echo $patrocinador->PAT_ID; ?>">
            <?php if($patrocinador->PAT_URL_EVENT!=''): ?>
              <a target="_blank" href="<?php echo $base_url ?>redireccionamiento/externo/?url=<?php echo $patrocinador->PAT_HASH_URL_EVENT ?>">
                <img data-original="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" class="lazy-load-image">
                <span>Ir a la tienda</span>
              </a>
            <?php else: ?>
              <img data-original="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" class="lazy-load-image">
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
      <div class="clear"></div>
    </div><!-- End mini -->

    <div class="ofertas-destacadas col-md-12">
      <h3>
        OFERTAS <small>DESTACADAS</small>
      </h3>
      <?php echo $promocionespremium_html ?>
    </div>
  </div>
</section>
