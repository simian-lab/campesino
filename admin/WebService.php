<?php
/*Check the parameter */
  if(isset($_GET['vista'])) {
    /*Select the view*/
    switch ($_GET['vista']) {
      case 'paquetes':
       $sql = "SELECT * FROM v_reporteador_paquetes";
      break;
      case 'eventos':
       $sql = "SELECT * FROM v_reporteador_eventos";
      break;
      case 'promociones':
       $sql = "SELECT * FROM v_reporteador_promociones";
      break;
      default:
        print "Consulta '".$_GET['vista']."' inválida. Las opciones válidas son 'paquetes', 'eventos' y 'promociones'";
        die();
      break;
    }
    /*Set the connections*/
      switch ($_SERVER['SERVER_NAME'])
      {
        case 'sss-adm-stg.loencontraste.com':
          $DB_HOST = '54.83.30.83';
          $DB_NAME = 'sss_stg';
          $DB_USERNAME = 'seasons';
          $DB_PASSWORD = 'h0h0h0';
        break;
        case 'especiales.loencontraste.com':
        case 'sss-adm-pro.loencontraste.com':
          $DB_HOST = '172.31.19.181';
          $DB_NAME = 'loe_sss';
          $DB_USERNAME = 'loe_sss';
          $DB_PASSWORD = 'MGV8$EhL';
        break;
        default:
          $DB_HOST = 'localhost';
          $DB_NAME = 'eltiempo_co_cyber_lunes_v2';
          $DB_USERNAME = 'root';
          $DB_PASSWORD = 'root';
        break;
      }
    /*Try the connection*/
    try {
      $DB = new PDO( "mysql:host=".$DB_HOST.";"."dbname=".$DB_NAME, $DB_USERNAME, $DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }
    catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      die();
    }
    /*execute the query*/
    $ConsultaVista = $DB->prepare($sql);
    $ConsultaVista->execute();
    /*Fetch the results of the query*/
    $VistaList = $ConsultaVista->fetchAll(PDO::FETCH_CLASS);
    /*print the json*/
    header('Content-type: application/json');
    echo json_encode(array($_GET['vista']=>$VistaList));
    /*close the connection*/
    $DB = null;
  }
  else {
      print "Porfavor ingrese un parametro 'paquetes', 'eventos' o 'promociones' al final de la url de la manera: 'http://url.php<u><b>?vista=parametro</b></u>'";
      die();
  }
?>
