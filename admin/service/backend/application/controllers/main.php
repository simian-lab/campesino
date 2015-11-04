<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MX_Controller
{

    function __construct()
    {

        $dominios_permitidos = '*';

        if ($this->config->item('allowed_domains') && (bool)count($this->config->item('allowed_domains'))) {
            $dominios_permitidos = implode(',', $this->config->item('allowed_domains'));
        }

        header('Access-Control-Allow-Origin:' . $dominios_permitidos);

        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('ion_auth');
        $this->data = array();
        $this->checkProcess();
    }

    /**
     * METODO PARA IMPRIMIR EL MENU
     */
    public function print_menu()
    {

        $process_list = $this->ion_auth->consulta_menu($this->session->userdata('sadmin_user_id'));
        $menu_list = '<ul class="toggle">';
        $cierra = false;
        foreach ($process_list as $listado) {
            if ($listado->process_id == 0) {
                if ($cierra == TRUE)
                    $menu_list .= '</ul>';
                $menu_list .= '<h3>' . $listado->process . '</h3><ul class="toggle">';
                $cierra = TRUE;
            } else {
                $icono = 'icn_tags';
                if ($listado->style)
                    $icono = $listado->style;

                if ($listado->menu == 'Si')
                    $menu_list .= '<li class="' . $icono . '"><a href="' . site_url($listado->method) . '">' . $listado->process . '</a></li>';
            }
        }
        if ($cierra == TRUE)
            $menu_list .= '</ul>';

        $menu_list .= '</ul>';
        return $menu_list;
    }

// METODO OUTPUT - SALIDA A NAVEGADOR.
    function salida($plantilla, $datos = array(), $breadcrumbs = array())
    {
        // Si existen datos en $datos['output'] los asignos para pasarlos al header
        if (isset($datos['output'])) {
            $data['output'] = $datos['output'];
        }

        $data['activa_menu'] = NULL;

        // Pregunto si existe session activa, si no mostramos el formulario login
        if ($this->ion_auth->logged_in() == 1) {
            $data['activa_menu'] = 1;
            $data['user'] = $this->session->userdata('username');
            $data['email'] = $this->session->userdata('email');
            $id = $this->session->userdata('sadmin_user_id');

        } elseif ($plantilla == 'auth/forgot_password' || $plantilla == 'auth/reset_password') {

        } else {
            if (uri_string() != 'main/login')
                redirect('main/login', 'refresh');
        }

        // Recupero el menu del usuario
        $data['menu_usuario'] = $this->print_menu();
        // Cargo los breacrumbs
        $data['breadcrumbs'] = implode('<div class="breadcrumb_divider"></div>', $breadcrumbs);

        $this->load->view('default/header', $data);
        $this->load->view($plantilla, $datos);
        $this->load->view('default/pie');

    }

// METODO OUTPUT - SALIDA A NAVEGADOR.
    function error($plantilla, $datos = array(), $breadcrumbs = array())
    {

        $data['output'] = $datos['output'];;
        $data['activa_menu'] = NULL;
        if ($this->ion_auth->logged_in() == 1) {
            $data['activa_menu'] = 1;
            $data['user'] = $this->session->userdata('username');
            $data['email'] = $this->session->userdata('email');
            $id = $this->session->userdata('sadmin_user_id');

        } elseif ($plantilla == 'auth/forgot_password' || $plantilla == 'auth/reset_password') {

        } else {
            if (uri_string() != 'main/login')
                redirect('main/login', 'refresh');
        }

        // Recupero el menu del usuario
        $data['menu_usuario'] = $this->print_menu();
        // Cargo los breacrumbs
        $data['breadcrumbs'] = implode('<div class="breadcrumb_divider"></div>', $breadcrumbs);
        $this->load->view('default/header_error', $data);
        $this->load->view($plantilla, $datos);
        $this->load->view('default/pie');

    }

    function index()
    {

        $process_list = $this->ion_auth->consulta_menu($this->session->userdata('sadmin_user_id'));
        $ir = 'list_user';
        foreach ($process_list as $listado) {
            if ($listado->process_id != 0) {

                if ($listado->menu == 'Si') {
                    $ir = str_replace('main/', '', $listado->method);
                    break;
                }
            }
        }

        $this->$ir();
    }


    /* FUNCIONES DE ION_AUTH */
    function login()
    {
        $auth = $this->load->module('auth_ion');
        echo $retorno = modules::run('modules/auth_ion/login');
    }

    function logout()
    {
        $auth = $this->load->module('auth_ion');
        echo $retorno = modules::run('modules/auth_ion/logout');
    }

    function list_user()
    {
        $auth = $this->load->module('auth_ion');
        echo $retorno = modules::run('modules/auth_ion/list_user');
    }

    function list_process()
    {
        $auth = $this->load->module('auth_ion');
        echo $retorno = modules::run('modules/auth_ion/list_process');
    }

    function list_groups()
    {
        $auth = $this->load->module('auth_ion');
        echo $retorno = modules::run('modules/auth_ion/list_groups');
    }

    function forgot_password()
    {
        $auth = $this->load->module('auth_ion');
        echo $retorno = modules::run('modules/auth_ion/forgot_password');
    }

    function reset_password($pais = NULL, $key = NULL)
    {
        if (!in_array($pais, array('cl', 'ar', 'pe')))
            $key = $pais;
        else {
            $this->load->database($pais);
        }
        $auth = $this->load->module('auth_ion');
        echo $retorno = modules::run('modules/auth_ion/reset_password', $key);
    }

    function change_password($id)
    {
        $auth = $this->load->module('auth_ion');
        echo $retorno = modules::run('modules/auth_ion/change_password', $id);
    }


    function add_process_groups($id = NULL)
    {
        $auth = $this->load->module('auth_ion');
        echo $retorno = modules::run('modules/auth_ion/add_process_groups', $id);
    }

    function checkProcess()
    {
        $this->load->model('ion_auth_model');

        $accesos_predeterminados = array('main/index', 'main/logout', 'main/login', '');
        $segment = 'main/' . $this->uri->segment(2);
        if (in_array($segment, $accesos_predeterminados))
            return true;
        if (!$segment || !$this->session->userdata('sadmin_user_id'))
            return false;

        if (!$this->ion_auth_model->access($segment, $this->session->userdata('sadmin_user_id'))) {
            redirect('main/logout', 'refresh');
        }/**/
    }

    /* FUNCIONES DE Noticias */
    function noticia()
    {
        $auth = $this->load->module('noticia');
        echo $retorno = modules::run('modules/noticia/list_noticias');
    }

    function imagenes_noticia($id = NULL)
    {
        $auth = $this->load->module('noticia');
        echo $retorno = modules::run('modules/noticia/imagenes', $id);
    }


    /* FUNCION DE NOVEDADES */
    function articulos()
    {
        $auth = $this->load->module('articulos');
        echo $retorno = modules::run('modules/articulos/index');
    }

    function promociones()
    {
        $auth = $this->load->module('promociones');
        echo $retorno = modules::run('modules/promociones/index');
    }

    function promociones_premium()
    {
        $auth = $this->load->module('promociones_premium');
        echo $retorno = modules::run('modules/promociones_premium/index');
    }

    function promociones_premium_home()
    {
        $auth = $this->load->module('promociones_premium_home');
        echo $retorno = modules::run('modules/promociones_premium_home/index');
    }

    function promociones_generales()
    {
        $auth = $this->load->module('promociones_generales');
        echo $retorno = modules::run('modules/promociones_generales/index');
    }

    function pautas()
    {
        $auth = $this->load->module('pautas');
        echo $retorno = modules::run('modules/pautas/index');
    }

    function tags()
    {
        $auth = $this->load->module('tags');
        echo $retorno = modules::run('modules/tags/index');
    }

    function tags_categorias()
    {
        $auth = $this->load->module('tags_categorias');
        echo $retorno = modules::run('modules/tags_categorias/index');
    }

    function tags_subcategorias()
    {
        $auth = $this->load->module('tags_subcategorias');
        echo $retorno = modules::run('modules/tags_subcategorias/index');
    }

    function pendientes()
    {
        $auth = $this->load->module('pendientes');
        echo $retorno = modules::run('modules/pendientes/index');
    }

    function aliados()
    {
        $auth = $this->load->module('aliados');
        echo $retorno = modules::run('modules/aliados/index');
    }

    function aliado()
    {
        $auth = $this->load->module('aliado');
        echo $retorno = modules::run('modules/aliado/index');
    }

    function destinos()
    {
        $auth = $this->load->module('destinos');
        echo $retorno = modules::run('modules/destinos/index');
    }

    function Paquetes()
    {
        $auth = $this->load->module('paquetes');
        echo $retorno = modules::run('modules/paquetes/index');
    }

    function asignar_pautas($id = NULL)
    {
        $auth = $this->load->module('asignar_pautas');
        // Imprimo el valor obtenido
        // echo $retorno = modules::run('modules/tabla_nutricional/index');
        echo $retorno = modules::run('modules/asignar_pautas/index', $id);
    }

    function asignar_paquetes_aliados()
    {
        $auth = $this->load->module('asignar_paquetes_aliados');
        // Imprimo el valor obtenido
        echo $retorno = modules::run('modules/asignar_paquetes_aliados/index');
    }

    function pautas_pre_evento()
    {
        $auth = $this->load->module('pautas_pre_evento');
        // Imprimo el valor obtenido
        echo $retorno = modules::run('modules/pautas_pre_evento/index');
    }

    function formulario_sorteo()
    {

        $auth = $this->load->module('formulario_sorteo');
        // Imprimo el valor obtenido
        echo $retorno = modules::run('modules/formulario_sorteo/index');


    }

    function formulario_participacion()
    {
        $auth = $this->load->module('formulario_participacion');
        // Imprimo el valor obtenido
        echo $retorno = modules::run('modules/formulario_participacion/index');
    }

    function marcas()
    {

        $auth = $this->load->module('marcas');
        // Imprimo el valor obtenido
        echo $retorno = modules::run('modules/marcas/index');

    }

    function asignar_tiendas()
    {
        $auth = $this->load->module('asignar_tiendas');
        // Imprimo el valor obtenido
        echo $retorno = modules::run('modules/asignar_tiendas/index');
    }

    function promociones_aprobadas()
    {
        $auth = $this->load->module('promociones_aprobadas');
        echo $retorno = modules::run('modules/promociones_aprobadas/index');
    }

    function promociones_rechazadas()
    {
        $auth = $this->load->module('promociones_rechazadas');
        echo $retorno = modules::run('modules/promociones_rechazadas/index');
    }

    function lista_blanca_dominios()
    {
        $auth = $this->load->module('lista_blanca_dominios');
        echo $retorno = modules::run('modules/lista_blanca_dominios/index');
    }

    function formulario_registro()
    {
        $auth = $this->load->module('formulario_registro');
        echo $retorno = modules::run('modules/formulario_registro/index');
    }

    function prueba_mail()
    {
        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'localhost';
        //$config['smtp_timeout'] = '90';


        $this->email->initialize($config);

        $this->email->from('no-reply@cyberlunes.com.co');
        $this->email->to('mcisneros@brandigital.com,icano@brandigital.com,ggiorda@brandigital.com');
        $this->email->subject('mail de prueba');
        $this->email->message('Esto es un asunto de prueba ' . base_url());

        if ($this->email->send()) {
            echo 'Mensaje enviado';
        }

        echo('<br>');
        echo $this->email->print_debugger();
    }

}
