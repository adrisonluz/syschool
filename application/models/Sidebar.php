<?php

class Sidebar extends MY_Model{
    public $htmlSidebar;


    public function __construct() {
        parent::__construct();
        
        $this->htmlSidebar = '<div class="sidebarmenu">';
    }
    
    public function setMenu($menu){
        $this->htmlSidebar .= $menu;
    }
    
    public function endSidebar() {
        $this->htmlSidebar .= '</div>';
        
        return $this->htmlSidebar;
    }
}
