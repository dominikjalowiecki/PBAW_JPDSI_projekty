<?php
# Credit calculator controller
require_once __DIR__ . '/../config.php';
require_once _ROOT_PATH . '/libs/smarty/Smarty.class.php';

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


function validateCalc($credit_amount, $credit_duration, $credit_percent, &$infos, &$messages, &$hide_hero)
{
    if (
        $credit_amount === null ||
        $credit_duration === null ||
        $credit_percent === null
    ) return false;

    $infos[] = 'Parameters received.';

    $hide_hero = true;

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

    $infos[] = 'Parameters validated successfully!';
    return true;
}


function processCalc($credit_amount, $credit_duration, $credit_percent, $output_type, &$infos, &$messages)
{
    global $role;

    if ($role !== 'admin') {
        $messages[] = 'Only user with administrative privileges can use credit calculator!';
        return null;
    }

    $infos[] = 'Proceeding to calculations.';

    $credit_amount = intval($credit_amount);
    $credit_duration = intval($credit_duration);
    $credit_percent = floatval($credit_percent);

    switch ($output_type) {
        case 'annually':
            return ($credit_amount + $credit_amount * $credit_percent / 100) / $credit_duration;
        default:
            $months = $credit_duration * 12;
            return ($credit_amount + $credit_amount * $credit_percent / 100) / $months;
    }
}


$messages = array();
$infos = array();
$hide_hero = false;
$res = null;

[$credit_amount, $credit_duration, $credit_percent, $output_type] = getCalcParams();

if (validateCalc($credit_amount, $credit_duration, $credit_percent, $infos, $messages, $hide_hero))
    $res = processCalc($credit_amount, $credit_duration, $credit_percent, $output_type, $infos, $messages);

$smarty = new Smarty();

$smarty->assign('app_url', _APP_URL);
$smarty->assign('p_title', 'Credit calculator | Calculator');
$smarty->assign('p_description', 'Calculator page');
$smarty->assign('p_major_title', 'Credit caltulator');
$smarty->assign('p_major_description', 'Calculate credit interest within seconds.');

$smarty->assign('credit_amount', $credit_amount);
$smarty->assign('credit_duration', $credit_duration);
$smarty->assign('credit_percent', $credit_percent);
$smarty->assign('output_type', $output_type);
$smarty->assign('res', $res);
$smarty->assign('messages', $messages);
$smarty->assign('infos', $infos);
$smarty->assign('hide_hero', $hide_hero);

$smarty->display(_ROOT_PATH . '/app/credit_calc.tpl');
