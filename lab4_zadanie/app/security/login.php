<?php
# Login controller
require_once __DIR__ . '/../../config.php';
require_once _ROOT_PATH . '/libs/smarty/Smarty.class.php';


function getLoginParams()
{
    return [
        'login' => isset($_REQUEST['login']) ? trim($_REQUEST['login']) : null,
        'password' => isset($_REQUEST['password']) ? trim($_REQUEST['password']) : null
    ];
}


function setRole($role)
{
    $_SESSION['role'] = $role;
}


function validateLogin($login_data, &$messages)
{
    if ($login_data['login'] === null || $login_data['password'] === null)
        return false;

    if ($login_data['login'] === '')
        $messages[] = 'Login is required!';

    if ($login_data['password'] === '')
        $messages[] = 'Password is required!';

    if (count($messages) != 0) return false;

    if ($login_data['login'] === 'admin' && $login_data['password'] === 'admin') {
        setRole('admin');
        return true;
    } elseif ($login_data['login'] === 'user' && $login_data['password'] === 'user') {
        setRole('user');
        return true;
    }

    $messages[] = 'Invalid login or password...';
    return false;
}


if (session_status() !== PHP_SESSION_ACTIVE) session_start();
if (isset($_SESSION['role'])) header('Location: ' . _APP_URL);

$messages = array();

$login_data = getLoginParams();

if (!validateLogin($login_data, $messages)) {
    $smarty = new Smarty();

    $smarty->assign('app_url', _APP_URL);
    $smarty->assign('p_title', 'Credit calculator | Login');
    $smarty->assign('p_description', 'Website login form');
    $smarty->assign('p_major_title', 'Login');
    $smarty->assign('messages', $messages);

    $smarty->display(_ROOT_PATH . '/app/security/login.tpl');
} else {
    header('Location: ' . _APP_URL);
}
