<?php

namespace App\Controller;

class BaseController
{
    private $model;
    private $view;

    public function __construct($model, $view)
    {
        $this->model = $model;
        $this->view = $view;
    }
    
    public function handleRequest()
    {
        
    }
}
