<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit calculator | Login</title>
    <link rel="stylesheet" href="<?php echo _APP_URL . '/assets/css/pure-min.css'; ?>">
</head>

<body style="margin: 20px;">
    <header style="margin-bottom: 20px;" class="pure-menu pure-menu-horizontal">
        <a href="<?php echo _APP_URL; ?>" style="border: 1px dotted black;" class="pure-menu-heading pure-menu-link">
            Credit calculator
        </a>
    </header>
    <main>
        <form action="<?php echo _APP_ROOT . '/app/security/login.php'; ?>" method="POST" class="pure-form">
            <fieldset>
                <legend>Login form</legend>
                <input type="text" name="login" id="login" value="<?php if ($login_data['login'] !== null) echo $login_data['login'];  ?>" placeholder="Login">
                <input type="password" name="password" id="password" placeholder="Password">
                <button type="submit" class="pure-button pure-button-primary">Login</button>
            </fieldset>
        </form>
        <?php
        if (count($messages) > 0) {
            echo '<ol style="max-width: 300px; padding: 10px 10px 10px 30px; background-color: #fefe00; border: 1px solid #ddd; border-radius: 8px;">';
            foreach ($messages as $message) {
                echo '<li>' . $message . '</li>';
            }
            echo '</ol>';
        }
        ?>
    </main>
    <footer>
        <p style="margin: 30px 0;">Dominik Jałowiecki &copy; 2023</p>
    </footer>
</body>

</html>