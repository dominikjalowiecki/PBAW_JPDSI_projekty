<?php
session_start();

$role = $_SESSION['role'] ?? null;

if ($role === null) {
    include _ROOT_PATH . '/app/security/login.php';
    exit();
}
