<?php

// Front controller
require_once __DIR__ . '/init.php';

$router = getRouter();

$router->setDefaultRoute('credit_calc');
$router->setNoPermissionRoute('credit_calc');

$router->addRoute('login', 'LoginController');
$router->addRoute('logout', 'LoginController', ['user', 'admin']);
$router->addExtendedRoute('protected_page', 'ProtectedPageController', null, 'process', 'user');
$router->addRoute('credit_calc', 'CreditCalcController', ['user', 'admin']);

$router->go();
