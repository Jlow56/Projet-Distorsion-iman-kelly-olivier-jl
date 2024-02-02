<?php
require "config/autoload.php";

$router = new Router();
$router->handleRequest($_GET);
?>