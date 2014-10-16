<?php

if ( ! function_exists('log_promociones'))
{
  function log_promociones($message)
  {

    $path_file = APPPATH.'logs/log_promociones.txt';

    $fp = fopen($path_file, FOPEN_WRITE_CREATE);
    flock($fp, LOCK_EX);
	fwrite($fp, $message);
	flock($fp, LOCK_UN);
	fclose($fp);

	@chmod($path_file, FILE_WRITE_MODE);
        
  }

}
?>