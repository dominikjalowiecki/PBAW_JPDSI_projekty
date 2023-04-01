<?php

namespace app\controllers;

use app\forms\LoginForm;
use function core\getFromRequest;

/**
 * Class of login controller
 * @author Dominik Jałowiecki
 */
class LoginController extends \core\ActionController
{
    private $form;

    public function __construct()
    {
        $this->form = new LoginForm();
    }

    /**
     * Method assigns role of logged in user
     */
    private static function setRole($name)
    {
        $_SESSION['role'] = $name;
    }

    protected function getParams()
    {
        $this->form->login = getFromRequest('login');
        $this->form->password = getFromRequest('password');
    }

    protected function validate()
    {
        $messages = getMessages();

        if ($this->form->login === null || $this->form->password === null)
            return false;

        if ($this->form->login === '')
            $messages->addError('Login is required!');

        if ($this->form->password === '')
            $messages->addError('Password is required!');

        if ($messages->isError()) return false;

        if ($this->form->login === 'admin' && $this->form->password === 'admin') {
            self::setRole('admin');
            return true;
        } elseif ($this->form->login === 'user' && $this->form->password === 'user') {
            self::setRole('user');
            return true;
        }

        $messages->addError('Invalid login or password...');
        return false;
    }

    public function process()
    {
        $config = getConfig();

        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        if (isset($_SESSION['role'])) header('Location: ' . $config->app_url);

        $this->getParams();

        if (!$this->validate()) {
            $this->generateView();
        } else {
            header('Location: ' . $config->app_url);
        }
    }

    protected function generateView()
    {
        $smarty = getSmarty();

        $smarty->assign('p_title', 'Credit calculator | Login');
        $smarty->assign('p_description', 'Website login form');
        $smarty->assign('p_major_title', 'Login');

        $smarty->display('login.tpl');
    }
}
