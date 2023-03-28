<?php
require_once __DIR__ . '/../../config.php';
require_once $config->root_path . '/app/protected_page/ProtectedPageController.class.php';

include $config->root_path . '/app/security/check.php';


$controller = new ProtectedPageController();
$controller->process();
