<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
    
    public function index()
    {
        parent::__construct();
        
        //$this->load->model('Model', '', TRUE);
        $dados['url'] = $this->url;
        $this->load->view('welcome_message', $dados);
    }
}
