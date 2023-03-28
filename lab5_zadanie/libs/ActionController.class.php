<?php
require_once __DIR__ . '/Controller.class.php';

/**
 * Abstract class of action controllers
 * @author Dominik Jałowiecki
 */
abstract class ActionController extends Controller
{
    /**
     * Method receive sent parameters
     */
    abstract protected function getParams();

    /**
     * Method validates received data
     * @return boolean true if data is valid, false otherwise
     */
    abstract protected function validate();
}
