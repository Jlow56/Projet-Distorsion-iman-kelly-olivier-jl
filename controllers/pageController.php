<?php
    class PageController
    {
        public function __construct() {

        }

        public function home() : void {
            $route  = "home";
            $postManager = new PostManager();
            $posts = $postManager->getAllPosts(1);
            require "templates/layout.phtml";
        }

        public function postCreate() : void {
            if(isset($_POST['message'])) {
                $post = new Post($_POST['message'], DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')), 1);
                $postManager = new PostManager();
                $postManager->getCreatePost($post);
                header("Location: index.php");
            } else {
                header("Location: index.php");
            }
            
        }

        public function about() : void {
            $route  = "about";
            require "templates/layout.phtml";
        }

        public function notFound() : void {
            $route  = "404";
            require "templates/layout.phtml";
        }
    }