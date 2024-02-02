<?php
class PageController
{
    public function home(): void
    {
        $route = "home";
        require "templates/layout.phtml";
    }
    
    public function about(): void
    {
        $route = "about";
        require "templates/layout.phtml";
    }
    
    public function page404(): void
    {
        $route = "404";
        require "templates/layout.phtml";
    }
}
?>