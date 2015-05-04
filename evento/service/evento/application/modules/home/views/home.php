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
    <a href="#anchor-ofertas-destacadas" onclick="onClickOfertasDestacadas()">
      <img class="esc" src="<?php echo $base_url_static;?>img/ancla.png">
      <img class="mov" src="<?php echo $base_url_static;?>img/ancla-mov.png">
    </a>
  </div>
  <div class="container">
    <div class="wrapper-filter">
      <img src="<?php echo $base_url_static;?>img/extra-left-filter.png" class="extra-left">
      <img src="<?php echo $base_url_static;?>img/extra-right-filter.png" class="extra-right">
      <div class="filter row col-md-12">
        <div class="item-filter <?php if(empty($subCategorias)) { echo 'col-sm-4 col-sm-offset-1'; } else {echo 'col-sm-3 col-xs-12';} ?>">
          <?php echo $tiendas ?>
        </div>

        <div class="item-filter <?php if(empty($subCategorias)) { echo 'col-sm-4 col-xs-12'; } else {echo 'col-sm-3 col-xs-12';} ?>">
          <?php echo $marcas ?>
        </div>

        <div class="button-search col-sm-2 col-xs-12" id="buscarOfertaButton" name="buscarOfertaButton">
          <input type="submit" name="Buscar" value="Buscar">
        </div>
      </div><!--End Filter-->
    </div><!-- End wrapper Filter-->

    <div class="menu-tabs">
      <ul>
        <li class="active">
          <a href="<?php echo $base_url;?>" onclick="onClickTodasLasTiendas()" >TODAS LAS TIENDAS</a>
        </li>
        <li>
          <a href="<?php echo $base_url."descuentos"?>" onclick="onClickTabTodasLasOfertas()" >TODAS LAS OFERTAS</a>
        </li>
      </ul>
    </div>

    <div class="important-brand col-md-12 content-patrocinadores-destacados">
      <h2>PATROCINADORES <small>DESTACADOS</small></h2>
      <?php $posicion = 1; ?>
      <?php foreach($patrocinadores_oro_plus as $patrocinador): ?>
      <?php
        if($patrocinador->PAT_URL_EVENT != '') {
          $url_patrocinador = $base_url . 'redireccionamiento/externo/?url=' . $patrocinador->PAT_HASH_URL_EVENT;
        } else {
          $url_patrocinador = '#';
        }
      ?>
        <div class="wrapper-box col-sm-3 col-xs-12 ">
          <div class="box" data-id="<?php echo $patrocinador->PAT_ID; ?>">
              <a target="_blank" href="<?php echo $url_patrocinador ?>" onClick="onClickPatrocinador('<?php echo $patrocinador->PAT_ID ?>', '<?php echo $posicion ?>')">
                <img data-original="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" class="lazy-load-image">
                <span>Ir a la tienda</span>
              </a>
          </div>
        </div>
      <?php $posicion++; ?>
      <?php endforeach; ?>

      <div class="clear"></div>
      <hr>
    </div><!-- End important-brand-->

    <div class="clear"></div>

    <div class="publicidad col-xs-12">
      <div class="box col-sm-4">
        <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=41700&pgname=home&fmtid=9611&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">
          <p>Publicidad</p>
          <script type="text/javascript">
          sas.call("std", {
                  siteId:  41700, //
                  pageId:  282275, // Página : Cyberlunes/home
                  formatId:  9611, // Formato : Primer Boton 300x100 300x100
                  target:  ''   // Segmentación
                });
          </script>
          <noscript>
            <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=41700&pgname=home&fmtid=9611&visit=m&tmstp=[timestamp]" border="0" alt="" />
          </noscript>
        </a>
      </div>
      <div class="box col-sm-4">
        <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=41700&pgname=home&fmtid=9608&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">
          <p>Publicidad</p>
          <script type="text/javascript">
          sas.call("std", {
                      siteId:  41700, //
                      pageId:  282275, // Página : Cyberlunes/home
                      formatId:  9608, // Formato : Segundo Boton 300x100 300x100
                      target:  ''   // Segmentación
                    });
          </script>
            <noscript>
              <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=41700&pgname=home&fmtid=9608&visit=m&tmstp=[timestamp]" border="0" alt="" />
            </noscript>
        </a>
      </div>
      <div class="box col-sm-4">
        <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=41700&pgname=home&fmtid=11772&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">
          <p>Publicidad</p>
          <script type="text/javascript">
          sas.call("std", {
                      siteId:  41700, //
                      pageId:  282275, // Página : Cyberlunes/home
                      formatId:  11772, // Formato : Tercer Boton 300x100 300x100
                      target:  ''   // Segmentación
                    });
          </script>
          <noscript>
            <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=41700&pgname=home&fmtid=11772&visit=m&tmstp=[timestamp]" border="0" alt="" />
          </noscript>
        </a>
      </div>
      <div class="clear"></div>
      <hr>
    </div><!-- End publicidad-->

    <div class="clear"></div>

    <div class="important-brand col-md-12 content-patrocinadores-destacados">

      <?php foreach($patrocinadores_oro as $patrocinador): ?>
      <?php
      if($patrocinador->PAT_URL_EVENT != '') {
        $url_patrocinador = $base_url . 'redireccionamiento/externo/?url=' . $patrocinador->PAT_HASH_URL_EVENT;
      } else {
        $url_patrocinador = '#';
      }
      ?>
        <div class="wrapper-box col-sm-3 col-xs-12">
          <div class="box" data-id="<?php echo $patrocinador->PAT_ID; ?>">
            <a target="_blank" href="<?php echo $url_patrocinador ?>" onClick="onClickPatrocinador('<?php echo $patrocinador->PAT_ID ?>', '<?php echo $posicion ?>')">
              <img data-original="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" class="lazy-load-image">
              <span>Ir a la tienda</span>
            </a>
          </div>
        </div>
      <?php $posicion++; ?>
      <?php endforeach; ?>

      <div class="clear"></div>
    </div><!-- End important-brand-->

    <div class="clear"></div>

    <div class="comercios col-md-12 content-patrocinadores-destacados">
      <h2>COMERCIOS <small>PARTICIPANTES</small></h2>

      <?php foreach($patrocinadores_plata as $patrocinador): ?>
      <?php
      if($patrocinador->PAT_URL_EVENT != '') {
        $url_patrocinador = $base_url . 'redireccionamiento/externo/?url=' . $patrocinador->PAT_HASH_URL_EVENT;
      } else {
        $url_patrocinador = '#';
      }
      ?>
        <div class="wrapper-box col-sm-2 col-xs-4">
          <div class="box" data-id="<?php echo $patrocinador->PAT_ID; ?>">
            <a target="_blank" href="<?php echo $url_patrocinador ?>" onClick="onClickPatrocinador('<?php echo $patrocinador->PAT_ID ?>', '<?php echo $posicion ?>')">
              <img data-original="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" class="lazy-load-image">
              <span>Ir a la tienda</span>
            </a>
          </div>
        </div>
      <?php $posicion++; ?>
      <?php endforeach; ?>

      <div class="clear"></div>
      <hr>
    </div><!-- End Comercios -->

    <div class="clear"></div>

    <div class="comercios col-md-12 content-patrocinadores-destacados">
      <?php foreach($patrocinadores_bronce as $patrocinador): ?>
      <?php
      if($patrocinador->PAT_URL_EVENT != '') {
        $url_patrocinador = $base_url . 'redireccionamiento/externo/?url=' . $patrocinador->PAT_HASH_URL_EVENT;
      } else {
        $url_patrocinador = '#';
      }
      ?>
        <div class="wrapper-box col-sm-2 col-xs-4">
          <div class="box" data-id="<?php echo $patrocinador->PAT_ID; ?>">
            <a target="_blank" href="<?php echo $url_patrocinador ?>" onClick="onClickPatrocinador('<?php echo $patrocinador->PAT_ID ?>', '<?php echo $posicion ?>')">
              <img data-original="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" class="lazy-load-image">
              <span>Ir a la tienda</span>
            </a>
          </div>
        </div>
      <?php $posicion++; ?>
      <?php endforeach; ?>

      <div class="clear"></div>
      <hr>
    </div><!-- End Comercios -->

    <div class="clear"></div>

    <div class="comercios col-md-12 content-patrocinadores-destacados">
      <?php foreach($patrocinadores_platino as $patrocinador): ?>
      <?php
      if($patrocinador->PAT_URL_EVENT != '') {
        $url_patrocinador = $base_url . 'redireccionamiento/externo/?url=' . $patrocinador->PAT_HASH_URL_EVENT;
      } else {
        $url_patrocinador = '#';
      }
      ?>
        <div class="wrapper-box col-sm-2 col-xs-4">
          <div class="box" data-id="<?php echo $patrocinador->PAT_ID; ?>">
            <a target="_blank" href="<?php echo $url_patrocinador ?>" onClick="onClickPatrocinador('<?php echo $patrocinador->PAT_ID ?>', '<?php echo $posicion ?>')">
              <img data-original="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" class="lazy-load-image">
              <span>Ir a la tienda</span>
            </a>
          </div>
        </div>
      <?php $posicion++; ?>
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
      <?php
      if($patrocinador->PAT_URL_EVENT != '') {
        $url_patrocinador = $base_url . 'redireccionamiento/externo/?url=' . $patrocinador->PAT_HASH_URL_EVENT;
      } else {
        $url_patrocinador = '#';
      }
      ?>
        <div class="wrapper-box">
          <div class="box" data-id="<?php echo $patrocinador->PAT_ID; ?>">
            <a target="_blank" href="<?php echo $url_patrocinador ?>" onClick="onClickPatrocinador('<?php echo $patrocinador->PAT_ID ?>', '<?php echo $posicion ?>')">
              <img data-original="<?php echo $base_url_img_aliados.$patrocinador->PAT_LOGO ?>" class="lazy-load-image">
              <span>Ir a la tienda</span>
            </a>
          </div>
        </div>
      <?php $posicion++; ?>
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
