<?php if(!$this->config->item('contingencia')): ?>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="registrate">
    <div class="modal-dialog">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-hidden="true"><img src="<?php echo $base_url_static?>img/close.png" alt=""></a>                    
            <h1>Regístrate en</h1><img src="<?php echo $base_url_static?>img/logo.png" alt="">      
            <h2>Y entérate primero de las ofertas</h2>
            <form action="http://www.elabs10.com/functions/mailing_list.html" method="post" name="UPTml251012" onSubmit='return (!(UPTvalidateform(document.UPTml251012)));'>
                <input type="hidden" name="submitaction" value="3">
                <input type="hidden" name="mlid" value="251010">
                <input type="hidden" name="siteid" value="2010001358">
                <input type="hidden" name="tagtype" value="q2">
                <input type="hidden" name="demographics" value="-1,58933,66010,66009">
                <input type="hidden" name="redirection" value="<?php echo base_url(); ?>gracias">
                <input type="hidden" name="uredirection" value="">
                <input type="hidden" name="welcome" value="">
                <input type="hidden" name="double_optin" value="">
                <input type="hidden" name="append" value="">
                <input type="hidden" name="update" value="on">
                <input type="hidden" name="activity" value="submit">
                <input type="hidden" name="val_66095" value=""/>

                <div class="input">
                    <label class="green" for="">Nombre</label>
                    <input type="text" name="val_58933" placeholder="Nombre" value="" id="nombre_formpopup"/>
                </div>                        
                <div class="input">
                    <label class="green" for="">E-mail</label>
                    <input type="text" name="email" placeholder="Email" value="" />
                </div>                 
                <div class="input">
                    <label style="display: none" for="">intereses</label>
                    <?php if(!$this->agent->is_mobile()): ?>
                    <select name="val_66010[]" id="interes-modal" multiple="multiple">
                        <option value="Tecnologia">Tecnología</option>
                        <option value="Moviles">Móviles</option>
                        <option value="Viajes y turismo">Viajes y turismo</option>
                        <option value="Moda">Moda</option>
                        <option value="Otras categorias">Otras categorías</option>
                    </select>
                    <?php endif; ?>     
                    <?php if($this->agent->is_mobile()): ?>
                    <select name="val_66010[]" id="interes-modal">
                        <option value="" disabled selected>Intereses</option>
                        <option value="Tecnologia">Tecnología</option>
                        <option value="Moviles">Móviles</option>
                        <option value="Viajes y turismo">Viajes y turismo</option>
                        <option value="Moda">Moda</option>
                        <option value="Otras categorias">Otras categorías</option>
                    </select>
                    <?php endif; ?>
                </div>                   
                <div class="intereses">
                    <input type="hidden" name="val_66009" value="on"/>
                    <span>Al hacer clic en suscribirte estás aceptando los <a href="#" data-toggle="modal" data-target="#terminos">términos y condiciones</a> y las <a href="#" data-toggle="modal" data-target="#politicas">politicas de privacidad del portal.</a></span>
                </div>            
                <!--<div class="intereses">
                    <input type="checkbox" name="val_66095"/>
                    <span>Acepto recibir correos de Portales de Casa Editorial El Tiempo.</a></span>
                </div>-->            
                <div class="submit">
                    <input type="hidden" id="showpopup" value="on" name="showpopup">                               
                    <input class="suscribe" type="submit" value="suscríbete" />
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>