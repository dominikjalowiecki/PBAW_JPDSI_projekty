<?php
# Credit calculator controller
require_once __DIR__ . '/../config.php';

include _ROOT_PATH . '/app/security/check.php';


function getCalcParams()
{
    return [
        $_REQUEST['credit_amount'] ?? null,
        $_REQUEST['credit_duration'] ?? null, # In years
        $_REQUEST['credit_percent'] ?? null,
        $_REQUEST['output_type'] ?? null
    ];
}


function validateCalc($credit_amount, $credit_duration, $credit_percent, &$messages)
{
    if (
        $credit_amount === null ||
        $credit_duration === null ||
        $credit_percent === null
    ) return false;

    if ($credit_amount === '')
        $messages[] = 'Credit amount is missing...';

    if ($credit_duration === '')
        $messages[] = 'Credit duration is missing...';

    if ($credit_percent === '')
        $messages[] = 'Credit percent is missing...';

    if (count($messages) !== 0) return false;

    if (empty($messages)) {
        if (!(is_numeric($credit_amount) && $credit_amount > 0))
            $messages[] = 'Credit amount must be an unsigned, non zero integer...';

        if (!(is_numeric($credit_duration) && $credit_duration > 0))
            $messages[] = 'Credit duration must be an unsigned, non zero integer...';

        if (!(is_numeric($credit_percent) && $credit_percent > 0))
            $messages[] = 'Credit percent must be a positive number...';
    }

    if (count($messages) !== 0) return false;

    return true;
}


function processCalc($credit_amount, $credit_duration, $credit_percent, $output_type, &$messages)
{
    global $role;

    if ($role !== 'admin') {
        $messages[] = 'Only user with administrative privileges can use credit calculator!';
        return null;
    }

    $credit_amount = intval($credit_amount);
    $credit_duration = intval($credit_duration);
    $credit_percent = floatval($credit_percent);

    switch ($output_type) {
        case 'annually':
            return round(($credit_amount + $credit_amount * $credit_percent / 100) / $credit_duration, 2);
        default:
            $months = $credit_duration * 12;
            return round(($credit_amount + $credit_amount * $credit_percent / 100) / $months, 2);
    }
}


$messages = array();

[$credit_amount, $credit_duration, $credit_percent, $output_type] = getCalcParams();

if (validateCalc($credit_amount, $credit_duration, $credit_percent, $messages))
    $res = processCalc($credit_amount, $credit_duration, $credit_percent, $output_type, $messages);


include _ROOT_PATH . '/app/credit_calc_view.php';
