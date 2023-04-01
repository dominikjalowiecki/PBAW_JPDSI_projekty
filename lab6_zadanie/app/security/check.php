<?php
session_start();

$role = $_SESSION['role'] ?? null;

if ($role === null) {
    header('Location: ' . $config->action_url . 'login');
    exit();
}
