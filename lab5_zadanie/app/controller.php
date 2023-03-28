<?php
require_once __DIR__ . '/../config.php';

$action = $_REQUEST['action'] ?? null;

switch ($action) {
    case 'login':
        include_once $config->root_path . '/app/security/login/LoginController.class.php';

        (new LoginController())->process();
        break;
    case 'logout':
        include_once $config->root_path . '/app/security/logout.php';
        break;
    case 'protected_page':
        include $config->root_path . '/app/security/check.php';
        include_once $config->root_path . '/app/protected_page/ProtectedPageController.class.php';

        (new ProtectedPageController())->process();
        break;
    case 'credit_calc':
    default:
        include $config->root_path . '/app/security/check.php';
        include_once $config->root_path . '/app/credit_calc/CreditCalcController.class.php';

        (new CreditCalcController())->process();
        break;
}
