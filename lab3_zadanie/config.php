<?php
define('_SERVER_NAME', 'localhost');
define('_SERVER_URL', 'http://' . _SERVER_NAME);
define('_APP_ROOT', '/PBAW_JPDSI_projekty/lab3_zadanie');
define('_APP_URL', _SERVER_URL . _APP_ROOT);
define('_ROOT_PATH', __DIR__);

function out(&$param)
{
    if (isset($param))
        echo $param;
}
