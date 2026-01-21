<?php

namespace App\Core;

class BaseController
{

    protected function view($view, $data = [])
    {
        extract($data);
        require_once __DIR__ . '/../views/' . $view . '.php';
    }

    protected function redirect($path){
        header("Location: $path");

        exit;
    }
}