<?php

namespace app\controllers;

/**
 * Class of protected page controller
 * @author Dominik Jałowiecki
 */
class ProtectedPageController extends \core\Controller
{
    protected function generateView()
    {
        global $user;

        $smarty = getSmarty();

        $smarty->assign('p_title', 'Credit calculator | Protected page');
        $smarty->assign('p_description', 'Credit calculator protected page');
        $smarty->assign('p_major_title', 'Protected page');
        $smarty->assign('p_major_description', 'This is protected page.');

        $smarty->assign('user', $user);

        $smarty->display('protected_page.tpl');
    }
}
