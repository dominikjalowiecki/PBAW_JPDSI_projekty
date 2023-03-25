<?php
require_once __DIR__ . '/../../config.php';

session_start();
session_destroy();

header('Location: ' . _APP_URL);
