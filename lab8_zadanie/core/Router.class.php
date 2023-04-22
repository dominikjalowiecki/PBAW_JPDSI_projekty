<?php

namespace core;

use Exception;

/**
 * Router singleton class
 * @author Dominik Jałowiecki
 */
class Router
{
    private static $instance = null;

    public $action = null;
    public $routes = array();
    private $default = null;
    private $no_permission_route = 'login';

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
        throw new Exception('Singleton cannot be serialized...');
    }

    public static function getInstance(): Router
    {
        // Late static bindings
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function addExtendedRoute($action, $controller_name, $namespace, $method, $roles = null)
    {
        $this->routes[$action] = new Route($controller_name, $namespace, $roles, $method);
    }

    public function addRoute($action, $controller_name, $roles = null)
    {
        $this->routes[$action] = new Route($controller_name, null, $roles, 'action_' . $action);
    }

    public function setDefaultRoute($route)
    {
        $this->default = $route;
    }

    public function setNoPermissionRoute($route)
    {
        $this->no_permission_route = $route;
    }


    function control($controller_name, $namespace, $roles, $method)
    {
        if ($roles != null) {
            $user = (getFromSession('user', true, 'You have to be logged in to access this page...') != null) ? unserialize(getFromSession('user')) : null;
            if (!(isset($user) && isset($user->login) && isset($user->role)))
                forwardTo('login');
            // redirectTo('login&next=' . $this->action);

            $role_found = false;
            if (is_array($roles)) {
                foreach ($roles as $role) {
                    if (inRoles($role)) {
                        $role_found = true;
                        break;
                    }
                }
            } else {
                // If passed $roles parameter is string
                if (inRoles($roles)) $role_found = true;
            }

            if (!$role_found) {
                getMessages()->addError('Insufficient permissions for this action...');
                forwardTo($this->no_permission_route);
            }
        }

        if (empty($namespace)) {
            $controller_name = 'app\\controllers\\' . $controller_name;
        } else {
            $controller_name = $namespace . '\\' . $controller_name;
        }

        // include_once getConfig()->root_path . DIRECTORY_SEPARATOR . $controller_name . '.class.php';
        $controller = new $controller_name();

        if (method_exists($controller, $method))
            $controller->$method();
        else
            throw new Exception('Method "' . $method . '" does not exist in "' . $controller_name . '" class...');

        exit();
    }

    public function go()
    {
        if (isset($this->routes[$this->action])) {
            $route = $this->routes[$this->action];
            $this->control($route->controller_name, $route->namespace, $route->roles, $route->method);
        } elseif ($this->action == null) {
            if (isset($this->default) && isset($this->routes[$this->default])) {
                $route = $this->routes[$this->default];
                $this->control($route->controller_name, $route->namespace, $route->roles, $route->method);
            } else {
                throw new Exception('Route for action "' . $this->action . '" does not exist...');
            }
        } else {
            echo '404 Page Not Found';
        }
    }
}
