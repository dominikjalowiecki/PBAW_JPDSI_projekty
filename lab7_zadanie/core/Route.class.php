<?php

namespace core;

class Route
{
    public $controller_name = null;
    public $namespace = null;
    public $roles = null;
    public $method = null;

    public function __construct($controller_name, $namespace, $roles, $method)
    {
        $this->controller_name = $controller_name;
        $this->namespace = $namespace;
        $this->roles = $roles;
        $this->method = $method;
    }
}
