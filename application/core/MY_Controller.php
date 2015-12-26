<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class MY_Controller extends CI_Controller {
    protected   $user;    
    public      $url;
            
    function __construct() {
        parent::__construct();
               
        $url = base_url();
        $this->url = $url;
    }
}