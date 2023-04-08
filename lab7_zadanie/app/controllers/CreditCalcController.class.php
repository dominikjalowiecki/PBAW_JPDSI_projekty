<?php

namespace app\controllers;

use app\forms\CreditCalcForm;
use app\models\CreditCalcResult;
use function core\{
    getFromRequest,
    getFromSession,
    inRoles
};

/**
 * Class of credit calculator controller
 * @author Dominik Jałowiecki
 */
class CreditCalcController extends \core\ActionController
{
    private $form;
    private $result;
    private $hide_hero;

    public function __construct()
    {
        $this->form = new CreditCalcForm();
        $this->result = new CreditCalcResult();
        $this->hide_hero = false;
    }

    protected function getParams()
    {
        $this->form->credit_amount = getFromRequest('credit_amount');
        $this->form->credit_duration = getFromRequest('credit_duration'); # In years
        $this->form->credit_percent = getFromRequest('credit_percent');
        $this->form->output_type = getFromRequest('output_type');
    }

    protected function validate()
    {
        $messages = getMessages();

        if (
            $this->form->credit_amount === null ||
            $this->form->credit_duration === null ||
            $this->form->credit_percent === null
        ) return false;

        $messages->addInfo('Parameters received.');

        $this->hide_hero = true;

        if ($this->form->credit_amount === '')
            $messages->addError('Credit amount is missing...');

        if ($this->form->credit_duration === '')
            $messages->addError('Credit duration is missing...');

        if ($this->form->credit_percent === '')
            $messages->addError('Credit percent is missing...');

        if ($messages->isError()) return false;

        if (!$messages->isError()) {
            if (!(is_numeric($this->form->credit_amount) && $this->form->credit_amount > 0))
                $messages->addError('Credit amount must be an unsigned, non zero integer...');

            if (!(is_numeric($this->form->credit_duration) && $this->form->credit_duration > 0))
                $messages->addError('Credit duration must be an unsigned, non zero integer...');

            if (!(is_numeric($this->form->credit_percent) && $this->form->credit_percent > 0))
                $messages->addError('Credit percent must be a positive number...');
        }

        if ($messages->isError()) return false;

        $messages->addInfo('Parameters validated successfully!');
        return true;
    }

    public function action_credit_calc()
    {
        $messages = getMessages();
        $this->getParams();

        if ($this->validate()) {
            if (!inRoles('admin')) {
                $messages->addError('Only user with administrative privileges can use credit calculator!');
            } else {
                $messages->addInfo('Proceeding to calculations.');

                $this->result->output_type = $this->form->output_type;

                $credit_amount = intval($this->form->credit_amount);
                $credit_duration = intval($this->form->credit_duration);
                $credit_percent = floatval($this->form->credit_percent);

                switch ($this->result->output_type) {
                    case 'annually':
                        $this->result->result = ($credit_amount + $credit_amount * $credit_percent / 100) / $credit_duration;
                        break;
                    default:
                        $months = $credit_duration * 12;
                        $this->result->result = ($credit_amount + $credit_amount * $credit_percent / 100) / $months;
                        break;
                }
            }
        }

        $this->generateView();
    }

    protected function generateView()
    {
        $smarty = getSmarty();

        $smarty->assign('p_title', 'Credit calculator | Calculator');
        $smarty->assign('p_description', 'Calculator page');
        $smarty->assign('p_major_title', 'Credit calculator');
        $smarty->assign('p_major_description', 'Calculate credit interest within seconds.');

        $smarty->assign('form', $this->form);
        $smarty->assign('result', $this->result);
        $smarty->assign('hide_hero', $this->hide_hero);

        $smarty->assign('user', unserialize(getFromSession('user')));

        $smarty->display('credit_calc.tpl');
    }
}
