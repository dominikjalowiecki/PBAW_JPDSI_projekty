<?php
require_once $config->root_path . '/libs/ActionController.class.php';

require_once $config->root_path . '/app/credit_calc/CreditCalcForm.class.php';
require_once $config->root_path . '/app/credit_calc/CreditCalcResult.class.php';
require_once $config->root_path . '/libs/Messages.class.php';
require_once $config->root_path . '/libs/smarty/Smarty.class.php';


/**
 * Class of credit calculator controller
 * @author Dominik Jałowiecki
 */
class CreditCalcController extends ActionController
{
    private $form;
    private $result;
    private $messages;
    private $hide_hero;

    public function __construct()
    {
        $this->form = new CreditCalcForm();
        $this->result = new CreditCalcResult();
        $this->messages = new Messages();
        $this->hide_hero = false;
    }

    protected function getParams()
    {
        $this->form->credit_amount = isset($_REQUEST['credit_amount']) ? trim($_REQUEST['credit_amount']) : null;
        $this->form->credit_duration = isset($_REQUEST['credit_duration']) ? trim($_REQUEST['credit_duration']) : null; # In years
        $this->form->credit_percent = isset($_REQUEST['credit_percent']) ? trim($_REQUEST['credit_percent']) : null;
        $this->form->output_type = isset($_REQUEST['output_type']) ? trim($_REQUEST['output_type']) : null;
    }

    protected function validate()
    {
        if (
            $this->form->credit_amount === null ||
            $this->form->credit_duration === null ||
            $this->form->credit_percent === null
        ) return false;

        $this->messages->addInfo('Parameters received.');

        $this->hide_hero = true;

        if ($this->form->credit_amount === '')
            $this->messages->addError('Credit amount is missing...');

        if ($this->form->credit_duration === '')
            $this->messages->addError('Credit duration is missing...');

        if ($this->form->credit_percent === '')
            $this->messages->addError('Credit percent is missing...');

        if ($this->messages->isError()) return false;

        if ($this->messages->isError()) {
            if (!(is_numeric($this->form->credit_amount) && $this->form->credit_amount > 0))
                $this->messages->addError('Credit amount must be an unsigned, non zero integer...');

            if (!(is_numeric($this->form->credit_duration) && $this->form->credit_duration > 0))
                $this->messages->addError('Credit duration must be an unsigned, non zero integer...');

            if (!(is_numeric($this->form->credit_percent) && $this->form->credit_percent > 0))
                $this->messages->addError('Credit percent must be a positive number...');
        }

        if ($this->messages->isError()) return false;

        $this->messages->addInfo('Parameters validated successfully!');
        return true;
    }

    public function process()
    {
        $this->getParams();

        if ($this->validate()) {
            global $role;

            if ($role !== 'admin') {
                $this->messages->addError('Only user with administrative privileges can use credit calculator!');
            } else {
                $this->messages->addInfo('Proceeding to calculations.');

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
        global $config;

        $smarty = new Smarty();

        $smarty->assign('app_url', $config->app_url);
        $smarty->assign('p_title', 'Credit calculator | Calculator');
        $smarty->assign('p_description', 'Calculator page');
        $smarty->assign('p_major_title', 'Credit calculator');
        $smarty->assign('p_major_description', 'Calculate credit interest within seconds.');

        $smarty->assign('form', $this->form);
        $smarty->assign('result', $this->result);
        $smarty->assign('messages', $this->messages);
        $smarty->assign('hide_hero', $this->hide_hero);

        $smarty->display($config->root_path . '/app/credit_calc/credit_calc.tpl');
    }
}
