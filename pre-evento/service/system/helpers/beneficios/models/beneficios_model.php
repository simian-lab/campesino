<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Beneficios_model extends CI_Model{

    function get_socios(){

        $query = $this->db->get('SOC_SOCIO');

        if ($query->num_rows() > 0) return $query->result_array();
        
        return NULL;
    }    
    
    function get_categorias($limit=''){
        if($limit!='') $this->db->limit($limit);
        
        $this->db->order_by("CAT_ORDEN", "ASC");
        $query = $this->db->get('CAT_CATEGORIA');

        if ($query->num_rows() > 0) return $query->result_array();
        
        return NULL;
    }
        
    function getnumRows($categoria,$searchOp, $searchCampo, $searchString){
        
        if($searchOp!=''){
            $search = ' AND '.$this->_compare($searchCampo, $searchOp, $searchString);
        }else{
            $search = ' ';
        }
        if($categoria!=''){
            $sql ="SELECT  COUNT(*) AS CANT
                    FROM BEN_BENEFICIO t1
                        INNER JOIN SOC_SOCIO t2 ON(t2.ID = t1.SOC_ID)
                        INNER JOIN BXC_BENXCAT t3 ON (t1.BEN_ID = t3.BEN_ID)
                        INNER JOIN CAT_CATEGORIA t4 ON (t3.CAT_ID = t4.ID AND CAT_ID=".$categoria.")
                        WHERE t1.BEN_ACTIVO = 1".$search; 
        }else{       
            $sql ="SELECT  COUNT(*) AS CANT
                    FROM BEN_BENEFICIO t1
                        INNER JOIN SOC_SOCIO t2 ON(t2.ID = t1.SOC_ID)
                        WHERE t1.BEN_ACTIVO = 1".$search;            
        }

                
        $query = $this->db->query($sql);
        
        return $query->row_array();
     
    }
    
    function get_beneficios($per_page,$offset,$categoria,$searchOp, $searchCampo, $searchString){
   
        if(empty($offset))
            $desde = 1;
        else
            $desde = $offset;
		
		$offset = (($desde - 1) * $per_page);
        
        if($searchOp!=''){
            $search = ' AND '.$this->_compare($searchCampo, $searchOp, $searchString);
        }else{
            $search = ' ';
        }
        if($categoria!=''){
             $sql ="SELECT  
                        t1.BEN_ID, t1.BEN_PRECIO, t1.BEN_NOMBRE, t1.BEN_DESCRIPCION_MEDIANA,
                        t2.SOC_IMAGEN, 
                        (SELECT tt1.IMG_IMAGEN FROM IMG_IMAGEN tt1 WHERE tt1.BEN_ID = t1.BEN_ID AND tt1.IMG_TIPO='L' LIMIT 1) AS IMG_IMAGEN
                    FROM BEN_BENEFICIO t1
                        INNER JOIN SOC_SOCIO t2 ON(t2.ID = t1.SOC_ID)
                        INNER JOIN BXC_BENXCAT t3 ON (t1.BEN_ID = t3.BEN_ID)
                        INNER JOIN CAT_CATEGORIA t4 ON (t3.CAT_ID = t4.ID AND CAT_ID=".$categoria.")                        
                        WHERE t1.BEN_ACTIVO = 1".$search."
                    LIMIT " . $offset . "," .$per_page ;
        }else{    
             $sql ="SELECT  
                        t1.BEN_ID, t1.BEN_PRECIO, t1.BEN_NOMBRE, t1.BEN_DESCRIPCION_MEDIANA,
                        t2.SOC_IMAGEN, 
                        (SELECT tt1.IMG_IMAGEN FROM IMG_IMAGEN tt1 WHERE tt1.BEN_ID = t1.BEN_ID AND tt1.IMG_TIPO='L' LIMIT 1) AS IMG_IMAGEN
                    FROM BEN_BENEFICIO t1
                        INNER JOIN SOC_SOCIO t2 ON(t2.ID = t1.SOC_ID)
                        WHERE t1.BEN_ACTIVO = 1".$search."
                    LIMIT " . $offset . "," .$per_page ;
        }      

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) return $query->result_array();
        
        return NULL;
    }
    
    function get_beneficio($beneficio){
                
         $sql ="SELECT  
                    t1.BEN_ID, t1.BEN_PRECIO, t1.BEN_NOMBRE, t1.BEN_DESCRIPCION_MINI, 
                    t1.BEN_DESCRIPCION_MEDIANA, t1.BEN_COMO_PARTICIPAR,  t1.BEN_DESCRIPCION_LARGA,
                    t1.BEN_URL, t1.BEN_PREGUNTAS_FRECUENTES, t1.BEN_TERMINOS_Y_CONDICIONES, t1.BEN_REEMBOLSO_SMS,
                    t2.SOC_IMAGEN
                FROM BEN_BENEFICIO t1
                    INNER JOIN SOC_SOCIO t2 ON(t2.ID = t1.SOC_ID)
                WHERE t1.BEN_ID=".$beneficio;
   

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) return $query->row_array();
        
        return NULL;
    }    
    
    function get_beneficio_imagenes($beneficio){
         $sql ="SELECT IMG_IMAGEN FROM IMG_IMAGEN WHERE BEN_ID =".$beneficio." AND IMG_TIPO='D'";
   

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) return $query->result_array();
        
        return NULL;        
    }
    
    function _compare($searchFieldValue, $searchOper, $searchString) {
        if ($searchOper == 'eq') {
            return ' ' . $searchFieldValue . ' = \'' . $searchString . '\'';
        }
        if ($searchOper == 'ne') {
            return ' ' . $searchFieldValue . ' <> \'' . $searchString . '\'';
        }
        if ($searchOper == 'lt') {
            return ' ' . $searchFieldValue . ' < \'' . $searchString . '\'';
        }
        if ($searchOper == 'le') {
            return ' ' . $searchFieldValue . ' <= \'' . $searchString . '\'';
        }
        if ($searchOper == 'gt') {
            return ' ' . $searchFieldValue . ' > \'' . $searchString . '\'';
        }
        if ($searchOper == 'ge') {
            return ' ' . $searchFieldValue . ' => \'' . $searchString . '\'';
        }
        if ($searchOper == 'bw') {
            return ' ' . $searchFieldValue . ' LIKE \'' . $searchString . '%\'';
        }
        if ($searchOper == 'bn') {
            return ' ' . $searchFieldValue . ' NOT LIKE \'' . $searchString . '%\'';
        }
        if ($searchOper == 'in') {
            return ' ' . $searchFieldValue . ' LIKE \'%' . $searchString . '%\'';
        }
        if ($searchOper == 'ni') {
            return ' ' . $searchFieldValue . ' NOT LIKE \'%' . $searchString . '%\'';
        }
        if ($searchOper == 'ew') {
            return ' ' . $searchFieldValue . ' LIKE \'%' . $searchString . '\'';
        }

        if ($searchOper == 'en') {
            return ' ' . $searchFieldValue . ' NOT LIKE \'%' . $searchString . '\'';
        }

        if ($searchOper == 'cn') {
            return ' ' . $searchFieldValue . ' LIKE \'%' . $searchString . '%\'';
        }

        if ($searchOper == 'nc') {
            return ' ' . $searchFieldValue . ' NOT LIKE \'%' . $searchString . '%\'';
        }
    }    
    
}