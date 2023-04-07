<?php

namespace app\controllers;

use app\forms\LoginForm;
use app\models\User;
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
            $user = new User($this->form->login, 'admin');
            $_SESSION['user'] = serialize($user);
            return true;
        } elseif ($this->form->login === 'user' && $this->form->password === 'user') {
            $user = new User($this->form->login, 'user');
            $_SESSION['user'] = serialize($user);
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
            $action = getFromRequest('next');

            if (!empty($action))
                header('Location: ' . $config->action_url . $action);
            else
                header('Location: ' . $config->app_url);
        }
    }

    public function logout()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        session_destroy();

        getMessages()->addInfo('Logged out successfully.');

        $this->generateView();
    }

    protected function generateView()
    {
        $smarty = getSmarty();

        $smarty->assign('p_title', 'Credit calculator | Login');
        $smarty->assign('p_description', 'Website login form');
        $smarty->assign('p_major_title', 'Login');
        $smarty->assign('next', '&next=' . getFromRequest('next'));

        $smarty->display('login.tpl');
    }
}
