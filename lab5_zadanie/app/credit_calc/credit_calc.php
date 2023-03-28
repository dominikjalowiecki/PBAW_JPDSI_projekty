<?php
require_once __DIR__ . '/../../config.php';
require_once $config->root_path . '/app/credit_calc/CreditCalcController.class.php';

include $config->root_path . '/app/security/check.php';


$controller = new CreditCalcController();
$controller->process();
