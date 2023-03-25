<?php
require_once __DIR__ . '/../config.php';
require_once _ROOT_PATH . '/libs/smarty/Smarty.class.php';

include _ROOT_PATH . '/app/security/check.php';


$smarty = new Smarty();

$smarty->assign('app_url', _APP_URL);
$smarty->assign('p_title', 'Credit calculator | Protected page');
$smarty->assign('p_description', 'Credit calculator protected page');
$smarty->assign('p_major_title', 'Protected page');
$smarty->assign('p_major_description', 'This is protected page.');

$smarty->display(_ROOT_PATH . '/app/protected_page.tpl');
