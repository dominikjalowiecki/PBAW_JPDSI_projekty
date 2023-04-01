<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit calculator</title>
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
        <form action="<?php echo _APP_URL . '/app/credit_calc.php' ?>" method="GET" class="pure-form pure-form-stacked">
            <fieldset>
                <legend>Calculator form</legend>
                <label for="credit_amount">Credit amount ($)</label>
                <input type="text" name="credit_amount" id="credit_amount" placeholder="100000" value="<?php out($credit_amount); ?>">
                <label for="credit_duration">Credit duration (years)</label>
                <input type="text" name="credit_duration" id="credit_duration" placeholder="5" value="<?php out($credit_duration); ?>">
                <label for="credit_percent">Credit percent (%)</label>
                <input type="text" name="credit_percent" id="credit_percent" placeholder="12.5" value="<?php out($credit_percent); ?>">
                <label for="output_type">Output type</label>
                <select name="output_type" id="output_type">
                    <option value="montly">Monthly</option>
                    <option value="annually" <?php if (isset($_REQUEST['output_type']) && $_REQUEST['output_type'] === 'annually') echo 'selected'; ?>>Annually</option>
                </select>
                <button type="submit" style="margin-top: 20px;" class="pure-button pure-button-primary">Calculate</button>
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

        if (isset($res) && $res !== null) : ?>

            <div style="max-width: 200px; padding: 10px; background-color: #22fe00; border: 1px solid #ddd; border-radius: 8px;">
                <h3>Result:</h3>
                <p><?php echo $res . ($output_type === 'annually' ? '$ per year' : '$ per month'); ?></p>
            </div>

        <?php endif ?>
    </main>
    <footer>
        <p style="margin: 30px 0;">Dominik Jałowiecki &copy; 2023</p>
    </footer>
</body>

</html>