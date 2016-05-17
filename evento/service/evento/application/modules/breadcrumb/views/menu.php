<div id="menu">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="menu-head">
          <span class="title">Inicio</span>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-9 col-md-9">
        <nav class="navbar-collapse collapse">
          <ul id="menuTop">
            <li class="item-menu-current">
              TODAS LAS OFERTAS
            </li>
            <?php if(isset($resultCategoriasFija)): ?>
              <?php foreach ($resultCategoriasFija as $item): //var_dump($this->uri->segment(2));
                if($this->uri->segment(2) == $item['CAT_SLUG']) {
                  $class = 'active';
                }
                else {
                  $class = '';
                }
                ?>
                <li class="<?php echo $class_active ?>">
                  <a onClick='s.eVar28="<?php htmlentities(echo $item['CAT_NOMBRE'], ENT_QUOTES) ?>"' href="<?php echo base_url('descuentos/'.$item['CAT_SLUG']);?>"><?php echo htmlentities($item['CAT_NOMBRE'], ENT_QUOTES); ?></a>
                </li>
              <?php endforeach; ?>
            <?php endif; ?>
            <?php
            $class_active = '';
            foreach ($resultCategoriasSubMenu as $item){
              if($this->uri->segment(2) == $item['CAT_SLUG']){
                $class_active = 'class="active"';
              }
            }
            ?>
            <li <?php echo $class_active ?>>
              <a href="#" data-toggle="dropdown">Otras categorías</a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                <?php if(isset($resultCategoriasSubMenu)): ?>
                  <?php foreach ($resultCategoriasSubMenu as $item): ?>
                    <li>
                      <a onClick='s.eVar28="<?php echo htmlentities($item['CAT_NOMBRE'], ENT_QUOTES) ?>"' href="<?php echo base_url('descuentos/'.$item['CAT_SLUG']);?>"><?php echo htmlentities($item['CAT_NOMBRE'], ENT_QUOTES); ?></a>
                    </li>
                  <?php endforeach; ?>
                <?php endif; ?>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
      <div class="col-lg-3">
        <div class="sponsor right">
          <span>Evento de:</span>
          <a href="http://ccce.org.co/" target="_blank"><img src="<?php echo $base_url_static;?>img/camara-de-comercio.png" alt=""></a>
        </div>
      </div>
    </div>
  </div>
</div>