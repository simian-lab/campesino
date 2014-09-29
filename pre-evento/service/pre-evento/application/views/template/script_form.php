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

        if(thisform.elements["val_66010[]"].length != undefined )
        {
            checkbox_len = thisform.elements["val_66010[]"].length;
            for (var i = 0; i < checkbox_len;i++)
            {
                if (thisform.elements['val_66010[]'][i].selected)
                {
                    checkbox = true;
                    break;
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
                
                //setCookie('user','suscription','56000');
                
                //$("#agradecimiento").modal("show");
                $.ajax({
                    type: 'POST',
                    dataType: 'json',                        
                    async :false,
                    url: '<?php echo site_url('home/home/setOrigen'); ?>',
                    success: function(xmldata) {
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
    
    function setCookie(cname,cvalue,exdays)
    {
        var d = new Date();
        d.setTime(d.getTime()+(exdays*24*60*60*1000));
        var expires = "expires="+d.toGMTString();
        document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/";
    }

    function getCookie(cname)
    {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++)
          {
          var c = ca[i].trim();
          if (c.indexOf(name)==0) return c.substring(name.length,c.length);
        }
        return "";
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

    function shareFacebook(){
        var pageTitle = document.title; //HTML page title
        var pageUrl = location.href; //Location of the page

        
        sharetext='Si les gustan las ofertas como a mí no se pueden perder CyberLunes este 19 de mayo. Entérense de las tiendas que van a participar aquí: http://www.cyberlunes.com.co';
        //var shareName = $(this).attr('class').split(' ')[0]; //get the first class name of clicked element
        var shareName= 'facebook';

        //console.log(shareName);
        switch (shareName) //switch to different links based on different social name
        {
            case 'facebook':
                    //ga('send', 'event', 'restaurante/share', 'click', 'facebook');
                var openLink = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle);
                break;  
            
        }
        
        //Parameters for the Popup window
        winWidth    = 650;  
        winHeight   = 450;
        winLeft     = ($(window).width()  - winWidth)  / 2,
        winTop      = ($(window).height() - winHeight) / 2, 
        winOptions   = 'width='  + winWidth  + ',height=' + winHeight + ',top='    + winTop    + ',left='   + winLeft;
        
        //open Popup window and redirect user to share website.
        window.open(openLink,'',winOptions);
        return false;

    }

    function shareTwitter(){
        var pageTitle = document.title; //HTML page title
        var pageUrl = location.href; //Location of the page

        
        var shareName= 'twitter';

        sharetext = 'Ya estoy listo para el próximo @CyberLunesCo este 19 de Mayo. Alístate tu también en http://www.cyberlunes.com.co';

        //console.log(shareName);
        switch (shareName) //switch to different links based on different social name
        {
            case 'twitter':
                var openLink = 'http://twitter.com/home?status=' + encodeURIComponent( sharetext );
                //ga('send', 'event', 'restaurante/share', 'click', 'twitter');
                break;              
            
        }
        
        //Parameters for the Popup window
        winWidth    = 650;  
        winHeight   = 450;
        winLeft     = ($(window).width()  - winWidth)  / 2,
        winTop      = ($(window).height() - winHeight) / 2, 
        winOptions   = 'width='  + winWidth  + ',height=' + winHeight + ',top='    + winTop    + ',left='   + winLeft;
        
        //open Popup window and redirect user to share website.
        window.open(openLink,'',winOptions);
        return false;

    }

    $(document).ready(function(){
        //alert(getCookie('user'))

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
            }
        });

        $('#icon-collapse-form').click(function(){
            $('#collapseOne').toggle();
            if($('#collapseOne').is(':hidden')){
                $('#icon-collapse-form').attr('src', '<?php echo $base_url_static?>img/arrow-up.png');
            }
            else{
                $('#icon-collapse-form').attr('src', '<?php echo $base_url_static?>img/arrow-down.png');
            }
        });
        
       /* if(getCookie('user') && getCookie('user') == 'suscription'){
            //$('#id-form-detalle-mobile').css({display: 'none'});
            //$('#form-collapse').children('section').css({display: 'none'});
            //$('.box-form').addClass('mobile');
            //$('#id-form-detalle-mobile').attr('id','form-collapse');
            //$("#registrate").modal("hide");
            //$('#accordion').css({display: 'none'});
            //$('footer').css({'margin-bottom':'0'});
        }
        else{
           //$('.vistaFormulario').removeClass('mobile');
           //$('#id-form-detalle-mobile').attr('id','id-form-detalle-mobile'); 
        }*/

    });
    
    
</script>