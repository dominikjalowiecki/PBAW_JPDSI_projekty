<?php
require_once __DIR__ . '/../config.php';
include _ROOT_PATH . '/app/security/check.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit calculator | Protected page</title>
    <link rel="stylesheet" href="<?php echo _APP_URL . '/assets/css/pure-min.css'; ?>">
</head>

<body style="margin: 20px;">
    <header style="margin-bottom: 20px;" class="pure-menu pure-menu-horizontal">
        <a href="<?php echo _APP_URL; ?>" style="border: 1px dotted black;" class="pure-menu-heading pure-menu-link">
            Credit calculator
        </a>
        <ul class="pure-menu-list">
            <li class="pure-menu-item">
                <a href="<?php echo _APP_ROOT . '/app/protected_page.php'; ?>" class="pure-menu-link">Protected page</a>
            </li>
            <li class="pure-menu-item">
                <a href="<?php echo _APP_ROOT . '/app/security/logout.php'; ?>" class="pure-menu-link">Logout</a>
            </li>
        </ul>
    </header>
    <main>
        <h3>This page is protected!</h3>
    </main>
    <footer>
        <p style="margin: 30px 0;">Dominik Jałowiecki &copy; 2023</p>
    </footer>
</body>

</html>