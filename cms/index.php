<?php
require_once 'config/config.php';

// Autoloader
spl_autoload_register(function($className){
    // Namespace to file path mapping could be added here if using Namespaces
    // For simplicity, we check core, controllers, models
    if(file_exists('app/core/' . $className . '.php')){
        require_once 'app/core/' . $className . '.php';
    } else if (file_exists('app/controllers/' . $className . '.php')){
        require_once 'app/controllers/' . $className . '.php';
    } else if (file_exists('app/models/' . $className . '.php')){
        require_once 'app/models/' . $className . '.php';
    }
});

// Init Core Library
$init = new App();
