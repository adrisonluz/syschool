<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    public $dados;


    public function index()
    {
        parent::__construct();
               
        $this->dados['url'] = $this->url;
        $this->dados['current'] = 'home';
        
        $this->load->view('home', $this->dados);
    }
}
