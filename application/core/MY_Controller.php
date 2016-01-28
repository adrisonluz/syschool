<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class MY_Controller extends CI_Controller {
    protected   $user;    
    public      $url;
    public      $current_url;
    public      $sector;
    public      $model;

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
        
        $this->current_url = current_url();
    }
    
    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function setLayout($layout) {
        $this->layout = $layout;
    }
    
    public function setCSS($css = array()) {
        $this->css = $css;
    }
    
    public function setJS($js = array()) {
        $this->js = $js;
    }
    
    public function setSector($sector) {
        $this->sector = $sector;
    }
    
    public function getSector() {
        return $this->sector;
    }
    
    public function setModel($model, $apelido) {
        $this->model = $this->load->model($model, $apelido, TRUE);
    }
}