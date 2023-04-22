<?php

namespace app\controllers;

use function core\getFromSession;

/**
 * Class of results page controller
 * @author Dominik Jałowiecki
 */
class ResultsController extends \core\Controller
{
    private $results;

    public function action_get_results()
    {
        try {
            $database = getDb();

            $this->results = $database->select('result', '*', [
                'ORDER' => [
                    'date' => 'DESC'
                ],
                'LIMIT' => [0, 10]
            ]);
        } catch (\PDOException $e) {
            getMessages()->addError('An error has occurred while reading from database...');
            if (getConfig()->debug) getMessages()->addError('Database error: ' . $e->getMessage());
        }

        $this->generateView();
    }

    protected function generateView()
    {
        $smarty = getSmarty();

        $smarty->assign('p_title', 'Credit calculator | Results page');
        $smarty->assign('p_description', 'Credit calculator results page');
        $smarty->assign('p_major_title', 'Results page');
        $smarty->assign('p_major_description', 'See previous 10 users\' calculations.');

        $smarty->assign('results', $this->results);
        $smarty->assign('user', unserialize(getFromSession('user')));

        $smarty->display('results.tpl');
    }
}
