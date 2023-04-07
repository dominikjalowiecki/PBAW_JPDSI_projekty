<?php

// Front controller
require_once __DIR__ . '/init.php';

use function core\control;

getConfig()->no_permission_action = 'credit_calc';

switch ($action) {
    case 'login':
        control('LoginController');
        break;
    case 'logout':
        control('LoginController', null, ['user', 'admin'], 'logout');
        break;
    case 'protected_page':
        control('ProtectedPageController', null, ['user']);
        break;
    case 'credit_calc':
    case null:
        control('CreditCalcController', null, ['user', 'admin']);
        break;
    default:
        echo '404 Page Not Found';
        break;
}
