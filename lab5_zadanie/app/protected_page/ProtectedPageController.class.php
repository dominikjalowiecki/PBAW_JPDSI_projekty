<?php
require_once $config->root_path . '/libs/Controller.class.php';

require_once $config->root_path . '/libs/smarty/Smarty.class.php';


/**
 * Class of protected page controller
 * @author Dominik Jałowiecki
 */
class ProtectedPageController extends Controller
{
    protected function generateView()
    {
        global $config;

        $smarty = new Smarty();

        $smarty->assign('app_url', $config->app_url);
        $smarty->assign('p_title', 'Credit calculator | Protected page');
        $smarty->assign('p_description', 'Credit calculator protected page');
        $smarty->assign('p_major_title', 'Protected page');
        $smarty->assign('p_major_description', 'This is protected page.');

        $smarty->display($config->root_path . '/app/protected_page/protected_page.tpl');
    }
}
