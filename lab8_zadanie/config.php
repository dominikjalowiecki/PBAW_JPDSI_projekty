<?php

$config->debug = True;

$config->server_name = $_SERVER['SERVER_NAME'];
$config->server_url = $_SERVER['REQUEST_SCHEME'] . '://' . $config->server_name;
$config->app_root = dirname($_SERVER['SCRIPT_NAME']);
$config->action_root = $config->app_root . '/controller.php?action=';

$config->db_type = 'mysql';
$config->db_host = 'localhost';
$config->db_name = 'credit_calc';
$config->db_user = 'root';
$config->db_password = '';

$config->db_port = '3306';
$config->db_charset = 'utf8mb4';
$config->db_error = PDO::ERRMODE_EXCEPTION;
$config->db_option = [PDO::ATTR_CASE => PDO::CASE_NATURAL];

// Generated values
$config->root_path = __DIR__;
$config->app_url = $config->server_url . $config->app_root;
$config->action_url = $config->server_url . $config->action_root;
