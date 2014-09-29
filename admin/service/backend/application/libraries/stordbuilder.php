<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
define('KEY_DDBB', '@');
define('VALUE_DDBB', NULL);
define('TYPE_DDBB', NULL);
define('POSITION_DDBB',NULL);
define('CALL_NAME', NULL);
define('NUMBER_PARAMETERS', NULL);
define('FORMAT_NAME', NULL);
define('TIPE_NAME', 'mysql_array');

class StordBuilder {

    var $dbArray = array();
    var $dbCallName = '';
    var $dbformat = '';
    var $dbNumParameters = '';

      
    public function callName($name = CALL_NAME) {
        $this->dbCallName = $name;
    }    
    
    public function setNumParameters($numParameters = NUMBER_PARAMETERS) {
        $this->dbNumParameters = $numParameters;
        $this->dbArray = array_fill(0,$numParameters,NULL);
    }
    
    public function formatName($format = FORMAT_NAME) {
        $this->dbformat = $format;
    }
    
    public function setData($key = KEY_DDBB, $value=VALUE_DDBB, $type=TYPE_DDBB, $position=POSITION_DDBB) {
               
        if($type == '')
            $type = 'string';
        
        $this->dbArray[] = array(
                                'key' => '@'.$key,
                                'value' => $this->_cast($value,$type),
                                'position' => $position
                            );

    }

    function _cast($value,$type){
        
        switch($type){
            case "integer";
                $value = (integer)$value;
            break;
            case "string";
                $value = (string)$value;
            break;
            case "float";
                $value = (float)$value;
            break;
            default;
                $value = (string)$value;
            break;        
        }
        
        return $value;        
    }
    
    public function show($tipe = TIPE_NAME) {
        $tipe = strtolower($tipe);
        switch ($tipe):
            case 'mysql':
                return $this->_opcionMySQL();
                break;
            case 'sqlserver':
                return $this->_opcionSQLServer();
                break;
            case 'mysql_array':
                return $this->_opcionSQL();
                break;
            default:
                return $this->_opcionSQL();
        endswitch;
    }

    function _opcionMySQL(){
        $sql = '';

        $sql .= 'CALL ' . $this->dbCallName . ' (';
        foreach ($this->dbArray as $k => $valor):
            $sql .= "'" . $valor['value'] . "', ";
        endforeach;

        $sql = substr($sql, 0, -2);
        $sql .= ' )';
        $params['sql'] = $sql;
        return $params;
    }

    function _opcionSQLServer() {
        $sql = '';
        $valueTemp = array_fill(0,$this->dbNumParameters,NULL);

        $sql .= 'EXEC ' . $this->dbCallName . ' (';
        foreach ($this->dbArray as $k => $valor):                 
            $valueTemp[$valor['position']-1] = $valor['value'];
        endforeach;            
        
        for($i=0;$i<$this->dbNumParameters;$i++){
            $sql .= '?, ';
        }

        $sql = substr($sql, 0, -2);
        $sql .= ' )';
        $params['value'] = $valueTemp;
        $params['sql'] = $sql;
        return $params;
    }

    function _opcionSQL() {
       
        $sql = '';
        $valueTemp = array_fill(0,$this->dbNumParameters,NULL);
        
        $sql .= 'CALL ' . $this->dbCallName . ' (';
        
        foreach ($this->dbArray as $k => $valor):                 
            $valueTemp[$valor['position']-1] = $valor['value'];
        endforeach;            
        
        for($i=0;$i<$this->dbNumParameters;$i++){
            $sql .= '?, ';
        }    
        
        $sql = substr($sql, 0, -2);
        $sql .= ' )';
        $params['value'] = $valueTemp;
        $params['sql'] = $sql;
        return $params;
    }
}