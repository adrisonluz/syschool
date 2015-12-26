<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class MY_Controller extends CI_Controller {
    protected   $user;    
    public      $url;
    
    /**
    * Layout default utilizado pelo controlador.
    */
    public $layout = 'default';

    /**
    * Titulo default.
    */
    public $title = 'Aline Rosa | Sistema';

    /**
    * Definindo os css default.
    */
    public $css = array('style','niceforms-default');

    /**
    * Carregando os js default.
    */
    public $js = array('clockp','clockh','jquery.min','ddaccordion','jconfirmaction.jquery','niceforms','functions');

            
    function __construct() {
        parent::__construct();
               
        $url = base_url();
        $this->url = $url;
    }
}