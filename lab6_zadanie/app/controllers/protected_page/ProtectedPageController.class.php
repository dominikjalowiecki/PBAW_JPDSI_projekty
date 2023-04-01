<?php
require_once $config->root_path . '/core/Controller.class.php';

/**
 * Class of protected page controller
 * @author Dominik Jałowiecki
 */
class ProtectedPageController extends Controller
{
    protected function generateView()
    {
        $smarty = getSmarty();

        $smarty->assign('p_title', 'Credit calculator | Protected page');
        $smarty->assign('p_description', 'Credit calculator protected page');
        $smarty->assign('p_major_title', 'Protected page');
        $smarty->assign('p_major_description', 'This is protected page.');

        $smarty->display('protected_page.tpl');
    }
}
