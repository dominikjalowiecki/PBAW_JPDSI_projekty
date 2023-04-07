<?php

namespace core;

/**
 * Abstract class of simple controllers
 * @author Dominik Jałowiecki
 */
abstract class Controller
{
    /**
     * Method call all necesarry methods, processes data (if available) and calls generateView()
     */
    public function process()
    {
        $this->generateView();
    }

    /**
     * Method that generates view
     */
    abstract protected function generateView();
}
