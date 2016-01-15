<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function index()
	{
            $dados['current'] = 'login';
            $this->load->view('login', $dados);
	}
}
