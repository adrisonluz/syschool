<?php

class Sidebar {
    public $sidebar = array();
    public $submenu = array();

    public function __construct() {

    }
    
    public function getSidebar() {
        return $this->sidebar;
    }
    
    public function setSidebar($titulo,$link,$submenu = false) {
        $this->sidebar[] = array(
            'titulo'    =>  $titulo,
            'link'      =>  $link,
            'submenu'   =>  $submenu
        );
    }
    
    public function getSubmenu() {
        return $this->submenu;
    }
    
    public function setSubmenu($titulo,$link) {
        $this->submenu[] = array(
            'titulo'    =>  $titulo,
            'link'      =>  $link
        );
    }
}
