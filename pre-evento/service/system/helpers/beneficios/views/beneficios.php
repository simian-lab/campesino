        <div class="content_main">
            <article id="offers">
                <?php if(isset($beneficios)): ?>
                    <?php foreach ($beneficios as $beneficio): ?>
                        <ul class="card_list">
                            <li class="card">
                                <a class="link_card_list" href="<?php echo site_url('beneficios/main/get_detalle/'.$beneficio['BEN_ID']); ?>">
                                    <div class="layer_content_1">
                                        <figure class="products"><img src="<?php echo site_url('multimedia/'.$beneficio['IMG_IMAGEN']); ?>"></figure>
                                        <figure class="partner"><img src="<?php echo site_url('multimedia/'.$beneficio['SOC_IMAGEN']); ?>"></figure>
                                    </div>
                                    <div class="layer_content_2 pts<?php echo $beneficio['BEN_PRECIO']; ?>">
                                        <p><?php echo $beneficio['BEN_DESCRIPCION_MEDIANA']; ?></p>
                                    </div>
                                    <div class="layer_content_3 nice"></div>
                                </a>
                            </li>
                        </ul>                      
                    <?php endforeach; ?> 
                <?php else: ?>
                    <p class="message">								
                        Ninguna oferta.
                    </p>
                <?php endif; ?>    

                <nav id="pagination">
                    <?php echo $this->pagination->create_links(); ?> 
                </nav>
            </article>
        </div>
    </section>
</section>