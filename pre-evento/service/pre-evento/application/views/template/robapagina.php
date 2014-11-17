<div class="mainRobaPagina">
	<div class="logo">
		<img src="<?php echo $base_url_static ?>robapagina/img/logo.png" alt="CyberLunes" />
	</div>
	<div class="contenedor">
		<span class="start-day">Lunes 1 de Diciembre</span>
		<div class="countdown">
			<div class="items-time">
				<span class="item" id="dias">00</span>
				<span class="item" id="horas">00</span>
				<span class="item" id="minutos">00</span>
				<span class="item" id="segundos">00</span>
			</div>
			<div class="items-description">
				<span class="item">Días</span>
				<span class="item">Horas</span>
				<span class="item">Min</span>
				<span class="item">Seg</span>
			</div>
		</div>
		<p>Registrate y entérate primero de las ofertas</p>
		<div class="formRobaPagina">
			<form class="formularioRobaPagina" action="http://www.elabs10.com/functions/mailing_list.html" method="post" name="UPTml251013" onSubmit='return (!(UPTvalidateform(document.UPTml251013)));'>
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
                <input type="hidden" name="val_66009" value="on"/>
                <input type="hidden" id="showpopup" value="on" name="showpopup">

				<input type="text" class="form-control" placeholder="E-mail" name="email" />
				<input type="submit" value="Regístrate">
			</form>
		</div>
		<div class="legals">
			<p>Al hacer clic en suscribirte estás aceptando los <a data-target="#terminos" data-toggle="modal" href="#">Términos y condiciones</a> y la <a data-target="#politicas" data-toggle="modal" href="#">política de privacidad</a> del portal.</p>
		</div>
	</div>
</div>

<script type="text/javascript">
	var timespan = countdown( new Date(2014, 11, 01) ,function(ts) {
	                        $('.countdown').find('#dias').html(ts.days)
	                        $('.countdown').find('#horas').html(ts.hours)
	                        $('.countdown').find('#minutos').html(ts.minutes)
	                        $('.countdown').find('#segundos').html(ts.seconds)
	                    } ,countdown.DAYS|countdown.HOURS|countdown.MINUTES|countdown.SECONDS).toString();
</script>