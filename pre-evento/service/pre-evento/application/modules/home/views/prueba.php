<table border="0" cellpadding="0" cellspacing="0">
	<form action="http://www.elabs10.com/functions/mailing_list.html" method="post" name="UPTml251010" onSubmit="return (!(UPTvalidateform(document.UPTml251010)));">
        <input type="hidden" name="submitaction" value="3">
        <input type="hidden" name="mlid" value="251010">
        <input type="hidden" name="siteid" value="2010001358">
        <input type="hidden" name="tagtype" value="q2">
        <input type="hidden" name="demographics" value="-1,58933,66010,66009,66095">
        <input type="hidden" name="redirection" value="">
        <input type="hidden" name="uredirection" value="">
        <input type="hidden" name="welcome" value="">
        <input type="hidden" name="double_optin" value="">
        <input type="hidden" name="append" value="">
        <input type="hidden" name="update" value="on">
        <input type="hidden" name="activity" value="submit">

        <tr>
            <td colspan="2">
                <font face="Arial" size="2" color="#000000"> Please fill in the fields below:<br></font>
                <font size=1>(required fields in bold)<br></font>
            </td>
        </tr>
        <tr>
            <td> 
                <font face="Arial" size="2" color="#000000"> <b>Email</b>
            </td>
            <td> 
                <font face="Arial" size="2" color="#000000"> 
                    <input type='text' name='email' value='' size='10'>
            </td>
        </tr>
        <tr>
            <td>
                <font face="Arial" size="2" color="#000000"><b>Nombre</b>
            </td>
            <td>
                <font face="Arial" size="2" color="#000000">
                    <input type="text" name="val_58933" size="10" value="">
            </td>
        </tr>
        <tr>
            <td>
                <font face="Arial" size="2" color="#000000"><b>Intereses</b>
            </td>
            <td>
                <font face="Arial" size="2" color="#000000">
                    <input type="checkbox" name="val_66010[]" value="Tecnologia" >Tecnologia<br>
                    <input type="checkbox" name="val_66010[]" value="Moviles" >Moviles<br>
                    <input type="checkbox" name="val_66010[]" value="Viajes y turismo" >Viajes y turismo<br>
                    <input type="checkbox" name="val_66010[]" value="Moda" >Moda<br>
                    <input type="checkbox" name="val_66010[]" value="Otras categorias" >Otras categorias<br>
            </td>
        </tr>
        <tr>
            <td>
                <font face="Arial" size="2" color="#000000"><b>Acepto terminos y condiciones</b>
            </td>
            <td>
                <font face="Arial" size="2" color="#000000">
                    <input type="checkbox" name="val_66009">
            </td>
        </tr>
        <tr>
            <td>
                <font face="Arial" size="2" color="#000000"><b>Acepto recibir correos de Portales de Casa Editorial El Tiempo</b>
            </td>
            <td>
                <font face="Arial" size="2" color="#000000">
                    <input type="checkbox" name="val_66095">
            </td>
        </tr>
            <input type="hidden" id="showpopup" value="on" name="showpopup">
        <tr>
            <td colspan="2">
                <font face="Arial" size="2" color="#000000">
                    <input type="submit" value="Submit">
            </td>
        </tr>

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
                alert("Email address seems incorrect (check @ and .'s)");
                return false;
            }
            var user=matchArray[1];
            var domain=matchArray[2];
            if (user.match(userPat)==null) {
                alert("The username doesn't seem to be valid.");
                return false;
            }
            var IPArray=domain.match(ipDomainPat);
            if (IPArray!=null) {
                  for (var i=1;i<=4;i++) {
                    if (IPArray[i]>255) {
                        alert("Destination IP address is invalid!");
                    return false;
                    }
                }
                return true;
            }
            var domainArray=domain.match(domainPat);
            if (domainArray==null) {
                alert("The domain name doesn't seem to be valid.");
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
                            alert("The address must end in a three-letter domain, or two letter country.");
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
            	if (thisform.val_58933.value==""){   
            alert("Please enter a value for Nombre");
            return(true);}
                var checkbox = false;
                var checkbox_len = 1;
                if(thisform.elements["val_66010[]"].length != undefined )
            	{
            		checkbox_len = thisform.elements["val_66010[]"].length;
            		for (var i = 0; i < checkbox_len;i++)
            		{
            			if (thisform.elements['val_66010[]'][i].checked)
            			{
            				checkbox = true;
            				break;
            			}
            		}
            	}
            	else
            	{
            		if (thisform.elements['val_66010[]'].checked)
            		{
            			checkbox = true;
            		}
            	}

                if (!checkbox)
                {
                    alert("Please select a value for Intereses");
                    return(true);
                }

            	if (!(thisform.elements['val_66009'].checked))
            	{
            	    alert("Please select a value for Acepto terminos y condiciones");
                    return(true);
                }

            	if (!(thisform.elements['val_66095'].checked))
            	{
            	    alert("Please select a value for Acepto recibir correos de Portales de Casa Editorial El Tiempo");
                    return(true);
                }

            	if (emailCheck(thisform.email.value)) 
            	{	

                    if ((document.getElementById('unsubscribe') 
                        && document.getElementById('unsubscribe').checked) && (document.getElementById('showpopup') && document.getElementById('showpopup').value == "on")) {
            	   	alert('Thank you, now you are unsubscribed!'); 
            	}
            	else if(( (document.getElementById('unsubscribe')
                        && !document.getElementById('unsubscribe').checked) || (!document.getElementById('unsubscribe')) ) && (document.getElementById('showpopup') && document.getElementById('showpopup').value == "on")){
                    	alert('Thank you for signing up!');
                    }
            		return false;
            	}
            	else
            	{
            		return true;
            	}
            }
        </script>
    </form>
</table>