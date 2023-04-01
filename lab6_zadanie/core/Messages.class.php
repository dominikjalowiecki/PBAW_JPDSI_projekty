<?php

namespace core;

/**
 * Class of messages
 * @author Dominik Jałowiecki
 */
class Messages
{
    /** @var string[] $errors array Contains error messages */
    private $errors;
    /** @var string[] $infos array Contains information messages */
    private $infos;
    /** @var int $count Count of inserted messages */
    private $count;

    public function __construct()
    {
        $this->errors = array();
        $this->infos = array();
        $this->count = 0;
    }

    /**
     * @param string $message Message to be inserted as an error
     */
    public function addError($message)
    {
        $this->errors[] = $message;
        ++$this->count;
    }

    /**
     * @param string $message Message to be inserted as an information
     */
    public function addInfo($message)
    {
        $this->infos[] = $message;
        ++$this->count;
    }

    /**
     * @return boolean true if there are errors, false otherwise
     */
    public function isError()
    {
        return count($this->errors) > 0;
    }

    /**
     * @return boolean true if there are informations, false otherwise
     */
    public function isInfo()
    {
        return count($this->infos) > 0;
    }

    /**
     * @return $errors Array of errors
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return @infos Array of informations
     */
    public function getInfos()
    {
        return $this->infos;
    }

    /**
     * @return boolean true if no available messages, false otherwise
     */
    public function isEmpty()
    {
        return $this->count === 0;
    }

    /**
     * Method purges errors, informations and resets $count property
     */
    public function purge()
    {
        unset($this->errors);
        $this->errors = array();

        unset($this->infos);
        $this->infos = array();

        $this->count = 0;
    }
}
