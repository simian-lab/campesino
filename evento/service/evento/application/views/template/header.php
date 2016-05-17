<!--[if lt IE 9]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
<div class="mastercard">
  <div class="container">
    <div class="row">
    <script type="text/javascript">

    if (document.body.clientWidth >= 930) {
            sas_pageid = '57473/592107'; // Página : LoEncontraste/especiales
            sas_formatid = '21675';  // Formato : Push Down Top 960x90
            sas_target = '';   // Segmentación
        } else {
            sas_pageid = ' 57473/592107'; // Página : LoEncontraste/especiales
            sas_formatid = '8941';  // Formato : Push Down Top 960x90
            sas_target = '';   // Segmentación
        }
    SmartAdServerAjax(sas_pageid,sas_formatid,sas_target);
    </script>
    </div>
  </div>
</div>
<header>
  <div class="container">
    <div class="row head">
      <div class="col-md-3 col-sm-6 col-xs-6 logo">
        <a href="<?php echo $base_url;?>" onclick="clickHeader('logo LOE')">
          <img src="<?php echo $base_url_static?>img/logo.png" alt="cybermonday">
        </a>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-6 title">
        <?php if(!$this->agent->is_mobile()): ?>
          <span><?php echo TAG_LINE ?></span>
        <?php endif; ?>
      </div>
      <div class="col-md-6 marcas">
        <!--<figure>
          <a href="https://www.bbva.com.co/web/personas/tarjetas/promociones/cyberlunes" target="_blank" onclick="onClickPublicidad('BBVA', 'Header')"><img src="<?php echo $base_url_static;?>img/BBVA_87X35.png" alt="BBVA" /></a>
        </figure>
        <figure>
          <a href="http://www.mintic.gov.co" target="_blank" onclick="onClickPublicidad('MinTIC', 'Header')"><img src="<?php echo $base_url_static;?>img/mintic.png" alt="MinTIC" /></a>
        </figure>
        <figure>
          <a href="http://www.vivedigital.gov.co" target="_blank" onclick="onClickPublicidad('Vive digital', 'Header')"><img src="<?php echo $base_url_static;?>img/digital.png" alt="Vive digital" /></a>
        </figure>
        <figure>
          <a href="http://wsp.presidencia.gov.co" target="_blank" onclick="onClickPublicidad('Gobierno de Colombia', 'Header')"><img src="<?php echo $base_url_static;?>img/colombia.png" alt="Gobierno de Colombia" /></a>
        </figure>-->
      </div>
    </div>
  </div>
</header>

<!-- MENU -->
<?php echo $menu_html;?>

<!-- FIN MENU -->

<div class="share">
  <a onClick='shareFacebook();' href="#" class="button_facebook_top"><img src="<?php echo $base_url_static ?>img/social_fb.png" alt=""></a>
  <a onClick='shareTwitter();'  href="#" class="button_twitter_top"><img src="<?php echo $base_url_static ?>img/social_tw.png" alt=""></a>
</div>

