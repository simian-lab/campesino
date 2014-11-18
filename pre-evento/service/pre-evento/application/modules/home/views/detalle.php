<section id="detalle">
    <!--<div class="banner">
        <script type="text/javascript">
         sas.call("std", {
          siteId:  '<?php echo $siteId ?>', // 
          pageId:  '<?php echo $pageId ?>', // Página : Cyberlunes_Pre-Evento/home
          formatId:  25757, // Formato : Expandible Derecha Banderole  0x0
          target:  ''   // Segmentación
         });
        </script>
        <noscript>
         <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=<?php echo $siteId ?>&pgname=home&fmtid=25757&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">                
          <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=<?php echo $siteId ?>&pgname=home&fmtid=25757&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
        </noscript>
    </div>-->
    <div class="share">
       <a href="#" onClick='shareFacebook();'><img src="<?php echo $base_url_static;?>img/fb.png" alt=""></a>
       <a href="#"  onClick='shareTwitter("detalle");'><img src="<?php echo $base_url_static;?>img/tw.png" alt=""></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <?php $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : ''; ?>
                    <li><a href="<?php echo base_url().$page; ?>">Home</a></li>
                    <li class="active"><a href="<?php echo current_url() ?>"><?php echo $breadcrumb['ART_TITULO'] ?></a></li>
                </ol>
            </div>
        </div>                            
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <article>
                    <?php foreach($articulo as $articulo): ?>
                    <hgroup>
                        <h1><?php echo $articulo->ART_TITULO ?></h1>
                        <date><?php echo convertirFecha($articulo->ART_FECHA) ?></date>
                    </hgroup>                   
                    <figure>
                        <img src="<?php echo $base_url_img_articulos.$articulo->ART_IMAGEN ?>" alt="">
                    </figure>     
                        <p><?php echo htmlspecialchars_decode($articulo->ART_DETALLE) ?></p>
                    <?php endforeach; ?>
                </article>
            </div>
            <div class="col-lg-4 col-md-12 aside">
                <div class="col-lg-4 col-md-12 publicidades" style="padding:0">
                    <div class="row">
                      
                      <div class="col-sm-6 col-md-12 col-xs-12">
                           <figure class="publi">
                              <div class="titulo-publi">
                                  <span>publicidad</span>
                              </div>
                              <script type="text/javascript">
                               sas.call("std", {
                                siteId:  '<?php echo $siteId ?>', // 
                                pageId:  '<?php echo $pageId ?>', // Página : Cyberlunes_Pre-Evento/convencional
                                formatId:  9344, // Formato : Robapagina 300x250
                                target:  ''   // Segmentación
                               });
                              </script>
                              <noscript>
                               <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=<?php echo $siteId ?>&pgname=convencional&fmtid=9344&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">                
                                <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=<?php echo $siteId ?>&pgname=convencional&fmtid=9344&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
                              </noscript>
                          </figure> 
                      </div>

                      <div class="col-sm-6 col-md-12 col-xs-12">
                          <figure class="publi">
                              <div class="titulo-publi">
                                  <span>publicidad</span>
                              </div>
                              <script type="text/javascript">
                               sas.call("std", {
                                siteId:  '<?php echo $siteId ?>', // 
                                pageId:  '<?php echo $pageId ?>', // Página : Cyberlunes_Pre-Evento/convencional
                                formatId:  9611, // Formato : Robapagina 300x250
                                target:  ''   // Segmentación
                               });
                              </script>
                              <noscript>
                               <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=<?php echo $siteId ?>&pgname=convencional&fmtid=9344&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">                
                                <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=<?php echo $siteId ?>&pgname=convencional&fmtid=9344&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
                              </noscript>
                          </figure>
                          <figure class="publi"> 
                              <div class="titulo-publi">
                                  <span>publicidad</span>
                              </div>
                              <script type="text/javascript">
                               sas.call("std", {
                                siteId:  '<?php echo $siteId ?>', // 
                                pageId:  '<?php echo $pageId ?>', // Página : Cyberlunes_Pre-Evento/convencional
                                formatId:  9608, // Formato : Robapagina 300x250
                                target:  ''   // Segmentación
                               });
                              </script>
                              <noscript>
                               <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=<?php echo $siteId ?>&pgname=convencional&fmtid=9344&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">                
                                <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=<?php echo $siteId ?>&pgname=convencional&fmtid=9344&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
                              </noscript>
                          </figure>
                          <figure class="publi">
                              <div class="titulo-publi">
                                  <span>publicidad</span>
                              </div>
                              <script type="text/javascript">
                               sas.call("std", {
                                siteId:  '<?php echo $siteId ?>', // 
                                pageId:  '<?php echo $pageId ?>', // Página : Cyberlunes_Pre-Evento/convencional
                                formatId:  11772, // Formato : Robapagina 300x250
                                target:  ''   // Segmentación
                               });
                              </script>
                              <noscript>
                               <a href="http://ads.eltiempo.com/ac?jump=1&nwid=484&siteid=<?php echo $siteId ?>&pgname=convencional&fmtid=9344&visit=m&tmstp=[timestamp]&out=nonrich" target="_blank">                
                                <img src="http://ads.eltiempo.com/ac?out=nonrich&nwid=484&siteid=<?php echo $siteId ?>&pgname=convencional&fmtid=9344&visit=m&tmstp=[timestamp]" border="0" alt="" /></a>
                              </noscript> 
                          </figure>  
                      </div>

                    </div>
                </div>   

                <div class="clearfix"></div>            
                   
                <div class="articulos">
                    <h1><b>Artículos</b> relacionados</h1>
                    <ul>
                        <?php foreach($articulos_recomendados as $articulo_recomendado): ?>
                        <li class="col-lg-12 col-md-4 col-sm-4">
                            <figure class="col-lg-6 col-md-6 col-sm-6">
                                <a href="<?php echo base_url().'detalle/'.$articulo_recomendado->ART_SLUG ?>"><img border="0" src="<?php echo $base_url_tod?>?src=<?php echo ($base_url_img_articulos.$articulo_recomendado->ART_IMAGEN); ?>&amp;w=130&amp;h=145&amp;zc=1&amp;" alt=""></a>
                                <img src="<?php echo $base_url_static?>img/border-btn-leermas.png" class="border-impacto">
                            </figure>
                            <aside class="col-lg-6 col-md-6 col-sm-6">
                                <hgroup>
                                    <a href="<?php echo base_url().'detalle/'.$articulo_recomendado->ART_SLUG ?>"><h3><?php echo $articulo_recomendado->ART_TITULO ?></h3></a>
                                    <date><?php echo convertirFecha($articulo_recomendado->ART_FECHA) ?></date>                                   
                                </hgroup>
                                <div class="desc">
                                    <p><?php echo $articulo_recomendado->ART_DESCRIPCION ?></p>
                                </div>
                                <div class="leer-mas">
                                    <a href="<?php echo base_url().'detalle/'.$articulo_recomendado->ART_SLUG ?>">Leer <b>Más</b></a>
                                </div>
                            </aside>                                    
                        </li>
                        <?php endforeach; ?>
                        <div class="fix"></div>
                    </ul>
                </div>        
            </div>
        </div>
    </div>            
</section>