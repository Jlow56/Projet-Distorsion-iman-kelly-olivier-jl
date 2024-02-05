<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */
session_start();

require "config/autoload.php";

$router = new Router();
$router->handleRequest($_GET);

