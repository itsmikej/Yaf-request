<?php

namespace Imj\test;

error_reporting(E_ALL | E_STRICT);

// register autoloader
spl_autoload_register(function($class)
{
    $map = [
        'Imj\YafRequest' => __DIR__ . "/../src/YafRequest.php",
    ];
    if(isset($map[$class])) {
        require_once $map[$class];
        return true;
    }
    return false;
});
