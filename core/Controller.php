<?php

namespace app\core;

class Controller
{
    public function render($template, array $params = [])
    {
        Application::$app->router->renderView($template, $params);
    }
}