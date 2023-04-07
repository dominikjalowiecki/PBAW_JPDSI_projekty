<?php

// Front controller
require_once __DIR__ . '/init.php';

use app\controllers\{
    LoginController,
    ProtectedPageController,
    CreditCalcController
};

switch ($action) {
    case 'login':
        (new LoginController())->process();
        break;
    case 'logout':
        (new LoginController())->logout();
        break;
    case 'protected_page':
        include $config->root_path . '/app/security/check.php';

        (new ProtectedPageController())->process();
        break;
    case 'credit_calc':
    default:
        include $config->root_path . '/app/security/check.php';

        (new CreditCalcController())->process();
        break;
}
