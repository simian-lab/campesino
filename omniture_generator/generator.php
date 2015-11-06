<?php
// TODO: Unify this database configuration with the xml_parser.php
/*if(!$argv) {
  error("Este script solo se debe ejecutar por consola.");
}
if(count($argv) != 2) {
  error("Este script recibe un único parámetro, el entorno. Las opciones válidas son 'development', 'local', 'production' y 'origin'");
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

    $DB_HOST = 'localhost';
    $DB_NAME = 'stage_loe_specials';
    $DB_USERNAME = 'loe-specials';
    $DB_PASSWORD = 'sp3c14ls';
    break;
    case 'production':
        $DB_HOST = '52.20.189.63';
        $DB_NAME = 'dbespeciales_prod';
        $DB_USERNAME = 'especialprod';
        $DB_PASSWORD = 'Esp3cial3456!';
    break;
    case 'origin':
      // TODO: Define this
    break;
    default:
    error("Entorno '".$argv[1]."' inválido. Las opciones válidas son 'development', 'stage', 'production' y 'origin'");
    break;
  }*/
  $DB_HOST = 'localhost';
    $DB_NAME = 'eltiempo_co_cyber_lunes_v2';
    $DB_USERNAME = 'root';
    $DB_PASSWORD = 'root';
    /*______________*/
  try {
    $DB = new PDO( "mysql:host=".$DB_HOST.";"."dbname=".$DB_NAME, $DB_USERNAME, $DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  }
  catch(PDOException $e) {
    error($e->getMessage());
  }
  //if($argv[1] != 'production') {
    $FTP_CREDENTIALS['SERVER'] = 'ftp3. omniture.com';
    $FTP_CREDENTIALS['USER'] = 'eltiempoeltiempoalafijade _616765';
    $FTP_CREDENTIALS['PASSWORD'] = 'Ybi3 yrYb';
  /*}
  else {
    $FTP_CREDENTIALS['SERVER'] = 'ftp3. omniture.com';
    $FTP_CREDENTIALS['USER'] = 'eltiempoel tiempoalafijap_2533821';
    $FTP_CREDENTIALS['PASSWORD'] = 'yDBj* $s5';
  }
  init($DB, $FTP_CREDENTIALS);
}*/
function init($db, $ftp_credentials) {
    $file_name = "omniture.tab";
    $date = date_format(date_create(), 'Y-m-d H:i:s');
    $header = "## SC    SiteCatalyst SAINT Import File  v:2.1\n"
    . "## SC    '## SC' indicates a SiteCatalyst pre-process header. Please do not remove these lines.\n"
    . "## SC    D:" . $date . " A:2864550:51\n";
    $table_header = "\nKey  ID-Anterior Nombre  Categoria   Sub-Categoria   Tipo    Contenido   Comentarios Precios Configuracion\n";
    $query_specials = $db->prepare("SELECT * FROM specials");
    $query_specials->execute();
    $specials = $query_specials->fetchAll();
    if(!empty($specials)) {
        $file = fopen($file_name, "w");
        fwrite($file, $header);
        fwrite($file, $table_header);
        foreach($specials as $special) {
            if($special['slug'] != NULL) {
                add_promotions_from_special($db, $file, $special);
            }
        }
        fclose($file);
        upload_file_ftp($ftp_credentials, $file_name);
    }
}
function add_promotions_from_special($db, $file, $special) {
    $special_id = $special['id'];
    $special_prefix = strtoupper(substr($special['slug'], 0, 3));
    $key_prefix = 'ESP' . $special_prefix . '-';
    $query_promotions = $db->prepare("SELECT * FROM PRO_PROMOCIONES WHERE PRO_ESPECIAL_ID = :special_id");
    $query_promotions->bindParam(':special_id', $special_id);
    $query_promotions->execute();
    $promotions = $query_promotions->fetchAll();
    foreach($promotions as $promotion) {
        $query_taxonomy = $db->prepare("SELECT * FROM TAX_TAXONOMIAS WHERE TAX_ID = :tax_id");
        $query_taxonomy->bindParam(':tax_id', $promotion['PRO_TAX_ID']);
        $query_taxonomy->execute();
        $taxonomy = $query_taxonomy->fetchAll();

        $subcategory_slug = str_replace('-', '_', $taxonomy[0]['TAX_SLUG']);
        $query_taxonomy = $db->prepare("SELECT TAX_SLUG FROM TAX_TAXONOMIAS WHERE TAX_ID = :tax_id");
        $query_taxonomy->bindParam(':tax_id', $taxonomy[0]['TAX_PARENT_ID']);
        $query_taxonomy->execute();
        $taxonomy = $query_taxonomy->fetchAll();

        if(!empty($taxonomy)) {
            $category_slug = str_replace('-', '_', $taxonomy[0]['TAX_SLUG']);
        }
        else {
            $category_slug = 'NA';
        }

        $row = $key_prefix . $promotion['PRO_ID']
        . ' 0'
        . ' ' . $promotion['PRO_NOMBRE']
        . ' ' . $category_slug
        . ' ' . $category_slug
        . ' ' . $subcategory_slug
        . ' NA'
        . ' 0'
        . ' 1'
        . ' automatic'
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