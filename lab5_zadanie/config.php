<?php
require_once __DIR__ . '/Config.class.php';

$config = new Config();

$config->server_name = 'localhost';
$config->server_url = 'http://' . $config->server_name;
$config->app_root = '/PBAW_JPDSI_projekty/lab5_zadanie';
$config->app_url = $config->server_url . $config->app_root;
$config->root_path = __DIR__;
$config->action_root = $config->app_root . '/app/controller.php?action=';
$config->action_url = $config->server_url . $config->action_root;
