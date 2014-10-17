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
                        /*switch(thisform.name){
                            case 'UPTml272461_home':
                                onClickRegistro("Ventana", "Home", intereses.join(', '));
                                break;
                            case 'UPTml272461_footer1':
                            case 'UPTml272461_footer2':
                                onClickRegistro("Barra inferior", "Footer", intereses.join(', ')); 
                                break;
                            case 'UPTml272461_mobile':
                                onClickRegistro("Mobile", "Home", intereses.join(', '));
                                break;
                            case 'UPTml272461_popup':
                                onClickRegistro("Pop up", "Detalle artículo", intereses.join(', ')); 
                                break;
                        }*/

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