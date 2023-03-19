<?php
# Login controller
require_once __DIR__ . '/../../config.php';


function getLoginParams()
{
    return [
        'login' => isset($_REQUEST['login']) ? trim($_REQUEST['login']) : null,
        'password' => isset($_REQUEST['password']) ? trim($_REQUEST['password']) : null
    ];
}


function setRole($role)
{
    session_start();
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


$messages = array();

$login_data = getLoginParams();

if (!validateLogin($login_data, $messages)) {
    include _ROOT_PATH . '/app/security/login_view.php';
} else {
    header('Location: ' . _APP_URL);
}
