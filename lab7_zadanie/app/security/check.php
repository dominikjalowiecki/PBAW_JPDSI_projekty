<?php

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$user = isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;

if (!(isset($user) && isset($user->login) && isset($user->role))) {
    header('Location: ' . $config->action_url . 'login&next=' . $action);
    exit();
}
