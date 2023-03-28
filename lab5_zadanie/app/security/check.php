<?php
session_start();

$role = $_SESSION['role'] ?? null;

if ($role === null) {
    include $config->root_path . '/app/security/login/login.php';
    exit();
}
