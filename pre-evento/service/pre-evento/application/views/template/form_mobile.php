<div class="box-form <?php (isset($hide_form)?print('mobile'):print('')) ?> <?php (isset($class_form_mobile)?print('mobile'):print('')) ?>" id="form-collapse">
    <header>
        <hgroup>
            <h1>SÉ EL PRIMERO EN RECIBIR LAS OFERTAS</h1>
        </hgroup>
    </header>                        
    <section>
        <form action="http://www.elabs10.com/functions/mailing_list.html" method="post" name="UPTml251011" onSubmit='return (!(UPTvalidateform(document.UPTml251011)));'>
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

            <input type="text" name="val_58933" placeholder="Nombre" value="" id="nombre_formmobile"/>
            <input type="text" name="email" placeholder="Email" value="" />
            <?php if(!$this->agent->is_mobile()): ?>
            <select name="val_66010[]" id="interes" multiple="multiple">
                <option value="Tecnologia">Tecnología</option>
                <option value="Moviles">Móviles</option>
                <option value="Viajes y turismo">Viajes y turismo</option>
                <option value="Moda">Moda</option>
                <option value="Otras categorias">Otras categorías</option>
            </select>
            <?php endif; ?>     
            <?php if($this->agent->is_mobile()): ?>
            <select name="val_66010[]" id="interes">
                <option value="" disabled selected>Intereses</option>
                <option value="Tecnologia">Tecnología</option>
                <option value="Moviles">Móviles</option>
                <option value="Viajes y turismo">Viajes y turismo</option>
                <option value="Moda">Moda</option>
                <option value="Otras categorias">Otras categorías</option>
            </select>
            <?php endif; ?>                                 
            <div class="bases">
                <input type="hidden" name="val_66009" value="on"/>
                <span>Al hacer clic en suscribirte estás aceptando los <a href="#" data-toggle="modal" data-target="#terminos">términos y condiciones</a> y la <a href="#" data-toggle="modal" data-target="#politicas">política de privacidad</a> del portal.</span>            
            </div> 
            <!--<div class="bases">
                <input type="checkbox" name="val_66095"/>
                <span>Acepto recibir correos de Portales de Casa Editorial El Tiempo</span>
            </div>-->  
            <input type="hidden" id="showpopup" value="on" name="showpopup">                               
            <input type="submit" value="SUSCRÍBETE" />
        </form>
    </section>
    <footer>
        <img src="<?php echo $base_url_static?>img/bottom-form.png" alt="" />          
    </footer>
</div>