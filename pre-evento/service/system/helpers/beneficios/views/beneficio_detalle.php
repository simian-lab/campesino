        <section id="content_benefice">

            <div id="partners_header">

                <nav id="partners_nav">
                    <ul>
                        <li class="bt_previous"> < Anterior</li>
                        <li class="bt_next">Próximo ></li>
                    </ul>
                </nav>    
                <div class="content_head">
                 <div class="pri">
                        <h1>
                            <?php echo $beneficio['BEN_NOMBRE']; ?>
                            <span><?php echo $beneficio['BEN_DESCRIPCION_MINI']; ?></span>
                        </h1>
                        <h4><?php echo $beneficio['BEN_DESCRIPCION_MEDIANA']; ?></h4>
                    </div>
                    <div class="sec">
                        <figure><img src="<?php echo site_url('multimedia/'.$beneficio['SOC_IMAGEN']); ?>"></figure>
                    </div>    

                </div>   
                <nav class="social_options">
                    <div class="social">
                        <ul>
                            <li><span>Compartir</span><li>
                            <li><a href="" class="tw">twitter</a></li>
                            <li><a href="" class="fbk">facebook</a></li>
                        </ul>    
                    </div>

                </nav>

            </div>                           

            <!-- Code Slider -->
            <?php if(isset($slide)): ?>
            <div id="benefit" class="theme-default">
                <div id="slider" class="nivoSlider">
                    <?php foreach ($slide as $imagen): ?>
                         <a href=""><img src="<?php echo site_url('multimedia/'.$imagen['IMG_IMAGEN']); ?>" data-thumb="<?php echo site_url('multimedia/'.$imagen['IMG_IMAGEN']); ?>" alt="" /></a>
                    <?php endforeach; ?>
                </div>                                
            </div>
            <? endif; ?>
            <!-- End Code --> 

            <div class="como_participar">
                <h4>Como participar</h4>
                <?php echo $beneficio['BEN_COMO_PARTICIPAR']; ?>
            </div>
            <?php if($this->tank_auth->is_logged_in()): ?>
                <div class="points">
                    <a href="#puntos" class="button_icon_left fancybox">Cambiar sus articulos</a>
                </div>
            <?php endif; ?>
            <div class="prod_asociados">

                <p>Para ver todos los productos que estan asociados haga <a href="http://<?php echo $beneficio['BEN_URL']; ?>" target="_blank">click aquí</a></p>

            </div>

            <section id="detail_benefit">
                <div class="top_detail">
                    <a href="javascript:void(0)" class="bt_slider bt_close">Abrir</a>
                    <h5>Los detalles de este beneficio</h5>
                </div>
                <div class="content_slx">
                    <div class="content_help">
                        <?php echo $beneficio['BEN_DESCRIPCION_LARGA']; ?>
                    </div>
                </div>
            </section>

            <div class="pie">
                <ul>
                    <li><a href="#preguntas" class="action_link fancybox">Preguntas más frecuentes</a></li>
                    <li><a href="#terminos" class="action_link fancybox">Términos y condiciones</a></li>
                    <?php if($beneficio['BEN_REEMBOLSO_SMS']==1): ?>
                        <!-- <li><a href="#sms" class="action_link fancybox">Reembolso por sms</a></li>-->
                    <?php endif; ?>
                </ul>
                <p>Todos los productos están sujetos a disponibilidad de stock. Fotos meramente ilustrativas</p>
            </div>
        </section>
    </section>
</section>


<div id="preguntas" style="width:610px; display: none;" class="modal_default">
    <div class="titulomodal">PREGUNTAS FRECUENTES</div>
    <?php echo $beneficio['BEN_NOMBRE']; ?>
    <hr></hr>
    <div class="content">
               
        <div id="scrollbar1">
            <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
            <div class="viewport">
                <div class="overview"><?php echo nl2br($beneficio['BEN_PREGUNTAS_FRECUENTES']); ?><?php echo nl2br($beneficio['BEN_PREGUNTAS_FRECUENTES']); ?><?php echo nl2br($beneficio['BEN_PREGUNTAS_FRECUENTES']); ?><?php echo nl2br($beneficio['BEN_PREGUNTAS_FRECUENTES']); ?><?php echo nl2br($beneficio['BEN_PREGUNTAS_FRECUENTES']); ?><?php echo nl2br($beneficio['BEN_PREGUNTAS_FRECUENTES']); ?><?php echo nl2br($beneficio['BEN_PREGUNTAS_FRECUENTES']); ?><?php echo nl2br($beneficio['BEN_PREGUNTAS_FRECUENTES']); ?><?php echo nl2br($beneficio['BEN_PREGUNTAS_FRECUENTES']); ?><?php echo nl2br($beneficio['BEN_PREGUNTAS_FRECUENTES']); ?></div>
            </div>
        </div>
    </div>
</div>

<div id="terminos" style="width:610px; display: none;" class="modal_default">
    <div class="titulomodal">TERMINOS Y CONDICIONES</div>
    <?php echo $beneficio['BEN_NOMBRE']; ?>
    <hr></hr>
    <div class="content">
               
        <div id="scrollbar2">
            <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
            <div class="viewport">
                <div class="overview"><?php echo nl2br($beneficio['BEN_TERMINOS_Y_CONDICIONES']); ?></div>
            </div>
        </div>
    </div>
</div>

<div id="sms" style="width:610px; display: none;" class="modal_default">
    <div class="titulomodal">REEMBOLSO POR SMS</div>
    <?php echo $beneficio['BEN_NOMBRE']; ?>
    <hr></hr>
    <div class="content">
               
        <div id="scrollbar3">
            <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
            <div class="viewport">
                <div class="overview">
                    <ul>
                    <li>Envie um SMS* para o número 50035 com o nome do parceiro que oferece o produto ou serviço que você deseja trocar seus pontos.</li>
                    <li>Receba no seu celular o número do voucher.</li>
                    <li>Apresente os vouchers resgatados via SMS no ponto de venda ou insira seu número no campo apropriado no site do parceiro.</li>
                </ul>                    
                </div>
            </div>
        </div>
    </div>
</div>


<div id="puntos" style="width:470px; display: none;" class="modal_default">
    <header>
       <h3>Confirmación</h3>
   </header>
   <div class="content">
       <form id="form_change" method="POST" action="<?php echo site_url('vouchers/main/generar_voucher'); ?>">
        <p>En este rescate le deducirá de su cuenta los siguientes puntos</p>
        <h2>Oferta &bull; <?php echo $beneficio['BEN_PRECIO']; ?> Puntos</h2><br> 
        <input type="hidden" name="BEN_ID" value="<?php echo  $beneficio['BEN_ID']; ?>" />
        <input type="submit" class="btn_icon_left" />
       </form>
   </div>
</div>

<script>
    $('.bt_slider').click(function() {
        $('.content_slx').toggle('slow');
    });

</script>

