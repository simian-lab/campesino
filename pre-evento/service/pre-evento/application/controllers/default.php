<?php

/**
 * Controller with cross-domain headers
 */
class Default_Controller extends CI_Controller
{
    public function __construct()
    {
        $dominios_permitidos = '*';

        if ($this->config->item('allowed_domains') && (bool) count($this->config->item('allowed_domains'))) {
            $dominios_permitidos =  implode(',', $this->config->item('allowed_domains'));
        }

        header('Access-Control-Allow-Origin:' . $dominios_permitidos);

        parent::__construct();
    }
}