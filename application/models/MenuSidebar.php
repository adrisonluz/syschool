<?php

class MenuSidebar{
    public $htmlMenu;
    
    public function setMenu($nome, $link) {
        $this->htmlMenu = '<a class="menuitem submenuheader" href="' . $link . '" >' . $menu . '</a>';
    }
    
    public function setSubmenu($submenu) {
        $this->htmlMenu .= $submenu;
    }
}
