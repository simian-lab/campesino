<?php
// TODO: Unify this database configuration with the xml_parser.php
if(!$argv) {
  error("Este script solo se debe ejecutar por consola.");
}
if(count($argv) != 2) {
  error("Este script recibe un único parámetro, el entorno. Las opciones válidas son 'development', 'stage', 'production' y 'origin'");
}
else {
  switch ($argv[1]) {
    case 'development':
    $DB_HOST = 'localhost';
    $DB_NAME = 'eltiempo_co_cyber_lunes_v2';
    $DB_USERNAME = 'root';
    $DB_PASSWORD = 'root';
    break;
    case 'stage':
    $DB_HOST = '54.83.30.83';
    $DB_NAME = 'sss_stg';
    $DB_USERNAME = 'seasons';
    $DB_PASSWORD = 'h0h0h0';
    break;
    case 'production':
        $DB_HOST = '172.31.42.171';
        $DB_NAME = 'loe_sss';
        $DB_USERNAME = 'loe_sss';
        $DB_PASSWORD = 'MGV8$EhL';
    break;
    case 'origin':
      // TODO: Define this
    break;
    default:
    error("Entorno '".$argv[1]."' inválido. Las opciones válidas son 'development', 'stage', 'production' y 'origin'");
    break;
  }
  try {
    $DB = new PDO( "mysql:host=".$DB_HOST.";"."dbname=".$DB_NAME, $DB_USERNAME, $DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  }
  catch(PDOException $e) {
    error($e->getMessage());
  }
  if($argv[1] != 'production') {
    $FTP_CREDENTIALS['SERVER'] = 'ftp3.omniture.com';
    $FTP_CREDENTIALS['USER'] = 'eltiempoeltiempoalafijade_616765';
    $FTP_CREDENTIALS['PASSWORD'] = 'Ybi3yrYb';
  }
  else {
    $FTP_CREDENTIALS['SERVER'] = 'ftp3.omniture.com';
    $FTP_CREDENTIALS['USER'] = 'eltiempoeltiempoalafijap_2533821';
    $FTP_CREDENTIALS['PASSWORD'] = 'yDBj*$s5';
  }
  init($DB, $FTP_CREDENTIALS);
}
function init($db, $ftp_credentials) {

  $file_name = "omniture-eventos.tab";

  $date = date_format(date_create(), 'Y-m-d H:i:s');

  $header = "## SC	SiteCatalyst SAINT Import File	v:2.1\n"
  . "## SC	'## SC' indicates a SiteCatalyst pre-process header. Please do not remove these lines.\n"
  . "## SC	D:" . $date . " A:2864550:51\n";

  $table_header = "\nKey	ID-Anterior	Nombre	Categoria	Sub-Categoria	Tipo	Contenido	Comentarios	Precios	Configuracion\n";
    $query_eventos = $db->prepare("SELECT * FROM EVE_EVENTOS");
    $query_eventos->execute();
    $eventos = $query_eventos->fetchAll();
    if(!empty($eventos)) {
        $file = fopen($file_name, "w");
        fwrite($file, $header);
        fwrite($file, $table_header);
        foreach($eventos as $evento) {
          add_promotions_from_special($db, $file, $evento);
        }
        fclose($file);
        upload_file_ftp($ftp_credentials, $file_name);
    }
}
function add_promotions_from_special($db, $file, $evento) {
    $evento_id = $evento['EVE_ID'];
    $evento_prefix = $evento['EVE_PREFIJO'];
    $key_prefix = 'eve' . $evento_prefix .'-';
    $query_promotions = $db->prepare("SELECT * FROM PRO_PROMOCIONES INNER JOIN EXP_EVENTOXPROMOCION ON	PRO_PROMOCIONES.PRO_ID=EXP_EVENTOXPROMOCION.EXP_PROMOCION	WHERE EXP_EVENTO = :evento_id");
    $query_promotions->bindParam(':evento_id', $evento_id);
    $query_promotions->execute();
    $promotions = $query_promotions->fetchAll();
    foreach($promotions as $promotion) {
        $query_category = $db->prepare("SELECT * FROM CAT_CATEGORIA WHERE CAT_ID = :cat_id");
        $query_category->bindParam(':cat_id', $promotion['CAT_ID']);
        $query_category->execute();
        $category = $query_category->fetchAll();
        $category_slug = str_replace('-', '_', $category[0]['CAT_SLUG']);

        $query_subcategory = $db->prepare("SELECT * FROM SUB_SUBCATEGORIA WHERE SUB_ID = :subcat_id");
        $query_subcategory->bindParam(':subcat_id', $promotion['SUB_ID']);
        $query_subcategory->execute();
        $subcategory = $query_subcategory->fetchAll();
        if(empty($subcategory)) {
            $subcategory_slug = 'NA';
        } else {
          $subcategory_slug = str_replace('-', '_', $subcategory[0]['SUB_SLUG']);
        }



    $row = $key_prefix . $promotion['PRO_ID']
    . '	0'
    . '	' . $promotion['PRO_NOMBRE']
    . '	' . $category_slug
    . '	' . $subcategory_slug
    . '	NA'
    . '	NA'
    . '	0'
    . '	1'
    . '	automatic'
    . "\n";
        fwrite($file, $row);
    }
}
function upload_file_ftp($ftp_credentials, $file_name) {
    $connection_result = ftp_connect($ftp_credentials['SERVER']);
    if($connection_result != false) {
        $login_result = ftp_login($connection_result, $ftp_credentials['USER'], $ftp_credentials['PASSWORD']);

        if($login_result) {
            ftp_pasv($connection_result, true);
            $upload_result = ftp_put($connection_result, $file_name, $file_name, FTP_BINARY);
            ftp_close($connection_result);
            if($upload_result) {
                echo 'El archivo se subió correctamente.';
            }
            else {
                error('El archivo no se pudo subir.');
            }
        }
        else {
            error('Las credenciales de conexión no son válidas');
        }
    }
    else {
        error('Hubo un error en la conección FTP.');
    }
}
/**
 * Shows an error message in the console and
 * halts the program.
 */
function error($message) {
  // TODO Save this in a log file
  die("ERROR: ".$message." \n");
}
?>