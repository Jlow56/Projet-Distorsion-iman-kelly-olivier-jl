<?php
    class Router 
    {
        public function __construct() {

        }

        public function handleRequest(array $get, array $session) : void {
            $pageController = new PageController;
            if(isset($get['route']) && $get['route'] === "about") {
                $pageController->about();
            } else if(isset($get['route']) && $get['route'] === "postMessage") {
                $pageController->postCreate();
            } else if(!isset($get['route'])) {
                $pageController->home();
            } else {
                $pageController->notFound();
            }
        }
    }