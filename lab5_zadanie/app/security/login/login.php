<?php
require_once $config->root_path . '/app/security/login/LoginController.class.php';


$controller = new LoginController();
$controller->process();
