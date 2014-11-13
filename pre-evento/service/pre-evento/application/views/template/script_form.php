<script language="Javascript">
function emailCheck (emailStr) {
    var emailPat=/^(.+)@(.+)$/;
    var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]";
    var validChars="\[^\\s" + specialChars + "\]";
    var quotedUser="(\"[^\"]*\")";
    var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;
    var atom=validChars + '+';
    var word="(" + atom + "|" + quotedUser + ")";
    var userPat=new RegExp("^" + word + "(\\." + word + ")*$");
    var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$");
    var matchArray=emailStr.match(emailPat);
    if (matchArray==null) {
        $('#alerta-form-ingresar-mail').modal('show');
        //alert("Debe ingresar una direccion de correo electrónico");
        return false;
    }
    var user=matchArray[1];
    var domain=matchArray[2];
    if (user.match(userPat)==null) {
        $('#alerta-form-incorrecto-mail').modal('show');
        return false;
    }
    var IPArray=domain.match(ipDomainPat);
    if (IPArray!=null) {
          for (var i=1;i<=4;i++) {
            if (IPArray[i]>255) {
                $('#alerta-form-ip-invalida').modal('show');
              return false;
            }
        }
        return true;
    }
    var domainArray=domain.match(domainPat);
    if (domainArray==null) {
        $('#alerta-form-dominio-invalido').modal('show'); 
        return false;
    }
    var atomPat=new RegExp(atom,"g");
    var domArr=domain.match(atomPat);
    var len=domArr.length;
    if ((domArr[domArr.length-1] != "info") &&
        (domArr[domArr.length-1] != "name") &&
        (domArr[domArr.length-1] != "arpa") &&
        (domArr[domArr.length-1] != "coop") &&
        (domArr[domArr.length-1] != "aero")) {
            if (domArr[domArr.length-1].length<2 ||
                domArr[domArr.length-1].length>3) {
                    $('#alerta-form-direccion-dominio').modal('show'); 
                    //alert("La dirección debe terminar en un dominio de tres letras, o dos letras del país.");
                    return false;
            }
    }
    if (len<2) {
       var errStr="This address is missing a hostname!";
       alert(errStr);
       return false;
    }

    var checkEmail = $.ajax({
                        type: 'POST',
                        data: {email: emailStr},
                        async: false,
                        global: false,
                        url: '<?php echo site_url('formulario_lyris/formulario_lyris/checkEmailExist'); ?>',
                        success: function response(data){}
                    }).responseText;

    var json_data = JSON.parse(checkEmail);
    if(json_data.status.code == 101){
        $('#alerta-form-usuario-registrado').modal();
        return false;
    }
    
    return true;
    }
    function UPTvalidateform(thisform)
    {
        if (thisform.val_58933.value=="" || thisform.val_58933.value=="Nombre"){  
            $('#alerta-form-nombre').modal('show');
            return(true);
        }
        var checkbox = false;
        var checkbox_len = 1;
        var intereses = [];

        if(thisform.elements["val_66010[]"].length != undefined )
        {
            checkbox_len = thisform.elements["val_66010[]"].length;
            for (var i = 0; i < checkbox_len;i++)
            {
                if (thisform.elements['val_66010[]'][i].selected)
                {
                    checkbox = true;
                    intereses.push(thisform.elements['val_66010[]'][i].value);
                }
            }
        }
        else
        {
            if (thisform.elements['val_66010[]'].selected)
            {
                checkbox = true;
            }
        }

        if(thisform.elements['val_66010[]'].value == ''){
            checkbox = false;
        }

        if (!checkbox)
        {
            $('#alerta-form-intereses').modal('show');
            return(true);
        }

        /*if (!(thisform.elements['val_66009'].checked))
        {
            $('#alerta-form-terminos').modal('show');
            return(true);
        }*/

        if (emailCheck(thisform.email.value)) 
        {   

            if ((document.getElementById('unsubscribe') 
                && document.getElementById('unsubscribe').checked) && (document.getElementById('showpopup') && document.getElementById('showpopup').value == "on")) {
                alert('Gracias, ahora usted esta dado de baja!'); 
                
            }
            else if(( (document.getElementById('unsubscribe')
                && !document.getElementById('unsubscribe').checked) || (!document.getElementById('unsubscribe')) ) && (document.getElementById('showpopup') && document.getElementById('showpopup').value == "on")){
                
                
                $.ajax({
                    type: 'POST',                    
                    async :false,
                    dataType: 'html',
                    data: {nombre: thisform.val_58933.value, email: thisform.email.value, intereses: intereses.join(', ')},
                    url: '<?php echo site_url('formulario_lyris/formulario_lyris/setUser'); ?>',
                    success: function(xmldata) {
                        
                        onClickRegistro(thisform.email.value);

                        $.ajax({
                            type: 'POST',
                            dataType: 'json',                        
                            async :false,
                            url: '<?php echo site_url('home/home/setOrigen'); ?>',
                            success: function(xmldata) {
                                return(true);
                            }
                        });

                        return(true);
                    }
                });
            }
            return false;
        }
        else
        {
            return true;
        }
    }
</script>


<script type="text/javascript">
    $('#nombre').alphanum({
        allowNumeric : false,
        disallow     : '',
    });

    $('#nombre_formmobile').alphanum({
        allowNumeric : false,
        disallow     : '',
    });

    $('#nombre_form_bottom').alphanum({
        allowNumeric : false,
        disallow     : '',
    });

    $('#nombre_sorteo').alphanum({
        allowNumeric : false,
        disallow     : '',
    });

    $('#nombre_participacion').alphanum({
        allowNumeric : false,
        disallow     : '',
    });

    $('#nombre_formpopup').alphanum({
        allowNumeric : false,
        disallow     : '',
    });

    $('#id-nombre-contacto').alphanum({
        allowNumeric : false,
        disallow     : '',
    });

    $('#id-telefono').numeric();

    $('#id-celular').numeric();

    function validarEmail(){
        if(document.getElementById('email-form-sorteo').value == ''){
            alert('Debe ingresar una dirección de correo electrónico');
            return false;
        }
        
        return true;
    }

    function validarEmailPart(){
        if(document.getElementById('email-form-participacion').value == ''){
            alert('Debe ingresar una dirección de correo electrónico');
            return false;
        }
        return true;
    }

    
    $(document).ready(function(){
       

        if(typeof String.prototype.trim !== 'function') {
            String.prototype.trim = function() {
            return this.replace(/^\s+|\s+$/g, ''); 
          }
        }

        $('#sas_20592').css({'position':'absolute','bottom':'-302px'});

        var contingencia = '<?php echo $this->config->item('contingencia') ?>';
        
        if(contingencia != 1){
            $.ajax({
                type: 'post',
                url: '<?php echo base_url() ?>home/home/getOrigen',
                dataType: 'json', 
                success: function response(data){
                    if(data['hide_form'] != 1 && data['is_mobile'] != 1){
                        $('.main').removeAttr('style');
                        $('#accordion').show();
                        $('#form-collapse').show();
                        $('#registrate').show();
                    }

                    if(data['hide_form'] == 1){
                        $('#footer_main').css({'margin-bottom':'0'});
                    }
                }
            });
        }
        else{
            $('#footer_main').css({'margin-bottom':'0'});
        }
        

        $('#icon-collapse-form').click(function(){
            $('#collapseOne').toggle();
            if($('#collapseOne').is(':hidden')){
                $('#icon-collapse-form').attr('src', '<?php echo $base_url_static?>img/arrow-up.png');
                $('#footer_main').css({'margin-bottom':'41px'});
            }
            else{
                $('#icon-collapse-form').attr('src', '<?php echo $base_url_static?>img/arrow-down.png');
                $('#footer_main').css({'margin-bottom':'150px'});
            }
        });
        

    });
    
    
</script>

<div class="modal fade" id="uso_marca" style="z-index:2000">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Términos y condiciones para el uso de la marca Cyberlunes&reg;</h4>
            </div>
            <div class="modal-body">
                <p>Por favor descargue y lea estos instructivos para el uso adecuado de la marca y logos de Cyberlunes®. Recuerde que Cyberlunes® es una marca registrada, de uso exclusivo de la Cámara Colombiana de Comercio Electrónico CCCE.</p>
                <br><br>
                <ul>
                    <li>
                        - <a href="<?php echo $url_static;?>multimedia/TERMINOS-Y-CONDICIONES-CYBERLUNES.PDF" target="_blank">Términos y condiciones de uso de la marca (Descargar PDF)</a>
                    </li>
                    <li>
                        - <a href="<?php echo $url_static;?>multimedia/MARCAS-CYBERLUNES-SITE.PDF" target="_blank">Alcance de la marca (Descargar PDF)</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>