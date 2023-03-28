<?php
require_once $config->root_path . '/libs/ActionController.class.php';

require_once $config->root_path . '/app/security/login/LoginForm.class.php';
require_once $config->root_path . '/libs/Messages.class.php';
require_once $config->root_path . '/libs/smarty/Smarty.class.php';


/**
 * Class of login controller
 * @author Dominik Jałowiecki
 */
class LoginController extends ActionController
{
    private $form;
    private $messages;

    public function __construct()
    {
        $this->form = new LoginForm();
        $this->messages = new Messages();
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
        $this->form->login = isset($_REQUEST['login']) ? trim($_REQUEST['login']) : null;
        $this->form->password = isset($_REQUEST['password']) ? trim($_REQUEST['password']) : null;
    }

    protected function validate()
    {
        if ($this->form->login === null || $this->form->password === null)
            return false;

        if ($this->form->login === '')
            $this->messages->addError('Login is required!');

        if ($this->form->password === '')
            $this->messages->addError('Password is required!');

        if ($this->messages->isError()) return false;

        if ($this->form->login === 'admin' && $this->form->password === 'admin') {
            self::setRole('admin');
            return true;
        } elseif ($this->form->login === 'user' && $this->form->password === 'user') {
            self::setRole('user');
            return true;
        }

        $this->messages->addError('Invalid login or password...');
        return false;
    }

    public function process()
    {
        global $config;

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
        global $config;

        $smarty = new Smarty();

        $smarty->assign('app_url', $config->app_url);
        $smarty->assign('p_title', 'Credit calculator | Login');
        $smarty->assign('p_description', 'Website login form');
        $smarty->assign('p_major_title', 'Login');
        $smarty->assign('messages', $this->messages);

        $smarty->display($config->root_path . '/app/security/login/login.tpl');
    }
}
