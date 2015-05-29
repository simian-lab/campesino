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
  <div class="container">
    <div class="wrapper-filter">
      <img src="<?php echo $base_url_static;?>img/extra-left-filter.png" class="extra-left" style="
      ">
      <img src="<?php echo $base_url_static;?>img/extra-right-filter.png" class="extra-right" style="
      ">
      <div class="filter row col-md-12">
        <div class="item-filter <?php if(empty($subCategorias)) { echo 'col-sm-4 col-sm-offset-1'; } else {echo 'col-sm-3 col-xs-12';} ?>">
          <?php echo $tiendas ?>
        </div>

        <div class="item-filter <?php if(empty($subCategorias)) { echo 'col-sm-4 col-xs-12'; } else {echo 'col-sm-3 col-xs-12';} ?>">
          <?php echo $marcas ?>
        </div>

        <?php echo $subCategorias ?>

        <div class="button-search <?php if(empty($subCategorias)) { echo 'col-sm-2 col-xs-12'; } else {echo 'col-sm-3 col-xs-12';} ?>" id="buscarOfertaButton" name="buscarOfertaButton">
          <input type="submit" name="Buscar" value="Buscar">
        </div>
      </div><!--End Filter-->
    </div><!-- End wrapper Filter-->

    <div class="menu-tabs">
      <ul>
        <li>
          <a href="<?php echo $base_url;?>" onclick="onClickTodasLasTiendas()" >TODAS LAS TIENDAS</a>
        </li>
        <li class="active">
          <a href="<?php echo $base_url."descuentos"?>" onclick="onClickTabTodasLasOfertas()" >TODAS LAS OFERTAS</a>
        </li>
      </ul>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <ol class="breadcrumb">
          <?php if(!empty($breadcrumb)): ?>
            <li><a href="<?php echo $base_url ?>">Inicio</a></li>
          <?php endif; ?>

          <?php foreach($breadcrumb as $item): ?>
            <?php if($item != '' && end($breadcrumb) == $item): ?>
              <li class="active"><?php echo $item ?></li>
            <?php elseif($item != '' && end($breadcrumb) != $item): ?>
              <li><a href="<?php ($this->uri->segment(2)!='todos')?print($base_url.'descuentos/'.$this->uri->segment(2)):'#' ?>"><?php echo $item ?></a></li>
            <?php endif; ?>
          <?php endforeach; ?>

        </ol>

        <?php //echo set_breadcrumb(); ?>

      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">

        <?php echo $promocionespremium_html ?>

      </div>
    </div>
  </div>
</section>
<?php if(!isset($publicidad_categoria) && !isset($publicidad_home)): ?>
  <div class="publi">
    <div class="container">
      <div class="row">
        <div id="slide-publi">
          <div class="item">
            <!--<a href="#" target="_blank"><img src="<?php echo $base_url_static;?>img/publicidad1.jpg" alt="Owl Image"></a>-->
            <div class="publi-content">
              <div class="titulo-publicidad">
                <span>Publicidad</span>
              </div>
              <script type="text/javascript">
                sas.call("std", {
                  siteId:  41700, //
                  pageId:  282275, // Página : Cyberlunes/home
                  formatId:  9611, // Formato : Primer Boton 300x100 300x100
                  target:  ''   // Segmentación
                });
              </script>
              <noscript>
                <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=41700&pgname=home&fmtid=9611&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">
                  <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=41700&pgname=home&fmtid=9611&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
                </noscript>
              </div>
            </div>
            <div class="item">
              <!--<a href="#" target="_blank"><img src="<?php echo $base_url_static;?>img/publicidad2.jpg" alt="Owl Image"></a>-->
              <div class="publi-content">
                <div class="titulo-publicidad">
                  <span>Publicidad</span>
                </div>
                <script type="text/javascript">
                  sas.call("std", {
                    siteId:  41700, //
                    pageId:  282275, // Página : Cyberlunes/home
                    formatId:  9608, // Formato : Segundo Boton 300x100 300x100
                    target:  ''   // Segmentación
                  });
                </script>
                <noscript>
                  <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=41700&pgname=home&fmtid=9608&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">
                    <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=41700&pgname=home&fmtid=9608&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
                  </noscript>
                </div>
              </div>
              <div class="item">
                <!--<a href="#" target="_blank"><img src="<?php echo $base_url_static;?>img/publicidad3.jpg" alt="Owl Image"></a>-->
                <div class="publi-content">
                  <div class="titulo-publicidad">
                    <span>Publicidad</span>
                  </div>
                  <script type="text/javascript">
                    sas.call("std", {
                      siteId:  41700, //
                      pageId:  282275, // Página : Cyberlunes/home
                      formatId:  11772, // Formato : Tercer Boton 300x100 300x100
                      target:  ''   // Segmentación
                    });
                  </script>
                  <noscript>
                    <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=41700&pgname=home&fmtid=11772&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">
                      <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=41700&pgname=home&fmtid=11772&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
                    </noscript>
                  </div>
                </div>
              </div>
              <a href="#" class="btn next">
                <img src="<?php echo $base_url_static;?>img/btn-slider_right.png" alt="">
              </a>
              <a href="#" class="btn prev">
                <img src="<?php echo $base_url_static;?>img/btn-slider_left.png" alt="">
              </a>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <?php if(isset($publicidad_categoria) && !isset($publicidad_home) ): ?>
        <div class="container pauta">
          <div class="row">
            <div class="col-lg-12">
              <img src="<?php echo $base_url_static;?>img/publi_left.jpg" class="img-publi" alt="Publicidad" />
              <h3 class="title-superbanner">Publicidad</h3>
                <script type="text/javascript">
                 sas.call("std", {
                  siteId:  41700, // 
                  pageId:  439812, // Página : Cyberlunes/categoria
                  formatId:  31982, // Formato : Superbanner categoria 960x90
                  target:  'tecnologia'   // Segmentación
                  seccion:  'tecnologia'   // Segmentación
                  categoria:  'tecnologia'   // Segmentación
                  
                 });
                </script>
                <h1>Gio</h1>
                <noscript>
                  <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=41700&pgname=categoria&fmtid=31982&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">                
                    <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=41700&pgname=categoria&fmtid=31982&visit=m&tmstp=[timestamp]" border="0" alt="" />
                  </a>
                </noscript>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <section class="wrapp">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <?php echo $promocionesgenerales_html ?>
              </div>
            </div>

            <div class="row banner">
              <div class="col-lg-12">
                <script type="text/javascript">
                  sas.call("std", {
                    siteId:  41700, //
                    pageId:  282275, // Página : Cyberlunes/home
                    formatId:  8941, // Formato : Barra Fija 960x30
                    target:  ''   // Segmentación
                  });
                </script>
                <noscript>
                  <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=41700&pgname=home&fmtid=8941&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">
                    <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=41700&pgname=home&fmtid=8941&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
                </noscript>
              </div>
            </div>

          </div>
        </section>
