<?php

namespace core;

class ClassLoader
{
    public $paths = array();

    public function __construct()
    {
        spl_autoload_register(
            function ($classname) {
                $classname = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
                $filename = getConfig()->root_path . DIRECTORY_SEPARATOR . $classname . '.class.php';

                if (is_readable($filename)) {
                    require_once $filename;
                }
            }
        );
    }

    public function addPath($path)
    {
        $this->paths[] = $path;

        if (count($this->paths) == 1) {
            spl_autoload_register(
                function ($classname) {
                    $classname = str_replace('\\', DIRECTORY_SEPARATOR, $classname);

                    foreach ($this->paths as $path) {
                        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
                        $filename = getConfig()->root_path . $path . DIRECTORY_SEPARATOR . $classname . '.class.php';

                        if (is_readable($filename)) {
                            require_once $filename;
                        }
                    }
                }
            );
        }
    }
}
