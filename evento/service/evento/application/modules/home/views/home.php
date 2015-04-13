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
    <h3 id="anchor-ofertas-destacadas">OFERTAS <small>DESTACADAS</small></h3>
    <ul>
      <li class="post col-lg-6 col-md-6 col-sm-6 col-sx-12">
        <figure>
          <div class="overlay">
            <p>¡Compra ahora!</p>
            <a href="#" target="_blank" class="link red">ir a oferta</a>
          </div>
          <a style="display: block;" target="_blank" href="#">
            <img src="http://d3b369zdeuh99v.cloudfront.net/multimedia/promociones/173fc-1416953993_imagen.jpg" alt="¡Compra ahora!" title="Cartagena en oferta"></a>
          </figure>
          <article>
            <div class="info">
              <h2>LAN</h2>
            </div>
            <div class="desc">
              <p>Cartagena en oferta</p>

            </div>
            <a href="#" target="_blank" class="link red">ir a oferta</a>
          </article>
        </li>
        <li class="descuento nm  post col-lg-6 col-md-6 col-sm-6 col-sx-12">
          <figure>
            <div class="overlay">
              <p>¡Envío gratis!</p>
              <a href="#" target="_blank" class="link red">ir a oferta</a>
            </div>
            <a style="display: block;" target="_blank" href="#"><img src="http://d3b369zdeuh99v.cloudfront.net/multimedia/promociones/6a371-1416932149_imagen.png" alt="¡Envío gratis!
              " title="INVICTA 17734 para hombre"></a>

            </figure>
            <article>
              <div class="info">
                <h2>Estuyo.com</h2>
              </div>
              <div class="desc">
                <p>INVICTA 17734 para hombre</p>

                <span class="ahora">Ahora $219,900</span> - <span class="antes">Antes $2,130,769</span>
              </div>
              <div class="porcentaje">
                <img src="http://origin-www2.cyberlunes.com.co/static/evento/img/top-percent.png" alt="">
                <span class="num">90</span>
                <span class="signo">%</span>
                <span>Descuento</span>
              </div>
              <a href="#" target="_blank" class="link red">ir a oferta</a>
            </article>
          </li>

          <li class=" post col-lg-6 col-md-6 col-sm-6 col-sx-12">
            <figure>
              <div class="overlay">
                <p>$119.000 Triple Play TV Digital+10Megas+ClaroVideo</p>
                <a href="#" target="_blank" class="link red">ir a oferta</a>
              </div>


              <a style="display: block;" target="_blank" href="#">
                <img src="http://d3b369zdeuh99v.cloudfront.net/multimedia/promociones/08830-1417045245_imagen.jpg" alt="$119.000 Triple Play TV Digital+10Megas+ClaroVideo" title="Compra YA y paga en marzo">
              </a>

            </figure>
            <article>
              <div class="info">
                <h2>Claro</h2>
              </div>
              <div class="desc">
                <p>Compra YA y paga en marzo</p>

                <span class="ahora">Ahora $119,000</span>
              </div>
              <a href="#" target="_blank" class="link red">ir a oferta</a>
            </article>
          </li>

          <li class="descuento nm  post col-lg-6 col-md-6 col-sm-6 col-sx-12">
            <figure>
              <div class="overlay">
                <p>Referencias seleccionadas</p>
                <a href="#" target="_blank" class="link red">ir a oferta</a>
              </div>
              <a style="display: block;" target="_blank" href="#">
                <img src="http://d3b369zdeuh99v.cloudfront.net/multimedia/promociones/98924-1416952309_imagen.jpg" alt="Referencias seleccionadas" title="Televisores LG">
              </a>

            </figure>
            <article>
              <div class="info">
                <h2>Falabella.com</h2>
              </div>
              <div class="desc">
                <p>Televisores LG</p>

              </div>
              <div class="porcentaje">
                <img src="http://origin-www2.cyberlunes.com.co/static/evento/img/top-percent.png" alt="">
                <span class="num">30</span>
                <span class="signo">%</span>
                <span>Descuento</span>
              </div>
              <a href="#" target="_blank" class="link red">ir a oferta</a>
            </article>
          </li>
        </div>
      </div>
    </section>
