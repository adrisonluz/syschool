<?php

class SubmenuSidebar{
    public $htmlSubmenu;

    public function __construct() {
        $this->htmlSubmenu = '<div class="submenu">
                        <ul>';
    }
    
    public function setSubmenu($nome, $link){
        $this->htmlSubmenu .= '<li><a href="' . $link . '">' . $nome . '</a></li>';
    }
    
    public function endSubmenu() {
        $this->htmlSubmenu .= '</ul>
                </div>';
        
        return $this->htmlSubmenu;
    }
}
