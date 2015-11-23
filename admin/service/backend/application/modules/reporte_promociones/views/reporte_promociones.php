<style>.DTTT_container {display: none;}</style>
<a href="reporte_promociones/export"><button>Exportar</button></a>
<?php
	if(isset($output->output)) {
		echo $output->output;
	}
	else {
		echo $output;
	}
?>