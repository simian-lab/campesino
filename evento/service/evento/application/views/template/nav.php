<!-- MENU -->
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
                    <ul>
                        <?php foreach($categorias as $categoria):  ?>
                            <li><a href="#" onClick='s.eVar28="<?php echo $categoria->CAT_NOMBRE; ?>"'><?php echo htmlentities($categoria->CAT_NOMBRE, ENT_QUOTES); ?></a></li>
                        <?php endforeach; ?>
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
<!-- FIN MENU -->   