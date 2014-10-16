
		<div style="z-index:2000" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="agradecimiento">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <span><b>Gracias</b> por inscribirte</span>  
		            <p>Antes del inicio de CyberLunes recibirás <br> promociones en tu categoría elegida.</p>
		            <!--i>Estás siendo direccionado a la página principal</i-->
		        </div>
		    </div>
		</div>


		<script type="text/javascript">

		    $(document).ready(function(){
		    	 $("#agradecimiento").modal("show");  

	
				window.setTimeout(function () {
			        $("#agradecimiento").modal("hide");
			    }, 3000);		     


		    });
		    


		</script>
