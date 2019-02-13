<?php
$autoload = function ($className) {

    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $class = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $className . '.php';
    if (file_exists($class) == true) {
        include_once($class);
    }
};
spl_autoload_register($autoload);

require(dirname(__FILE__) . '/lib/GUMP/gump.php');
