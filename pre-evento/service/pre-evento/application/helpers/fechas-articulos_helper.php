<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    
function convertirFecha($fecha){

    $fecha = explode('-',$fecha);
    $meses = array(
        '01'    =>   'Enero',
        '02'    =>   'Febrero',
        '03'    =>   'Marzo',
        '04'    =>   'Abril',
        '05'    =>   'Mayo',
        '06'    =>   'Junio',
        '07'    =>   'Julio',
        '08'    =>   'Agosto',
        '09'    =>   'Septiembre',
        '10'    =>   'Octubre',
        '11'    =>   'Noviembre',
        '12'    =>   'Diciembre');
    $mes = $meses[$fecha[1]];
    $dia = substr($fecha[2], 0, 2);
    $año = $fecha[0];
    $fechaArt = $mes.' '.$dia.' de '.$año;

    return $fechaArt;
}
