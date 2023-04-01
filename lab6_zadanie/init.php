<?php
require_once __DIR__ . '/core/Config.class.php';
$config = new Config();

include __DIR__ . '/config.php';

/**
 * Function allows accessing application config without
 * the necessity of using 'global' keyword
 */
function &getConfig()
{
    global $config;
    return $config;
}


require_once getConfig()->root_path . '/core/Messages.class.php';
$messages = new Messages();

function getMessages()
{
    global $messages;
    return $messages;
}


$smarty = null;

function getSmarty()
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


require_once getConfig()->root_path . '/core/helper_functions.php';

$action = getFromRequest('action');
