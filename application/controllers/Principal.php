<?php

/**
 *
 */
class Principal extends MY_Controller
{

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
public $css = array('default');

/**
* Carregando os js default.
*/
public $js = array('home');

// Metodoo index
function index()
{
parent::__construct();

$this->css = array('style','niceforms-default');
$this->js = array('clockp','clockh','jquery.min','ddaccordion','jconfirmaction.jquery','niceforms','functions');

// Carregando a view.
$this->load->view('principal');
}

}
?>