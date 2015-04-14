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
      <img src="http://dynamikdemos.a2hosted.com/clients/eltiempo/cyberlunes/assets/extra-left-filter.png" class="extra-left" style="
      ">
      <img src="http://dynamikdemos.a2hosted.com/clients/eltiempo/cyberlunes/assets/extra-right-filter.png" class="extra-right" style="
      ">
      <div class="filter row col-md-10 col-md-offset-1">
        <?php echo $tiendas ?>

        <?php echo $marcas ?>

        <div class="button-search col-md-2 col-xs-12">
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

    <div class="important-brand col-md-12">
      <h2>PATROCINADORES <small>DESTACADOS</small></h2>

      <?php foreach($patrocinadores_oro_plus as $patrocinador): ?>
        <div class="wrapper-box col-md-3 col-xs-12">
          <div class="box">
            <?php if($patrocinador->PAT_URL_EVENT!=''): ?>
              <a target="_blank" href="<?php echo prep_url($patrocinador->PAT_URL_EVENT); ?>">
                <img src="<?php echo $base_url_img_aliados;?><?php echo $patrocinador->PAT_LOGO ?>">
                <span>Ir a la tienda</span>
              </a>
            <?php else: ?>
              <img src="<?php echo $base_url_img_aliados;?><?php echo $patrocinador->PAT_LOGO ?>">
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

    <div class="important-brand col-md-12">

      <?php foreach($patrocinadores_oro as $patrocinador): ?>
        <div class="wrapper-box col-md-3 col-xs-12">
          <div class="box">
            <?php if($patrocinador->PAT_URL_EVENT!=''): ?>
              <a target="_blank" href="<?php echo prep_url($patrocinador->PAT_URL_EVENT); ?>">
                <img src="<?php echo $base_url_img_aliados;?><?php echo $patrocinador->PAT_LOGO ?>">
                <span>Ir a la tienda</span>
              </a>
            <?php else: ?>
              <img src="<?php echo $base_url_img_aliados;?><?php echo $patrocinador->PAT_LOGO ?>">
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="clear"></div>
    </div><!-- End important-brand-->

    <div class="clear"></div>

    <div class="comercios col-md-12">
      <h2>COMERCIOS <small>PARTICIPANTES</small></h2>

      <?php foreach($patrocinadores_plata as $patrocinador): ?>
        <div class="wrapper-box col-md-2 col-xs-4">
          <div class="box">
            <?php if($patrocinador->PAT_URL_EVENT!=''): ?>
              <a target="_blank" href="<?php echo prep_url($patrocinador->PAT_URL_EVENT); ?>">
                <img src="<?php echo $base_url_img_aliados;?><?php echo $patrocinador->PAT_LOGO ?>">
                <span>Ir a la tienda</span>
              </a>
            <?php else: ?>
              <img src="<?php echo $base_url_img_aliados;?><?php echo $patrocinador->PAT_LOGO ?>">
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="clear"></div>
      <hr>
    </div><!-- End Comercios -->

    <div class="clear"></div>

    <div class="comercios col-md-12">
      <?php foreach($patrocinadores_bronce as $patrocinador): ?>
        <div class="wrapper-box col-md-2 col-xs-4">
          <div class="box">
            <?php if($patrocinador->PAT_URL_EVENT!=''): ?>
              <a target="_blank" href="<?php echo prep_url($patrocinador->PAT_URL_EVENT); ?>">
                <img src="<?php echo $base_url_img_aliados;?><?php echo $patrocinador->PAT_LOGO ?>">
                <span>Ir a la tienda</span>
              </a>
            <?php else: ?>
              <img src="<?php echo $base_url_img_aliados;?><?php echo $patrocinador->PAT_LOGO ?>">
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="clear"></div>
      <hr>
    </div><!-- End Comercios -->

    <div class="clear"></div>

    <div class="comercios col-md-12">
      <?php foreach($patrocinadores_platino as $patrocinador): ?>
        <div class="wrapper-box col-md-2 col-xs-4">
          <div class="box">
            <?php if($patrocinador->PAT_URL_EVENT!=''): ?>
              <a target="_blank" href="<?php echo prep_url($patrocinador->PAT_URL_EVENT); ?>">
                <img src="<?php echo $base_url_img_aliados;?><?php echo $patrocinador->PAT_LOGO ?>">
                <span>Ir a la tienda</span>
              </a>
            <?php else: ?>
              <img src="<?php echo $base_url_img_aliados;?><?php echo $patrocinador->PAT_LOGO ?>">
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="clear"></div>
      <hr>
    </div><!-- End Comercios -->

    <div class="clear"></div>

    <div class="mini col-md-12">
      <?php foreach($patrocinadores_general as $patrocinador): ?>
        <div class="wrapper-box">
          <div class="box">
            <?php if($patrocinador->PAT_URL_EVENT!=''): ?>
              <a target="_blank" href="<?php echo prep_url($patrocinador->PAT_URL_EVENT); ?>">
                <img src="<?php echo $base_url_img_aliados;?><?php echo $patrocinador->PAT_LOGO ?>">
                <span>Ir a la tienda</span>
              </a>
            <?php else: ?>
              <img src="<?php echo $base_url_img_aliados;?><?php echo $patrocinador->PAT_LOGO ?>">
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
      <div class="clear"></div>
    </div><!-- End mini -->

    <div class="ofertas-destacadas col-md-12">
      <?php echo $promocionespremium_html ?>
    </div>
  </div>
</section>
