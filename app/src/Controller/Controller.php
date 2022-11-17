<?php

namespace App\Controller;

abstract class Controller
{
    public function __construct(string $action, array $params = [])
    {
        if (!is_callable([$this, $action])) {
            throw new \RuntimeException("La methode $action n'est pas disponible dans ce controller");
        }
        call_user_func_array([$this, $action], $params);
    }

    public function render(string $view, string $title, string $style, array $args = [])
    {
        $view = dirname(__DIR__, 2) . '/views/' . $view;
        $base = dirname(__DIR__, 2) . '/views/base.php';

        ob_start();
        foreach ($args as $key => $value) {
            ${$key} = $value;
        }

        unset($args);

        require_once $view;
        $content = ob_get_clean();
        $title = $title;
        $style = 'style/' . $style . '?time();';


        require_once $base;

        exit;
    }
}
