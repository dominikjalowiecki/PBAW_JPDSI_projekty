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
    $router = getRouter();
    $router->setAction($action_name);
    // include getConfig()->root_path . '/controller.php';

    $router->go();
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
