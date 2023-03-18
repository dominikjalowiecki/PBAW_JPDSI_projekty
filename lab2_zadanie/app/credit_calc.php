<?php
# Credit calculator controller

# Step 0 - Initialization phase
require_once __DIR__ . '/../config.php';


# Step 1 - Receiving client's parameters
$credit_amount = $_REQUEST['credit_amount'] ?? null;
$credit_duration = $_REQUEST['credit_duration'] ?? null; # In years
$credit_percent = $_REQUEST['credit_percent'] ?? null;
$output_type = $_REQUEST['output_type'] ?? null;


# Step 2 - Validation of passed parameters
if (
    $credit_amount === null ||
    $credit_duration === null ||
    $credit_percent === null
) {
    $messages[] = 'Invalid request! Some of the parameters are missing...';
}

if ($credit_amount == '') {
    $messages[] = 'Credit amount is missing...';
}

if ($credit_duration == '') {
    $messages[] = 'Credit duration is missing...';
}

if ($credit_percent == '') {
    $messages[] = 'Credit percent is missing...';
}

if (empty($messages)) {
    if (!(is_numeric($credit_amount) && $credit_amount > 0)) {
        $messages[] = 'Credit amount must be an unsigned, non zero integer...';
    }

    if (!(is_numeric($credit_duration) && $credit_duration > 0)) {
        $messages[] = 'Credit duration must be an unsigned, non zero integer...';
    }

    if (!(is_numeric($credit_percent) && $credit_percent > 0)) {
        $messages[] = 'Credit percent must be a positive number...';
    }
}


# Step 3. Business logic
if (empty($messages)) {
    $credit_amount = intval($credit_amount);
    $credit_duration = intval($credit_duration);
    $credit_percent = floatval($credit_percent);

    switch ($output_type) {
        case 'annually':
            $res = round($credit_amount + $credit_amount * $credit_percent / 100, 2);
            break;
        default:
            $months = $credit_duration * 12;
            $res = round(($credit_amount + $credit_amount * $credit_percent / 100) / $months, 2);
            break;
    }
}


# Step 4. Including view
include _ROOT_PATH . '/app/credit_calc_view.php';
