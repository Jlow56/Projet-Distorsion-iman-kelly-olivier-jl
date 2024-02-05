<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


abstract class AbstractController
{
    protected function render(string $template, array $data) : void
    {
        require "templates/layout.phtml";
    }

    protected function renderJson(array $data) : void
    {
        echo json_encode($data);
    }

    protected function redirect(string $route) : void
    {
        header("Location: $route");
    }
}