<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit calculator</title>
</head>

<body>
    <a href="<?php echo _APP_URL; ?>">
        <h1>Credit calculator</h1>
    </a>
    <form action="<?php echo _APP_URL . '/app/credit_calc.php' ?>" method="GET">
        <p>
            <label for="credit_amount">Credit amount</label><br />
            <input type="text" name="credit_amount" id="credit_amount" placeholder="100000" value="<?php if (isset($_REQUEST['credit_amount'])) echo $_REQUEST['credit_amount']; ?>"><span> $</span>
        </p>
        <p>
            <label for="credit_duration">Credit duration</label><br />
            <input type="text" name="credit_duration" id="credit_duration" placeholder="5" value="<?php if (isset($_REQUEST['credit_duration'])) echo $_REQUEST['credit_duration']; ?>"><span> years</span>
        </p>
        <p>
            <label for="credit_percent">Credit percent</label><br />
            <input type="text" name="credit_percent" id="credit_percent" placeholder="12.5" value="<?php if (isset($_REQUEST['credit_percent'])) echo $_REQUEST['credit_percent']; ?>"><span> %</span>
        </p>
        <p>
            <label for="output_type">Output type</label><br />
            <select name="output_type" id="output_type">
                <option value="montly">Monthly</option>
                <option value="annually" <?php if (isset($_REQUEST['output_type']) && $_REQUEST['output_type'] === 'annually') echo 'selected'; ?>>Annually</option>
            </select>
        </p>
        <p>
            <button type="submit">Calculate</button>
        </p>
    </form>
    <?php
    if (isset($messages)) {
        echo '<ol style="max-width: 300px; padding: 10px 10px 10px 30px; background-color: #fefe00; border: solid black 1px;">';
        foreach ($messages as $message) {
            echo '<li>' . $message . '</li>';
        }
        echo '</ol>';
    }

    if (isset($res)) : ?>

        <div style="max-width: 200px; padding: 10px; background-color: #22fe00; border: solid black 1px;">
            <h3>Result:</h3>
            <p><?php echo $res . ($output_type === 'annually' ? '$ per year' : '$ per month'); ?></p>
        </div>

    <?php endif ?>

    <p style="margin: 30px 20px;">Dominik Jałowiecki &copy; 2023</p>
</body>

</html>