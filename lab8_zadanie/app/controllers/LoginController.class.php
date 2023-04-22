<?php

namespace app\controllers;

use app\forms\LoginForm;
use app\models\User;
use function core\{
    getFromGet,
    getFromPost,
    getFromSession,
    addRole
};

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
        $this->form->login = getFromPost('login');
        $this->form->password = getFromPost('password');
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
            addRole($user->role);
            $_SESSION['user'] = serialize($user);
            return true;
        } elseif ($this->form->login === 'user' && $this->form->password === 'user') {
            $user = new User($this->form->login, 'user');
            addRole($user->role);
            $_SESSION['user'] = serialize($user);
            return true;
        }

        $messages->addError('Invalid login or password...');
        return false;
    }

    public function action_login()
    {
        $user = (getFromSession('user') != null) ? unserialize(getFromSession('user')) : null;
        if (isset($user) && isset($user->login) && isset($user->role)) getRouter()->redirectTo('');

        $this->getParams();

        if (!$this->validate()) {
            $this->generateView();
        } else {
            $action = getFromGet('next');

            if (isset($action))
                getRouter()->redirectTo($action);
            else
                getRouter()->redirectTo('');
        }
    }

    public function action_logout()
    {
        session_destroy();

        getMessages()->addInfo('Logged out successfully.');

        $this->generateView();
    }

    protected function generateView()
    {
        $next = (getFromGet('next') != null) ? '?next=' . getFromGet('next') : '';

        $smarty = getSmarty();

        $smarty->assign('p_title', 'Credit calculator | Login');
        $smarty->assign('p_description', 'Website login form');
        $smarty->assign('p_major_title', 'Login');
        $smarty->assign('next', $next);

        $smarty->display('login.tpl');
    }
}
