<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    
function get_combobox($year='',$id=''){
    $combobox = '';
    
    if($year=='')$year = date('Y');
    
    for($i=$year; $i<($year+10); $i++)
        if($id==$i)
            $combobox .= '<option value="'.$i.'" selected="selected">'.$i.'</option>';
        else
            $combobox .= '<option value="'.$i.'">'.$i.'</option>';
    
    return $combobox;
} 

function date_dia_espanol($dia){
    
    if ($dia=="Monday") $dia="Lunes";
    if ($dia=="Tuesday") $dia="Martes";
    if ($dia=="Wednesday") $dia="Miércoles";
    if ($dia=="Thursday") $dia="Jueves";
    if ($dia=="Friday") $dia="Viernes";
    if ($dia=="Saturday") $dia="Sabado";
    if ($dia=="Sunday") $dia="Domingo";

    return $dia;
}

function date_mes_espanol($mes){
    
    if ($mes=="January") $mes="Enero";
    if ($mes=="February") $mes="Febrero";
    if ($mes=="March") $mes="Marzo";
    if ($mes=="April") $mes="Abril";
    if ($mes=="May") $mes="Mayo";
    if ($mes=="June") $mes="Junio";
    if ($mes=="July") $mes="Julio";
    if ($mes=="August") $mes="Agosto";
    if ($mes=="September") $mes="Setiembre";
    if ($mes=="October") $mes="Octubre";
    if ($mes=="November") $mes="Noviembre";
    if ($mes=="December") $mes="Diciembre";  
    
    return $mes;
}

function format_date($date){
    $day = substr($date,8, 2);
    $month = substr($date,5, 2);
    $year = substr($date,0, 4);
 
    $format_date = $day.'/'.$month.'/'.$year;
    
    return $format_date;
}

function add_months_to_date($orgDate,$mth){ 
  $cd = strtotime($orgDate); 
  $retDAY = date('d/m/Y H:i:s', mktime(0,0,0,date('m',$cd)+$mth,date('d',$cd),date('Y',$cd))); 
  return $retDAY; 
} 
