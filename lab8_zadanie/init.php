<?php

require_once __DIR__ . '/core/Config.class.php';
$config = new core\Config();

include __DIR__ . '/config.php';

/**
 * Function allows accessing application config without
 * the necessity of using 'global' keyword
 */
function &getConfig(): core\Config
{
    global $config;
    return $config;
}


require_once getConfig()->root_path . '/core/Messages.class.php';
$messages = new core\Messages();

function getMessages(): core\Messages
{
    global $messages;
    return $messages;
}


$smarty = null;

function getSmarty(): Smarty
{
    global $smarty;

    if (!isset($smarty)) {
        include_once getConfig()->root_path . '/libs/smarty/Smarty.class.php';

        $smarty = new Smarty();

        $smarty->assign('config', getConfig());
        $smarty->assign('messages', getMessages());
        $smarty->setTemplateDir(
            array(
                getConfig()->root_path . '/app/views',
                getConfig()->root_path . '/app/views/templates'
            )
        );
    }

    return $smarty;
}


require_once getConfig()->root_path . '/core/ClassLoader.class.php';

$class_loader = new core\ClassLoader();
$class_loader->addPath('/libs');
function getClassLoader(): core\ClassLoader
{
    global $class_loader;
    return $class_loader;
}


require_once getConfig()->root_path . '/core/Router.class.php';
$router = core\Router::getInstance();
function getRouter(): core\Router
{
    global $router;
    return $router;
}


require_once getConfig()->root_path . '/core/helper_functions.php';

session_start();
$config->roles = isset($_SESSION['_roles']) ? unserialize($_SESSION['_roles']) : array();

$router->setAction(core\getFromRequest('action'));
