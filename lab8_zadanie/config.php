<?php

$config->server_name = 'localhost';
$config->server_url = 'http://' . $config->server_name;
$config->app_root = '/PBAW_JPDSI_projekty/lab8_zadanie';
$config->action_root = $config->app_root . '/controller.php?action=';

$config->root_path = __DIR__;
$config->app_url = $config->server_url . $config->app_root;
$config->action_url = $config->server_url . $config->action_root;
