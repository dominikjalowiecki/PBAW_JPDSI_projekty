<?php

// Front controller
require_once __DIR__ . '/init.php';

$router = getRouter();

$router->setDefaultRoute('credit_show');
$router->setNoPermissionRoute('credit_show');

$router->addRoute('login', 'LoginController');
$router->addRoute('logout', 'LoginController', ['user', 'admin']);
$router->addExtendedRoute('protected_page', 'ProtectedPageController', null, 'process', 'user');
$router->addRoute('credit_calc', 'CreditCalcController', ['user', 'admin']);
$router->addRoute('credit_show', 'CreditCalcController', ['user', 'admin']);
$router->addRoute('get_results', 'ResultsController', ['user', 'admin']);

$router->go();
