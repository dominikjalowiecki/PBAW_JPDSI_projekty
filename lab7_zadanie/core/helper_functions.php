<?php

namespace core;

function getFrom(&$source, $name, $required, $error_message)
{
    if (isset($source[$name]))
        return trim($source[$name]);

    if ($required) getMessages()->addError($error_message);

    return null;
}

function getFromRequest($name, $required = false, $error_message = '')
{
    return getFrom($_REQUEST, $name, $required, $error_message);
}

function getFromGet($name, $required = false, $error_message = '')
{
    return getFrom($_GET, $name, $required, $error_message);
}

function getFromPost($name, $required = false, $error_message = '')
{
    return getFrom($_POST, $name, $required, $error_message);
}

function getFromCookie($name, $required = false, $error_message = '')
{
    return getFrom($_COOKIE, $name, $required, $error_message);
}

function getFromSession($name, $required = false, $error_message = '')
{
    return getFrom($_SESSION, $name, $required, $error_message);
}

function forwardTo($action_name)
{
    global $action;
    $action = $action_name;

    include getConfig()->root_path . '/controller.php';

    exit();
}

function redirectTo($action_name)
{
    header('Location: ' . getConfig()->action_url . $action_name);

    exit();
}

function addRole($role_name)
{
    $config = getConfig();
    $config->roles[$role_name] = true;
    $_SESSION['_roles'] = serialize($config->roles);
}

function inRoles($role_name)
{
    return isset(getConfig()->roles[$role_name]);
}

function control($controller_name, $namespace = null, $roles = null, $method = 'process')
{
    if ($roles != null) {
        global $action;

        $user = (getFromSession('user', true, 'You have to be logged in to access this page...') != null) ? unserialize(getFromSession('user')) : null;
        if (!(isset($user) && isset($user->login) && isset($user->role)))
            forwardTo('login');
        // redirectTo('login&next=' . $action);

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
            getMessages()->addError('No permission for this action...');
            forwardTo(getConfig()->no_permission_action);
        }
    }

    if (empty($namespace)) {
        $controller_name = 'app\\controllers\\' . $controller_name;
    } else {
        $controller_name = $namespace . '\\' . $controller_name;
    }

    // include_once getConfig()->root_path . DIRECTORY_SEPARATOR . $controller_name . '.class.php';
    $controller = new $controller_name();

    if (is_callable([$controller, $method])) $controller->$method();
    exit();
}
